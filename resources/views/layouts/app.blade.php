<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#16A34A">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="JAPLO">
    <meta name="description" content="Platform jasa pengantar lokal untuk masyarakat Bintan">
    <title>@yield('title', 'JAPLO - Jasa Pengantar Lokal')</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome 6 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- JAPLO Global CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>
<body>

{{-- ======================== NAVBAR ======================== --}}
<nav class="jp-navbar navbar navbar-expand-lg">
    <div class="container">

        <a class="navbar-brand" href="{{ route('home') }}">
            <span class="brand-icon"><i class="fas fa-motorcycle"></i></span>
            JAPLO
        </a>

        <button class="navbar-toggler border-0 text-white" type="button"
                data-bs-toggle="collapse" data-bs-target="#jpNav"
                aria-controls="jpNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="jpNav">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item ms-lg-2">
                        <a class="nav-link btn-nav-cta" href="{{ route('register') }}">Daftar</a>
                    </li>

                @else
                    @php $user = auth()->user(); @endphp

                    {{-- ── ADMIN NAV ── --}}
                    @if($user->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-gauge-high me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-users me-1"></i> Pengguna
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.users') }}">
                                    <i class="fas fa-user me-2" style="color:var(--jp-green)"></i> Customer
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.drivers') }}">
                                    <i class="fas fa-id-card me-2" style="color:var(--jp-green)"></i> Driver
                                </a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-sliders me-1"></i> Konten
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.restaurants') }}">
                                    <i class="fas fa-utensils me-2" style="color:#EF4444"></i> Restoran & Menu
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.products') }}">
                                    <i class="fas fa-bag-shopping me-2" style="color:#8B5CF6"></i> Produk
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.health_services') }}">
                                    <i class="fas fa-kit-medical me-2" style="color:#3B82F6"></i> Kesehatan
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.promotions') }}">
                                    <i class="fas fa-tag me-2" style="color:#F59E0B"></i> Promosi
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.articles') }}">
                                    <i class="fas fa-newspaper me-2" style="color:#F97316"></i> Artikel
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.tariffs') }}">
                                    <i class="fas fa-coins me-2" style="color:var(--jp-green)"></i> Tarif
                                </a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-receipt me-1"></i> Transaksi
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.orders') }}">
                                    <i class="fas fa-motorcycle me-2" style="color:var(--jp-green)"></i> Ojek/Taksi
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.packages') }}">
                                    <i class="fas fa-box me-2" style="color:#8B5CF6"></i> Paket
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.market_orders') }}">
                                    <i class="fas fa-cart-shopping me-2" style="color:var(--jp-green)"></i> Belanja Pasar
                                </a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-handshake me-1"></i> Registrasi
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.mitra_registrations') }}">
                                    <i class="fas fa-handshake me-2" style="color:var(--jp-green)"></i> Mitra Usaha
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.expo_registrations') }}">
                                    <i class="fas fa-store me-2" style="color:#F59E0B"></i> Tenant Expo
                                </a></li>
                            </ul>
                        </li>

                    {{-- ── DRIVER NAV ── --}}
                    @elseif($user->isDriver())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="fas fa-gauge me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('order.history') }}">
                                <i class="fas fa-list me-1"></i> Riwayat
                            </a>
                        </li>

                    {{-- ── CUSTOMER NAV ── --}}
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="fas fa-house me-1"></i> Beranda
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-grid-2 me-1"></i> Layanan
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('customer.ojek') }}">
                                    <i class="fas fa-motorcycle me-2" style="color:#16A34A"></i> Ojek / Taksi
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('customer.kuliner') }}">
                                    <i class="fas fa-bowl-food me-2" style="color:#EF4444"></i> Kuliner
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('customer.paket') }}">
                                    <i class="fas fa-box me-2" style="color:#8B5CF6"></i> Kirim Paket
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('customer.pasar') }}">
                                    <i class="fas fa-cart-shopping me-2" style="color:#16A34A"></i> Belanja Pasar
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('customer.kesehatan') }}">
                                    <i class="fas fa-kit-medical me-2" style="color:#3B82F6"></i> Kesehatan
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('customer.produk') }}">
                                    <i class="fas fa-bag-shopping me-2" style="color:#8B5CF6"></i> Produk
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('customer.pencetakan') }}">
                                    <i class="fas fa-print me-2" style="color:#6B7280"></i> Percetakan
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('customer.promosi') }}">
                                    <i class="fas fa-tag me-2" style="color:#F59E0B"></i> Promosi
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('customer.trending') }}">
                                    <i class="fas fa-fire me-2" style="color:#F97316"></i> Trending
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('customer.sosial') }}">
                                    <i class="fas fa-people-group me-2" style="color:#0EA5E9"></i> Sosial
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('customer.mitra') }}">
                                    <i class="fas fa-handshake me-2" style="color:#16A34A"></i> Daftar Mitra
                                </a></li>
                                <li><a class="dropdown-item" href="{{ route('customer.expo') }}">
                                    <i class="fas fa-store me-2" style="color:#F59E0B"></i> Daftar Expo
                                </a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('order.history') }}">
                                <i class="fas fa-clock-rotate-left me-1"></i> Riwayat
                            </a>
                        </li>
                    @endif

                    {{-- ── USER MENU ── --}}
                    <li class="nav-item dropdown ms-lg-2">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                           role="button" data-bs-toggle="dropdown">
                            <span class="nav-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            <span class="d-none d-lg-inline">{{ Str::limit($user->name, 14) }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <div class="px-3 py-2" style="border-bottom:1px solid var(--jp-gray-200)">
                                    <div style="font-size:.875rem;font-weight:600;color:var(--jp-gray-900)">
                                        {{ $user->name }}
                                    </div>
                                    <div style="font-size:.78rem;color:var(--jp-gray-400)">{{ $user->email }}</div>
                                </div>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user me-2" style="color:var(--jp-green)"></i> Profil Saya
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-right-from-bracket me-2"></i> Keluar
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
{{-- ======================== END NAVBAR ======================== --}}

