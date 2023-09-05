@extends('layouts.app')

@section('layout')
    <x-app-content>

        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Export User Amount</h6>
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

        <div class="row mt-1" id="basic-table">
            <div class="col-12">

                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title">User A4 Amount</h4>
                    </div>

                    <div class="table-responsive">
                        @include('Admin.AdminUKW.Booking.UserA4Amount.amountTable')
                    </div>
                </div>
            </div>
        </div>

    </x-app-content>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
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
