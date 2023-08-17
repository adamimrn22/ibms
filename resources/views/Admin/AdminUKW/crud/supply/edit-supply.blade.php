@extends('layouts.app')

@section('csslink')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
@endsection
@section('layout')
    <x-app-content>

        {{ Breadcrumbs::render('supply.edit', $supply) }}

        <div class="row mt-1">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Edit Alat Tulis</h3>
                    </div>
                    <div class="card-body">

                        <form id="addSupplyForm" action="{{ route('ukw.Supply.update', ['Supply' => $supply->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <x-form.form-group>
                                    <x-form.label :for="'name'" :title="'Name'" />
                                    <x-form.input :id="'name'" :value="$supply->name" />
                                </x-form.form-group>

                                <x-form.form-group>
                                    <x-form.label :for="'current_quantity'" :title="'Stock'" />
                                    <x-form.input :id="'current_quantity'" :value="$supply->current_quantity" />
                                </x-form.form-group>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <x-form.label :for="'subcategory_id'" :title="'Category'" />
                                        <select style="overflow:hidden" id="subcategory_id" name="subcategory_id"
                                            class="select2 form-select form-select ">
                                            @foreach ($subcategories as $subcategory)
                                                <option
                                                    value="{{ $subcategory->id . '|' . $subcategory->subcategory_name }}"
                                                    {{ $supply->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                                                    {{ $subcategory->subcategory_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('subcategory_id')
                                            <label class="error">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="mb-1">
                                        <x-form.label :for="'status_id'" :title="'Status'" />
                                        <select style="overflow:hidden" id="status_id" name="status_id"
                                            class="select2 form-select form-select ">
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->id }}"
                                                    {{ $supply->status_id == $status->id ? 'selected' : '' }}>
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

                            <x-form.form-group :colClass="'col-12'" class="mt-1">
                                <x-form.label :for="'image'" :title="'Image'" />
                                <input type="file" name="image[]" id="image" multiple />
                            </x-form.form-group>

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

    @if (session('error'))
        <script>
            toastr.error("{{ session('error') }}", 'Error');
        </script>
    @endif

    {{-- file pond link --}}
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    <script>
        const inputElement = document.querySelector('input[type="file"]');
        const submitButton = document.getElementById('submit-btn');

        // Register the plugin
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType
        );
        // Create a FilePond instance
        const pond = FilePond.create(inputElement, {
            allowMultiple: false, // Allow multiple file uploads
            maxFiles: 1, // Limit the maximum number of files to 5 (adjust as needed)
            acceptedFileTypes: ['image/jpeg', 'image/png'], // Accepted file types
            maxFileSize: '2MB', // Maximum file size
        });

        FilePond.setOptions({
            server: {
                process: "{{ route('ukw.supply-tmp-upload') }}",
                revert: "{{ route('ukw.supply-tmp-delete') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
        });
    </script>
    <script src="{{ asset('js/Admin/Inventory/UPSM/Classroom/AddClass.js') }}"></script>
@endsection
