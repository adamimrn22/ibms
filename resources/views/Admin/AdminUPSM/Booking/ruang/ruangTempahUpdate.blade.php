@extends('layouts.app')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection
@section('layout')
    <x-app-content>

        <div class="row mt-1" id="basic-table">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Tempahan Ruang</h3>
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
                                    <th scope="row">Ruang Tempahan</th>
                                    <td>{{ $booking->room->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Ditempah Oleh</th>
                                    <td>{{ $booking->user->first_name . ' ' . $booking->user->last_name }}</td>
                                </tr>
                                <tr>
                                    <td>Tarikh</td>
                                    <td class="p-0">
                                        <table class="table ">
                                            <thead>
                                                <th scope="row">Tarikh Mula</th>
                                                <th scope="row">Tarikh Habis</th>
                                            </thead>
                                            <tbody>
                                                <td>
                                                    <span class="badge rounded-pill badge bg-info">
                                                        {{ Carbon\Carbon::parse($booking->date_book_start)->isoFormat('dddd, MMMM DD, YYYY') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge rounded-pill badge bg-info">
                                                        {{ Carbon\Carbon::parse($booking->date_book_end)->isoFormat('dddd, MMMM DD, YYYY') }}
                                                    </span>
                                                </td>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Waktu</td>
                                    <td class="p-0">
                                        <table class="table ">
                                            <thead>
                                                <th scope="row">Waktu Mula</th>
                                                <th scope="row">Waktu Habis</th>
                                            </thead>
                                            <tbody>
                                                <td>
                                                    <span class="badge rounded-pill badge bg-info px-1">
                                                        {{ Carbon\Carbon::parse($booking->time_start)->isoFormat('H:mm A') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge rounded-pill badge bg-info px-1">
                                                        {{ Carbon\Carbon::parse($booking->time_end)->isoFormat('H:mm A') }}
                                                    </span>
                                                </td>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">Jadual Ruang</th>
                                    <td>
                                        <button type="button" class="btn d-inline-flex align-items-center text-primary"
                                            data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-calendar-event" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z">
                                                </path>
                                                <path d="M16 3l0 4"></path>
                                                <path d="M8 3l0 4"></path>
                                                <path d="M4 11l16 0"></path>
                                                <path d="M8 15h2v2h-2z"></path>
                                            </svg>

                                            <span class="ms-1">
                                                Lihat Jadual Ruang
                                            </span>
                                        </button>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">Tujuan</th>
                                    <td style="white-space: normal; overflow-wrap: break-word;">
                                        {{ $booking->detail->objective }}
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Komputer Riba</th>
                                    <td>{{ $booking->detail->laptop ? 'PERLU' : 'TIDAK PERLU' }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">LCD</th>
                                    <td>{{ $booking->detail->lcd ? 'PERLU' : 'TIDAK PERLU' }}</td>
                                </tr>

                                <tr>
                                    <th scope="row">Makanan</th>
                                    <td>{{ $booking->detail->food ? 'PERLU' : 'TIDAK PERLU' }}</td>
                                </tr>

                                @if ($booking->detail->food)
                                    <tr>
                                        <th scope="row">Waktu Makanan</th>
                                        <td>{{ $booking->detail->food_time }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        @if ($booking->status_id === 1)
                            <form action="{{ route('upsm.ruangTempah.update', ['Ruang' => $booking->id]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="my-1 d-flex justify-content-end">
                                    <button value="0" name="updateBtn" class="btn btn-outline-danger">
                                        Reject
                                    </button>
                                    <button value="1" name="updateBtn" class="btn btn-primary ms-1">
                                        Approve
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle"
            style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Jadual Ruang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="GET" action="/test" target="_blank">
                        <div class="modal-body">
                            <table class="table">
                                <tbody>
                                    <tr>

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
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary waves-effect waves-float waves-light" id="filterButton">Lihat
                                Jadual Ruang</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </x-app-content>
@endsection

@section('script')
    <script src="{{ asset('app-asset/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>

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
