@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>
        <x-uit.uitSection />
        <x-uit.title :title="'Hardware'" />

        <x-uit.card-table :filterID="'searchMouse'" :searchPlaceholder="'Search Mouse...'" :addRoute="'uit.Mouse.create'" :data="$data" :btnTitle="'Mouse'">
            @include('Admin.AdminUIT.table.Hardware.mouseTable')
        </x-uit.card-table>

    </x-app-content>

    <x-uit.delete-modal :modalID="'deleteMouseModal'" :deleteFormId="'deleteMouseForm'" />
@endsection

@section('script')
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success');
        </script>
    @endif
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Mouse/viewAllMouse.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Mouse/deleteMouse.js') }}"></script>
@endsection
