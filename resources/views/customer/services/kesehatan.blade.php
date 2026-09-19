@extends('layouts.app')
@section('title', 'Layanan Kesehatan — JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/services.css') }}">
@endpush

@section('content')
<div class="jp-page-top">
    <div class="container">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('dashboard') }}" class="btn btn-sm"
               style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;border-radius:8px">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('images/icons/kesehatan.svg') }}" width="40" height="40" alt="Kesehatan">
            <div>
                <h1><i class="fas fa-kit-medical me-2" style="color:rgba(255,255,255,.8)"></i>Layanan Kesehatan</h1>
                <p class="mb-0" style="font-size:.85rem;color:rgba(255,255,255,.8)">Akses layanan kesehatan terpercaya di Bintan</p>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container">

        {{-- Emergency Banner --}}
        <div class="jp-card mb-4" style="border-color:#FCA5A5;background:linear-gradient(135deg,#FEE2E2,#FECACA)">
            <div class="jp-card-body d-flex align-items-center gap-3">
                <div style="font-size:2rem;flex-shrink:0">🚨</div>
                <div class="flex-grow-1">
                    <div style="font-weight:700;color:#DC2626;margin-bottom:.2rem">Darurat Medis?</div>
                    <div style="font-size:.8375rem;color:#EF4444">Hubungi layanan darurat segera</div>
                </div>
                <div class="d-flex gap-2">
                    <a href="tel:119" class="btn btn-sm" style="background:#DC2626;color:#fff;font-weight:700">
                        <i class="fas fa-phone me-1"></i> 119
                    </a>
                    <a href="tel:112" class="btn btn-sm btn-jp-ghost">
                        <i class="fas fa-phone me-1"></i> 112
                    </a>
                </div>
            </div>
        </div>

        {{-- Health Services Grid --}}
        @if($healthServices->count() > 0)
            <div class="row g-3">
                @foreach($healthServices as $service)
                    <div class="col-md-6 col-lg-4">
                        <div class="health-card">
                            <div class="d-flex align-items-start gap-3">
                                <div class="health-icon-wrap">
                                    @if($service->icon)
                                        <img src="{{ asset('storage/' . $service->icon) }}" width="32" height="32"
                                             alt="{{ $service->name }}" style="object-fit:contain">
                                    @else
                                        <i class="fas fa-kit-medical" style="color:var(--jp-green)"></i>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <div class="health-name">{{ $service->name }}</div>
                                    @if($service->provider)
                                        <div style="font-size:.75rem;color:var(--jp-gray-400);margin-bottom:.35rem">
                                            <i class="fas fa-building me-1"></i>{{ $service->provider }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="health-desc">{{ $service->description }}</div>

                            <div class="health-price {{ !$service->price || $service->price == 0 ? 'free' : '' }}">
                                @if(!$service->price || $service->price == 0)
                                    <i class="fas fa-check-circle me-1"></i> Gratis
                                @else
                                    Mulai Rp {{ number_format($service->price, 0, ',', '.') }}
                                @endif
                            </div>

                            <a href="{{ route('customer.kesehatan.detail', $service) }}"
                               class="btn btn-jp-outline w-100 mt-auto">
                                <i class="fas fa-arrow-right me-2"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        @else
            <div class="jp-empty">
                <div class="empty-icon"><i class="fas fa-kit-medical"></i></div>
                <p>Belum ada layanan kesehatan tersedia</p>
            </div>
        @endif

    </div>
</div>
@endsection

