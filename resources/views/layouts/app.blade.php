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
            --border-color: #E0E0E0;
        }
        
        /* Smooth Transitions */
        * {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
        }
        
        body {
            background-color: var(--background);
            overflow-x: hidden;
        }
        
        /* ============= ANIMATIONS ============= */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* ============= UTILITY CLASSES ============= */
        .fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
        }
        
        .slide-in-right {
            animation: slideInRight 0.5s ease-out forwards;
        }
        
        .pulse-animation {
            animation: pulse 2s ease-in-out infinite;
        }
        
        .bounce-animation {
            animation: bounce 1s ease-in-out infinite;
        }
        
        .shake-animation {
            animation: shake 0.5s ease-in-out;
        }
        
        /* ============= HERO BACKGROUNDS ============= */
        .hero-background {
            position: relative;
            background: linear-gradient(135deg, rgba(0, 168, 89, 0.9) 0%, rgba(0, 143, 74, 0.8) 100%);
            overflow: hidden;
        }
        
        .hero-background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=1200&q=80');
            background-size: cover;
            background-position: center;
            opacity: 0.3;
            z-index: 0;
        }
        
        .hero-background-overlay {
            position: relative;
            z-index: 1;
        }
        
        .hero-driver-bg {
            position: relative;
            min-height: 500px;
            background: linear-gradient(135deg, rgba(0, 168, 89, 0.85) 0%, rgba(0, 143, 74, 0.75) 100%), 
                        url('https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=1200&q=80');
            background-size: cover;
            background-position: center right;
            background-attachment: fixed;
        }
        
        .hero-driver-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, rgba(0, 168, 89, 0.95) 0%, rgba(0, 168, 89, 0.4) 70%, transparent 100%);
            z-index: 1;
        }
        
        .hero-content-wrapper {
            position: relative;
            z-index: 2;
        }
        
        /* ============= NAVBAR STYLES ============= */
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            transition: all 0.3s;
        }
        
        .navbar-brand:hover {
            transform: scale(1.05);
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            box-shadow: 0 4px 15px rgba(0, 168, 89, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .nav-link {
            position: relative;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            right: 0;
            height: 2px;
            background: white;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s;
        }
        
        .nav-link:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }
        
        /* ============= BUTTON STYLES ============= */
        .btn {
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.3s;
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        .btn-primary {
            background: var(--primary-color);
            border: 2px solid var(--primary-color);
            color: white;
            position: relative;
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 168, 89, 0.4);
        }
        
        .btn-primary:active {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 168, 89, 0.3);
        }
        
        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }
        
        .btn-accent {
            background: var(--accent-color);
            border: 2px solid var(--accent-color);
            color: white;
        }
        
        .btn-accent:hover {
            background: #E55A2B;
            border-color: #E55A2B;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.4);
        }
        
        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(76, 175, 80, 0.4);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            transition: all 0.3s;
        }
        
        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }
        
        /* ============= FORM STYLES ============= */
        .form-control {
            border-radius: 10px;
            border: 2px solid var(--border-color);
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.3rem rgba(0, 168, 89, 0.1);
            transform: translateY(-2px);
        }
        
        .form-control.is-invalid {
            border-color: var(--danger-color);
            animation: shake 0.5s;
        }
        
        .form-control.is-valid {
            border-color: var(--success-color);
        }
        
        .form-label {
            color: var(--text-primary);
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .form-floating > .form-control {
            height: calc(3.5rem + 2px);
            line-height: 1.25;
        }
        
        .input-group-text {
            border: 2px solid var(--border-color);
            transition: all 0.3s;
        }
        
        .input-group:focus-within .input-group-text {
            border-color: var(--primary-color);
            background: var(--primary-color) !important;
        }
        
        /* ============= CARD STYLES ============= */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            position: relative;
        }
        
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            transform: scaleX(0);
            transition: transform 0.3s;
            transform-origin: left;
        }
        
        .card:hover {
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
            transform: translateY(-6px);
        }
        
        .card:hover::before {
            transform: scaleX(1);
        }
        
        /* ============= ALERT STYLES ============= */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideInRight 0.3s ease-out;
        }
        
        .alert-success {
            background: rgba(76, 175, 80, 0.1);
            color: #388E3C;
            border-left: 4px solid #4CAF50;
        }
        
        .alert-danger {
            background: rgba(244, 67, 54, 0.1);
            color: #D32F2F;
            border-left: 4px solid #F44336;
        }
        
        .alert-warning {
            background: rgba(255, 193, 7, 0.1);
            color: #F57F17;
            border-left: 4px solid #FFC107;
        }
        
        .alert-info {
            background: rgba(33, 150, 243, 0.1);
            color: #1565C0;
            border-left: 4px solid #2196F3;
        }
        
        /* ============= HERO SECTION ============= */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 60px 0;
            border-radius: 0 0 30px 30px;
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0, 168, 89, 0.2);
        }
        
        /* ============= FEATURE CARDS ============= */
        .feature-card {
            text-align: center;
            padding: 30px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .feature-card i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: var(--primary-color);
            transition: all 0.3s;
        }
        
        .feature-card:hover i {
            transform: scale(1.2) rotate(10deg);
        }
        
        /* ============= STAT CARD ============= */
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            transition: all 0.3s;
            border: 2px solid transparent;
        }
        
        .stat-card:hover {
            border-color: var(--primary-color);
            box-shadow: 0 8px 20px rgba(0, 168, 89, 0.2);
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
        
        /* ============= BADGE STYLES ============= */
        .badge-status {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-block;
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
        
        /* ============= FOOTER ============= */
        .footer {
            background: linear-gradient(135deg, var(--text-primary) 0%, #1a1a1a 100%);
            color: white;
            padding: 40px 0 20px;
            margin-top: 60px;
            box-shadow: 0 -5px 20px rgba(0, 0, 0, 0.1);
        }
        
        .footer a {
            transition: all 0.3s;
            color: #BBB;
        }
        
        .footer a:hover {
            color: var(--primary-color);
            transform: translateX(5px);
        }
        
        /* ============= ADDITIONAL UTILITIES ============= */
        .backdrop-blur {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        .shadow-modern {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }
        
        .animated-gradient {
            background: linear-gradient(135deg, #00A859, #008F4A, #00C16A);
            background-size: 200% 200%;
            animation: gradientShift 10s ease infinite;
        }
        
        /* Loading skeleton */
        .skeleton {
            animation: pulse 2s ease-in-out infinite;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* ============= RESPONSIVE ============= */
        @media (max-width: 768px) {
            .hero-driver-bg {
                background-attachment: scroll;
            }
            
            .btn {
                width: 100%;
            }
            
            .form-control {
                font-size: 16px; /* Prevents zoom on iOS */
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <i class="fas fa-motorcycle me-2"></i> JAPLO
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-home me-1"></i> Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i> Masuk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-accent text-white ms-2" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i> Daftar
                            </a>
                        </li>
                    @else
                        @if(auth()->user()->isAdmin())
                            <!-- Admin Navigation -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">
                                    <i class="fas fa-chart-line me-1"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-users me-1"></i> Manajemen
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('admin.users') }}">
                                        <i class="fas fa-user-circle me-2"></i> Users
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.drivers') }}">
                                        <i class="fas fa-id-card me-2"></i> Drivers
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('admin.orders') }}">
                                        <i class="fas fa-receipt me-2"></i> Orders
                                    </a></li>
                                </ul>
                            </li>
                        @elseif(auth()->user()->isCustomer())
                            <!-- Customer Navigation -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">
                                    <i class="fas fa-home me-1"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-th me-1"></i> Layanan
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('customer.ojek') }}">
                                        <i class="fas fa-motorcycle me-2 text-primary"></i> Ojek & Taxi
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('customer.kuliner') }}">
                                        <i class="fas fa-utensils me-2 text-danger"></i> Kuliner
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('customer.kesehatan') }}">
                                        <i class="fas fa-hospital me-2 text-danger"></i> Kesehatan
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('customer.produk') }}">
                                        <i class="fas fa-shopping-bag me-2 text-info"></i> Produk
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('customer.pencetakan') }}">
                                        <i class="fas fa-print me-2 text-dark"></i> Pencetakan
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="{{ route('customer.promosi') }}">
                                        <i class="fas fa-bullhorn me-2 text-success"></i> Promosi
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('customer.trending') }}">
                                        <i class="fas fa-fire me-2 text-warning"></i> Trending
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('customer.sosial') }}">
                                        <i class="fas fa-users me-2 text-primary"></i> Sosial
                                    </a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('order.history') }}">
                                    <i class="fas fa-list me-1"></i> Riwayat Pesanan
                                </a>
                            </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i> {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-edit me-2"></i> Profil
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i> Keluar
                                        </button>
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
    
    <!-- Toast Notifications Script -->
    <script>
        // Toast Notification System
        class Toast {
            static show(message, type = 'info', duration = 3000) {
                const toastContainer = document.getElementById('toastContainer') || this.createContainer();
                
                const toastId = 'toast-' + Date.now();
                const toastHTML = `
                    <div id="${toastId}" class="toast-notification toast-${type} fade-in-up" role="alert">
                        <div class="toast-content">
                            <i class="fas fa-check-circle toast-icon"></i>
                            <span class="toast-message">${message}</span>
                            <button type="button" class="toast-close" onclick="this.parentElement.parentElement.remove()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                `;
                
                toastContainer.insertAdjacentHTML('beforeend', toastHTML);
                
                if (duration > 0) {
                    setTimeout(() => {
                        const toast = document.getElementById(toastId);
                        if (toast) toast.classList.add('fade-out');
                        setTimeout(() => {
                            toast?.remove();
                        }, 300);
                    }, duration);
                }
            }
            
            static success(message, duration = 3000) {
                this.show(message, 'success', duration);
            }
            
            static error(message, duration = 5000) {
                this.show(message, 'error', duration);
            }
            
            static warning(message, duration = 4000) {
                this.show(message, 'warning', duration);
            }
            
            static info(message, duration = 3000) {
                this.show(message, 'info', duration);
            }
            
            static createContainer() {
                const container = document.createElement('div');
                container.id = 'toastContainer';
                container.className = 'toast-container';
                document.body.appendChild(container);
                return container;
            }
        }
        
        // Initialize toast container on page load
        document.addEventListener('DOMContentLoaded', () => {
            Toast.createContainer();
        });
        
        // Global form validation
        class FormValidator {
            static validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }
            
            static validatePhone(phone) {
                const re = /^(\+62|0)[0-9]{9,12}$/;
                return re.test(phone.replace(/\s/g, ''));
            }
            
            static validatePassword(password) {
                return password.length >= 6;
            }
            
            static validateRequired(value) {
                return value.trim().length > 0;
            }
        }
        
        // Auto-dismiss alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.add('fade-out');
                    setTimeout(() => alert.remove(), 300);
                }, 5000);
            });
        });
    </script>
    
    <!-- Toast Styles -->
    <style>
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 400px;
        }
        
        .toast-notification {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 300px;
            border-left: 4px solid #2196F3;
            animation: slideInRight 0.3s ease-out;
        }
        
        .toast-notification.toast-success {
            border-left-color: #4CAF50;
        }
        
        .toast-notification.toast-success .toast-icon {
            color: #4CAF50;
        }
        
        .toast-notification.toast-error {
            border-left-color: #F44336;
        }
        
        .toast-notification.toast-error .toast-icon {
            color: #F44336;
        }
        
        .toast-notification.toast-warning {
            border-left-color: #FFC107;
        }
        
        .toast-notification.toast-warning .toast-icon {
            color: #FFC107;
        }
        
        .toast-notification.toast-info {
            border-left-color: #2196F3;
        }
        
        .toast-notification.toast-info .toast-icon {
            color: #2196F3;
        }
        
        .toast-content {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
        }
        
        .toast-icon {
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        
        .toast-message {
            color: #333;
            font-weight: 500;
            flex: 1;
        }
        
        .toast-close {
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 1rem;
            padding: 0;
            display: flex;
            align-items: center;
            transition: color 0.3s;
        }
        
        .toast-close:hover {
            color: #333;
        }
        
        .fade-out {
            animation: fadeOut 0.3s ease-out forwards;
        }
        
        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(100px);
            }
        }
        
        @media (max-width: 768px) {
            .toast-container {
                left: 10px;
                right: 10px;
                max-width: none;
            }
            
            .toast-notification {
                min-width: auto;
            }
        }
    </style>
    
    @stack('scripts')
</body>
</html>
