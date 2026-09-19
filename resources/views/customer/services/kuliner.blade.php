@extends('layouts.app')
@section('title', 'Kuliner — JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/services.css') }}">
@endpush

@section('content')
<div class="jp-page-top">
    <div class="container">
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('images/icons/kuliner.svg') }}" width="40" height="40" alt="Kuliner">
            <div>
                <h1>Kuliner Bintan</h1>
                <p class="mb-0" style="font-size:.85rem;color:rgba(255,255,255,.8)">
                    Pesan dari warung & restoran lokal favoritmu
                </p>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container">

        {{-- Search & Filter --}}
        <div class="jp-card mb-4">
            <div class="jp-card-body">
                <form method="GET" action="{{ route('customer.kuliner') }}">
                    <div class="row g-2">
                        <div class="col-md-7">
                            <input type="text" name="search" class="form-control"
                                   placeholder="Cari restoran atau makanan..."
                                   value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="category" class="form-select">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-jp-primary w-100">
                                <i class="fas fa-search me-1"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Restaurant list --}}
        @if($restaurants->count() > 0)
            <div class="row g-3">
                @foreach($restaurants as $restaurant)
                    <div class="col-6 col-md-4 col-lg-3">
                        <a href="{{ route('customer.kuliner.detail', $restaurant) }}" class="restaurant-card">
                            @if($restaurant->image)
                                <img src="{{ $restaurant->image_url }}" alt="{{ $restaurant->name }}" class="card-img">
                            @else
                                <div class="card-img-placeholder">
                                    <i class="fas fa-bowl-food"></i>
                                </div>
                            @endif
                            <div style="padding:.85rem">
                                <div class="d-flex align-items-start justify-content-between gap-1 mb-1">
                                    <div class="fw-700" style="font-size:.875rem;line-height:1.3">
                                        {{ $restaurant->name }}
                                    </div>
                                    <span class="{{ $restaurant->is_open ? 'badge-open' : 'badge-close' }} flex-shrink-0">
                                        {{ $restaurant->is_open ? 'Buka' : 'Tutup' }}
                                    </span>
                                </div>
                                <div style="font-size:.78rem;color:var(--jp-gray-400);margin-bottom:.5rem">
                                    {{ $restaurant->category }}
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div style="font-size:.78rem;color:var(--jp-gray-600)">
                                        <i class="fas fa-star" style="color:#F59E0B"></i>
                                        {{ number_format($restaurant->rating, 1) }}
                                    </div>
                                    <div style="font-size:.78rem;color:var(--jp-gray-400)">
                                        <i class="fas fa-clock me-1"></i>{{ $restaurant->delivery_time }} menit
                                    </div>
                                </div>
                                @if($restaurant->min_order > 0)
                                    <div style="font-size:.72rem;color:var(--jp-gray-400);margin-top:.3rem">
                                        Min. Rp {{ number_format($restaurant->min_order, 0, ',', '.') }}
                                    </div>
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $restaurants->withQueryString()->links() }}
            </div>
        @else
            <div class="jp-empty" style="padding:4rem 1rem">
                <div class="empty-icon"><i class="fas fa-bowl-food"></i></div>
                <p>Tidak ada restoran ditemukan</p>
                @if(request('search'))
                    <a href="{{ route('customer.kuliner') }}" class="btn btn-jp-ghost btn-sm">Reset Pencarian</a>
                @endif
            </div>
        @endif

    </div>
</div>
@endsection

