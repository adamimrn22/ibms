@extends('test.testlayout')

@section('section')
    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h4 class="card-title text-white">Bilangan Pinjaman A4</h4>
                    <p class="card-text">{{ $user->paperAmount->amount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <h4 class="card-title text-white">Unit Pengguna</h4>
                    <p class="card-text">{{ $user->unit->name }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h4 class="card-title text-white">Jawatan Pengguna</h4>
                    <p class="card-text">{{ $user->position->name }}</p>
                </div>
            </div>
        </div>

    </div>

    <div class="card ">
        <div class="m-2">
            <a href="alatanTulis.html" class="btn btn-primary">
                Pesan pinjaman Alatan Tulis
            </a>

            <hr>

            <div class="card">

                <div class="card-title">
                    <h3 class="h5">Bilangan Pending Pesanan</h3>
                </div>
                <div class=" ">

                    <div class="d-flex justify-content-md-end align-items-center mx-0 mb-2 row">

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


                    <div style="overflow: auto">
                        @include('test.testAlatBookingTable')
                    </div>

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
@endsection

@section('script')
    <script src="{{ asset('js/alatBooking.js') }}"></script>
@endsection
