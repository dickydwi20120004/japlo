@extends('layouts.app')
@section('title', 'Detail Order Pasar ' . $marketOrder->order_number . ' — JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/services.css') }}">
@endpush

@section('content')
<div class="jp-page-top">
    <div class="container">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('customer.pasar') }}" class="btn btn-sm"
               style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;border-radius:8px">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="d-flex align-items-center gap-3">
            <div style="font-size:2rem">🛒</div>
            <div>
                <h1>{{ $marketOrder->order_number }}</h1>
                <span class="jp-badge"
                      style="{{ match($marketOrder->status) {
                        'pending'    => 'background:rgba(255,255,255,.2);color:#fff',
                        'accepted'   => 'background:rgba(255,255,255,.2);color:#fff',
                        'shopping'   => 'background:rgba(255,255,255,.2);color:#fff',
                        'on_the_way' => 'background:rgba(255,255,255,.2);color:#fff',
                        'delivered'  => 'background:rgba(255,255,255,.2);color:#fff',
                        'cancelled'  => 'background:rgba(255,100,100,.3);color:#fff',
                        default      => 'background:rgba(255,255,255,.2);color:#fff',
                      } }}">
                    {{ ucfirst(str_replace('_', ' ', $marketOrder->status)) }}
                </span>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container">
        <div class="row g-4">

            {{-- Detail Info --}}
            <div class="col-lg-6">
                {{-- Info Order --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-store me-2 text-jp-green"></i>Info Order</span>
                    </div>
                    <div class="jp-card-body">
                        <div class="info-row">
                            <span class="info-label">No. Order</span>
                            <span class="info-value" style="font-family:monospace">{{ $marketOrder->order_number }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Pasar</span>
                            <span class="info-value">{{ $marketOrder->market_name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Alamat Kirim</span>
                            <span class="info-value">{{ $marketOrder->delivery_address }}</span>
                        </div>
                        @if($marketOrder->notes)
                            <div class="info-row">
                                <span class="info-label">Catatan</span>
                                <span class="info-value">{{ $marketOrder->notes }}</span>
                            </div>
                        @endif
                        <div class="info-row">
                            <span class="info-label">Status</span>
                            <span class="info-value">
                                <span class="jp-badge"
                                      style="{{ match($marketOrder->status) {
                                        'pending'    => 'background:#FEF3C7;color:#D97706',
                                        'accepted'   => 'background:#DBEAFE;color:#2563EB',
                                        'shopping'   => 'background:#EDE9FE;color:#7C3AED',
                                        'on_the_way' => 'background:#FEF9C3;color:#A16207',
                                        'delivered'  => 'background:#DCFCE7;color:#15803D',
                                        'cancelled'  => 'background:#FEE2E2;color:#DC2626',
                                        default      => 'background:#F3F4F6;color:#6B7280',
                                      } }}">
                                    {{ ucfirst(str_replace('_', ' ', $marketOrder->status)) }}
                                </span>
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Dibuat</span>
                            <span class="info-value">{{ $marketOrder->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        @if($marketOrder->delivered_at)
                            <div class="info-row">
                                <span class="info-label">Diterima</span>
                                <span class="info-value">{{ $marketOrder->delivered_at->format('d M Y, H:i') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Biaya --}}
                <div class="jp-card">
                    <div class="jp-card-header">
                        <span><i class="fas fa-receipt me-2 text-jp-green"></i>Rincian Biaya</span>
                    </div>
                    <div class="jp-card-body">
                        <div class="price-row">
                            <span style="color:var(--jp-gray-600)">Estimasi Belanjaan</span>
                            <span>Rp {{ number_format($marketOrder->estimated_price ?? 0, 0, ',', '.') }}</span>
                        </div>
                        @if($marketOrder->actual_price)
                            <div class="price-row">
                                <span style="color:var(--jp-gray-600)">Harga Aktual</span>
                                <span>Rp {{ number_format($marketOrder->actual_price, 0, ',', '.') }}</span>
                            </div>
                        @endif
                        <div class="price-row">
                            <span style="color:var(--jp-gray-600)">Ongkir</span>
                            <span>Rp {{ number_format($marketOrder->delivery_fee ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="price-row">
                            <span style="color:var(--jp-gray-600)">Service Fee</span>
                            <span>Rp {{ number_format($marketOrder->service_fee ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="price-row total">
                            <span>Total</span>
                            <span>Rp {{ number_format($marketOrder->total ?? ($marketOrder->estimated_price + $marketOrder->delivery_fee + $marketOrder->service_fee), 0, ',', '.') }}</span>
                        </div>
                        <div style="margin-top:.75rem;padding-top:.75rem;border-top:1px solid var(--jp-gray-100)">
                            <div class="d-flex justify-content-between font-size-sm" style="font-size:.8rem">
                                <span style="color:var(--jp-gray-500)">Metode Bayar</span>
                                <span style="font-weight:600">{{ ucfirst($marketOrder->payment_method ?? 'Cash') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mt-1" style="font-size:.8rem">
                                <span style="color:var(--jp-gray-500)">Status Bayar</span>
                                <span>
                                    <span class="jp-badge {{ ($marketOrder->payment_status ?? '') === 'paid' ? 'jp-badge-completed' : 'jp-badge-pending' }}">
                                        {{ ($marketOrder->payment_status ?? '') === 'paid' ? 'Lunas' : 'Belum Bayar' }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Daftar Item --}}
            <div class="col-lg-6">
                <div class="jp-card">
                    <div class="jp-card-header">
                        <span><i class="fas fa-list-check me-2 text-jp-green"></i>Daftar Belanjaan</span>
                        <span class="jp-badge" style="background:var(--jp-green-light);color:var(--jp-green)">
                            {{ $marketOrder->items->count() }} item
                        </span>
                    </div>
                    <div class="jp-card-body p-0">
                        @if($marketOrder->items->count() > 0)
                            <div class="table-responsive">
                                <table class="jp-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                            <th>Est. Harga</th>
                                            @if($marketOrder->items->where('actual_price', '>', 0)->count() > 0)
                                                <th>Harga Aktual</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($marketOrder->items as $i => $item)
                                            <tr>
                                                <td style="color:var(--jp-gray-400);font-size:.8rem">{{ $i + 1 }}</td>
                                                <td>
                                                    <div style="font-weight:600;font-size:.875rem">{{ $item->item_name }}</div>
                                                    @if($item->description)
                                                        <div style="font-size:.75rem;color:var(--jp-gray-400)">{{ $item->description }}</div>
                                                    @endif
                                                </td>
                                                <td style="font-size:.875rem;white-space:nowrap">
                                                    {{ $item->quantity }} {{ $item->unit }}
                                                </td>
                                                <td style="font-size:.875rem">
                                                    @if($item->estimated_price)
                                                        Rp {{ number_format($item->estimated_price, 0, ',', '.') }}
                                                    @else
                                                        <span style="color:var(--jp-gray-400)">—</span>
                                                    @endif
                                                </td>
                                                @if($marketOrder->items->where('actual_price', '>', 0)->count() > 0)
                                                    <td style="font-size:.875rem">
                                                        @if($item->actual_price)
                                                            <span style="color:var(--jp-green);font-weight:600">
                                                                Rp {{ number_format($item->actual_price, 0, ',', '.') }}
                                                            </span>
                                                        @else
                                                            <span style="color:var(--jp-gray-400)">—</span>
                                                        @endif
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="jp-empty">
                                <div class="empty-icon"><i class="fas fa-list"></i></div>
                                <p>Tidak ada item</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

