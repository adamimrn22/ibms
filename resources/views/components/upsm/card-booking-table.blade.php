@props(['id', 'placeholder', 'data', 'title'])
<div class="row mt-1" id="basic-table">
    <div class="col-12">

        <div class="card">

            <div class="card-header">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('upsm.BookingKenderaan.index') ? 'active' : '' }}"
                            id="home-tab" data-bs-toggle="tab" href="{{ route('upsm.BookingKenderaan.index') }}"
                            aria-controls="home" role="tab" aria-selected="true">Pending</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('upsm.BookingKenderaan.indexHistory') ? 'active' : '' }}"
                            href="{{ route('upsm.BookingKenderaan.indexHistory') }}" aria-controls="profile"
                            role="tab" aria-selected="false">History</a>
                    </li>
                </ul>
            </div>

            <div class="card-header">
                <h4 class="card-title">{{ $title }}</h4>
            </div>

            <div class="d-flex justify-content-between align-items-center mx-0 mb-2 row">

                <div class="col-sm-12 col-md-4">
                    <div class="input-group">
                        <input type="text" id="{{ $id }}" placeholder="{{ $placeholder }}"
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
                {{ $slot }}

                {{-- <div class="d-flex align-items-center justify-content-center">
                    <div id="roleSpinner" align="center" class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div> --}}

                @include('components.Pagination')
            </div>
        </div>
    </div>
</div>
