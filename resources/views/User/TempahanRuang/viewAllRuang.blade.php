@extends('layouts.userapp')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/forms/select/select2.min.css') }}">
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
                                <form method="GET" action="/jadualRuang" target="_blank">
                                    @csrf
                                    <td>
                                        <select style="overflow:hidden" id="roomTypeFilter" name="room_type"
                                            class="select2 form-select form-select ">
                                            @foreach ($rooms as $roomSelect)
                                                <option value="{{ $roomSelect->id }}|{{ $roomSelect->name }}">
                                                    {{ $roomSelect->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td width="25%" align="right">
                                        <button class="btn btn-gradient-primary btn-sm  " id="filterButton">
                                            Lihat jadual ruang
                                        </button>
                                    </td>
                                </form>
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
    </script>
@endsection
