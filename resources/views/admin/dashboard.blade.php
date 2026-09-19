@extends('layouts.app')

@section('title', 'Admin Dashboard — JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}">
@endpush

@section('content')

{{-- Admin Header --}}
<div class="jp-admin-header">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div>
                <h1><i class="fas fa-gauge-high me-2"></i>Admin Dashboard</h1>
                <p>Selamat datang, {{ auth()->user()->name }}</p>
            </div>
            <div style="font-size:.8rem;color:rgba(255,255,255,.65)">
                <i class="fas fa-clock me-1"></i>{{ now()->isoFormat('dddd, D MMMM YYYY') }}
            </div>
        </div>
    </div>
</div>

<div class="jp-dash-body">
    <div class="container">

        {{-- Stats --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="jp-stat-card">
                    <div class="stat-icon icon-blue"><i class="fas fa-users"></i></div>
                    <div>
                        <div class="stat-value">{{ $totalUsers }}</div>
                        <div class="stat-label">Total Customer</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="jp-stat-card">
                    <div class="stat-icon icon-green"><i class="fas fa-motorcycle"></i></div>
                    <div>
                        <div class="stat-value">{{ $totalDrivers }}</div>
                        <div class="stat-label">Total Driver</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="jp-stat-card">
                    <div class="stat-icon icon-amber"><i class="fas fa-receipt"></i></div>
                    <div>
                        <div class="stat-value">{{ $totalOrders }}</div>
                        <div class="stat-label">Total Pesanan</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="jp-stat-card">
                    <div class="stat-icon icon-purple"><i class="fas fa-coins"></i></div>
                    <div>
                        <div class="stat-value" style="font-size:1rem">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                        <div class="stat-label">Total Revenue</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stats Registrasi --}}
        @php
            $pendingMitra = \App\Models\MitraRegistration::where('status','pending')->count();
            $pendingExpo  = \App\Models\ExpoRegistration::where('status','pending')->count();
            $pendingDrivers = \App\Models\Driver::where('is_verified', false)->count();
        @endphp
        @if($pendingMitra > 0 || $pendingExpo > 0 || $pendingDrivers > 0)
            <div class="row g-3 mb-4">
                @if($pendingDrivers > 0)
                    <div class="col-6 col-md-4">
                        <a href="{{ route('admin.drivers') }}" class="jp-stat-card text-decoration-none"
                           style="border-color:#FEF3C7;background:#FFFBEB">
                            <div class="stat-icon icon-amber"><i class="fas fa-id-card"></i></div>
                            <div>
                                <div class="stat-value" style="color:#D97706">{{ $pendingDrivers }}</div>
                                <div class="stat-label">Driver Pending Verifikasi</div>
                            </div>
                        </a>
                    </div>
                @endif
                @if($pendingMitra > 0)
                    <div class="col-6 col-md-4">
                        <a href="{{ route('admin.mitra_registrations') }}" class="jp-stat-card text-decoration-none"
                           style="border-color:#DCFCE7;background:#F0FDF4">
                            <div class="stat-icon icon-green"><i class="fas fa-handshake"></i></div>
                            <div>
                                <div class="stat-value" style="color:var(--jp-green)">{{ $pendingMitra }}</div>
                                <div class="stat-label">Mitra Pending Approval</div>
                            </div>
                        </a>
                    </div>
                @endif
                @if($pendingExpo > 0)
                    <div class="col-6 col-md-4">
                        <a href="{{ route('admin.expo_registrations') }}" class="jp-stat-card text-decoration-none"
                           style="border-color:#FEF3C7;background:#FFFBEB">
                            <div class="stat-icon icon-amber"><i class="fas fa-store"></i></div>
                            <div>
                                <div class="stat-value" style="color:#D97706">{{ $pendingExpo }}</div>
                                <div class="stat-label">Expo Pending Approval</div>
                            </div>
                        </a>
                    </div>
                @endif
            </div>
        @endif

        <div class="row g-4">

            {{-- Quick actions --}}
            <div class="col-lg-4">
                <div class="jp-card mb-4">
                    <div class="jp-card-header">Menu Kelola</div>
                    <div class="jp-card-body d-flex flex-column gap-2">
                        <a href="{{ route('admin.users') }}" class="quick-action">
                            <div class="qa-icon icon-blue"><i class="fas fa-users"></i></div>
                            <div><div class="qa-label">Pengguna</div><div class="qa-desc">Kelola akun customer</div></div>
                            <i class="fas fa-chevron-right ms-auto" style="color:var(--jp-gray-400);font-size:.8rem"></i>
                        </a>
                        <a href="{{ route('admin.drivers') }}" class="quick-action">
                            <div class="qa-icon icon-green"><i class="fas fa-id-card"></i></div>
                            <div><div class="qa-label">Driver</div><div class="qa-desc">Verifikasi & kelola driver</div></div>
                            <i class="fas fa-chevron-right ms-auto" style="color:var(--jp-gray-400);font-size:.8rem"></i>
                        </a>
                        <a href="{{ route('admin.orders') }}" class="quick-action">
                            <div class="qa-icon icon-amber"><i class="fas fa-receipt"></i></div>
                            <div><div class="qa-label">Pesanan Ojek</div><div class="qa-desc">Monitor transaksi ojek</div></div>
                            <i class="fas fa-chevron-right ms-auto" style="color:var(--jp-gray-400);font-size:.8rem"></i>
                        </a>
                        <a href="{{ route('admin.packages') }}" class="quick-action">
                            <div class="qa-icon icon-purple"><i class="fas fa-box"></i></div>
                            <div><div class="qa-label">Kirim Paket</div><div class="qa-desc">Monitor pengiriman paket</div></div>
                            <i class="fas fa-chevron-right ms-auto" style="color:var(--jp-gray-400);font-size:.8rem"></i>
                        </a>
                        <a href="{{ route('admin.market_orders') }}" class="quick-action">
                            <div class="qa-icon icon-green"><i class="fas fa-cart-shopping"></i></div>
                            <div><div class="qa-label">Belanja Pasar</div><div class="qa-desc">Monitor order titip belanja</div></div>
                            <i class="fas fa-chevron-right ms-auto" style="color:var(--jp-gray-400);font-size:.8rem"></i>
                        </a>
                        <a href="{{ route('admin.restaurants') }}" class="quick-action">
                            <div class="qa-icon icon-red"><i class="fas fa-utensils"></i></div>
                            <div><div class="qa-label">Restoran & Menu</div><div class="qa-desc">Kelola data kuliner</div></div>
                            <i class="fas fa-chevron-right ms-auto" style="color:var(--jp-gray-400);font-size:.8rem"></i>
                        </a>
                        <a href="{{ route('admin.products') }}" class="quick-action">
                            <div class="qa-icon icon-purple"><i class="fas fa-bag-shopping"></i></div>
                            <div><div class="qa-label">Produk</div><div class="qa-desc">Kelola katalog produk</div></div>
                            <i class="fas fa-chevron-right ms-auto" style="color:var(--jp-gray-400);font-size:.8rem"></i>
                        </a>
                        <a href="{{ route('admin.promotions') }}" class="quick-action">
                            <div class="qa-icon icon-amber"><i class="fas fa-tag"></i></div>
                            <div><div class="qa-label">Promosi</div><div class="qa-desc">Kelola promo & diskon</div></div>
                            <i class="fas fa-chevron-right ms-auto" style="color:var(--jp-gray-400);font-size:.8rem"></i>
                        </a>
                        <a href="{{ route('admin.articles') }}" class="quick-action">
                            <div class="qa-icon" style="background:#FFF7ED;color:#EA580C"><i class="fas fa-newspaper"></i></div>
                            <div><div class="qa-label">Artikel / Trending</div><div class="qa-desc">Kelola konten artikel</div></div>
                            <i class="fas fa-chevron-right ms-auto" style="color:var(--jp-gray-400);font-size:.8rem"></i>
                        </a>
                        <a href="{{ route('admin.tariffs') }}" class="quick-action">
                            <div class="qa-icon icon-green"><i class="fas fa-coins"></i></div>
                            <div><div class="qa-label">Tarif</div><div class="qa-desc">Atur tarif semua layanan</div></div>
                            <i class="fas fa-chevron-right ms-auto" style="color:var(--jp-gray-400);font-size:.8rem"></i>
                        </a>
                        <a href="{{ route('admin.mitra_registrations') }}" class="quick-action">
                            <div class="qa-icon icon-green"><i class="fas fa-handshake"></i></div>
                            <div><div class="qa-label">Mitra Usaha</div><div class="qa-desc">Approve pendaftaran mitra</div></div>
                            <i class="fas fa-chevron-right ms-auto" style="color:var(--jp-gray-400);font-size:.8rem"></i>
                        </a>
                        <a href="{{ route('admin.expo_registrations') }}" class="quick-action">
                            <div class="qa-icon icon-amber"><i class="fas fa-store"></i></div>
                            <div><div class="qa-label">Tenant Expo</div><div class="qa-desc">Approve pendaftaran expo</div></div>
                            <i class="fas fa-chevron-right ms-auto" style="color:var(--jp-gray-400);font-size:.8rem"></i>
                        </a>
                    </div>
                </div>

                {{-- Recent users --}}
                <div class="jp-card">
                    <div class="jp-card-header">
                        <span>Customer Terbaru</span>
                        <a href="{{ route('admin.users') }}" class="btn btn-jp-ghost btn-sm" style="font-size:.75rem;padding:.3rem .7rem">Semua</a>
                    </div>
                    <div class="jp-card-body p-0">
                        @if($recentUsers->count() > 0)
                            @foreach($recentUsers as $u)
                                <div style="display:flex;align-items:center;gap:.75rem;padding:.7rem 1.25rem;border-bottom:1px solid var(--jp-gray-100)">
                                    <div style="width:34px;height:34px;border-radius:50%;background:var(--jp-green-light);color:var(--jp-green);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.875rem;flex-shrink:0">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </div>
                                    <div class="flex-grow-1" style="min-width:0">
                                        <div style="font-size:.875rem;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $u->name }}</div>
                                        <div style="font-size:.75rem;color:var(--jp-gray-400)">{{ $u->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="jp-empty" style="padding:1.5rem"><p style="margin:0">Belum ada customer</p></div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Recent orders --}}
            <div class="col-lg-8">
                <div class="jp-card">
                    <div class="jp-card-header">
                        <span>Pesanan Terbaru</span>
                        <a href="{{ route('admin.orders') }}" class="btn btn-jp-ghost btn-sm" style="font-size:.75rem;padding:.3rem .7rem">Lihat Semua</a>
                    </div>
                    <div class="jp-card-body p-0">
                        @if($recentOrders->count() > 0)
                            <div class="table-responsive">
                                <table class="jp-table">
                                    <thead>
                                        <tr>
                                            <th>No. Pesanan</th>
                                            <th>Customer</th>
                                            <th>Driver</th>
                                            <th>Harga</th>
                                            <th>Status</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentOrders as $order)
                                            <tr>
                                                <td style="font-family:monospace;font-size:.8rem">{{ $order->order_number }}</td>
                                                <td>{{ $order->user->name ?? '—' }}</td>
                                                <td style="color:var(--jp-gray-400)">
                                                    {{ $order->driver->name ?? '<em>Menunggu</em>' }}
                                                </td>
                                                <td class="fw-600">Rp {{ number_format($order->price, 0, ',', '.') }}</td>
                                                <td>
                                                    <span class="jp-badge jp-badge-{{ strtolower($order->status) }}">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                </td>
                                                <td style="font-size:.78rem;color:var(--jp-gray-400);white-space:nowrap">
                                                    {{ $order->created_at->diffForHumans() }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="jp-empty">
                                <div class="empty-icon"><i class="fas fa-receipt"></i></div>
                                <p>Belum ada pesanan</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
