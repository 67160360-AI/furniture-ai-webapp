document.addEventListener('DOMContentLoaded', () => {
    const productGrid = document.querySelector('.product-grid[data-products-api]');
    const searchGrid = document.querySelector('[data-search-results]');
    const grid = productGrid || searchGrid;
    if (!grid) return;

    const keyword = new URLSearchParams(window.location.search).get('keyword') || '';
    const endpoint = searchGrid
        ? `api_search.php?keyword=${encodeURIComponent(keyword)}`
        : grid.dataset.productsApi;

    fetch(endpoint)
        .then(response => {
            if (!response.ok) throw new Error('API request failed');
            return response.json();
        })
        .then(products => {
            if (!Array.isArray(products) || products.length === 0) {
                grid.innerHTML = '<p class="muted" style="grid-column: 1/-1; text-align: center; padding: 40px;">ไม่พบสินค้าในระบบ</p>';
                return;
            }

            grid.innerHTML = products.map(product => `
                <article class="card">
                    <img src="images/${encodeURIComponent(product.image || 'chair.jpg')}" alt="${escapeHtml(product.name)}" onerror="this.src='https://via.placeholder.com/300x220?text=Furniture';">
                    <div class="card-body" style="padding: 15px; display: flex; flex-direction: column; flex: 1;">
                        <h3 style="margin: 0 0 8px; font-size: 18px;">${escapeHtml(product.name)}</h3>
                        <div class="price" style="color: #ff7a00; font-size: 20px; font-weight: 800; margin-bottom: 8px;">฿${Number(product.price || 0).toLocaleString('th-TH', {minimumFractionDigits: 2})}</div>
                        <p class="muted" style="font-size: 13px; color: #68747a; margin-bottom: 15px; flex: 1;">${escapeHtml(product.description)}</p>
                        <a class="btn-primary" href="product_detail.html?id=${product.id}" style="display: block; text-align: center; background: #ff7a00; color: #fff; padding: 10px; border-radius: 6px; text-decoration: none; font-weight: 600;">ดูรายละเอียด</a>
                    </div>
                </article>`).join('');
        })
        .catch(error => {
            console.error(error);
            grid.innerHTML = '<p class="muted" style="grid-column: 1/-1; text-align: center; padding: 40px;">ไม่สามารถโหลดข้อมูลได้ กรุณาตรวจสอบการเชื่อมต่อฐานข้อมูล</p>';
        });

    function escapeHtml(value) {
        if (!value) return '';
        return String(value).replace(/[&<>'"]/g, character => ({
            '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;'
        }[character]));
    }
});