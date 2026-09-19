@extends('layouts.app')
@section('title', 'Layanan Percetakan — JAPLO')

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
            <img src="{{ asset('images/icons/pencetakan.svg') }}" width="40" height="40" alt="Percetakan">
            <div>
                <h1>Layanan Percetakan</h1>
                <p class="mb-0" style="font-size:.85rem;color:rgba(255,255,255,.8)">Print, scan, fotokopi & cetak foto — antar ke lokasi Anda</p>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container">
        <div class="row g-4">

            {{-- Form --}}
            <div class="col-lg-7">
                <form action="{{ route('customer.pencetakan.order') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Pilih Jenis Layanan --}}
                    <div class="jp-card mb-4">
                        <div class="jp-card-header">
                            <span><i class="fas fa-print me-2 text-jp-green"></i>Pilih Jenis Layanan</span>
                        </div>
                        <div class="jp-card-body">
                            <input type="hidden" name="service_type" id="serviceTypeInput"
                                   value="{{ old('service_type', 'print_bw') }}">
                            <div class="row g-2">
                                @php
                                    $printServices = [
                                        ['key' => 'print_bw',    'icon' => '🖨️', 'name' => 'Print Hitam Putih', 'price' => 'Mulai Rp 300/hal'],
                                        ['key' => 'print_color', 'icon' => '🎨', 'name' => 'Print Warna',        'price' => 'Mulai Rp 1.000/hal'],
                                        ['key' => 'fotokopi',    'icon' => '📄', 'name' => 'Fotokopi',           'price' => 'Mulai Rp 200/hal'],
                                        ['key' => 'scan',        'icon' => '🔍', 'name' => 'Scan Dokumen',       'price' => 'Mulai Rp 500/hal'],
                                        ['key' => 'foto',        'icon' => '🖼️', 'name' => 'Cetak Foto',         'price' => 'Mulai Rp 3.000/lbr'],
                                    ];
                                @endphp
                                @foreach($printServices as $svc)
                                    <div class="col-6 col-md-4">
                                        <div class="service-option-card {{ old('service_type', 'print_bw') == $svc['key'] ? 'selected' : '' }}"
                                             id="svc-{{ $svc['key'] }}"
                                             onclick="selectService('{{ $svc['key'] }}')">
                                            <div class="svc-icon">{{ $svc['icon'] }}</div>
                                            <div class="svc-name">{{ $svc['name'] }}</div>
                                            <div class="svc-price">{{ $svc['price'] }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('service_type')<div class="text-danger mt-2" style="font-size:.8rem">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- Upload File & Detail --}}
                    <div class="jp-card mb-4">
                        <div class="jp-card-header">
                            <span><i class="fas fa-file-upload me-2 text-jp-green"></i>File & Detail Cetak</span>
                        </div>
                        <div class="jp-card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Upload File</label>
                                    <input type="file" name="files[]" class="form-control @error('files') is-invalid @enderror"
                                           multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.ppt,.pptx">
                                    <div style="font-size:.75rem;color:var(--jp-gray-400);margin-top:4px">
                                        Format: PDF, DOC, DOCX, JPG, PNG, PPT. Maks 10MB per file.
                                    </div>
                                    @error('files')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Jumlah Halaman / Lembar <span class="text-danger">*</span></label>
                                    <input type="number" name="pages" id="pagesInput"
                                           class="form-control @error('pages') is-invalid @enderror"
                                           value="{{ old('pages', 1) }}" min="1" required
                                           onchange="calculateEstimate()">
                                    @error('pages')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Ukuran Kertas</label>
                                    <select name="paper_size" class="form-select">
                                        <option value="A4" {{ old('paper_size', 'A4') == 'A4' ? 'selected' : '' }}>A4</option>
                                        <option value="A3" {{ old('paper_size') == 'A3' ? 'selected' : '' }}>A3</option>
                                        <option value="F4" {{ old('paper_size') == 'F4' ? 'selected' : '' }}>F4 (Folio)</option>
                                        <option value="Letter" {{ old('paper_size') == 'Letter' ? 'selected' : '' }}>Letter</option>
                                        <option value="3R" {{ old('paper_size') == '3R' ? 'selected' : '' }}>3R (Foto)</option>
                                        <option value="4R" {{ old('paper_size') == '4R' ? 'selected' : '' }}>4R (Foto)</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Warna</label>
                                    <select name="color" class="form-select" id="colorSelect" onchange="calculateEstimate()">
                                        <option value="bw" {{ old('color', 'bw') == 'bw' ? 'selected' : '' }}>Hitam Putih</option>
                                        <option value="color" {{ old('color') == 'color' ? 'selected' : '' }}>Berwarna</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Catatan / Instruksi</label>
                                    <textarea name="notes" class="form-control" rows="3"
                                              placeholder="Misal: cetak 2 sisi, jilid spiral, kualitas tinggi...">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Info Pemesan --}}
                    <div class="jp-card mb-4">
                        <div class="jp-card-header">
                            <span><i class="fas fa-user me-2 text-jp-green"></i>Info Pemesan</span>
                        </div>
                        <div class="jp-card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Pemesan <span class="text-danger">*</span></label>
                                    <input type="text" name="customer_name"
                                           class="form-control @error('customer_name') is-invalid @enderror"
                                           value="{{ old('customer_name', auth()->user()->name) }}" required>
                                    @error('customer_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nomor HP <span class="text-danger">*</span></label>
                                    <input type="tel" name="customer_phone"
                                           class="form-control @error('customer_phone') is-invalid @enderror"
                                           value="{{ old('customer_phone', auth()->user()->phone ?? '') }}"
                                           placeholder="08xx-xxxx-xxxx" required>
                                    @error('customer_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Alamat Pengiriman (Opsional)</label>
                                    <textarea name="delivery_address" class="form-control" rows="2"
                                              placeholder="Kosongkan jika akan diambil sendiri...">{{ old('delivery_address') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Estimasi Harga --}}
                    <div class="price-estimate-box mb-4">
                        <div class="est-label mb-1">Estimasi Biaya</div>
                        <div class="est-value" id="estimateValue">Rp —</div>
                        <div style="font-size:.75rem;color:var(--jp-green-dark);margin-top:.25rem">
                            *Harga final dikonfirmasi setelah file diproses
                        </div>
                    </div>

                    <button type="submit" class="btn btn-jp-primary w-100" style="padding:.85rem;font-size:1rem">
                        <i class="fas fa-paper-plane me-2"></i> Buat Order Percetakan
                    </button>
                </form>
            </div>

            {{-- Sidebar: Keunggulan & Info --}}
            <div class="col-lg-5">

                {{-- Tarif Info --}}
                @if($tariff ?? null)
                    <div class="jp-card mb-4">
                        <div class="jp-card-header">
                            <span><i class="fas fa-tags me-2 text-jp-green"></i>Info Tarif</span>
                        </div>
                        <div class="jp-card-body">
                            <div class="table-responsive">
                                <table class="jp-table">
                                    <thead>
                                        <tr>
                                            <th>Layanan</th>
                                            <th>Harga / hal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(is_array($tariff))
                                            @foreach($tariff as $t)
                                                <tr>
                                                    <td>{{ $t['label'] ?? $t['name'] ?? '—' }}</td>
                                                    <td style="font-weight:600;color:var(--jp-green)">
                                                        Rp {{ number_format($t['price'] ?? $t['base_fare'] ?? 0, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @elseif(is_object($tariff))
                                            <tr>
                                                <td>{{ $tariff->label ?? 'Percetakan' }}</td>
                                                <td style="font-weight:600;color:var(--jp-green)">
                                                    Rp {{ number_format($tariff->base_fare ?? 0, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Keunggulan --}}
                <div class="jp-card mb-4">
                    <div class="jp-card-header">
                        <span><i class="fas fa-star me-2 text-jp-green"></i>Mengapa Pakai Kami?</span>
                    </div>
                    <div class="jp-card-body">
                        @php
                            $features = [
                                ['icon' => 'bolt', 'title' => 'Cepat', 'desc' => 'Proses 15–30 menit'],
                                ['icon' => 'medal', 'title' => 'Berkualitas', 'desc' => 'Mesin print terkini'],
                                ['icon' => 'motorcycle', 'title' => 'Antar Jemput', 'desc' => 'Pengiriman ke lokasi'],
                                ['icon' => 'coins', 'title' => 'Terjangkau', 'desc' => 'Harga bersaing'],
                            ];
                        @endphp
                        <div class="row g-2">
                            @foreach($features as $feat)
                                <div class="col-6">
                                    <div style="background:var(--jp-gray-50);border-radius:10px;padding:.85rem;text-align:center">
                                        <div style="width:38px;height:38px;background:var(--jp-green-light);border-radius:10px;display:flex;align-items:center;justify-content:center;margin:0 auto .5rem;color:var(--jp-green)">
                                            <i class="fas fa-{{ $feat['icon'] }}"></i>
                                        </div>
                                        <div style="font-weight:700;font-size:.8125rem">{{ $feat['title'] }}</div>
                                        <div style="font-size:.75rem;color:var(--jp-gray-400)">{{ $feat['desc'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- WA Order --}}
                <div class="jp-card">
                    <div class="jp-card-header">
                        <span><i class="fab fa-whatsapp me-2" style="color:#25D366"></i>Pesan via WhatsApp</span>
                    </div>
                    <div class="jp-card-body">
                        <p style="font-size:.875rem;color:var(--jp-gray-600);margin-bottom:1rem;line-height:1.6">
                            Atau langsung hubungi kami via WhatsApp untuk konsultasi kebutuhan percetakan Anda.
                        </p>
                        <a href="https://api.whatsapp.com/send?phone=6281234567890&text={{ urlencode('Halo JAPLO, saya ingin menggunakan layanan percetakan. Mohon informasinya.') }}"
                           target="_blank"
                           class="btn w-100"
                           style="background:#25D366;color:#fff;font-weight:600;border:none;padding:.7rem">
                            <i class="fab fa-whatsapp me-2"></i> Chat WhatsApp
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const servicePrices = {
    'print_bw':    300,
    'print_color': 1000,
    'fotokopi':    200,
    'scan':        500,
    'foto':        3000,
};

let selectedService = '{{ old('service_type', 'print_bw') }}';

function selectService(key) {
    selectedService = key;
    document.getElementById('serviceTypeInput').value = key;
    document.querySelectorAll('.service-option-card').forEach(c => c.classList.remove('selected'));
    document.getElementById('svc-' + key).classList.add('selected');
    calculateEstimate();
}

function calculateEstimate() {
    const pages = parseInt(document.getElementById('pagesInput').value) || 0;
    const price = servicePrices[selectedService] || 0;
    if (pages > 0 && price > 0) {
        const total = pages * price;
        document.getElementById('estimateValue').textContent = 'Rp ' + total.toLocaleString('id-ID');
    } else {
        document.getElementById('estimateValue').textContent = 'Rp —';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    selectService(selectedService);
});
</script>
@endpush

