<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 🔸 Validação dos campos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ], [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
        ]);

        // 🔸 Tentativa de autenticação
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Regenera sessão por segurança
            $request->session()->regenerate();

            return redirect()->route('profile')
                ->with('success', 'Login realizado com sucesso!');
        }

        // 🔸 Retorna erro genérico se falhar
        return back()->withErrors([
            'login_error' => 'E-mail ou senha incorretos.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Você saiu com sucesso!');
    }
}
