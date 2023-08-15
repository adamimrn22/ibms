@extends('layouts.userapp')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/pickers/flatpickr/flatpickr.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('app-asset/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('layout')
    <div class="row mt-1 m-0">
        <div>
            <div class="card container">
                <div class="card-header">
                    <h3> Permohonan Kenderaan</h3>
                </div>
                <div class="card-body">
                    <p>
                        Permohonan menggunakan kenderaan jabatan sebelum / semasa / selepas waktu pejabat hendaklah mengisi
                        butir-butir
                        di ruangan yang telah dikhaskan dalam borang ini.
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

                    </p>

                    <hr>
                    <form action="" class="form">
                        <div class="row">
                            <x-form.form-group>
                                <x-form.label :for="'datepicker'" :title="'Tarikh Guna ( Pergi )'" />
                                <input type="text" id="datepicker" name="DOP" value="{{ old('DOP') }}"
                                    class="form-control flatpickr-basic flatpickr-input" placeholder="YYYY-MM-DD">
                                @error('DOP')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </x-form.form-group>
                            <x-form.form-group>
                                <x-form.label :for="'datepicker'" :title="'Tarikh Guna ( Balik )'" />
                                <input type="text" id="datepicker" name="DOP" value="{{ old('DOP') }}"
                                    class="form-control flatpickr-basic flatpickr-input" placeholder="YYYY-MM-DD">
                                @error('DOP')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </x-form.form-group>

                            <x-form.form-group>
                                <x-form.label :for="'timePicker'" :title="'Masa Guna  ( Pergi )'" />
                                <input type="text" id="timePicker"
                                    class="form-control flatpickr-time text-start flatpickr-input" placeholder="HH:MM">
                                @error('DOP')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </x-form.form-group>
                            <x-form.form-group>
                                <x-form.label :for="'timePicker'" :title="'Masa Dijangka Selesai  ( Balik )'" />
                                <input type="text" id="timePicker"
                                    class="form-control flatpickr-time text-start flatpickr-input" placeholder="HH:MM">
                                @error('DOP')
                                    <label class="error">{{ $message }}</label>
                                @enderror
                            </x-form.form-group>

                            <hr>

                            <x-form.form-group>
                                <label class="form-label" for="exampleFormControlTextarea1">Destinasi</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Textarea"></textarea>
                            </x-form.form-group>

                            <x-form.form-group>
                                <label class="form-label" for="exampleFormControlTextarea1">Tujuan</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Textarea"></textarea>
                            </x-form.form-group>

                            <hr>

                            <p class="h5">Staff Terlibat</p>

                            <div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Unit</th>
                                            <th>Position</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span class="dynamic-number">1</span>
                                            </td>
                                            <td class="staff-select-cell" width="30%">
                                                <input type="text" name="name[]" class="form-control"
                                                    value="{{ $user->first_name . ' ' . $user->last_name }}" readonly>

                                            </td>
                                            <td>
                                                <input type="text" name="unit[]" class="form-control"
                                                    value="{{ $user->unit->name }}">
                                            </td>
                                            <td>
                                                <input type="text" name="position[]" class="form-control"
                                                    value="{{ $user->position->name }}">
                                            </td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-danger btn-sm delete-row">Delete</button>
                                            </td>
                                        </tr>

                                        <!-- New rows will be added here -->
                                    </tbody>
                                </table>
                                <button type="button" id="addRowBtn" class="btn btn-outline-secondary btn-sm">Add
                                    Rows</button>
                            </div>


                            <div class="my-1">
                                <p>
                                    Saya akui bahawa butir-butir yang dinyatakan di atas adalah benar dan memperakui bahawa
                                    perjalanan di atas adalah
                                    untuk tujuan rasmi dan bertanggungjawab sepenuhnya terhadap perjalanan tersebut
                                </p>
                            </div>

                            <div class="col-12">
                                <x-form.btn class="btn-primary waves-float waves-light" :title="'Submit'"
                                    :type="'submit'" />
                                <x-form.btn class="btn-outline-secondary" :title="'Reset'" :type="'reset'" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @if ($errors->any())
        <script>
            toastr.error('Validation Error', 'Error');
        </script>
    @endif

    <script src="{{ asset('app-asset/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
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
                    <td>
                        <span class="dynamic-number">${rowNum}</span>
                    </td>
                    <td class="staff-select-cell" width="30%">
                        <select name="status[]" class="form-select select2 staff-select">
                            <option value="" selected disabled></option>
                            @foreach ($staffs as $staff)
                                <option value="{{ $staff->id }}" data-unit="{{ $staff->unit->name }}" data-position="{{ $staff->position->name }}">
                                    {{ $staff->first_name . ' ' . $staff->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" name="unit[]" class="form-control unit" readonly>
                    </td>
                    <td>
                        <input type="text" name="position[]" class="form-control position" readonly>
                    </td>
                    <td>
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
        flatpickr("#datepicker", {
            // Options can be customized as per your requirements
            dateFormat: "Y-m-d",
            // Additional options...

            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });

        flatpickr("#timePicker", {
            enableTime: true, // Enable time selection
            noCalendar: true, // Disable calendar
            dateFormat: "H:i", // Format for displaying time
        });
    </script>

    <script src="{{ asset('app-asset/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-asset/js/scripts/forms/form-select2.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Laptop/createLaptop.js') }}"></script>
@endsection
