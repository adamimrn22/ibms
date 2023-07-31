@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>
        <x-uit.uitSection />
        <x-uit.title :title="'Cable'" />

        <x-uit.card-cable-table :filterID="'searchLan'" :searchPlaceholder="'Search Lan Cable...'" :data="$data">
            @include('Admin.AdminUIT.table.cable.ethernetTable')
        </x-uit.card-cable-table>

    </x-app-content>

    <x-uit.delete-modal :modalID="'deleteLanModal'" :deleteFormId="'deleteLanForm'" />
@endsection

@section('script')
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success');
        </script>
    @endif
    <script src="{{ asset('js/Admin/Inventory/UIT/Cable/view/viewAllLan.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UIT/Cable/delete/deleteLan.js') }}"></script>
@endsection
