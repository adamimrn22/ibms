<?php

namespace App\Http\Controllers\Admin\Booking\UKW;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
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

        $data = $this->applyPaginationFilterSearch(1, $query, $perPage, $searchTerm);
        if ($request->ajax()) {
            return response()->json([
                'table' => view('Admin.AdminUKW.Booking.AlatTulis.bookingTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUKW.Booking.AlatTulis.ViewBooking', compact('data'));
    }

    public function indexHistory(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $filter = $request->input('status');

        $query = UkwBooking::query()->with('status');

        $data = $this->applyPaginationFilterSearch(0, $query, $perPage, $searchTerm, $filter);
        if ($request->ajax()) {
            return response()->json([
                'table' => view('Admin.AdminUKW.Booking.AlatTulis.viewHistoryBookingTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

         return view('Admin.AdminUKW.Booking.AlatTulis.viewBookingHistory', compact('data'));
    }

    public function generatePDF(string $encryptID)
    {
        $id = Crypt::decryptString($encryptID);
        $booking = UkwBooking::with('user', 'inventories')->find($id);
// dd($booking);
        if (!$booking) {
            abort(404); // Booking not found
        }
        // Load your view with the booking data
        $pdfContent = view('pdf.printPinjamanAlatanTulis', ['booking' => $booking])->render();

        // Create Dompdf options
        $pdfOptions = new Options();
        $pdfOptions->set('isHtml5ParserEnabled', true);
        $pdfOptions->set('isRemoteEnabled', true);

        // Create a Dompdf instance
        $dompdf = new Dompdf($pdfOptions);
        $dompdf->loadHtml($pdfContent);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();

           // Return the PDF content in a new tab
        return response($dompdf->output())
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', "inline; filename={$booking->reference}_" . Carbon::parse($booking->created_at)->format('Y-m-d') . ".pdf");
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
            $remarkNotes = $request->input('remarkNotes', []);

            $updatedAttributes = [];

                if($updateBookingBtn)
                {
                    $booking->update([
                        'status_id' => 2,
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

                                        $attributes['approved_quantity'] = $approvedQuantity[$itemID];
                                        $attributes['remarkNotes'] = $remarkNotes[$itemID];
                                        $attributes['status_id'] = 2;
                                        $attributes['updated_at'] = now();
                                    }else {
                                        $attributes['approved_quantity'] = 0;
                                        $attributes['remarkNotes'] = $remarkNotes[$itemID];
                                        $attributes['status_id'] = 3;
                                        $attributes['updated_at'] = now();
                                    }
                                }else {
                                    return redirect()->route('ukw.BookingAlatTulis.index')->with([
                                        'error' => 'User Amount for a4 is not set'
                                    ]);
                                }
                            }else {
                                $attributes['approved_quantity'] = $approvedQuantity[$itemID];
                                $attributes['updated_at'] = now();
                                $attributes['remarkNotes'] = $remarkNotes[$itemID];

                                $attributes['status_id'] = 2;
                            }

                        } else {
                            $attributes['approved_quantity'] = 0;
                            $attributes['remarkNotes'] = $remarkNotes[$itemID];
                            $attributes['status_id'] = 3;
                        }


                        $updatedAttributes[$itemID] = $attributes;
                    }

                    $booking->inventories()->sync($updatedAttributes);
                    Mail::to($booking->user->email)->queue(new ApproveAlatTulis($booking->user, $booking->reference));

                }else {

                    $booking->update([
                        'status_id' => 3,
                        'updated_at' => now()
                    ]);

                    foreach ($bookingItemId as $inventoryId => $quantity) {
                        $attributes = [
                            'approved_quantity' => 0,
                            'status_id' => 3,
                            $attributes['remarkNotes'] = $remarkNotes[$inventoryId],
                            'updated_at' => now(),
                        ];

                        $updatedAttributes[$inventoryId] = $attributes;
                    }

                    $booking->inventories()->sync($updatedAttributes);
                    Mail::to($booking->user->email)->queue(new RejectedAlatTulis($booking->reference));
                }
            return redirect()->route('ukw.BookingAlatTulis.indexHistory')->with([
                'success'  => 'Booking ' . $booking->reference . ' telah diapprove',
                'bookingID' => $booking->id
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

    public function applyPaginationFilterSearch($type, $query, $perPage, $searchTerm, $status = null)
    {
        if($type){
            $query->where('status_id', 1);

            // For search filtering
            if ($searchTerm) {
                $query->where('reference', 'LIKE', "%{$searchTerm}%")
                ->where('status_id', 1);
            }

            $query->latest('created_at');
            // Apply pagination
            return $query->paginate($perPage);
            $query->where('status_id', 1);

        }else {
            $query->where('status_id', '!=', 1);
            // For search filtering
            if ($searchTerm) {
                $query->where('reference', 'LIKE', "%{$searchTerm}%")
                ->where('status_id', '!=', 1);
            }

            if ($status && $status !== 'ALL') {
                $query->where('status_id', '=', "$status");
            }

            $query->latest('updated_at');

            // Apply pagination
            return $query->paginate($perPage);
        }
    }
}
