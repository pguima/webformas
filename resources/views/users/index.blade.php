@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Usuários</h4>

        <form method="GET" action="{{ route('users.index') }}" class="d-flex">
            <input type="text" name="q" class="form-control me-2" placeholder="Pesquisar..."
                value="{{ $query }}">
            <button class="btn btn-outline-secondary">Buscar</button>
        </form>

        @if ($isAdmin)
            <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasUser">
                Novo Usuário
            </button>
        @endif
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo</th>
                <th>CPF</th>
                <th>WhatsApp</th>
                @if ($isAdmin)
                    <th class="text-end">Ações</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->type }}</td>
                    <td>{{ $u->cpf }}</td>
                    <td>{{ $u->whatsapp }}</td>
                    @if ($isAdmin)
                        <td class="text-end">
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasUser" data-id="{{ $u->id }}"
                                data-name="{{ $u->name }}" data-email="{{ $u->email }}"
                                data-type="{{ $u->type }}" data-cpf="{{ $u->cpf }}"
                                data-whatsapp="{{ $u->whatsapp }}">
                                Editar
                            </button>

                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                data-bs-target="#modalDelete{{ $u->id }}">
                                Excluir
                            </button>

                            <!-- Modal de confirmação -->
                            <div class="modal fade" id="modalDelete{{ $u->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Excluir Usuário</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Tem certeza que deseja excluir <strong>{{ $u->name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="{{ route('users.destroy', $u->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Sim, excluir</button>
                                            </form>
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $users->links() }}
    </div>

    @if ($isAdmin)
        <!-- Offcanvas para criar/editar -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasUser">
            <div class="offcanvas-header">
                <h5 id="offcanvasTitle">Novo Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <form method="POST" id="userForm">
                    @csrf
                    <div id="methodField"></div>

                    <div class="mb-3">
                        <label>Nome</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Senha</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="••••••">
                    </div>
                    <div class="mb-3">
                        <label>Tipo</label>
                        <select name="type" id="type" class="form-select" required>
                            <option>Admin</option>
                            <option>Web</option>
                            <option>Marketing</option>
                            <option>Vendas</option>
                            <option>Media</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>CPF</label>
                        <input type="text" name="cpf" id="cpf" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>WhatsApp</label>
                        <input type="text" name="whatsapp" id="whatsapp" class="form-control">
                    </div>

                    <button class="btn btn-success w-100">Salvar</button>
                </form>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const offcanvas = document.getElementById('offcanvasUser');
            offcanvas.addEventListener('show.bs.offcanvas', function(event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');

                const form = document.getElementById('userForm');
                const methodField = document.getElementById('methodField');
                const title = document.getElementById('offcanvasTitle');

                if (id) {
                    // Editar
                    form.action = `/usuarios/${id}`;
                    methodField.innerHTML = '@method('PUT')';
                    title.textContent = 'Editar Usuário';

                    document.getElementById('name').value = button.getAttribute('data-name');
                    document.getElementById('email').value = button.getAttribute('data-email');
                    document.getElementById('type').value = button.getAttribute('data-type');
                    document.getElementById('cpf').value = button.getAttribute('data-cpf');
                    document.getElementById('whatsapp').value = button.getAttribute('data-whatsapp');
                    document.getElementById('password').value = '';
                } else {
                    // Novo
                    form.action = '/usuarios';
                    methodField.innerHTML = '';
                    title.textContent = 'Novo Usuário';
                    form.reset();
                }
            });
        });
    </script>
@endsection
