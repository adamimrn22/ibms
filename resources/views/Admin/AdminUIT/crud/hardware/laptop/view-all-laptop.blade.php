@extends('layouts.app')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/css/style.css') }}">
@endsection
@section('layout')
    <x-app-content>
        <x-uit.uitSection />
        <x-uit.title :title="'Hardware'" />

        <x-uit.card-table :filterID="'searchLaptop'" :searchPlaceholder="'Search Laptop...'" :addRoute="'uit.Laptop.create'" :data="$data" :btnTitle="'Laptop'">
            @include('Admin.AdminUIT.table.Hardware.laptopTable')
        </x-uit.card-table>

    </x-app-content>

    <x-uit.delete-modal :modalID="'deleteLaptopModal'" :deleteFormId="'deleteLaptopForm'" />
@endsection

@section('script')
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success');
        </script>
    @endif
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Laptop/viewAllLaptop.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Laptop/deleteLaptop.js') }}"></script>
@endsection
