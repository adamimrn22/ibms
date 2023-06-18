@extends('layouts.app')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/css/style.css') }}">
@endsection

@section('layout')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users list start -->
                <section class="app-user-list">
                    <div class="row">
                        @include('SuperAdmin.section.UserSection')
                    </div>
                    <!-- list and filter start -->

                    <div class="row mt-1" id="basic-table">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <p class="card-text">
                                            Here is the list of all users
                                        </p>

                                        <button class="btn add-new btn-primary mt-50 add-permission-modal" tabindex="0"
                                            type="button" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                            <span>Add New User</span>
                                        </button>
                                    </div>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between align-items-center mx-0 mb-2 row">

                                    <div class="col-sm-12 col-md-4">
                                        <div class="input-group">
                                            <button type="button"
                                                class="btn btn-outline-primary dropdown-toggle waves-effect"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Filter
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                <select id="userFilter" class="form-select mx-1 px-2">
                                                    <option selected value="All">All</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Not Active</option>
                                                </select>
                                            </div>
                                            <input type="text" id="searchUser" placeholder="Search user..."
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

                                    @include('SuperAdmin.table.userTable')

                                    <div class="d-flex align-items-center justify-content-center">
                                        <div id="roleSpinner" align="center" class="spinner-border text-primary"
                                            role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>

                                    @include('components.Pagination');
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users list ends -->

                @include('SuperAdmin.modal.userModal')
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/table/viewAllUserTable.js') }}"></script>
    <script src="{{ asset('app-asset/js/custom/addUser.js') }}"></script>
@endsection
