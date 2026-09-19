@extends('layouts.app')
@section('title', 'Menu — ' . $restaurant->name . ' — Admin JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}">
@endpush

@section('content')
<div class="jp-admin-top">
    <div class="container">
        <div class="mb-2">
            <a href="{{ route('admin.restaurants') }}" class="btn btn-sm"
               style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;border-radius:8px">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Restoran
            </a>
        </div>
        <h1><i class="fas fa-bowl-food me-2"></i>Menu — {{ $restaurant->name }}</h1>
        <p style="font-size:.85rem;color:rgba(255,255,255,.8);margin:.25rem 0 0">
            {{ $restaurant->menus->count() }} item menu
        </p>
    </div>
</div>

<div class="page-body">
    <div class="container">
        <div class="row g-4">

            {{-- Tambah Menu --}}
            <div class="col-lg-4">
                <div class="jp-card">
                    <div class="jp-card-header">
                        <span><i class="fas fa-plus me-2 text-jp-green"></i>Tambah Menu</span>
                    </div>
                    <div class="jp-card-body">
                        <form method="POST" action="{{ route('admin.menus.store') }}">
                            @csrf
                            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                            <div class="mb-3">
                                <label class="form-label">Nama Menu <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" required placeholder="Nama makanan/minuman">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                                <input type="number" name="price" class="form-control" required min="0" step="500">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="category" class="form-select">
                                    <option value="Makanan">Makanan</option>
                                    <option value="Minuman">Minuman</option>
                                    <option value="Dessert">Dessert</option>
                                    <option value="Snack">Snack</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="2"
                                          placeholder="Deskripsi singkat..."></textarea>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="is_available" value="1"
                                       checked id="menuAvail">
                                <label class="form-check-label" for="menuAvail" style="font-size:.875rem">
                                    Tersedia
                                </label>
                            </div>
                            <button type="submit" class="btn btn-jp-primary w-100">
                                <i class="fas fa-plus me-1"></i> Tambah Menu
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- List Menu --}}
            <div class="col-lg-8">
                <div class="jp-card">
                    <div class="jp-card-body p-0">
                        <div class="table-responsive">
                            <table class="jp-table">
                                <thead>
                                    <tr>
                                        <th>Nama Menu</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($restaurant->menus->sortBy('category') as $menu)
                                        <tr>
                                            <td>
                                                <div class="fw-600">{{ $menu->name }}</div>
                                                <div style="font-size:.75rem;color:var(--jp-gray-400)">
                                                    {{ Str::limit($menu->description, 50) }}
                                                </div>
                                            </td>
                                            <td>
                                                <span class="jp-badge jp-badge-accepted" style="font-size:.72rem">
                                                    {{ $menu->category }}
                                                </span>
                                            </td>
                                            <td class="fw-600">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                                            <td>
                                                <span class="jp-badge {{ $menu->is_available ? 'jp-badge-completed' : 'jp-badge-cancelled' }}">
                                                    {{ $menu->is_available ? 'Tersedia' : 'Habis' }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    {{-- Toggle Availability --}}
                                                    <form method="POST" action="{{ route('admin.menus.update', $menu->id) }}">
                                                        @csrf @method('PUT')
                                                        <input type="hidden" name="name" value="{{ $menu->name }}">
                                                        <input type="hidden" name="description" value="{{ $menu->description }}">
                                                        <input type="hidden" name="price" value="{{ $menu->price }}">
                                                        <input type="hidden" name="category" value="{{ $menu->category }}">
                                                        <input type="hidden" name="is_available" value="{{ $menu->is_available ? '0' : '1' }}">
                                                        <button type="submit" class="btn btn-sm btn-jp-ghost"
                                                                title="{{ $menu->is_available ? 'Set Habis' : 'Set Tersedia' }}">
                                                            <i class="fas fa-{{ $menu->is_available ? 'eye-slash' : 'eye' }}"></i>
                                                        </button>
                                                    </form>
                                                    <form method="POST" action="{{ route('admin.menus.delete', $menu->id) }}"
                                                          onsubmit="return confirm('Hapus menu ini?')">
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
                                        <tr><td colspan="5">
                                            <div class="jp-empty" style="padding:2rem">
                                                <div class="empty-icon"><i class="fas fa-bowl-food"></i></div>
                                                <p>Belum ada menu</p>
                                            </div>
                                        </td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

