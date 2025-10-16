<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>WebFormas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ícones Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- jQuery 3.x -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        p{
            color: var(--cor-text-01);
        }
    </style>

</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar collapsed" id="sidebar">
        <div class="sidebar_header logo row d-flex justify-content-center">
                <img class="logo-inteiro" src="{{ Storage::url('images/logo-webformas.webp') }}" alt="Minha Foto">
                <h1 class="text-center logo-letra">WF</h1>
            
        </div>
        <div class="sidebar-menu">
            <div>
                <a href="{{ route('profile') }}"
                    class="sidebar_item">
                    <i class="bi bi-person-bounding-box"></i>
                    <span class="sidebar_item_text">Perfil</span>
                </a>
                <a href="{{ route('users.index') }}"
                    class="sidebar_item">
                    <i class="bi bi-people"></i>
                    <span class="sidebar_item_text">Usuários</span>
                </a>
                <a href="{{ route('clientes.index') }}"
                    class="sidebar_item">
                    <i class="bi bi-card-checklist"></i>
                    <span class="sidebar_item_text">clientes</span>
                </a>
                <!--<a href="dashboard" class="sidebar_item">
                    <i class="bi bi-clipboard2-data"></i>
                    <span class="sidebar_item_text">Início</span>
                </a>
                <a href="dashboard/?pag=compromissos"
                    class="sidebar_item">
                    <i class="bi bi-calendar-check"></i>
                    <span class="sidebar_item_text">Compromissos</span>
                </a>
                <a href="dashboard/?pag=orcamento"
                    class="sidebar_item">
                    <i class="bi bi-cash-coin"></i>
                    <span class="sidebar_item_text">Orçamento</span>
                </a>
                <a href="dashboard/?pag=fornecedores"
                    class="sidebar_item">
                    <i class="bi bi-shop-window"></i>
                    <span class="sidebar_item_text">Fornecedores</span>
                </a>
                <a href="dashboard/?pag=roteiro"
                    class="sidebar_item">
                    <i class="bi bi-clock-history"></i>
                    <span class="sidebar_item_text">Roteiro</span>
                </a>
                <a href="dashboard/?pag=financeiro"
                    class="sidebar_item">
                    <i class="bi bi-coin"></i>
                    <span class="sidebar_item_text">Financeiro</span>
                </a>
                <a href="dashboard/?pag=curso" class="sidebar_item">
                    <i class="bi bi-mortarboard-fill"></i>
                    <span class="sidebar_item_text">Curso</span>
                </a>-->
            </div>


        </div>
    </div>

    <!-- Main Content -->
    <div class="main_content expanded row justify-content-center" id="main_content">
        

        <nav class="navbar navbar-expand-lg mb-4">
            <div class="container-fluid justify-content-between">
                <div>
                    <button class="sidebar_toggle" id="sidebar_toggle">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
                
                <div class="d-flex align-items-center me-4">
                    <h2 class="me-3">Olá, {{ Auth::user()->name }}!</h2>
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-outline-secondary btn-sm">Sair</button>
                    </form>
                    @endauth
                </div>
            </div>
        </nav>
        

        <div class="container page-content">
            @yield('content')
        </div>
    </div> <!-- Fechamento da div main-content -->

    
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    $(document).ready(function() {
        // Máscara CPF
        $('#cpf').mask('000.000.000-00');

        // Máscara WhatsApp (8 ou 9 dígitos)
        var SPMaskBehavior = function(val) {
                val = val.replace(/\D/g, '');
                return (val.length === 11) ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };

        $('#whatsapp').mask(SPMaskBehavior, spOptions);
    });

    $(document).ready(function () {
            // Elementos
            const $sidebar = $('#sidebar');
            const $main_content = $('#main_content');
            const $sidebar_toggle = $('#sidebar_toggle');

            // Função para alternar a sidebar
            function toggle_sidebar() {
                $sidebar.toggleClass('collapsed');
                $main_content.toggleClass('expanded');
                $(".logo-inteiro").toggle();
                $(".logo-letra").toggle();
            }
            $sidebar_toggle.on('click', toggle_sidebar);

        });
    </script>

</body>

</html>