<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>JAPLO — Jasa Pengantar Lokal Bintan</title>
    <meta name="description" content="Platform jasa pengantar lokal pertama untuk masyarakat Bintan. Ojek, kuliner, kirim paket, belanja pasar, dan banyak lagi.">

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- Landing Page CSS --}}
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>

{{-- ═══════════════════════════════════════
     TOP BAR
════════════════════════════════════════ --}}
<div class="topbar d-none d-md-block">
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-location-dot me-1"></i>
                Melayani Wilayah Bintan, Kepulauan Riau
                <span class="sep">|</span>
                <i class="fas fa-phone me-1"></i>
                Bantuan: +62 771 xxx xxxx
            </div>
            <div class="topbar-right d-flex gap-3">
                <a href="{{ route('register') }}?role=driver">
                    <i class="fas fa-motorcycle me-1"></i> Jadi Driver JAPLO
                </a>
                <a href="{{ route('customer.mitra') }}">
                    <i class="fas fa-store me-1"></i> Daftar Mitra Usaha
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     NAVBAR
════════════════════════════════════════ --}}
<nav class="jp-navbar">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center gap-3">

            {{-- Brand --}}
            <a href="{{ route('home') }}" class="brand">
                <span class="brand-icon"><i class="fas fa-motorcycle"></i></span>
                JAPLO
            </a>

            {{-- Search bar --}}
            <div class="search-wrap d-none d-md-block">
                <form action="{{ route('login') }}" method="GET">
                    <input type="text"
                           placeholder="Cari layanan, produk, kuliner di Bintan...">
                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            {{-- Actions --}}
            <div class="nav-actions ms-auto">
                @auth
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-house"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('order.history') }}">
                        <i class="fas fa-receipt"></i>
                        <span>Pesanan</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-login">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-daftar">Daftar</a>
                @endauth
            </div>

        </div>

        {{-- Search mobile --}}
        <div class="search-wrap d-md-none mt-2">
            <form action="{{ route('login') }}" method="GET">
                <input type="text" placeholder="Cari di JAPLO...">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
</nav>

