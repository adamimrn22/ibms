@extends('layouts.app')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection
@section('layout')
    <x-app-content>

        {{ Breadcrumbs::render('car.create') }}

        <div class="row mt-1">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Create Kenderaan</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            {{ implode('', $errors->all('<div>:message</div>')) }}
                        @endif
                        <form id="addCarForm" action="{{ route('upsm.Kenderaan.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <x-form.form-group>
                                    <x-form.label :for="'name'" :title="'Name'" />
                                    <x-form.input :id="'name'" />
                                </x-form.form-group>

                                <x-form.form-group>
                                    <x-form.label :for="'location'" :title="'Location'" />
                                    <x-form.input :id="'location'" />
                                </x-form.form-group>

                                <x-form.form-group>
                                    <x-form.label :for="'seat'" :title="'Seat'" />
                                    <x-form.input :id="'seat'" :type="'number'" />
                                </x-form.form-group>

                                <x-form.form-group>
                                    <x-form.label :for="'DOP'" :title="'Date Of Purchase'" />
                                    <input type="text" id="DOP" name="DOP" value="{{ old('DOP') }}"
                                        class="form-control flatpickr-basic flatpickr-input" placeholder="YYYY-MM-DD">
                                    @error('DOP')
                                        <label class="error">{{ $message }}</label>
                                    @enderror
                                </x-form.form-group>

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

                            </div>

                            <hr>

                            <div class="col-12">
                                <x-form.btn class="btn-primary waves-float waves-light" :title="'Submit'"
                                    :type="'submit'" id="submit-btn" />
                                <x-form.btn class="btn-outline-secondary" :title="'Reset'" :type="'reset'" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
    <script src="{{ asset('js/Admin/Inventory/UPSM/Car/addCar.js') }}"></script>
@endsection
