<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>สินค้าทั้งหมด - Maison Forme</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
  :root {
    /* -- iOS Apple Style Tokens -- */
    --bg-base: #f4f5f7;
    --ink: #1d1d1f;
    --ink-soft: #86868b;
    --ink-faint: #a1a1a6;

    --amber: #ff8a1e;
    --amber-deep: #e6690a;
    --copper: #c2520a;

    /* Authentic iOS Frosted Glass */
    --glass-bg: rgba(255, 255, 255, 0.45);
    --glass-blur: blur(40px) saturate(200%);
    --glass-border: rgba(255, 255, 255, 0.8);
    --glass-highlight: inset 0 1px 0 rgba(255, 255, 255, 1);
    
    --radius-xl: 36px;
    --radius-lg: 28px;
    --radius-md: 20px;
    --radius-sm: 14px;

    --shadow-ios: 0 10px 40px -10px rgba(0, 0, 0, 0.08);
    --shadow-float: 0 24px 60px -20px rgba(0, 0, 0, 0.12);
  }

  * { box-sizing: border-box; }
  html { scroll-behavior: smooth; }
  body {
    margin: 0; padding: 0;
    font-family: 'Kanit', sans-serif;
    background: var(--bg-base); color: var(--ink);
    line-height: 1.7; min-height: 100vh; overflow-x: hidden;
    display: flex; flex-direction: column;
  }
  a { text-decoration: none; color: inherit; }
  img { max-width: 100%; display: block; }

  /* ---------- Ambient liquid background ---------- */
  .liquid-bg { position: fixed; inset: 0; z-index: -1; overflow: hidden; background: #f0f2f5; }
  .blob { position: absolute; border-radius: 50%; filter: blur(80px); will-change: transform; }
  .blob-1 { width: 50vw; height: 50vw; background: #ffaa55; opacity: 0.35; top: -10%; left: -10%; animation: driftA 20s alternate infinite ease-in-out; }
  .blob-2 { width: 45vw; height: 45vw; background: #5fc9e8; opacity: 0.35; top: 20%; right: -15%; animation: driftB 25s alternate infinite ease-in-out; }
  .blob-3 { width: 55vw; height: 55vw; background: #cba6f7; opacity: 0.3; bottom: -20%; left: 10%; animation: driftC 22s alternate infinite ease-in-out; }

  @keyframes driftA { 0% { transform: translate(0, 0) scale(1); } 100% { transform: translate(10%, 10%) scale(1.1); } }
  @keyframes driftB { 0% { transform: translate(0, 0) scale(1); } 100% { transform: translate(-10%, 10%) scale(1.15); } }
  @keyframes driftC { 0% { transform: translate(0, 0) scale(1); } 100% { transform: translate(10%, -10%) scale(1.05); } }

  /* ---------- Header: iOS Glass Pill ---------- */
  header { position: sticky; top: 14px; z-index: 1000; padding: 0 16px; margin-bottom: 30px; }
  .header-inner {
    max-width: 1280px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 20px;
    background: var(--glass-bg); backdrop-filter: var(--glass-blur); -webkit-backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border); border-radius: 999px; box-shadow: var(--shadow-ios); padding: 10px 12px 10px 22px;
  }
  .brand { color: var(--copper); font-size: 22px; font-weight: 900; letter-spacing: -0.5px; white-space: nowrap; }

  .search-form { display: flex; flex: 1; max-width: 280px; border: 1px solid rgba(0, 0, 0, 0.05); border-radius: 999px; overflow: hidden; background: rgba(255, 255, 255, 0.6); transition: all 0.3s ease; }
  .search-form:focus-within { border-color: var(--amber); box-shadow: 0 0 0 3px rgba(255, 138, 30, 0.18); background: rgba(255, 255, 255, 0.9); }
  .search-form input { flex: 1; border: 0; padding: 8px 16px; outline: none; font-family: 'Kanit', sans-serif; font-size: 13px; background: transparent; color: var(--ink); }
  .search-form button { background: linear-gradient(180deg, var(--amber), var(--amber-deep)); color: #fff; border: 0; padding: 0 18px; cursor: pointer; font-weight: 600; font-family: 'Kanit', sans-serif; transition: filter 0.2s; }
  .search-form button:hover { filter: brightness(1.08); }

  nav { display: flex; gap: 4px; align-items: center; }
  nav a { font-weight: 500; font-size: 14px; color: var(--ink-soft); white-space: nowrap; padding: 8px 14px; border-radius: 999px; transition: background 0.2s, color 0.2s; }
  nav a:hover { background: rgba(0, 0, 0, 0.04); color: var(--ink); }
  nav a.active { color: var(--copper); font-weight: 700; background: rgba(255, 138, 30, 0.14); }

  .header-actions { display: flex; align-items: center; gap: 10px; }
  .cart-btn { font-size: 19px; width: 42px; height: 42px; display: flex; align-items: center; justify-content: center; border-radius: 50%; background: rgba(255, 255, 255, 0.5); border: 1px solid var(--glass-border); transition: all 0.2s; }
  .auth-links { display: flex; gap: 8px; align-items: center; }
  .auth-links a { font-size: 14px; font-weight: 600; padding: 9px 18px; border-radius: 999px; transition: all 0.2s; }
  .btn-login { color: var(--copper); background: rgba(255, 138, 30, 0.12); }
  .btn-register { background: var(--ink); color: #fff !important; }

  /* ---------- Page Header (Glass Panel) ---------- */
  .page-header {
    max-width: 1280px; margin: 0 auto 40px; padding: 0 24px; text-align: center;
  }
  .page-header-glass {
    background: var(--glass-bg); backdrop-filter: var(--glass-blur); -webkit-backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border); box-shadow: var(--shadow-ios), var(--glass-highlight);
    border-radius: var(--radius-lg); padding: 50px 30px; position: relative; overflow: hidden;
  }
  .page-header-glass h1 { font-size: clamp(28px, 4vw, 42px); margin: 0 0 10px; font-weight: 900; letter-spacing: -1px; }
  .page-header-glass p { font-size: 16px; color: var(--ink-soft); margin: 0; }

  /* ---------- Filters (iOS Segmented Control Style) ---------- */
  .filter-container {
    max-width: 1280px; margin: 0 auto 40px; padding: 0 24px;
    display: flex; justify-content: center;
  }
  .filter-glass {
    display: inline-flex; flex-wrap: wrap; justify-content: center; gap: 8px;
    background: var(--glass-bg); backdrop-filter: var(--glass-blur); -webkit-backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border); box-shadow: var(--shadow-ios);
    border-radius: 999px; padding: 8px 12px;
  }
  .filter-btn {
    background: transparent; border: 0; color: var(--ink-soft);
    font-family: 'Kanit', sans-serif; font-size: 14px; font-weight: 600;
    padding: 8px 20px; border-radius: 999px; cursor: pointer; transition: all 0.3s ease;
  }
  .filter-btn:hover { color: var(--ink); background: rgba(0, 0, 0, 0.04); }
  .filter-btn.active { background: #fff; color: var(--ink); box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }

  /* ---------- Product Grid (iOS Cards) ---------- */
  .container { max-width: 1280px; margin: 0 auto; padding: 0 24px; flex: 1; width: 100%; }
  
  .codemonday-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 26px; margin-bottom: 60px; }
  
  .cm-card {
    background: var(--glass-bg); backdrop-filter: var(--glass-blur); -webkit-backdrop-filter: var(--glass-blur);
    border-radius: var(--radius-lg); padding: 30px 26px; box-shadow: var(--shadow-ios), var(--glass-highlight);
    border: 1px solid var(--glass-border); display: flex; flex-direction: column; justify-content: space-between;
    transition: transform 0.35s ease;
  }
  .cm-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-float), var(--glass-highlight); background: rgba(255, 255, 255, 0.7); }
  
  .cm-img-container { width: 100%; height: 190px; display: flex; align-items: center; justify-content: center; margin-bottom: 22px; background: rgba(255, 255, 255, 0.5); border-radius: var(--radius-md); overflow: hidden; position: relative; }
  .cm-img-container img { max-width: 90%; max-height: 90%; object-fit: contain; transition: transform 0.5s ease; }
  .cm-card:hover .cm-img-container img { transform: scale(1.05); }
  
  .cm-tag { display: inline-block; background: rgba(255, 138, 30, 0.1); color: var(--copper); padding: 4px 14px; border-radius: 999px; font-size: 12px; font-weight: 700; margin-bottom: 14px; }
  .cm-title { font-size: 20px; font-weight: 800; color: var(--ink); margin: 0 0 5px; line-height: 1.3; }
  .cm-price { font-size: 18px; font-weight: 800; color: var(--copper); margin-bottom: 12px; }
  .cm-desc { font-size: 14px; color: var(--ink-soft); margin: 0 0 26px; line-height: 1.6; flex: 1; }
  
  .cm-footer { display: flex; align-items: center; justify-content: space-between; font-weight: 700; font-size: 15px; color: var(--ink); cursor: pointer; padding-top: 15px; border-top: 1px solid rgba(0, 0, 0, 0.05); }
  .cm-arrow-btn { width: 38px; height: 38px; background: var(--ink); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.2s; }
  .cm-card:hover .cm-arrow-btn { background: var(--amber); transform: translateX(4px); }

  /* ---------- Footer: Clear Glass Panel ---------- */
  footer { padding: 0 16px 30px; margin-top: auto; }
  .footer-panel {
    max-width: 1280px; margin: 0 auto;
    background: var(--glass-bg); backdrop-filter: var(--glass-blur); -webkit-backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border); box-shadow: var(--shadow-ios), var(--glass-highlight); border-radius: var(--radius-xl);
    padding: 46px 40px 26px; color: var(--ink-soft);
  }
  .footer-content {
    display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; padding-bottom: 26px; border-bottom: 1px solid rgba(0, 0, 0, 0.05);
  }
  .footer-brand { color: var(--ink); font-size: 22px; font-weight: 800; }
  .footer-copy { margin: 22px auto 0; text-align: center; font-size: 13px; color: var(--ink-faint); }

  /* Responsive */
  @media (max-width: 992px) {
    .header-inner { flex-wrap: wrap; justify-content: center; border-radius: 28px; }
    .search-form { order: 3; max-width: 100%; width: 100%; }
    nav { order: 2; overflow-x: auto; width: 100%; justify-content: center; padding-bottom: 4px; }
  }
  @media (max-width: 600px) {
    header { padding: 0 10px; top: 10px; }
    .page-header-glass { padding: 40px 20px; }
    .filter-glass { border-radius: 20px; padding: 12px; flex-wrap: wrap; }
    .filter-btn { flex: 1 1 45%; text-align: center; }
  }
