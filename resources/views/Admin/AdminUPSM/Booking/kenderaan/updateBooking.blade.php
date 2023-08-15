@extends('layouts.app')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/forms/select/select2.min.css') }}">
@endsection
@section('layout')
    <x-app-content>

        <div class="row mt-1">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Tempahan Kenderaan</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-nowrap text-center">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col" width="80%">Butir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tarikh</td>
                                    <td class="p-0">
                                        <table class="table ">
                                            <thead>
                                                <th scope="row">Tarikh Pergi</th>
                                                <th scope="row">Tarikh Balik</th>
                                            </thead>
                                            <tbody>
                                                <td>{{ $booking->dateGo }}</td>
                                                <td>{{ $booking->dateReturn }}</td>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Waktu</td>
                                    <td class="p-0">
                                        <table class="table ">
                                            <thead>
                                                <th scope="row">Waktu Pergi</th>
                                                <th scope="row">Waktu Balik</th>
                                            </thead>
                                            <tbody>
                                                <td>{{ $booking->timeGo }}</td>
                                                <td>{{ $booking->timeReturn }}</td>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Destinasi</th>
                                    <td>{{ $booking->destination }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Tujuan</th>
                                    <td>{{ $booking->objective }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-bordered text-nowrap text-center my-1">
                            <thead>
                                <tr>
                                    <th scope="col" colspan="5">Staff Terlibat</th>
                                </tr>
                            </thead>
                            <thead>
                                <tr>
                                    <th scope="col">Bil</th>
                                    <th scope="col">Staff ID</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Jawatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($booking->staff as $index => $staffInvolved)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $staffInvolved->username }}</td>
                                        <td>{{ $staffInvolved->first_name . ' ' . $staffInvolved->last_name }}</td>
                                        <td>{{ $staffInvolved->unit->name }}</td>
                                        <td>{{ $staffInvolved->position->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <hr>

                        @if ($booking->driver)
                            <table class="table text-center my-1 border">
                                <thead>
                                    <th width="60">Nama Pemandu</th>
                                    <th width="20">Unit</th>
                                    <th width="20">Jawatan</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td width="60">
                                            <select name="driver" class="form-select select2 staff-select">
                                                <option value="" selected disabled></option>
                                                @foreach ($staffs as $staff)
                                                    <option value="{{ $staff->id }}"
                                                        data-unit="{{ $staff->unit->name }}"
                                                        data-position="{{ $staff->position->name }}">
                                                        {{ $staff->first_name . ' ' . $staff->last_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td width="20">
                                            <span class="form-control" id="unit" style="display: none;"></span>
                                        </td>
                                        <td width="20">
                                            <span class="form-control" id="position" style="display: none;"></span>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        @endif
                        @if ($booking->vehicle_type === 1)
                            <table class="table text-center border my-2">
                                <thead>
                                    <th>Kereta</th>
                                    <th>Butir Kereta</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td width="50%">
                                            <select name="car" class="form-select select2 carSelect">
                                                <option value="" selected disabled></option>
                                                @foreach ($cars as $car)
                                                    <option value="{{ $car->id }}"
                                                        data-attributes="{{ $car->attribute }}"
                                                        data-carLocation="{{ $car->location }}">
                                                        {{ $car->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="m-0 p-0">
                                            <table width="100%">
                                                <thead>
                                                    <th style="padding: 3px">Lokasi</th>
                                                    <th style="padding: 3px">Bil Tempat Duduk</th>
                                                </thead>
                                                <tr>
                                                    <td style="padding: 3px">
                                                        <span id="carLocation"></span>
                                                    </td>
                                                    <td style="padding: 3px">
                                                        <span id="carSeat"></span>
                                                    </td>
                                                </tr>
                                                <tr>

                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif

                        <div class="d-flex flex-row-reverse p-2">
                            <button id="submitBtn" type="submit" name="updateBooking" value="approveButton"
                                class="btn btn-success waves-effect waves-float waves-light mx-1" disabled>Approve</button>
                            <button type="submit" name="updateBooking" value="rejectButton"
                                class="btn btn-outline-danger waves-effect">Reject</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-content>
@endsection

@section('script')
    <script src="{{ asset('app-asset/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-asset/js/scripts/forms/form-select2.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('.select2.staff-select').on('change', function() {
                let selectedOption = $(this).find('option:selected');
                let unit = selectedOption.data('unit');
                let position = selectedOption.data('position');

                if (unit === undefined || position === undefined) {
                    $('#unit, #position').hide();
                } else {
                    $('#unit').text(unit).show();
                    $('#position').text(position).show();
                }

                updateSubmitButtonState()
            });

            $('.carSelect').on('change', function() {
                let selectedOption = $(this).find('option:selected');
                let attributesJSON = selectedOption.attr('data-attributes');
                let carLocation = selectedOption.attr('data-carlocation')
                let attributes = JSON.parse(attributesJSON);

                if (attributes) { // Assuming DOP refers to location
                    let carSeat = attributes.seat || '';

                    $('#carLocation').text(carLocation);
                    $('#carSeat').text(carSeat);
                } else {
                    $('#carLocation').text('');
                    $('#carSeat').text('');
                }

                updateSubmitButtonState()
            });

            function updateSubmitButtonState() {
                // Check if both conditions are met
                var isDriverVisible = {{ $booking->driver ? 'true' : 'false' }};
                var isCarVisible = {{ $booking->vehicle_type === 1 ? 'true' : 'false' }};

                let selectedStaff = $('.staff-select').val();
                let selectedCar = $('.carSelect').val();

                // Enable the submit button if both conditions are false or both selects are selected
                if ((!isDriverVisible && !isCarVisible)) {
                    $('#submitBtn').prop('disabled', false);
                } else {
                    if (selectedStaff !== null && selectedCar !== null) {
                        // Enable the submit button
                        $('#submitBtn').prop('disabled', false);
                    } else {
                        // Disable the submit button
                        $('#submitBtn').prop('disabled', true);
                    }
                }
            }

            updateSubmitButtonState()
        });
    </script>
@endsection
