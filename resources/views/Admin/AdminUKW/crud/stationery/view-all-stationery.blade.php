@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>
        <x-ukw.inventory-stock-low />
        <x-ukw.export-inventory />
        <x-ukw.card-table :id="'searchStationery'" :placeholder="'Search Stationery'" :data='$data'>
            @include('Admin.AdminUKW.table.stationeryTable')
        </x-ukw.card-table>
    </x-app-content>

    <x-ukw.quantity-modal />
    <x-uit.delete-modal :modalID="'deleteStationery'" :deleteFormId="'deleteStationeryForm'" />
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

    <script src="{{ asset('js/Admin/Inventory/UKW/Stationery/viewAllStationery.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UKW/Stationery/deleteStationery.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UKW/exportAlatTulisStock.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UKW/updateQuantityStock.js') }}"></script>
@endsection
