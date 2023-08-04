@extends('layouts.userapp')

@section('csslink')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/vendors/css/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-asset/css/plugins/extensions/ext-component-sweet-alerts.css') }}">

    <!-- Include the custom CSS class -->
    <style>
        .fixed-image {
            width: 250px;
            height: 250px;
            object-fit: cover;
        }

        /* Add a custom class for the position-relative container */
        .image-container {
            width: 250px;
            height: 250px;
            /* Set the container width and height to match the image size */
            position: relative;
        }

        /* Add a custom class for the text overlay */
        .overlay-text {
            font-size: 16px;
            /* Adjust the font size as needed */
            line-height: 1;
            /* Set line-height to 1 to ensure the text doesn't create additional space */
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 10px;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .image-container:hover .fixed-image {
            box-shadow: 0 0 15px 5px rgba(0, 0, 0, 0.4);
        }

        .mainSection {
            background-color: #fff;
            min-height: 75vh;
        }
    </style>
@endsection

@section('layout')
    <div class="container p-2 mainSection">
        <div>
            <h2>Welcome
                {{ ucfirst(strtolower(Auth::user()->first_name)) . ' ' . ucfirst(strtolower(Auth::user()->last_name)) }}
            </h2>
            <div>
                Your IP Address: {{ request()->getClientIp(true) }}
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-3 mb-4">
                <div class="image-container">
                    <a href="{{ route('AlatTulis.index') }}">
                        <img class="fixed-image" src="{{ asset('img/stationery.jpg') }}" alt="Image 1">
                        <div class="overlay-text">
                            Pinjaman Alat Tulis
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="image-container">
                    <a href="">
                        <img class="fixed-image" src="{{ asset('img/it.jpg') }}" alt="Image 2">
                        <div class="overlay-text">
                            Pinjaman Barang IT
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="image-container">
                    <a href="">
                        <img class="fixed-image" src="{{ asset('img/classroom.jpg') }}" alt="Image 3">
                        <div class="overlay-text">
                            Tempahan Ruang
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="image-container">
                    <a href="">
                        <img class="fixed-image" src="{{ asset('img/car.jpg') }}" alt="Image 4">
                        <div class="overlay-text">
                            Tempahan Kereta
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@php
@endphp

@section('script')
    <script src="{{ asset('app-asset/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berjaya!',
                text: '{{ session('success') }}',
            });
        @endif
    </script>
@endsection
