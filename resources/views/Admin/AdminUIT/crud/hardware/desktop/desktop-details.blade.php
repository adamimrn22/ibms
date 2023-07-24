@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>

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

                        @if (
                            $desktop->attribute &&
                                (!empty($desktop->attribute->keyboard) ||
                                    !empty($desktop->attribute->mouse) ||
                                    count($desktop->attribute->monitor) > 0))
                            <h5 class="my-1">Desktop Peripheral</h5>
                            <table class="table table-bordered text-nowrap text-center">
                                <thead>
                                    <tr>
                                        <th scope="col"> </th>
                                        <th scope="col" width="80%">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($desktop->attribute->keyboard->name))
                                        <tr>
                                            <th scope="row" class="text-start">Keyboard</th>
                                            <td>
                                                <a
                                                    href="{{ route('uit.Keyboard.show', ['Keyboard' => Crypt::encrypt($desktop->attribute->keyboard->id)]) }}">
                                                    {{ strtoupper($desktop->attribute->keyboard->name) }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                    @if (!empty($desktop->attribute->mouse->name))
                                        <tr>
                                            <th scope="row" class="text-start"> Mouse </th>
                                            <td>
                                                <a
                                                    href="{{ route('uit.Mouse.show', ['Mouse' => Crypt::encrypt($desktop->attribute->mouse->id)]) }}">
                                                    {{ strtoupper($desktop->attribute->mouse->name) }}
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th scope="row" class="text-start">Monitor</th>
                                        <td class="m-0 p-0">
                                            <table class="table text-nowrap text-center">
                                                @forelse ($desktop->attribute->monitor as $monitor)
                                                    <tr>
                                                        <td>
                                                            <a
                                                                href="{{ route('uit.Monitor.show', ['Monitor' => Crypt::encrypt($monitor->id)]) }}">
                                                                {{ strtoupper($monitor->name) }}
                                                            </a>
                                                        </td>
                                                    </tr>

                                                @empty
                                                    <tr>No Monitor</tr>
                                                @endforelse
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </x-app-content>
@endsection


@section('script')
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Desktop/createDesktop.js') }}"></script>
@endsection
