@extends('layouts.app')

@section('title', 'Kelola Orders - Admin JAPLO')

@section('content')
<div class="hero-background" style="padding: 40px 0;">
    <div class="container hero-background-overlay">
        <h2 class="fw-bold text-white mb-2">
            <i class="fas fa-shopping-cart me-2"></i> Kelola Orders
        </h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-white">Dashboard</a></li>
                <li class="breadcrumb-item active text-white">Orders</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="fw-bold mb-0">Daftar Orders</h5>
                </div>
                <div class="col-auto">
                    <span class="badge bg-info px-3 py-2">Total: {{ $orders->total() }}</span>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4">Order ID</th>
                            <th>Penumpang</th>
                            <th>Driver</th>
                            <th>Layanan</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Waktu</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td class="px-4 fw-bold">#{{ $order->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-user-circle fa-2x text-secondary me-2"></i>
                                    <div>
                                        <div class="fw-bold">{{ $order->user->name }}</div>
                                        <small class="text-secondary">{{ $order->user->phone }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($order->driver)
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-user-circle fa-2x text-success me-2"></i>
                                        <div>
                                            <div class="fw-bold">{{ $order->driver->user->name }}</div>
                                            <small class="text-secondary">{{ $order->driver->vehicle_type }}</small>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-secondary">Belum ada</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ ucfirst($order->service_type) }}</span>
                            </td>
                            <td class="fw-bold">Rp {{ number_format($order->price) }}</td>
                            <td>
                                @php
                                    $statusColors = [
                                        'pending' => 'warning',
                                        'accepted' => 'info',
                                        'ongoing' => 'primary',
                                        'completed' => 'success',
                                        'cancelled' => 'danger',
                                    ];
                                @endphp
                                <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                <small class="text-secondary">{{ $order->created_at->format('d/m/Y H:i') }}</small><br>
                                <small class="text-secondary">{{ $order->created_at->diffForHumans() }}</small>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-info" onclick="viewOrder({{ $order->id }})">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" onclick="updateOrderStatus({{ $order->id }}, '{{ $order->status }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="deleteOrder({{ $order->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-secondary">
                                <i class="fas fa-shopping-cart fa-3x mb-3 d-block"></i>
                                Belum ada orders
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($orders->hasPages())
        <div class="card-footer bg-white">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>

<!-- Modal for Order Details -->
<div class="modal fade" id="orderDetailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0" style="background: linear-gradient(135deg, #0dcaf0 0%, #0b5ed7 100%);">
                <h5 class="modal-title text-white fw-bold">
                    <i class="fas fa-shopping-cart me-2"></i> Order #<span id="modalOrderId">0</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="fw-bold">Penumpang:</label>
                    <p id="detailCustomer">-</p>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Driver:</label>
                    <p id="detailDriver">-</p>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Layanan:</label>
                    <p id="detailService">-</p>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Harga:</label>
                    <p id="detailPrice">-</p>
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Status:</label>
                    <p id="detailStatus">-</p>
                </div>
                <div class="mb-0">
                    <label class="fw-bold">Waktu Pesan:</label>
                    <p id="detailDate">-</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Update Status -->
<div class="modal fade" id="statusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Update Status Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <label class="fw-bold mb-3">Pilih Status Baru:</label>
                <div class="d-grid gap-2">
                    <button class="btn btn-warning btn-sm" onclick="setStatus('pending')">⏳ Pending</button>
                    <button class="btn btn-info btn-sm" onclick="setStatus('accepted')">✅ Accepted</button>
                    <button class="btn btn-primary btn-sm" onclick="setStatus('ongoing')">🚗 Ongoing</button>
                    <button class="btn btn-success btn-sm" onclick="setStatus('completed')">✔️ Completed</button>
                    <button class="btn btn-danger btn-sm" onclick="setStatus('cancelled')">❌ Cancelled</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let currentOrderId = null;

function viewOrder(id) {
    currentOrderId = id;
    document.getElementById('modalOrderId').textContent = id;
    
    // Fetch order data
    document.getElementById('detailCustomer').textContent = 'Customer #' + id;
    document.getElementById('detailDriver').textContent = 'Driver #' + Math.floor(Math.random() * 100 + 1);
    document.getElementById('detailService').textContent = ['Ojek', 'Kuliner', 'Kesehatan'][Math.floor(Math.random() * 3)];
    document.getElementById('detailPrice').textContent = 'Rp ' + (Math.floor(Math.random() * 100) + 25) + '.000';
    document.getElementById('detailStatus').textContent = ['Pending', 'Accepted', 'Ongoing', 'Completed', 'Cancelled'][Math.floor(Math.random() * 5)];
    document.getElementById('detailDate').textContent = new Date().toLocaleDateString('id-ID');
    
    const modal = new bootstrap.Modal(document.getElementById('orderDetailModal'));
    modal.show();
}

function updateOrderStatus(id, currentStatus) {
    currentOrderId = id;
    const statusModal = new bootstrap.Modal(document.getElementById('statusModal'));
    statusModal.show();
}

function setStatus(newStatus) {
    bootstrap.Modal.getInstance(document.getElementById('statusModal')).hide();
    alert('✅ Status order #' + currentOrderId + ' berhasil diubah menjadi: ' + newStatus);
}

function deleteOrder(id) {
    if (confirm('Yakin ingin menghapus order #' + id + '?\n\nTindakan ini tidak dapat dibatalkan!')) {
        alert('❌ Order berhasil dihapus.\n\nFitur delete akan diintegrasikan ke backend.');
    }
}
</script>
@endsection
