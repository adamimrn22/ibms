@extends('layouts.app')

@section('csslink')
    <link rel="stylesheet" href="{{ asset('app-asset/vendors/css/forms/select/select2.min.css') }}">
@endsection
@section('layout')
    <x-app-content>

        {{ Breadcrumbs::render('desktop.create') }}

        <x-uit.card title="Add New Desktop">
            <x-form :id="'createDesktopForm'" :action="route('uit.Desktop.store')" :method="'POST'">
                <x-form.form-group>
                    <x-form.label :for="'desktopID'" :title="'Desktop ID'" />
                    <x-form.input :id="'desktopID'" :placeholder="'UIT/USSB-XXX-00-DSKPT'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'desktopModel'" :title="'Desktop Model'" />
                    <x-form.input :id="'desktopModel'" :placeholder="'HP-000'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'price'" :title="'Price (RM)'" />
                    <x-form.input id="price" :placeholder="'4000.00'" :type="'number'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'location'" :title="'Location'" />
                    <x-form.input :id="'location'" :placeholder="'Location'" />
                </x-form.form-group>

                <hr>

                <p>Desktop Specification</p>

                <x-form.form-group>
                    <x-form.label :for="'processor'" :title="'Processor'" />
                    <x-form.input :id="'processor'" :placeholder="'Intel i5-0000'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'ram'" :title="'RAM'" />
                    <x-form.input :id="'ram'" :placeholder="'4GB DDR3'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'OS'" :title="'Operating System'" />
                    <x-form.input :id="'OS'" :placeholder="'Windows 10'" />
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'gpu'" :title="'Graphic Card'" />
                    <x-form.input :id="'gpu'" :placeholder="'RTX 3060'" />
                </x-form.form-group>

                <x-form.label :for="'storageName'" :title="'Storage Name'" />
                <div>
                    <div id="inputContainer">
                        <div class="row d-flex align-items-center mb-1">
                            <div class="col-md-6 col-12">
                                <x-form.input :id="'storage[]'" :placeholder="'HDD SEAGATE 1 TB'" />
                            </div>

                            <div class="col-md-2 col-12 m-0 pl-2 ">
                                <x-form.btn :title="'Delete'" class="btn-outline-danger text-nowrap deleteStorageBtn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-x me-25">
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

                <p>Computer Peripheral</p>

                <x-form.form-group>
                    <x-form.label :for="'keyboard'" :title="'Keyboard'" />
                    <select style="overflow:hidden" id="keyboard" name="keyboard" class="select2 form-select form-select ">
                        <option value="">No Keyboard</option>
                        @foreach ($keyboards as $keyboard)
                            <option value="{{ $keyboard->id }}">
                                {{ $keyboard->name . ' - ' . $keyboard->model }}
                            </option>
                        @endforeach
                    </select>
                </x-form.form-group>

                <x-form.form-group>
                    <x-form.label :for="'mouse'" :title="'Mouse'" />
                    <select style="overflow:hidden" id="mouse" name="mouse" class="select2 form-select form-select ">
                        <option value="">No Mouse</option>
                        @foreach ($mice as $mouse)
                            <option value="{{ $mouse->id }}">
                                {{ $mouse->name . ' - ' . $mouse->model }}
                            </option>
                        @endforeach
                    </select>
                </x-form.form-group>

                <x-form.label :for="'monitorName'" :title="'Monitor Name'" />

                <div>
                    <div id="inputMonitorContainer">
                        <div class="row d-flex align-items-center mb-1">
                            <div class="col-md-6 col-12">
                                <select style="overflow:hidden" id="monitor[]" name="monitor[]"
                                    class="select2 form-select form-select ">
                                    <option value="">No Monitor</option>
                                    @foreach ($monitors as $key => $monitor)
                                        <option value="{{ $monitor->id }}">
                                            {{ $monitor->name . ' - ' . $monitor->model }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-12 m-0 pl-2">
                                <button class="btn btn-outline-danger text-nowrap px-1 waves-effect deleteMonitorBtn"
                                    type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-x me-25">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                    <span>Delete</span>
                                </button>
                            </div>
                        </div>
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

    <script src="{{ asset('app-asset/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-asset/js/scripts/forms/form-select2.js') }}"></script>

    <script>
        var monitorsData = @json($monitors);
    </script>
    <script src="{{ asset('js/Admin/Inventory/UIT/Hardware/Desktop/createDesktop.js') }}"></script>
@endsection
