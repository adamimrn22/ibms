@extends('layouts.app')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection

@section('layout')
    <x-app-content>

        {{ Breadcrumbs::render('misc.create') }}

        <x-uit.card title="Add New Miscellaneous">
            <x-form :id="'miscellaneousForm'" :action="route('uit.Miscellaneous.store')" :method="'POST'">

                <x-form.form-group>
                    <x-form.label :for="'assetID'" :title="'ASSET ID'" />
                    <x-form.input :id="'assetID'" :placeholder="'UIT-MSC-D0231'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'name'" :title="'Name'" />
                    <x-form.input :id="'name'" :placeholder="'Name'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'location'" :title="'Location'" />
                    <x-form.input :id="'location'" :placeholder="'Location'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'brand'" :title="'Brand'" />
                    <x-form.input :id="'brand'" :placeholder="'Brand Name'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'model'" :title="'Model'" />
                    <x-form.input :id="'model'" :placeholder="'Model Name'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'price'" :title="'Price'" />
                    <x-form.input :id="'price'" :placeholder="'Price'" :type="'number'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'datepicker'" :title="'Date Of Purchase'" />
                    <input type="text" id="datepicker" name="DOP" value="{{ old('DOP') }}"
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
        flatpickr("#datepicker", {
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
    <script src="{{ asset('js/Admin/Inventory/UIT/Others/miscForm.js') }}"></script>
@endsection
