@extends('Auth.app')

@section('title')
    {{ 'Login | Welcome' }}
@endsection

@section('Auth')
    <!-- Login-->
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

            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    <div class="alert-body">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <h2 class="card-title fw-bold mb-1">Welcome to IBMS! 👋</h2>
            <p class="card-text mb-2">Please sign-in to your account to start booking</p>
            <form class="auth-login-form mt-2" action="/login" method="POST">
                @csrf
                <div class="mb-1">
                    <label class="form-label" for="username">STAFF ID</label>
                    <input class="form-control" id="username" type="text" name="username" placeholder="SC0000"
                        aria-describedby="username" autofocus="" tabindex="1" />
                </div>
                <div class="mb-1">
                    <div class="d-flex justify-content-between">
                        <label class="form-label" for="password">Password</label>
                        <a href="{{ route('password.request') }}">
                            <small>Forgot Password?</small>
                        </a>
                    </div>
                    <div class="input-group input-group-merge form-password-toggle">
                        <input class="form-control form-control-merge" id="password" type="password" name="password"
                            placeholder="············" aria-describedby="password" tabindex="2" /><span
                            class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                    </div>
                </div>

                <button class="btn btn-primary w-100" tabindex="4">Sign in</button>
            </form>


        </div>
    </div>
    <!-- /Login-->

    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">

        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid"
                src="{{ asset('app-asset/images/pages/login-v2.svg') }}" alt="Login V2">
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('app-asset/js/custom/auth-login.js') }}"></script>
@endsection
