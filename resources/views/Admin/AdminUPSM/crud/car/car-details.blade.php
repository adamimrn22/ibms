@extends('layouts.app')

@section('layout')
    <x-app-content>

        {{ Breadcrumbs::render('car.show', $car) }}

        <div class="row mt-1">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Car Details </h3>
                    </div>
                    <div class="card-body">
                        <div class="my-1">
                            <h1>{{ $car->name }}</h1>
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
                                    <th scope="row" class="text-start">Plate Number</th>
                                    <td>
                                        <span
                                            class="badge rounded-pill badge-light-primary">{{ $car->attribute->plateNumber }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Seat</th>
                                    <td>
                                        <span>{{ $car->attribute->seat }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Location</th>
                                    <td>{{ $car->location }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Date Of Purchase</th>
                                    <td>{{ $car->attribute->DOP }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Status</th>
                                    <td>{{ $car->Status->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-content>
@endsection
