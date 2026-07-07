<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'JAPLO - Jasa Pengantar Lokal')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        
        :root {
            --primary-color: #00A859;
            --primary-dark: #008F4A;
            --accent-color: #FF6B35;
            --success-color: #4CAF50;
            --danger-color: #F44336;
            --warning-color: #FFC107;
            --info-color: #2196F3;
            --text-primary: #212121;
            --text-secondary: #757575;
            --background: #F5F5F5;
        }
        
        body {
            background-color: var(--background);
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .btn-primary {
            background: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 168, 89, 0.3);
        }
        
        .btn-accent {
            background: var(--accent-color);
            border: none;
            color: white;
            border-radius: 8px;
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-accent:hover {
            background: #E55A2B;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.3);
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s;
        }
        
        .card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
            transform: translateY(-4px);
        }
        
        .form-control {
            border-radius: 8px;
            border: 1px solid #E0E0E0;
            padding: 12px 16px;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(0, 168, 89, 0.15);
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 60px 0;
            border-radius: 0 0 30px 30px;
            margin-bottom: 40px;
        }
        
        .feature-card {
            text-align: center;
            padding: 30px;
            cursor: pointer;
        }
        
        .feature-card i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--primary-color);
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
        }
        
        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .stat-card .stat-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }
        
        .badge-status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        
        .badge-pending {
            background: #FFF3E0;
            color: #F57C00;
        }
        
        .badge-accepted {
            background: #E3F2FD;
            color: #1976D2;
        }
        
        .badge-completed {
            background: #E8F5E9;
            color: #388E3C;
        }
        
        .badge-cancelled {
            background: #FFEBEE;
            color: #D32F2F;
        }
        
        .footer {
            background: var(--text-primary);
            color: white;
            padding: 30px 0;
            margin-top: 60px;
        }
        
        .alert {
            border-radius: 8px;
            border: none;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-motorcycle me-2"></i> JAPLO
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-accent text-white ms-2" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Keluar</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="fas fa-motorcycle me-2"></i> JAPLO</h5>
                    <p class="text-light">Jasa Pengantar Lokal - Platform ojek online terpercaya.</p>
                </div>
                <div class="col-md-4">
                    <h6>Menu</h6>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-light text-decoration-none">Beranda</a></li>
                        <li><a href="/tentang" class="text-light text-decoration-none">Tentang Kami</a></li>
                        <li><a href="/bantuan" class="text-light text-decoration-none">Bantuan</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h6>Kontak</h6>
                    <p class="text-light mb-1"><i class="fas fa-envelope me-2"></i> support@japlo.id</p>
                    <p class="text-light mb-1"><i class="fas fa-phone me-2"></i> +62 xxx xxx xxxx</p>
                    <div class="mt-3">
                        <a href="#" class="text-light me-3"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-light me-3"><i class="fab fa-twitter fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <hr class="bg-light">
            <div class="text-center text-light">
                <p class="mb-0">&copy; 2024 JAPLO. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    @stack('scripts')
</body>
</html>
