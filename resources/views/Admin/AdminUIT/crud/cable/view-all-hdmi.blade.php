@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>
        <x-uit.uitSection />
        <x-uit.title :title="'Cable'" />

        <x-uit.card-cable-table :filterID="'searchHdmi'" :searchPlaceholder="'Search HDMI...'" :addRoute="'uit.Hdmi.create'" :data="$data">
            @include('Admin.AdminUIT.table.cable.hdmiTable')
        </x-uit.card-cable-table>

    </x-app-content>

    <x-uit.delete-modal :modalID="'deleteHdmiModal'" :deleteFormId="'deleteHdmiForm'" />
@endsection

@section('script')
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success');
        </script>
    @endif
    <script src="{{ asset('js/Admin/Inventory/UIT/Cable/view/viewAllHdmi.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UIT/Cable/delete/deleteHdmi.js') }}"></script>
@endsection
