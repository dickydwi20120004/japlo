@extends('layouts.app')
@section('title', $restaurant->name . ' — JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/services.css') }}">
@endpush

@section('content')
<div class="jp-page-top">
    <div class="container">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('customer.kuliner') }}" class="btn btn-sm"
               style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;border-radius:8px">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
            <div>
                <h1>{{ $restaurant->name }}</h1>
                <div class="d-flex flex-wrap gap-2 mt-2">
                    <span class="{{ $restaurant->is_open ? 'badge-open' : 'badge-close' }}">
                        {{ $restaurant->is_open ? 'Buka' : 'Tutup' }}
                    </span>
                    <span class="info-pill"><i class="fas fa-star" style="color:#F59E0B"></i> {{ number_format($restaurant->rating, 1) }}</span>
                    <span class="info-pill"><i class="fas fa-clock"></i> {{ $restaurant->open_time }} – {{ $restaurant->close_time }}</span>
                    @if($restaurant->delivery_time)
                        <span class="info-pill"><i class="fas fa-motorcycle"></i> ~{{ $restaurant->delivery_time }} menit</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container">
        <div class="row g-4">

            {{-- Left: Menu --}}
            <div class="col-lg-8">

                {{-- Restaurant Info Card --}}
                <div class="jp-card mb-4 overflow-hidden">
                    @if($restaurant->image)
                        <img src="{{ $restaurant->image_url }}" alt="{{ $restaurant->name }}" class="restaurant-banner">
                    @else
                        <div class="restaurant-banner-placeholder">🍽️</div>
                    @endif
                    <div class="jp-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div style="font-size:.78rem;color:var(--jp-gray-400);margin-bottom:3px">Kategori</div>
                                <div style="font-weight:600;font-size:.875rem">{{ $restaurant->category }}</div>
                            </div>
                            <div class="col-md-6">
                                <div style="font-size:.78rem;color:var(--jp-gray-400);margin-bottom:3px">Alamat</div>
                                <div style="font-weight:600;font-size:.875rem">{{ $restaurant->address }}</div>
                            </div>
                            @if($restaurant->min_order > 0)
                                <div class="col-md-6">
                                    <div style="font-size:.78rem;color:var(--jp-gray-400);margin-bottom:3px">Min. Order</div>
                                    <div style="font-weight:600;font-size:.875rem;color:var(--jp-green)">
                                        Rp {{ number_format($restaurant->min_order, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endif
                            @if($restaurant->phone)
                                <div class="col-md-6">
                                    <div style="font-size:.78rem;color:var(--jp-gray-400);margin-bottom:3px">Telepon</div>
                                    <div style="font-weight:600;font-size:.875rem">{{ $restaurant->phone }}</div>
                                </div>
                            @endif
                            @if($restaurant->description)
                                <div class="col-12">
                                    <div style="font-size:.875rem;color:var(--jp-gray-600);line-height:1.6">
                                        {{ $restaurant->description }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Menu by Category --}}
                @if($menus->count() > 0)
                    @foreach($menus as $category => $items)
                        <div class="mb-4">
                            <div class="category-section-title">
                                <i class="fas fa-utensils me-2" style="color:var(--jp-green)"></i>{{ $category ?: 'Menu Utama' }}
                            </div>
                            <div class="row g-3">
                                @foreach($items as $menu)
                                    <div class="col-6 col-md-4">
                                        <div class="menu-card">
                                            @if($menu->image)
                                                <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}">
                                            @else
                                                <div class="menu-img-placeholder">🍛</div>
                                            @endif
                                            <div style="padding:.75rem">
                                                <div style="font-weight:700;font-size:.8375rem;margin-bottom:.25rem;line-height:1.3">
                                                    {{ $menu->name }}
                                                </div>
                                                @if($menu->description)
                                                    <div style="font-size:.75rem;color:var(--jp-gray-400);margin-bottom:.5rem;line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
                                                        {{ $menu->description }}
                                                    </div>
                                                @endif
                                                <div style="font-weight:700;color:var(--jp-green);font-size:.9rem">
                                                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                                                </div>
                                                @if(!$menu->is_available)
                                                    <div style="font-size:.72rem;color:var(--jp-red);margin-top:3px">Habis</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="jp-empty">
                        <div class="empty-icon"><i class="fas fa-bowl-food"></i></div>
                        <p>Menu belum tersedia</p>
                    </div>
                @endif
            </div>

            {{-- Right: Order via WA --}}
            <div class="col-lg-4">
                <div class="jp-card" style="position:sticky;top:80px">
                    <div class="jp-card-header">
                        <span><i class="fab fa-whatsapp me-2" style="color:#25D366"></i>Pesan via WhatsApp</span>
                    </div>
                    <div class="jp-card-body">
                        <p style="font-size:.875rem;color:var(--jp-gray-600);line-height:1.6;margin-bottom:1rem">
                            Pilih menu yang ingin Anda pesan, lalu hubungi restoran langsung via WhatsApp.
                        </p>

                        @php
                            $waNumber = $restaurant->phone ? preg_replace('/[^0-9]/', '', $restaurant->phone) : null;
                            $waNumber = $waNumber ? ('62' . ltrim($waNumber, '0')) : null;
                            $waMessage = 'Halo, saya ingin pesan dari ' . $restaurant->name . '. Mohon info menu yang tersedia hari ini.';
                        @endphp

                        @if($waNumber)
                            <a href="https://api.whatsapp.com/send?phone={{ $waNumber }}&text={{ urlencode($waMessage) }}"
                               target="_blank"
                               class="btn btn-jp-primary w-100"
                               style="background:#25D366;border:none">
                                <i class="fab fa-whatsapp me-2"></i> Pesan via WhatsApp
                            </a>
                        @else
                            <div style="background:var(--jp-gray-50);border:1.5px dashed var(--jp-gray-200);border-radius:10px;padding:1rem;text-align:center;font-size:.8rem;color:var(--jp-gray-400)">
                                <i class="fas fa-phone-slash mb-2 d-block" style="font-size:1.5rem"></i>
                                Nomor WhatsApp tidak tersedia
                            </div>
                        @endif

                        <div style="margin-top:1rem;padding-top:1rem;border-top:1px solid var(--jp-gray-100)">
                            <div style="font-size:.72rem;color:var(--jp-gray-400);text-align:center;line-height:1.6">
                                <i class="fas fa-info-circle me-1"></i>
                                Fitur keranjang belanja in-app akan segera hadir
                            </div>
                        </div>
                    </div>

                    {{-- Quick Info --}}
                    <div style="padding:0 1.25rem 1.25rem">
                        <div style="background:var(--jp-gray-50);border-radius:10px;padding:.85rem">
                            <div class="d-flex justify-content-between" style="font-size:.8125rem;margin-bottom:.4rem">
                                <span style="color:var(--jp-gray-500)">Total Menu</span>
                                <span style="font-weight:600">{{ $menus->flatten()->count() }} item</span>
                            </div>
                            <div class="d-flex justify-content-between" style="font-size:.8125rem;margin-bottom:.4rem">
                                <span style="color:var(--jp-gray-500)">Kategori</span>
                                <span style="font-weight:600">{{ $menus->keys()->count() }} kategori</span>
                            </div>
                            @if($restaurant->min_order > 0)
                                <div class="d-flex justify-content-between" style="font-size:.8125rem">
                                    <span style="color:var(--jp-gray-500)">Min. Order</span>
                                    <span style="font-weight:600;color:var(--jp-green)">
                                        Rp {{ number_format($restaurant->min_order, 0, ',', '.') }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

