@extends('layouts.app')

@section('layout')
    <x-app-content>

        {{ Breadcrumbs::render('software.create') }}

        <x-uit.card title="Add New Software">
            <x-form :id="'softwareForm'" :action="route('uit.Software.store')" :method="'POST'">

                <x-form.form-group>
                    <x-form.label :for="'name'" :title="'Software Name'" />
                    <x-form.input :id="'name'" :placeholder="'Software Name'" />
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
                    <x-form.label :for="'price'" :title="'Price'" />
                    <x-form.input :id="'price'" :placeholder="'Price'" :type="'number'" />
                </x-form.form-group>

                <hr>

                <x-form.form-group :colClass="'col-md-12'">
                    <label class="form-label" for="details">Details Of the software</label>
                    <textarea class="form-control textarea" id="details" name="details" rows="3" placeholder="eg keys where or what"></textarea>
                </x-form.form-group>
                <hr>

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


    <script src="{{ asset('js/Admin/Inventory/UIT/Others/softwareForm.js') }}"></script>
@endsection
