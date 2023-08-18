@extends('layouts.app')

@section('csslink')
@endsection
@section('layout')
    <x-app-content>

        <div class="row mt-1">
            <form action="{{ route('ukw.BookingAlatTulis.update', ['BookingAlatTuli' => $booking->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> Boooking Alat Tulis</h3>
                        </div>
                        <div class="card-body">
                            <p class="card-text mb-1">
                                Check the checkbox for approve and leave uncheck for reject
                            </p>
                            <div class="my-2">
                                <table width="100%" border="1">
                                    <thead>
                                        <tr align="center">
                                            <td>BOOKING ID</td>
                                            <th>{{ $booking->reference }}</th>

                                            <td>STAFF ID</td>
                                            <th>{{ $booking->user->username }}</th>

                                            <td>Full Name</td>
                                            <th>{{ $booking->user->first_name . ' ' . $booking->user->last_name }}
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th width="2%">No.</th>
                                        <th width="5%" class="text-center">
                                            <div class="form-check form-check-success">
                                                <input class="form-check-input" type="checkbox" id="approveAll">
                                                <label class="form-check-label" for="approveAll">Approve</label>
                                            </div>
                                        <th>Name</th>
                                        <th width="5%" class="text-center">Quantity</th>
                                        <th width="5%" class="text-center">Catatan</th>
                                    </tr>
                                </thead>
                                @foreach ($booking->inventories as $index => $inventory)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="form-check form-check-success">
                                                <input type="hidden" name="booking[{{ $inventory->id }}]"
                                                    value="unchecked">
                                                <input class="form-check-input approveCheckbox" type="checkbox"
                                                    id="approval" name="booking[{{ $inventory->id }}]" value="approved">
                                                <label class="form-check-label">Approve</label>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $inventory->name }}
                                            <input type="hidden" name="subcategory[{{ $inventory->id }}]"
                                                value="{{ $inventory->subcategory_id }}">
                                        </td>
                                        @php
                                            if ($inventory->pivot->quantity > $inventory->current_quantity) {
                                                $inventory->pivot->quantity = $inventory->current_quantity;
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
                                                            <line x1="5" y1="12" x2="19"
                                                                y2="12">
                                                            </line>
                                                        </svg>
                                                    </button></span>
                                                <input type="number" class="touchspin form-control"
                                                    value="{{ $inventory->pivot->quantity }}"
                                                    name="approvedQuantity[{{ $inventory->id }}]"
                                                    max="{{ $inventory->current_quantity }}">
                                                <span class="input-group-btn bootstrap-touchspin-injected">
                                                    <button class="btn btn-primary bootstrap-touchspin-up"
                                                        type="button"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-plus">
                                                            <line x1="12" y1="5" x2="12"
                                                                y2="19">
                                                            </line>
                                                            <line x1="5" y1="12" x2="19"
                                                                y2="12">
                                                            </line>
                                                        </svg></button></span>
                                            </div>
                                        </td>
                                        <td width="25%">
                                            <input type="text" class=" form-control"
                                                name="remarkNotes[{{ $inventory->id }}]">
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <hr>

                            <div class="mb-1">
                                <label class="form-label" for="remark">Remarks ( Untuk Email )</label>
                                <textarea class="form-control" id="remark" name="remark" rows="3" placeholder="Remarks for not approve"></textarea>
                            </div>

                            <div class="d-flex flex-row-reverse p-2">
                                <button id="submitBtn" type="submit" name="updateBooking" value="1"
                                    class="btn btn-success waves-effect waves-float waves-light mx-1"
                                    disabled>Approve</button>
                                <button type="submit" name="updateBooking" value="0"
                                    class="btn btn-outline-danger waves-effect">Reject All</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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

    <script>
        $(document).ready(function() {
            function updateApproveButtonState() {
                var anyCheckboxChecked = $('.approveCheckbox:checked').length > 0;
                $('#submitBtn').prop('disabled', !anyCheckboxChecked);
            }

            // Checkbox change event
            $('.approveCheckbox').on('change', function() {
                updateApproveButtonState();
            });

            // "Check All" button click event
            $('#approveAll').click(function() {
                $('.approveCheckbox').prop('checked', this.checked);
                updateApproveButtonState(); // Update the button state
            });

            $('.bootstrap-touchspin-up').click(function() {
                var input = $(this).closest('.input-group').find('.touchspin');
                var currentValue = parseInt(input.val());
                var maxQuantity = parseInt(input.attr('max'));

                if (currentValue < maxQuantity) {
                    input.val(currentValue + 1);
                }
            });

            $('.bootstrap-touchspin-down').click(function() {
                var input = $(this).closest('.input-group').find('.touchspin');
                var currentValue = parseInt(input.val());

                if (currentValue > 1) {
                    input.val(currentValue - 1);
                }
            });

            updateApproveButtonState();
        });
    </script>
@endsection
