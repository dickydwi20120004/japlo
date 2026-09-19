@extends('layouts.app')
@section('title', 'Kelola Restoran — Admin JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}">
@endpush

@section('content')
<div class="jp-admin-top">
    <div class="container">
        <h1><i class="fas fa-utensils me-2"></i>Kelola Restoran & Kuliner</h1>
    </div>
</div>

<div class="page-body">
    <div class="container">

        {{-- Tambah Restoran --}}
        <div class="jp-card mb-4">
            <div class="jp-card-header">
                <span><i class="fas fa-plus me-2 text-jp-green"></i>Tambah Restoran Baru</span>
            </div>
            <div class="jp-card-body">
                <form method="POST" action="{{ route('admin.restaurants.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label">Nama Restoran <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required placeholder="Nama warung/restoran">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select name="category" class="form-select" required>
                                <option value="Makanan">Makanan</option>
                                <option value="Minuman">Minuman</option>
                                <option value="Camilan">Camilan</option>
                                <option value="Fast Food">Fast Food</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Jam Buka</label>
                            <input type="time" name="open_time" class="form-control" value="08:00">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Jam Tutup</label>
                            <input type="time" name="close_time" class="form-control" value="21:00">
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Alamat</label>
                            <input type="text" name="address" class="form-control" placeholder="Alamat lengkap">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Nomor HP</label>
                            <input type="text" name="phone" class="form-control" placeholder="08xx-xxxx-xxxx">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Min. Order (Rp)</label>
                            <input type="number" name="min_order" class="form-control" value="15000" min="0">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Est. Waktu (menit)</label>
                            <input type="number" name="delivery_time" class="form-control" value="30" min="5">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="2"
                                      placeholder="Deskripsi singkat restoran..."></textarea>
                        </div>
                        <div class="col-12">
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" checked id="rActive">
                                    <label class="form-check-label" for="rActive" style="font-size:.875rem">Aktif</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-jp-primary">
                                <i class="fas fa-plus me-1"></i> Tambah Restoran
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- List Restoran --}}
        <div class="jp-card">
            <div class="jp-card-body p-0">
                <div class="table-responsive">
                    <table class="jp-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Jam</th>
                                <th>Min. Order</th>
                                <th>Menu</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($restaurants as $r)
                                <tr>
                                    <td>
                                        <div class="fw-600">{{ $r->name }}</div>
                                        <div style="font-size:.75rem;color:var(--jp-gray-400)">{{ $r->address }}</div>
                                    </td>
                                    <td style="font-size:.875rem">{{ $r->category }}</td>
                                    <td style="font-size:.8rem;white-space:nowrap">
                                        {{ $r->open_time ? substr($r->open_time,0,5) : '—' }} –
                                        {{ $r->close_time ? substr($r->close_time,0,5) : '—' }}
                                    </td>
                                    <td style="font-size:.875rem">Rp {{ number_format($r->min_order,0,',','.') }}</td>
                                    <td>
                                        <a href="{{ route('admin.menus', $r->id) }}" class="btn btn-sm btn-jp-ghost">
                                            <i class="fas fa-list me-1"></i>{{ $r->menus_count }} menu
                                        </a>
                                    </td>
                                    <td>
                                        <i class="fas fa-star" style="color:#F59E0B;font-size:.75rem"></i>
                                        {{ number_format($r->rating, 1) }}
                                    </td>
                                    <td>
                                        <span class="jp-badge {{ $r->is_active ? 'jp-badge-completed' : 'jp-badge-cancelled' }}">
                                            {{ $r->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.menus', $r->id) }}"
                                               class="btn btn-sm btn-jp-primary" title="Kelola Menu">
                                                <i class="fas fa-utensils"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.restaurants.delete', $r->id) }}"
                                                  onsubmit="return confirm('Hapus restoran ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm"
                                                        style="background:#FEE2E2;color:#DC2626;border:none">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8">
                                    <div class="jp-empty">
                                        <div class="empty-icon"><i class="fas fa-utensils"></i></div>
                                        <p>Belum ada restoran</p>
                                    </div>
                                </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($restaurants->hasPages())
                <div style="padding:1rem 1.25rem;border-top:1px solid var(--jp-gray-200)">
                    {{ $restaurants->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

