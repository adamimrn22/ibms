@extends('layouts.app')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection
@section('layout')
    <x-app-content>

        {{ Breadcrumbs::render('cable.create') }}

        <x-uit.card title="Add New Cable">
            <x-form :id="'createCableForm'" :action="route('uit.Cable.store')" :method="'POST'">

                <x-form.form-group>
                    <x-form.label :for="'cableID'" :title="'Cable ID'" />
                    <x-form.input :id="'cableID'" :placeholder="'UIT/USSB-XXX-00-CBL'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'price'" :title="'Price (RM)'" />
                    <x-form.input :id="'price'" :placeholder="'1200.20'" :type="'number'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'cableName'" :title="'Cable Name'" />
                    <x-form.input :id="'cableName'" :placeholder="'Cat 5 Lan Cable'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'location'" :title="'Location'" />
                    <x-form.input :id="'location'" :placeholder="'Location'" />
                </x-form.form-group>

                <hr>

                <p>Cable Specification</p>

                <div class="col-md-6 col-12">
                    <div class="mb-1">
                        <x-form.label :for="'subcategory_id'" :title="'Category'" />
                        <select style="overflow:hidden" id="subcategory_id" name="subcategory_id"
                            class="select2 form-select form-select ">
                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id . '|' . $subcategory->subcategory_name }}">
                                    {{ $subcategory->subcategory_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('subcategory_id')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <x-form.form-group>
                    <x-form.label :for="'meter'" :title="'Length (Meter) '" />
                    <x-form.input :id="'meter'" :placeholder="'5'" type="number" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'DOP'" :title="'Date Of Purchase'" />
                    <input type="text" id="DOP" name="DOP" value="{{ old('DOP') }}"
                        class="form-control flatpickr-basic flatpickr-input" placeholder="YYYY-MM-DD">
                    @error('DOP')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </x-form.form-group>

                <hr>

                <div class="col-md-6 col-12">
                    <div class="mb-1">
                        <x-form.label :for="'status'" :title="'Status'" />
                        <select style="overflow:hidden" id="status" name="status"
                            class="select2 form-select form-select ">
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}">
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <x-form.btn class="btn-primary waves-float waves-light" :title="'Submit'" :type="'submit'" />
                    <x-form.btn class="btn-outline-secondary" :title="'Reset'" :type="'reset'" />
                </div>
            </x-form>
        </x-uit.card>

    </x-app-content>
@endsection

@section('script')
    @if ($errors->any())
        <script>
            toastr.error('Validation Error', 'Error');
        </script>
    @endif

    @if (session('error'))
        <script>
            toastr.error("{{ session('error') }}", 'Error');
        </script>
    @endif

    <script src="{{ asset('app-asset/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script>
        // Initialize Flatpickr
        flatpickr("#DOP", {
            // Options can be customized as per your requirements
            dateFormat: "Y-m-d",
            // Additional options...

            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
        });
    </script>

    <script src="{{ asset('app-asset/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-asset/js/scripts/forms/form-select2.js') }}"></script>
    <script src="{{ asset('js/Admin/Inventory/UIT/Cable/createCable.js') }}"></script>
@endsection
