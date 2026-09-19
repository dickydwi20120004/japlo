@extends('layouts.app')
@section('title', $article->title . ' — JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/services.css') }}">
@endpush

@section('content')
<div class="jp-page-top">
    <div class="container">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('customer.trending') }}" class="btn btn-sm btn-jp-ghost"
               style="background:rgba(255,255,255,.15);border-color:rgba(255,255,255,.3);color:#fff">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <span class="category-badge" style="background:rgba(255,255,255,.2);color:#fff;margin-bottom:.75rem;display:inline-flex">
            <i class="fas fa-fire me-1"></i> {{ $article->category ?? 'Trending' }}
        </span>
        <h1>{{ $article->title }}</h1>
        <div class="d-flex flex-wrap gap-3 mt-2 article-meta">
            <span><i class="fas fa-user"></i> {{ $article->author->name ?? 'Redaksi JAPLO' }}</span>
            <span><i class="fas fa-calendar"></i> {{ $article->published_at?->format('d M Y') ?? $article->created_at->format('d M Y') }}</span>
            <span><i class="fas fa-eye"></i> {{ number_format($article->views ?? 0) }} tayang</span>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container">
        <div class="row g-4">
            {{-- Main Content --}}
            <div class="col-lg-8">
                <div class="jp-card overflow-hidden mb-4">
                    {{-- Thumbnail --}}
                    @if($article->image)
                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="article-thumbnail">
                    @else
                        <div class="article-thumb-placeholder">
                            <i class="fas fa-fire" style="color:var(--jp-green)"></i>
                        </div>
                    @endif

                    <div class="jp-card-body">
                        {{-- Excerpt --}}
                        @if($article->excerpt)
                            <div style="background:var(--jp-gray-50);border-left:4px solid var(--jp-green);border-radius:0 8px 8px 0;padding:.85rem 1rem;margin-bottom:1.5rem;font-size:.9rem;color:var(--jp-gray-600);font-style:italic;line-height:1.6">
                                {{ $article->excerpt }}
                            </div>
                        @endif

                        {{-- Article Body --}}
                        <div class="article-content">
                            {!! $article->content !!}
                        </div>

                        {{-- Tags / Share --}}
                        <hr style="border-color:var(--jp-gray-200);margin:1.5rem 0">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                            <div class="d-flex align-items-center gap-2">
                                @if($article->category)
                                    <span class="category-badge">{{ $article->category }}</span>
                                @endif
                            </div>
                            <div class="d-flex gap-2">
                                <span style="font-size:.8rem;color:var(--jp-gray-400)">Bagikan:</span>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' — ' . url()->current()) }}"
                                   target="_blank" class="btn btn-sm btn-jp-ghost" title="WhatsApp">
                                    <i class="fab fa-whatsapp" style="color:#25D366"></i>
                                </a>
                                <button onclick="navigator.clipboard.writeText('{{ url()->current() }}').then(()=>JapToast.success('Link disalin!'))"
                                        class="btn btn-sm btn-jp-ghost" title="Salin link">
                                    <i class="fas fa-link"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                {{-- Author Card --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-user-pen me-2 text-jp-green"></i>Penulis</span>
                    </div>
                    <div class="jp-card-body d-flex align-items-center gap-3">
                        <div style="width:48px;height:48px;border-radius:50%;background:var(--jp-green-light);display:flex;align-items:center;justify-content:center;font-size:1.2rem;font-weight:700;color:var(--jp-green);flex-shrink:0">
                            {{ strtoupper(substr($article->author->name ?? 'R', 0, 1)) }}
                        </div>
                        <div>
                            <div class="fw-600" style="font-size:.875rem">{{ $article->author->name ?? 'Redaksi JAPLO' }}</div>
                            <div style="font-size:.78rem;color:var(--jp-gray-400)">
                                {{ $article->published_at?->format('d F Y') ?? $article->created_at->format('d F Y') }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Related Articles --}}
                @if($related->count() > 0)
                    <div class="jp-card">
                        <div class="jp-card-header">
                            <span><i class="fas fa-newspaper me-2 text-jp-green"></i>Artikel Terkait</span>
                        </div>
                        <div class="jp-card-body p-2">
                            @foreach($related as $rel)
                                <a href="{{ route('customer.trending.detail', $rel->slug) }}" class="related-card">
                                    <div class="rel-thumb">
                                        @if($rel->image)
                                            <img src="{{ $rel->image_url }}" alt="{{ $rel->title }}">
                                        @else
                                            <i class="fas fa-fire" style="color:var(--jp-green)"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="rel-title">{{ $rel->title }}</div>
                                        <div class="rel-meta">
                                            <i class="fas fa-eye me-1"></i>{{ number_format($rel->views ?? 0) }}
                                            &nbsp;·&nbsp;
                                            {{ $rel->published_at?->diffForHumans() ?? $rel->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

