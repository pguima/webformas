<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q');

        $clientes = Cliente::with('vendedor')
            ->when($query, fn($q) =>
                $q->where('cliente', 'like', "%{$query}%")
                  ->orWhere('email', 'like', "%{$query}%")
                  ->orWhere('dominio', 'like', "%{$query}%")
            )
            ->orderBy('cliente')
            ->paginate(10);

        $isAdmin = Auth::user()->type === 'Admin';
        $vendedores = User::orderBy('name')->get();

        return view('clientes.index', compact('clientes', 'isAdmin', 'vendedores', 'query'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->type !== 'Admin') {
            abort(403, 'Acesso negado.');
        }

        $validated = $request->validate([
            'cliente' => 'required|string|max:255',
            'vendedor_id' => 'required|exists:users,id',
            'dominio' => 'nullable|string|max:255',
            'plataforma' => 'nullable|string|max:255',
            'servicos' => 'nullable|array',
            'plano' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
            'email' => 'nullable|string|max:255',
            'servidor' => 'nullable|string|max:255',
        ]);

        Cliente::create($validated);

        return back()->with('success', 'Cliente criado com sucesso!');
    }

    public function destroy($id)
    {
        if (Auth::user()->type !== 'Admin') {
            abort(403, 'Acesso negado.');
        }

        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return back()->with('success', 'Cliente excluído com sucesso!');
    }
}
