. @extends('layouts.app')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/forms/select/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/css/plugins/forms/pickers/form-flat-pickr.css') }}">
@endsection
@section('layout')
    <x-app-content>

        {{ Breadcrumbs::render('laptop.edit', $laptop) }}

        <x-uit.card title="Edit Laptop">
            <x-form :id="'editLaptopForm'" :action="route('uit.Laptop.update', ['Laptop' => $laptop->id])" :method="'POST'">
                @method('PUT')

                <x-form.form-group>
                    <x-form.label :for="'laptopID'" :title="'Laptop ID'" />
                    <x-form.input id="laptopID" :value="$laptop->name" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'price'" :title="'Price (RM)'" />
                    <x-form.input id="price" :value="$laptop->price" :type="'number'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'laptopBrand'" :title="'Laptop Brand'" />
                    @php
                        $brands = ['Asus', 'HP', 'Lenovo', 'Acer', 'MSI', 'LG', 'Samsung', 'Gigabyte', 'Dell', 'Microsoft', 'Medion', 'Chuwi', 'Teclast', 'Razer', 'Apple', 'Huawei', 'Primux', 'Jumper', 'Bmax', 'Winnovo', 'Alienware', 'VANT', 'Innjoo', 'KUU', 'HONOR', 'Toshiba', 'OMEN', 'XIDU', 'PRIXTON', 'Evoo', 'DeepGaming', 'Schneider', 'TOPOSH', 'Xiaomi', 'Ubrand', 'Panasonic', 'IProda', 'AWOW', 'Mytrix', 'JETWING', 'VUCATIMES', 'Schenker', 'BiTECOOL', 'ACEPC', 'Gateway', 'MAINGEAR', 'Google', 'Fancy Cherry', 'GPD', 'DaySky', 'Jepssen'];
                    @endphp
                    <select style="overflow:hidden" id="laptopBrand" name="laptopBrand"
                        class="select2 form-select form-select ">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand }}" {{ $laptop->attribute->brand == $brand ? 'selected' : '' }}>
                                {{ $brand }}
                            </option>
                        @endforeach
                    </select>
                    @error('brand')
                        <label class="error">{{ $message }}</label>
                    @enderror
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'laptopModel'" :title="'Laptop Model'" />
                    <x-form.input id="laptopModel" :value="$laptop->attribute->model" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'location'" :title="'Location'" />
                    <x-form.input :id="'location'" :value="$laptop->location" />
                </x-form.form-group>

                <hr>

                <p>Laptop Specification</p>

                <x-form.form-group>
                    <x-form.label :for="'display'" :title="'Display'" />
                    <x-form.input id="display" :value="$laptop->attribute?->display" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'processor'" :title="'Processor'" />
                    <x-form.input id="processor" :value="$laptop->attribute->processor" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'ram'" :title="'RAM'" />
                    <x-form.input id="ram" :value="$laptop->attribute->ram" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'OS'" :title="'Operating System'" />
                    <x-form.input id="OS" :value="$laptop->attribute->OS" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'gpu'" :title="'Graphic Card'" />
                    <x-form.input id="gpu" :value="$laptop->attribute->gpu" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'datepicker'" :title="'Date Of Purchase'" />
                    <input type="text" id="datepicker" name="DOP" value="{{ $laptop->attribute->DOP }}"
                        class="form-control flatpickr-basic flatpickr-input">
                </x-form.form-group>


                <x-form.label :for="'storage[]'" :title="'Storage Name'" />
                <div>
                    <div id="inputContainer">
                        @foreach ($laptop->attribute->storage as $storage)
                            <div class="row d-flex align-items-center mb-1">
                                <div class="col-md-6 col-12">
                                    <input type="text" class="form-control" id="storageName" name="storage[]"
                                        placeholder="HDD SEAGATE 1 TB" value="{{ $storage }}">
                                </div>
                                <div class="col-md-2 col-12 m-0 pl-2">
                                    <button class="btn btn-outline-danger text-nowrap px-1 waves-effect deleteStorageBtn"
                                        type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-x me-25">
                                            <line x1="18" y1="6" x2="6" y2="18">
                                            </line>
                                            <line x1="6" y1="6" x2="18" y2="18">
                                            </line>
                                        </svg>
                                        <span>Delete</span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-12 mb-1">
                        <button class="btn btn-icon btn-primary waves-effect waves-float waves-light" type="button"
                            id="addStorageBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-plus me-25">
                                <line x1="12" y1="5" x2="12" y2="19">
                                </line>
                                <line x1="5" y1="12" x2="19" y2="12">
                                </line>
                            </svg>
                            <span>Add Other Storage</span>
                        </button>
                    </div>
                </div>

                <hr>

                <div class="col-md-6 col-12">
                    <div class="mb-1">
                        <x-form.label :for="'status'" :title="'Status'" />
                        <select style="overflow:hidden" id="status" name="status"
                            class="select2 form-select form-select ">
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}" {{ $laptop->status == $status ? 'selected' : '' }}>
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
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Laptop/editLaptop.js') }}"></script>
@endsection
