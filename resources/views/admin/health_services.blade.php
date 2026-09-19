@extends('layouts.app')
@section('title', 'Kelola Layanan Kesehatan — Admin JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}">
@endpush

@section('content')
<div class="jp-admin-top">
    <div class="container">
        <h1><i class="fas fa-kit-medical me-2"></i>Kelola Layanan Kesehatan</h1>
    </div>
</div>

<div class="page-body">
    <div class="container">

        {{-- Tambah Layanan --}}
        <div class="jp-card mb-4">
            <div class="jp-card-header">
                <span><i class="fas fa-plus me-2 text-jp-green"></i>Tambah Layanan Baru</span>
            </div>
            <div class="jp-card-body">
                <form method="POST" action="{{ route('admin.health_services.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label">Nama Layanan <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required placeholder="Nama layanan kesehatan">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control" required min="0" step="1000"
                                   placeholder="0 = Gratis">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Provider</label>
                            <input type="text" name="provider" class="form-control" placeholder="Nama klinik/provider">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Nomor HP</label>
                            <input type="text" name="phone" class="form-control" placeholder="08xx">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="2"
                                      placeholder="Deskripsi singkat layanan..."></textarea>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_available" value="1" checked id="hsAvail">
                                <label class="form-check-label" for="hsAvail" style="font-size:.875rem">
                                    Layanan tersedia
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-jp-primary">
                                <i class="fas fa-plus me-1"></i> Tambah Layanan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- List --}}
        <div class="jp-card">
            <div class="jp-card-body p-0">
                <div class="table-responsive">
                    <table class="jp-table">
                        <thead>
                            <tr>
                                <th>Nama Layanan</th>
                                <th>Provider</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($services as $svc)
                                <tr>
                                    <td>
                                        <div class="fw-600">{{ $svc->name }}</div>
                                        <div style="font-size:.75rem;color:var(--jp-gray-400)">
                                            {{ Str::limit($svc->description, 60) }}
                                        </div>
                                    </td>
                                    <td style="font-size:.875rem">{{ $svc->provider ?? '—' }}</td>
                                    <td class="fw-600">
                                        {{ $svc->price > 0 ? 'Rp ' . number_format($svc->price, 0, ',', '.') : 'Gratis' }}
                                    </td>
                                    <td>
                                        <span class="jp-badge {{ $svc->is_available ? 'jp-badge-completed' : 'jp-badge-cancelled' }}">
                                            {{ $svc->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                                        </span>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.health_services.delete', $svc->id) }}"
                                              onsubmit="return confirm('Hapus layanan ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm"
                                                    style="background:#FEE2E2;color:#DC2626;border:none">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5">
                                    <div class="jp-empty">
                                        <div class="empty-icon"><i class="fas fa-kit-medical"></i></div>
                                        <p>Belum ada layanan kesehatan</p>
                                    </div>
                                </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($services->hasPages())
                <div style="padding:1rem 1.25rem;border-top:1px solid var(--jp-gray-200)">
                    {{ $services->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

