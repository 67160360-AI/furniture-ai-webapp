document.addEventListener('DOMContentLoaded', () => {
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id') || '1';
    const image = document.querySelector('#productImage');
    const name = document.querySelector('#productName');
    const price = document.querySelector('#productPrice');
    const description = document.querySelector('#productDescription');
    const form = document.querySelector('#addToCartForm');

    fetch(`api_product.php?id=${encodeURIComponent(id)}`)
        .then(response => {
            if (!response.ok) throw new Error('ไม่พบสินค้า');
            return response.json();
        })
        .then(product => {
            document.title = `${product.name} - Maison Forme`;
            name.textContent = product.name;
            price.textContent = `฿${Number(product.price).toLocaleString('th-TH', {minimumFractionDigits: 2})}`;
            description.textContent = product.description;
            image.src = `images/${encodeURIComponent(product.image)}`;
            image.alt = product.name;
            form.addEventListener('submit', event => {
                event.preventDefault();
                const quantity = Math.max(1, Number(document.querySelector('#productQty').value) || 1);
                const cart = JSON.parse(localStorage.getItem('furniture-cart') || '[]');
                const existing = cart.find(item => item.id === product.id);
                if (existing) existing.quantity += quantity;
                else cart.push({id: product.id, name: product.name, price: Number(product.price), image: product.image, quantity});
                localStorage.setItem('furniture-cart', JSON.stringify(cart));
                alert('เพิ่มสินค้าลงตะกร้าแล้ว');
            });
        })
        .catch(error => {
            name.textContent = error.message;
            description.textContent = 'กรุณากลับไปเลือกสินค้าจากคอลเลกชัน';
        });
});
