@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>

        {{ Breadcrumbs::render('mouse.show', $mouse) }}

        <div class="row mt-1">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Mouse Details</h3>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered bg-light text-nowrap text-center mb-2">
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-start">ID NAME</th>
                                    <td>{{ $mouse->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Location</th>
                                    @if ($location)
                                        @if ($location->subcategory_id === 1)
                                            <td>
                                                <a
                                                    href="{{ route('uit.Desktop.show', ['Desktop' => Crypt::encryptString($location->id)]) }}">
                                                    {{ $mouse->location }}
                                                </a>
                                            </td>
                                        @elseif ($location->subcategory_id === 2)
                                            <td>
                                                <a
                                                    href="{{ route('uit.Laptop.show', ['Laptop' => Crypt::encryptString($location->id)]) }}">
                                                    {{ $mouse->location }}
                                                </a>
                                            </td>
                                        @endif
                                    @else
                                        <td>{{ $mouse->location }}</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>

                        <h5>Mouse Specification</h5>
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
                                            class="badge rounded-pill badge-light-primary">{{ $mouse->attribute->brand }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Type Of Mouse</th>
                                    <td>{{ $mouse->attribute->mouseType }}</td>
                                </tr>

                                <tr>
                                    <th scope="row" class="text-start">Connection</th>
                                    <td class="m-0 p-0">
                                        <table class="table text-nowrap text-center">
                                            @foreach ($mouse->attribute?->connection as $connection)
                                                <tr>
                                                    <td>
                                                        {{ $connection }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                <tr>
                                    <th scope="row" class="text-start">Weight</th>
                                    <td>{{ $mouse->attribute->weight }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Color</th>
                                    <td>{{ $mouse->attribute->color }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">DPI</th>
                                    <td>{{ $mouse->attribute->dpi }}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-start">Date Of Purchase</th>
                                    <td>{{ $mouse->attribute->DOP }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-content>
@endsection
