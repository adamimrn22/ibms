@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>
        <x-uit.uitSection />
        <x-uit.title :title="'Hardware'" />

        <x-uit.card-table :filterID="'searchProjector'" :searchPlaceholder="'Search Projector...'" :addRoute="'uit.Projector.create'" :data="$data" :btnTitle="'Projector'">
            @include('Admin.AdminUIT.table.Hardware.projectorTable')
        </x-uit.card-table>

    </x-app-content>

    <x-uit.delete-modal :modalID="'deleteProjectorModal'" :deleteFormId="'deleteProjectorForm'" />
@endsection

@section('script')
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success');
        </script>
    @endif
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Projector/viewAllProjector.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Projector/deleteProjector.js') }}"></script>
@endsection
