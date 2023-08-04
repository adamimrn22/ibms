@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>

        <div class="row mt-1">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Edit Alat Tulis</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text mb-1">
                            Check the checkbox for approve and leave uncheck for reject
                        </p>
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th width="2%">No.</th>
                                    <th width="5%" class="text-center">
                                        <div class="form-check form-check-success">
                                            <input class="form-check-input" type="checkbox" id="approval">
                                            <label class="form-check-label" for="approval">Approve</label>
                                        </div>
                                    <th>Name</th>
                                    <th width="5%" class="text-center">Quantity</th>
                                </tr>
                            </thead>
                            @foreach ($bookings as $index => $booking)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="form-check form-check-success">
                                            <input class="form-check-input" type="checkbox" id="approval">
                                            <label class="form-check-label" for="approval">Approve</label>
                                        </div>
                                    </td>
                                    <td>{{ $booking->inventory->name }}</td>
                                    @php
                                        if ($booking->quantity > $booking->inventory->current_quantity) {
                                            $booking->quantity = $booking->inventory->current_quantity;
                                        }
                                    @endphp
                                    <td>
                                        <div class="input-group bootstrap-touchspin">
                                            <span class="input-group-btn bootstrap-touchspin-injected"><button
                                                    class="btn btn-primary bootstrap-touchspin-down" type="button"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-minus">
                                                        <line x1="5" y1="12" x2="19" y2="12">
                                                        </line>
                                                    </svg>
                                                </button></span>
                                            <input type="number" class="touchspin form-control"
                                                value="{{ $booking->quantity }}">
                                            <span class="input-group-btn bootstrap-touchspin-injected">
                                                <button class="btn btn-primary bootstrap-touchspin-up" type="button"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-plus">
                                                        <line x1="12" y1="5" x2="12" y2="19">
                                                        </line>
                                                        <line x1="5" y1="12" x2="19" y2="12">
                                                        </line>
                                                    </svg></button></span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <hr>
                        <div class="d-flex flex-row-reverse p-2">
                            <button type="button"
                                class="btn btn-success waves-effect waves-float waves-light mx-1">Approve</button>
                            <button type="button" class="btn btn-outline-danger waves-effect">Reject All</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-content>
@endsection

@section('script')
    @if (Session::has('error'))
        <script>
            toastr.danger("{{ session('error') }}", 'Error');
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            toastr.success("{{ session('success') }}", 'Success');
        </script>
    @endif
@endsection
