@extends('layouts.app')
@section('title', 'Notifikasi — JAPLO')

@section('content')
<div style="background:linear-gradient(135deg,#15803D,#16A34A);padding:1.5rem 0 3rem;color:#fff">
    <div class="container">
        <h1 style="font-size:1.5rem;font-weight:700;margin:0">
            <i class="fas fa-bell me-2"></i>Notifikasi
        </h1>
    </div>
</div>

<div style="margin-top:-2rem;position:relative;z-index:10;padding-bottom:2rem">
    <div class="container">
        <div class="jp-card">
            <div class="jp-card-header">
                <span>Semua Notifikasi</span>
                @if($notifications->total() > 0)
                    <button onclick="fetch('{{ route('notifications.read.all') }}',{method:'POST',headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}}).then(()=>location.reload())"
                            class="btn btn-sm btn-jp-ghost">
                        Tandai semua dibaca
                    </button>
                @endif
            </div>
            <div class="jp-card-body p-0">
                @forelse($notifications as $notif)
                    <div style="display:flex;align-items:flex-start;gap:1rem;padding:1rem 1.25rem;border-bottom:1px solid var(--jp-gray-100);background:{{ $notif->read_at ? '#fff' : '#F0FDF4' }}">
                        <div style="width:40px;height:40px;border-radius:50%;background:var(--jp-green-light);display:flex;align-items:center;justify-content:center;color:var(--jp-green);flex-shrink:0;font-size:.9rem">
                            <i class="fas fa-bell"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div style="font-size:.875rem;font-weight:600;color:var(--jp-gray-900)">{{ $notif->title }}</div>
                            <div style="font-size:.8125rem;color:var(--jp-gray-500);margin-top:.2rem">{{ $notif->message }}</div>
                            <div style="font-size:.75rem;color:var(--jp-gray-400);margin-top:.35rem">
                                <i class="fas fa-clock me-1"></i>{{ $notif->created_at->diffForHumans() }}
                            </div>
                        </div>
                        @if(!$notif->read_at)
                            <span style="width:8px;height:8px;border-radius:50%;background:var(--jp-green);flex-shrink:0;margin-top:5px"></span>
                        @endif
                    </div>
                @empty
                    <div class="jp-empty">
                        <div class="empty-icon"><i class="fas fa-bell-slash"></i></div>
                        <p>Belum ada notifikasi</p>
                    </div>
                @endforelse
            </div>
            @if($notifications->hasPages())
                <div style="padding:1rem 1.25rem;border-top:1px solid var(--jp-gray-200)">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
