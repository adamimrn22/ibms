@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>

        {{ Breadcrumbs::render('laptop.show', $laptop) }}

        <div class="row mt-1">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Laptop Details</h3>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered bg-light text-nowrap text-center mb-2">

                            <tbody>
                                <tr>
                                    <th scope="row" class="text-start">ID NAME</th>
                                    <td>{{ $laptop->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Location</th>
                                    <td>{{ $laptop->location }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <h5>Laptop Specification</h5>
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
                                            class="badge rounded-pill badge-light-primary">{{ $laptop->attribute->brand }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Model</th>
                                    <td>{{ $laptop->attribute->model }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Processor</th>
                                    <td>{{ $laptop->attribute->processor }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Ram</th>
                                    <td>{{ $laptop->attribute->ram }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Operating System</th>
                                    <td>{{ $laptop->attribute->OS }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Graphic Card</th>
                                    <td>{{ $laptop->attribute->gpu }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Storage</th>
                                    <td class="m-0 p-0">
                                        <table class="table text-nowrap text-center">
                                            @foreach ($laptop->attribute?->storage as $storage)
                                                <tr>
                                                    <td>
                                                        {{ $storage }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h5 class="my-1">Desktop Peripheral</h5>
                        <table class="table table-bordered text-nowrap text-center">
                            <thead>
                                <tr>
                                    <th scope="col"> </th>
                                    <th scope="col" width="80%">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                            <th scope="row" class="text-start">Keyboard</th>
                                            <td>{{ $laptop->attribute->keyboard }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-start">Mouse</th>
                                            <td>{{ $laptop->attribute->mouse }}</td>
                                        </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </x-app-content>
@endsection
