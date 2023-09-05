@extends('layouts.userapp')

@section('csslink')
    <style>
        .removeBtn {
            color: #ef4444;
        }

        .removeBtn:hover {
            cursor: pointer;
            text-decoration: underline;
        }

        .modal {
            text-align: center;
        }
    </style>
@endsection

@section('section')
    <div class="card">
        <div class="p-1 d-flex justify-content-end">
            <button class="btn btn-sm btn-secondary waves-effect d-inline-flex align-items-center" type="button"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" aria-controls="offcanvasExample">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" width="20">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
                <span class="ms-1" id="totalQuantity">{{ $totalQuantity }}</span>
            </button>
        </div>
    </div>

    <div class="card mt-1">
        <div class="m-1">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">Pinjaman Alat Tulis</h4>
                </div>

                <div class="card-header">
                    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link
                                    {{ request()->routeIs('AlatTulis.paper') ? 'active' : '' }}"
                                href="{{ route('AlatTulis.paper') }}" role="tab">
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


    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel"
        style="visibility: hidden;" aria-hidden="true">
        <div class="offcanvas-header">
            <h5 id="offcanvasEndLabel" class="offcanvas-title">Pesanan Pinjaman Alat Tulis</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            @include('User.AlatTulis.cart')
        </div>
    </div>

    @include('User.AlatTulis.alatTulisItem.imageModal')
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

                            toastr.options = {
                                closeButton: true,
                                positionClass: 'toast-top-left',
                                timeOut: 500,
                            };

                            toastr.success(' Item telah ditambahkan ke troli.', 'Success');
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
                        $('#cart-section').empty().html(response.cart);
                        $('#cart-section').html(response.cart);
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
                const itemId = $(this).closest('td').data('item-id');

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
                const itemId = $(this).closest('td').data('item-id');

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

            $('.btn-show-image').on('click', function() {
                const itemId = $(this).data('item-id');
                console.log(itemId)

                $.ajax({
                    url: "{{ route('AlatTulis.image') }}",
                    type: 'GET',
                    data: {
                        id: itemId, // Pass the item ID to the AJAX request
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.error) {
                            $('#img-error').text(response.error);
                        } else {
                            let img = response.image;
                            let imgPath =
                                `{{ asset('storage/supply/${img.parent_folder}/${img.path}') }}`
                            $('#image-preview').attr('src', imgPath);
                            $('#img-error').text('');
                        }
                    },
                    error: function(xhr) {
                        $('#img-error').text(
                            'Ralat berlaku semasa memproses permintaan anda.');
                    }
                });

            });
        });
    </script>
@endsection
