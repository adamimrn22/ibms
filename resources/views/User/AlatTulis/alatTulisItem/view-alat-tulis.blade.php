@extends('layouts.userapp')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/css/grid-product.css') }}">
    <style>
        .removeBtn {
            color: #ef4444;
        }

        .removeBtn:hover {
            cursor: pointer;
            text-decoration: underline;
        }

        .product-image {
            width: 200px;
            min-height: 280px;
            object-fit: cover;
            cursor: pointer;
        }

        .btn-full-width {
            width: 100%;
        }

        .item-container {
            height: 100%;
            /* Set a fixed height for the item container */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .item-container h5 {
            overflow: hidden;
            white-space: nowrap;
            /* Prevent text from wrapping */
            text-overflow: ellipsis;
            /* Show ellipsis (...) for overflow text */
            margin: 0;
            padding: 0;
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

    <div class="d-md-flex justify-content-between">
        <!-- Filter Section (Left) -->
        <div class="p-3 mb-3 mb-md-0" style="min-width: 15%;">
            <h4 class="h3 border-bottom-primary pb-1">Filter</h4>
            <div style="width: 200px;">
                <h6 class="mt-1">Sub Kategori</h6>
                <div class="my-1">
                    <div class="form-check form-check-primary mb-1">
                        <input type="checkbox" class="form-check-input category-checkbox" id="all" value="All"
                            checked>
                        <label class="form-check-label ms-1" for="all">All</label>
                    </div>
                    <div class="form-check form-check-primary mb-1">
                        <input type="checkbox" class="form-check-input category-checkbox" id="a4Paper" value="22">
                        <label class="form-check-label ms-1" for="a4Paper">A4 Paper</label>
                    </div>
                    <div class="form-check form-check-primary mb-1">
                        <input type="checkbox" class="form-check-input category-checkbox" id="Paper" value="18">
                        <label class="form-check-label ms-1" for="Paper">Paper</label>
                    </div>
                    <div class="form-check form-check-primary mb-1">
                        <input type="checkbox" class="form-check-input category-checkbox" id="File" value="19">
                        <label class="form-check-label ms-1" for="File">File</label>
                    </div>
                    <div class="form-check form-check-primary mb-1">
                        <input type="checkbox" class="form-check-input category-checkbox" id="alatTulis" value="20">
                        <label class="form-check-label ms-1" for="alatTulis">Alatan Tulis</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Grid (Right) -->
        <div class="d-flex flex-fill ms-md-1 px-1">
            <div class="row">
                <div class="mb-1 py-1 d-flex justify-content-between border-top border-bottom">
                    <div class="col-sm-12 col-md-4">
                        <div class="input-group">
                            <input type="text" id="searchItem" placeholder="Cari Alatan Tulis.." class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                        <div class="d-flex justify-content-end">
                            <label class="d-inline-flex align-items-center">
                                Show
                                <select id="recordFilter" class="form-select mx-1 px-2">
                                    <option value="9" selected>9</option>
                                    <option value="18">10</option>
                                    <option value="27">25</option>
                                    <option value="36">50</option>
                                    <option value="63">75</option>
                                    <option value="108">100</option>
                                </select> entries
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row p-0 m-0" style="position: relative" id="productCol">
                    @include('User.AlatTulis.alatTulisItem.product-grid')

                    <div class="d-flex align-items-center justify-content-center ">
                        <div id="roleSpinner" align="center" class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>

                @include('components.product-pagination')
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

    <script src="{{ asset('js/User/AlatTulis/viewAlatTulis.js') }}"></script>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.btn-book', function() {
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
                                timeOut: 1500,
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

            $(document).on('click', '.btn-show-image', function() {
                const itemId = $(this).data('item-id');

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
