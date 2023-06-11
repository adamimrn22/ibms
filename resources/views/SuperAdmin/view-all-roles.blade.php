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
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span>Total 4 users</span>
                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="" class="avatar avatar-sm pull-up"
                                            data-bs-original-title="Vinnie Mostowy">
                                            <img class="rounded-circle" src="../../../app-assets/images/avatars/2.png"
                                                alt="Avatar">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="" class="avatar avatar-sm pull-up"
                                            data-bs-original-title="Allen Rieske">
                                            <img class="rounded-circle" src="../../../app-assets/images/avatars/12.png"
                                                alt="Avatar">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="" class="avatar avatar-sm pull-up"
                                            data-bs-original-title="Julee Rossignol">
                                            <img class="rounded-circle" src="../../../app-assets/images/avatars/6.png"
                                                alt="Avatar">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="" class="avatar avatar-sm pull-up"
                                            data-bs-original-title="Kaith D'souza">
                                            <img class="rounded-circle" src="../../../app-assets/images/avatars/11.png"
                                                alt="Avatar">
                                        </li>
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                                    <div class="role-heading">
                                        <h4 class="fw-bolder">Administrator</h4>
                                        <a href="javascript:;" class="role-edit-modal" data-bs-toggle="modal"
                                            data-bs-target="#addRoleModal">
                                            <small class="fw-bolder">Edit Role</small>
                                        </a>
                                    </div>
                                    <a href="javascript:void(0);" class="text-body"><svg xmlns="http://www.w3.org/2000/svg"
                                            width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-copy font-medium-5">
                                            <rect x="9" y="9" width="13" height="13" rx="2"
                                                ry="2"></rect>
                                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                        </svg></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span>Total 7 users</span>
                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="" class="avatar avatar-sm pull-up"
                                            data-bs-original-title="Jimmy Ressula">
                                            <img class="rounded-circle" src="../../../app-assets/images/avatars/4.png"
                                                alt="Avatar">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="" class="avatar avatar-sm pull-up"
                                            data-bs-original-title="John Doe">
                                            <img class="rounded-circle" src="../../../app-assets/images/avatars/1.png"
                                                alt="Avatar">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="" class="avatar avatar-sm pull-up"
                                            data-bs-original-title="Kristi Lawker">
                                            <img class="rounded-circle" src="../../../app-assets/images/avatars/2.png"
                                                alt="Avatar">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="" class="avatar avatar-sm pull-up"
                                            data-bs-original-title="Kaith D'souza">
                                            <img class="rounded-circle" src="../../../app-assets/images/avatars/5.png"
                                                alt="Avatar">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="" class="avatar avatar-sm pull-up"
                                            data-bs-original-title="Danny Paul">
                                            <img class="rounded-circle" src="../../../app-assets/images/avatars/7.png"
                                                alt="Avatar">
                                        </li>
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                                    <div class="role-heading">
                                        <h4 class="fw-bolder">Manager</h4>
                                        <a href="javascript:;" class="role-edit-modal" data-bs-toggle="modal"
                                            data-bs-target="#addRoleModal">
                                            <small class="fw-bolder">Edit Role</small>
                                        </a>
                                    </div>
                                    <a href="javascript:void(0);" class="text-body"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-copy font-medium-5">
                                            <rect x="9" y="9" width="13" height="13"
                                                rx="2" ry="2"></rect>
                                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                        </svg></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span>Total 5 users</span>
                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="" class="avatar avatar-sm pull-up"
                                            data-bs-original-title="Andrew Tye">
                                            <img class="rounded-circle" src="../../../app-assets/images/avatars/6.png"
                                                alt="Avatar">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="" class="avatar avatar-sm pull-up"
                                            data-bs-original-title="Rishi Swaat">
                                            <img class="rounded-circle" src="../../../app-assets/images/avatars/9.png"
                                                alt="Avatar">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="" class="avatar avatar-sm pull-up"
                                            data-bs-original-title="Rossie Kim">
                                            <img class="rounded-circle" src="../../../app-assets/images/avatars/12.png"
                                                alt="Avatar">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="" class="avatar avatar-sm pull-up"
                                            data-bs-original-title="Kim Merchent">
                                            <img class="rounded-circle" src="../../../app-assets/images/avatars/10.png"
                                                alt="Avatar">
                                        </li>
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            title="" class="avatar avatar-sm pull-up"
                                            data-bs-original-title="Sam D'souza">
                                            <img class="rounded-circle" src="../../../app-assets/images/avatars/8.png"
                                                alt="Avatar">
                                        </li>
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                                    <div class="role-heading">
                                        <h4 class="fw-bolder">Users</h4>
                                        <a href="javascript:;" class="role-edit-modal" data-bs-toggle="modal"
                                            data-bs-target="#addRoleModal">
                                            <small class="fw-bolder">Edit Role</small>
                                        </a>
                                    </div>
                                    <a href="javascript:void(0);" class="text-body"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-copy font-medium-5">
                                            <rect x="9" y="9" width="13" height="13"
                                                rx="2" ry="2"></rect>
                                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                        </svg></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- table -->
                <div class="row" id="basic-table">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Total users with their roles</h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <p class="card-text">
                                        Here is the list of all user with their assigned roles
                                    </p>

                                    <a href="javascript:void(0)" data-bs-target="#addRoleModal" data-bs-toggle="modal">
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
                                @include('SuperAdmin.table.roleTable')



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



            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/table/viewAllRoleTable.js') }}"></script>
@endsection