{{-- ═══════════════════════════════════════
     CATEGORY BAR
════════════════════════════════════════ --}}
<div class="catbar">
    <div class="container-fluid px-4">
        <ul>
            @php
                $cats = [
                    ['route'=>'customer.ojek',      'icon'=>'fas fa-motorcycle',    'color'=>'#16A34A', 'label'=>'Ojek/Taksi'],
                    ['route'=>'customer.kuliner',    'icon'=>'fas fa-bowl-food',     'color'=>'#EF4444', 'label'=>'Kuliner'],
                    ['route'=>'customer.paket',      'icon'=>'fas fa-box',           'color'=>'#8B5CF6', 'label'=>'Kirim Paket'],
                    ['route'=>'customer.pasar',      'icon'=>'fas fa-cart-shopping', 'color'=>'#16A34A', 'label'=>'Belanja Pasar'],
                    ['route'=>'customer.kesehatan',  'icon'=>'fas fa-kit-medical',   'color'=>'#3B82F6', 'label'=>'Kesehatan'],
                    ['route'=>'customer.produk',     'icon'=>'fas fa-bag-shopping',  'color'=>'#8B5CF6', 'label'=>'Produk'],
                    ['route'=>'customer.pencetakan', 'icon'=>'fas fa-print',         'color'=>'#6B7280', 'label'=>'Cetak'],
                    ['route'=>'customer.promosi',    'icon'=>'fas fa-tag',           'color'=>'#F59E0B', 'label'=>'Promo'],
                    ['route'=>'customer.trending',   'icon'=>'fas fa-fire',          'color'=>'#F97316', 'label'=>'Trending'],
                    ['route'=>'customer.sosial',     'icon'=>'fas fa-people-group',  'color'=>'#0EA5E9', 'label'=>'Komunitas'],
                    ['route'=>'customer.mitra',      'icon'=>'fas fa-handshake',     'color'=>'#16A34A', 'label'=>'Jadi Mitra'],
                    ['route'=>'customer.expo',       'icon'=>'fas fa-store',         'color'=>'#F59E0B', 'label'=>'Expo'],
                ];
            @endphp
            @foreach($cats as $cat)
                <li>
                    <a href="{{ route($cat['route']) }}">
                        <i class="{{ $cat['icon'] }}" style="color:{{ $cat['color'] }}"></i>
                        {{ $cat['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

{{-- ═══════════════════════════════════════
     HERO BANNER SLIDER
════════════════════════════════════════ --}}
<div class="hero-section">
    <div class="container-fluid px-4">
        <div class="hero-main">

            {{-- Slider utama --}}
            <div class="hero-banner-main">

                <div class="hero-slide hero-slide-1 active">
                    <div class="hero-content">
                        <span class="badge-hero">🏍️ Layanan Ojek Lokal</span>
                        <h1>Pesan Ojek<br>Cepat & Murah</h1>
                        <p>Antar jemput ke mana saja di Bintan.<br>Harga transparan, driver terverifikasi.</p>
                        <a href="{{ route('register') }}" class="btn-hero">
                            <i class="fas fa-bolt"></i> Pesan Sekarang
                        </a>
                    </div>
                </div>

                <div class="hero-slide hero-slide-2">
                    <div class="hero-content">
                        <span class="badge-hero">🛒 Belanja Pasar</span>
                        <h1>Titip Belanja<br>di Pasar Bintan</h1>
                        <p>Pesan belanjaan dari pasar tradisional.<br>Driver belanja, langsung antar ke rumah.</p>
                        <a href="{{ route('register') }}" class="btn-hero">
                            <i class="fas fa-cart-shopping"></i> Titip Belanja
                        </a>
                    </div>
                </div>

                <div class="hero-slide hero-slide-3">
                    <div class="hero-content">
                        <span class="badge-hero">🤝 Mitra Usaha</span>
                        <h1>Bergabung<br>Jadi Mitra JAPLO</h1>
                        <p>Daftarkan usahamu. Jangkau ribuan<br>pelanggan di seluruh Bintan.</p>
                        <a href="{{ route('register') }}" class="btn-hero">
                            <i class="fas fa-handshake"></i> Daftar Mitra
                        </a>
                    </div>
                </div>

                <div class="hero-dots">
                    <span class="active" data-slide="0"></span>
                    <span data-slide="1"></span>
                    <span data-slide="2"></span>
                </div>
            </div>

            {{-- Side banners --}}
            <div class="hero-side">
                <a href="{{ route('register') }}" class="hero-side-item hero-side-1">
                    <div class="text-center">
                        <div style="font-size:1.5rem;margin-bottom:.3rem">📦</div>
                        <div class="side-text">Kirim Paket</div>
                        <div class="side-sub">Motor & Mobil</div>
                    </div>
                </a>
                <a href="{{ route('register') }}" class="hero-side-item hero-side-2">
                    <div class="text-center">
                        <div style="font-size:1.5rem;margin-bottom:.3rem">🍜</div>
                        <div class="side-text">Pesan Kuliner</div>
                        <div class="side-sub">Warung Lokal Bintan</div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     FLASH PROMO BAR
════════════════════════════════════════ --}}
<div class="flash-bar">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div class="flash-title">
                <span class="fire">🔥</span>
                PROMO HARI INI
                <div class="countdown ms-2">
                    <span class="num" id="hh">00</span>
                    <span class="sep2">:</span>
                    <span class="num" id="mm">00</span>
                    <span class="sep2">:</span>
                    <span class="num" id="ss">00</span>
                </div>
            </div>
            <a href="{{ route('customer.promosi') }}"
               style="font-size:.8125rem;color:var(--jp-green);font-weight:600;text-decoration:none">
                Lihat Semua Promo <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     LAYANAN — Grid 6 kolom
════════════════════════════════════════ --}}
<div class="section">
    <div class="container-fluid px-4">
        <div class="section-head">
            <div class="section-title">
                <i class="fas fa-grid-2" style="color:var(--jp-green)"></i>
                Semua <span class="accent">Layanan JAPLO</span>
            </div>
        </div>
        <div class="svc-grid">
            @php
                $services = [
                    ['route'=>'customer.ojek',      'img'=>'ojek.svg',       'name'=>'Ojek/Taksi'],
                    ['route'=>'customer.kuliner',    'img'=>'kuliner.svg',    'name'=>'Kuliner'],
                    ['route'=>'customer.paket',      'img'=>'paket.svg',      'name'=>'Kirim Paket'],
                    ['route'=>'customer.pasar',      'img'=>'pasar.svg',      'name'=>'Belanja Pasar'],
                    ['route'=>'customer.kesehatan',  'img'=>'kesehatan.svg',  'name'=>'Kesehatan'],
                    ['route'=>'customer.produk',     'img'=>'produk.svg',     'name'=>'Produk'],
                    ['route'=>'customer.pencetakan', 'img'=>'pencetakan.svg', 'name'=>'Percetakan'],
                    ['route'=>'customer.promosi',    'img'=>'promosi.svg',    'name'=>'Iklan/Promo'],
                    ['route'=>'customer.trending',   'img'=>'trending.svg',   'name'=>'Trending'],
                    ['route'=>'customer.sosial',     'img'=>'sosial.svg',     'name'=>'Komunitas'],
                    ['route'=>'customer.mitra',      'img'=>'mitra.svg',      'name'=>'Mitra Usaha'],
                    ['route'=>'customer.expo',       'img'=>'expo.svg',       'name'=>'Mini Expo'],
                ];
            @endphp
            @foreach($services as $s)
                <a href="{{ route($s['route']) }}" class="svc-item">
                    <div class="svc-img-box">
                        <img src="{{ asset('images/icons/' . $s['img']) }}"
                             alt="{{ $s['name'] }}"
                             loading="lazy">
                    </div>
                    <span class="svc-name">{{ $s['name'] }}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     PROMO BANNER GRID
