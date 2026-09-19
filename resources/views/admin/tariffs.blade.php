@extends('layouts.app')
@section('title', 'Kelola Tarif — Admin JAPLO')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard-admin.css') }}">
@endpush

@section('content')
<div class="jp-admin-top">
    <div class="container">
        <h1><i class="fas fa-coins me-2"></i>Kelola Tarif Layanan</h1>
        <p style="font-size:.85rem;color:rgba(255,255,255,.8);margin:.25rem 0 0">
            Atur tarif semua layanan dari sini
        </p>
    </div>
</div>

<div class="page-body">
    <div class="container">
        <div class="row g-3">
            @forelse($tariffs as $tariff)
                <div class="col-md-6 col-lg-4">
                    <div class="jp-card h-100">
                        <div class="jp-card-header">
                            <span class="fw-700">{{ $tariff->label }}</span>
                            <span class="jp-badge {{ $tariff->is_active ? 'jp-badge-completed' : 'jp-badge-cancelled' }}">
                                {{ $tariff->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                        <div class="jp-card-body">
                            <div style="font-size:.8375rem;color:var(--jp-gray-600);line-height:2">
                                <div>Biaya Dasar: <strong>Rp {{ number_format($tariff->base_fare, 0, ',', '.') }}</strong></div>
                                <div>Per KM: <strong>Rp {{ number_format($tariff->per_km, 0, ',', '.') }}</strong></div>
                                <div>Minimum: <strong>Rp {{ number_format($tariff->minimum_fare, 0, ',', '.') }}</strong></div>
                                <div>Biaya Platform: <strong>Rp {{ number_format($tariff->platform_fee, 0, ',', '.') }}</strong></div>
                            </div>

                            <form method="POST" action="{{ route('admin.tariffs.update', $tariff->id) }}" class="mt-3">
                                @csrf @method('PUT')
                                <div class="row g-2 mb-2">
                                    <div class="col-6">
                                        <label class="form-label" style="font-size:.75rem">Biaya Dasar</label>
                                        <input type="number" name="base_fare" class="form-control form-control-sm"
                                               value="{{ $tariff->base_fare }}" min="0" step="500">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label" style="font-size:.75rem">Per KM</label>
                                        <input type="number" name="per_km" class="form-control form-control-sm"
                                               value="{{ $tariff->per_km }}" min="0" step="500">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label" style="font-size:.75rem">Minimum</label>
                                        <input type="number" name="minimum_fare" class="form-control form-control-sm"
                                               value="{{ $tariff->minimum_fare }}" min="0" step="500">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label" style="font-size:.75rem">Platform Fee</label>
                                        <input type="number" name="platform_fee" class="form-control form-control-sm"
                                               value="{{ $tariff->platform_fee }}" min="0" step="500">
                                    </div>
                                </div>
                                <input type="hidden" name="label" value="{{ $tariff->label }}">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                           id="active_{{ $tariff->id }}" {{ $tariff->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="active_{{ $tariff->id }}" style="font-size:.8rem">
                                        Aktifkan tarif ini
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-jp-primary btn-sm w-100">
                                    <i class="fas fa-save me-1"></i> Simpan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="jp-empty">
                        <div class="empty-icon"><i class="fas fa-coins"></i></div>
                        <p>Belum ada tarif</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

