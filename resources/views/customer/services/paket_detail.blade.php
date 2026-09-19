@extends('layouts.app')
@section('title', 'Detail Pengiriman ' . $delivery->delivery_number . ' — JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/services.css') }}">
@endpush

@section('content')
<div class="jp-page-top">
    <div class="container">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('customer.paket') }}" class="btn btn-sm"
               style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;border-radius:8px">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div style="font-size:2rem">📦</div>
            <div>
                <h1>{{ $delivery->delivery_number }}</h1>
                <span class="jp-badge"
                      style="{{ match($delivery->status) {
                        'pending'    => 'background:rgba(255,255,255,.2);color:#fff',
                        'accepted'   => 'background:rgba(255,255,255,.2);color:#fff',
                        'picked_up'  => 'background:rgba(255,255,255,.2);color:#fff',
                        'in_transit' => 'background:rgba(255,255,255,.2);color:#fff',
                        'delivered'  => 'background:rgba(255,255,255,.2);color:#fff',
                        'cancelled'  => 'background:rgba(255,100,100,.3);color:#fff',
                        default      => 'background:rgba(255,255,255,.2);color:#fff',
                      } }}">
                    {{ ucfirst(str_replace('_', ' ', $delivery->status)) }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container">
        <div class="row g-4">

            {{-- Left: Status & Route --}}
            <div class="col-lg-5">

                {{-- Status Timeline --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-route me-2 text-jp-green"></i>Status Pengiriman</span>
                    </div>
                    <div class="jp-card-body">
                        @php
                            $statuses = ['pending', 'accepted', 'picked_up', 'in_transit', 'delivered'];
                            $statusLabels = [
                                'pending'    => ['label' => 'Menunggu Driver', 'desc' => 'Pesanan sedang dicari driver', 'icon' => 'clock'],
                                'accepted'   => ['label' => 'Driver Ditemukan', 'desc' => 'Driver menuju lokasi jemput', 'icon' => 'check'],
                                'picked_up'  => ['label' => 'Paket Dijemput', 'desc' => 'Paket sudah diambil driver', 'icon' => 'box'],
                                'in_transit' => ['label' => 'Dalam Perjalanan', 'desc' => 'Paket sedang diantar', 'icon' => 'motorcycle'],
                                'delivered'  => ['label' => 'Terkirim', 'desc' => 'Paket sudah sampai di tujuan', 'icon' => 'circle-check'],
                            ];
                            $currentIndex = array_search($delivery->status, $statuses);
                        @endphp

                        @if($delivery->status === 'cancelled')
                            <div class="d-flex align-items-center gap-3 p-3"
                                 style="background:#FEE2E2;border-radius:10px;border:1px solid #FECACA">
                                <i class="fas fa-circle-xmark" style="font-size:1.5rem;color:#DC2626"></i>
                                <div>
                                    <div class="fw-600" style="color:#DC2626">Pengiriman Dibatalkan</div>
                                    @if($delivery->cancellation_reason)
                                        <div style="font-size:.8rem;color:#EF4444;margin-top:2px">
                                            {{ $delivery->cancellation_reason }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="status-timeline">
                                @foreach($statuses as $i => $status)
                                    @php
                                        $isDone = $currentIndex !== false && $i < $currentIndex;
                                        $isActive = $currentIndex !== false && $i == $currentIndex;
                                        $isPending = $currentIndex !== false && $i > $currentIndex;
                                        $info = $statusLabels[$status];
                                    @endphp
                                    <div class="timeline-step {{ $isDone ? 'done' : ($isActive ? 'active' : 'pending-step') }}">
                                        <div class="timeline-dot">
                                            @if($isDone)
                                                <i class="fas fa-check" style="font-size:.6rem"></i>
                                            @elseif($isActive)
                                                <i class="fas fa-circle" style="font-size:.5rem"></i>
                                            @else
                                                <i class="fas fa-circle" style="font-size:.4rem;opacity:.4"></i>
                                            @endif
                                        </div>
                                        <div class="timeline-body">
                                            <div class="timeline-title">{{ $info['label'] }}</div>
                                            <div class="timeline-desc">{{ $info['desc'] }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Route --}}
                <div class="jp-card">
                    <div class="jp-card-header">
                        <span><i class="fas fa-location-dot me-2 text-jp-green"></i>Rute Pengiriman</span>
                    </div>
                    <div class="jp-card-body">
                        <div style="display:flex;flex-direction:column;gap:.75rem">
                            <div style="display:flex;align-items:flex-start;gap:.75rem">
                                <div style="width:10px;height:10px;border-radius:50%;background:var(--jp-green);flex-shrink:0;margin-top:5px"></div>
                                <div>
                                    <div style="font-size:.72rem;color:var(--jp-gray-400);margin-bottom:2px">Jemput dari</div>
                                    <div style="font-size:.875rem;font-weight:600">{{ $delivery->pickup_address }}</div>
                                </div>
                            </div>
                            <div style="margin-left:4px;width:2px;height:16px;background:var(--jp-gray-200)"></div>
                            <div style="display:flex;align-items:flex-start;gap:.75rem">
                                <div style="width:10px;height:10px;border-radius:50%;background:var(--jp-red);flex-shrink:0;margin-top:5px"></div>
                                <div>
                                    <div style="font-size:.72rem;color:var(--jp-gray-400);margin-bottom:2px">Antar ke</div>
                                    <div style="font-size:.875rem;font-weight:600">{{ $delivery->destination_address }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right: Detail --}}
            <div class="col-lg-7">

                {{-- Info Pengirim --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-user me-2 text-jp-green"></i>Info Pengirim</span>
                    </div>
                    <div class="jp-card-body">
                        <div class="info-row">
                            <span class="info-label">Nama</span>
                            <span class="info-value">{{ $delivery->sender_name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Telepon</span>
                            <span class="info-value">{{ $delivery->sender_phone }}</span>
                        </div>
                    </div>
                </div>

                {{-- Info Penerima --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-user-check me-2 text-jp-green"></i>Info Penerima</span>
                    </div>
                    <div class="jp-card-body">
                        <div class="info-row">
                            <span class="info-label">Nama</span>
                            <span class="info-value">{{ $delivery->recipient_name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Telepon</span>
                            <span class="info-value">{{ $delivery->recipient_phone }}</span>
                        </div>
                    </div>
                </div>

                {{-- Detail Paket --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-box me-2 text-jp-green"></i>Detail Paket</span>
                    </div>
                    <div class="jp-card-body">
                        <div class="info-row">
                            <span class="info-label">Jenis Paket</span>
                            <span class="info-value">{{ ucfirst(str_replace('_', ' ', $delivery->package_type)) }}</span>
                        </div>
                        @if($delivery->package_description)
                            <div class="info-row">
                                <span class="info-label">Isi Paket</span>
                                <span class="info-value">{{ $delivery->package_description }}</span>
                            </div>
                        @endif
                        <div class="info-row">
                            <span class="info-label">Berat</span>
                            <span class="info-value">{{ $delivery->weight }} kg</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Jarak</span>
                            <span class="info-value">{{ $delivery->distance }} km</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Mudah Pecah</span>
                            <span class="info-value">{{ $delivery->fragile ? '⚠️ Ya' : 'Tidak' }}</span>
                        </div>
                        @if($delivery->special_notes)
                            <div class="info-row">
                                <span class="info-label">Catatan</span>
                                <span class="info-value">{{ $delivery->special_notes }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Biaya --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-receipt me-2 text-jp-green"></i>Biaya Pengiriman</span>
                    </div>
                    <div class="jp-card-body">
                        <div class="info-row">
                            <span class="info-label">Total Biaya</span>
                            <span class="info-value" style="font-size:1.1rem;color:var(--jp-green)">
                                Rp {{ number_format($delivery->price, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Metode Bayar</span>
                            <span class="info-value">{{ ucfirst($delivery->payment_method ?? 'Cash') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status Bayar</span>
                            <span class="info-value">
                                <span class="jp-badge {{ $delivery->payment_status === 'paid' ? 'jp-badge-completed' : 'jp-badge-pending' }}">
                                    {{ $delivery->payment_status === 'paid' ? 'Lunas' : 'Belum Bayar' }}
                                </span>
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Dibuat</span>
                            <span class="info-value">{{ $delivery->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        @if($delivery->delivered_at)
                            <div class="info-row">
                                <span class="info-label">Diterima</span>
                                <span class="info-value">{{ $delivery->delivered_at->format('d M Y, H:i') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

