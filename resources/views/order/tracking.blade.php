@extends('layouts.app')

@section('title', 'Order Tracking - JAPLO')

@section('content')
<!-- GPS Navigation Tracking Page -->
<div class="hero-section" style="padding: 40px 0; background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);">
    <div class="container">
        <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm mb-3">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
        <h2 class="fw-bold mb-2 text-white" style="font-size: 2.5rem;">📍 Tracking Order</h2>
        <p class="mb-0 text-white" style="font-size: 1.1rem;">Live tracking dengan GPS</p>
    </div>
</div>

<div class="container py-4">
    <div class="row">
        <!-- Map Section (Main) -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow-modern" style="height: 600px; border-radius: 20px; overflow: hidden;">
                <div id="mapContainer" style="width: 100%; height: 100%;"></div>
            </div>
        </div>

        <!-- Info Section (Sidebar) -->
        <div class="col-lg-4">
            <!-- Order Status Card -->
            <div class="card shadow-modern mb-3">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-receipt text-primary me-2"></i>
                        Order Details
                    </h5>

                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-secondary d-block mb-1">Order Number</small>
                        <h6 class="fw-bold mb-0" id="orderNumber">JPL20260804001</h6>
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-secondary d-block mb-1">Status</small>
                        <div>
                            <span class="badge bg-success badge-status" id="orderStatus">In Progress</span>
                        </div>
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-secondary d-block mb-1">Dari</small>
                        <p class="mb-0 fw-500" id="pickupLocation">📍 Jl. Merdeka No. 123</p>
                    </div>

                    <div class="mb-3">
                        <small class="text-secondary d-block mb-1">Ke</small>
                        <p class="mb-0 fw-500" id="destinationLocation">🎯 Jl. Sudirman No. 456</p>
                    </div>
                </div>
            </div>

            <!-- Driver Info Card -->
            <div class="card shadow-modern mb-3">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-user-tie text-success me-2"></i>
                        Driver Info
                    </h5>

                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-light p-2 me-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user fa-2x text-secondary"></i>
                        </div>
                        <div>
                            <p class="fw-bold mb-0" id="driverName">Ahmad Sopir</p>
                            <small class="text-secondary" id="driverRating">⭐ 4.8 (156 trips)</small>
                        </div>
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-secondary d-block mb-1">Vehicle</small>
                        <p class="mb-0 fw-500" id="vehicleInfo">🏍️ Honda Beat - B 1234 ABC</p>
                    </div>

                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-secondary d-block mb-1">Distance & Time</small>
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="mb-0 fw-bold text-primary" id="distanceInfo">2.5 km</p>
                                <small class="text-secondary">Distance</small>
                            </div>
                            <div>
                                <p class="mb-0 fw-bold text-primary" id="timeInfo">8 min</p>
                                <small class="text-secondary">ETA</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" onclick="callDriver()">
                            <i class="fas fa-phone me-2"></i> Hubungi Driver
                        </button>
                        <button class="btn btn-outline-danger" onclick="cancelOrder()">
                            <i class="fas fa-times me-2"></i> Batalkan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Real-time Status Card -->
            <div class="card shadow-modern">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-clock text-warning me-2"></i>
                        Status Timeline
                    </h5>

                    <div class="timeline">
                        <!-- Status 1 -->
                        <div class="timeline-item">
                            <div class="timeline-marker completed">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="timeline-content">
                                <p class="mb-0 fw-bold">Pesanan Dibuat</p>
                                <small class="text-secondary">Aug 4, 12:00 PM</small>
                            </div>
                        </div>

                        <!-- Status 2 -->
                        <div class="timeline-item">
                            <div class="timeline-marker completed">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="timeline-content">
                                <p class="mb-0 fw-bold">Driver Menerima</p>
                                <small class="text-secondary">Aug 4, 12:02 PM</small>
                            </div>
                        </div>

                        <!-- Status 3 (Active) -->
                        <div class="timeline-item">
                            <div class="timeline-marker active">
                                <i class="fas fa-location-dot"></i>
                            </div>
                            <div class="timeline-content">
                                <p class="mb-0 fw-bold">Driver Mengambil</p>
                                <small class="text-secondary">Aug 4, 12:05 PM</small>
                            </div>
                        </div>

                        <!-- Status 4 -->
                        <div class="timeline-item">
                            <div class="timeline-marker">
                                <i class="fas fa-flag-checkered"></i>
                            </div>
                            <div class="timeline-content">
                                <p class="mb-0 fw-bold">Sampai Tujuan</p>
                                <small class="text-secondary">-</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.min.js"></script>

