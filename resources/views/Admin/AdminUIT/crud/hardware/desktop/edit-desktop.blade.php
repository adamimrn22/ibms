@extends('layouts.app')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/forms/select/select2.min.css') }}">
@endsection
@section('layout')
    <x-app-content>
        {{ Breadcrumbs::render('desktop.edit', $desktop) }}

        <x-uit.card :title="'Edit Desktop'">
            <x-form :id="'editDesktopForm'" :action="route('uit.Desktop.update', ['Desktop' => $desktop->id])" :method="'POST'">
                @method('PUT')
                <x-form.form-group>
                    <x-form.label :for="'desktopID'" :title="'Desktop ID'" />
                    <x-form.input id="desktopID" :value="$desktop->name" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'desktopModel'" :title="'Desktop Model'" />
                    <x-form.input id="desktopModel" :value="$desktop->attribute->model" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'location'" :title="'Location'" />
                    <x-form.input id="location" :value="$desktop->location" />
                </x-form.form-group>

                <hr>

                <p>Desktop Spec</p>

                <x-form.form-group>
                    <x-form.label :for="'processor'" :title="'Processor'" />
                    <x-form.input id="processor" :value="$desktop->attribute->processor" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'ram'" :title="'RAM'" />
                    <x-form.input id="ram" :value="$desktop->attribute->ram" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'OS'" :title="'Operating System'" />
                    <x-form.input id="OS" :value="$desktop->attribute->OS" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'gpu'" :title="'Graphic Card'" />
                    <x-form.input id="gpu" :value="$desktop->attribute->gpu" />
                </x-form.form-group>

                <x-form.label :for="'storageName'" :title="'Storage Name'" />

                <div>
                    <div id="inputContainer">
                        @foreach ($desktop->attribute->storage as $storage)
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

                <p>Computer Peripheral</p>

                <x-form.form-group>
                    <x-form.label :for="'keyboard'" :title="'Keyboard'" />
                    <x-form.input id="keyboard" :value="$desktop->attribute->keyboard" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'mouse'" :title="'Mouse'" />
                    <x-form.input id="mouse" :value="$desktop->attribute->mouse" />
                </x-form.form-group>

                <x-form.label :for="'monitorName'" :title="'Monitor Name'" />

                <div>
                    <div id="inputMonitorContainer">
                        @foreach ($desktop->attribute->monitor as $monitor)
                            <div class="row d-flex align-items-center mb-1">
                                <div class="col-md-6 col-12">
                                    <input type="text" class="form-control" id="monitorName" name="monitor[]"
                                        placeholder="HDD SEAGATE 1 TB" value="{{ $monitor }}">
                                </div>
                                <div class="col-md-2 col-12 m-0 pl-2">
                                    <button class="btn btn-outline-danger text-nowrap px-1 waves-effect deleteMonitorBtn"
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
                            id="addMonitorBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-plus me-25">
                                <line x1="12" y1="5" x2="12" y2="19">
                                </line>
                                <line x1="5" y1="12" x2="19" y2="12">
                                </line>
                            </svg>
                            <span>Add Other Monitor</span>
                        </button>
                    </div>

                </div>

                <hr>
                @php
                    $status = ['AVAILABLE', 'BOOKED', 'MISSING', 'DISPOSE', 'DAMAGED'];
                @endphp

                <div class="col-md-6 col-12">
                    <div class="mb-1">
                        <x-form.label :for="'status'" :title="'Status'" />
                        <select style="overflow:hidden" id="status" name="status"
                            class="select2 form-select form-select ">
                            @foreach ($status as $status)
                                <option value="{{ $status }}" {{ $desktop->status == $status ? 'selected' : '' }}>
                                    {{ $status }}
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

    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Desktop/editDesktop.js') }}"></script>

    <script src="{{ asset('app-asset/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-asset/js/scripts/forms/form-select2.js') }}"></script>
@endsection
