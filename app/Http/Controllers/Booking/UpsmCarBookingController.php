<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpsmCarBookingController extends Controller
{
    public function index()
    {
        return view('User.UpsmBooking.tempahanKereta.createPermohonanKereta');
    }
}
