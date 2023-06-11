@extends('Auth.app')

@section('Auth')
    <!-- /Left Text-->
    <!-- Forgot password-->
    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                <div class="alert-body">
                                    {{ $error }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    <div class="alert-body">
                        {{ session('status') }}
                    </div>
                </div>
            @endif
            <h2 class="card-title fw-bold mb-1">Forgot Password? 🔒</h2>
            <p class="card-text mb-2">Enter your email and we'll send you instructions to reset your
                password</p>
            <form id="forgot-password-form" class="auth-forgot-password-form mt-2" action="{{ route('password.email') }}"
                method="POST">
                @csrf
                <div class="mb-1">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" id="email" type="text" name="email"
                        placeholder="john@kolejspace.edu.my" aria-describedby="email" autofocus="" tabindex="1" />
                </div>
                <button id="submit-button" class="btn btn-primary w-100" tabindex="2">Send reset link</button>
            </form>
            <p class="text-center mt-2"><a href="{{ route('login') }}"><i data-feather="chevron-left"></i> Back to
                    login</a></p>
        </div>
    </div>
    <!-- /Forgot password-->
    <div class="d-none d-lg-flex col-lg-8 align-items-center">
        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid"
                src="{{ asset('app-asset/images/pages/forgot-password-v2.svg') }}" alt="Forgot password V2"></div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('app-asset/js/custom/auth-resetlink.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#forgot-password-form').submit(function() {
                // Disable the submit button
                $('#submit-button').prop('disabled', true);

                return true; // Allow the form to be submitted
            });
        });
    </script>
@endsection
