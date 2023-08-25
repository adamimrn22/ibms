@extends('layouts.userapp')

@section('csslink')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/pickers/pickadate/pickadate.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/css/plugins/forms/pickers/form-pickadate.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/pickers/pickadate/classic.time.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/pickers/pickadate/default.time.css') }}"> --}}
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
                        <x-form.label :for="'dateUse'" :title="'Tarikh Mula Guna '" />
                        {{-- <input type="text" id="dateUse" name="dateUse" class="form-control flatpickr-basic flatpickr-input"
                        placeholder="YYYY-MM-DD"> --}}
                        <input type="text" class="form-control pickadate-book_start picker__input"
                            placeholder="18 June, 2020" readonly="" id="P892070796" aria-haspopup="true"
                            aria-readonly="false" aria-owns="P892070796_root">
                        @error('dateUse')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </x-form.form-group>

                    <x-form.form-group>
                        <x-form.label :for="'dateUse'" :title="'Tarikh Habis Guna '" />
                        {{-- <input type="text" id="dateUse" name="dateUse" class="form-control flatpickr-basic flatpickr-input"
                        placeholder="YYYY-MM-DD"> --}}
                        <input type="text" class="form-control pickadate-e picker__input" placeholder="18 June, 2020"
                            readonly="" id="P892070796" aria-haspopup="true" aria-readonly="false"
                            aria-owns="P892070796_root">
                        @error('dateUse')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </x-form.form-group>

                    <x-form.form-group>
                        <x-form.label :for="'dateUse'" :title="'Tarikh Habis Guna '" />

                        <input type="text" class="form-control pickadate-book_sftart picker__input"
                            placeholder="18 June, 2020" readonly="" id="P892070796" aria-haspopup="true"
                            aria-readonly="false" aria-owns="P892070796_root">
                        @error('dateUse')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </x-form.form-group>

                    <x-form.form-group>
                        <x-form.label :for="'dateUse'" :title="'Tarikh Habis Guna '" />
                        {{-- <input type="text" id="dateUse" name="dateUse" class="form-control flatpickr-basic flatpickr-input"
                        placeholder="YYYY-MM-DD"> --}}
                        <input type="text" id="pt-default" class="form-control pickatime-start  picker__input"
                            placeholder="8:00 AM" readonly="" aria-haspopup="true" aria-readonly="false"
                            aria-owns="pt-default_root">
                        @error('dateUse')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </x-form.form-group>

                </div>

                <x-form.btn class="btn-primary" :id="'bookBtn'" :title="'Tempah'" :type="'submit'" />
            </form>
            {{--
                <x-form.form-group>
                    <label for="time" class="form-label">
                        Jumlah Waktu Guna
                    </label>
                    <input type="text" id="time" name="time" class="form-control " readonly>
                </x-form.form-group> --}}

            {{-- <input type="text" id="pt-default" class="form-control pickatime-start  picker__input" placeholder="8:00 AM"
                readonly="" aria-haspopup="true" aria-readonly="false" aria-owns="pt-default_root"> --}}
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('app-asset/vendors/js/pickers/pickadate/legacy.js') }}"></script>
    <script src="{{ asset('app-asset/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('app-asset/vendors/js/pickers/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('app-asset/vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <script>
        //     $(document).ready(function() {

        //         const bookedDateRanges = [{
        //                 start: '20/8/2023',
        //                 end: '22/8/2023'
        //             },
        //             {
        //                 start: '25/8/2023',
        //                 end: '28/8/2023'
        //             }
        //         ];
        //         const bookedTimeRanges = [{
        //                 start: '08:00',
        //                 end: '12:00'
        //             },
        //             {
        //                 start: '14:00',
        //                 end: '16:00'
        //             }
        //         ]; // Example booked time ranges

        //         // Initialize the date picker
        //         const datepicker = $('.pickadate-book_start').pickadate({
        //             formatSubmit: 'dd/mm/yyyy',
        //             // ... other options
        //         }).pickadate('picker');

        //         // Initialize the time picker
        //         const timepicker = $('.pickatime-start').pickatime({
        //             interval: 30
        //         }).pickatime('picker');

        //         // Disable booked dates in the date picker
        //         bookedDateRanges.forEach(range => {
        //             const [startDay, startMonth, startYear] = range.start.split('/').map(Number);
        //             const [endDay, endMonth, endYear] = range.end.split('/').map(Number);
        //             datepicker.set('disable', [{
        //                 from: [startYear, startMonth - 1, startDay],
        //                 to: [endYear, endMonth - 1, endDay]
        //             }]);
        //         });

        //         // Disable booked time ranges in the time picker
        //         bookedTimeRanges.forEach(range => {
        //             const [startHour, startMinute] = range.start.split(':').map(Number);
        //             const [endHour, endMinute] = range.end.split(':').map(Number);
        //             timepicker.set('disable', [{
        //                     from: [0, 0],
        //                     to: [startHour, startMinute - 1]
        //                 },
        //                 {
        //                     from: [endHour, endMinute + 1],
        //                     to: [23, 59]
        //                 }
        //             ]);
        //         });

        //     });
        //
    </script>
@endsection
