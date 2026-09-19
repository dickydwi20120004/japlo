@extends('layouts.app')
@section('title', 'Kelola Pengguna — Admin JAPLO')

@section('content')
<div style="background:linear-gradient(135deg,#15803D,#16A34A);padding:1.5rem 0 3rem;color:#fff">
    <div class="container">
        <h1 style="font-size:1.35rem;font-weight:700;margin:0">
            <i class="fas fa-users me-2"></i>Kelola Pengguna
        </h1>
        <p style="font-size:.85rem;color:rgba(255,255,255,.8);margin:.25rem 0 0">Total: {{ $users->total() }} customer terdaftar</p>
    </div>
</div>

<div style="margin-top:-2rem;position:relative;z-index:10;padding-bottom:2rem">
    <div class="container">

        {{-- Search --}}
        <div class="jp-card mb-4">
            <div class="jp-card-body">
                <form method="GET">
                    <div class="row g-2">
                        <div class="col-md-9">
                            <input type="text" name="search" class="form-control"
                                   placeholder="Cari nama atau email..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-jp-primary w-100">
                                <i class="fas fa-search me-1"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="jp-card">
            <div class="jp-card-body p-0">
                <div class="table-responsive">
                    <table class="jp-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Bergabung</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td style="color:var(--jp-gray-400);font-size:.8rem">{{ $user->id }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width:32px;height:32px;border-radius:50%;background:var(--jp-green-light);color:var(--jp-green);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.8rem;flex-shrink:0">
                                                {{ strtoupper(substr($user->name,0,1)) }}
                                            </div>
                                            <span class="fw-600">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td style="font-size:.875rem">{{ $user->email }}</td>
                                    <td style="font-size:.875rem">{{ $user->phone ?? '—' }}</td>
                                    <td style="font-size:.78rem;color:var(--jp-gray-400)">
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>
                                    <td>
                                        <a href="mailto:{{ $user->email }}" class="btn btn-sm btn-jp-ghost">
                                            <i class="fas fa-envelope"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6">
                                    <div class="jp-empty"><div class="empty-icon"><i class="fas fa-users"></i></div><p>Belum ada pengguna</p></div>
                                </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($users->hasPages())
                <div style="padding:1rem 1.25rem;border-top:1px solid var(--jp-gray-200)">
                    {{ $users->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
