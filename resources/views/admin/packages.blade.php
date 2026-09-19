@extends('layouts.app')
@section('title', 'Pengiriman Paket — Admin JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}">
@endpush

@section('content')
<div class="jp-admin-top">
    <div class="container">
        <h1><i class="fas fa-box me-2"></i>Pengiriman Paket</h1>
        <p style="font-size:.85rem;color:rgba(255,255,255,.8);margin:.25rem 0 0">
            Total: {{ $deliveries->total() }} pengiriman
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
                                @foreach(['pending','accepted','picked_up','in_transit','delivered','cancelled'] as $s)
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
                                <th>No. Kirim</th>
                                <th>Pengirim</th>
                                <th>Penerima</th>
                                <th>Jenis Paket</th>
                                <th>Harga</th>
                                <th>Driver</th>
                                <th>Status</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($deliveries as $d)
                                <tr>
                                    <td>
                                        <span style="font-family:monospace;font-size:.8rem;font-weight:600">
                                            {{ $d->delivery_number }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-600" style="font-size:.875rem">{{ $d->sender_name }}</div>
                                        <div style="font-size:.75rem;color:var(--jp-gray-400)">
                                            {{ Str::limit($d->pickup_address, 30) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-600" style="font-size:.875rem">{{ $d->recipient_name }}</div>
                                        <div style="font-size:.75rem;color:var(--jp-gray-400)">
                                            {{ Str::limit($d->destination_address, 30) }}
                                        </div>
                                    </td>
                                    <td style="font-size:.8rem">
                                        {{ ucfirst(str_replace('_',' ',$d->package_type)) }}
                                        @if($d->fragile)
                                            <span title="Fragile" style="color:#F59E0B">⚠️</span>
                                        @endif
                                    </td>
                                    <td class="fw-600">Rp {{ number_format($d->price, 0, ',', '.') }}</td>
                                    <td style="font-size:.875rem;color:var(--jp-gray-500)">
                                        {{ $d->driver->name ?? '—' }}
                                    </td>
                                    <td>
                                        @php
                                            $sc = match($d->status) {
                                                'pending'    => 'jp-badge-pending',
                                                'accepted'   => 'jp-badge-accepted',
                                                'picked_up'  => 'jp-badge-pickup',
                                                'in_transit' => 'jp-badge-progress',
                                                'delivered'  => 'jp-badge-completed',
                                                'cancelled'  => 'jp-badge-cancelled',
                                                default      => 'jp-badge-pending',
                                            };
                                        @endphp
                                        <span class="jp-badge {{ $sc }}">
                                            {{ ucfirst(str_replace('_',' ',$d->status)) }}
                                        </span>
                                    </td>
                                    <td style="font-size:.78rem;color:var(--jp-gray-400);white-space:nowrap">
                                        {{ $d->created_at->format('d M Y, H:i') }}
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8">
                                    <div class="jp-empty">
                                        <div class="empty-icon"><i class="fas fa-box"></i></div>
                                        <p>Belum ada pengiriman paket</p>
                                    </div>
                                </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($deliveries->hasPages())
                <div style="padding:1rem 1.25rem;border-top:1px solid var(--jp-gray-200)">
                    {{ $deliveries->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