</style>
</head>
<body>

  <!-- Ambient liquid glass background -->
  <div class="liquid-bg" aria-hidden="true">
    <span class="blob blob-1"></span>
    <span class="blob blob-2"></span>
    <span class="blob blob-3"></span>
  </div>

  <!-- Header & Navbar -->
  <header>
    <div class="header-inner">
      <a href="index.php" class="brand">Maison Forme</a>

      <form action="search.html" method="GET" class="search-form">
        <input type="text" name="keyword" placeholder="ค้นหาเฟอร์นิเจอร์ หรือสไตล์ที่ชอบ...">
        <button type="submit">ค้นหา</button>
      </form>

      <nav aria-label="เมนูหลัก">
        <a href="index.php">หน้าหลัก</a>
        <a href="products.html" class="active">สินค้า</a>
        <a href="furniture-designer.html">The Perfect Match</a>
        <a href="services.html">บริการ</a>
        <a href="promo.html">โปรโมชั่น</a>
      </nav>

      <div class="header-actions">
        <a href="cart.html" class="cart-btn" aria-label="ตะกร้าสินค้า">🛒</a>
        <div class="auth-links">
          <a href="login.html" class="btn-login">เข้าสู่ระบบ</a>
          <a href="register.html" class="btn-register">สมัครสมาชิก</a>
        </div>
      </div>
    </div>
  </header>

  <!-- Page Header (Frosted Panel) -->
  <section class="page-header">
    <div class="page-header-glass">
      <h1>คอลเลกชันเฟอร์นิเจอร์ทั้งหมด</h1>
      <p>ค้นพบดีไซน์ที่ใช่ เติมเต็มทุกพื้นที่ในบ้านคุณด้วยเฟอร์นิเจอร์พรีเมียม</p>
    </div>
  </section>

  <!-- Category Filters (iOS Segmented Style) -->
  <div class="filter-container">
    <div class="filter-glass">
      <button class="filter-btn active">🌟 ทั้งหมด</button>
      <button class="filter-btn">🛋️ ห้องนั่งเล่น</button>
      <button class="filter-btn">🛏️ ห้องนอน</button>
      <button class="filter-btn">🍽️ ห้องรับประทานอาหาร</button>
      <button class="filter-btn">💼 ห้องทำงาน</button>
    </div>
  </div>

  <!-- Main Content (Products Grid from PHP) -->
  <main class="container">
    <div class="codemonday-grid">
      <?php
      // เชื่อมต่อฐานข้อมูล MySQL
      $conn = new mysqli("localhost", "root", "", "furniture_db");
      if (!$conn->connect_error) {
          // ดึงข้อมูลสินค้าจากตาราง products
          $sql = "SELECT * FROM products ORDER BY id DESC";
          $result = $conn->query($sql);

          if ($result && $result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  $title = htmlspecialchars($row['title'] ?? $row['name'] ?? 'สินค้าแนะนำ');
                  $desc = htmlspecialchars($row['description'] ?? 'รายละเอียดสินค้า');
                  $image = htmlspecialchars($row['image'] ?? 'chair.jpg');
                  $badge = htmlspecialchars($row['badge'] ?? 'Featured');
                  $price = number_format($row['price'] ?? 0, 2);

                  echo '
                  <div class="cm-card">
                    <div>
                      <div class="cm-img-container">
                        <img src="images/'.$image.'" alt="'.$title.'" onerror="this.src=\'https://via.placeholder.com/280x160?text=Maison+Forme\';">
                      </div>
                      <span class="cm-tag">'.$badge.'</span>
                      <h3 class="cm-title">'.$title.'</h3>
                      <div class="cm-price">฿'.$price.'</div>
                      <p class="cm-desc">'.$desc.'</p>
                    </div>
                    <a href="product_detail.html?id='.$row['id'].'" class="cm-footer">
                      <span>ดูรายละเอียด</span>
                      <div class="cm-arrow-btn">+</div>
                    </a>
                  </div>';
              }
          } else {
              echo '<p style="text-align:center; grid-column: 1/-1; color: var(--ink-faint); padding: 40px;">ยังไม่มีรายการสินค้าในระบบ</p>';
          }
          $conn->close();
      }
      ?>
    </div>
  </main>

  <!-- Footer -->
  <footer>
    <div class="footer-panel">
      <div class="footer-content">
        <div class="footer-brand">Maison Forme</div>
        <div style="font-size: 14px;">ยกระดับไลฟ์สไตล์บ้านคุณด้วยเฟอร์นิเจอร์ดีไซน์พรีเมียม</div>
      </div>
      <div class="footer-copy">
        <p>© 2026 Maison Forme | ร้านเฟอร์นิเจอร์ All Rights Reserved.</p>
      </div>
    </div>
  </footer>

</body>
</html>