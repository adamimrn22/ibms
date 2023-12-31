@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>

        <!-- table -->
        <x-ukw.card-table :id="'searchFile'" :placeholder="'Search File'" :data='$data'>
            @include('Admin.AdminUKW.table.fileTable')
        </x-ukw.card-table>
        <!-- table -->
    </x-app-content>

    <x-uit.delete-modal :modalID="'deleteFile'" :deleteFormId="'deleteFileForm'" />
@endsection

@section('script')
    @if (Session::has('error'))
        <script>
            toastr.danger("{{ session('error') }}", 'Error');
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            toastr.success("{{ session('success') }}", 'Success');
        </script>
    @endif

    <script src="{{ asset('js/Admin/Inventory/UKW/File/viewAllFile.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UKW/File/deleteFile.js') }}"></script>
@endsection
