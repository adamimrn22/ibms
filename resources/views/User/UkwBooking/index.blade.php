@extends('layouts.userapp')

@section('csslink')
@endsection

@section('layout')
    <div class="p-1 container">

        <div class="bg-white p-1 border d-flex justify-content-end">
            <div class="position-relative d-inline-block cursor" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd"
                aria-controls="offcanvasEnd">
                <img src="{{ asset('img/shopping-cart-bolt.svg') }}" alt="">
                <span class="badge rounded-pill bg-primary badge-up" id="totalQuantity">{{ $totalQuantity }}</span>
            </div>
        </div>


        <ul class="nav navbar-nav align-items-end ms-auto">

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel"
                aria-hidden="true" style="visibility: hidden;">
                <div class="offcanvas-header">
                    <h5 id="offcanvasEndLabel" class="offcanvas-title">Tempahan Barang Semasa</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>

                @include('User.UkwBooking.cart')
            </div>

        </ul>

        <div class="row mt-1" id="basic-table">
            <div class="col-12">

                <div class="card ">

                    <div class="card-header">
                        <h4 class="card-title">Pinjaman Alat Tulis</h4>
                    </div>

                    <div class="card-header">
                        <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link
                                        {{ request()->routeIs('AlatTulis.index') ? 'active' : '' }}"
                                    href="{{ route('AlatTulis.index') }}" role="tab">
                                    Kertas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link
                                        {{ request()->routeIs('AlatTulis.a4') ? 'active' : '' }}"
                                    href="{{ route('AlatTulis.a4') }}" role="tab">
                                    A4 Paper
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link
                                        {{ request()->routeIs('AlatTulis.file') ? 'active' : '' }}"
                                    href="{{ route('AlatTulis.file') }}" role="tab">
                                    Fail
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link
                                        {{ request()->routeIs('AlatTulis.stationery') ? 'active' : '' }}"
                                    href="{{ route('AlatTulis.stationery') }}" role="tab">
                                    Barang Alat Tulis
                                </a>
                            </li>
                        </ul>

                    </div>
                    <hr>

                    @yield('tableSection')

                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    @yield('scripts')

    <script>
        $(document).ready(function() {
            $('.btn-book').on('click', function() {
                const itemId = $(this).data('item-id');

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: 'POST',
                    data: {
                        item_id: itemId,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.error) {
                            toastr.error(response.error, 'Amaran')
                        } else {
                            loadCartSection();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    },
                });
            });

            // Function to load the cart section using AJAX
            function loadCartSection() {
                $.ajax({
                    url: '{{ route('cart.get') }}',
                    method: 'GET',
                    success: function(response) {
                        $('#cart-section').html(response.cart);
                        console.log(response.totalQuantity)
                        totalQuantity == 0 ? '0' :
                            $('#totalQuantity').html(response.totalQuantity);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    },
                });
            }

            // Event listener for decrement buttons
            $(document).on('click', '.btn-decrement', function() {
                const itemId = $(this).closest('.d-flex').data('item-id');

                console.log(itemId)
                $.ajax({
                    url: `{{ route('cart.decrement', ['itemId' => ':itemId']) }}`.replace(
                        ':itemId',
                        itemId),
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        loadCartSection();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    },
                });
            });

            // Event listener for increment buttons
            $(document).on('click', '.btn-increment', function() {
                const itemId = $(this).closest('.d-flex').data('item-id');

                console.log(itemId)
                $.ajax({
                    url: `{{ route('cart.increment', ['itemId' => ':itemId']) }}`.replace(
                        ':itemId',
                        itemId),
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.error) {
                            toastr.error(response.error, 'Amaran')
                        } else {
                            loadCartSection();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    },
                });
            });

            $(document).on('click', '.btn-remove', function() {
                const itemId = $(this).data('item-id');

                $.ajax({
                    url: `{{ route('cart.remove', ['itemId' => ':itemId']) }}`.replace(':itemId',
                        itemId),
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        // On success, reload the cart section with updated data
                        loadCartSection();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    },
                });
            });

            $(document).on('click', '.btn-clear-cart', function() {
                $.ajax({
                    url: '{{ route('cart.clear') }}',
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        // On success, reload the cart section with updated data
                        loadCartSection();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    },
                });
            });

        });
    </script>
@endsection
