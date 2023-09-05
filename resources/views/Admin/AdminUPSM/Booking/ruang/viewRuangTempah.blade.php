@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>
        <!-- table -->

        <div class="row mt-1" id="basic-table">
            <div class="col-12">

                <div class="card">

                    <div class="card-header">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('upsm.ruangTempah.index') ? 'active' : '' }}"
                                    href="{{ route('upsm.ruangTempah.index') }}">Pending</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Str::contains(request()->path(), 'TempahHistory') ? 'active' : '' }}"
                                    href="{{ route('upsm.ruangTempah.indexHistory') }}">History</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-header">
                        <h4 class="card-title">Pending Ruang Tempah </h4>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mx-0 mb-2 row">

                        <div class="col-sm-12 col-md-4">
                            <div class="input-group">
                                <input type="text" id="searchBooking" placeholder="Search Booking" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="d-flex justify-content-end">
                                <label class="d-inline-flex  align-items-center">
                                    Show
                                    <select id="recordFilter" class="form-select mx-1 px-2">
                                        <option value="7" selected>7</option>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="75">75</option>
                                        <option value="100">100</option>
                                    </select> entries
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="table-responsive">
                        @include('Admin.AdminUPSM.Booking.ruang.RuangTempahTable')

                        <div class="d-flex align-items-center justify-content-center">
                            <div id="roleSpinner" align="center" class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        @include('components.Pagination')
                    </div>
                </div>
            </div>
        </div>

        <!-- table -->
    </x-app-content>
@endsection

@section('script')
    <script src="{{ asset('js/Admin/Booking/UPSM/tempahanRuang/viewTempahan.js') }}"></script>
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
