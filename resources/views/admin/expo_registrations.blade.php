@extends('layouts.app')
@section('title', 'Pendaftaran Expo — Admin JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}">
@endpush

@section('content')
<div class="jp-admin-top">
    <div class="container">
        <h1><i class="fas fa-store me-2"></i>Pendaftaran Tenant Mini Expo</h1>
    </div>
</div>

<div class="page-body">
    <div class="container">
        <div class="jp-card">
            <div class="jp-card-body p-0">
                <div class="table-responsive">
                    <table class="jp-table">
                        <thead>
                            <tr>
                                <th>Nama Usaha</th>
                                <th>Expo</th>
                                <th>Booth</th>
                                <th>Harga Booth</th>
                                <th>HP</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($registrations as $reg)
                                <tr>
                                    <td>
                                        <div class="fw-600">{{ $reg->business_name }}</div>
                                        <div style="font-size:.78rem;color:var(--jp-gray-400)">{{ $reg->owner_name }}</div>
                                    </td>
                                    <td style="font-size:.8rem">{{ $reg->expo_name }}</td>
                                    <td style="font-size:.875rem">{{ $reg->booth_size }}m²</td>
                                    <td class="fw-600">Rp {{ number_format($reg->booth_price, 0, ',', '.') }}</td>
                                    <td style="font-size:.875rem">{{ $reg->phone }}</td>
                                    <td>
                                        @php
                                            $sc = match($reg->status) {
                                                'pending'  => 'jp-badge-pending',
                                                'approved' => 'jp-badge-completed',
                                                'rejected' => 'jp-badge-cancelled',
                                                'paid'     => 'jp-badge-accepted',
                                                default    => 'jp-badge-pending',
                                            };
                                        @endphp
                                        <span class="jp-badge {{ $sc }}">{{ ucfirst($reg->status) }}</span>
                                    </td>
                                    <td style="font-size:.78rem;color:var(--jp-gray-400)">
                                        {{ $reg->created_at->format('d M Y') }}
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            @if($reg->status === 'pending')
                                                <form method="POST" action="{{ route('admin.expo_registrations.approve', $reg->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-jp-primary" title="Setujui">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.expo_registrations.reject', $reg->id) }}"
                                                      onsubmit="return confirm('Tolak pendaftaran ini?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm"
                                                            style="background:#FEE2E2;color:#DC2626;border:none">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8">
                                    <div class="jp-empty">
                                        <div class="empty-icon"><i class="fas fa-store"></i></div>
                                        <p>Belum ada pendaftaran expo</p>
                                    </div>
                                </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($registrations->hasPages())
                <div style="padding:1rem 1.25rem;border-top:1px solid var(--jp-gray-200)">
                    {{ $registrations->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

