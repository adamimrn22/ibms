@extends('layouts.app')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/tables/datatable/dataTables.bootstrap5.min.css') }}">
@endsection

@section('layout')
    <x-app-content>

        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Export Staff Amount</h6>
                <button class="btn btn-link" id="expandButton" data-bs-toggle="collapse"
                    data-bs-target="#cardBodyContent">Expand</button>

            </div>
            <div class="card-body collapse" id="cardBodyContent">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Export Type</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tr>
                        <td>
                            <select class="form-select" id="month">
                                @foreach ($distinctMonths as $month)
                                    <option value="{{ $month }}">
                                        {{ \Carbon\Carbon::createFromDate(null, $month, 1)->format('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-select" id="year">
                                @foreach ($distinctYears as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-select" id="exportType">
                                <option value="excel">Excel</option>
                                <option value="pdf">Pdf</option>
                            </select>
                        </td>
                        <td>
                            <a id="exportLink" class="btn btn-outline-success waves-effect" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-export"
                                    width="14" height="14" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                    <path
                                        d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v5m-5 6h7m-3 -3l3 3l-3 3">
                                    </path>
                                </svg>
                                <span>Export</span>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Reset Staff Amount</h6>
            </div>
            <div class="card-body" id="cardBodyContent">
                <button class="btn btn-outline-primary btn-sm reset-staff-button" data-bs-toggle="modal"
                    data-bs-target="#resetWarning" data-value="0">
                    Update Amount Pensyarah
                </button>
                <button class="btn btn-primary btn-sm ms-1 reset-staff-button" name="resetStaffButton"
                    data-bs-toggle="modal" data-bs-target="#resetWarning" data-value="1">Update
                    Other
                    Unit
                </button>
            </div>
        </div>

        <div class="row mt-1" id="basic-table">
            <div class="col-12">

                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">User A4 Amount</h4>
                    </div>

                    <div class="table-responsive p-1">
                        @include('Admin.AdminUKW.Booking.UserA4Amount.amountTable')
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade text-start modal-warning" id="resetWarning" tabindex="-1" aria-labelledby="myModalLabel140"
            aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel140">Warning!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="resetStaffAmountForm" action="{{ route('ukw.Amount.update') }}" method="POST">
                        <div class="modal-body">
                            <p id="textmodal">
                                Warning! This will reset the <span id="resetType"></span> A4 amount for this month
                            </p>
                            <input type="hidden" id="resetStaffAmount" name="resetStaffAmount">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-warning waves-effect waves-float waves-light" id="ResetBtn" disabled>
                                Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </x-app-content>
@endsection

@section('script')
    <script src="{{ asset('app-asset/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-asset/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            const ajaxSettings = {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            };

            $('#amountUserTable').DataTable();

            $('.reset-staff-button').click(function() {
                let value = $(this).data('value');
                $('#resetStaffAmount').val(value);
            });

            $(document).on('shown.bs.modal', '#resetWarning', function(event) {
                let value = $('#resetStaffAmount').val();
                let resetType = value == 0 ? 'Pensyarah' : 'Staff';

                $('#resetType').text(resetType);
                $('#textmodal').show();
                $('#ResetBtn').prop('disabled', false);
            });

            $('#resetStaffAmountForm').submit(function(e) {
                e.preventDefault();

                let updateButton = $('#resetStaffAmount').val();

                $.ajax({
                    ...ajaxSettings,
                    type: 'PUT',
                    url: $(this).attr('action'),
                    data: {
                        resetStaffButton: updateButton
                    },
                    success: function(response) {
                        toastr.success(response.success, 'Success');
                        $('#amountUserTableBody').html(response.tbody).show();
                        $('#resetWarning').modal('hide');
                    },
                    error: function(xhr) {
                        toastr.error('Error Occured', 'Error');
                        console.error(xhr.statusText)
                    }
                });
            });

            $('#updateStaffAmount').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Collect input data from the table
                var formData = {};
                $('tbody tr').each(function() {
                    var userId = $(this).find('input[name^="user["]').val();
                    formData['user[' + userId + ']'] = userId;
                    $(this).find('input[name^="amount["]').each(function() {
                        formData[$(this).attr('name')] = $(this).val();
                    });
                    $(this).find('input[name^="default_amount["]').each(function() {
                        formData[$(this).attr('name')] = $(this).val();
                    });
                });

                // Submit the form with all data
                $.ajax({
                    ...ajaxSettings,
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    success: function(response) {
                        toastr.success('Staff A4 Amount Updated!', 'Success');
                        $('#amountUserTableBody').html(response.users).show();
                    }
                });
            });

            $("#expandButton").on('click', function() {
                $("#cardBodyContent").collapse('toggle');
            });

            $("#exportLink").click(function(event) {
                event.preventDefault(); // Prevent default link behavior

                // Get selected values from dropdowns
                let selectedMonth = $("#month").val();
                let selectedYear = $("#year").val();
                let exportType = $('#exportType').val();

                // Generate the export URL with the selected values
                let exportUrl = "{{ route('ukw.export.a4Amount') }}";
                exportUrl += "?month=" + selectedMonth + "&year=" + selectedYear + "&exportType=" +
                    exportType;

                // Navigate to the generated URL
                window.open(exportUrl, '_blank');
            });
        });
    </script>
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
