<?php

namespace App\Http\Controllers\User\Reservation;

use Carbon\Carbon;
use App\Models\UkwInventory;
use Illuminate\Http\Request;
use App\Models\UpsmInventory;
use App\Models\UpsmRuangBooking;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class RuangBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = UpsmInventory::where('subcategory_id', 16)->where('status_id', 6)->get();

        return view('User.TempahanRuang.viewAllRuang', compact('rooms'));
    }

    public function viewTempahan(Request $request)
    {
        $perPage = $request->input('records', 7);
        $searchTerm = $request->input('search');
        $status = $request->input('status');
        $query = UpsmRuangBooking::query()->with('detail', 'room', 'status');
        $user = Auth::user();
        $data = $this->applyPaginationFilterSearch($query, $searchTerm, $perPage, $user->id);

        if ($request->ajax()) {
            return response()->json([
                'table' => view('User.TempahanRuang.tempahanTable', compact('data'))->render(),
                'pagination' => view('components.Pagination', compact('data'))->render(),
            ]);
        }

        return view('User.TempahanRuang.viewTempahan', compact('data'));
    }

    public function ruangTempah(Request $request)
    {
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        $bookings = UpsmRuangBooking::with('room')
            ->whereBetween('date_book', [$dateFrom, $dateTo])
            ->orderBy('date_book')
            ->get();

        $rooms = UpsmInventory::where('subcategory_id', 16)->get();

        $uniqueDates = $bookings->pluck('date_book')->unique();
        $uniqueRoomNames = $bookings->pluck('room.name')->unique();

        return view('User.TempahanRuang.viewBetweenTempahan',  compact('bookings', 'uniqueDates', 'uniqueRoomNames', 'rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $encryptID)
    {
        $id = Crypt::decryptString($encryptID);
        $room = UpsmInventory::with('images')->findOrFail($id);
        $room->attribute = json_decode($room->attribute);
        $room->image = $room->images[0]->parent_folder . '/' . $room->images[0]->path;
        $user = Auth::user();
        return view('User.TempahanRuang.tempahRuang', compact('room', 'user'));
    }

    public function getDisabledTimeRanges(Request $request) {
        $selectedDate = $request->input('date');

        $disabledTimeRanges = UpsmRuangBooking::whereDate('date_book', $selectedDate)
            ->select('time_start', 'time_end')
            ->get();

        return response()->json(['disabledTimeRanges' => $disabledTimeRanges]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $roomId)
    {
        $room = UpsmInventory::findOrFail($roomId);

        $startTime = Carbon::createFromFormat('Y-m-d H:i:s', '2023-08-05 00:42:38');
        $endTime = Carbon::createFromFormat('Y-m-d H:i:s', '2023-09-09 09:42:37');
        $user = Auth::user();

        $booking = new UpsmRuangBooking([
            'reference' => 'BK011',
            'date_book_start' => $startTime->toDateString(),
            'date_book_end' => $endTime->toDateString(),
            'time_start' => $startTime->toTimeString(),
            'time_end' => $endTime->toTimeString(),
            'room_id' => $room->id,
            'user_id' => $user->id, // Replace with the actual user ID
            'status_id' => 1, // Replace with the actual status ID
        ]);

        if (!$booking->isAvailable($startTime, $endTime)) {
            // Room is not available for the specified timeframe
            // Return an error response to the user'
            dd('unavailable');
        } else {
            // Create the booking
            // $booking->save();
            dd('available');
        }
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
    public function edit(string $id)
    {
        //
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

      public function applyPaginationFilterSearch($query, $searchTerm, $perPage, $user_id)
    {
        // For search filtering
        if ($searchTerm) {
            $query->where(function ($subQuery) use ($searchTerm) {
                $subQuery->whereHas('detail', function ($detailQuery) use ($searchTerm) {
                    $detailQuery->where('objective', 'LIKE', "%{$searchTerm}%");
                })
                ->orWhere('reference', 'LIKE', "%{$searchTerm}%");
            })->where('user_id', $user_id);
        }

        // Apply pagination
        return $query->paginate($perPage);
    }
}
