@extends('layouts.userapp')

@section('csslink')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/vendors/css/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-asset/css/plugins/extensions/ext-component-sweet-alerts.css') }}">
@endsection

@section('section')
    <div class="card ">
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
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>{{ $booking->inventory->name }}</td>
                            <td align="end">{{ $booking->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
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
