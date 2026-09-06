import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

const SIDEBAR_STATE_KEY = 'lucky_admin_sidebar_state';

function enableResultOnlyMode() {
    const path = window.location.pathname;
    if (!/\/admin\/(results|charts)(\/|$)/i.test(path)) return;

    const shouldHide = (text = '') => {
        const value = text.trim().toLowerCase();
        return value.includes('panna') || value === 'jodi' || value.includes('comment');
    };

    document.querySelectorAll('label').forEach((label) => {
        if (shouldHide(label.textContent)) label.closest('.form-group, .col, .col-6, .col-md-3, .col-md-4, .col-md-6, .col-lg-2, .col-lg-3')?.classList.add('result-only-hidden');
    });

    document.querySelectorAll('input, textarea, select').forEach((field) => {
        const name = (field.getAttribute('name') || '').toLowerCase();
        if (name === 'open_panna' || name === 'jodi' || name === 'close_panna' || name.includes('comment')) {
            field.closest('.form-group, .col, .col-6, .col-md-3, .col-md-4, .col-md-6, .col-lg-2, .col-lg-3')?.classList.add('result-only-hidden');
        }
    });

    document.querySelectorAll('table').forEach((table) => {
        const headerRow = table.querySelector('thead tr:last-child');
        if (!headerRow) return;
        const blocked = new Set();
        [...headerRow.children].forEach((cell, index) => {
            if (shouldHide(cell.textContent)) blocked.add(index);
        });
        table.querySelectorAll('tbody tr').forEach((row) => {
            [...row.children].forEach((cell, index) => {
                if (shouldHide(cell.textContent) || cell.querySelector('input[name="open_panna"], input[name="jodi"], input[name="close_panna"], textarea[name*="comment" i]')) blocked.add(index);
            });
        });
        blocked.forEach((index) => {
            headerRow.children[index]?.classList.add('result-only-hidden');
            table.querySelectorAll('tbody tr').forEach((row) => row.children[index]?.classList.add('result-only-hidden'));
        });
    });
}

function initSidebarGroups() {
    document.querySelectorAll('.sidebar-group-toggle').forEach((button) => {
        button.addEventListener('click', () => {
            const group = button.closest('.sidebar-group');
            if (!group) return;
            const key = group.dataset.sidebarGroup;
            const open = !group.classList.contains('open');
            group.classList.toggle('open', open);
            button.setAttribute('aria-expanded', open ? 'true' : 'false');
            try {
                const state = JSON.parse(localStorage.getItem(SIDEBAR_STATE_KEY) || '{}');
                state[key] = open;
                localStorage.setItem(SIDEBAR_STATE_KEY, JSON.stringify(state));
            } catch (_) {}
        });
    });

    let state = {};
    try { state = JSON.parse(localStorage.getItem(SIDEBAR_STATE_KEY) || '{}'); } catch (_) {}
    document.querySelectorAll('.sidebar-group').forEach((group) => {
        const key = group.dataset.sidebarGroup;
        if (Object.prototype.hasOwnProperty.call(state, key) && state[key] === true) group.classList.add('open');
        if (Object.prototype.hasOwnProperty.call(state, key) && state[key] === false && !group.querySelector('.sidebar-link.active')) group.classList.remove('open');
    });
}

function closeSidebarAfterNavigation() {
    document.querySelectorAll('#adminSidebar a.sidebar-link').forEach((link) => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 900) {
                window.setTimeout(() => window.closeSidebar?.(), 40);
            }
        });
    });
}

function improveForms() {
    document.querySelectorAll('input[type="date"], input[type="time"], input[type="datetime-local"]').forEach((input) => {
        input.title = input.type === 'datetime-local' ? 'Select date and time / तारीख और समय चुनें' : 'Select / चुनें';
    });

    document.querySelectorAll('form').forEach((form) => {
        form.addEventListener('submit', () => {
            const submit = form.querySelector('button[type="submit"], input[type="submit"]');
            if (!submit || submit.dataset.noLoading) return;
            submit.dataset.originalText = submit.innerHTML;
            submit.disabled = true;
            submit.innerHTML = 'Saving… / सेव हो रहा है…';
            window.setTimeout(() => { submit.disabled = false; submit.innerHTML = submit.dataset.originalText || 'Save'; }, 8000);
        });
    });
}

function initAdminUi() {
    enableResultOnlyMode();
    initSidebarGroups();
    closeSidebarAfterNavigation();
    improveForms();
}

if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', initAdminUi, { once: true });
else initAdminUi();
