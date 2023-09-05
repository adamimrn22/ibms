<?php

namespace App\Exports;

use App\Models\UkwInventory;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AlatTulisStock implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function headings(): array
    {
        return [
            'Nama Alat Tulis',
            'Bilangan Semasa',
        ];
    }

    public function query()
    {
        return UkwInventory::query()
            ->with(['status', 'subcategory'])
            ->select('name', 'current_quantity', 'status_id');
    }

    public function map($UkwInventory): array
    {

        return [
            $UkwInventory->name,
            $UkwInventory->current_quantity,
        ];
    }
}
