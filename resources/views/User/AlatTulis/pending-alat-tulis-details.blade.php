@extends('layouts.userapp')

@section('csslink')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/vendors/css/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-asset/css/plugins/extensions/ext-component-sweet-alerts.css') }}">
@endsection

@section('section')
    <div class="card ">
        <div class="m-2 mb-0">
            <a href="{{ route('AlatTulis.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6" width="16px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
                Kembali</a>
        </div>
        <div class="m-2">
            <div>
                ID Booking : {{ $bookings[0]->reference }}
            </div>
            <div>
                Tarikh Pesanan : {{ $date }}
            </div>
            <table class="table my-1">
                <thead>
                    <th>Nama Alatan</th>
                    <th class="text-end">Bilangan</th>
                </thead>
                @foreach ($bookings as $booking)
                    @foreach ($booking->inventories as $inventory)
                        <tr>
                            <td>{{ $inventory->name }}</td>
                            <td align="end">{{ $inventory->pivot->quantity }}</td>
                        </tr>
                    @endforeach
                @endforeach
                <tfoot>
                    <tr align="end">
                        <th>Jumlah Bilangan</th>
                        <th>{{ $totalQuantity }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
