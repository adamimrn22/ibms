<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="index.css">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/vendors/css/extensions/toastr.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/components.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/css/core/menu/menu-types/horizontal-menu.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-asset/css/plugins/extensions/ext-component-toastr.css') }}">
</head>

<body>

    <section>
        <div class="row mx-0" style="min-height: 100vh;">
            <div class="col-12 col-md-8 bg-body-tertiary p-5">
                <div>
                    <a href="alatanTulis.html">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6" width="16px">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                        </svg>

                        Kembali
                    </a>
                </div>
                <div class=" mt-5">
                    <table width="100%">
                        <thead class="border-bottom">
                            <tr>
                                <th class="d-none d-sm-block"></th>
                                <th>
                                    <div class="py-2 text-uppercase">Nama Alatan Tulis</div>
                                </th>
                                <th class="text-end">
                                    <div class="py-2 text-uppercase">Kuantiti</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="p-3">
                            <tr class="border-bottom mb-1">
                                <td class="d-none d-sm-block">
                                    <img src="{{ asset('img/car.jpg') }}" class="rounded-2 my-3" height="100px"
                                        alt="">
                                </td>
                                <td>Item 1</td>
                                <td class="text-end">3</td>
                            </tr>
                            <tr class="border-bottom mb-1">
                                <td class="d-none d-sm-block">
                                    <img src="car.jpg" class="rounded-2 my-3" height="100px" alt="">
                                </td>
                                <td>Item 1</td>
                                <td class="text-end">3</td>
                            </tr>


                            <tr align="end">
                                <th class="d-none d-sm-block"></th>
                                <th>Jumlah Kuantiti</th>
                                <td>2x</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-md-4 bg-white pt-0 pt-md-5 shadow-lg">
                <div>
                    <div class="p-3 mt-0 mt-md-5">
                        <h6>Maklumat Pesanan</h6>
                        <p>Butir Pengguna</p>
                        <table width="100%">
                            <tr>
                                <th>Nama:</th>
                                <td>Bill Gates</td>
                            </tr>
                            <tr>
                                <th>Staff ID:</th>
                                <td>SC0122</td>
                            </tr>
                            <tr>
                                <th>Tarikj:</th>
                                <td>Tuesday, August 08, 2023</td>
                            </tr>
                            <tr>
                                <th>Unit:</th>
                                <td>Pembangunan Sistem</td>
                            </tr>
                            <tr>
                                <th>Jawatan:</th>
                                <td>Penolong Eksekutif</td>
                            </tr>
                        </table>
                        <hr>

                        <p>Jumlah Kesemua Kuantiti Pinjaman</p>
                        <p class="text-end h3">2x</p>

                        <hr>

                        <button class="btn btn-primary w-100">
                            Pesan Alatan Tulis
                        </button>


                        <button class="btn btn-danger w-100 mt-1">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-asset/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-asset/vendors/js/ui/jquery.sticky.js') }}"></script>
    <script src="{{ asset('app-asset/vendors/js/extensions/toastr.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-asset/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-asset/js/core/app.js') }}"></script>
</body>

</html>
