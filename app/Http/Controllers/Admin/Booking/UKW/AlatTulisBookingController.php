<?php

namespace App\Http\Controllers\Admin\Booking\UKW;

use Carbon\Carbon;
use App\Models\UkwBooking;
use App\Models\UkwInventory;
use Illuminate\Http\Request;
use App\Mail\ApproveAlatTulis;
use App\Mail\RejectedAlatTulis;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Models\UserPaperBookingAmount;

class AlatTulisBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $query = UkwBooking::query()->with('status');

        $data = $this->applyPaginationFilterSearch($query, $perPage, $searchTerm);
        if ($request->ajax()) {
            return response()->json([
                'table' => view('Admin.AdminUKW.Booking.AlatTulis.bookingTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUKW.Booking.AlatTulis.ViewBooking', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $encrypytReference)
    {
        $reference = Crypt::decryptString($encrypytReference);
        $booking = UkwBooking::with('inventories', 'user')->where('reference', $reference)->first();

        if($booking->status_id !== 1) {
           return abort(500, 'BOOKING IS ALREADY UPDATED');
        }

        return view('Admin.AdminUKW.Booking.AlatTulis.updateBookingTable', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $booking = UkwBooking::with('inventories','user')->find($id);

            if($booking->status_id !== 1) {
                abort(500, 'BOOKING IS ALREADY UPDATED');
            }

            $updateBookingBtn = $request->input('updateBooking');
            $bookingItemId = $request->input('booking', []);
            $bookingItemSubCategory = $request->input('subcategory', []);
            $approvedQuantity = $request->input('approvedQuantity', []);
            $remark = $request->input('remark');

            if(empty($remark)){
                $remark = 'Tiada Remarks';
            }

            $updatedAttributes = [];

                if($updateBookingBtn)
                {
                    $booking->update([
                        'status_id' => 2,
                        'remark' => $remark,
                        'updated_at' => now()
                    ]);

                    foreach ($bookingItemId as $itemID => $isApprove ) {

                        if ($isApprove === 'approved') {

                            if($bookingItemSubCategory[$itemID] == 22) {

                                $currentYear = Carbon::parse($booking->created_at)->format('Y');
                                $currentMonth = Carbon::parse($booking->created_at)->format('n');

                                $userPaperBooking = UserPaperBookingAmount::where('year', $currentYear)
                                    ->where('month', $currentMonth)
                                    ->where('user_id', $booking->user->id)
                                    ->first();

                                if ($userPaperBooking) {
                                    if ($userPaperBooking->amount > 0) {
                                        $userPaperBooking->subtractAmount( $approvedQuantity[$itemID] );
                                    }else {
                                        $attributes['approved_quantity'] = 0;
                                        $attributes['updated_at'] = now();
                                        $attributes['status_id'] = 3;
                                    }
                                }else {
                                    return redirect()->route('ukw.BookingAlatTulis.index')->with([
                                        'error' => 'User Amount for a4 is not set'
                                    ]);
                                }
                            }else {
                                $attributes['approved_quantity'] = $approvedQuantity[$itemID];
                                $attributes['updated_at'] = now();
                                $attributes['status_id'] = 2;
                            }

                        } else {
                            $attributes['approved_quantity'] = 0;
                            $attributes['status_id'] = 3;
                        }

                        $updatedAttributes[$itemID] = $attributes;
                    }

                    $booking->inventories()->sync($updatedAttributes);
                    Mail::to($booking->user->email)->queue(new ApproveAlatTulis($booking->user, $booking->reference));

                }else {

                    $booking->update([
                        'status_id' => 3,
                        'remark' => $remark,
                        'updated_at' => now()
                    ]);

                    foreach ($bookingItemId as $inventoryId => $quantity) {
                        $attributes = [
                            'approved_quantity' => 0,
                            'status_id' => 3,
                            'updated_at' => now(),
                        ];

                        $updatedAttributes[$inventoryId] = $attributes;
                    }

                    $booking->inventories()->sync($updatedAttributes);
                    Mail::to($booking->user->email)->queue(new RejectedAlatTulis($booking->reference));
                }
            return redirect()->route('ukw.BookingAlatTulis.index')->with([
                'success' => 'Success'
            ]);

        } catch (\Throwable $th) {
            return redirect()->route('ukw.BookingAlatTulis.index')->with(['error' => strval($th->getMessage())]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function applyPaginationFilterSearch($query, $perPage, $searchTerm)
    {
        // For search filtering
        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->whereHas('user', function ($userQuery) use ($searchTerm) {
                    $userQuery->where('name', 'LIKE', "%{$searchTerm}%");
                })
                ->orWhere('reference', 'LIKE', "%{$searchTerm}%")
                ->where('status_id', 1);
            });
        }

        // Subquery to get latest entries for each reference
        $subQuery = UkwBooking::selectRaw('MAX(id) as id')
            ->groupBy('reference')->where('status_id', 1);

        // Apply groupBy
        $query->whereIn('id', $subQuery);

        // Apply pagination
        return $query->paginate($perPage);
    }
}
