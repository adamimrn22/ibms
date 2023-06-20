@extends('layouts.app')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/forms/select/select2.min.css') }}">
@endsection
@section('layout')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <h3>Permissions List</h3>

                <!-- table -->
                <div class="row mt-1" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">List of all permission</h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <p class="card-text">
                                        Here is the list of all user permission
                                    </p>

                                    <button class="btn add-new btn-primary mt-50 add-permission-modal" tabindex="0"
                                        type="button" data-bs-toggle="modal" data-bs-target="#addPermissionModal">
                                        <span>Add New Permission</span>
                                    </button>
                                </div>
                            </div>

                            <hr>


                            <div class="d-flex justify-content-between align-items-center mx-0 mb-2 row">

                                <div class="col-sm-12 col-md-4">
                                    <div class="input-group">
                                        <input type="text" id="searchUserWithRoles" placeholder="Search permission..."
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
                                @include('SuperAdmin.permission.table.permissionTable')

                                <div class="d-flex align-items-center justify-content-center">
                                    <div id="roleSpinner" align="center" class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>

                                @include('components.Pagination');
                            </div>
                        </div>
                    </div>
                </div>
                <!-- table -->

                @include('SuperAdmin.permission.modal.permissionModal')

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/table/viewAllPermissionTable.js') }}"></script>
    <script src="{{ asset('js/modal/permissionModal.js') }}"></script>
    <script src="{{ asset('app-asset/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-asset/js/scripts/forms/form-select2.js') }}"></script>
@endsection
