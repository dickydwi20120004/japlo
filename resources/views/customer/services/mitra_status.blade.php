@extends('layouts.app')
@section('title', 'Status Mitra Usaha — JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/services.css') }}">
@endpush

@section('content')
<div class="jp-page-top">
    <div class="container">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('customer.mitra') }}" class="btn btn-sm"
               style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;border-radius:8px">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div style="font-size:2rem">🤝</div>
            <div>
                <h1>Status Kemitraan</h1>
                <p class="mb-0" style="font-size:.85rem;color:rgba(255,255,255,.8)">Pantau status pendaftaran mitra Anda</p>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container" style="max-width:680px">

        @if($registration)
            @php
                $statusConfig = match($registration->status) {
                    'pending'  => [
                        'icon' => 'clock', 'icon_color' => '#D97706', 'bg' => '#FEF3C7',
                        'title' => 'Menunggu Verifikasi Admin',
                        'desc' => 'Pendaftaran Anda sedang ditinjau oleh tim JAPLO. Proses ini biasanya membutuhkan 1–3 hari kerja.',
                        'badge_style' => 'background:#FEF3C7;color:#D97706',
                    ],
                    'approved' => [
                        'icon' => 'circle-check', 'icon_color' => '#15803D', 'bg' => '#DCFCE7',
                        'title' => 'Pendaftaran Disetujui! 🎉',
                        'desc' => 'Selamat! Anda resmi menjadi Mitra JAPLO. Usaha Anda kini dapat muncul di platform kami.',
                        'badge_style' => 'background:#DCFCE7;color:#15803D',
                    ],
                    'rejected' => [
                        'icon' => 'circle-xmark', 'icon_color' => '#DC2626', 'bg' => '#FEE2E2',
                        'title' => 'Pendaftaran Ditolak',
                        'desc' => 'Mohon maaf, pendaftaran Anda tidak dapat disetujui saat ini. Silakan perbaiki dan daftar ulang.',
                        'badge_style' => 'background:#FEE2E2;color:#DC2626',
                    ],
                    default => [
                        'icon' => 'circle-question', 'icon_color' => '#6B7280', 'bg' => '#F3F4F6',
                        'title' => 'Status Tidak Diketahui',
                        'desc' => 'Hubungi admin untuk informasi lebih lanjut.',
                        'badge_style' => 'background:#F3F4F6;color:#6B7280',
                    ],
                };
            @endphp

            {{-- Status Hero --}}
            <div class="jp-card mb-4">
                <div class="status-hero">
                    <div class="status-icon-wrap" style="background:{{ $statusConfig['bg'] }}">
                        <i class="fas fa-{{ $statusConfig['icon'] }}" style="color:{{ $statusConfig['icon_color'] }}"></i>
                    </div>
                    <div class="status-title">{{ $statusConfig['title'] }}</div>
                    <p class="status-desc">{{ $statusConfig['desc'] }}</p>
                    @if($registration->status === 'rejected' && $registration->admin_notes)
                        <div class="alert alert-danger mt-3" style="max-width:420px;margin:1rem auto 0;text-align:left">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <strong>Alasan:</strong> {{ $registration->admin_notes }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Detail Registrasi --}}
            <div class="jp-card mb-4">
                <div class="jp-card-header">
                    <span><i class="fas fa-briefcase me-2 text-jp-green"></i>Detail Pendaftaran</span>
                </div>
                <div class="jp-card-body">
                    <div class="info-row">
                        <span class="info-label">Nama Usaha</span>
                        <span class="info-value">{{ $registration->business_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Jenis Usaha</span>
                        <span class="info-value">{{ $registration->business_type }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Nama Pemilik</span>
                        <span class="info-value">{{ $registration->owner_name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Telepon</span>
                        <span class="info-value">{{ $registration->phone }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Tier Kemitraan</span>
                        <span class="info-value">
                            @php
                                $tiers = $membershipTiers;
                                $tierLabel = $tiers[$registration->membership_tier]['label'] ?? ucfirst($registration->membership_tier);
                                $tierColor = $tiers[$registration->membership_tier]['color'] ?? '#16A34A';
                            @endphp
                            <span style="color:{{ $tierColor }};font-weight:700">{{ $tierLabel }}</span>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Status</span>
                        <span class="info-value">
                            <span class="jp-badge" style="{{ $statusConfig['badge_style'] }}">
                                {{ ucfirst($registration->status) }}
                            </span>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Didaftarkan</span>
                        <span class="info-value">{{ $registration->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    @if($registration->approved_at)
                        <div class="info-row">
                            <span class="info-label">Disetujui</span>
                            <span class="info-value">{{ $registration->approved_at->format('d M Y, H:i') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            @if($registration->status === 'rejected')
                <div class="text-center">
                    <a href="{{ route('customer.mitra') }}" class="btn btn-jp-primary">
                        <i class="fas fa-redo me-2"></i> Daftar Ulang
                    </a>
                </div>
            @endif

        @else
            {{-- No Registration --}}
            <div class="jp-card">
                <div class="jp-empty" style="padding:4rem 2rem">
                    <div class="empty-icon">🤝</div>
                    <p style="font-size:1rem;font-weight:600;color:var(--jp-gray-700)">
                        Anda belum mendaftar sebagai Mitra JAPLO
                    </p>
                    <p style="font-size:.875rem;color:var(--jp-gray-400);max-width:360px;margin:0 auto 1.5rem">
                        Bergabunglah sebagai mitra dan kembangkan bisnis Anda bersama ribuan pelanggan JAPLO di Bintan.
                    </p>
                    <a href="{{ route('customer.mitra') }}" class="btn btn-jp-primary">
                        <i class="fas fa-handshake me-2"></i> Daftar Sekarang
                    </a>
                </div>
            </div>
        @endif

    </div>
</div>
@endsection

