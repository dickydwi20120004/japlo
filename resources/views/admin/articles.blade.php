@extends('layouts.app')
@section('title', 'Kelola Artikel — Admin JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}">
@endpush

@section('content')
<div class="jp-admin-top">
    <div class="container">
        <h1><i class="fas fa-newspaper me-2"></i>Kelola Artikel / Trending</h1>
    </div>
</div>

<div class="page-body">
    <div class="container">

        {{-- Tambah Artikel --}}
        <div class="jp-card mb-4">
            <div class="jp-card-header">
                <span><i class="fas fa-plus me-2 text-jp-green"></i>Tulis Artikel Baru</span>
            </div>
            <div class="jp-card-body">
                <form method="POST" action="{{ route('admin.articles.store') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label">Judul Artikel <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" required
                                   placeholder="Judul artikel yang menarik...">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Kategori</label>
                            <select name="category" class="form-select">
                                <option value="Berita">Berita</option>
                                <option value="Tips">Tips</option>
                                <option value="Komunitas">Komunitas</option>
                                <option value="Promo">Promo</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="published">Publish</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Ringkasan</label>
                            <textarea name="excerpt" class="form-control" rows="2"
                                      placeholder="Ringkasan singkat artikel (maks 500 karakter)..."></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Isi Artikel <span class="text-danger">*</span></label>
                            <textarea name="content" class="form-control" rows="8" required
                                      placeholder="Tulis isi artikel di sini... Bisa menggunakan HTML sederhana seperti &lt;p&gt;, &lt;h3&gt;, &lt;ul&gt;, &lt;strong&gt;"></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-jp-primary">
                                <i class="fas fa-paper-plane me-1"></i> Simpan Artikel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- List Artikel --}}
        <div class="jp-card">
            <div class="jp-card-body p-0">
                <div class="table-responsive">
                    <table class="jp-table">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Views</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($articles as $article)
                                <tr>
                                    <td>
                                        <div class="fw-600" style="max-width:250px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                                            {{ $article->title }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="jp-badge jp-badge-accepted" style="font-size:.72rem">
                                            {{ $article->category ?? '—' }}
                                        </span>
                                    </td>
                                    <td style="font-size:.875rem">{{ $article->author->name ?? '—' }}</td>
                                    <td style="font-size:.875rem">{{ number_format($article->views) }}</td>
                                    <td>
                                        <span class="jp-badge {{ $article->status === 'published' ? 'jp-badge-completed' : 'jp-badge-pending' }}">
                                            {{ $article->status === 'published' ? 'Published' : 'Draft' }}
                                        </span>
                                    </td>
                                    <td style="font-size:.78rem;color:var(--jp-gray-400);white-space:nowrap">
                                        {{ $article->created_at->format('d M Y') }}
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('customer.trending.detail', $article->slug) }}"
                                               target="_blank" class="btn btn-sm btn-jp-ghost" title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.articles.delete', $article->id) }}"
                                                  onsubmit="return confirm('Hapus artikel ini?')">
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
                                <tr><td colspan="7">
                                    <div class="jp-empty"><div class="empty-icon"><i class="fas fa-newspaper"></i></div><p>Belum ada artikel</p></div>
                                </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($articles->hasPages())
                <div style="padding:1rem 1.25rem;border-top:1px solid var(--jp-gray-200)">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

