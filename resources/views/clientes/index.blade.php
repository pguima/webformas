@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Gerenciamento de Clientes</h2>

    <!-- Mensagens de sucesso/erro -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Pesquisa -->
    <form method="GET" action="{{ route('clientes.index') }}" class="mb-3 d-flex">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control me-2" placeholder="Pesquisar cliente...">
        <button class="btn btn-primary">Buscar</button>
    </form>

    <!-- Botão Criar -->
    @if($isAdmin)
        <button class="btn btn-success mb-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCreate">
            Novo Cliente
        </button>
    @endif

    <!-- Tabela -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Domínio</th>
                        <th>Plataforma</th>
                        <th>Serviços</th>
                        <th>Plano</th>
                        <th>Status</th>
                        <th>Email</th>
                        <th>Servidor</th>
                        @if($isAdmin)
                            <th class="text-center">Ações</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->cliente }}</td>
                            <td>{{ $cliente->vendedor->name ?? '-' }}</td>
                            <td>{{ $cliente->dominio }}</td>
                            <td>{{ $cliente->plataforma }}</td>
                            <td>
                                @if($cliente->servicos)
                                    {{ implode(', ', $cliente->servicos) }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $cliente->plano }}</td>
                            <td>{{ ucfirst($cliente->status) }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->servidor }}</td>
                            @if($isAdmin)
                                <td class="text-center">
                                    <button class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteModal"
                                        data-id="{{ $cliente->id }}"
                                        data-name="{{ $cliente->cliente }}">
                                        Excluir
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center p-3">Nenhum cliente encontrado</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Paginação -->
    <div class="mt-3">
        {{ $clientes->links() }}
    </div>
</div>

<!-- Offcanvas Criar Cliente -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCreate">
    <div class="offcanvas-header">
        <h5>Novo Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <form method="POST" action="{{ route('clientes.store') }}">
            @csrf
            <div class="mb-3">
                <label>Cliente</label>
                <input type="text" name="cliente" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Vendedor</label>
                <select name="vendedor_id" class="form-select" required>
                    <option value="">Selecione...</option>
                    @foreach($vendedores as $vendedor)
                        <option value="{{ $vendedor->id }}">{{ $vendedor->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Domínio</label>
                <input type="text" name="dominio" class="form-control">
            </div>

            <div class="mb-3">
                <label>Plataforma</label>
                <input type="text" name="plataforma" class="form-control">
            </div>

            <div class="mb-3">
                <label>Serviços</label>
                <select name="servicos[]" class="form-select" multiple>
                    <option value="Landing Page">Landing Page</option>
                    <option value="Gestão de Tráfego">Gestão de Tráfego</option>
                    <option value="Social Media">Social Media</option>
                    <option value="SEO">SEO</option>
                    <option value="E-commerce">E-commerce</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Plano</label>
                <input type="text" name="plano" class="form-control">
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select">
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                    <option value="em análise">Em análise</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="text" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label>Servidor</label>
                <input type="text" name="servidor" class="form-control">
            </div>

            <button class="btn btn-primary w-100">Salvar</button>
        </form>
    </div>
</div>

<!-- Modal Confirma Exclusão -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5>Confirmar Exclusão</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir o cliente <strong id="deleteClientName"></strong>?
      </div>
      <div class="modal-footer">
        <form id="formDeleteClient" method="POST" action="">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger">Excluir</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const deleteModal = document.getElementById('confirmDeleteModal');
    deleteModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        document.getElementById('deleteClientName').textContent = name;
        document.getElementById('formDeleteClient').action = '/clientes/' + id;
    });
});
</script>
@endsection
