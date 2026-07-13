@extends('layouts.app')

@section('title', 'Kelola Penumpang - Admin JAPLO')

@section('content')
<div class="hero-background" style="padding: 40px 0;">
    <div class="container hero-background-overlay">
        <h2 class="fw-bold text-white mb-2">
            <i class="fas fa-users me-2"></i> Kelola Penumpang
        </h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-white">Dashboard</a></li>
                <li class="breadcrumb-item active text-white">Penumpang</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="fw-bold mb-0">Daftar Penumpang</h5>
                </div>
                <div class="col-auto">
                    <span class="badge bg-primary px-3 py-2">Total: {{ $users->total() }}</span>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4">ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>Terdaftar</th>
                            <th>Total Orders</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="px-4 fw-bold">#{{ $user->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-circle fa-2x text-secondary me-2"></i>
                                    <div>
                                        <div class="fw-bold">{{ $user->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                <small class="text-secondary">{{ $user->created_at->format('d/m/Y H:i') }}</small><br>
                                <small class="text-secondary">{{ $user->created_at->diffForHumans() }}</small>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $user->orders->count() }} orders</span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary" onclick="alert('Detail user #{{ $user->id }}')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-secondary">
                                <i class="fas fa-users fa-3x mb-3 d-block"></i>
                                Belum ada penumpang terdaftar
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($users->hasPages())
        <div class="card-footer bg-white">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
