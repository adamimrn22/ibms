@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>
        <x-ukw.inventory-stock-low />
        <x-ukw.export-inventory />
        <!-- table -->
        <x-ukw.card-table :id="'searchPaper'" :placeholder="'Search Paper'" :data='$data'>
            @include('Admin.AdminUKW.table.a4paperTable')
        </x-ukw.card-table>
        <!-- table -->
    </x-app-content>

    <x-ukw.quantity-modal />
    <x-uit.delete-modal :modalID="'deletePaper'" :deleteFormId="'deletePaperForm'" />
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

    <script src="{{ asset('js/Admin/Inventory/UKW/A4/viewAllA4.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UKW/A4/deleteA4.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UKW/exportAlatTulisStock.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UKW/updateQuantityStock.js') }}"></script>
@endsection
