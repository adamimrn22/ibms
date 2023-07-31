@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>
        <x-uit.uitSection />
        <x-uit.title :title="'Hardware'" />

        <x-uit.card-table :filterID="'searchPrinter'" :searchPlaceholder="'Search Printer...'" :addRoute="'uit.Printer.create'" :data="$data" :btnTitle="'Printer'">
            @include('Admin.AdminUIT.table.Hardware.printerTable')
        </x-uit.card-table>

    </x-app-content>

    <x-uit.delete-modal :modalID="'deletePrinterModal'" :deleteFormId="'deletePrinterForm'" />
@endsection

@section('script')
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success');
        </script>
    @endif
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Printer/viewAllPrinter.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Printer/deletePrinter.js') }}"></script>
@endsection
