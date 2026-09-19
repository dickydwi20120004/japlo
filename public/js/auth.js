/**
 * JAPLO — Auth Pages (Login, Register, Forgot/Reset Password)
 * File: public/js/auth.js
 */

/**
 * Toggle show/hide password
 */
function togglePassword(inputId, button) {
    const input = document.getElementById(inputId);
    const icon  = button.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

/**
 * Fill demo credentials (login page)
 */
function fillDemo(type) {
    const map = {
        user:   { email: 'demo@japlo.com',   password: 'password123' },
        driver: { email: 'driver@japlo.com', password: 'password123' },
        admin:  { email: 'admin@japlo.com',  password: 'admin123'    },
    };
    const creds = map[type];
    if (!creds) return;
    const emailEl = document.getElementById('email');
    const pwdEl   = document.getElementById('password');
    if (emailEl) emailEl.value = creds.email;
    if (pwdEl)   pwdEl.value   = creds.password;
}

/**
 * Toggle driver fields (register page)
 */
function toggleDriverFields() {
    const role        = document.querySelector('input[name="role"]:checked');
    const driverFields = document.getElementById('driverFields');
    if (!role || !driverFields) return;

    const isDriver     = role.value === 'driver';
    const driverInputs = driverFields.querySelectorAll('input, select');
    const required     = ['vehicle_type', 'vehicle_brand', 'license_plate', 'license_number'];

    driverFields.style.display = isDriver ? 'block' : 'none';

    driverInputs.forEach(input => {
        if (isDriver && required.includes(input.name)) {
            input.setAttribute('required', 'required');
        } else {
            input.removeAttribute('required');
        }
    });
}

/* Init on DOMContentLoaded */
document.addEventListener('DOMContentLoaded', function () {
    /* Register page – init driver fields */
    const roleInputs = document.querySelectorAll('input[name="role"]');
    if (roleInputs.length) {
        toggleDriverFields();
        roleInputs.forEach(r => r.addEventListener('change', toggleDriverFields));
    }
});
