@extends('layouts.app')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/css/style.css') }}">
@endsection
@section('layout')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row"></div>
            <div class="content-body">

                {{ Breadcrumbs::render('desktop.show', $desktop) }}

                <div class="row mt-1">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> Desktop Details</h3>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered bg-light text-nowrap text-center mb-2">

                                    <tbody>
                                        <tr>
                                            <th scope="row" class="text-start">ID NAME</th>
                                            <td>{{ $desktop->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-start">Location</th>
                                            <td>{{ $desktop->location }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h5>Desktop Specification</h5>
                                <table class="table table-bordered text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col"> </th>
                                            <th scope="col" width="80%">Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="text-start">Model</th>
                                            <td>{{ $desktop->attribute->model }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-start">Processor</th>
                                            <td>{{ $desktop->attribute->processor }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-start">Ram</th>
                                            <td>{{ $desktop->attribute->ram }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-start">Operating System</th>
                                            <td>{{ $desktop->attribute->OS }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-start">Graphic Card</th>
                                            <td>{{ $desktop->attribute->gpu }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-start">Storage</th>
                                            <td class="m-0 p-0">
                                                <table class="table text-nowrap text-center">
                                                    @foreach ($desktop->attribute?->storage as $storage)
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
                                        <tr>
                                            <th scope="row" class="text-start">Keyboard</th>
                                            <td>{{ $desktop->attribute->keyboard }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-start">Mouse</th>
                                            <td>{{ $desktop->attribute->mouse }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="text-start">Monitor</th>
                                            <td class="m-0 p-0">
                                                <table class="table text-nowrap text-center">
                                                    @foreach ($desktop->attribute?->monitor as $monitor)
                                                        <tr>
                                                            <td>
                                                                {{ $monitor }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Desktop/createDesktop.js') }}"></script>
@endsection
