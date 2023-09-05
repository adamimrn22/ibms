@extends('layouts.userapp')

@section('csslink')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/css/plugins/forms/pickers/form-pickadate.css') }}">
@endsection

@section('section')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"> Permohonan Tempahan Ruang ( {{ $room->name }} ) </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-12">
                    <table width="100%">
                        <thead class="bg-tertiary text-uppercase text-sm" style="background-color: #f3f2f7">
                            <tr>
                                <th colspan="2" class="text-center">Maklumat Pemohon</th>
                            </tr>
                        </thead>
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

                </div>

                <div class="col-md-6 col-12">
                    <table width="100%">
                        <thead class="bg-tertiary text-uppercase text-sm" style="background-color: #f3f2f7">
                            <tr>
                                <th colspan="2" class="text-center">Maklumat Ruang</th>
                            </tr>
                        </thead>
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

            <div class="mt-1"></div>
            <hr>

            <form action="{{ route('TempahRuang.store', ['Ruang' => $room->id]) }}" method="POST">
                @csrf
                <div class="row">
                    <x-form.form-group>
                        <x-form.label :for="'pickadate-book_start'" :title="'Tarikh Mula Guna '" />
                        <input type="text" class="form-control pickadate-book_start picker__input" name="date_start"
                            placeholder="18 June, 2020" readonly="" id="P892070796" aria-haspopup="true"
                            aria-readonly="false" aria-owns="P892070796_root">
                        @error('dateUse')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </x-form.form-group>

                    <x-form.form-group>
                        <x-form.label :for="'pickadate-book_end'" :title="'Tarikh Habis Guna '" />
                        <input type="text" class="form-control pickadate-book_end picker__input" name="date_end"
                            placeholder="18 June, 2020" readonly="" id="P892070796" aria-haspopup="true"
                            aria-readonly="false" aria-owns="P892070796_root">
                        @error('dateUse')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </x-form.form-group>

                    <x-form.form-group>
                        <x-form.label :for="' pickatime-start'" :title="'Waktu Mula Guna '" />
                        <input type="text" id="pt-default" class="form-control pickatime-start  picker__input"
                            name="time_start" placeholder="8:00 AM" readonly="" aria-haspopup="true"
                            aria-readonly="false" aria-owns="pt-default_root">

                        @error('dateUse')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </x-form.form-group>

                    <x-form.form-group>
                        <x-form.label :for="'pickatime-end '" :title="'Waktu Habis Guna '" />
                        <input type="text" id="pt-default" class="form-control pickatime-end  picker__input"
                            name="time_end" placeholder="8:00 AM" readonly="" aria-haspopup="true" aria-readonly="false"
                            aria-owns="pt-default_root">
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
                                <input class="form-check-input" type="checkbox" id="laptop" name="laptop">
                                <label class="form-check-label" for="laptop">Komputer Riba</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="lcd" name="lcd">
                                <label class="form-check-label" for="lcd">LCD</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="tempahanMakanan" name="tempahanMakanan">
                                <label class="form-check-label" for="tempahanMakanan">Tempahan
                                    Makanan</label>
                            </div>
                        </div>
                        <div style="display:none" class="ms-5" id="tempahanMakananWaktu">
                            <p>Waktu </p>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="pagiRadio" name="eatTime"
                                    value="PAGI">
                                <label class="form-check-label" for="pagiRadio">Pagi</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="tengahHariRadio" name="eatTime"
                                    value="TENGAH HARI">
                                <label class="form-check-label" for="tengahHariRadio">Tengah Hari</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="petangRadio" name="eatTime"
                                    value="PETANG">
                                <label class="form-check-label" for="petangRadio">Petang</label>
                            </div>
                        </div>
                    </x-form.form-group>
                </div>
        </div>

        <div class="m-1 d-flex justify-content-end">
            <button type="button" value="0" onclick="goBack()" class="btn btn-outline-danger  ">
                Batal
            </button>
            <button value="1" name="checkOutBtn" class="btn btn-primary ms-1">
                Tempah Ruang
            </button>
        </div>

        </form>
    </div>
@endsection

@section('script')
    <script src="{{ asset('app-asset/vendors/js/pickers/pickadate/legacy.js') }}"></script>
    <script src="{{ asset('app-asset/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('app-asset/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('app-asset/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <script>
        function goBack() {
            window.history.back();
        }

        $(document).ready(function() {

            $("#tempahanMakanan").on("change", function() {
                if ($(this).prop("checked")) {
                    $("#tempahanMakananWaktu").css("display", "inline-block");
                } else {
                    $("#tempahanMakananWaktu").css("display", "none");
                }
            });

            // Initialize the date picker
            $('.pickadate-book_start').pickadate({
                formatSubmit: 'dd/mm/yyyy',
            }).pickadate('picker');

            $('.pickadate-book_end').pickadate({
                formatSubmit: 'dd/mm/yyyy',
            }).pickadate('picker');


            $('.pickatime-start').pickatime({
                interval: 30,
                min: [7, 0], // Minimum time: 8:00 AM
                max: [23, 30] // Maximum time: 11:30 PM
            });

            $('.pickatime-end').pickatime({
                interval: 30,
                min: [7, 0], // Minimum time: 8:00 AM
                max: [23, 30] // Maximum time: 11:30 PM
            }).pickatime('picker');


        });
    </script>
@endsection
