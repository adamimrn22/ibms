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
        $users = $this->userData('User');

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

        $validatedData = $request->validate([
            'user.*' => 'required|exists:users,id',
            'amount.*' => 'nullable|numeric',
            'default_amount.*' => 'nullable|numeric',
        ]);

        foreach ($validatedData['user'] as $userId => $userValue) {
            $amount = $validatedData['amount'][$userId] ?? 0;
            $default_amount = $validatedData['default_amount'][$userId] ?? 0;

            UserPaperBookingAmount::updateOrCreate(
                [
                    'user_id' => $userId,
                    'month' => now()->month,
                    'year' => now()->year,
                ],
                [
                    'amount' => $amount,
                    'default_amount' => $default_amount,
                ]
            );

        }
        $users = $this->userData('User');
        return view('Admin.AdminUKW.Booking.UserA4Amount.amount-table-body', compact('users'))->render();
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
    public function update(Request $request)
    {
        try {

            $updateBtn = $request->input('resetStaffButton');

            if ($updateBtn == 1) {
                $users = User::role('user')->with('paperAmount')->where('unit_id', '!=', 8)->get();
                foreach ($users as $user) {
                    $default_amount = $user->paperAmount->default_amount;

                    UserPaperBookingAmount::updateOrCreate(
                        [
                            'user_id' => $user->id,
                            'month' => now()->month,
                            'year' => now()->year,
                        ],
                        [
                            'amount' => $default_amount,
                        ]
                    );
                }

                $users = $this->userData('User');
                return response()->json([
                    'tbody' =>  view('Admin.AdminUKW.Booking.UserA4Amount.amount-table-body', compact('users'))->render(),
                    'success' => 'A4 Amount for Staff This Month Has Been Reseted'
                ]);


            }else if ($updateBtn == 0) {
                $users = User::role('user')->with('paperAmount')->where('unit_id', '=', 8)->get();
                foreach ($users as $user) {
                    $default_amount = $user->paperAmount->default_amount;
                    UserPaperBookingAmount::updateOrCreate(
                        [
                            'user_id' => $user->id,
                            'month' => now()->month,
                            'year' => now()->year,
                        ],
                        [
                            'amount' => $default_amount,
                        ]
                    );
                }

                $users = $this->userData('User');
                return response()->json([
                    'tbody' =>  view('Admin.AdminUKW.Booking.UserA4Amount.amount-table-body', compact('users'))->render(),
                    'success' => 'A4 Amount for Pensyarah Has Been Reseted '
                ]);

            }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'An error occurred'], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function userData($roleName)
    {
        $user = User::leftJoin('user_paper_booking_amounts', function ($join) {
            $join->on('users.id', '=', 'user_paper_booking_amounts.user_id')
                ->where('month', now()->month)
                ->where('year', now()->year);
        })
        ->with('roles')
        ->where('isActive', 1)
        ->whereHas('roles', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        })
        ->select('users.*', 'user_paper_booking_amounts.amount', 'user_paper_booking_amounts.default_amount')
        ->get();

        return $user;
    }
}
