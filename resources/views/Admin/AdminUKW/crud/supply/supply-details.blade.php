@extends('layouts.app')

@section('csslink')
    <style>
        img {
            max-height: 250px;
        }
    </style>
@endsection

@section('layout')
    <x-app-content>
        {{ Breadcrumbs::render('supply.show', $supply) }}

        <div class="row mt-1">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Alat Tulis Details </h3>
                    </div>
                    <div class="card-body">

                        <div class="my-1">
                            <h3 class="text-center">{{ strtoupper($supply->name) }}</h3>
                        </div>

                        <hr>

                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{ asset('storage/supply/' . $supply->images->parent_folder . '/' . $supply->images->path) }}"
                                alt="">
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
                                    <th scope="row" class="text-start">Name</th>
                                    <td>
                                        <span>{{ $supply->name }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Current Quantitiy</th>
                                    <td>{{ $supply->current_quantity }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Stock</th>
                                    <td>{{ $supply->stock }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Status</th>
                                    <td>{{ $supply->status->name }}</td>
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
