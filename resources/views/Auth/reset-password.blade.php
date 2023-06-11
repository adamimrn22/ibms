@extends('Auth.app')

@section('title')
    RESET PASSWORD
@endsection
@section('Auth')

    <div class="d-none d-lg-flex col-lg-8 align-items-center">
        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid"
                src="{{ asset('app-asset/images/pages/reset-password-v2.svg') }}" alt="Register V2"></div>
    </div>
    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    <div class="alert-body">
                        {{ session('status') }}
                    </div>
                </div>
            @endif

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
            <h2 class="card-title fw-bold mb-1">Reset Password 🔒</h2>
            <p class="card-text mb-2">Your new password must be different from previously used passwords</p>

            <form class="auth-reset-password-form mt-2" action="{{ route('password.store') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <input type="hidden" name="email" value="{{ old('email', $request->email) }}">
                <div class="mb-1">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">New Password</label>
                    </div>

                    <div class="input-group input-group-merge form-password-toggle">
                        <input class="form-control form-control-merge" id="password" type="password" name="password"
                            placeholder="············" aria-describedby="password" autofocus="" tabindex="1"><span
                            class="input-group-text cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" width="14"
                                height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg></span>
                    </div>
                </div>
                <div class="mb-1">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                    </div>
                    <div class="input-group input-group-merge form-password-toggle">
                        <input class="form-control form-control-merge" id="password_confirmation" type="password"
                            name="password_confirmation" placeholder="············" aria-describedby="password_confirmation"
                            tabindex="2"><span class="input-group-text cursor-pointer"><svg
                                xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-eye">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg></span>
                    </div>
                </div>
                <button class="btn btn-primary w-100 waves-effect waves-float waves-light" tabindex="3">
                    Set New Password
                </button>
            </form>

            <p class="text-center mt-2"><a href="{{ route('login') }}"><svg xmlns="http://www.w3.org/2000/svg"
                        width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-chevron-left">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg> Back to login</a></p>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('app-asset/js/custom/auth-reset.js') }}"></script>
@endsection
