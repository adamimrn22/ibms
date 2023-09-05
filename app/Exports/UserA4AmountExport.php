<?php

namespace App\Exports;

use App\Models\UserPaperBookingAmount;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

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
        return [
            'Nama Staff',
            'Nombor Staff',
            'Jawatan Staff', // Replace with the actual column name
            'Unit Staff', // Replace with the actual column name
            'Jumlah Sekarang',
            'Jumlah Tetap',
        ];
    }

    public function query()
    {
        return UserPaperBookingAmount::query()
        ->with(['user','user.position', 'user.unit'])
            ->select('user_id', 'amount', 'default_amount')
            ->where('month', $this->month)
            ->where('year', $this->year);

    }

    public function map($userPaperBookingAmount): array
    {

        return [
            $userPaperBookingAmount->user->first_name . ' ' . $userPaperBookingAmount->user->last_name,
            $userPaperBookingAmount->user->username,
            $userPaperBookingAmount->user->position->name,
            $userPaperBookingAmount->user->unit->name,
            $userPaperBookingAmount->amount,
            $userPaperBookingAmount->default_amount,
        ];
    }
}
