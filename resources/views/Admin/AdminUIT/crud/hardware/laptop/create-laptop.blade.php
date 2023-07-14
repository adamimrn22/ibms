@extends('layouts.app')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection
@section('layout')
    <x-app-content>

        {{ Breadcrumbs::render('laptop.create') }}

        <x-uit.card title="Add New Laptop">
            <x-form :id="'createLaptopForm'" :action="route('uit.Laptop.store')" :method="'POST'">
                <x-form.form-group>
                    <x-form.label :for="'laptopID'" :title="'Laptop ID'" />
                    <x-form.input id="laptopID" :placeholder="'UIT/USSB-XXX-00-XXX'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'laptopModel'" :title="'Laptop Model'" />
                    <x-form.input id="laptopModel" :placeholder="'HP-000'" />
                </x-form.form-group>

                <x-form.form-group>
                    <label class="form-label" for="price">Price (RM)</label>
                    <x-form.input id="price" :placeholder="'1800.00'" :type="'number'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'laptopBrand'" :title="'Laptop Brand'" />
                    @php
                        $brands = ['Asus', 'HP', 'Lenovo', 'Acer', 'MSI', 'LG', 'Samsung', 'Gigabyte', 'Dell', 'Microsoft', 'Medion', 'Chuwi', 'Teclast', 'Razer', 'Apple', 'Huawei', 'Primux', 'Jumper', 'Bmax', 'Winnovo', 'Alienware', 'VANT', 'Innjoo', 'KUU', 'HONOR', 'Toshiba', 'OMEN', 'XIDU', 'PRIXTON', 'Evoo', 'DeepGaming', 'Schneider', 'TOPOSH', 'Xiaomi', 'Ubrand', 'Panasonic', 'IProda', 'AWOW', 'Mytrix', 'JETWING', 'VUCATIMES', 'Schenker', 'BiTECOOL', 'ACEPC', 'Gateway', 'MAINGEAR', 'Google', 'Fancy Cherry', 'GPD', 'DaySky', 'Jepssen'];
                    @endphp
                    <select style="overflow:hidden" id="laptopBrand" name="laptopBrand"
                        class="select2 form-select form-select ">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand }}">
                                {{ $brand }}
                            </option>
                        @endforeach
                    </select>
                    @error('brand')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'location'" :title="'Location'" />
                    <x-form.input id="location" :placeholder="'Location'" />
                </x-form.form-group>

                <hr>

                <p>Laptop Specification</p>

                <x-form.form-group>
                    <x-form.label :for="'display'" :title="'Display'" />
                    <x-form.input id="display" :placeholder="'14 (1920 x 1080)'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'processor'" :title="'Processor'" />
                    <x-form.input id="processor" :placeholder="'Intel i5-0000'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'ram'" :title="'RAM'" />
                    <x-form.input id="ram" :placeholder="'4GB DDR3'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'OS'" :title="'Operating System'" />
                    <x-form.input id="OS" :placeholder="'Windows 10'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'gpu'" :title="'Graphic Card'" />
                    <x-form.input id="gpu" :placeholder="'RTX 3060'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'datepicker'" :title="'Date Of Purchase'" />
                    <input type="text" id="datepicker" name="DOP" value="{{ old('DOP') }}"
                        class="form-control flatpickr-basic flatpickr-input" placeholder="YYYY-MM-DD">
                </x-form.form-group>


                <x-form.label :for="'storage[]'" :title="'Storage Name'" />
                <div>
                    <div id="inputContainer">
                        <div class="row d-flex align-items-center mb-1">
                            <div class="col-md-6 col-12">
                                <x-form.input :id="'storage[]'" :placeholder="'HDD SEAGATE 1 TB'" />
                            </div>

                            <div class="col-md-2 col-12 m-0 pl-2 ">
                                <x-form.btn :title="'Delete'" class="btn-outline-danger text-nowrap deleteStorageBtn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-x me-25">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </x-form.btn>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-1">
                        <x-form.btn class="btn-icon btn-primary waves-float waves-light" :id="'addStorageBtn'"
                            :title="'Add Other Storage'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-plus me-25">
                                <line x1="12" y1="5" x2="12" y2="19">
                                </line>
                                <line x1="5" y1="12" x2="19" y2="12">
                                </line>
                            </svg>
                        </x-form.btn>
                    </div>
                </div>

                <hr>

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
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Laptop/createLaptop.js') }}"></script>
@endsection
