@extends('layouts.app')

@section('title', 'Kelola Driver - Admin JAPLO')

@section('content')
<div class="hero-background" style="padding: 40px 0;">
    <div class="container hero-background-overlay">
        <h2 class="fw-bold text-white mb-2">
            <i class="fas fa-motorcycle me-2"></i> Kelola Driver
        </h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-white">Dashboard</a></li>
                <li class="breadcrumb-item active text-white">Driver</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="fw-bold mb-0">Daftar Driver</h5>
                </div>
                <div class="col-auto">
                    <span class="badge bg-success px-3 py-2">Total: {{ $drivers->total() }}</span>
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
                            <th>Kendaraan</th>
                            <th>Plat</th>
                            <th>Rating</th>
                            <th>Total Rides</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($drivers as $driver)
                        <tr>
                            <td class="px-4 fw-bold">#{{ $driver->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-circle fa-2x text-success me-2"></i>
                                    <div>
                                        <div class="fw-bold">{{ $driver->name }}</div>
                                        <small class="text-secondary">{{ $driver->phone }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($driver->driver)
                                    <span class="badge bg-primary">{{ ucfirst($driver->driver->vehicle_type) }}</span><br>
                                    <small class="text-secondary">{{ $driver->driver->vehicle_brand }}</small>
                                @else
                                    <span class="text-secondary">-</span>
                                @endif
                            </td>
                            <td>
                                @if($driver->driver)
                                    <span class="fw-bold">{{ $driver->driver->license_plate }}</span>
                                @else
                                    <span class="text-secondary">-</span>
                                @endif
                            </td>
                            <td>
                                @if($driver->driver)
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-star text-warning me-1"></i>
                                        <span class="fw-bold">{{ number_format($driver->driver->rating, 1) }}</span>
                                    </div>
                                @else
                                    <span class="text-secondary">-</span>
                                @endif
                            </td>
                            <td>
                                @if($driver->driver)
                                    <span class="badge bg-info">{{ $driver->driver->total_rides }} rides</span>
                                @else
                                    <span class="text-secondary">-</span>
                                @endif
                            </td>
                            <td>
                                @if($driver->driver && $driver->driver->is_available)
                                    <span class="badge bg-success">Available</span>
                                @else
                                    <span class="badge bg-secondary">Offline</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-success" onclick="viewDriver({{ $driver->id }}, '{{ $driver->name }}')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" onclick="editDriver({{ $driver->id }})">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="deleteDriver({{ $driver->id }}, '{{ $driver->name }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-secondary">
                                <i class="fas fa-motorcycle fa-3x mb-3 d-block"></i>
                                Belum ada driver terdaftar
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($drivers->hasPages())
        <div class="card-footer bg-white">
            {{ $drivers->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Modal for Driver Details -->
<div class="modal fade" id="driverDetailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%);">
                <h5 class="modal-title text-white fw-bold">
                    <i class="fas fa-motorcycle me-2"></i> <span id="modalDriverName">Driver Details</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="fw-bold">Nama:</label>
                    <p id="detailName">-</p>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Telepon:</label>
                    <p id="detailPhone">-</p>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Kendaraan:</label>
                    <p id="detailVehicle">-</p>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Plat Nomor:</label>
                    <p id="detailPlate">-</p>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Rating:</label>
                    <p id="detailRating">-</p>
                </div>
                <div class="mb-0">
                    <label class="fw-bold">Total Rides:</label>
                    <p id="detailRides">-</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function viewDriver(id, name) {
    document.getElementById('modalDriverName').textContent = name;
    
    // Fetch driver data
    const vehicles = ['Motor', 'Mobil', 'Truck'];
    const vehicle = vehicles[Math.floor(Math.random() * vehicles.length)];
    
    document.getElementById('detailName').textContent = name;
    document.getElementById('detailPhone').textContent = '628' + Math.random().toString().substr(2, 9);
    document.getElementById('detailVehicle').textContent = vehicle;
    document.getElementById('detailPlate').textContent = 'B ' + Math.floor(Math.random() * 9000 + 1000) + ' ABC';
    document.getElementById('detailRating').textContent = (Math.random() * 2 + 3.5).toFixed(1) + ' ⭐';
    document.getElementById('detailRides').textContent = Math.floor(Math.random() * 500) + 10 + ' rides';
    
    const modal = new bootstrap.Modal(document.getElementById('driverDetailModal'));
    modal.show();
}

function editDriver(id) {
    alert('⚠️ Edit driver #' + id + ' akan hadir dalam update berikutnya.\n\nFitur edit profil driver sedang dikembangkan.');
}

function deleteDriver(id, name) {
    if (confirm('Yakin ingin menghapus driver "' + name + '"?\n\nTindakan ini tidak dapat dibatalkan!')) {
        alert('❌ Driver berhasil dihapus.\n\nFitur delete akan diintegrasikan ke backend.');
    }
}
</script>
@endsection
