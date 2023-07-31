@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>
        <x-uit.uitSection />
        <x-uit.title :title="'Cable'" />

        <x-uit.card-cable-table :filterID="'searchVga'" :searchPlaceholder="'Search Vga Cable...'" :addRoute="'uit.Hdmi.create'" :data="$data" :btnTitle="'HDMI'">
            @include('Admin.AdminUIT.table.cable.vgaTable')
        </x-uit.card-cable-table>

    </x-app-content>

    <x-uit.delete-modal :modalID="'deleteVgaModal'" :deleteFormId="'deleteVgaForm'" />
@endsection

@section('script')
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success');
        </script>
    @endif
    <script src="{{ asset('js/Admin/Inventory/UIT/Cable/view/viewAllVga.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UIT/Cable/delete/deleteVga.js') }}"></script>
@endsection
