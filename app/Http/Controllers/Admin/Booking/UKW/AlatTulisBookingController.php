<?php

namespace App\Http\Controllers\Admin\Booking\UKW;

use App\Models\UkwBooking;
use App\Models\UkwInventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ApproveAlatTulis;
use App\Mail\RejectedAlatTulis;
use App\Models\UserPaperBookingAmount;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

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
        $bookings = UkwBooking::with('inventory', 'user')->where('reference', $reference)->get();



        return view('Admin.AdminUKW.Booking.AlatTulis.updateBookingTable', compact('bookings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $updateBookingBtn = $request->input('updateBooking');
            $bookingUpdates = $request->input('booking', []);
            $quantityUpdates = $request->input('quantity', []);
            $userEmail = null;

            if($updateBookingBtn === 'rejectButton'){
                foreach ($bookingUpdates as $bookingId => $status) {
                    $booking = UkwBooking::with('inventory', 'user')->find($bookingId);
                    $booking->status_id = 3;
                    $booking->updated_at = now();
                    $booking->save();

                    $reference = $booking->reference;
                    $userEmail = $booking->user->email;

                }

                if ($userEmail) {
                    Mail::to($userEmail)->queue(new RejectedAlatTulis($reference));
                }

                return redirect()->route('ukw.BookingAlatTulis.index')->with([
                    'success' => 'Success'
                ]);

            }else if ($updateBookingBtn === 'approveButton') {

                if(empty($bookingUpdates)) {
                    return back()->with(['error' => 'error']);
                }

                foreach ($bookingUpdates as $bookingId => $status) {

                    $booking = UkwBooking::with('inventory', 'user', 'status')->find($bookingId);



                    if ($status === 'approved') {
                        $approvedQuantity = intval($quantityUpdates[$bookingId]);
                        $booking->status_id = 2;
                        $booking->approved_quantity = $approvedQuantity;
                        $booking->inventory->current_quantity -= $approvedQuantity;
                    } else {
                        $booking->status_id = 3;
                        $booking->approved_quantity = 0 ;
                    }

                    if($booking->inventory->subcategory_id == 22) {
                        $userPaperBooking = UserPaperBookingAmount::where('user_id', $booking->user->id)->first();
                        if ($userPaperBooking) {
                            $userPaperBooking->subtractAmount( $quantityUpdates[$bookingId] );
                        }
                    }

                    $booking->updated_at = now();
                    $reference = $booking->reference;
                    $user = $booking->user;
                    $userEmail = $booking->user->email;

                    $booking->save();
                    $booking->inventory->save();
                }


                if ($userEmail) {
                    Mail::to($userEmail)->queue(new ApproveAlatTulis($user, $reference));
                }

                return redirect()->route('ukw.BookingAlatTulis.index')->with([
                    'success' => 'Success'
                ]);
            }
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
