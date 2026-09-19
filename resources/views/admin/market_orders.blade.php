@extends('layouts.app')
@section('title', 'Belanja Pasar — Admin JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}">
@endpush

@section('content')
<div class="jp-admin-top">
    <div class="container">
        <h1><i class="fas fa-cart-shopping me-2"></i>Order Belanja Pasar</h1>
        <p style="font-size:.85rem;color:rgba(255,255,255,.8);margin:.25rem 0 0">
            Total: {{ $orders->total() }} order
        </p>
    </div>
</div>

<div class="page-body">
    <div class="container">

        {{-- Filter --}}
        <div class="jp-card mb-4">
            <div class="jp-card-body">
                <form method="GET">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                @foreach(['pending','accepted','shopping','on_the_way','delivered','cancelled'] as $s)
                                    <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_',' ',$s)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-jp-primary w-100">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="jp-card">
            <div class="jp-card-body p-0">
                <div class="table-responsive">
                    <table class="jp-table">
                        <thead>
                            <tr>
                                <th>No. Order</th>
                                <th>Customer</th>
                                <th>Pasar</th>
                                <th>Item</th>
                                <th>Est. Total</th>
                                <th>Ongkir</th>
                                <th>Driver</th>
                                <th>Status</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>
                                        <span style="font-family:monospace;font-size:.8rem;font-weight:600">
                                            {{ $order->order_number }}
                                        </span>
                                    </td>
                                    <td style="font-size:.875rem">{{ $order->customer->name ?? '—' }}</td>
                                    <td style="font-size:.875rem">{{ $order->market_name }}</td>
                                    <td>
                                        <span class="jp-badge jp-badge-accepted" style="font-size:.72rem">
                                            {{ $order->items->count() }} item
                                        </span>
                                    </td>
                                    <td class="fw-600">
                                        @if($order->estimated_price)
                                            Rp {{ number_format($order->estimated_price, 0, ',', '.') }}
                                        @else
                                            <span style="color:var(--jp-gray-400)">—</span>
                                        @endif
                                    </td>
                                    <td style="font-size:.875rem">
                                        Rp {{ number_format($order->delivery_fee, 0, ',', '.') }}
                                    </td>
                                    <td style="font-size:.875rem;color:var(--jp-gray-500)">
                                        {{ $order->driver->name ?? '—' }}
                                    </td>
                                    <td>
                                        @php
                                            $sc = match($order->status) {
                                                'pending'    => 'jp-badge-pending',
                                                'accepted'   => 'jp-badge-accepted',
                                                'shopping'   => 'jp-badge-pickup',
                                                'on_the_way' => 'jp-badge-progress',
                                                'delivered'  => 'jp-badge-completed',
                                                'cancelled'  => 'jp-badge-cancelled',
                                                default      => 'jp-badge-pending',
                                            };
                                        @endphp
                                        <span class="jp-badge {{ $sc }}">
                                            {{ ucfirst(str_replace('_',' ',$order->status)) }}
                                        </span>
                                    </td>
                                    <td style="font-size:.78rem;color:var(--jp-gray-400);white-space:nowrap">
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="9">
                                    <div class="jp-empty">
                                        <div class="empty-icon"><i class="fas fa-cart-shopping"></i></div>
                                        <p>Belum ada order belanja pasar</p>
                                    </div>
                                </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($orders->hasPages())
                <div style="padding:1rem 1.25rem;border-top:1px solid var(--jp-gray-200)">
                    {{ $orders->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

