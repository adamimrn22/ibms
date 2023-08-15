@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>

        <div class="row mt-1" id="basic-table">
            <div class="col-12">

                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">User A4 Amount</h4>
                    </div>


                    <div class="table-responsive">
                        @include('Admin.AdminUKW.Booking.UserA4Amount.amountTable')
                    </div>
                </div>
            </div>
        </div>

    </x-app-content>
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
@endsection
