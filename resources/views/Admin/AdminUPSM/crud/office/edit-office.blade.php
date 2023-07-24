@extends('layouts.app')

@section('csslink')
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
@endsection
@section('layout')
    <x-app-content>

        {{ Breadcrumbs::render('office.edit', $office) }}

        <div class="row mt-1">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Create Office</h3>
                    </div>
                    <div class="card-body">
                        <form id="editRuangOfficeForm" action="{{ route('upsm.Office.update', ['Office' => $office->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <x-form.form-group>
                                    <x-form.label :for="'officeName'" :title="'Name'" />
                                    <x-form.input :id="'officeName'" :value="$office->name" />
                                </x-form.form-group>

                                <x-form.form-group>
                                    <x-form.label :for="'officeLocation'" :title="'Location'" />
                                    <x-form.input :id="'officeLocation'" :value="$office->location" />
                                </x-form.form-group>

                                <x-form.form-group>
                                    <x-form.label :for="'Sofa'" :title="'Sofa'" />
                                    <x-form.input :id="'Sofa'" :type="'number'" :value="$office->attribute->Sofa" />
                                </x-form.form-group>

                                <x-form.form-group>
                                    <x-form.label :for="'Drawer'" :title="'Drawer'" />
                                    <x-form.input :id="'Drawer'" :type="'number'" :value="$office->attribute->Drawer" />
                                </x-form.form-group>

                                <x-form.form-group>
                                    <x-form.label :for="'Chair'" :title="'Chair'" />
                                    <x-form.input :id="'Chair'" :type="'number'" :value="$office->attribute->Chair" />
                                </x-form.form-group>

                                <x-form.form-group>
                                    <x-form.label :for="'FoldableChair'" :title="'Foldable Chair'" />
                                    <x-form.input :id="'FoldableChair'" :value="$office->attribute->Foldable_Chair" />
                                </x-form.form-group>

                                <x-form.form-group>
                                    <x-form.label :for="'Table'" :title="'Table'" />
                                    <x-form.input :id="'Table'" :value="$office->attribute->Table" />
                                </x-form.form-group>

                                <x-form.form-group>
                                    <x-form.label :for="'Whiteboard'" :title="'Whiteboard'" />
                                    <x-form.input :id="'Whiteboard'" :value="$office->attribute->Whiteboard" />
                                </x-form.form-group>

                                <x-form.form-group>
                                    <x-form.label :for="'Duster'" :title="'Duster'" />
                                    <x-form.input :id="'Duster'" :value="$office->attribute->Duster" />
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


    <script src="{{ asset('js/Admin/Inventory/UPSM/Office/editOffice.js') }}"></script>
@endsection
