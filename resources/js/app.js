import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

/*
 * Result-only presentation mode.
 *
 * The database and backend continue to support open/close panna, jodi and
 * comment-related fields for compatibility. On result/chart admin screens we
 * only show the final Result value to keep the UI simple.
 */
function enableResultOnlyMode() {
    const path = window.location.pathname;

    if (!/\/admin\/(results|charts)(\/|$)/i.test(path)) {
        return;
    }

    const blockedInputNames = new Set([
        'open_panna',
        'jodi',
        'close_panna',
    ]);

    const hasBlockedInput = (element) => {
        if (!element) return false;

        if (element.matches?.('input, textarea, select')) {
            const name = (element.getAttribute('name') || '').toLowerCase();
            if (blockedInputNames.has(name) || name.includes('comment')) {
                return true;
            }
        }

        return Boolean(
            element.querySelector?.(
                'input[name="open_panna"], input[name="jodi"], input[name="close_panna"], textarea[name*="comment" i]'
            )
        );
    };

    const hideFieldWrapper = (element) => {
        const wrapper = element.closest(
            '.col-md-3, .col-md-4, .col-md-6, .col-lg-2, .col-lg-3, .col, .form-group'
        ) || element.parentElement;

        if (wrapper) {
            wrapper.hidden = true;
        }
    };

    document.querySelectorAll('label').forEach((label) => {
        const text = label.textContent.trim().toLowerCase();

        if (
            text.includes('panna') ||
            text === 'jodi' ||
            text === 'comment' ||
            text === 'comments'
        ) {
            hideFieldWrapper(label);
        }
    });

    document.querySelectorAll('input, textarea, select').forEach((field) => {
        const name = (field.getAttribute('name') || '').toLowerCase();

        if (
            blockedInputNames.has(name) ||
            name.includes('comment')
        ) {
            hideFieldWrapper(field);
        }
    });

    document.querySelectorAll('table').forEach((table) => {
        const headerRows = table.querySelectorAll('thead tr');
        const header = headerRows[headerRows.length - 1];
        if (!header) return;

        const headers = Array.from(header.children);
        const blockedColumns = new Set();

        headers.forEach((cell, index) => {
            const text = cell.textContent.trim().toLowerCase();

            if (
                text.includes('panna') ||
                text === 'jodi' ||
                text === 'comment' ||
                text === 'comments'
            ) {
                blockedColumns.add(index);
            }
        });

        table.querySelectorAll('tbody tr').forEach((row) => {
            Array.from(row.children).forEach((cell, index) => {
                if (hasBlockedInput(cell)) {
                    blockedColumns.add(index);
                }
            });
        });

        blockedColumns.forEach((index) => {
            headers[index]?.setAttribute('hidden', 'hidden');

            table.querySelectorAll('tbody tr').forEach((row) => {
                row.children[index]?.setAttribute('hidden', 'hidden');
            });
        });
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', enableResultOnlyMode, { once: true });
} else {
    enableResultOnlyMode();
}
