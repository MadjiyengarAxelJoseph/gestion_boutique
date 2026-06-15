<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Boutique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: #0f0f0f;
            color: #e0e0e0;
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: linear-gradient(135deg, #1a1a1a, #2d2d2d) !important;
            border-bottom: 1px solid #333;
            padding: 15px 30px;
            box-shadow: 0 2px 20px rgba(0,0,0,0.5);
        }

        .navbar-brand {
            font-size: 1.4rem;
            font-weight: 700;
            color: #fff !important;
            letter-spacing: 1px;
        }

        .navbar-brand span {
            color: #f0a500;
        }

        .nav-link {
            color: #aaa !important;
            font-weight: 500;
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: all 0.3s;
            margin: 0 4px;
        }

        .nav-link:hover {
            color: #fff !important;
            background: rgba(240,165,0,0.15);
        }

        .nav-link.active {
            color: #f0a500 !important;
            background: rgba(240,165,0,0.1);
        }

        .main-content {
            flex: 1;
            padding: 40px 30px;
        }

        /* CARDS */
        .card {
            background: #1a1a1a;
            border: 1px solid #2a2a2a;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }

        .card-header {
            border-radius: 16px 16px 0 0 !important;
            border-bottom: 1px solid #2a2a2a;
            padding: 20px 25px;
        }

        .card-header.bg-primary {
            background: linear-gradient(135deg, #1a1a2e, #16213e) !important;
            border-left: 4px solid #f0a500;
        }

        .card-header.bg-warning {
            background: linear-gradient(135deg, #2a1f00, #3d2e00) !important;
            border-left: 4px solid #f0a500;
        }

        .card-header.bg-info {
            background: linear-gradient(135deg, #001a2a, #002a3d) !important;
            border-left: 4px solid #00bcd4;
        }

        .card-header h4 {
            color: #fff;
            font-weight: 600;
            margin: 0;
        }

        .card-body {
            padding: 25px;
        }

        /* TABLES */
        .table {
            color: #ddd;
            border-color: #2a2a2a;
        }

        .table-dark th {
            background: #111 !important;
            color: #f0a500;
            border-color: #333;
            font-weight: 600;
            letter-spacing: 0.5px;
            padding: 14px 16px;
        }

        .table td {
            border-color: #222;
            padding: 12px 16px;
            vertical-align: middle;
        }

        .table-striped > tbody > tr:nth-of-type(odd) > * {
            background-color: #161616;
            color: #ddd;
        }

        .table-hover > tbody > tr:hover > * {
            background-color: #222;
            color: #fff;
        }

        /* BUTTONS */
        .btn-primary {
            background: linear-gradient(135deg, #f0a500, #e09000);
            border: none;
            color: #000;
            font-weight: 600;
            border-radius: 8px;
            padding: 8px 20px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #ffb700, #f0a500);
            color: #000;
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(240,165,0,0.3);
        }

        .btn-warning {
            background: linear-gradient(135deg, #333, #444);
            border: 1px solid #555;
            color: #f0a500;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #444, #555);
            color: #ffb700;
            transform: translateY(-1px);
        }

        .btn-danger {
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(231,76,60,0.3);
        }

        .btn-secondary {
            background: #2a2a2a;
            border: 1px solid #444;
            color: #aaa;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            background: #333;
            color: #fff;
        }

        .btn-info {
            background: linear-gradient(135deg, #0097a7, #00bcd4);
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-info:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(0,188,212,0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, #1b5e20, #2e7d32);
            border: none;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-success:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(46,125,50,0.3);
        }

        .btn-light {
            background: #2a2a2a;
            border: 1px solid #444;
            color: #ddd;
            border-radius: 8px;
        }

        /* formulaire */
        .form-control, .form-select {
            background: #111;
            border: 1px solid #333;
            color: #ddd;
            border-radius: 8px;
            padding: 10px 14px;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            background: #161616;
            border-color: #f0a500;
            color: #fff;
            box-shadow: 0 0 0 3px rgba(240,165,0,0.15);
        }

        .form-label {
            color: #aaa;
            font-weight: 500;
            margin-bottom: 6px;
        }

        textarea.form-control {
            min-height: 100px;
        }

        /* alèrte */
        .alert-success {
            background: #0d2b0d;
            border: 1px solid #1b5e20;
            color: #81c784;
            border-radius: 10px;
        }

        .alert-danger {
            background: #2b0d0d;
            border: 1px solid #c62828;
            color: #ef9a9a;
            border-radius: 10px;
        }

        /* BADGES */
        .badge {
            border-radius: 6px;
            padding: 5px 10px;
            font-size: 0.8rem;
        }

        /* titre de la page */
        h2 {
            color: #fff;
            font-weight: 700;
            font-size: 1.6rem;
        }

        h4, h5 {
            color: #ddd;
        }

        /* FOOTER */
        footer {
            background: linear-gradient(135deg, #111, #1a1a1a);
            border-top: 1px solid #2a2a2a;
            padding: 25px 30px;
            text-align: center;
            color: #666;
            font-size: 0.9rem;
        }

        footer a {
            color: #f0a500;
            text-decoration: none;
            transition: color 0.3s;
        }

        footer a:hover {
            color: #ffb700;
        }

        footer .footer-divider {
            color: #333;
            margin: 0 10px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .navbar {
                padding: 10px 15px;
            }

            .navbar-brand {
                font-size: 1.1rem;
            }

            .nav-link {
                padding: 6px 10px !important;
                margin: 2px 0;
                font-size: 0.9rem;
            }

            .main-content {
                padding: 20px 15px;
            }

            h2 {
                font-size: 1.3rem;
            }

            .card-body {
                padding: 15px;
            }

            /* Boutons plus grands sur mobile */
            .btn {
                padding: 10px 16px;
                font-size: 0.95rem;
            }

            /* Stack les boutons d'action verticalement */
            .d-flex.gap-2 {
                flex-direction: column;
            }

            /* Tables scrollables sur mobile */
            .table-responsive-wrapper {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                border-radius: 10px;
            }

            /* Cacher certaines colonnes sur mobile */
            .hide-mobile {
                display: none !important;
            }

            footer {
                padding: 15px;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 576px) {
            .navbar-nav {
                flex-direction: row;
                justify-content: center;
                margin-top: 10px;
                flex-wrap: wrap;
            }

            .main-content {
                padding: 15px 10px;
            }

            .card-header h4 {
                font-size: 1rem;
            }

            .btn-sm {
                padding: 6px 10px;
                font-size: 0.8rem;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .main-content {
                padding: 30px 20px;
            }

            .nav-link {
                padding: 6px 12px !important;
            }
        }

    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('clients.index') }}">
            <i class="fas fa-store me-2"></i>Gestion<span>Boutique</span>
        </a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link {{ request()->is('clients*') ? 'active' : '' }}"
               href="{{ route('clients.index') }}">
                <i class="fas fa-users me-1"></i> Clients
            </a>
            <a class="nav-link {{ request()->is('produits*') ? 'active' : '' }}"
               href="{{ route('produits.index') }}">
                <i class="fas fa-box me-1"></i> Produits
            </a>
            <a class="nav-link {{ request()->is('commandes*') ? 'active' : '' }}"
               href="{{ route('commandes.index') }}">
                <i class="fas fa-shopping-cart me-1"></i> Commandes
            </a>
        </div>
    </div>
</nav>

<div class="main-content">
    <div class="container-fluid">

        @if(session('success'))
            <div class="alert alert-success mb-4">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        @yield('content')

    </div>
</div>

<footer>
    <div class="mb-1">
        <i class="fas fa-store me-2" style="color:#f0a500"></i>
        <strong style="color:#ddd">GestionBoutique</strong>
        <span class="footer-divider">|</span>
    </div>
    <div>
        <i class="fas fa-envelope me-1" style="color:#f0a500"></i>
        <a href="mailto:axelmadjiyengar@gmail.com">axelmadjiyengar@gmail.com</a>
        <span class="footer-divider">|</span>
        <strong style="color:#ddd">Site devéloppé par MADJIYENGAR Axel Joseph</strong>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>