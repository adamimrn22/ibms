@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>
        <x-ukw.inventory-stock-low />
        <x-ukw.export-inventory />
        <!-- table -->
        <x-ukw.card-table :id="'searchFile'" :placeholder="'Search File'" :data='$data'>
            @include('Admin.AdminUKW.table.fileTable')
        </x-ukw.card-table>
        <!-- table -->
    </x-app-content>

    <x-ukw.quantity-modal />
    <x-uit.delete-modal :modalID="'deleteFile'" :deleteFormId="'deleteFileForm'" />
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

    <script src="{{ asset('js/Admin/Inventory/UKW/File/viewAllFile.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UKW/File/deleteFile.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UKW/exportAlatTulisStock.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UKW/updateQuantityStock.js') }}"></script>
@endsection
