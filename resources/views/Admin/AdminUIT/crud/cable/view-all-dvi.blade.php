@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>
        <x-uit.uitSection />
        <x-uit.title :title="'Cable'" />

        <x-uit.card-cable-table :filterID="'searchDvi'" :searchPlaceholder="'Search Dvi...'" :addRoute="'uit.Hdmi.create'" :data="$data" :btnTitle="'HDMI'">
            @include('Admin.AdminUIT.table.cable.dviTable')
        </x-uit.card-cable-table>

    </x-app-content>

    <x-uit.delete-modal :modalID="'deleteDviModal'" :deleteFormId="'deleteDviForm'" />
@endsection

@section('script')
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success');
        </script>
    @endif
    <script src="{{ asset('js/Admin/Inventory/UIT/Cable/view/viewAllDvi.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UIT/Cable/delete/deleteDvi.js') }}"></script>
@endsection
