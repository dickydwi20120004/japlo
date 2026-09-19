@extends('layouts.app')
@section('title', $healthService->name . ' — JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/services.css') }}">
@endpush

@section('content')
<div class="jp-page-top">
    <div class="container">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('customer.kesehatan') }}" class="btn btn-sm"
               style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;border-radius:8px">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div style="width:52px;height:52px;border-radius:14px;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0">
                @if($healthService->icon)
                    <img src="{{ asset('storage/' . $healthService->icon) }}" width="32" height="32"
                         alt="{{ $healthService->name }}" style="object-fit:contain;filter:brightness(10)">
                @else
                    <i class="fas fa-kit-medical" style="color:#fff"></i>
                @endif
            </div>
            <div>
                <h1>{{ $healthService->name }}</h1>
                @if($healthService->provider)
                    <div style="font-size:.85rem;color:rgba(255,255,255,.8)">
                        <i class="fas fa-building me-1"></i>{{ $healthService->provider }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container">
        <div class="row g-4">

            {{-- Left: Main Info --}}
            <div class="col-lg-8">

                {{-- Banner Image --}}
                @if($healthService->image)
                    <div class="jp-card mb-4 overflow-hidden">
                        <img src="{{ $healthService->image_url }}" alt="{{ $healthService->name }}"
                             style="width:100%;height:260px;object-fit:cover">
                    </div>
                @endif

                {{-- Description --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-info-circle me-2 text-jp-green"></i>Tentang Layanan</span>
                    </div>
                    <div class="jp-card-body">
                        <div style="font-size:.9375rem;color:var(--jp-gray-700);line-height:1.75">
                            {{ $healthService->full_description ?? $healthService->description }}
                        </div>
                    </div>
                </div>

                {{-- Benefits --}}
                @if($healthService->benefits && count($healthService->benefits) > 0)
                    <div class="jp-card mb-4">
                        <div class="jp-card-header">
                            <span><i class="fas fa-circle-check me-2 text-jp-green"></i>Manfaat Layanan</span>
                        </div>
                        <div class="jp-card-body">
                            @foreach($healthService->benefits as $benefit)
                                <div class="benefit-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ $benefit }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- How It Works --}}
                @if($healthService->how_it_works && count($healthService->how_it_works) > 0)
                    <div class="jp-card mb-4">
                        <div class="jp-card-header">
                            <span><i class="fas fa-list-ol me-2 text-jp-green"></i>Cara Kerja</span>
                        </div>
                        <div class="jp-card-body">
                            @foreach($healthService->how_it_works as $i => $step)
                                <div class="step-item">
                                    <div class="step-num">{{ $i + 1 }}</div>
                                    <div class="step-text">{{ $step }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {{-- Right: Booking --}}
            <div class="col-lg-4">
                <div class="jp-card" style="position:sticky;top:80px">
                    <div class="jp-card-header">
                        <span><i class="fas fa-calendar-check me-2 text-jp-green"></i>Booking Layanan</span>
                    </div>
                    <div class="jp-card-body">
                        {{-- Price --}}
                        <div style="text-align:center;padding:1rem 0;border-bottom:1px solid var(--jp-gray-100);margin-bottom:1rem">
                            @if(!$healthService->price || $healthService->price == 0)
                                <div style="font-size:1.5rem;font-weight:800;color:var(--jp-green)">Gratis</div>
                                <div style="font-size:.78rem;color:var(--jp-gray-400)">Tidak ada biaya</div>
                            @else
                                <div style="font-size:.78rem;color:var(--jp-gray-400);margin-bottom:.25rem">Mulai dari</div>
                                <div style="font-size:1.5rem;font-weight:800;color:var(--jp-green)">
                                    Rp {{ number_format($healthService->price, 0, ',', '.') }}
                                </div>
                            @endif
                        </div>

                        {{-- Provider info --}}
                        @if($healthService->provider)
                            <div style="background:var(--jp-gray-50);border-radius:10px;padding:.75rem;margin-bottom:1rem">
                                <div style="font-size:.72rem;color:var(--jp-gray-400);margin-bottom:.25rem">Penyedia Layanan</div>
                                <div style="font-size:.875rem;font-weight:600;color:var(--jp-gray-800)">{{ $healthService->provider }}</div>
                                @if($healthService->phone)
                                    <div style="font-size:.8rem;color:var(--jp-green);margin-top:.25rem">
                                        <i class="fas fa-phone me-1"></i>{{ $healthService->phone }}
                                    </div>
                                @endif
                            </div>
                        @endif

                        {{-- Booking Button (WA) --}}
                        @php
                            $waNumber = $healthService->phone
                                ? ('62' . ltrim(preg_replace('/[^0-9]/', '', $healthService->phone), '0'))
                                : '6281234567890';
                            $waMsg = 'Halo, saya ingin booking layanan *' . $healthService->name . '* di JAPLO. Mohon informasinya.';
                        @endphp
                        <a href="https://api.whatsapp.com/send?phone={{ $waNumber }}&text={{ urlencode($waMsg) }}"
                           target="_blank"
                           class="btn w-100 mb-2"
                           style="background:#25D366;color:#fff;font-weight:600;border:none;padding:.75rem">
                            <i class="fab fa-whatsapp me-2"></i> Booking via WhatsApp
                        </a>
                        <a href="{{ route('customer.kesehatan') }}" class="btn btn-jp-ghost w-100">
                            <i class="fas fa-arrow-left me-2"></i> Layanan Lainnya
                        </a>

                        <div style="font-size:.72rem;color:var(--jp-gray-400);text-align:center;margin-top:.75rem;line-height:1.5">
                            <i class="fas fa-info-circle me-1"></i>
                            Sistem booking online akan segera hadir
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

