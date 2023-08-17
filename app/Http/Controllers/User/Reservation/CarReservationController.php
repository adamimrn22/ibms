<?php

namespace App\Http\Controllers\User\Reservation;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UpsmVehicleBooking;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Mail\TempahanKereta\NewPesananKereta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TempahanKereta\PesananBerjaya;
use App\Mail\TempahanKereta\PesananKeretaBerjaya;

class CarReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $staffs = User::role('User')->with('unit', 'position')->where('isActive', 1)
                        ->where('id', '!=', $user->id)->get();
        return view('User.TempahanKereta.permohonanKereta', compact('user', 'staffs'));
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
        $validatedData = $request->validate([
            'dateGo' => 'required|date',
            'dateReturn' => 'required|date',
            'timeGo' => 'required',
            'timeReturn' => 'required',
            'destination' => 'required|string',
            'objective' => 'required|string',
            'vehicle' => 'filled',
            'driver' => '',
            'name' => 'required|array', // Staff IDs
        ]);

        $user = Auth::user();

        $lastBooking = UpsmVehicleBooking::latest()->where('reference', 'LIKE', 'UPSMVHBK%')->first();
        $lastReferenceNumber = $lastBooking ? intval(substr($lastBooking->reference, 8)) : 0; // Changed index from 6 to 8
        $newReferenceNumber = $lastReferenceNumber + 1;
        $reference = 'UPSMVHBK' . str_pad($newReferenceNumber, 4, '0', STR_PAD_LEFT);

        $booking = UpsmVehicleBooking::create([
            'reference' => $reference,
            'dateGo' => $validatedData['dateGo'],
            'dateReturn' => $validatedData['dateReturn'],
            'timeGo' => $validatedData['timeGo'],
            'timeReturn' => $validatedData['timeReturn'],
            'destination' => $validatedData['destination'],
            'objective' => $validatedData['objective'],
            'vehicle_type' => $validatedData['vehicle'],
            'driver' => $validatedData['driver'],
            'status_id' => 1,
        ]);

        $staffIds = array_map('intval', $validatedData['name']);
        $booking->staff()->attach($staffIds, [
            'booking_id' => $booking->id,
            'created_at' => now()
        ]);

        $role = Role::findByName('ADMIN UPSM');
        $userWithRole = $role->users()->first();

        if ($userWithRole) {
            $adminEmail = $userWithRole->email;
            Mail::to($user->email)->queue(new PesananKeretaBerjaya($booking));
            Mail::to($adminEmail)->queue(new NewPesananKereta($booking, $user));
        }

        return redirect()->route('user.homepage')->with('success', 'Tempahan Kenderaan telah berjaya');

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
}
