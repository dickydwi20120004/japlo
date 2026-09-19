@extends('layouts.app')
@section('title', 'Belanja Titip Pasar — JAPLO')

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
            <div style="width:48px;height:48px;background:rgba(255,255,255,.2);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.5rem">
                🛒
            </div>
            <div>
                <h1>Belanja Titip Pasar</h1>
                <p class="mb-0" style="font-size:.85rem;color:rgba(255,255,255,.8)">Titip belanja di pasar tradisional Bintan</p>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container">
        <div class="row g-4">

            {{-- Form Order --}}
            <div class="col-lg-7">
                <form action="{{ route('customer.pasar.store') }}" method="POST" id="pasarForm">
                    @csrf

                    {{-- Info Pengiriman --}}
                    <div class="jp-card mb-4">
                        <div class="jp-card-header">
                            <span><i class="fas fa-store me-2 text-jp-green"></i>Informasi Belanja</span>
                        </div>
                        <div class="jp-card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Pilih Pasar <span class="text-danger">*</span></label>
                                    <select name="market_name" class="form-select @error('market_name') is-invalid @enderror" required>
                                        <option value="">-- Pilih Pasar --</option>
                                        @foreach($markets as $market)
                                            <option value="{{ $market }}" {{ old('market_name') == $market ? 'selected' : '' }}>
                                                {{ $market }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('market_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Jarak Estimasi (km) <span class="text-danger">*</span></label>
                                    <input type="number" name="distance" id="distanceInput"
                                           class="form-control @error('distance') is-invalid @enderror"
                                           value="{{ old('distance') }}" min="1" step="0.5" placeholder="Misal: 3" required>
                                    @error('distance')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Alamat Pengiriman <span class="text-danger">*</span></label>
                                    <textarea name="delivery_address" class="form-control @error('delivery_address') is-invalid @enderror"
                                              rows="2" placeholder="Alamat lengkap tujuan pengiriman belanjaan..." required>{{ old('delivery_address') }}</textarea>
                                    @error('delivery_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Catatan Umum</label>
                                    <textarea name="notes" class="form-control" rows="2"
                                              placeholder="Catatan untuk shopper (misal: pilihkan yang segar, ukuran sedang, dll)">{{ old('notes') }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                                    <select name="payment_method" class="form-select" required>
                                        <option value="cash" {{ old('payment_method', 'cash') == 'cash' ? 'selected' : '' }}>💵 Tunai (Cash)</option>
                                        <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>🏦 Transfer Bank</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Daftar Belanjaan --}}
                    <div class="jp-card mb-4">
                        <div class="jp-card-header">
                            <span><i class="fas fa-list-check me-2 text-jp-green"></i>Daftar Belanjaan</span>
                            <button type="button" onclick="addItem()" class="btn btn-sm btn-jp-outline">
                                <i class="fas fa-plus me-1"></i> Tambah Baris
                            </button>
                        </div>
                        <div class="jp-card-body p-0">
                            <div class="items-table-wrap">
                                <table class="items-table" id="itemsTable">
                                    <thead>
                                        <tr>
                                            <th class="col-no">#</th>
                                            <th class="col-nama">Nama Barang <span class="text-danger">*</span></th>
                                            <th class="col-desc">Spesifikasi</th>
                                            <th class="col-qty">Jumlah</th>
                                            <th class="col-unit">Satuan</th>
                                            <th class="col-price">Est. Harga (Rp)</th>
                                            <th class="col-del"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="itemsBody">
                                        {{-- Rows pre-filled from old() or seeded --}}
                                    </tbody>
                                </table>
                            </div>
                            <div style="padding:.75rem 1rem">
                                <button type="button" onclick="addItem()" class="btn btn-sm btn-jp-ghost w-100">
                                    <i class="fas fa-plus me-1"></i> Tambah Item Lagi
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Total & Submit --}}
                    <div class="total-box mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="total-label">Estimasi Total Belanjaan</div>
                                <div class="total-value" id="totalEstimate">Rp 0</div>
                                <div style="font-size:.75rem;color:var(--jp-green-dark);margin-top:.2rem">
                                    *Belum termasuk ongkir & service fee
                                </div>
                            </div>
                            <div style="font-size:2.5rem;opacity:.5">🛒</div>
                        </div>
                    </div>
                    <input type="hidden" name="estimated_price" id="estimatedPriceInput" value="0">

                    <button type="submit" class="btn btn-jp-primary w-100" style="padding:.85rem;font-size:1rem">
                        <i class="fas fa-shopping-cart me-2"></i> Buat Order Belanja
                    </button>
                </form>
            </div>

            {{-- Sidebar: Riwayat & Info Tarif --}}
            <div class="col-lg-5">
                {{-- Tarif Info --}}
                @if($tariff)
                    <div class="jp-card mb-4">
                        <div class="jp-card-header">
                            <span><i class="fas fa-info-circle me-2 text-jp-green"></i>Info Tarif</span>
                        </div>
                        <div class="jp-card-body">
                            <div style="font-size:.8375rem;color:var(--jp-gray-600);line-height:1.8">
                                <div>🛵 Biaya Dasar: <strong>Rp {{ number_format($tariff->base_fare, 0, ',', '.') }}</strong></div>
                                <div>📍 Per km: <strong>Rp {{ number_format($tariff->per_km, 0, ',', '.') }}</strong></div>
                                <div>💵 Minimum: <strong>Rp {{ number_format($tariff->minimum_fare, 0, ',', '.') }}</strong></div>
                            </div>
                            <div style="font-size:.75rem;color:var(--jp-gray-400);margin-top:.5rem">
                                *Biaya ongkir dihitung saat pesanan diterima driver
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Riwayat Order --}}
                <div class="jp-card">
                    <div class="jp-card-header">
                        <span><i class="fas fa-clock-rotate-left me-2 text-jp-green"></i>Order Pasar Saya</span>
                    </div>
                    <div class="jp-card-body p-0">
                        @if($myOrders->count() > 0)
                            <div class="table-responsive">
                                <table class="jp-table">
                                    <thead>
                                        <tr>
                                            <th>No. Order</th>
                                            <th>Pasar</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($myOrders as $order)
                                            <tr>
                                                <td>
                                                    <span style="font-family:monospace;font-size:.8rem;font-weight:600">
                                                        {{ $order->order_number }}
                                                    </span>
                                                </td>
                                                <td style="font-size:.8375rem">{{ $order->market_name }}</td>
                                                <td>
                                                    <span class="jp-badge"
                                                          style="{{ match($order->status) {
                                                            'pending'    => 'background:#FEF3C7;color:#D97706',
                                                            'accepted'   => 'background:#DBEAFE;color:#2563EB',
                                                            'shopping'   => 'background:#EDE9FE;color:#7C3AED',
                                                            'on_the_way' => 'background:#FEF9C3;color:#A16207',
                                                            'delivered'  => 'background:#DCFCE7;color:#15803D',
                                                            'cancelled'  => 'background:#FEE2E2;color:#DC2626',
                                                            default      => 'background:#F3F4F6;color:#6B7280',
                                                          } }}">
                                                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('customer.pasar.show', $order) }}"
                                                       class="btn btn-sm btn-jp-ghost">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="jp-empty">
                                <div class="empty-icon"><i class="fas fa-shopping-basket"></i></div>
                                <p>Belum ada order belanja pasar</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let itemCount = 0;
