<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function viewProfile($id)
    {
        $admin = Auth::user();

        if ($admin->type !== 'Admin') {
            abort(403, 'Acesso negado');
        }

        $user = User::findOrFail($id);
        return view('user.profile', compact('user'));
    }
}
