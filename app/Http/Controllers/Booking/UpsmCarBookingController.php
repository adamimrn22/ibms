<?php

namespace App\Http\Controllers\Booking;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UpsmCarBookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $staffs = User::role('User')->with('unit', 'position')->where('isActive', 1)
                        ->where('id', '!=', $user->id)->get();
        return view('User.UpsmBooking.tempahanKereta.createPermohonanKereta', compact('staffs', 'user'));
    }
}
