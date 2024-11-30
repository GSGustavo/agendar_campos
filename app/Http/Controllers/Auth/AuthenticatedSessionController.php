<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Campos;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Inertia\Inertia;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {

       
        // Fazendo isso pro sintético ficar como primeira opção no select do menu
        $campos = Campos::query()
            ->where("status", '1')
            ->orderBy("id", "asc")
            ->get(['id', 'nome']);

        $data = [
            'campos' => $campos,
            'apigetagendamentos' => route("api.auth.menu.getagendamentos"),
            'routeforgotpass' => route('password.request')
        ];




        return Inertia::render('Guest/Login', $data);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $subdomain = \Illuminate\Support\Arr::first(explode('.', request()->getHost()));

        $user = User::select()->where('email', $request->email)->exists();
        $status = User::select()->where('email', $request->email)->where("status", '1')->exists();
        
        if ($user and $status) {
            if ($user) {
                $request->authenticate();

                $request->session()->regenerate();
    
                $route = 'auth.menu.index';

                if ($subdomain == "dash") {
                    $route = 'dashboard.index';
                }

                return redirect()->intended(route($route, absolute: false));
            } else {
                $data = [
                    'email' => $user->email
                ];
                return Inertia::render("Guest/Password/Changepass");
            }
            
        } else if ($user) {
            return back()->withErrors(['account' => 'Sua conta encontra-se inativa!']);
        } else {
            return back()->withErrors(['account' => 'A conta não existe!']);
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

        return redirect()->intended(route('login', absolute: false));
    }
}
