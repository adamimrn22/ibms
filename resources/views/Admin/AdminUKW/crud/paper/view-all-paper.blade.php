@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>
        <x-ukw.inventory-stock-low />
        <x-ukw.export-inventory />
        <x-ukw.card-table :id="'searchPaper'" :placeholder="'Search Paper'" :data='$data'>
            @include('Admin.AdminUKW.table.paperTable')
        </x-ukw.card-table>
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

    <script src="{{ asset('js/Admin/Inventory/UKW/Paper/viewAllPaper.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UKW/Paper/deletePaper.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UKW/exportAlatTulisStock.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UKW/updateQuantityStock.js') }}"></script>
@endsection
