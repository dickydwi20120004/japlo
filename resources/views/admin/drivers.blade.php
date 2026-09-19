@extends('layouts.app')
@section('title', 'Kelola Driver — Admin JAPLO')

@section('content')
<div style="background:linear-gradient(135deg,#15803D,#16A34A);padding:1.5rem 0 3rem;color:#fff">
    <div class="container">
        <h1 style="font-size:1.35rem;font-weight:700;margin:0">
            <i class="fas fa-id-card me-2"></i>Kelola Driver
        </h1>
        <p style="font-size:.85rem;color:rgba(255,255,255,.8);margin:.25rem 0 0">Total: {{ $drivers->total() }} driver terdaftar</p>
    </div>
</div>

<div style="margin-top:-2rem;position:relative;z-index:10;padding-bottom:2rem">
    <div class="container">
        <div class="jp-card">
            <div class="jp-card-body p-0">
                <div class="table-responsive">
                    <table class="jp-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kendaraan</th>
                                <th>Plat</th>
                                <th>Status</th>
                                <th>Verifikasi</th>
                                <th>Rating</th>
                                <th>Rides</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($drivers as $driverUser)
                                @php $d = $driverUser->driver; @endphp
                                <tr>
                                    <td>
                                        <div class="fw-600">{{ $driverUser->name }}</div>
                                        <div style="font-size:.78rem;color:var(--jp-gray-400)">{{ $driverUser->email }}</div>
                                    </td>
                                    <td style="font-size:.875rem">
                                        {{ $d ? ucfirst($d->vehicle_type) . ' — ' . $d->vehicle_brand : '—' }}
                                    </td>
                                    <td style="font-family:monospace;font-size:.85rem">
                                        {{ $d->license_plate ?? '—' }}
                                    </td>
                                    <td>
                                        @if($d && $d->is_available)
                                            <span class="jp-badge jp-badge-completed">Online</span>
                                        @else
                                            <span class="jp-badge jp-badge-cancelled">Offline</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($d && $d->is_verified)
                                            <span class="jp-badge jp-badge-completed">Terverifikasi</span>
                                        @else
                                            <span class="jp-badge jp-badge-pending">Menunggu</span>
                                        @endif
                                    </td>
                                    <td>
                                        <i class="fas fa-star" style="color:#F59E0B;font-size:.75rem"></i>
                                        {{ $d ? number_format($d->rating, 1) : '—' }}
                                    </td>
                                    <td>{{ $d ? number_format($d->total_rides) : '—' }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            @if($d && !$d->is_verified)
                                                <form method="POST" action="{{ route('admin.drivers.verify', $driverUser->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-jp-primary" title="Verifikasi">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            @if($d && $d->is_verified)
                                                <form method="POST" action="{{ route('admin.drivers.suspend', $driverUser->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm"
                                                            style="background:#FEE2E2;color:#DC2626;border:none" title="Suspend"
                                                            onclick="return confirm('Suspend driver ini?')">
                                                        <i class="fas fa-ban"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8">
                                    <div class="jp-empty"><div class="empty-icon"><i class="fas fa-id-card"></i></div><p>Belum ada driver</p></div>
                                </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($drivers->hasPages())
                <div style="padding:1rem 1.25rem;border-top:1px solid var(--jp-gray-200)">
                    {{ $drivers->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
