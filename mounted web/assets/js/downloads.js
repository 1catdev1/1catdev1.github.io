/**
 * RollzSMP — Downloads filter & search
 */

(function () {
    'use strict';

    const grid = document.getElementById('downloadsGrid');
    const search = document.getElementById('downloadSearch');
    const tabs = document.querySelectorAll('.filter-tab');

    if (!grid) return;

    const cards = Array.from(grid.querySelectorAll('[data-category]'));

    let currentCategory = 'all';
    let currentQuery = '';

    function filter() {
        const q = currentQuery.toLowerCase().trim();

        cards.forEach((card) => {
            const cat = card.getAttribute('data-category') || '';
            const name = (card.getAttribute('data-name') || '').toLowerCase();
            const desc = (card.getAttribute('data-desc') || '').toLowerCase();

            const matchCat = currentCategory === 'all' || cat === currentCategory;
            const matchQuery = !q || name.includes(q) || desc.includes(q);

            card.style.display = matchCat && matchQuery ? '' : 'none';
        });
    }

    if (search) {
        search.addEventListener('input', () => {
            currentQuery = search.value;
            filter();
        });
    }

    tabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            tabs.forEach((t) => t.classList.remove('active'));
            tab.classList.add('active');
            currentCategory = tab.getAttribute('data-filter') || 'all';
            filter();
        });
    });
})();
