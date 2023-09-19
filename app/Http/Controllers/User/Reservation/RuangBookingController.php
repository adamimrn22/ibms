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
        $user = Auth::user();
        $query = UpsmRuangBooking::query()->with('detail', 'room', 'status')->where('user_id', $user->id);
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
        $roomRaw = $request->input('room_type');
        $roomInput = explode("|", $roomRaw);
        $roomSelectedID = $roomInput[0];
        $roomName = $roomInput[1];

        $bookData = UpsmRuangBooking::with('detail', 'room')->where('room_id', $roomSelectedID)->get();
        $rooms = UpsmInventory::where('subcategory_id', '=', 16)->where('status_id', '=', 6)->get();

        return view('testbiew', compact('bookData', 'rooms', 'roomName', 'roomSelectedID'));
        // $dateFrom = $request->input('date_from');
        // $dateTo = $request->input('date_to');

        // $rooms = UpsmInventory::ofRoom(16)->get();
        // $roomType = $request->input('room_type');

        // $bookings = UpsmRuangBooking::with('room')
        // ->where(function ($query) use ($dateFrom, $dateTo) {
        //     // Condition 1: Booking starts within the given range
        //     $query->whereBetween('date_book_start', [$dateFrom, $dateTo]);
        //     // Condition 2: Booking ends within the given range
        //     $query->orWhereBetween('date_book_end', [$dateFrom, $dateTo]);

        // })
        // ->when($roomType, function ($query) use ($roomType) {
        //     $query->whereHas('room', function ($subquery) use ($roomType) {
        //         $subquery->where('room_id', $roomType);
        //     });
        // })
        // ->paginate(10);

        // return view('User.TempahanRuang.viewBetweenTempahan',  compact('bookings', 'rooms', 'dateFrom', 'dateTo'));
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
        $laptopChecked = $request->has('laptop'); // true if checked, false if unchecked
        $lcdChecked = $request->has('lcd');
        $tempahanMakananChecked = $request->has('tempahanMakanan');

        $date_start = Carbon::parse($request->input('date_start'))->format('Y/m/d');
        $date_end =  Carbon::parse($request->input('date_end'))->format('Y/m/d');
        $time_start =  Carbon::parse($request->input('time_start'))->format('H:i:s');
        $time_end = Carbon::parse($request->input('time_end'))->format('H:i:s');

        $objective = $request->input('objective');
        $eatTime = $request->input('eatTime');

        $user = Auth::user();

        $lastBooking = UpsmRuangBooking::latest()->where('reference', 'LIKE', 'UPSMRTBK%')->first();
        $lastReferenceNumber = $lastBooking ? intval(substr($lastBooking->reference, 8)) : 0; // Changed index from 6 to 8
        $newReferenceNumber = $lastReferenceNumber + 1;
        $reference = 'UPSMRTBK' . str_pad($newReferenceNumber, 4, '0', STR_PAD_LEFT);

        $detail = [
            'objective' => $objective,
            'laptop' => $laptopChecked,
            'lcd' => $lcdChecked,
            'food' => $tempahanMakananChecked,
            'food_time' => $eatTime
        ];

        $booking = UpsmRuangBooking::create([
            'reference' => $reference,
            'date_book_start' => $date_start,
            'date_book_end' => $date_end,
            'time_start' => $time_start,
            'time_end' => $time_end,
            'room_id' => $roomId,
            'user_id' => $user->id,
            'status_id' => 1,
        ]);

        $booking->detail()->create($detail);

        return redirect()->route('TempahRuang.index')->with([
            'success' => 'Booking Created'
        ]);
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
            $query->where('user_id', $user_id)
            ->where(function ($subQuery) use ($searchTerm) {
                $subQuery->whereHas('detail', function ($detailQuery) use ($searchTerm) {
                    $detailQuery->where('objective', 'LIKE', "%{$searchTerm}%");
                })
                ->orWhere('reference', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Apply pagination
        return $query->paginate($perPage);
    }
}
