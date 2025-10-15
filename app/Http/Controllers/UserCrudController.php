<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserCrudController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $users = User::when($query, function ($q) use ($query) {
            $q->where('name', 'like', "%{$query}%")
              ->orWhere('email', 'like', "%{$query}%");
        })
        ->orderBy('name')
        ->paginate(10);

        $isAdmin = Auth::user()->type === 'Admin';

        return view('users.index', compact('users', 'isAdmin', 'query'));

    }

    public function store(Request $request)
    {
        if (Auth::user()->type !== 'Admin') {
            abort(403, 'Acesso negado.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'type' => 'required|string',
            'cpf' => 'nullable|string|max:14',
            'whatsapp' => 'nullable|string|max:20',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->type !== 'Admin') {
            abort(403, 'Acesso negado.');
        }

        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:4',
            'type' => 'required|string',
            'cpf' => 'nullable|string|max:14',
            'whatsapp' => 'nullable|string|max:20',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy($id)
    {
        if (Auth::user()->type !== 'Admin') {
            abort(403, 'Acesso negado.');
        }

        User::findOrFail($id)->delete();

        return redirect()->route('users.index')->with('success', 'Usuário removido com sucesso!');
    }
}
