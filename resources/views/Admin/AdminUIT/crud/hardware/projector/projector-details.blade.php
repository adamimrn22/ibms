@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>

        {{ Breadcrumbs::render('projector.show', $projector) }}

        <div class="row mt-1">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Projector Details</h3>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered bg-light text-nowrap text-center mb-2">
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-start">ID NAME</th>
                                    <td>{{ $projector->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Location</th>
                                    <td>{{ $projector->location }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <h5>Projector Specification</h5>
                        <table class="table table-bordered text-nowrap text-center">
                            <thead>
                                <tr>
                                    <th scope="col"> </th>
                                    <th scope="col" width="80%">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-start">Brand</th>
                                    <td>
                                        <span
                                            class="badge rounded-pill badge-light-primary">{{ $projector->attribute->brand }}</span>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row" class="text-start">model</th>
                                    <td>{{ $projector->attribute->model }}</td>
                                </tr>

                                <tr>
                                    <th scope="row" class="text-start">Weight</th>
                                    <td>{{ $projector->attribute->weight }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Color</th>
                                    <td>{{ $projector->attribute->color }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Date Of Purchase</th>
                                    <td>{{ $projector->attribute->DOP }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-content>
@endsection
