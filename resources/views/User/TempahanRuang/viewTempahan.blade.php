@extends('layouts.userapp')

@section('csslink')
@endsection
@section('section')
    <div class="mt-1">


        <div class="card ">
            <div class="card-body text-justify">

                <div>
                    <h3 class="h5">Bilangan Pending Pesanan</h3>

                    <div class="d-flex justify-content-between align-items-center mx-0 my-2 row">

                        <div class="col-sm-12 col-md-4 m-0 p-0">
                            <div class="input-group">
                                <input type="text" id="searchTujuan" placeholder="Search Tujuan..." class="form-control">
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
                </div>
                <div>

                    @include('User.TempahanRuang.tempahanTable')

                    <div class="d-flex align-items-center justify-content-center mt-2">
                        <div id="roleSpinner" align="center" class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                    @include('components.Pagination')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/User/Ruang/viewRuangTempah.js') }}"></script>
@endsection
