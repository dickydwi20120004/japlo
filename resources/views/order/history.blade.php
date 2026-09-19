@extends('layouts.app')
@section('title', 'Riwayat Pesanan — JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/order.css') }}">
@endpush

@section('content')

<div class="jp-page-top">
    <div class="container">
        <div class="mb-2">
            <a href="{{ route('dashboard') }}" class="btn btn-sm"
               style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;border-radius:8px">
                <i class="fas fa-arrow-left me-1"></i> Dashboard
            </a>
        </div>
        <h1><i class="fas fa-clock-rotate-left me-2"></i>Riwayat Pesanan</h1>
        <div class="d-flex gap-3 mt-2" style="font-size:.8rem;color:rgba(255,255,255,.8)">
            <span>Total: <strong>{{ $totalOrders }}</strong></span>
            <span>Selesai: <strong>{{ $completedOrders }}</strong></span>
            <span>Dibatalkan: <strong>{{ $cancelledOrders }}</strong></span>
            @if($totalSpent > 0)
                <span>Pengeluaran: <strong>Rp {{ number_format($totalSpent, 0, ',', '.') }}</strong></span>
            @endif
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container">

        {{-- Filter Tab --}}
        <div class="jp-card mb-4">
            <div class="jp-card-body">
                <div class="d-flex flex-wrap gap-2">
                    @php $currentStatus = request('status', ''); @endphp
                    @php
                        $filters = [
                            '' => 'Semua',
                            'pending' => 'Menunggu',
                            'accepted,picked_up,in_progress' => 'Dalam Proses',
                            'completed' => 'Selesai',
                            'cancelled' => 'Dibatalkan',
                        ];
                    @endphp
                    @foreach($filters as $val => $label)
                        <a href="{{ route('order.history') }}?status={{ $val }}"
                           class="btn btn-sm {{ $currentStatus === $val ? 'btn-jp-primary' : 'btn-jp-ghost' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Orders --}}
        @if($orders->count() > 0)
            <div class="d-flex flex-column gap-3">
                @foreach($orders as $order)
                    <div class="order-card">
                        <div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
                            {{-- Info kiri --}}
                            <div class="flex-grow-1">
                                {{-- Header --}}
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <span style="font-family:monospace;font-size:.8rem;font-weight:700;color:var(--jp-gray-700)">
                                        {{ $order->order_number }}
                                    </span>
                                    @php
                                        $badgeMap = [
                                            'pending'     => 'jp-badge-pending',
                                            'accepted'    => 'jp-badge-accepted',
                                            'picked_up'   => 'jp-badge-pickup',
                                            'in_progress' => 'jp-badge-progress',
                                            'completed'   => 'jp-badge-completed',
                                            'cancelled'   => 'jp-badge-cancelled',
                                        ];
                                    @endphp
                                    <span class="jp-badge {{ $badgeMap[$order->status] ?? '' }}">
                                        {{ ucfirst(str_replace('_',' ',$order->status)) }}
                                    </span>
                                    @if($order->payment_status === 'paid')
                                        <span class="jp-badge jp-badge-completed" style="font-size:.7rem">Lunas</span>
                                    @endif
                                </div>

                                {{-- Route --}}
                                <div class="route-mini mb-1">
                                    <span class="dot" style="background:var(--jp-green)"></span>
                                    <span>{{ Str::limit($order->pickup_address, 45) }}</span>
                                </div>
                                <div style="margin-left:3px;margin-bottom:.25rem">
                                    <div class="route-mini" style="flex-direction:column;align-items:flex-start;gap:0">
                                        <div class="line"></div>
                                    </div>
                                </div>
                                <div class="route-mini mb-2">
                                    <span class="dot" style="background:var(--jp-red,#EF4444)"></span>
                                    <span>{{ Str::limit($order->destination_address, 45) }}</span>
                                </div>

                                {{-- Meta --}}
                                <div class="d-flex flex-wrap gap-3" style="font-size:.78rem;color:var(--jp-gray-400)">
                                    <span><i class="fas fa-calendar me-1"></i>{{ $order->created_at->format('d M Y, H:i') }}</span>
                                    <span><i class="fas fa-road me-1"></i>{{ $order->distance }} km</span>
                                    @if($order->driver)
                                        <span><i class="fas fa-motorcycle me-1"></i>{{ $order->driver->name }}</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Harga & Aksi --}}
                            <div class="text-end" style="flex-shrink:0">
                                <div style="font-size:1.1rem;font-weight:800;color:var(--jp-green)">
                                    Rp {{ number_format($order->price, 0, ',', '.') }}
                                </div>
                                <div class="d-flex gap-2 mt-2 justify-content-end">
                                    @if(in_array($order->status, ['pending','accepted','picked_up','in_progress']))
                                        <a href="{{ route('order.track', $order->id) }}"
                                           class="btn btn-sm btn-jp-primary">
                                            <i class="fas fa-location-dot me-1"></i> Lacak
                                        </a>
                                    @else
                                        <a href="{{ route('order.track', $order->id) }}"
                                           class="btn btn-sm btn-jp-ghost">
                                            <i class="fas fa-eye me-1"></i> Detail
                                        </a>
                                    @endif
                                    @if($order->status === 'completed' && !$order->rating)
                                        <a href="{{ route('order.track', $order->id) }}"
                                           class="btn btn-sm btn-jp-outline">
                                            <i class="fas fa-star me-1"></i> Beri Rating
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($orders->hasPages())
                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            @endif

        @else
            <div class="jp-empty" style="padding:4rem 1rem">
                <div class="empty-icon"><i class="fas fa-clock-rotate-left"></i></div>
                <p>Belum ada riwayat pesanan</p>
                <a href="{{ route('customer.ojek') }}" class="btn btn-jp-primary btn-sm">
                    <i class="fas fa-motorcycle me-2"></i>Pesan Ojek Sekarang
                </a>
            </div>
        @endif

    </div>
</div>
@endsection