const units = ['pcs', 'kg', 'gram', 'liter', 'ml', 'ikat', 'buah', 'lusin', 'box', 'lembar'];

function addItem(data = {}) {
    itemCount++;
    const body = document.getElementById('itemsBody');
    const tr = document.createElement('tr');
    tr.id = 'item-row-' + itemCount;
    tr.innerHTML = `
        <td class="col-no" style="text-align:center;color:var(--jp-gray-400);font-size:.8rem">${itemCount}</td>
        <td class="col-nama">
            <input type="text" name="items[${itemCount}][item_name]" class="form-control"
                   placeholder="Nama barang" value="${data.item_name || ''}" required>
        </td>
        <td class="col-desc">
            <input type="text" name="items[${itemCount}][description]" class="form-control"
                   placeholder="Misal: segar, medium" value="${data.description || ''}">
        </td>
        <td class="col-qty">
            <input type="number" name="items[${itemCount}][quantity]" class="form-control item-qty"
                   placeholder="1" value="${data.quantity || 1}" min="1" step="0.5"
                   onchange="calculateTotal()">
        </td>
        <td class="col-unit">
            <select name="items[${itemCount}][unit]" class="form-select">
                ${units.map(u => `<option value="${u}" ${(data.unit || 'pcs') === u ? 'selected' : ''}>${u}</option>`).join('')}
            </select>
        </td>
        <td class="col-price">
            <input type="number" name="items[${itemCount}][estimated_price]" class="form-control item-price"
                   placeholder="0" value="${data.estimated_price || ''}" min="0" step="500"
                   onchange="calculateTotal()">
        </td>
        <td class="col-del" style="text-align:center">
            <button type="button" onclick="removeItem(${itemCount})"
                    class="btn btn-sm" style="color:var(--jp-red);padding:2px 6px">
                <i class="fas fa-trash-can"></i>
            </button>
        </td>
    `;
    body.appendChild(tr);
}

function removeItem(id) {
    const row = document.getElementById('item-row-' + id);
    if (row) row.remove();
    calculateTotal();
    renumberRows();
}

function renumberRows() {
    const rows = document.querySelectorAll('#itemsBody tr');
    rows.forEach((row, idx) => {
        const noCell = row.querySelector('.col-no');
        if (noCell) noCell.textContent = idx + 1;
    });
}

function calculateTotal() {
    let total = 0;
    document.querySelectorAll('#itemsBody tr').forEach(row => {
        const qty   = parseFloat(row.querySelector('.item-qty')?.value) || 0;
        const price = parseFloat(row.querySelector('.item-price')?.value) || 0;
        total += qty * price;
    });
    document.getElementById('totalEstimate').textContent = 'Rp ' + Math.round(total).toLocaleString('id-ID');
    document.getElementById('estimatedPriceInput').value = Math.round(total);
}

// Init with pre-filled items from old() or default 3 rows
document.addEventListener('DOMContentLoaded', function () {
    @if(old('items'))
        @foreach(old('items') as $key => $item)
            addItem({
                item_name: @json($item['item_name'] ?? ''),
                description: @json($item['description'] ?? ''),
                quantity: @json($item['quantity'] ?? 1),
                unit: @json($item['unit'] ?? 'pcs'),
                estimated_price: @json($item['estimated_price'] ?? ''),
            });
        @endforeach
    @else
        addItem();
        addItem();
        addItem();
    @endif
    calculateTotal();
});
</script>
@endpush

