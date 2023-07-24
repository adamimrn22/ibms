@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>

        {{ Breadcrumbs::render('monitor.show', $monitor) }}

        <div class="row mt-1">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Monitor Details</h3>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered bg-light text-nowrap text-center mb-2">

                            <tbody>
                                <tr>
                                    <th scope="row" class="text-start">ID NAME</th>
                                    <td>{{ $monitor->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Location</th>
                                    <td>{{ $monitor->location }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <h5>Monitor Specification</h5>
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
                                            class="badge rounded-pill badge-light-primary">{{ $monitor->attribute->brand }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Model</th>
                                    <td>{{ $monitor->attribute->model }}</td>
                                </tr>

                                <tr>
                                    <th scope="row" class="text-start">Price (RM)</th>
                                    <td>{{ $monitor->price }}</td>
                                </tr>

                                <tr>
                                    <th scope="row" class="text-start">Display</th>
                                    <td>{{ $monitor->attribute->display }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Dimension</th>
                                    <td>{{ $monitor->attribute->dimension }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Resolution</th>
                                    <td>{{ $monitor->attribute->resolution }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Date Of Purchase</th>
                                    <td>{{ $monitor->attribute->DOP }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-content>
@endsection
