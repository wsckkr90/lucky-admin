import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

function enableResultOnlyMode() {
    const path = window.location.pathname;
    if (!/\/admin\/(results|charts)(\/|$)/i.test(path)) return;

    const blockedInputNames = new Set(['open_panna', 'jodi', 'close_panna']);
    const hidden = (el) => {
        const wrapper = el.closest('.col-md-3, .col-md-4, .col-md-6, .col-lg-2, .col-lg-3, .col, .form-group, td, th') || el.parentElement;
        if (wrapper) wrapper.hidden = true;
    };

    document.querySelectorAll('label').forEach((label) => {
        const text = label.textContent.trim().toLowerCase();
        if (text.includes('panna') || text === 'jodi' || text === 'comment' || text === 'comments') hidden(label);
    });

    document.querySelectorAll('input, textarea, select').forEach((field) => {
        const name = (field.getAttribute('name') || '').toLowerCase();
        if (blockedInputNames.has(name) || name.includes('comment')) hidden(field);
    });

    document.querySelectorAll('table').forEach((table) => {
        const header = table.querySelector('thead tr:last-child');
        if (!header) return;
        const blocked = new Set();
        [...header.children].forEach((cell, index) => {
            const text = cell.textContent.trim().toLowerCase();
            if (text.includes('panna') || text === 'jodi' || text.includes('comment')) blocked.add(index);
        });
        table.querySelectorAll('tbody tr').forEach((row) => {
            [...row.children].forEach((cell, index) => {
                if (cell.querySelector('input[name="open_panna"], input[name="jodi"], input[name="close_panna"], textarea[name*="comment" i]')) blocked.add(index);
            });
        });
        blocked.forEach((index) => {
            header.children[index]?.setAttribute('hidden', 'hidden');
            table.querySelectorAll('tbody tr').forEach((row) => row.children[index]?.setAttribute('hidden', 'hidden'));
        });
    });
}

function enhanceSidebar() {
    const sidebar = document.getElementById('adminSidebar');
    if (!sidebar || sidebar.dataset.enhanced) return;
    sidebar.dataset.enhanced = '1';

    const sections = [...sidebar.querySelectorAll('.sidebar-section')];
    const state = JSON.parse(localStorage.getItem('admin_sidebar_state') || '{}');

    sections.forEach((section, index) => {
        const title = section.textContent.trim();
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'sidebar-section-toggle';
        button.innerHTML = `<span>${title}</span><span class="sidebar-chevron">⌄</span>`;

        const menu = document.createElement('div');
        menu.className = 'sidebar-submenu';
        let cursor = section.nextElementSibling;
        while (cursor && !cursor.classList.contains('sidebar-section')) {
            const next = cursor.nextElementSibling;
            menu.appendChild(cursor);
            cursor = next;
        }

        section.replaceWith(button);
        button.parentNode.insertBefore(menu, button.nextSibling);

        const key = `${index}-${title}`;
        const open = state[key] !== false;
        menu.hidden = !open;
        button.classList.toggle('collapsed', !open);
        button.addEventListener('click', () => {
            const isOpen = menu.hidden;
            menu.hidden = !isOpen;
            button.classList.toggle('collapsed', !isOpen);
            state[key] = isOpen;
            localStorage.setItem('admin_sidebar_state', JSON.stringify(state));
        });
    });

    const path = window.location.pathname;
    sidebar.querySelectorAll('a.sidebar-link.active').forEach((active) => {
        const menu = active.closest('.sidebar-submenu');
        const toggle = menu?.previousElementSibling;
        if (menu && toggle) {
            menu.hidden = false;
            toggle.classList.remove('collapsed');
        }
    });
}

function addLanguagePicker() {
    const topbar = document.querySelector('.admin-topbar > div:last-child');
    if (!topbar || document.getElementById('adminLanguage')) return;
    const wrap = document.createElement('div');
    wrap.className = 'd-flex align-items-center gap-2';
    wrap.innerHTML = `<label class="small text-muted mb-0" for="adminLanguage">Lang</label><select id="adminLanguage" class="form-select form-select-sm" style="width:auto"><option value="en">English</option><option value="hi">हिन्दी</option></select>`;
    topbar.prepend(wrap);
    const select = wrap.querySelector('select');
    const saved = localStorage.getItem('admin_locale') || 'en';
    select.value = saved;
    select.addEventListener('change', () => {
        localStorage.setItem('admin_locale', select.value);
        document.documentElement.lang = select.value === 'hi' ? 'hi' : 'en';
        document.body.classList.toggle('admin-hindi', select.value === 'hi');
    });
    document.documentElement.lang = saved === 'hi' ? 'hi' : 'en';
    document.body.classList.toggle('admin-hindi', saved === 'hi');
}

function initAdminUi() {
    enableResultOnlyMode();
    enhanceSidebar();
    addLanguagePicker();
}

if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', initAdminUi, { once: true });
else initAdminUi();
