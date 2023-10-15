<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller {
    /**
     * Display the login view.
     */
    public function create(): View {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse {
        $request->authenticate();
        $request->session()->regenerate();
        $loggedUserEmail = $request->input('email');
        // Find the authenticated user by email and update the is_logged column
        User::where('email', '!=', $loggedUserEmail)->update(['is_now_authenticated' => false]);
        User::where('email', $loggedUserEmail)->update(['is_now_authenticated' => true]);

        return redirect()->intended(RouteServiceProvider::ADMIN);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse {
        // Get the authenticated user and update status
        User::where('is_now_authenticated', true)->update(['is_now_authenticated' => false]);
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('http://localhost:5174/');
    }

    public function getAuthUser() {
        $authenticatedUser = User::where('is_now_authenticated', true)->get();
        if (!$authenticatedUser) {
            return response()->json([
                'user' => null,
            ]);
        }
        return response()->json([
            'user' => $authenticatedUser,
        ]);
    }
}
