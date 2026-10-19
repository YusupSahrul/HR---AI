import './bootstrap';

// Keep landing-page interactions progressive: navigation remains usable without JS.
document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('header');

    if (header) {
        const updateHeader = () => {
            header.classList.toggle('shadow-sm', window.scrollY > 12);
        };

        updateHeader();
        window.addEventListener('scroll', updateHeader, { passive: true });
    }

    document.querySelectorAll('[data-password-toggle]').forEach((toggle) => {
        toggle.addEventListener('click', () => {
            const input = document.querySelector(toggle.dataset.passwordToggle);
            if (!input) return;
            input.type = input.type === 'password' ? 'text' : 'password';
            toggle.setAttribute('aria-label', input.type === 'password' ? 'Tampilkan password' : 'Sembunyikan password');
        });
    });
});
