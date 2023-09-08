<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use App\Models\UkwInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\UpsmInventory;
use App\Models\UpsmRuangBooking;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $roles = $user->getRoleNames();

        if($roles[0] === 'Admin UKW'){
            return $this->UkwViews();
        }else if ($roles[0] === 'Admin UPSM'){
            return $this->UpsmViews();
        }else if ($roles[0] === 'Admin UIT'){
            return $this->uitViews();
        }
        abort(404);
    }

    private function UpsmViews()
    {
        $currentMonth = now()->format('Y-m');
        $roomCounts = DB::table('upsm_ruang_bookings')
            ->select('upsm_inventories.name as room_name', DB::raw('COUNT(*) as count'))
            ->join('upsm_inventories', 'upsm_ruang_bookings.room_id', '=', 'upsm_inventories.id')
            ->whereRaw('DATE_FORMAT(upsm_ruang_bookings.date_book_start, "%Y-%m") = ?', [$currentMonth])
            ->whereRaw('upsm_ruang_bookings.status_id = ?', [2])
            ->groupBy('room_name')
            ->get() ;

        $labels = $roomCounts->pluck('room_name')->toArray();
        $data = $roomCounts->pluck('count')->toArray();

        $ruangPejabatCount = UpsmInventory::ofRoom(15)->count();
        $ruangKelasCount = UpsmInventory::ofRoom(16)->count();

        return view('Admin.AdminUPSM.upsm-dashboard', compact([
            'ruangKelasCount', 'ruangPejabatCount', 'labels', 'data'
        ]));
    }

    private function UkwViews()
    {
        $stock = UkwInventory::select('name', 'current_quantity')->get();
        $totalQuantity = $stock->sum('current_quantity');
        $labels = $stock->pluck('name')->toArray();
        $data = $stock->pluck('current_quantity')->toArray();

        $lowerStock = UkwInventory::where('current_quantity', '<=', 5)->select('name', 'current_quantity')->get();

        $currentMonth = now()->format('Y-m');

        $bookingCounts = DB::table('ukw_bookings')
        ->join('users', 'ukw_bookings.user_id', '=', 'users.id')
        ->where('ukw_bookings.status_id', '=', 2) // Adjust the status filter as needed
        ->whereRaw('DATE_FORMAT(ukw_bookings.updated_at, "%Y-%m") = ?', [$currentMonth])
        ->groupBy('users.unit_id')
        ->select('users.unit_id', DB::raw('COUNT(*) as booking_count'))
        ->get();

        if(count($bookingCounts) > 0){
            $chartData = [];
            foreach ($bookingCounts as $booking) {
                $unit = Unit::find($booking->unit_id);
                $chartData[] = [
                    'label' => $unit->name,
                    'value' => $booking->booking_count,
                ];
            }
        }else {
            $chartData = [];
            $units = Unit::all();
            foreach ($units as $unit) {
                $chartData[] = [
                    'label' => $unit->name,
                    'value' => 0
                ];
            }
        }

        return view('Admin.AdminUKW.ukw-dashboard', compact('labels', 'data', 'totalQuantity', 'lowerStock', 'chartData'));
    }

    private function uitViews()
    {
        return view('Admin.AdminUIT.uit-dashboard');
    }
}
