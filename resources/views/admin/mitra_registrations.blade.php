@extends('layouts.app')
@section('title', 'Pendaftaran Mitra — Admin JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}">
@endpush

@section('content')
<div class="jp-admin-top">
    <div class="container">
        <h1><i class="fas fa-handshake me-2"></i>Pendaftaran Mitra Usaha</h1>
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
                                @foreach(['pending','approved','rejected','suspended'] as $s)
                                    <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>
                                        {{ ucfirst($s) }}
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
                                <th>Nama Usaha</th>
                                <th>Pemilik</th>
                                <th>Jenis</th>
                                <th>Tier</th>
                                <th>HP</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($registrations as $reg)
                                <tr>
                                    <td class="fw-600">{{ $reg->business_name }}</td>
                                    <td style="font-size:.875rem">{{ $reg->owner_name }}</td>
                                    <td style="font-size:.8rem">{{ ucfirst($reg->business_type) }}</td>
                                    <td>
                                        <span style="font-size:.78rem;font-weight:600;text-transform:uppercase">
                                            {{ $reg->membership_tier }}
                                        </span>
                                    </td>
                                    <td style="font-size:.875rem">{{ $reg->phone }}</td>
                                    <td>
                                        @php
                                            $sc = match($reg->status) {
                                                'pending'  => 'jp-badge-pending',
                                                'approved' => 'jp-badge-completed',
                                                'rejected' => 'jp-badge-cancelled',
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
                                                <form method="POST" action="{{ route('admin.mitra_registrations.approve', $reg->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-jp-primary" title="Setujui">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.mitra_registrations.reject', $reg->id) }}"
                                                      onsubmit="return confirm('Tolak pendaftaran ini?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm"
                                                            style="background:#FEE2E2;color:#DC2626;border:none" title="Tolak">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            @if($reg->ktp_photo)
                                                <a href="{{ asset('storage/' . $reg->ktp_photo) }}"
                                                   target="_blank" class="btn btn-sm btn-jp-ghost" title="Lihat KTP">
                                                    <i class="fas fa-id-card"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8">
                                    <div class="jp-empty">
                                        <div class="empty-icon"><i class="fas fa-handshake"></i></div>
                                        <p>Belum ada pendaftaran mitra</p>
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

