@extends('layouts.userapp')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <style>
        .textarea {
            resize: none;
        }
    </style>
@endsection
@section('section')
    <div class="mt-1">
        <div class="card">
            <div class="card-header">
                <h3> Permohonan Kenderaan</h3>
            </div>

            <div class="card-body text-justify">
                <p class="" style="text-align: justify">
                    Permohonan menggunakan kenderaan jabatan sebelum / semasa / selepas waktu pejabat hendaklah mengisi
                    butir-butir di ruangan yang telah dikhaskan dalam borang ini.
                </p>
                <ol>
                    <li>
                        Permohonan mestilah diserahkan ke Unit Pentadbiran, Bhg. Pengurusan selewat-lewatnya 24 JAM
                        sebelum tarikh
                        penggunaan.
                    </li>
                    <li>
                        Semua permohonan HENDAKLAH diluluskan melalui Ketua Jabatan / Ketua Bahagian / Ketua Unit.
                    </li>
                    <li>
                        Permohonan akan dipertimbangkan tertakluk kepada kekosongan kenderaan dan juga pemandu.
                    </li>
                </ol>

                <hr>

                <form id="permohonanKereta" action="{{ route('TempahKereta.store') }}" class="form" method="POST">
                    @csrf
                    <div class="row">

                        <x-form.form-group>
                            <x-form.label :for="'dateGo'" :title="'Tarikh Guna ( Pergi )'" />
                            <input type="text" id="dateGo" name="dateGo"
                                class="form-control flatpickr-basic flatpickr-input" placeholder="YYYY-MM-DD">
                            @error('dateGo')
                                <label class="error">{{ $message }}</label>
                            @enderror
                        </x-form.form-group>

                        <x-form.form-group>
                            <x-form.label :for="'dateReturn'" :title="'Tarikh Balik ( Pergi )'" />
                            <input type="text" id="dateReturn" name="dateReturn"
                                class="form-control flatpickr-basic flatpickr-input" placeholder="YYYY-MM-DD">
                            @error('dateReturn')
                                <label class="error">{{ $message }}</label>
                            @enderror
                        </x-form.form-group>

                        <x-form.form-group>
                            <x-form.label :for="'timeGo'" :title="'Waktu Pergi'" />
                            <input type="text" id="timeGo" name="timeGo"
                                class="form-control flatpickr-time text-start flatpickr-input bg-white" placeholder="HH:MM">
                            @error('timeGo')
                                <label class="error">{{ $message }}</label>
                            @enderror
                        </x-form.form-group>

                        <x-form.form-group>
                            <x-form.label :for="'timeReturn'" :title="'Waktu Balik'" />
                            <input type="text" id="timeReturn" name="timeReturn"
                                class="form-control flatpickr-time text-start flatpickr-input bg-white" placeholder="HH:MM">
                            @error('timeReturn')
                                <label class="error">{{ $message }}</label>
                            @enderror
                        </x-form.form-group>

                        <x-form.form-group>
                            <label class="form-label" for="destination">Destinasi</label>
                            <textarea class="form-control textarea" id="destination" name="destination" rows="3"
                                placeholder="Destinasi Pergi"></textarea>
                        </x-form.form-group>

                        <x-form.form-group>
                            <label class="form-label" for="objective">Tujuan</label>
                            <textarea class="form-control textarea" id="objective" name="objective" rows="3" placeholder="Tujuan Pergi"></textarea>
                        </x-form.form-group>

                        <x-form.form-group>
                            <div class="my-1">
                                <p>Jenis Kenderaan</p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="carCheckbox" name="vehicle"
                                        value="1">
                                    <label class="form-check-label" for="carCheckbox">Kereta</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="busCheckbox" name="vehicle"
                                        value="0">
                                    <label class="form-check-label" for="busCheckbox">Bas</label>
                                </div>
                            </div>
                        </x-form.form-group>

                        <x-form.form-group>
                            <div class="my-1">
                                <p>Tanda jika perlukan pemandu</p>
                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="driver" value="0">
                                    <input class="form-check-input" type="checkbox" id="driver" name="driver"
                                        value="1">
                                    <label class="form-check-label" for="driver">Pemandu</label>
                                </div>
                            </div>
                        </x-form.form-group>
                        <hr>

                        <p class="h5">Staff Terlibat</p>

                        <div class="p-1" style="overflow: auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Unit</th>
                                        <th>Jawatan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td width="10%">
                                            <span class="dynamic-number">1</span>
                                        </td>
                                        <td class="staff-select-cell" width="30%">
                                            <input type="hidden" name="name[]" value="{{ $user->id }}">
                                            <span
                                                class="form-control">{{ $user->first_name . ' ' . $user->last_name }}</span>

                                        </td>
                                        <td width="30%">
                                            <input type="text" class="form-control" value="{{ $user->unit->name }}"
                                                readonly>
                                        </td>
                                        <td width="20%">
                                            <input type="text" class="form-control"
                                                value="{{ $user->position->name }}" readonly>
                                        </td>
                                        <td width="10%">
                                            <button type="button"
                                                class="btn btn-danger btn-sm delete-row">Delete</button>
                                        </td>
                                    </tr>

                                    <!-- New rows will be added here -->
                                </tbody>
                            </table>
                            <button type="button" id="addRowBtn" class="btn btn-outline-secondary btn-sm">Tambah
                                Staff</button>
                        </div>


                        <div class="my-1">
                            <p>
                                Saya akui bahawa butir-butir yang dinyatakan di atas adalah benar dan memperakui bahawa
                                perjalanan di atas adalah
                                untuk tujuan rasmi dan bertanggungjawab sepenuhnya terhadap perjalanan tersebut
                            </p>
                        </div>

                        <div class="col-12">
                            <x-form.btn class="btn-primary waves-float waves-light" :title="'Tempah'" :type="'submit'" />
                            <x-form.btn class="btn-outline-secondary" :title="'Reset'" :type="'reset'" />
                        </div>

                    </div>

                </form>


            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('app-asset/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('app-asset/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-asset/js/scripts/forms/form-select2.js') }}"></script>
    <script src="{{ asset('app-asset/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/User/Kendereaan/tempahanKenderaan.js') }}"></script>
    <script>
        $(document).ready(function() {
            let rowNum = 1; // Initialize row number

            // Function to update dynamic numbers
            function updateDynamicNumbers() {
                $('.dynamic-number').each(function(index) {
                    $(this).text(index + 1);
                });
            }

            // Handle "Add Row" button click
            $('#addRowBtn').click(function() {
                rowNum++;

                // Create a new row HTML
                let newRowHtml = `
                <tr>
                    <td width="10%">
                        <span class="dynamic-number">${rowNum}</span>
                    </td>
                    <td class="staff-select-cell" width="30%">
                        <select name="name[]" class="form-select select2 staff-select">
                            <option value="" selected disabled></option>
                            @foreach ($staffs as $staff)
                                <option value="{{ $staff->id }}" data-unit="{{ $staff->unit->name }}" data-position="{{ $staff->position->name }}">
                                    {{ $staff->first_name . ' ' . $staff->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td width="30%">
                        <input type="text"class="form-control unit" readonly>
                    </td>
                    <td width="20%">
                        <input type="text"class="form-control position" readonly>
                    </td>
                    <td width="10%">
                        <button type="button" class="btn btn-danger btn-sm delete-row">Delete</button>
                    </td>
                </tr>
            `;

                // Append the new row HTML to the table
                $('.table tbody').append(newRowHtml);

                // Initialize Select2 for the new select input
                initializeSelect2($('.table tbody tr:last .select2'));

                // Update dynamic numbers
                updateDynamicNumbers();

                // Show the delete button for new rows
                updateDeleteButtonsVisibility();
            });

            // Handle row deletion
            $(document).on('click', '.delete-row', function() {
                if ($('.table tbody tr').length > 1) { // Check if there is more than one row
                    $(this).closest('tr').remove();
                    updateDynamicNumbers(); // Update dynamic numbers after deletion

                    // Update the visibility of delete buttons
                    updateDeleteButtonsVisibility();
                }
            });

            // Handle staff selection change
            $(document).on('change', '.staff-select', function() {
                const selectedOption = $(this).find('option:selected');
                const unit = selectedOption.data('unit');
                const position = selectedOption.data('position');

                $(this).closest('tr').find('.unit').val(unit);
                $(this).closest('tr').find('.position').val(position);

                // Remove the selected option from other Select2 instances
                $('.staff-select option[value="' + selectedOption.val() + '"]').not(selectedOption)
                    .remove();
            });

            // Function to update the visibility of delete buttons
            function updateDeleteButtonsVisibility() {
                $('.delete-row').each(function(index) {
                    if (index === 0) { // First row
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            }

            // Initialize Select2 for the initial select input
            function initializeSelect2($select) {
                $select.select2();
            }

            // Initialize Select2 for the initial select inputs
            $('.select2').each(function() {
                initializeSelect2($(this));
            });

            // Hide the delete button for the first row initially
            updateDeleteButtonsVisibility();
        });

        // Initialize Flatpickr
        flatpickr("#dateGo", {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });

        flatpickr("#dateReturn", {
            dateFormat: "Y-m-d",
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });

        flatpickr("#timeGo", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });

        flatpickr("#timeReturn", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });
    </script>
    @if ($errors->any())
        <script>
            toastr.error('Validation Error', 'Error');
        </script>
    @endif
@endsection
