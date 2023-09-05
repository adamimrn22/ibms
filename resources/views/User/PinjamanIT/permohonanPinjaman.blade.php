@extends('layouts.userapp')

@section('csslink')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-asset/vendors/css/extensions/sweetalert2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-asset/css/plugins/extensions/ext-component-sweet-alerts.css') }}">
@endsection

@section('section')
    <div class="card ">
        <div class="card-header">
            <h3 class="h6">Permohonan Barang Peralatan ICT</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('PinjamanUit.store') }}" method="POST">
                @csrf
                <div class="row">
                    <x-form.form-group :colClass="'col-md-12'">
                        <label class="form-label" for="objective">Maklumat Berkaitan Permohonan</label>
                        <textarea class="form-control textarea" id="objective" name="objective" rows="3"
                            placeholder="Maklumat Permohonan Barang seperti spesifikasi, jenis peralatan dan lain-lain"></textarea>
                    </x-form.form-group>

                    <div class="d-flex justify-content-end">
                        <x-form.btn class="btn-outline-secondary" :title="'Reset'" :type="'reset'" />
                        <x-form.btn class="btn-primary waves-float waves-light target-button-selector" :title="'Mohon Pinjaman Barang Peralatan ICT'"
                            :type="'submit'" disabled />
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Select the textarea and the button
            var $textarea = $('#objective');
            var $submitButton = $('.target-button-selector');

            // Add an input event listener to the textarea
            $textarea.on('input', function() {
                // Enable the button if there's content in the textarea, otherwise disable it
                if ($(this).val().trim().length > 0) {
                    $submitButton.prop('disabled', false);
                } else {
                    $submitButton.prop('disabled', true);
                }
            });
        });
    </script>
    @if ($errors->any())
        <script>
            toastr.error('Validation Error', 'Error');
        </script>
    @endif
@endsection
