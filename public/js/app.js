/**
 * JAPLO — Global App Scripts
 * File: public/js/app.js
 * Dipakai oleh: layouts/app.blade.php (semua halaman)
 */

/* ─────────────────────────────────────────
   TOAST NOTIFICATION SYSTEM
   Penggunaan: JapToast.success('pesan')
───────────────────────────────────────── */
const JapToast = {
    _icons: {
        success: 'fa-circle-check',
        error:   'fa-circle-xmark',
        warning: 'fa-triangle-exclamation',
        info:    'fa-circle-info',
    },

    show(msg, type = 'info', duration = 3500) {
        const container = document.getElementById('jp-toast-container');
        if (!container) return;

        const id   = 'toast-' + Date.now();
        const icon = this._icons[type] || 'fa-circle-info';
        const el   = document.createElement('div');
        el.id        = id;
        el.className = `jp-toast toast-${type}`;
        el.innerHTML = `
            <i class="fas ${icon} toast-icon"></i>
            <span class="toast-msg">${msg}</span>
            <button class="toast-close" onclick="JapToast.dismiss('${id}')">
                <i class="fas fa-xmark"></i>
            </button>`;
        container.appendChild(el);

        if (duration > 0) {
            setTimeout(() => this.dismiss(id), duration);
        }
    },

    dismiss(id) {
        const el = document.getElementById(id);
        if (!el) return;
        el.classList.add('toast-out');
        setTimeout(() => el.remove(), 280);
    },

    success(msg, duration) { this.show(msg, 'success', duration); },
    error(msg, duration)   { this.show(msg, 'error',   duration); },
    warning(msg, duration) { this.show(msg, 'warning', duration); },
    info(msg, duration)    { this.show(msg, 'info',    duration); },
};

/* ─────────────────────────────────────────
   AUTO-DISMISS BOOTSTRAP ALERTS
───────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.alert.alert-dismissible').forEach(function (alert) {
        setTimeout(function () {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
            if (bsAlert) bsAlert.close();
        }, 5000);
    });
});
