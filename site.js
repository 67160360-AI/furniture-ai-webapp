document.addEventListener('DOMContentLoaded', () => {
    // ฟังก์ชันอัปเดต Badge จำนวนสินค้าในตะกร้าบน Header
    window.updateHeaderCartBadge = function() {
        const cart = JSON.parse(localStorage.getItem('furniture-cart') || '[]');
        const totalCount = cart.reduce((sum, item) => sum + Number(item.quantity || 0), 0);
        document.querySelectorAll('.cart-btn, a[aria-label="ตะกร้าสินค้า"]').forEach(btn => {
            let badge = btn.querySelector('.cart-badge');
            if (totalCount > 0) {
                if (!badge) {
                    badge = document.createElement('span');
                    badge.className = 'cart-badge';
                    btn.style.position = 'relative';
                    btn.appendChild(badge);
                }
                badge.textContent = totalCount > 99 ? '99+' : totalCount;
                badge.style.display = 'inline-flex';
            } else if (badge) {
                badge.style.display = 'none';
            }
        });
    };
    window.updateHeaderCartBadge();

    // Legacy Cart fallback (เฉพาะเมื่อไม่ใช่หน้า Modern Cart)
    if (!document.querySelector('#modernCart')) {
        const cart = JSON.parse(localStorage.getItem('furniture-cart') || '[]');
        const content = document.querySelector('main .content');
        const pageTitle = content?.querySelector('h1')?.textContent || '';
        if (content && pageTitle.includes('ตะกร้า') && cart.length) {
            const total = cart.reduce((sum, item) => sum + Number(item.price || 0) * Number(item.quantity || 0), 0);
            content.innerHTML = `<h1>🛒 ตะกร้าสินค้าของฉัน</h1><div class="grid" data-cart-items></div><div class="card" style="margin-top:25px;display:flex;justify-content:space-between;align-items:center;gap:20px;flex-wrap:wrap"><strong>รวมทั้งหมด: ฿${total.toLocaleString('th-TH', {minimumFractionDigits: 2})}</strong><a class="btn-primary" href="checkout.html">ดำเนินการชำระเงิน</a></div>`;
            content.querySelector('[data-cart-items]').innerHTML = cart.map(item => `<article class="card"><img src="images/${encodeURIComponent(item.image || 'chair.jpg')}" alt="${escapeHtml(item.name)}"><h3>${escapeHtml(item.name)}</h3><p>จำนวน ${Number(item.quantity || 0)} ชิ้น</p><p class="price">฿${(Number(item.price || 0) * Number(item.quantity || 0)).toLocaleString('th-TH', {minimumFractionDigits: 2})}</p></article>`).join('');
        }
    }

    const checkout = document.querySelector('main .two-col');
    if (checkout && !document.querySelector('#modernCart')) {
        const cart = JSON.parse(localStorage.getItem('furniture-cart') || '[]');
        if (cart.length) {
            const summary = checkout.querySelector('.card:last-child');
            if (summary) {
                const total = cart.reduce((sum, item) => sum + Number(item.price || 0) * Number(item.quantity || 0), 0);
                summary.innerHTML = `<h2>🛒 สรุปคำสั่งซื้อ</h2>${cart.map(item => `<p>${escapeHtml(item.name)} x ${Number(item.quantity || 0)} <strong>฿${(Number(item.price || 0) * Number(item.quantity || 0)).toLocaleString('th-TH', {minimumFractionDigits: 2})}</strong></p>`).join('')}<hr><p><strong>รวมทั้งหมด ฿${total.toLocaleString('th-TH', {minimumFractionDigits: 2})}</strong></p>`;
            }
        }
    }

    // Legacy Search fallback (เฉพาะเมื่อไม่ใช่หน้า Modern Search)
    if (!document.querySelector('#modernSearch')) {
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
    }

    function escapeHtml(value) {
        if (!value) return '';
        return String(value).replace(/[&<>'"]/g, character => ({
            '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#39;', '"': '&quot;'
        }[character]));
    }
});