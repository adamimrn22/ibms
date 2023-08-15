<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true"
    style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="#">
                    <h2 class="brand-text">IBMS</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="feather feather-x d-block d-xl-none text-primary toggle-icon font-medium-4">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="feather feather-disc d-none d-xl-block collapse-toggle-icon primary font-medium-4">
                        <circle cx="12" cy="12" r="10"></circle>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </a>
            </li>
        </ul>
    </div>

    <div class="shadow-bottom"></div>

    <div class="main-menu-content ps">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


            @hasanyrole(['Admin UIT', 'Admin UKW', 'Admin UPSM'])
                <li class="mb-1 nav-item ">
                    <a class="d-flex align-items-center " href="{{ route('admin.dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span class="menu-title text-truncate" data-i18n="Home">Home</span>
                    </a>
                </li>
            @endhasrole

            @hasanyrole(['Admin UIT'])
                <li class="mb-1 nav-item ">
                    <a class="d-flex align-items-center {{ Str::contains(request()->path(), 'UIT') ? 'active' : '' }}"
                        href="{{ route('uit.Desktop.index') }}">
                        <i data-feather='archive'></i>
                        <span class="menu-item text-truncate">
                            UIT Asset Menu
                        </span>
                    </a>
                </li>
            @endhasrole

            @hasanyrole(['Admin UPSM'])
                <li class="mb-1 nav-item ">
                    <a class="d-flex align-items-center {{ Str::contains(request()->path(), 'UPSM/Booking/Kenderaan') ? 'active' : '' }}"
                        href="{{ route('upsm.BookingKenderaan.index') }}">
                        <i data-feather='archive'></i>
                        <span class="menu-item">
                            Tempahan Kenderaan
                        </span>
                    </a>
                </li>

                <li class="mb-1 nav-item ">
                    <a class="d-flex align-items-center {{ Str::contains(request()->path(), 'UPSM/Booking/Ruang') ? 'active' : '' }}"
                        href="{{ route('upsm.Classroom.index') }}">
                        <i data-feather='archive'></i>
                        <span class="menu-item text-truncate">
                            Tempahan Ruang
                        </span>
                    </a>
                </li>

                <li class="mb-1 nav-item ">
                    <a class="d-flex align-items-center {{ Str::contains(request()->path(), 'UPSM/Inventory') ? 'active' : '' }}"
                        href="{{ route('upsm.Classroom.index') }}">
                        <i data-feather='archive'></i>
                        <span class="menu-item text-truncate">
                            UPSM Asset Menu
                        </span>
                    </a>
                </li>
            @endhasrole

            @hasanyrole(['Admin UKW'])
                <li class="mb-1 nav-item ">
                    <a class="d-flex align-items-center {{ Str::contains(request()->path(), 'UKW/Booking/BookingAlatTulis') ? 'active' : '' }}"
                        href="{{ route('ukw.BookingAlatTulis.index') }}">
                        <i data-feather='archive'></i>
                        <span class="menu-item text-truncate">
                            UKW Booking Menu
                        </span>
                    </a>
                </li>

                <li class="mb-1 nav-item ">
                    <a class="d-flex align-items-center {{ Str::contains(request()->path(), 'UKW/Inventory') ? 'active' : '' }}"
                        href="{{ route('ukw.Paper.index') }}">
                        <i data-feather='archive'></i>
                        <span class="menu-item text-truncate">
                            UKW Asset Menu
                        </span>
                    </a>
                </li>

                <li class="mb-1 nav-item ">
                    <a class="d-flex align-items-center {{ Str::contains(request()->path(), 'UKW/Booking/Amount') ? 'active' : '' }}"
                        href="{{ route('ukw.Amount.index') }}">
                        <i data-feather='archive'></i>
                        <span class="menu-item text-truncate">
                            Staff A4 Amount
                        </span>
                    </a>
                </li>
            @endhasrole

            @hasanyrole(['Super Admin'])
                <li class="mb-1 nav-item ">
                    <a class="d-flex align-items-center " href="{{ route('superadmin.dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span class="menu-title text-truncate" data-i18n="Home">Home</span>
                    </a>
                </li>
            @endhasrole



            @hasanyrole(['Super Admin'])
                <li class="nav-item has-sub sidebar-group">
                    <a class="d-flex align-items-center" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-layout">
                            <rect x="3" y="3" width="18" height="18" rx="2"
                                ry="2">
                            </rect>
                            <line x1="3" y1="9" x2="21" y2="9"></line>
                            <line x1="9" y1="21" x2="9" y2="9"></line>
                        </svg><span class="menu-title text-truncate" data-i18n="Page Layouts">Inventory</span>
                    </a>
                    <ul class="menu-content">

                        <li class=" {{ Str::contains(request()->path(), 'UIT/Inventory') ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ route('uit.Desktop.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg>

                                <span class="menu-item text-truncate" data-i18n="Collapsed Menu">
                                    IT Asset Menu
                                </span>
                            </a>
                        </li>

                        <li class="{{ Str::contains(request()->path(), 'UPSM/Inventory') ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ route('upsm.Classroom.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg>

                                <span class="menu-item text-truncate" data-i18n="Collapsed Menu">
                                    UPSM Asset Menu
                                </span>
                            </a>
                        </li>

                        <li class="{{ Str::contains(request()->path(), 'UKW/Inventory') ? 'active' : '' }}">
                            <a class="d-flex align-items-center" href="{{ route('ukw.Paper.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg>

                                <span class="menu-item text-truncate" data-i18n="Collapsed Menu">
                                    UKW Asset Menu
                                </span>
                            </a>
                        </li>


                    </ul>
                </li>

            @endhasrole

            @role('Super Admin')
                <li class="nav-item has-sub mt-1" style=""><a class="d-flex align-items-center"
                        href="#"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg><span class="menu-title text-truncate" data-i18n="Roles &amp; Permission">Roles &amp;
                            Permission</span></a>
                    <ul class="menu-content">
                        <li class="{{ Request::routeIs('superadmin.roles.index') ? ' active' : '' }}"><a
                                class="d-flex align-items-center " href="{{ route('superadmin.roles.index') }}"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg><span class="menu-item text-truncate" data-i18n="Roles">Roles</span></a>
                        </li>
                        <li class="{{ Request::routeIs('superadmin.permission.index') ? ' active' : '' }}"><a
                                class="d-flex align-items-center" href="{{ route('superadmin.permission.index') }}"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg><span class="menu-item text-truncate" data-i18n="Permission">Permission</span></a>
                        </li>
                    </ul>
                </li>
            @endrole

            @can('user.view')
                <li class="nav-item has-sub mt-1" style=""><a class="d-flex align-items-center"
                        href="#"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg><span class="menu-title text-truncate" data-i18n="User">User</span></a>
                    <ul class="menu-content">
                        <li class="{{ Request::routeIs('users.index') ? ' active' : '' }}"><a
                                class="d-flex align-items-center" href="{{ route('users.index') }}"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-circle">
                                    <circle cx="12" cy="12" r="10"></circle>
                                </svg><span class="menu-item text-truncate" data-i18n="List">View User</span></a>
                        </li>

                    </ul>
                </li>
            @endcan

            @can(['position.view', 'unit.view'])
                <li class="nav-item has-sub mt-1" style=""><a class="d-flex align-items-center" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-plus-circle">
                            <circle cx="12" cy="12" r="10" />
                            <line x1="12" y1="8" x2="12" y2="16" />
                            <line x1="8" y1="12" x2="16" y2="12" />
                        </svg>
                        <span class="menu-title text-truncate">Position & Unit</span></a>
                    <ul class="menu-content">
                        @can('position.view')
                            <li class="{{ Request::routeIs('position.index') ? ' active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('position.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg>
                                    <span class="menu-item text-truncate" data-i18n="List">View Position</span></a>
                            </li>
                        @endcan

                        @can('unit.view')
                            <li class="{{ Request::routeIs('unit.index') ? ' active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('unit.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                    </svg>
                                    <span class="menu-item text-truncate" data-i18n="List">View Unit</span></a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

        </ul>
        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps__rail-y" style="top: 0px; right: 0px;">
            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
        </div>
    </div>
</div>
