@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>

        {{ Breadcrumbs::render('misc.show', $misc) }}

        <div class="row mt-1">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Miscellaneous Details</h3>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered bg-light text-nowrap text-center mb-2">
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-start">NAME</th>
                                    <td>{{ $misc->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Location</th>
                                    <td>{{ $misc->location }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <h5>Printer Specification</h5>
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
                                            class="badge rounded-pill badge-light-primary">{{ $misc->attribute->brand }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Model</th>
                                    <td>
                                        <span>{{ $misc->attribute->model }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Price</th>
                                    <td>
                                        <span>{{ $misc->price }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Date Of Purchase</th>
                                    <td>
                                        <span>{{ $misc->attribute->DOP }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Status</th>
                                    <td>
                                        <span>{{ $misc->status->name }}</span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-content>
@endsection
