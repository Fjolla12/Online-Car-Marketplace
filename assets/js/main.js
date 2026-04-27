
const themeBtn = document.getElementById('themeToggle');
if (themeBtn) {
    themeBtn.addEventListener('click', () => {
        const html  = document.documentElement;
        const current = html.getAttribute('data-theme') || 'light';
        const next    = current === 'light' ? 'dark' : 'light';

        html.setAttribute('data-theme', next);

        const expires = new Date(Date.now() + 86400e3 * 30).toUTCString();
        document.cookie = `theme=${next}; expires=${expires}; path=/`;

        themeBtn.textContent = next === 'dark' ? '☀️' : '🌙';
    });
}

document.querySelectorAll('.main-nav a').forEach(link => {
    if (link.href === window.location.href) {
        link.style.color = 'var(--accent)';
        link.style.fontWeight = '700';
    }
});