<!-- Custom Styles for Tracking -->
<style>
    /* Map Styles */
    #mapContainer {
        border-radius: 20px;
        z-index: 1;
    }

    .leaflet-container {
        border-radius: 20px;
        font-family: 'Poppins', sans-serif;
    }

    /* Custom Markers */
    .marker-icon-pickup {
        background: linear-gradient(135deg, #00A859 0%, #008F4A 100%);
        color: white;
        padding: 10px 15px;
        border-radius: 50%;
        font-weight: bold;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 168, 89, 0.3);
    }

    .marker-icon-driver {
        background: linear-gradient(135deg, #FFC107 0%, #FF9800 100%);
        color: white;
        padding: 10px 15px;
        border-radius: 50%;
        font-weight: bold;
        text-align: center;
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
        animation: pulse 2s ease-in-out infinite;
    }

    .marker-icon-destination {
        background: linear-gradient(135deg, #F44336 0%, #D32F2F 100%);
        color: white;
        padding: 10px 15px;
        border-radius: 50%;
        font-weight: bold;
        text-align: center;
        box-shadow: 0 4px 12px rgba(244, 67, 54, 0.3);
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.1);
        }
    }

    /* Timeline Styles */
    .timeline {
        position: relative;
        padding: 20px 0;
    }

    .timeline-item {
        display: flex;
        margin-bottom: 25px;
        position: relative;
    }

    .timeline-item:not(:last-child)::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 50px;
        bottom: -25px;
        width: 2px;
        background: #E0E0E0;
    }

    .timeline-item:not(:last-child).completed::before {
        background: #4CAF50;
    }

    .timeline-item.active:not(:last-child)::before {
        background: #FFC107;
    }

    .timeline-marker {
        min-width: 40px;
        height: 40px;
        background: white;
        border: 2px solid #E0E0E0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        color: #999;
        font-weight: bold;
        flex-shrink: 0;
        transition: all 0.3s;
    }

    .timeline-marker.completed {
        background: #4CAF50;
        border-color: #4CAF50;
        color: white;
    }

    .timeline-marker.active {
        background: #FFC107;
        border-color: #FFC107;
        color: white;
        animation: pulse 2s ease-in-out infinite;
    }

    .timeline-content {
        padding-top: 5px;
    }

    .timeline-content p {
        font-size: 0.95rem;
    }

    /* Button Styles */
    .btn-primary, .btn-outline-danger {
        border-radius: 12px;
        font-weight: 600;
        padding: 12px;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 168, 89, 0.3);
    }

    .btn-outline-danger:hover {
        transform: translateY(-2px);
    }

    /* Badge Styles */
    .badge-status {
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 991px) {
        #mapContainer {
            height: 400px !important;
        }

        .card {
            margin-bottom: 20px;
        }
    }

    @media (max-width: 768px) {
        #mapContainer {
            height: 300px !important;
        }

        .row {
            flex-direction: column-reverse;
        }
    }
</style>

