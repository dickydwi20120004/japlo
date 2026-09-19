@extends('layouts.app')
@section('title', 'Iklan & Promosi — JAPLO')

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
            <img src="{{ asset('images/icons/promosi.svg') }}" width="40" height="40" alt="Promosi">
            <div>
                <h1><i class="fas fa-tag me-2" style="color:#F59E0B"></i>Promo & Penawaran</h1>
                <p class="mb-0" style="font-size:.85rem;color:rgba(255,255,255,.8)">
                    {{ $promos->count() }} promo aktif tersedia untuk Anda
                </p>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container">

        @if($promos->count() > 0)
            <div class="row g-3">
                @foreach($promos as $promo)
                    <div class="col-md-6 col-lg-4">
                        <div class="promo-card">

                            {{-- Banner Image --}}
                            @if($promo->image)
                                <img src="{{ $promo->image_url }}" alt="{{ $promo->title }}" class="promo-banner">
                            @else
                                @php
                                    $placeholderBg = match($promo->type ?? 'info') {
                                        'discount'       => 'linear-gradient(135deg,#FEF3C7,#FCD34D)',
                                        'cashback'       => 'linear-gradient(135deg,#DBEAFE,#93C5FD)',
                                        'free_delivery'  => 'linear-gradient(135deg,#DCFCE7,#6EE7B7)',
                                        default          => 'linear-gradient(135deg,#F3F4F6,#E5E7EB)',
                                    };
                                    $placeholderIcon = match($promo->type ?? 'info') {
                                        'discount'       => '🏷️',
                                        'cashback'       => '💰',
                                        'free_delivery'  => '🛵',
                                        default          => '📢',
                                    };
                                @endphp
                                <div class="promo-banner-placeholder" style="background:{{ $placeholderBg }}">
                                    {{ $placeholderIcon }}
                                </div>
                            @endif

                            <div style="padding:.85rem">
                                {{-- Type Badge --}}
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <span class="jp-badge promo-type-{{ $promo->type ?? 'info' }}"
                                          style="font-size:.72rem">
                                        {{ match($promo->type ?? 'info') {
                                            'discount'       => '💸 Diskon',
                                            'cashback'       => '💰 Cashback',
                                            'free_delivery'  => '🛵 Gratis Ongkir',
                                            default          => '📢 Info',
                                        } }}
                                    </span>
                                    @if($promo->end_date)
                                        <span style="font-size:.72rem;color:var(--jp-gray-400)">
                                            <i class="fas fa-clock me-1"></i>
                                            Hingga {{ $promo->end_date->format('d M Y') }}
                                        </span>
                                    @endif
                                </div>

                                {{-- Title --}}
                                <div style="font-weight:700;font-size:.9rem;margin:.4rem 0 .3rem;line-height:1.35">
                                    {{ $promo->title }}
                                </div>

                                {{-- Description --}}
                                @if($promo->description)
                                    <p style="font-size:.78rem;color:var(--jp-gray-500);margin-bottom:.65rem;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden">
                                        {{ $promo->description }}
                                    </p>
                                @endif

                                {{-- Discount Value --}}
                                @if($promo->discount_value)
                                    <div style="font-size:.9rem;font-weight:700;color:var(--jp-green);margin-bottom:.5rem">
                                        @if($promo->discount_type === 'percent')
                                            Hemat {{ number_format($promo->discount_value, 0) }}%
                                        @else
                                            Hemat Rp {{ number_format($promo->discount_value, 0, ',', '.') }}
                                        @endif
                                        @if($promo->min_purchase)
                                            <span style="font-size:.72rem;color:var(--jp-gray-400);font-weight:400">
                                                · Min. Rp {{ number_format($promo->min_purchase, 0, ',', '.') }}
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                {{-- Promo Code --}}
                                @if($promo->promo_code)
                                    <div class="promo-code-box mb-2"
                                         onclick="copyCode('{{ $promo->promo_code }}')">
                                        <i class="fas fa-copy" style="color:var(--jp-green);font-size:.8rem"></i>
                                        <span class="promo-code-text">{{ $promo->promo_code }}</span>
                                        <span style="font-size:.72rem;color:var(--jp-green);font-weight:600">Salin</span>
                                    </div>
                                @endif

                                {{-- Quota --}}
                                @if($promo->quota)
                                    @php
                                        $used = $promo->used_count ?? 0;
                                        $remaining = max(0, $promo->quota - $used);
                                        $pct = min(100, ($used / $promo->quota) * 100);
                                        $fillClass = $pct >= 80 ? 'danger' : ($pct >= 50 ? 'warning' : '');
                                    @endphp
                                    <div>
                                        <div class="d-flex justify-content-between" style="font-size:.72rem;color:var(--jp-gray-400)">
                                            <span>Sisa kuota</span>
                                            <span>{{ $remaining }} / {{ $promo->quota }}</span>
                                        </div>
                                        <div class="quota-bar">
                                            <div class="quota-fill {{ $fillClass }}" style="width:{{ $pct }}%"></div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if(method_exists($promos, 'links'))
                <div class="mt-4">{{ $promos->links() }}</div>
            @endif

        @else
            <div class="jp-empty" style="padding:5rem 1rem">
                <div class="empty-icon">🏷️</div>
                <p>Belum ada promo aktif saat ini</p>
                <p style="font-size:.8rem;color:var(--jp-gray-400)">Pantau terus halaman ini untuk penawaran terbaru!</p>
            </div>
        @endif

    </div>
</div>
@endsection

@push('scripts')
<script>
function copyCode(code) {
    navigator.clipboard?.writeText(code).then(() => {
        JapToast.success('Kode promo <strong>' + code + '</strong> disalin!');
    }).catch(() => {
        // fallback
        const el = document.createElement('textarea');
        el.value = code;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        JapToast.success('Kode promo ' + code + ' disalin!');
    });
}
</script>
@endpush

