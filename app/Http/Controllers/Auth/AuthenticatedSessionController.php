<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $user = Auth::user();

        if ($user->isActive) {
            $request->session()->regenerate();

            if ($user->roles->pluck('name')[0] === 'Super Admin') {
                return redirect()->intended('/superadmin/dashboard');
            } else if (str_contains($user->roles->pluck('name')[0], 'Admin')) {
                return redirect()->intended('/admin/dashboard');
            } else if ($user->roles->pluck('name')[0] === 'User') {
                return redirect()->intended('/user');
            } else {
                abort(response('Unauthorized', 401));
            }
        } else {
            Auth::logout();
            return redirect()->route('login')->with('error', 'Looks like your account is not active. Please contact your administrator');
        }
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
