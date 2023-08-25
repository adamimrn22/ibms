@extends('layouts.userapp')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection
@section('section')
    <div class="mt-1">

        <div class="card">
            <div class="card-body">

                <div style="overflow: auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="5" class="text-center">Lihat Jadual Tempahan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th width="25%">Tarikh</th>
                                <td width="25%">
                                    <label class="form-label">Dari</label>
                                    <input class="flatpickr-basic flatpickr-input" type="text" name="dateFrom"
                                        id="dateFrom">
                                </td>
                                <td width="25%">
                                    <label class="form-label ms-2">Hingga</label>
                                    <input class="ms-2 flatpickr-basic flatpickr-input" type="text" name="dateTo"
                                        id="dateTo">
                                </td>
                                <td width="25%" align="right">
                                    <button class="btn btn-gradient-primary btn-sm mt-2" id="filterButton">
                                        Lihat jadual ruang
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Tempah Ruang</h3>
            </div>

            <div class="card-body text-justify">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Ruang</th>
                            <th>Lokasi</th>
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rooms as $room)
                            <tr>
                                <td>
                                    <span class="fw-bold">{{ $room->name }}</span>
                                </td>
                                <td>{{ $room->location }}</td>
                                <td align="right">
                                    <a href="{{ route('TempahRuang.booking', ['Ruang' => Crypt::encryptString($room->id)]) }}"
                                        class="btn btn-primary ">
                                        Tempah Ruang
                                    </a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td>Tiada ruang yang available</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('app-asset/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script>
        flatpickr("#dateFrom", {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });

        flatpickr("#dateTo", {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });

        document.getElementById('filterButton').addEventListener('click', function() {
            const dateFrom = document.getElementById('dateFrom').value;
            const dateTo = document.getElementById('dateTo').value;

            // Open bookings page in a new tab with date range query parameters
            const url = `/User/Booking/UPSM/Ruang/Tempahan/RuangTempah?date_from=${dateFrom}&date_to=${dateTo}`;
            window.open(url, '_blank');
        });
    </script>
@endsection
