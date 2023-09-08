@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>

        <x-uit.uitSection />
        <x-uit.card-other-table :searchPlaceholder="'Search Software...'" :addRoute="'uit.Software.create'" :data="$data" :btnTitle="'Add New Software'" :id="'searchSoftware'"
            :placeholder="'Search Software'">
            @include('Admin.AdminUIT.table.others.softwareTable')
        </x-uit.card-other-table>

    </x-app-content>

    <x-uit.delete-modal :modalID="'deleteSoftwareModal'" :deleteFormId="'deleteSoftwareForm'" />
@endsection

@section('script')
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success');
        </script>
    @endif
    <script src="{{ asset('js/Admin/Inventory/UIT/Others/viewAllSoftware.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UIT/Others/deleteSoftware.js') }}"></script>
@endsection
