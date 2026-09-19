/**
 * JAPLO — Order Tracking Scripts
 * File: public/js/tracking.js
 */

/**
 * Batalkan pesanan (placeholder — integrasi nyata via AJAX).
 */
function cancelOrder() {
    if (confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')) {
        alert('Pesanan dibatalkan.\n\nRefund akan diproses dalam 1-2 hari kerja.');
    }
}

/* Auto-refresh tracking status every 5 seconds (placeholder) */
setInterval(function () {
    // In real app, fetch updated status from server via API
}, 5000);
