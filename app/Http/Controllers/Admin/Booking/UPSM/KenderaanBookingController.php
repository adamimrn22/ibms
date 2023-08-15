<?php

namespace App\Http\Controllers\Admin\Booking\UPSM;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UpsmVehicleBooking;
use App\Http\Controllers\Controller;
use App\Models\UpsmInventory;
use Illuminate\Support\Facades\Crypt;

class KenderaanBookingController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $query = UpsmVehicleBooking::query()->with('staff', 'inventory', 'status');

        $data = $this->applyPaginationFilterSearch($query, $perPage, $searchTerm);
        if ($request->ajax()) {
            return response()->json([
                'table' => view('Admin.AdminUPSM.Booking.kenderaan.bookingTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        $bookings = UpsmVehicleBooking::with('staff', 'inventory')->get();
        return view('Admin.AdminUPSM.Booking.kenderaan.viewBooking', compact('data'));
    }

    public function edit(string $encryptID)
    {
        $id = Crypt::decryptString($encryptID);
        $booking = UpsmVehicleBooking::with('staff')->findOrFail($id);
        $staffs = User::role('User')->get();
        $cars = UpsmInventory::where('subcategory_id', 17)->where('status_id', 12)->get();
        return view('Admin.AdminUPSM.Booking.kenderaan.updateBooking', compact('booking', 'staffs', 'cars'));
    }
    public function applyPaginationFilterSearch($query, $perPage, $searchTerm)
    {
        // For search filtering
        if ($searchTerm) {
            $query->where('reference', 'LIKE', "%{$searchTerm}%")
                ->where('status_id', 1);
        }

        // Apply pagination
        return $query->paginate($perPage);
    }
}
