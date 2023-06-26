@extends('layouts.app')

@section('layout')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <h3>Roles List</h3>
                <p class="mb-2">
                    A role provided access to predefined menus and features so that depending <br>
                    on assigned role
                </p>

                <div class="row">

                    @include('SuperAdmin.role.section.RoleSection')

                    {{-- Roles Card --}}


                    <!-- table -->
                    <div class="row" id="basic-table">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Total active users with their roles</h4>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <p class="card-text">
                                            Here is the list of all active user with their assigned roles
                                        </p>

                                        <a href="javascript:void(0)" class="role-add-modal" data-bs-target="#addRoleModal"
                                            data-bs-toggle="modal">
                                            <span class="btn btn-primary waves-effect waves-float waves-light">Add New
                                                Role</span>
                                        </a>
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
                                    @include('SuperAdmin.role.table.roleTable')

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
                    <!-- table -->

                    @include('SuperAdmin.role.modal.roleModal')

                    @include('SuperAdmin.role.modal.userRoleModal')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('app-asset/js/custom/modal/addRoleModal.js') }}"></script>
    <script src="{{ asset('js/SuperAdmin/role/roleSection.js') }}"></script>
    <script src="{{ asset('js/SuperAdmin/permission/permissionModal.js') }}"></script>
    <script src="{{ asset('js/SuperAdmin/role/viewAllRoleTable.js') }}"></script>
    <script src="{{ asset('js/SuperAdmin/permission/userPermissionModal.js') }}"></script>
@endsection
