@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>

        <x-uit.uitSection />
        <x-uit.card-other-table :searchPlaceholder="'Search Miscellaneous...'" :addRoute="'uit.Miscellaneous.create'" :data="$data" :btnTitle="'Add New Miscellaneous'" :id="'searchMisc'"
            :placeholder="'Search Miscellaneous'">
            @include('Admin.AdminUIT.table.others.miscellaneousTable')
        </x-uit.card-other-table>

    </x-app-content>

    <x-uit.delete-modal :modalID="'deleteMiscModal'" :deleteFormId="'deleteMiscForm'" />
@endsection

@section('script')
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success');
        </script>
    @endif
    <script src="{{ asset('js/Admin/Inventory/UIT/Others/viewMisc.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UIT/Others/deleteMisc.js') }}"></script>
@endsection
