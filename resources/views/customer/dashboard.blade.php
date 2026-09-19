@extends('layouts.app')

@section('title', 'Dashboard — JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-customer.css') }}">
@endpush

@section('content')

{{-- Greeting Banner --}}
<div class="jp-greeting">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h2>Halo, {{ auth()->user()->name }} 👋</h2>
                <p>Mau pesan apa hari ini?</p>
            </div>
            <div class="d-flex gap-3 text-center d-none d-md-flex">
                <div>
                    <div style="font-size:1.4rem;font-weight:800;color:#fff">{{ $totalOrders }}</div>
                    <div style="font-size:.75rem;color:rgba(255,255,255,.7)">Total Pesanan</div>
                </div>
                <div style="width:1px;background:rgba(255,255,255,.2)"></div>
                <div>
                    <div style="font-size:1.4rem;font-weight:800;color:#fff">{{ $completedOrders }}</div>
                    <div style="font-size:.75rem;color:rgba(255,255,255,.7)">Selesai</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="jp-dash-body">
    <div class="container">

        {{-- ===== SERVICE MENU ===== --}}
        <div class="jp-card mb-4">
            <div class="jp-card-body">
                <div class="fw-700 mb-3" style="font-size:.875rem;color:var(--jp-gray-600)">PILIH LAYANAN</div>
                <div class="service-grid">
                    @php
                        $svcs = [
                            ['route'=>'customer.ojek',      'img'=>'ojek.svg',       'label'=>'OJEK/TAXI'],
                            ['route'=>'customer.kuliner',    'img'=>'kuliner.svg',    'label'=>'KULINER'],
                            ['route'=>'customer.promosi',    'img'=>'promosi.svg',    'label'=>'IKLAN'],
                            ['route'=>'customer.kesehatan',  'img'=>'kesehatan.svg',  'label'=>'KESEHATAN'],
                            ['route'=>'customer.produk',     'img'=>'produk.svg',     'label'=>'PRODUK'],
                            ['route'=>'customer.paket',      'img'=>'paket.svg',      'label'=>'KIRIM PAKET'],
                            ['route'=>'customer.pasar',      'img'=>'pasar.svg',      'label'=>'BLN PASAR'],
                            ['route'=>'customer.pencetakan', 'img'=>'pencetakan.svg', 'label'=>'CETAK'],
                            ['route'=>'customer.trending',   'img'=>'trending.svg',   'label'=>'TRENDING'],
                            ['route'=>'customer.mitra',      'img'=>'mitra.svg',      'label'=>'MITRA'],
                            ['route'=>'customer.expo',       'img'=>'expo.svg',       'label'=>'EXPO'],
                        ];
                    @endphp
                    @foreach($svcs as $s)
                        <a href="{{ route($s['route']) }}" class="svc-btn">
                            <div class="svc-icon-wrap">
                                <img src="{{ asset('images/icons/' . $s['img']) }}"
                                     alt="{{ $s['label'] }}"
                                     width="46" height="46"
                                     style="object-fit:contain">
                            </div>
                            <span class="svc-label">{{ $s['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ===== ACTIVE ORDER ===== --}}
        @if($activeOrder)
            <div class="active-order-card mb-4">
                <div class="order-status-line">
                    <span class="jp-badge jp-badge-{{ strtolower($activeOrder->status) }}">
                        {{ ucfirst($activeOrder->status) }}
                    </span>
                    <span>· {{ $activeOrder->order_number }}</span>
                </div>
                <div class="fw-700 mb-2" style="font-size:.9375rem;color:var(--jp-gray-900)">
                    Pesanan Aktif
                </div>
                <div class="order-route mb-3">
                    <div class="route-row">
                        <span class="route-dot green"></span>
                        <div>
                            <div style="font-size:.72rem;color:var(--jp-gray-400);margin-bottom:1px">Jemput</div>
                            <div style="font-size:.875rem;font-weight:500;color:var(--jp-gray-800)">{{ $activeOrder->pickup_address }}</div>
                        </div>
                    </div>
                    <div style="margin-left:4px;width:2px;height:14px;background:var(--jp-gray-200)"></div>
                    <div class="route-row">
                        <span class="route-dot red"></span>
                        <div>
                            <div style="font-size:.72rem;color:var(--jp-gray-400);margin-bottom:1px">Tujuan</div>
                            <div style="font-size:.875rem;font-weight:500;color:var(--jp-gray-800)">{{ $activeOrder->destination_address }}</div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div style="font-size:.8rem;color:var(--jp-gray-400)">Total</div>
                        <div style="font-size:1rem;font-weight:700;color:var(--jp-green)">
                            Rp {{ number_format($activeOrder->price, 0, ',', '.') }}
                        </div>
                    </div>
                    <a href="{{ route('order.track', $activeOrder->id) }}" class="btn btn-jp-primary btn-sm">
                        <i class="fas fa-location-dot me-1"></i> Lacak
                    </a>
                </div>
            </div>
        @endif

        {{-- ===== RECENT ORDERS ===== --}}
        <div class="jp-card">
            <div class="jp-card-header">
                <span>Riwayat Terakhir</span>
                <a href="{{ route('order.history') }}" class="btn btn-jp-ghost btn-sm">
                    Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="jp-card-body p-0">
                @if($recentOrders->count() > 0)
                    <div class="table-responsive">
                        <table class="jp-table">
                            <thead>
                                <tr>
                                    <th>No. Pesanan</th>
                                    <th>Tujuan</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                    <tr>
                                        <td><span style="font-family:monospace;font-weight:600;font-size:.8125rem">{{ $order->order_number }}</span></td>
                                        <td style="max-width:200px">{{ Str::limit($order->destination_address, 35) }}</td>
                                        <td class="fw-600">Rp {{ number_format($order->price, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="jp-badge jp-badge-{{ strtolower($order->status) }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td style="color:var(--jp-gray-400);font-size:.8rem;white-space:nowrap">
                                            {{ $order->created_at->format('d M Y') }}
                                        </td>
                                        <td>
                                            @if(in_array($order->status, ['pending','accepted','picked_up','in_progress']))
                                                <a href="{{ route('order.track', $order->id) }}" class="btn btn-sm btn-jp-outline">
                                                    <i class="fas fa-map-location-dot"></i>
                                                </a>
                                            @else
                                                <span style="font-size:.75rem;color:var(--jp-gray-400)">—</span>
                                            @endif
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
                        <a href="{{ route('customer.ojek') }}" class="btn btn-jp-primary btn-sm">
                            <i class="fas fa-motorcycle me-2"></i>Pesan Ojek Sekarang
                        </a>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
