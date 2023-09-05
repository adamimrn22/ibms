<?php

namespace App\Http\Controllers\Admin\Booking\UKW;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserPaperBookingAmount;

class A4AmountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roleName = 'User';

        $users = User::leftJoin('user_paper_booking_amounts', function ($join) {
            $join->on('users.id', '=', 'user_paper_booking_amounts.user_id')
                ->where('month', now()->month)
                ->where('year', now()->year);
        })
        ->with('roles')
        ->whereHas('roles', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        })
        ->select('users.*', 'user_paper_booking_amounts.amount', 'user_paper_booking_amounts.default_amount')
        ->get();


        // Retrieve distinct years and months
        $distinctYears = UserPaperBookingAmount::distinct()->pluck('year');
        $distinctMonths = UserPaperBookingAmount::distinct()->pluck('month');

        return view('Admin.AdminUKW.Booking.UserA4Amount.viewAmount', compact('users', 'distinctYears', 'distinctMonths'));
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
        $updateBtn = $request->input('update');
        $users =  User::role('user')->get();

        foreach ($users as $index => $user) {
            $amount = $request->input('amount')[$index];
            $default_amount = $request->input('default_amount')[$index];

            if ($updateBtn == 1) {
                // Update all records except where unit is 6
                if ($user->unit_id != 8) {
                    UserPaperBookingAmount::updateOrCreate(
                        [
                            'user_id' => $user->id,
                            'month' => now()->month,
                            'year' => now()->year,
                        ],
                        [
                            'amount' => $amount,
                            'default_amount' => $default_amount,
                        ]
                    );
                }
            } else if ($updateBtn == 0) {
                // Update only if unit is 6
                if ($user->unit_id == 8) {
                    UserPaperBookingAmount::updateOrCreate(
                        [
                            'user_id' => $user->id,
                            'month' => now()->month,
                            'year' => now()->year,
                        ],
                        [
                            'amount' => $amount,
                            'default_amount' => $default_amount,
                        ]
                    );
                }
            }
        }

        return redirect()->route('ukw.Amount.index')->with(['success' => 'Success']);
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
