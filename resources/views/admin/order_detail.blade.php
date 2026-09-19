@extends('layouts.app')
@section('title', 'Detail Order #' . $order->order_number . ' — Admin JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}">
@endpush

@section('content')
<div class="jp-admin-top">
    <div class="container">
        <div class="mb-2">
            <a href="{{ route('admin.orders') }}" class="btn btn-sm"
               style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;border-radius:8px">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <h1><i class="fas fa-receipt me-2"></i>{{ $order->order_number }}</h1>
        <p style="font-size:.85rem;color:rgba(255,255,255,.8);margin:.25rem 0 0">
            {{ $order->created_at->format('d F Y, H:i') }}
        </p>
    </div>
</div>

<div class="page-body">
    <div class="container">
        <div class="row g-4">

            {{-- Info Order --}}
            <div class="col-lg-8">

                {{-- Status --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span>Status Pesanan</span>
                        @php
                            $sc = match($order->status) {
                                'pending'     => 'jp-badge-pending',
                                'accepted'    => 'jp-badge-accepted',
                                'picked_up'   => 'jp-badge-pickup',
                                'in_progress' => 'jp-badge-progress',
                                'completed'   => 'jp-badge-completed',
                                'cancelled'   => 'jp-badge-cancelled',
                                default       => 'jp-badge-pending',
                            };
                        @endphp
                        <span class="jp-badge {{ $sc }}" style="font-size:.85rem;padding:5px 14px">
                            {{ ucfirst(str_replace('_',' ',$order->status)) }}
                        </span>
                    </div>
                    <div class="jp-card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="detail-row">
                                    <span class="detail-label">Dari</span>
                                    <span class="detail-value">{{ $order->pickup_address }}</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Ke</span>
                                    <span class="detail-value">{{ $order->destination_address }}</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Jarak</span>
                                    <span class="detail-value">{{ $order->distance }} km</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Est. Waktu</span>
                                    <span class="detail-value">{{ $order->estimated_time }} menit</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-row">
                                    <span class="detail-label">Harga</span>
                                    <span class="detail-value" style="color:var(--jp-green)">
                                        Rp {{ number_format($order->price, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Metode Bayar</span>
                                    <span class="detail-value">{{ ucfirst($order->payment_method) }}</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Status Bayar</span>
                                    <span class="jp-badge {{ $order->payment_status === 'paid' ? 'jp-badge-completed' : 'jp-badge-pending' }}">
                                        {{ $order->payment_status === 'paid' ? 'Lunas' : 'Belum Bayar' }}
                                    </span>
                                </div>
                                @if($order->customer_notes)
                                    <div class="detail-row">
                                        <span class="detail-label">Catatan</span>
                                        <span class="detail-value">{{ $order->customer_notes }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Order Items --}}
                @if($order->items && $order->items->count() > 0)
                    <div class="jp-card mb-4">
                        <div class="jp-card-header">
                            <span>Item Pesanan</span>
                        </div>
                        <div class="jp-card-body p-0">
                            <table class="jp-table">
                                <thead>
                                    <tr>
                                        <th>Nama Item</th>
                                        <th>Tipe</th>
                                        <th>Qty</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td class="fw-600">{{ $item->item_name }}</td>
                                            <td style="font-size:.8rem">{{ ucfirst($item->item_type) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td class="fw-600">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                {{-- Rating --}}
                @if($order->rating)
                    <div class="jp-card">
                        <div class="jp-card-header"><span>Rating dari Customer</span></div>
                        <div class="jp-card-body">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star" style="color: {{ $i <= $order->rating->rating ? '#F59E0B' : '#E5E7EB' }}"></i>
                                @endfor
                                <span class="fw-700">{{ $order->rating->rating }}/5</span>
                            </div>
                            @if($order->rating->review)
                                <p style="font-size:.875rem;color:var(--jp-gray-600);margin:0;font-style:italic">
                                    "{{ $order->rating->review }}"
                                </p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            {{-- Sidebar: Customer & Driver --}}
            <div class="col-lg-4">

                {{-- Customer --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header"><span><i class="fas fa-user me-2 text-jp-green"></i>Customer</span></div>
                    <div class="jp-card-body">
                        @if($order->user)
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div style="width:44px;height:44px;border-radius:50%;background:var(--jp-green-light);color:var(--jp-green);display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0">
                                    {{ strtoupper(substr($order->user->name,0,1)) }}
                                </div>
                                <div>
                                    <div class="fw-700">{{ $order->user->name }}</div>
                                    <div style="font-size:.8rem;color:var(--jp-gray-400)">{{ $order->user->email }}</div>
                                </div>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Telepon</span>
                                <span class="detail-value">{{ $order->user->phone ?? '—' }}</span>
                            </div>
                        @else
                            <p style="color:var(--jp-gray-400);font-size:.875rem">Data tidak tersedia</p>
                        @endif
                    </div>
                </div>

                {{-- Driver --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header"><span><i class="fas fa-motorcycle me-2 text-jp-green"></i>Driver</span></div>
                    <div class="jp-card-body">
                        @if($order->driver)
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div style="width:44px;height:44px;border-radius:50%;background:#FEF3C7;color:#D97706;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0">
                                    {{ strtoupper(substr($order->driver->name,0,1)) }}
                                </div>
                                <div>
                                    <div class="fw-700">{{ $order->driver->name }}</div>
                                    <div style="font-size:.8rem;color:var(--jp-gray-400)">{{ $order->driver->email }}</div>
                                </div>
                            </div>
                            @if($order->driver->driver)
                                <div class="detail-row">
                                    <span class="detail-label">Kendaraan</span>
                                    <span class="detail-value">{{ $order->driver->driver->vehicle_brand ?? '—' }}</span>
                                </div>
                                <div class="detail-row">
                                    <span class="detail-label">Plat</span>
                                    <span class="detail-value" style="font-family:monospace">{{ $order->driver->driver->license_plate ?? '—' }}</span>
                                </div>
                            @endif
                        @else
                            <div class="jp-empty" style="padding:1.5rem">
                                <p style="margin:0">Belum ada driver</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Payment --}}
                @if($order->payment)
                    <div class="jp-card">
                        <div class="jp-card-header"><span><i class="fas fa-credit-card me-2 text-jp-green"></i>Pembayaran</span></div>
                        <div class="jp-card-body">
                            <div class="detail-row">
                                <span class="detail-label">Transaction ID</span>
                                <span class="detail-value" style="font-family:monospace;font-size:.75rem">
                                    {{ $order->payment->transaction_id }}
                                </span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Subtotal</span>
                                <span class="detail-value">Rp {{ number_format($order->payment->subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Total</span>
                                <span class="detail-value" style="color:var(--jp-green)">
                                    Rp {{ number_format($order->payment->total_amount, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="detail-row">
                                <span class="detail-label">Status</span>
                                <span class="jp-badge {{ $order->payment->payment_status === 'success' ? 'jp-badge-completed' : 'jp-badge-pending' }}">
                                    {{ ucfirst($order->payment->payment_status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection

