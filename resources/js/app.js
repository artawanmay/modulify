import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const THEME_KEY = 'modulify-theme';

const getPreferredTheme = () => {
    const stored = localStorage.getItem(THEME_KEY);
    if (stored === 'light' || stored === 'dark') {
        return stored;
    }
    return 'dark';
};

const setTheme = (theme) => {
    const normalized = theme === 'light' ? 'light' : 'dark';
    document.documentElement.dataset.theme = normalized;
    document.documentElement.classList.toggle('dark', normalized === 'dark');
    localStorage.setItem(THEME_KEY, normalized);

    document.querySelectorAll('[data-theme-label]').forEach((label) => {
        label.textContent = normalized === 'dark' ? 'Dark' : 'Light';
    });

    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        button.setAttribute('aria-pressed', normalized === 'dark' ? 'true' : 'false');
    });
};

const toggleTheme = () => {
    const current = document.documentElement.dataset.theme || 'dark';
    setTheme(current === 'dark' ? 'light' : 'dark');
};

setTheme(getPreferredTheme());

document.addEventListener('click', (event) => {
    const target = event.target.closest('[data-theme-toggle]');
    if (!target) {
        return;
    }

    event.preventDefault();
    toggleTheme();
});