════════════════════════════════════════ --}}
<div class="section">
    <div class="container-fluid px-4">
        <div class="section-head">
            <div class="section-title">🎁 Promo & Penawaran Spesial</div>
            <a href="{{ route('customer.promosi') }}" class="section-more">Semua Promo →</a>
        </div>
        <div class="promo-grid">
            @php
                $promos = \App\Models\Promotion::active()->limit(4)->get();
                $gradients = [
                    'linear-gradient(135deg,#064E3B,#059669)',
                    'linear-gradient(135deg,#1E3A5F,#2563EB)',
                    'linear-gradient(135deg,#7C2D12,#EA580C)',
                    'linear-gradient(135deg,#4C1D95,#7C3AED)',
                ];
                $defaults = [
                    ['OJEKGRATIS',  'Gratis Ongkir Ojek',  '3 perjalanan pertama',       0],
                    ['MAKAN20',     'Diskon 20% Kuliner',  'Min. order Rp 25.000',        1],
                    ['CASHBACK5K',  'Cashback Rp 5.000',   'Belanja produk min. 50K',     2],
                    ['HUTBINTAN',   'Promo HUT Bintan',    'Semua layanan diskon 15%',    3],
                ];
            @endphp

            @if($promos->count() > 0)
                @foreach($promos as $i => $promo)
                    <a href="{{ route('customer.promosi') }}" class="promo-card">
                        <div class="promo-bg" style="background:{{ $gradients[$i % 4] }}">
                            @if($promo->promo_code)
                                <span class="promo-code">{{ $promo->promo_code }}</span>
                            @endif
                            <div class="promo-title">{{ $promo->title }}</div>
                            <div class="promo-sub">
                                {{ \Illuminate\Support\Str::limit($promo->description, 50) }}
                            </div>
                        </div>
                    </a>
                @endforeach
            @else
                @foreach($defaults as $d)
                    <a href="{{ route('customer.promosi') }}" class="promo-card">
                        <div class="promo-bg" style="background:{{ $gradients[$d[3]] }}">
                            <span class="promo-code">{{ $d[0] }}</span>
                            <div class="promo-title">{{ $d[1] }}</div>
                            <div class="promo-sub">{{ $d[2] }}</div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     STATS STRIP
