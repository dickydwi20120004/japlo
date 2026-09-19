@extends('layouts.app')
@section('title', 'Kelola Produk — Admin JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}">
@endpush

@section('content')
<div class="jp-admin-top">
    <div class="container">
        <h1><i class="fas fa-bag-shopping me-2"></i>Kelola Produk</h1>
    </div>
</div>

<div class="page-body">
    <div class="container">

        {{-- Tambah Produk --}}
        <div class="jp-card mb-4">
            <div class="jp-card-header">
                <span><i class="fas fa-plus me-2 text-jp-green"></i>Tambah Produk Baru</span>
            </div>
            <div class="jp-card-body">
                <form method="POST" action="{{ route('admin.products.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required placeholder="Nama produk">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Kategori</label>
                            <select name="category" class="form-select">
                                <option value="Elektronik">Elektronik</option>
                                <option value="Fashion">Fashion</option>
                                <option value="Rumah Tangga">Rumah Tangga</option>
                                <option value="Sembako">Sembako</option>
                                <option value="Kesehatan">Kesehatan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control" required min="0" step="500">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Harga Coret (Rp)</label>
                            <input type="number" name="original_price" class="form-control" min="0" step="500">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Stok <span class="text-danger">*</span></label>
                            <input type="number" name="stock" class="form-control" required min="0" value="10">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Berat (gram)</label>
                            <input type="number" name="weight" class="form-control" min="0" placeholder="500">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="2"
                                      placeholder="Deskripsi produk..."></textarea>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" value="1" checked id="prodActive">
                                <label class="form-check-label" for="prodActive" style="font-size:.875rem">Aktifkan produk</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-jp-primary">
                                <i class="fas fa-plus me-1"></i> Tambah Produk
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Filter --}}
        <div class="jp-card mb-4">
            <div class="jp-card-body">
                <form method="GET">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <select name="category" class="form-select">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected':'' }}>
                                        {{ $cat }}
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

        {{-- List Produk --}}
        <div class="jp-card">
            <div class="jp-card-body p-0">
                <div class="table-responsive">
                    <table class="jp-table">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Terjual</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>
                                        <div class="fw-600">{{ $product->name }}</div>
                                        <div style="font-size:.75rem;color:var(--jp-gray-400)">
                                            {{ Str::limit($product->description, 50) }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="jp-badge jp-badge-accepted" style="font-size:.72rem">
                                            {{ $product->category }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-600">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                                        @if($product->original_price && $product->original_price > $product->price)
                                            <div style="font-size:.75rem;color:var(--jp-gray-400);text-decoration:line-through">
                                                Rp {{ number_format($product->original_price, 0, ',', '.') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="{{ $product->stock < 5 ? 'text-danger fw-700' : '' }}">
                                            {{ $product->stock }}
                                        </span>
                                    </td>
                                    <td style="font-size:.875rem">{{ $product->sold_count }}</td>
                                    <td>
                                        <span class="jp-badge {{ $product->is_active ? 'jp-badge-completed' : 'jp-badge-cancelled' }}">
                                            {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.products.delete', $product->id) }}"
                                              onsubmit="return confirm('Hapus produk ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm"
                                                    style="background:#FEE2E2;color:#DC2626;border:none">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7">
                                    <div class="jp-empty">
                                        <div class="empty-icon"><i class="fas fa-bag-shopping"></i></div>
                                        <p>Belum ada produk</p>
                                    </div>
                                </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($products->hasPages())
                <div style="padding:1rem 1.25rem;border-top:1px solid var(--jp-gray-200)">
                    {{ $products->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

