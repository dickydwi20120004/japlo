@extends('layouts.app')
@section('title', 'Kelola Promosi — Admin JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}">
@endpush

@section('content')
<div class="jp-admin-top">
    <div class="container">
        <h1><i class="fas fa-tag me-2"></i>Kelola Promosi</h1>
    </div>
</div>

<div class="page-body">
    <div class="container">

        {{-- Tambah Promosi --}}
        <div class="jp-card mb-4">
            <div class="jp-card-header">
                <span><i class="fas fa-plus me-2 text-jp-green"></i>Tambah Promosi Baru</span>
            </div>
            <div class="jp-card-body">
                <form method="POST" action="{{ route('admin.promotions.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Judul Promo <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" required placeholder="Contoh: Diskon 20% Kuliner">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tipe <span class="text-danger">*</span></label>
                            <select name="type" class="form-select" required>
                                <option value="discount">Diskon</option>
                                <option value="cashback">Cashback</option>
                                <option value="free_delivery">Gratis Ongkir</option>
                                <option value="info">Info</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Kategori</label>
                            <select name="category" class="form-select">
                                <option value="">Semua Layanan</option>
                                <option value="Transportasi">Transportasi</option>
                                <option value="Kuliner">Kuliner</option>
                                <option value="Produk">Produk</option>
                                <option value="Kesehatan">Kesehatan</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nilai Diskon</label>
                            <input type="number" name="discount_value" class="form-control" placeholder="20" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tipe Diskon</label>
                            <select name="discount_type" class="form-select">
                                <option value="percent">Persen (%)</option>
                                <option value="nominal">Nominal (Rp)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Kode Promo</label>
                            <input type="text" name="promo_code" class="form-control" placeholder="PROMO20" style="text-transform:uppercase">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Kuota</label>
                            <input type="number" name="quota" class="form-control" placeholder="100 (kosong=unlimited)" min="1">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="start_date" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Berakhir</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" name="description" class="form-control" placeholder="Deskripsi singkat promo">
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" checked id="promoActive">
                                <label class="form-check-label" for="promoActive">Aktifkan promo</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-jp-primary">
                                <i class="fas fa-plus me-1"></i> Tambah Promosi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- List Promosi --}}
        <div class="jp-card">
            <div class="jp-card-body p-0">
                <div class="table-responsive">
                    <table class="jp-table">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Kode</th>
                                <th>Tipe</th>
                                <th>Diskon</th>
                                <th>Kuota</th>
                                <th>Berakhir</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($promotions as $promo)
                                <tr>
                                    <td class="fw-600">{{ $promo->title }}</td>
                                    <td>
                                        @if($promo->promo_code)
                                            <code style="background:#F3F4F6;padding:2px 8px;border-radius:4px;font-size:.8rem">
                                                {{ $promo->promo_code }}
                                            </code>
                                        @else
                                            <span style="color:var(--jp-gray-400)">—</span>
                                        @endif
                                    </td>
                                    <td style="font-size:.8rem">{{ ucfirst(str_replace('_',' ',$promo->type)) }}</td>
                                    <td style="font-size:.875rem">
                                        @if($promo->discount_value)
                                            {{ $promo->discount_type === 'percent'
                                                ? $promo->discount_value . '%'
                                                : 'Rp ' . number_format($promo->discount_value, 0, ',', '.') }}
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td style="font-size:.875rem">
                                        {{ $promo->quota
                                            ? $promo->used_count . '/' . $promo->quota
                                            : $promo->used_count . '/∞' }}
                                    </td>
                                    <td style="font-size:.78rem;color:var(--jp-gray-400)">
                                        {{ $promo->end_date ? $promo->end_date->format('d M Y') : '∞' }}
                                    </td>
                                    <td>
                                        <span class="jp-badge {{ $promo->is_active ? 'jp-badge-completed' : 'jp-badge-cancelled' }}">
                                            {{ $promo->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.promotions.delete', $promo->id) }}"
                                              onsubmit="return confirm('Hapus promosi ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm" style="background:#FEE2E2;color:#DC2626;border:none">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8">
                                    <div class="jp-empty"><div class="empty-icon"><i class="fas fa-tag"></i></div><p>Belum ada promosi</p></div>
                                </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($promotions->hasPages())
                <div style="padding:1rem 1.25rem;border-top:1px solid var(--jp-gray-200)">
                    {{ $promotions->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

