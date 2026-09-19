@extends('layouts.app')
@section('title', 'Komunitas Sosial — JAPLO')

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
            <img src="{{ asset('images/icons/sosial.svg') }}" width="40" height="40" alt="Sosial">
            <div>
                <h1><i class="fas fa-people-group me-2" style="color:rgba(255,255,255,.8)"></i>Komunitas Sosial</h1>
                <p class="mb-0" style="font-size:.85rem;color:rgba(255,255,255,.8)">Berbagi cerita dan informasi dengan komunitas JAPLO</p>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container">
        <div class="row g-4">

            {{-- Feed --}}
            <div class="col-lg-8">

                {{-- Create Post Card --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="post-avatar" style="background:var(--jp-green)">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="fw-600" style="font-size:.875rem">{{ auth()->user()->name }}</div>
                        </div>

                        <form action="{{ route('customer.sosial.post') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="compose-area mb-3">
                                <textarea name="content" class="form-control @error('content') is-invalid @enderror"
                                          rows="3"
                                          placeholder="Apa yang ingin Anda bagikan hari ini?">{{ old('content') }}</textarea>
                                @error('content')<div class="invalid-feedback" style="padding:.35rem .75rem">{{ $message }}</div>@enderror
                                <div style="padding:.5rem .75rem;display:flex;align-items:center;justify-content:between;gap:.5rem">
                                    <label style="display:flex;align-items:center;gap:.5rem;cursor:pointer;font-size:.8125rem;color:var(--jp-gray-500);font-weight:500;padding:.25rem .5rem;border-radius:8px;transition:background .15s">
                                        <i class="fas fa-image" style="color:var(--jp-green)"></i>
                                        <span>Tambah Foto</span>
                                        <input type="file" name="image" accept="image/*" style="display:none"
                                               onchange="previewImage(this)">
                                    </label>
                                </div>
                            </div>

                            {{-- Image Preview --}}
                            <div id="imagePreview" style="display:none;margin-bottom:.75rem">
                                <div style="position:relative;display:inline-block">
                                    <img id="previewImg" style="max-height:200px;border-radius:10px;object-fit:cover">
                                    <button type="button" onclick="clearImage()"
                                            style="position:absolute;top:6px;right:6px;width:24px;height:24px;border-radius:50%;background:rgba(0,0,0,.6);border:none;color:#fff;font-size:.7rem;cursor:pointer;display:flex;align-items:center;justify-content:center">
                                        ✕
                                    </button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-jp-primary">
                                    <i class="fas fa-paper-plane me-2"></i> Posting
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Posts Feed --}}
                @if($posts->count() > 0)
                    @foreach($posts as $post)
                        <div class="post-card">
                            <div class="post-card-header">
                                <div class="post-avatar" style="background: hsl({{ (ord($post->user->name[0] ?? 'A') * 13) % 360 }}, 60%, 45%)">
                                    {{ strtoupper(substr($post->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <div>
                                    <div class="post-meta-name">{{ $post->user->name ?? 'Pengguna' }}</div>
                                    <div class="post-meta-time">{{ $post->created_at->diffForHumans() }}</div>
                                </div>
                                @if($post->category)
                                    <span class="ms-auto jp-badge" style="background:var(--jp-green-light);color:var(--jp-green);font-size:.72rem">
                                        {{ $post->category }}
                                    </span>
                                @endif
                            </div>

                            <div class="post-content">{{ $post->content }}</div>

                            @if($post->image)
                                <img src="{{ $post->image_url }}" alt="Post image" class="post-image">
                            @endif

                            <div class="post-actions">
                                <button class="post-action-btn">
                                    <i class="fas fa-heart"></i>
                                    {{ $post->likes_count > 0 ? number_format($post->likes_count) . ' Suka' : 'Suka' }}
                                </button>
                                <button class="post-action-btn">
                                    <i class="fas fa-comment"></i>
                                    {{ $post->comments_count > 0 ? $post->comments_count . ' Komentar' : 'Komentar' }}
                                </button>
                                <button class="post-action-btn ms-auto"
                                        onclick="navigator.clipboard?.writeText(window.location.href).then(()=>JapToast.success('Link disalin!'))">
                                    <i class="fas fa-share"></i> Bagikan
                                </button>
                            </div>
                        </div>
                    @endforeach

                    {{-- Pagination --}}
                    <div class="mt-2">
                        {{ $posts->links() }}
                    </div>

                @else
                    <div class="jp-empty">
                        <div class="empty-icon"><i class="fas fa-people-group"></i></div>
                        <p>Belum ada postingan. Jadilah yang pertama!</p>
                    </div>
                @endif

            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                {{-- Community Info --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-circle-info me-2 text-jp-green"></i>Tentang Komunitas</span>
                    </div>
                    <div class="jp-card-body">
                        <p style="font-size:.875rem;color:var(--jp-gray-600);line-height:1.7;margin:0">
                            Forum sosial JAPLO adalah tempat berbagi pengalaman, informasi, dan cerita positif bagi seluruh pengguna di Bintan. Yuk ikut berpartisipasi!
                        </p>
                    </div>
                </div>

                {{-- Rules --}}
                <div class="jp-card">
                    <div class="jp-card-header">
                        <span><i class="fas fa-shield-halved me-2 text-jp-green"></i>Panduan Komunitas</span>
                    </div>
                    <div class="jp-card-body">
                        @php
                            $rules = [
                                'Bersikap sopan dan saling menghormati',
                                'Tidak menyebarkan hoaks atau informasi palsu',
                                'Dilarang konten SARA dan kekerasan',
                                'Promosi usaha boleh di kategori "Promosi"',
                                'Laporkan konten yang melanggar aturan',
                            ];
                        @endphp
                        <ul style="list-style:none;padding:0;margin:0">
                            @foreach($rules as $rule)
                                <li style="display:flex;align-items:flex-start;gap:.5rem;padding:.35rem 0;font-size:.8125rem;color:var(--jp-gray-600);border-bottom:1px solid var(--jp-gray-100)">
                                    <i class="fas fa-check" style="color:var(--jp-green);margin-top:3px;font-size:.7rem;flex-shrink:0"></i>
                                    {{ $rule }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('imagePreview').style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function clearImage() {
    document.getElementById('imagePreview').style.display = 'none';
    document.getElementById('previewImg').src = '';
    document.querySelector('input[name="image"]').value = '';
}
</script>
@endpush