<!-- Tracking JavaScript -->
<script>
    // Initialize Map
    let map = L.map('mapContainer').setView([-6.2088, 106.8456], 14); // Jakarta Default

    // Add Tile Layer (OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    // Marker Variables
    let pickupMarker, driverMarker, destinationMarker, routeLine;

    // Sample Data
    const orderData = {
        pickupLat: -6.2088,
        pickupLng: 106.8456,
        destinationLat: -6.2155,
        destinationLng: 106.8550,
        driverLat: -6.2088,
        driverLng: 106.8456,
        distance: 2.5,
        time: 8
    };

    // Initialize Markers
    function initializeMap() {
        // Pickup Marker (Green)
        pickupMarker = L.marker([orderData.pickupLat, orderData.pickupLng], {
            icon: L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            })
        }).addTo(map).bindPopup('<strong>Pickup Location</strong><br>📍 Jl. Merdeka No. 123');

        // Destination Marker (Red)
        destinationMarker = L.marker([orderData.destinationLat, orderData.destinationLng], {
            icon: L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            })
        }).addTo(map).bindPopup('<strong>Destination</strong><br>🎯 Jl. Sudirman No. 456');

        // Driver Marker (Yellow - Animated)
        driverMarker = L.marker([orderData.driverLat, orderData.driverLng], {
            icon: L.icon({
                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-yellow.png',
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            })
        }).addTo(map).bindPopup('<strong>Driver Ahmad</strong><br>🏍️ Honda Beat<br>Rating: ⭐ 4.8');

        // Draw Route Line
        drawRoute();

        // Fit Map to Bounds
        const group = new L.featureGroup([pickupMarker, driverMarker, destinationMarker]);
        map.fitBounds(group.getBounds().pad(0.1));
    }

    // Draw Route Line
    function drawRoute() {
        const routeCoordinates = [
            [orderData.pickupLat, orderData.pickupLng],
            [orderData.driverLat, orderData.driverLng],
            [orderData.destinationLat, orderData.destinationLng]
        ];

        if (routeLine) {
            map.removeLayer(routeLine);
        }

        routeLine = L.polyline(routeCoordinates, {
            color: '#00A859',
            weight: 3,
            opacity: 0.7,
            dashArray: '5, 5',
            lineCap: 'round'
        }).addTo(map);
    }

    // Simulate Real-time Driver Movement
    function simulateDriverMovement() {
        let progress = 0;
        const interval = setInterval(() => {
            progress += 0.005;

            if (progress >= 1) {
                clearInterval(interval);
                Toast.success('Pesanan selesai! Terima kasih telah menggunakan JAPLO.');
                return;
            }

            // Linear interpolation (Lerp)
            const currentLat = orderData.pickupLat + (orderData.destinationLat - orderData.pickupLat) * progress;
            const currentLng = orderData.pickupLng + (orderData.destinationLng - orderData.pickupLng) * progress;

            // Update driver position
            driverMarker.setLatLng([currentLat, currentLng]);

            // Update ETA
            const remainingTime = Math.max(0, Math.round(orderData.time * (1 - progress)));
            document.getElementById('timeInfo').textContent = remainingTime + ' min';

            // Update remaining distance
            const remainingDistance = (orderData.distance * (1 - progress)).toFixed(1);
            document.getElementById('distanceInfo').textContent = remainingDistance + ' km';

            // Auto pan to driver
            map.setView([currentLat, currentLng], 15);
        }, 1000); // Update every 1 second
    }

    // Call Driver Function
    function callDriver() {
        Toast.success('Menghubungi driver Ahmad...');
        // In production, ini akan integrate dengan telephony API
    }

    // Cancel Order Function
    function cancelOrder() {
        if (confirm('Apakah Anda yakin ingin membatalkan order?')) {
            Toast.warning('Order dibatalkan');
            setTimeout(() => {
                window.location.href = '{{ route("dashboard") }}';
            }, 1500);
        }
    }

    // Initialize on Load
    document.addEventListener('DOMContentLoaded', function() {
        initializeMap();
        
        // Start simulation after 2 seconds
        setTimeout(() => {
            Toast.info('🚗 Driver sedang menuju lokasi Anda...');
            simulateDriverMovement();
        }, 2000);
    });

    // Add Toast if not defined globally
    if (typeof Toast === 'undefined') {
        window.Toast = {
            success: function(msg) { alert(msg); },
            error: function(msg) { alert(msg); },
            warning: function(msg) { alert(msg); },
            info: function(msg) { alert(msg); }
        };
    }
</script>
@endsection
