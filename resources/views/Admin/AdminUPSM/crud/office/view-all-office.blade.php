@extends('layouts.app')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/css/style.css') }}">
@endsection
@section('layout')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row"></div>
            <div class="content-body">

                <x-upsmRoomSection />
                <hr>
                <h3>Ruang Office List</h3>

                <!-- table -->
                <div class="row mt-1" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">List of all Ruang Pejabat</h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <a class="btn add-new btn-primary" href="{{ route('upsm.Office.create') }}">
                                        <span>Add New Office Room</span>
                                    </a>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center mx-0 mb-2 row">

                                <div class="col-sm-12 col-md-4">
                                    <div class="input-group">
                                        <input type="text" id="searchOffice" placeholder="Search Ruang Office..."
                                            class="form-control">
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
                                @include('Admin.AdminUPSM.table.officeTable')

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
            </div>

            <x-uit.delete-modal :modalID="'deleteOffice'" :deleteFormId="'deleteOfficeForm'" />
        </div>
    </div>
@endsection

@section('script')
    @if (session('success'))
        <script>
            toastr.success('{{ session('success') }}', 'Success');
        </script>
    @endif

    <script src="{{ asset('js/Admin/Inventory/UPSM/Office/viewAllOffice.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UPSM/Office/deleteOffice.js') }}"></script>
@endsection
