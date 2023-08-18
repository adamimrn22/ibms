<?php

namespace App\Http\Controllers\Admin\Booking\UPSM;

use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UpsmInventory;
use App\Models\UpsmVehicleBooking;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Mail\TempahanKereta\PesananKeretaLulus;

class KenderaanBookingController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $query = UpsmVehicleBooking::query()->with('staff', 'inventory', 'status');

        $data = $this->applyPaginationFilterSearch(1,$query, $perPage, $searchTerm);
        if ($request->ajax()) {
            return response()->json([
                'table' => view('Admin.AdminUPSM.Booking.kenderaan.bookingTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUPSM.Booking.kenderaan.viewBooking', compact('data'));
    }

    public function indexHistory(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $filter = $request->input('status');

        $query = UpsmVehicleBooking::query()->with('staff', 'inventory', 'status');

        $data = $this->applyPaginationFilterSearch(0, $query, $perPage, $searchTerm, $filter);
        if ($request->ajax()) {
            return response()->json([
                'table' => view('Admin.AdminUPSM.Booking.kenderaan.historyBookingTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('Admin.AdminUPSM.Booking.kenderaan.viewHistoryBooking', compact('data'));
    }

    public function edit(string $encryptID)
    {
        $id = Crypt::decryptString($encryptID);
        $booking = UpsmVehicleBooking::with('staff')->findOrFail($id);

        if($booking->status_id !== 1) {
            abort(500, 'BOOKING IS ALREADY UPDATED');
        }

        $staffs = User::role('User')->get();
        $cars = UpsmInventory::where('subcategory_id', 17)->where('status_id', 12)->get();
        return view('Admin.AdminUPSM.Booking.kenderaan.updateBooking', compact('booking', 'staffs', 'cars'));
    }

    public function update(Request $request, string $id)
    {

        $updateBtn = $request->input('updateBooking');
        $driver = $request->input('driver');
        $car = $request->input('car');
        $remark = $request->input('remark');
        $booking = UpsmVehicleBooking::with('staff')->find($id);

        if($booking->status_id !== 1) {
            abort(500, 'BOOKING IS ALREADY UPDATED');
        }

        if(empty($remark)){
            $remark = 'Tiada Ulasan';
        }

        if ($booking) {
            if($updateBtn) {
                $booking->update([
                    'driver_id' => $driver,
                    'car_id' => $car,
                    'status_id' => 2,
                    'remark' => $remark,
                    'updated_at' => now(),
                ]);

                Mail::to($booking->staff[0]->email)->queue(new PesananKeretaLulus($booking));

                return redirect()->route('upsm.BookingKenderaan.indexHistory')->with([
                    'success'  => 'Booking ' . $booking->reference . ' telah diapprove',
                    'bookingID' => $booking->id
                ]);
            } else {
                UpsmVehicleBooking::where('id', $id)->update([
                    'status_id' => 3,
                    'remark' => $remark,
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function generatePDF(string $encryptID)
    {
        $id = Crypt::decryptString($encryptID);
        $booking = UpsmVehicleBooking::with('staff', 'driverBooking', 'vehicleBooking')->find($id);

        if (!$booking) {
            abort(404); // Booking not found
        }

        $booking->vehicle = json_decode($booking->vehicleBooking->attribute);


        // Load your view with the booking data
        $pdfContent = view('pdf.printTempahanKenderaan', ['booking' => $booking])->render();

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
