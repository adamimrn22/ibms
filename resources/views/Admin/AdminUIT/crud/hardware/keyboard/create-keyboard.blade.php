@extends('layouts.app')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection
@section('layout')
    <x-app-content>
        {{ Breadcrumbs::render('keyboard.create') }}

        <x-uit.card title="Add New Keyboard">
            <x-form :id="'createKeyboardForm'" :action="route('uit.Keyboard.store')" :method="'POST'">

                <x-form.form-group>
                    <x-form.label :for="'keyboardID'" :title="'Keyboard ID'" />
                    <x-form.input id="keyboardID" :placeholder="'UIT/USSB-XXX-00-MS'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'price'" :title="'Price (RM)'" />
                    <x-form.input id="price" :placeholder="'1200.20'" :type="'number'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'keyboardBrand'" :title="'Keyboard Brand'" />
                    @php
                        $brands = ['HP', 'DELL', 'ACER', 'AVF', 'LOGITECH', 'MICROSOFT', 'RAZER', 'STEELSERIES', 'CORSAIR', 'ASUS', 'APPLE', 'LENOVO'];
                    @endphp
                    <select style="overflow:hidden" id="keyboardBrand" name="keyboardBrand"
                        class="select2 form-select form-select ">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand }}">
                                {{ $brand }}
                            </option>
                        @endforeach
                    </select>
                    @error('keyboardBrand')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'keyboardModel'" :title="'Keyboard Model'" />
                    <x-form.input id="keyboardModel" :placeholder="'HP-000'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'location'" :title="'Location'" />
                    <x-form.input id="location" :placeholder="'Location'" />
                </x-form.form-group>

                <hr>

                <p>Mouse Specification</p>

                <x-form.form-group>
                    <x-form.label :for="'keyboardType'" :title="'Type Of Keyboard'" />
                    @php
                        $types = ['Standard Keyboard', 'Gaming Keyboard', 'Mechanical Keyboard', 'Membrane Keyboard', 'Wireless Keyboard', 'Ergonomic Keyboard', 'Compact/Mini Keyboard', 'Virtual Keyboard', 'Flexible Keyboard', 'Backlit Keyboard'];
                        
                    @endphp
                    <select style="overflow:hidden" id="keyboardType" name="keyboardType"
                        class="select2 form-select form-select ">
                        @foreach ($types as $type)
                            <option value="{{ $type }}">
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'connection'" :title="'Type Of Connection'" />
                    @php
                        $connections = ['Bluetooth', 'Wired', 'Wireless'];
                    @endphp

                    <select class="select2 form-select select2-hidden-accessible" id="connection" name="connection[]"
                        multiple data-select2-id="select2-multiple" tabindex="-1" aria-hidden="true">
                        @foreach ($connections as $connection)
                            <option value="{{ $connection }}">{{ $connection }}</option>
                        @endforeach
                        @error('connection')
                            <label class="error">{{ $message }}</label>
                        @enderror
                    </select>

                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'dimension'" :title="'Dimensions '" />
                    <x-form.input id="dimension" :placeholder="'(W X D X H) 4.07 x 2.41 x 1.34 in'" />
                </x-form.form-group>

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
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Keyboard/createKeyboard.js') }}"></script>
@endsection
