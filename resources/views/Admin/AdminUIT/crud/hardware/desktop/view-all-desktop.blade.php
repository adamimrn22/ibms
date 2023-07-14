@extends('layouts.app')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/css/style.css') }}">
@endsection
@section('layout')
    <x-app-content>
        <x-uit.uitSection />
        <x-uit.title :title="'Hardware'" />

        <x-uit.card-table :filterID="'searchDesktop'" :searchPlaceholder="'Search Desktop'" :addRoute="'uit.Desktop.create'" :data="$data" :btnTitle="'Desktop'">
            @include('Admin.AdminUIT.table.Hardware.desktopTable')
        </x-uit.card-table>

    </x-app-content>

    <x-uit.delete-modal :modalID="'deleteDesktopModal'" :deleteFormId="'deleteDesktopForm'" />
@endsection

@section('script')
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success');
        </script>
    @endif

    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Desktop/viewAllDesktop.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Desktop/deleteDesktop.js') }}"></script>
@endsection
