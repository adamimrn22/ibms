@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>
        <x-uit.uitSection />
        <x-uit.title :title="'Hardware'" />

        <x-uit.card-table :filterID="'searchKeyboard'" :searchPlaceholder="'Search Keyboard...'" :addRoute="'uit.Keyboard.create'" :data="$data" :btnTitle="'Keyboard'">
            @include('Admin.AdminUIT.table.Hardware.keyboardTable')
        </x-uit.card-table>

    </x-app-content>

    <x-uit.delete-modal :modalID="'deleteKeyboardModal'" :deleteFormId="'deleteKeyboardForm'" />
@endsection

@section('script')
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success');
        </script>
    @endif
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Keyboard/viewAllKeyboard.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Keyboard/deleteKeyboard.js') }}"></script>
@endsection
