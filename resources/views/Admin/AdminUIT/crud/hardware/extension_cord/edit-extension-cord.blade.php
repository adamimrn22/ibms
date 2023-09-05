@extends('layouts.app')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection
@section('layout')
    <x-app-content>
        {{ Breadcrumbs::render('ExtensionCord.edit', $cord) }}

        <x-uit.card title="Edit Extension Cord">
            <x-form :id="'createExtensionCordForm'" :action="route('uit.Extension-cord.update', ['Extension_cord' => $cord->id])" :method="'POST'">
                @method('PUT')
                <x-form.form-group>
                    <x-form.label :for="'extensionCordID'" :title="'Extension Cord ID'" />
                    <x-form.input id="extensionCordID" :value="$cord->name" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'brand'" :title="'Brand Name'" />
                    <x-form.input id="brand" :value="$cord->attribute->brand" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'length'" :title="'Length (M)'" />
                    <x-form.input id="length" :value="$cord->attribute->length" :type="'number'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'price'" :title="'Price (RM)'" />
                    <x-form.input id="price" :value="$cord->price" :type="'number'" />
                </x-form.form-group>


                <x-form.form-group>
                    <x-form.label :for="'location'" :title="'Location'" />
                    <x-form.input id="location" :value="$cord->location" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'DOP'" :title="'Date Of Purchase'" />
                    <input type="text" id="DOP" name="DOP" value="{{ $cord->attribute->DOP }}"
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
                                <option value="{{ $status->id }}" {{ $cord->status == $status ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </div>
                </div>

                <hr>

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
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/ExtensionCord/createExtensionCord.js') }}"></script>
@endsection
