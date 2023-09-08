@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>

        {{ Breadcrumbs::render('software.show', $software) }}

        <div class="row mt-1">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Software Details</h3>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered bg-light text-nowrap text-center mb-2">
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-start">NAME</th>
                                    <td>{{ $software->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Location</th>
                                    <td>{{ $software->location }}</td>
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
                                            class="badge rounded-pill badge-light-primary">{{ $software->attribute->brand }}</span>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row" class="text-start">Details</th>
                                    <td style="white-space: normal; overflow-wrap: break-word;">
                                        {{ $software->attribute->details }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-content>
@endsection
