@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>


        <!-- table -->
        <x-upsm.card-booking-table :id="'searchBooking'" :placeholder="'Search Booking'" :data='$data' :title="'Pending Tempahan Kenderaan'">
            @include('Admin.AdminUPSM.Booking.kenderaan.bookingTable')
        </x-upsm.card-booking-table>
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
            toastr.success("{{ session('success') }}", 'Success');
        </script>
    @endif
@endsection
