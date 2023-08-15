@extends('User.AlatTulis.alatTulisItem.index')

@section('tableSection')
    <div class="d-flex justify-content-between align-items-center mx-0 mb-2 row">

        <div class="col-sm-12 col-md-4">
            <div class="input-group">
                <input type="text" id="searchPaper" placeholder="Search A4 Paper.." class="form-control">
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

    <div class="table-responsive ">
        @include('User.AlatTulis.table.a4BookingTable')

        <div class="d-flex align-items-center justify-content-center">
            <div id="roleSpinner" align="center" class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        @include('components.Pagination')
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/User/AlatTulis/viewAllA4.js') }}"></script>
@endsection
