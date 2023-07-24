@extends('layouts.app')

@section('csslink')
    <style>
        .carousel-inner {
            max-height: 500px;
            /* Set your desired fixed height for the carousel */
            display: flex;
        }

        .carousel-item {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .carousel-item img {
            max-width: 100%;
            object-fit: cover;
            object-position: center;
            /* Use 'cover' if you want to cover the slide or 'contain' to fit inside preserving aspect ratio */
        }
    </style>
@endsection

@section('layout')
    <x-app-content>
        {{ Breadcrumbs::render('clasroom.edit', $classroom) }}

        <div class="row mt-1">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Classroom Details </h3>
                    </div>
                    <div class="card-body">
                        <div id="carouselExampleIndicators" class="carousel slide carousel-fade " data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @foreach ($classroom->images as $index => $image)
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"
                                        aria-label="Slide {{ $index + 1 }}"></button>
                                @endforeach
                            </div>

                            <div class="carousel-inner rounded">
                                @foreach ($classroom->images as $index => $image)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/classroom/' . $image->parent_folder . '/' . $image->path) }}"
                                            class="img-fluid d-block w-100" alt="Slide {{ $index + 1 }}">
                                    </div>
                                @endforeach
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>

                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="my-1">
                            <h1>{{ $classroom->name }}</h1>
                        </div>
                        <hr class="mt-1">
                        <table class="table table-bordered text-nowrap text-center">
                            <thead>
                                <tr>
                                    <th scope="col"> </th>
                                    <th scope="col" width="80%">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-start">Table</th>
                                    <td>
                                        <span>{{ $classroom->attribute->Table }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Chair</th>
                                    <td>{{ $classroom->attribute->Chair }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Foldable Chair</th>
                                    <td>{{ $classroom->attribute->Foldable_Chair }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Whiteboard</th>
                                    <td>{{ $classroom->attribute->Whiteboard }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Duster</th>
                                    <td>{{ $classroom->attribute->Duster }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Status</th>
                                    <td>{{ $classroom->Status->name }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
        </div>
    </x-app-content>
@endsection


@section('script')
    @if ($errors->any())
        <script>
            toastr.error('Validation Error', 'Error');
        </script>
    @endif
@endsection
