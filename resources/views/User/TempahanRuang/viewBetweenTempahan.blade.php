<!DOCTYPE html>
<html lang="en">


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME') }}</title>
    <meta name="base-url" content="{{ url('/') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/vendors/css/extensions/toastr.min.css') }}">
    <!-- END: Vendor CSS-->


    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-asset/vendors/js/tables/datatable/buttons.bootstrap5.min.js') }}">
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/components.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-asset/css/core/menu/menu-types/horizontal-menu.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-asset/css/plugins/extensions/ext-component-toastr.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/style.css') }}">
    <!-- END: Custom CSS-->


</head>

<body style="background-color: #fff">
    <div>
        <h1 class="h4 text-center  py-2">
            Jadual Ruang Tempahan <br> ( {{ $dateFrom }} hingga {{ $dateTo }} )
        </h1>
    </div>

    <div class="d-flex  justify-content-start px-3">
        <div>
            <label class="form-label" for="basicSelect">Nama Ruang</label>

            @role('User')
                <form method="get" action="{{ route('TempahRuang.view') . '' }}">
                @endrole
                @role('Admin UPSM')
                    <form method="get" action="{{ route('upsm.ruangTempah.view') . '' }}">
                    @endrole
                    <div class="d-flex">
                        <input type="hidden" name="date_from" value="{{ $dateFrom }}">
                        <input type="hidden" name="date_to" value="{{ $dateTo }}">
                        <select class="form-select" id="roomTypeFilter" name="room_type">
                            <option value="">Semua Ruang</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>
                        <div class="ms-1">
                            <button class="btn btn-outline-primary waves-effect">
                                Filter
                            </button>
                        </div>
                    </div>
                </form>
        </div>
    </div>

    <div class="p-3 pt-1">
        <table class="table" border="1">
            <thead>
                <tr>
                    <th>Bil</th>
                    <th>ID Tempahan</th>
                    <th>Nama Ruang</th>
                    <th>Tarikh Mula</th>
                    <th>Tarikh Habis</th>
                    <th>Waktu Mula</th>
                    <th>Waktu Habis</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $index => $booking)
                    <tr>
                        <td>{{ $bookings->firstItem() + $index }}</td>
                        <td>{{ $booking->reference }}</td>
                        <td>
                            <b>
                                {{ $booking->room->name }}
                            </b>
                        </td>
                        <td>
                            <span class="badge rounded-pill badge bg-success">
                                {{ Carbon\Carbon::parse($booking->date_book_start)->isoFormat('dddd, MMMM DD, YYYY') }}
                            </span>
                        </td>
                        <td>
                            <span class="badge rounded-pill badge bg-warning">
                                {{ Carbon\Carbon::parse($booking->date_book_end)->isoFormat('dddd, MMMM DD, YYYY') }}
                            </span>
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($booking->time_start)->translatedFormat('h:i A') }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($booking->time_end)->translatedFormat('h:i A') }}
                        </td>
                        <!-- Add more columns for other fields as needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>


        <div class="d-flex justify-content-between align-items-baseline mx-0 row mb-1 p-1" id="Pagination">
            <div class="col-sm-12 col-md-6">
                <div role="status" aria-live="polite">
                    Menunjukkan {{ $bookings->firstItem() }} hingga {{ $bookings->lastItem() }} daripada
                    {{ $bookings->total() }} entri
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end mt-3">
                        @if ($bookings->lastPage() > 1)
                            <li class="page-item first {{ $bookings->currentPage() == 1 ? 'disabled' : '' }}">
                                <a class="page-link"
                                    href="{{ $bookings->appends(['date_from' => $dateFrom, 'date_to' => $dateTo])->url(1) }}"
                                    aria-label="Pertama">
                                    <span aria-hidden="true">Pertama</span>
                                </a>
                            </li>
                            <li class="page-item {{ $bookings->currentPage() == 1 ? 'disabled' : '' }}">
                                <a class="page-link"
                                    href="{{ $bookings->appends(['date_from' => $dateFrom, 'date_to' => $dateTo])->previousPageUrl() }}"
                                    aria-label="Sebelumnya">
                                    <span aria-hidden="true">« Sebelumnya</span>
                                </a>
                            </li>
                            @for ($i = max(1, $bookings->currentPage() - 2); $i <= min($bookings->lastPage(), $bookings->currentPage() + 2); $i++)
                                <li class="page-item {{ $i == $bookings->currentPage() ? 'active' : '' }}">
                                    <a class="page-link"
                                        href="{{ $bookings->appends(['date_from' => $dateFrom, 'date_to' => $dateTo])->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li
                                class="page-item {{ $bookings->currentPage() == $bookings->lastPage() ? 'disabled' : '' }}">
                                <a class="page-link"
                                    href="{{ $bookings->appends(['date_from' => $dateFrom, 'date_to' => $dateTo])->nextPageUrl() }}"
                                    aria-label="Seterusnya">
                                    <span aria-hidden="true">Seterusnya »</span>
                                </a>
                            </li>
                            <li
                                class="page-item last {{ $bookings->currentPage() == $bookings->lastPage() ? 'disabled' : '' }}">
                                <a class="page-link"
                                    href="{{ $bookings->appends(['date_from' => $dateFrom, 'date_to' => $dateTo])->url($bookings->lastPage()) }}"
                                    aria-label="Akhir">
                                    <span aria-hidden="true">Akhir</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>


    </div>
</body>

</html>
