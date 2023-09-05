@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>
        <x-uit.uitSection />
        <x-uit.title :title="'Hardware'" />
        {{--
        <x-uit.card-table :filterID="'searchExtensionCord'" :searchPlaceholder="'Search Extension Cord...'" :addRoute="'uit.Extension-cord.create'" :data="$data" :btnTitle="'Extension Cord'">
           @include('Admin.AdminUIT.table.Hardware.extensionCordTable')11
        </x-uit.card-table> --}}

    </x-app-content>

    <x-uit.delete-modal :modalID="'deleteExtensionCordModal'" :deleteFormId="'deleteExtensionCordForm'" />
@endsection

@section('script')
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success');
        </script>
    @endif
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/ExtensionCord/viewAllExtensionCord.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/ExtensionCord/deleteExtensionCord.js') }}"></script>
@endsection
