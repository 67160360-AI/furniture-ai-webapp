document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-content-page]').forEach(container => {
        const page = container.dataset.contentPage;
        fetch(`api_content.php?page=${encodeURIComponent(page)}`)
            .then(response => {
                if (!response.ok) throw new Error('โหลดเนื้อหาไม่สำเร็จ');
                return response.json();
            })
            .then(items => {
                if (!items.length) return;
                const list = container.querySelector('[data-content-list]');
                if (list) {
                    list.innerHTML = items.map(item => `<article class="card"><h2>${escapeHtml(item.title)}</h2><p class="muted">${escapeHtml(item.description)}</p></article>`).join('');
                }
            })
            .catch(() => {});
    });

    function escapeHtml(value) {
        return String(value).replace(/[&<>'"]/g, character => ({
            '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;'
        }[character]));
    }
});
