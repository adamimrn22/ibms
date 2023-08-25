<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tempahan Ruang</title>
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

    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/css/plugins/forms/pickers/form-flat-pickr.css') }}">

    <style>
        /* Add this CSS in your <style> or separate CSS file */
        .sticky-column {
            position: sticky;
            top: 20px;
            /* Adjust the value based on your design */
            z-index: 1;
            /* Ensure the sticky element is above other content */
            background-color: white;
            /* Add a background color if needed */
            padding: 10px;
            /* Add padding for spacing */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Add shadow for visual separation */
        }

        .position-lg-relative {
            position: relative;
            overflow: auto;
        }
    </style>
</head>

<body>

    <section>
        <div class="row mx-0" style="min-height: 100vh;">
            <div class="col-12 col-md-4 bg-body-tertiary p-5 position-lg-relative">
                <div>
                    <button class="btn p-0" onclick="goBack()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6" width="16px">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                        </svg>

                        Kembali
                    </button>
                </div>
                <div class=" mt-5">
                    <div id="carouselExampleIndicators" class="carousel slide carousel-fade " data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach ($room->images as $index => $image)
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"
                                    aria-label="Slide {{ $index + 1 }}"></button>
                            @endforeach
                        </div>

                        <div class="carousel-inner rounded">
                            @foreach ($room->images as $index => $image)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/classroom/' . $image->parent_folder . '/' . $image->path) }}"
                                        class="img-fluid d-block w-100" style="min-height: 250px"
                                        alt="Slide {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>


                    <table width="100%" class="mt-1 table">
                        <tr>
                            <th>Bilangan Kerusi</th>
                            <td>{{ $room->attribute->Chair }}</td>
                        </tr>
                        <tr>
                            <th>Bilangan Kerusi Lipat</th>
                            <td>{{ $room->attribute->Foldable_Chair }}</td>
                        </tr>
                        <tr>
                            <th>Bilangan Meja</th>
                            <td>{{ $room->attribute->Table }}</td>
                        </tr>
                        <tr>
                            <th>Bilangan Papan putih</th>
                            <td>{{ $room->attribute->Whiteboard }}</td>
                        </tr>
                        <tr>
                            <th>Bilangan Pemadam</th>
                            <td>{{ $room->attribute->Duster }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            {{-- below is second col --}}
            <div class="col-12 col-md-8 bg-white pt-0 pt-md-5 shadow-lg position-lg-fixed">
                <div>
                    <div class=" mt-0  p-2">
                        <h6>Maklumat Pesanan</h6>
                        <p>Butir Pengguna</p>
                        <table width="100%">
                            <tr>
                                <th>Nama:</th>
                                <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                            </tr>
                            <tr>
                                <th>Staff ID:</th>
                                <td>{{ $user->username }}</td>
                            </tr>
                            <tr>
                                <th>Tarikh:</th>
                                <td>{{ Carbon\Carbon::now()->isoFormat('dddd, MMMM DD, YYYY') }}</td>
                            </tr>
                            <tr>
                                <th>Unit:</th>
                                <td>{{ $user->unit->name }}</td>
                            </tr>
                            <tr>
                                <th>Jawatan:</th>
                                <td>{{ $user->position->name }}</td>
                            </tr>
                        </table>
                        <hr>

                        <form>
                            @csrf

                            <div class="row">
                                <x-form.form-group>
                                    <x-form.label :for="'dateUse'" :title="'Tarikh Guna '" />
                                    <input type="text" id="dateUse" name="dateUse"
                                        class="form-control flatpickr-basic flatpickr-input" placeholder="YYYY-MM-DD">
                                    @error('dateUse')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </x-form.form-group>

                                <x-form.form-group>
                                    <label for="time" class="form-label">
                                        Jumlah Waktu Guna
                                    </label>
                                    <input type="text" id="time" name="time" class="form-control " readonly>
                                </x-form.form-group>
                            </div>

                            <div class="row">

                                <x-form.form-group>
                                    <x-form.label :for="'timeUse'" :title="'Masa Mula Guna'" />
                                    <input type="text" id="timeUse" name="timeUse"
                                        class="form-control flatpickr-basic flatpickr-input" placeholder="YYYY-MM-DD">
                                    @error('dateUse')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </x-form.form-group>

                                <x-form.form-group>
                                    <x-form.label :for="'timeDone'" :title="'Masa Habis Guna'" />
                                    <input type="text" id="timeDone" name="timeDone"
                                        class="form-control flatpickr-basic flatpickr-input" placeholder="YYYY-MM-DD">
                                    @error('dateUse')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </x-form.form-group>

                                <x-form.form-group :colClass="'col-md-12'">
                                    <x-form.label :for="'objective'" :title="'Tujuan'" />
                                    <textarea class="form-control textarea" id="objective" name="objective" rows="3" placeholder="Tujuan Guna"></textarea>
                                </x-form.form-group>

                                <x-form.form-group :colClass="'col-md-12'">
                                    <div style="display:inline-block">
                                        <p>Keperluan</p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="laptop"
                                                name="laptop">
                                            <label class="form-check-label" for="laptop">Komputer Riba</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="lcd"
                                                name="lcd">
                                            <label class="form-check-label" for="lcd">LCD</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="tempahanMakanan"
                                                name="tempahanMakanan">
                                            <label class="form-check-label" for="tempahanMakanan">Tempahan
                                                Makanan</label>
                                        </div>
                                    </div>
                                    <div style="display:none" class="ms-5" id="tempahanMakananWaktu">
                                        <p>Waktu </p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="pagiRadio"
                                                name="eatTime" value="pagi">
                                            <label class="form-check-label" for="pagiRadio">Pagi</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="tengahHariRadio"
                                                name="eatTime" value="tengah hari">
                                            <label class="form-check-label" for="tengahHariRadio">Tengah Hari</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="petangRadio"
                                                name="eatTime" value="pentang">
                                            <label class="form-check-label" for="petangRadio">Petang</label>
                                        </div>
                                    </div>

                                </x-form.form-group>
                            </div>

                            <div class="my-1 d-flex justify-content-end mt-3">
                                <button type="button" value="0" onclick="goBack()"
                                    class="btn btn-outline-danger  ">
                                    Batal
                                </button>
                                <button value="1" name="checkOutBtn" class="btn btn-primary ms-1">
                                    Tempah Ruang
                                </button>
                            </div>
                        </form>
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

    <script src="{{ asset('app-asset/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>

    <script>
        function goBack() {
            window.history.back();
        }

        $(document).ready(function() {

            const timeUseInput = document.getElementById("timeUse");
            const timeDoneInput = document.getElementById("timeDone");
            const timeOutput = document.getElementById("time");

            $("#tempahanMakanan").on("change", function() {
                if ($(this).prop("checked")) {
                    $("#tempahanMakananWaktu").css("display", "inline-block");
                } else {
                    $("#tempahanMakananWaktu").css("display", "none");
                }
            });

            $("#timeUse, #timeDone").on("change", function() {
                const startTime = new Date("2000-01-01 " + timeUseInput.value);
                const endTime = new Date("2000-01-01 " + timeDoneInput.value);
                const timeDiffMinutes = (endTime - startTime) / (1000 * 60); // Difference in minutes

                if (timeDiffMinutes >= 0) {
                    const hours = Math.floor(timeDiffMinutes / 60);
                    const minutes = timeDiffMinutes % 60;
                    timeOutput.value = hours + " jam " + minutes + " minit";
                } else {
                    timeOutput.value = "";
                }
            });

            // Step 1: Attach event listener to date picker
            $("#dateUse").change(function() {
                var selectedDate = $("#dateUse").val();

                // Step 2: Make AJAX call to retrieve disabled time slots
                $.ajax({
                    url: {{ route('TempahRuang.disabled.time.ranges') }},
                    method: "GET",
                    data: {
                        date: selectedDate
                    },
                    success: function(response) {
                        var disabledTimeRanges = response
                            .disabledTimeRanges; // Adjust this based on your server response

                        // Step 3: Disable time slots in time pickers
                        $("#timeUse").flatpickr({
                            enableTime: true,
                            noCalendar: true,
                            dateFormat: "H:i",
                            minTime: "00:00", // Adjust this based on your use case
                            maxTime: "23:59", // Adjust this based on your use case
                            disable: disabledTimeRanges // Array of time ranges to be disabled
                        });

                        $("#timeDone").flatpickr({
                            enableTime: true,
                            noCalendar: true,
                            dateFormat: "H:i",
                            minTime: "00:00", // Adjust this based on your use case
                            maxTime: "23:59", // Adjust this based on your use case
                            disable: disabledTimeRanges // Array of time ranges to be disabled
                        });
                    },
                    error: function() {
                        console.log("Error fetching disabled time ranges.");
                    }
                });
            });
        });
    </script>
</body>

</html>
