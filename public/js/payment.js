/**
 * JAPLO — Payment / Checkout Scripts
 * File: public/js/payment.js
 */

/* ── Handle payment method selection styling ── */
document.querySelectorAll('.payment-method').forEach(function (radio) {
    radio.addEventListener('change', function () {
        // Reset semua kartu ke style default
        document.querySelectorAll('.payment-method').forEach(function (r) {
            r.parentElement.style.borderColor       = '#ddd';
            r.parentElement.style.backgroundColor   = '';
            r.parentElement.style.boxShadow         = '';
        });

        // Aktifkan kartu yang dipilih
        this.parentElement.style.borderColor     = '#667eea';
        this.parentElement.style.backgroundColor = 'rgba(102, 126, 234, 0.05)';
        this.parentElement.style.boxShadow       = '0 4px 12px rgba(102, 126, 234, 0.15)';
    });
});

/* ── Form submission handler ── */
var paymentForm = document.getElementById('paymentForm');
if (paymentForm) {
    paymentForm.addEventListener('submit', function (e) {
        e.preventDefault();

        var button       = this.querySelector('button[type="submit"]');
        var originalText = button.innerHTML;
        button.disabled  = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Memproses pembayaran...';

        // Simulate brief delay before actual submit
        var form = this;
        setTimeout(function () {
            form.submit();
        }, 1500);
    });
}