════════════════════════════════════════ --}}
<div class="stats-strip">
    <div class="container-fluid px-4">
        <div class="row g-3">
            @php
                $totalUsers   = \App\Models\User::where('role', 'user')->count();
                $totalDrivers = \App\Models\User::where('role', 'driver')->count();
                $totalOrders  = \App\Models\Order::where('status', 'completed')->count();
            @endphp
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-num">{{ $totalUsers > 0 ? number_format($totalUsers) . '+' : '48.000+' }}</div>
                    <div class="stat-lbl">Pengguna Aktif</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-num">{{ $totalDrivers > 0 ? $totalDrivers . '+' : '200+' }}</div>
                    <div class="stat-lbl">Driver Aktif</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-num">{{ $totalOrders > 0 ? number_format($totalOrders) . '+' : '10.000+' }}</div>
                    <div class="stat-lbl">Pesanan Selesai</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-num">3</div>
                    <div class="stat-lbl">Kecamatan Dilayani</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     CARA KERJA
════════════════════════════════════════ --}}
<div class="section">
    <div class="container-fluid px-4">
        <div class="section-head">
            <div class="section-title">
                <i class="fas fa-circle-question" style="color:var(--jp-green)"></i>
                Cara Menggunakan JAPLO
            </div>
        </div>
        <div class="how-grid">
            @php
                $steps = [
                    ['icon'=>'👤', 'num'=>'1', 'title'=>'Daftar Akun',       'desc'=>'Buat akun gratis hanya dalam 1 menit'],
                    ['icon'=>'🔍', 'num'=>'2', 'title'=>'Pilih Layanan',     'desc'=>'Pilih dari 11 layanan yang tersedia'],
                    ['icon'=>'💳', 'num'=>'3', 'title'=>'Pesan & Bayar',     'desc'=>'Konfirmasi pesanan dan pilih metode bayar'],
                    ['icon'=>'✅', 'num'=>'4', 'title'=>'Selesai!',          'desc'=>'Lacak status pesanan secara real-time'],
                ];
            @endphp
            @foreach($steps as $s)
                <div class="how-item">
                    <div class="how-icon">{{ $s['icon'] }}</div>
                    <div class="how-num">{{ $s['num'] }}</div>
                    <div class="how-title">{{ $s['title'] }}</div>
                    <div class="how-desc">{{ $s['desc'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     CTA BOTTOM
════════════════════════════════════════ --}}
<div style="background:linear-gradient(135deg,#15803D,#16A34A);padding:2.5rem 0;margin-bottom:10px">
    <div class="container-fluid px-4">
        <div class="d-flex flex-column flex-md-row align-items-center
                    justify-content-between gap-3">
            <div style="color:#fff">
                <div style="font-size:1.25rem;font-weight:800;margin-bottom:.25rem">
                    Siap Merasakan Kemudahan JAPLO?
                </div>
                <div style="font-size:.875rem;color:rgba(255,255,255,.8)">
                    Daftar gratis sekarang dan mulai gunakan semua layanan lokal Bintan
                </div>
            </div>
            <div class="d-flex gap-2 flex-shrink-0">
                <a href="{{ route('register') }}?role=user"
                   style="background:#fff;color:#15803D;font-weight:700;font-size:.875rem;
                          padding:.65rem 1.5rem;border-radius:4px;text-decoration:none">
                    <i class="fas fa-user me-2"></i>Daftar Customer
                </a>
                <a href="{{ route('register') }}?role=driver"
                   style="background:rgba(255,255,255,.15);border:1.5px solid rgba(255,255,255,.4);
                          color:#fff;font-weight:700;font-size:.875rem;
                          padding:.65rem 1.5rem;border-radius:4px;text-decoration:none">
                    <i class="fas fa-motorcycle me-2"></i>Jadi Driver
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     FOOTER
════════════════════════════════════════ --}}
<footer class="jp-footer">
    <div class="container-fluid px-4">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="footer-brand mb-2">
                    <i class="fas fa-motorcycle me-2"></i>JAPLO
                </div>
                <p style="font-size:.8125rem;max-width:220px;line-height:1.6">
                    Platform jasa pengantar lokal pertama untuk masyarakat
                    Kabupaten Bintan, Kepulauan Riau. Berdiri sejak 2018.
                </p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" style="font-size:1.1rem"><i class="fab fa-instagram"></i></a>
                    <a href="#" style="font-size:1.1rem"><i class="fab fa-facebook"></i></a>
                    <a href="#" style="font-size:1.1rem"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="col-md-2">
                <div style="font-weight:600;color:#fff;margin-bottom:.75rem;font-size:.875rem">Layanan</div>
                <ul style="list-style:none;line-height:2;font-size:.8rem">
                    <li><a href="{{ route('customer.ojek') }}">Ojek & Taksi</a></li>
                    <li><a href="{{ route('customer.kuliner') }}">Kuliner</a></li>
                    <li><a href="{{ route('customer.paket') }}">Kirim Paket</a></li>
                    <li><a href="{{ route('customer.pasar') }}">Belanja Pasar</a></li>
                    <li><a href="{{ route('customer.kesehatan') }}">Kesehatan</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <div style="font-weight:600;color:#fff;margin-bottom:.75rem;font-size:.875rem">Bergabung</div>
                <ul style="list-style:none;line-height:2;font-size:.8rem">
                    <li><a href="{{ route('register') }}?role=driver">Daftar Driver</a></li>
                    <li><a href="{{ route('customer.mitra') }}">Daftar Mitra</a></li>
                    <li><a href="{{ route('customer.expo') }}">Daftar Expo</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <div style="font-weight:600;color:#fff;margin-bottom:.75rem;font-size:.875rem">Informasi</div>
                <ul style="list-style:none;line-height:2;font-size:.8rem">
                    <li><a href="{{ route('customer.trending') }}">Trending</a></li>
                    <li><a href="{{ route('customer.promosi') }}">Promo</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Kebijakan Privasi</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <div style="font-weight:600;color:#fff;margin-bottom:.75rem;font-size:.875rem">Kontak</div>
                <ul style="list-style:none;line-height:2.2;font-size:.8rem">
                    <li><i class="fas fa-envelope me-2" style="color:#16A34A"></i>support@japlo.id</li>
                    <li><i class="fas fa-phone me-2" style="color:#16A34A"></i>+62 771 xxx xxxx</li>
                    <li><i class="fas fa-location-dot me-2" style="color:#16A34A"></i>Tanjung Uban, Bintan</li>
                    <li><i class="fas fa-clock me-2" style="color:#16A34A"></i>Senin–Minggu, 06.00–22.00</li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="d-flex flex-column flex-md-row justify-content-between
                    align-items-center gap-2"
             style="font-size:.75rem;color:#6B7280">
            <span>
                &copy; {{ date('Y') }} JAPLO. Hak cipta dilindungi.
                Platform Jasa Pengantar Lokal Bintan.
            </span>
            <div class="d-flex gap-3">
                <a href="#">Syarat & Ketentuan</a>
                <a href="#">Kebijakan Privasi</a>
            </div>
        </div>
    </div>
</footer>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/welcome.js') }}"></script>

</body>
</html>
