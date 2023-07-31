@extends('layouts.app')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection
@section('layout')
    <x-app-content>
        {{ Breadcrumbs::render('projector.create') }}

        <x-uit.card title="Add New Projector">
            <x-form :id="'createProjectorForm'" :action="route('uit.Projector.store')" :method="'POST'">

                <x-form.form-group>
                    <x-form.label :for="'projectorID'" :title="'Projector ID'" />
                    <x-form.input id="projectorID" :placeholder="'UIT/USSB-XXX-00-PJT'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'price'" :title="'Price (RM)'" />
                    <x-form.input id="price" :placeholder="'1200.20'" :type="'number'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'projectorBrand'" :title="'Projector Brand'" />
                    @php
                        $brands = ['Epson', 'Sony', 'BenQ', 'Optoma', 'LG', 'ViewSonic', 'Acer', 'Panasonic', 'NEC', 'Hitachi', 'JVC', 'Dell', 'Xiaomi', 'Asus', 'Vivitek', 'Christie', 'InFocus', 'Philips', 'Casio', 'Canon'];
                    @endphp
                    <select style="overflow:hidden" id="projectorBrand" name="projectorBrand"
                        class="select2 form-select form-select ">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand }}">
                                {{ $brand }}
                            </option>
                        @endforeach
                    </select>
                    @error('printerBrand')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'projectorModel'" :title="'Projector Model'" />
                    <x-form.input id="projectorModel" :placeholder="'HP-000'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'location'" :title="'Location'" />
                    <x-form.input id="location" :placeholder="'Location'" />
                </x-form.form-group>

                <hr>

                <p>Projector Specification</p>

                <x-form.form-group>
                    <x-form.label :for="'weight'" :title="'Weight (G)'" />
                    <x-form.input id="weight" :placeholder="'5'" type="number" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'color'" :title="'Colour'" />
                    <x-form.input id="color" :placeholder="'Black'" />
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

        </div>
    </x-app-content>
@endsection


@section('script')
    @if ($errors->any())
        <script>
            toastr.error('Validation Error', 'Error');
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
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Projector/createProjector.js') }}"></script>
@endsection
