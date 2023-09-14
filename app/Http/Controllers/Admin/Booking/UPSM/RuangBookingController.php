<?php

namespace App\Http\Controllers\Admin\Booking\UPSM;

use App\Http\Controllers\Controller;
use App\Models\UpsmRuangBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RuangBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $query = UpsmRuangBooking::query()->with('room', 'user', 'status');

        $data = $this->applyPaginationFilterSearch(1,$query, $perPage, $searchTerm);

        if ($request->ajax()) {
            return response()->json([
                'table' => view('Admin.AdminUPSM.Booking.ruang.RuangTempahTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }


     return view('Admin.AdminUPSM.Booking.ruang.viewRuangTempah', compact('data'));
    }

    public function indexHistory(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $query = UpsmRuangBooking::query()->with('room', 'user', 'status');

        $data = $this->applyPaginationFilterSearch(0,$query, $perPage, $searchTerm);

        if ($request->ajax()) {
            return response()->json([
                'table' => view('Admin.AdminUPSM.Booking.ruang.HistoryRuangTempahTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }


     return view('Admin.AdminUPSM.Booking.ruang.viewTempahHistory', compact('data'));
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
    public function edit(string $encryptID)
    {
        $id = Crypt::decryptString($encryptID);
        $booking = UpsmRuangBooking::with('user', 'room', 'detail')->findOrFail($id);

        return view('Admin.AdminUPSM.Booking.ruang.ruangTempahUpdate', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateBtn = $request->input('updateBtn');

        if($updateBtn){
            UpsmRuangBooking::where('id', $id)->update([
               'status_id' => 2
            ]);
        }else {
            UpsmRuangBooking::where('id', $id)->update([
                'status_id' => 3
            ]);
        }

        return redirect()->route('upsm.ruangTempah.indexHistory')->with(['success' => 'Booking successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function applyPaginationFilterSearch($type, $query, $perPage, $searchTerm, $status = null)
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
