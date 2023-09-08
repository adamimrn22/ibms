<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\UserPaperBookingAmount;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserA4AmountExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $year;
    protected $month;

    public function __construct(int $month, int $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function headings(): array
    {
        $monthName = Carbon::createFromDate(null, $this->month, 1)->format('F');

        return [
            ['Junlah Bilangan A4 Pada Bulan ' . $monthName . ' ' . $this->year],
            ['Nama Staff', 'Nombor Staff', 'Jawatan Staff', 'Unit Staff', 'Jumlah Sekarang', 'Jumlah Tetap']
        ];
    }

    public function query()
    {
        return User::leftJoin('user_paper_booking_amounts', function ($join) {
            $join->on('users.id', '=', 'user_paper_booking_amounts.user_id')
                ->where('month', now()->month)
                ->where('year', now()->year);
        })
        ->leftJoin('units', 'users.unit_id', '=', 'units.id')
        ->leftJoin('positions', 'users.position_id', '=', 'positions.id')
        ->with('roles')
        ->whereHas('roles', function ($query) {
            $query->where('name', 'User'); // Replace 'User' with the actual role name
        })
        ->select(
            'users.*',
            'user_paper_booking_amounts.amount',
            'user_paper_booking_amounts.default_amount',
            'units.name as unit_name',
            'positions.name as position_name'
        );
    }

    public function map($userPaperBookingAmount): array
    {

        return [
            $userPaperBookingAmount->first_name . ' ' . $userPaperBookingAmount->last_name,
            $userPaperBookingAmount->username,
            $userPaperBookingAmount->position->name,
            $userPaperBookingAmount->unit->name,
            $userPaperBookingAmount->amount,
            $userPaperBookingAmount->default_amount,
        ];
    }
}
