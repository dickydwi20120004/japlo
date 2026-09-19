@extends('layouts.app')
@section('title', 'Kelola Pesanan — Admin JAPLO')

@section('content')
<div style="background:linear-gradient(135deg,#15803D,#16A34A);padding:1.5rem 0 3rem;color:#fff">
    <div class="container">
        <h1 style="font-size:1.35rem;font-weight:700;margin:0">
            <i class="fas fa-receipt me-2"></i>Kelola Pesanan
        </h1>
        <p style="font-size:.85rem;color:rgba(255,255,255,.8);margin:.25rem 0 0">Total: {{ $orders->total() }} pesanan</p>
    </div>
</div>

<div style="margin-top:-2rem;position:relative;z-index:10;padding-bottom:2rem">
    <div class="container">

        {{-- Filter --}}
        <div class="jp-card mb-4">
            <div class="jp-card-body">
                <form method="GET">
                    <div class="row g-2">
                        <div class="col-md-5">
                            <input type="text" name="search" class="form-control"
                                   placeholder="Cari nomor order..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4">
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                @foreach(['pending','accepted','picked_up','in_progress','completed','cancelled'] as $s)
                                    <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_', ' ', $s)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-jp-primary w-100">
                                <i class="fas fa-filter me-1"></i> Filter
                            </button>
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
                                <th>Driver</th>
                                <th>Tujuan</th>
                                <th>Harga</th>
                                <th>Bayar</th>
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
                                    <td style="font-size:.875rem">{{ $order->user->name ?? '—' }}</td>
                                    <td style="font-size:.875rem;color:var(--jp-gray-500)">
                                        {{ $order->driver->name ?? '<em>Belum</em>' }}
                                    </td>
                                    <td style="font-size:.8rem;max-width:150px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                                        {{ $order->destination_address }}
                                    </td>
                                    <td class="fw-600">Rp {{ number_format($order->price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="jp-badge {{ $order->payment_status === 'paid' ? 'jp-badge-completed' : 'jp-badge-pending' }}">
                                            {{ $order->payment_status === 'paid' ? 'Lunas' : 'Belum' }}
                                        </span>
                                    </td>
                                    <td>
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
                                    </td>
                                    <td style="font-size:.78rem;color:var(--jp-gray-400);white-space:nowrap">
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8">
                                    <div class="jp-empty"><div class="empty-icon"><i class="fas fa-receipt"></i></div><p>Belum ada pesanan</p></div>
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
