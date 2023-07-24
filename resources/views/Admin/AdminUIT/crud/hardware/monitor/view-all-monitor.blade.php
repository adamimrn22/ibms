@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>
        <x-uit.uitSection />
        <x-uit.title :title="'Hardware'" />

        <x-uit.card-table :filterID="'searchMonitor'" :searchPlaceholder="'Search Monitor...'" :addRoute="'uit.Monitor.create'" :data="$data" :btnTitle="'Monitor'">
            @include('Admin.AdminUIT.table.Hardware.monitorTable')
        </x-uit.card-table>

    </x-app-content>

    <x-uit.delete-modal :modalID="'deleteMonitorModal'" :deleteFormId="'deleteMonitorForm'" />
@endsection

@section('script')
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success');
        </script>
    @endif
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Monitor/viewAllMonitor.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Monitor/deleteMonitor.js') }}"></script>
@endsection
