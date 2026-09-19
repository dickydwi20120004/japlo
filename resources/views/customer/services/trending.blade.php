@extends('layouts.app')
@section('title', 'Trending — JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/services.css') }}">
@endpush

@section('content')
<div class="jp-page-top">
    <div class="container">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ route('dashboard') }}" class="btn btn-sm"
               style="background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.3);color:#fff;border-radius:8px">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('images/icons/trending.svg') }}" width="40" height="40" alt="Trending">
            <div>
                <h1><i class="fas fa-fire me-2" style="color:#F97316"></i>Trending</h1>
                <p class="mb-0" style="font-size:.85rem;color:rgba(255,255,255,.8)">Artikel dan info terkini dari komunitas JAPLO</p>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container">

        {{-- Search & Category Filter --}}
        <div class="jp-card mb-4">
            <div class="jp-card-body">
                <form method="GET" action="{{ route('customer.trending') }}" class="mb-3">
                    <div class="row g-2">
                        <div class="col">
                            <input type="text" name="search" class="form-control"
                                   placeholder="Cari artikel..."
                                   value="{{ request('search') }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-jp-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

                {{-- Category Pills --}}
                <div class="category-filter">
                    <a href="{{ route('customer.trending') }}"
                       class="cat-btn {{ !request('category') ? 'active' : '' }}">
                        <i class="fas fa-fire"></i> Semua
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('customer.trending', ['category' => $cat]) }}"
                           class="cat-btn {{ request('category') == $cat ? 'active' : '' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Articles Grid --}}
        @if($articles->count() > 0)
            <div class="row g-3">
                @foreach($articles as $article)
                    <div class="col-6 col-md-4 col-lg-3">
                        <a href="{{ route('customer.trending.detail', $article->slug) }}" class="article-card">
                            @if($article->image)
                                <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="article-thumb">
                            @else
                                <div class="article-thumb-placeholder">
                                    <i class="fas fa-fire"></i>
                                </div>
                            @endif
                            <div class="article-body">
                                @if($article->category)
                                    <span class="article-category">{{ $article->category }}</span>
                                @endif
                                <div class="article-title">{{ $article->title }}</div>
                                @if($article->excerpt)
                                    <div class="article-excerpt">{{ $article->excerpt }}</div>
                                @endif
                                <div class="article-meta">
                                    <span>
                                        <i class="fas fa-eye me-1"></i>
                                        {{ number_format($article->views ?? 0) }}
                                    </span>
                                    <span>{{ $article->published_at?->diffForHumans() ?? $article->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $articles->withQueryString()->links() }}
            </div>

        @else
            <div class="jp-empty">
                <div class="empty-icon"><i class="fas fa-newspaper"></i></div>
                <p>Belum ada artikel tersedia</p>
                @if(request('search') || request('category'))
                    <a href="{{ route('customer.trending') }}" class="btn btn-jp-ghost btn-sm">
                        Reset Filter
                    </a>
                @endif
            </div>
        @endif

    </div>
</div>
@endsection

