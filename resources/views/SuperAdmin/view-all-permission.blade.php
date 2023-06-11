@extends('layouts.app')

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

                                    <button class="btn add-new btn-primary mt-50" tabindex="0" type="button"
                                        data-bs-toggle="modal" data-bs-target="#addPermissionModal"><span>Add New
                                            Permission</span></button>
                                </div>
                            </div>

                            <hr>


                            <div class="d-flex justify-content-between align-items-center mx-0 mb-2 row">

                                <div class="col-sm-12 col-md-4">
                                    <div class="input-group">
                                        <button type="button" class="btn btn-outline-primary dropdown-toggle waves-effect"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Filter
                                        </button>
                                        <div class="dropdown-menu" style="">
                                            <select id="roleFilter" class="form-select mx-1 px-2">
                                                <option value="">All</option>
                                                <option value="User">User</option>
                                                <option value="Admin">Admin</option>
                                                <option value="Super Admin">Super Admin</option>
                                            </select>
                                        </div>
                                        <input type="text" id="searchUserWithRoles" placeholder="Search user..."
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
                                @include('SuperAdmin.table.permissionTable')

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

                <div class="modal fade" id="addPermissionModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-sm-5 pb-5">
                                <div class="text-center mb-2">
                                    <h1 class="mb-1">Add New Permission</h1>
                                    <p>Permissions you may use and assign to your users.</p>
                                </div>
                                <form id="addPermissionForm" class="row" onsubmit="return false" novalidate="novalidate">
                                    <div class="col-12">
                                        <label class="form-label" for="modalPermissionName">Permission Name</label>
                                        <input type="text" id="modalPermissionName" name="modalPermissionName"
                                            class="form-control" placeholder="Permission Name" autofocus=""
                                            data-msg="Please enter permission name">
                                    </div>

                                    <div class="col-12 text-center">
                                        <button type="submit"
                                            class="btn btn-primary mt-2 me-1 waves-effect waves-float waves-light">Create
                                            Permission</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-2 waves-effect"
                                            data-bs-dismiss="modal" aria-label="Close">
                                            Discard
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/table/viewAllPermissionTable.js') }}"></script>
@endsection
