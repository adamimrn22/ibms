@extends('layouts.app')

@section('csslink')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
@endsection
@section('layout')
    <x-app-content>

        {{ Breadcrumbs::render('clasroom.create') }}

        <div class="row mt-1">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Create Classroom</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            {{ implode('', $errors->all('<div>:message</div>')) }}
                        @endif
                        <form id="addRuangKelasForm" action="{{ route('upsm.Classroom.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <x-form.form-group>
                                    <x-form.label :for="'className'" :title="'Name'" />
                                    <x-form.input :id="'className'" />
                                </x-form.form-group>

                                <x-form.form-group>
                                    <x-form.label :for="'classLocation'" :title="'Location'" />
                                    <x-form.input :id="'classLocation'" />
                                </x-form.form-group>

                                <x-form.form-group>
                                    <x-form.label :for="'classChair'" :title="'Chair'" />
                                    <x-form.input :id="'classChair'" :type="'number'" />
                                </x-form.form-group>

                                <x-form.form-group>
                                    <x-form.label :for="'classFoldableChair'" :title="'Foldable Chair'" />
                                    <x-form.input :id="'classFoldableChair'" />
                                </x-form.form-group>

                                <x-form.form-group>
                                    <x-form.label :for="'classTable'" :title="'Table'" />
                                    <x-form.input :id="'classTable'" />
                                </x-form.form-group>

                                <x-form.form-group>
                                    <x-form.label :for="'classWhiteboard'" :title="'Whiteboard'" />
                                    <x-form.input :id="'classWhiteboard'" />
                                </x-form.form-group>

                                <x-form.form-group>
                                    <x-form.label :for="'classDuster'" :title="'Duster'" />
                                    <x-form.input :id="'classDuster'" />
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

                            <x-form.form-group :colClass="'col-12'" class="mt-1">
                                <x-form.label :for="'image'" :title="'Image'" />
                                <input type="file" name="image[]" id="image" multiple />
                            </x-form.form-group>

                            <hr>




                            <div class="col-12">
                                <x-form.btn class="btn-primary waves-float waves-light" :title="'Submit'"
                                    :type="'submit'" id="submit-btn" disabled />
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
            allowMultiple: true, // Allow multiple file uploads
            maxFiles: 5, // Limit the maximum number of files to 5 (adjust as needed)
            acceptedFileTypes: ['image/jpeg', 'image/png'], // Accepted file types
            maxFileSize: '2MB', // Maximum file size
        });

        FilePond.setOptions({
            server: {
                process: "{{ route('upsm.classroom-tmp-upload') }}",
                revert: "{{ route('upsm.classroom-tmp-delete') }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
        });

        // Listen to the 'processfiles' event which triggers after all files have been processed
        pond.on('processfiles', () => {
            // Enable the submit button when all files are successfully uploaded
            submitButton.disabled = false;
        });
    </script>
    <script src="{{ asset('js/Admin/Inventory/UPSM/Classroom/AddClass.js') }}"></script>
@endsection
