@extends('test.testlayout')

@section('csslink')
    <style>
        .header-link {
            text-decoration: none;
        }

        .image-card {
            position: relative;
            overflow: hidden;
            display: block;
            text-decoration: none;
            transition: transform 0.3s;
            height: 250px;
            border-radius: 10px;
            /* Adjust the height as needed */
        }

        .image-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            opacity: 1;
            box-shadow: 0px 0px 0px 0px rgba(0, 0, 0, 0);
            transition: box-shadow 0.3s;
        }

        .image-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 0px 20px 5px rgba(118, 114, 240, 0.541);
            -webkit-box-shadow: 0px 0px 20px 5px rgba(118, 114, 240, 0.541);
            -moz-box-shadow: 0px 0px 20px 5px rgba(118, 114, 240, 0.541);
        }
    </style>
@endsection

@section('section')
    <div class="mt-1">
        <div class="card p-1">
            <section class="p-1 my-1 text-secondary">
                <h3>Welcome
                    <span>
                        Abu bin seman
                    </span>
                    !
                </h3>
                <hr>
            </section>

            <section class=" mb-3">
                <div class="row gy-5 text-center">
                    <div class="col-md-3 card-container">
                        <a href="alatTulisDashboard.html" class="image-card">
                            <img src="{{ asset('img/stationery.jpg') }}" alt="Image 1">
                            <div class="image-overlay">Pinjaman Alat Tulis</div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="image-card">
                            <img src="{{ asset('img/it.jpg') }}" alt="Image 2">
                            <div class="image-overlay">Pinjaman IT</div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="image-card">
                            <img src="{{ asset('img/classroom.jpg') }}" alt="Image 3">
                            <div class="image-overlay">Tempahan Ruang</div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="#" class="image-card">
                            <img src="{{ asset('img/car.jpg') }}" alt="Image 4">
                            <div class="image-overlay">Tempahan Kereta</div>
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
