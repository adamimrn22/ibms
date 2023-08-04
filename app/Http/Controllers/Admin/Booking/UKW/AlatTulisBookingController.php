<?php

namespace App\Http\Controllers\Admin\Booking\UKW;

use App\Models\UkwInventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UkwBooking;
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
        $status = $request->input('status');
        $query = UkwBooking::query()->with('status');

        $data = $this->applyPaginationFilterSearch($query, $perPage, $searchTerm, $status);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function applyPaginationFilterSearch($query, $perPage, $searchTerm, $status)
    {
        // For search filtering
        if ($searchTerm) {
            $query->where(function ($query) use ($searchTerm) {
                $query->whereHas('user', function ($userQuery) use ($searchTerm) {
                    $userQuery->where('name', 'LIKE', "%{$searchTerm}%");
                })
                ->orWhere('reference', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Filter by status
        if ($status === 'pending') {
            $query->where('status_id', '=', 1);
        }

        // Subquery to get latest entries for each reference
        $subQuery = UkwBooking::selectRaw('MAX(id) as id')
            ->groupBy('reference');

        // Apply groupBy
        $query->whereIn('id', $subQuery);

        // Apply pagination
        return $query->paginate($perPage);
    }
}
