@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>

        <!-- table -->
        <x-ukw.card-booking-table :id="'searchBooking'" :placeholder="'Search Booking'" :data='$data'>
            @include('Admin.AdminUKW.Booking.AlatTulis.viewHistoryBookingTable')
        </x-ukw.card-booking-table>
        <!-- table -->
    </x-app-content>
@endsection

@section('script')
    @if (Session::has('error'))
        <script>
            toastr.danger("{{ session('error') }}", 'Error');
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            toastr.success("{{ session('success') }}", 'Berjaya');
        </script>
    @endif
@endsection
