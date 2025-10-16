<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>WebFormas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">



    <style>
        :root {
            --cor-01: #101723;
            --cor-02: #10161f;
            --cor-03: #0e131a;
            --cor-04: #0c223f;
            --cor-borda: #27354b;
            --cor-borda-02: #023b96;
            --cor-text-01: #94a3aa;
            --cor-h4: #ffffff;

            --cor-sidebar: var(--cor-01);
            --cor-nav-top: var(--cor-02);
            --cor-background: var(--cor-03);
            --cor-card: var(--cor-02);
        }

        body {
            font-family: "Poppins", sans-serif;
            transition: margin-left var(--transition-speed);
            min-height: 100vh;
            overflow-x: hidden;
            background-color: var(--cor-background);
        }

        h5 {
            color: var(--cor-h4);
        }

        h4 {
            color: var(--cor-h4);
        }

        h2{
            color: var(--cor-text-01);
            font-size: 18px;
            margin: 0;
        }

        /* Sidebar Styles */
        .sidebar {
            background-color: var(--cor-sidebar);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            z-index: 1030;
            transition: .3s;
            border-right: solid 1px var(--cor-borda);
        }

        .sidebar_header {
            padding: 1rem 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            height: 130px;
            padding: 0;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar_item {
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--cor-text-01);;
            text-decoration: none;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
            border-top: solid 1px transparent;
            border-bottom: solid 1px transparent;
            border-right: solid 1px transparent;
        }

        .sidebar_item i {
            font-size: 1.25rem;
            min-width: 1.5rem;
            text-align: center;
        }

        .sidebar.collapsed .sidebar_item_text {
            display: none;
        }

        .sidebar.collapsed .sidebar_item:hover .sidebar_item_text {
            display: block;
        }

        .sidebar .sidebar_item:hover {
            background-color: var(--cor-04);
            border-top: solid 1px var(--cor-borda-02);
            border-bottom: solid 1px var(--cor-borda-02);
            color: #FDF9F4;
            box-shadow: 0px 0px 20px #102e55 !important;
        }

        .sidebar.collapsed .sidebar_item:hover {
            width: 250px;
            background-color: var(--cor-04);
            border-right: solid 1px var(--cor-borda-02);
            color: #FDF9F4;
            box-shadow: 0px 0px 20px #102e55 !important;
            border-radius: 15px;
        }

        .sidebar_toggle {
            background: none;
            border: none;
            color: #FDF9F4;
            cursor: pointer;
            font-size: 1.25rem;
            padding: 0.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar_toggle:hover {
            color: #fbeae7;
        }

        .main_content {
            margin-left: 250px;
            transition: .3s;
        }

        .main_content.expanded {
            margin-left: 70px;
        }

        .page-content{
            padding: 1rem 3rem;
        }

        .logo{
            color: #fff
        }

        .logo-inteiro{
            display: none;
            height: 90px;
            width: auto;
        }

        .logo-letra{
            font-size: 24px;
        }

        nav.navbar{
            background-color: var(--cor-nav-top);
            border-bottom: solid 1px var(--cor-borda);
        }

        .card{
            background-color: var(--cor-card);
            padding: 20px;
            border: solid 1px var(--cor-borda)
        }

        .table{
            --bs-table-bg: #ffffff00;
            --bs-table-color: var(--cor-text-01);
            --bs-table-border-color: var(--cor-borda);
        }

        .form-control, .form-select{
            background-color: #ffffff00;
            color: #c8cdd1;
            border: solid 1px var(--cor-borda);
        }

        .form-control:focus, .form-select:focus{
            background-color: #ffffff00;
            color: #c8cdd1;
            box-shadow: none;
        }

        input::placeholder, select.placeholder{
            color: #757575 !important; /* cinza */
        }

        .btn-padrao {
            background: linear-gradient(to right, #00b1f7, #2565db);
            color: #ffffff;
        }


        .tag-verde {
            background-color: #11302f;
            color: #10b97e;
        }

        .table-striped>tbody>tr:nth-of-type(odd)>* {
            --bs-table-color-type: var(--cor-text-0);
        }

        .offcanvas {
            background-color: var(--cor-sidebar);
        }

        label {
            color: var(--cor-text-01);
        }

        .btn-close {
            background-color: #ffffff;
        }

        p{
            color: var(--cor-text-01);
        }
    </style>
</head>
<body style="padding-top: 200px">

    <div class="container">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