{{-- Toast container --}}
<div id="jp-toast-container"></div>

{{-- Flash messages --}}
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            JapToast.success('{{ addslashes(session('success')) }}');
        });
    </script>
@endif
@if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            JapToast.error('{{ addslashes(session('error')) }}');
        });
    </script>
@endif
@if(session('warning'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            JapToast.warning('{{ addslashes(session('warning')) }}');
        });
    </script>
@endif

{{-- Main content --}}
<main>@yield('content')</main>

{{-- ======================== FOOTER ======================== --}}
<footer class="jp-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="footer-brand mb-2">
                    <i class="fas fa-motorcycle me-2"></i>JAPLO
                </div>
                <p style="font-size:.85rem;color:#9CA3AF;max-width:260px;line-height:1.6">
                    Platform jasa pengantar lokal untuk masyarakat Bintan.
                    Cepat, aman, dan terpercaya. Berdiri sejak 2018.
                </p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="col-md-2">
                <div style="font-weight:600;color:#fff;margin-bottom:.75rem;font-size:.875rem">Layanan</div>
                <ul class="list-unstyled" style="line-height:2">
                    <li><a href="{{ route('customer.ojek') }}">Ojek / Taksi</a></li>
                    <li><a href="{{ route('customer.kuliner') }}">Kuliner</a></li>
                    <li><a href="{{ route('customer.paket') }}">Kirim Paket</a></li>
                    <li><a href="{{ route('customer.pasar') }}">Belanja Pasar</a></li>
                    <li><a href="{{ route('customer.kesehatan') }}">Kesehatan</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <div style="font-weight:600;color:#fff;margin-bottom:.75rem;font-size:.875rem">Bergabung</div>
                <ul class="list-unstyled" style="line-height:2">
                    <li><a href="{{ route('register') }}?role=driver">Daftar Driver</a></li>
                    <li><a href="{{ route('customer.mitra') }}">Daftar Mitra</a></li>
                    <li><a href="{{ route('customer.expo') }}">Daftar Expo</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <div style="font-weight:600;color:#fff;margin-bottom:.75rem;font-size:.875rem">Kontak</div>
                <p style="font-size:.85rem;color:#9CA3AF;margin-bottom:.5rem">
                    <i class="fas fa-envelope me-2" style="color:var(--jp-green)"></i>support@japlo.id
                </p>
                <p style="font-size:.85rem;color:#9CA3AF;margin-bottom:.5rem">
                    <i class="fas fa-phone me-2" style="color:var(--jp-green)"></i>+62 771 xxx xxxx
                </p>
                <p style="font-size:.85rem;color:#9CA3AF">
                    <i class="fas fa-location-dot me-2" style="color:var(--jp-green)"></i>Tanjung Uban, Bintan, Kepri
                </p>
            </div>
        </div>
        <hr class="jp-divider">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <p class="footer-copy mb-0">&copy; {{ date('Y') }} JAPLO. Hak cipta dilindungi.</p>
            <div class="d-flex gap-3" style="font-size:.8125rem">
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>
{{-- ======================== END FOOTER ======================== --}}

{{-- ======================== BOTTOM NAV MOBILE ======================== --}}
@auth
<nav class="jp-bottom-nav d-lg-none">
    <a href="{{ route('dashboard') }}"
       class="jp-bottom-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <i class="fas fa-house"></i>
        <span>Beranda</span>
    </a>

    @if(auth()->user()->isCustomer())
        <a href="{{ route('customer.ojek') }}"
           class="jp-bottom-nav-item {{ request()->routeIs('customer.ojek') ? 'active' : '' }}">
            <i class="fas fa-motorcycle"></i>
            <span>Ojek</span>
        </a>
        <a href="{{ route('customer.kuliner') }}"
           class="jp-bottom-nav-item {{ request()->routeIs('customer.kuliner*') ? 'active' : '' }}">
            <i class="fas fa-bowl-food"></i>
            <span>Kuliner</span>
        </a>
        <a href="{{ route('order.history') }}"
           class="jp-bottom-nav-item {{ request()->routeIs('order.history') ? 'active' : '' }}">
            <i class="fas fa-clock-rotate-left"></i>
            <span>Riwayat</span>
        </a>

    @elseif(auth()->user()->isDriver())
        <a href="{{ route('order.history') }}"
           class="jp-bottom-nav-item {{ request()->routeIs('order.history') ? 'active' : '' }}">
            <i class="fas fa-list"></i>
            <span>Riwayat</span>
        </a>

    @elseif(auth()->user()->isAdmin())
        <a href="{{ route('admin.orders') }}"
           class="jp-bottom-nav-item {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
            <i class="fas fa-receipt"></i>
            <span>Pesanan</span>
        </a>
        <a href="{{ route('admin.drivers') }}"
           class="jp-bottom-nav-item {{ request()->routeIs('admin.drivers') ? 'active' : '' }}">
            <i class="fas fa-id-card"></i>
            <span>Driver</span>
        </a>
    @endif

    <a href="{{ route('profile') }}"
       class="jp-bottom-nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
        <i class="fas fa-user-circle"></i>
        <span>Profil</span>
    </a>
</nav>
@endauth
{{-- ======================== END BOTTOM NAV ======================== --}}

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
{{-- JAPLO Global JS --}}
<script src="{{ asset('js/app.js') }}"></script>

@stack('scripts')
</body>
</html>
