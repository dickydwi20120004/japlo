/**
 * JAPLO — Profile Page Scripts
 * File: public/js/profile.js
 */

/**
 * Upload foto profil via AJAX tanpa reload halaman.
 * @param {HTMLInputElement} input
 */
function uploadPhoto(input) {
    if (!input.files || !input.files[0]) return;

    const form     = document.getElementById('photoForm');
    const formData = new FormData(form);

    JapToast.info('Mengupload foto...');

    fetch(form.action, {
        method:  'POST',
        body:    formData,
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
    })
    .then(function (r) { return r.json(); })
    .then(function (data) {
        if (data.success) {
            const wrap    = document.getElementById('avatarWrap');
            const existing = wrap.querySelector('img, span:not(.avatar-edit-btn *)');

            if (existing && existing.tagName === 'SPAN') {
                const img  = document.createElement('img');
                img.id     = 'avatarImg';
                img.alt    = 'Profile';
                img.style.cssText = 'width:100%;height:100%;object-fit:cover;border-radius:50%';
                img.src    = data.photo_url;
                wrap.insertBefore(img, wrap.firstChild);
                existing.remove();
            } else if (existing && existing.tagName === 'IMG') {
                existing.src = data.photo_url;
            }

            JapToast.success('Foto profil berhasil diperbarui!');
        } else {
            JapToast.error(data.message || 'Gagal mengupload foto.');
        }
    })
    .catch(function () {
        JapToast.error('Terjadi kesalahan saat upload.');
    });
}
