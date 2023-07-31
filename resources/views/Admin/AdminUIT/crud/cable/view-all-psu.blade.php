@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>
        <x-uit.uitSection />
        <x-uit.title :title="'Cable'" />

        <x-uit.card-cable-table :filterID="'searchPSU'" :searchPlaceholder="'Search Psu Cable...'" :addRoute="'uit.Hdmi.create'" :data="$data" :btnTitle="'HDMI'">
            @include('Admin.AdminUIT.table.cable.psuTable')
        </x-uit.card-cable-table>

    </x-app-content>

    <x-uit.delete-modal :modalID="'deletePsuModal'" :deleteFormId="'deletePsuForm'" />
@endsection

@section('script')
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success');
        </script>
    @endif
    <script src="{{ asset('js/Admin/Inventory/UIT/Cable/view/viewAllPsu.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UIT/Cable/delete/deletePsu.js') }}"></script>
@endsection
