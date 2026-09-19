<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Maison Forme - ดีไซน์เฟอร์นิเจอร์และไลฟ์สไตล์ที่ลงตัว</title>
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
  }
  a { text-decoration: none; color: inherit; }
  img { max-width: 100%; display: block; }

  /* ---------- Ambient liquid background ---------- */
  .liquid-bg { position: fixed; inset: 0; z-index: -1; overflow: hidden; background: #f0f2f5; }
  .blob { position: absolute; border-radius: 50%; filter: blur(80px); will-change: transform; }
  .blob-1 { width: 50vw; height: 50vw; background: #ffaa55; opacity: 0.4; top: -10%; left: -10%; animation: driftA 20s alternate infinite ease-in-out; }
  .blob-2 { width: 45vw; height: 45vw; background: #5fc9e8; opacity: 0.4; top: 20%; right: -15%; animation: driftB 25s alternate infinite ease-in-out; }

  @keyframes driftA { 0% { transform: translate(0, 0) scale(1); } 100% { transform: translate(10%, 10%) scale(1.1); } }
  @keyframes driftB { 0% { transform: translate(0, 0) scale(1); } 100% { transform: translate(-10%, 10%) scale(1.15); } }

  /* ---------- Header: iOS Glass Pill ---------- */
  header { position: sticky; top: 14px; z-index: 1000; padding: 0 16px; margin-bottom: 6px; }
  .header-inner {
    max-width: 1280px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; gap: 20px;
    background: var(--glass-bg); backdrop-filter: var(--glass-blur); -webkit-backdrop-filter: var(--glass-blur);
    border: 1px solid var(--glass-border); border-radius: 999px; box-shadow: var(--shadow-ios); padding: 10px 12px 10px 22px;
  }
  .brand { color: var(--copper); font-size: 22px; font-weight: 900; letter-spacing: -0.5px; white-space: nowrap; }

  /* Search Box */
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
  .cart-btn {
    font-size: 19px; width: 42px; height: 42px; display: flex; align-items: center; justify-content: center;
    border-radius: 50%; background: rgba(255, 255, 255, 0.6); border: 1px solid var(--glass-border);
    position: relative; transition: all 0.2s;
  }
  .cart-btn:hover { background: rgba(255, 255, 255, 0.9); transform: scale(1.06); }
  .cart-badge {
    position: absolute; top: -3px; right: -3px; background: linear-gradient(135deg, var(--amber), var(--copper));
    color: #fff; font-size: 11px; font-weight: 800; min-width: 18px; height: 18px; line-height: 18px;
    padding: 0 4px; border-radius: 999px; text-align: center; border: 2px solid #fff; display: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
  }

  .account { position: relative; }
  .auth-links { display: flex; gap: 8px; align-items: center; }
  .auth-links a { font-size: 14px; font-weight: 600; padding: 9px 18px; border-radius: 999px; transition: all 0.2s; }
  .btn-login { color: var(--copper); background: rgba(255, 138, 30, 0.12); }
  .btn-login:hover { background: rgba(255, 138, 30, 0.2); }
  .btn-register { background: var(--ink); color: #fff !important; box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15); }
  .btn-register:hover { filter: brightness(1.1); transform: translateY(-1px); }

  .user-toggle-btn {
    border: 0; background: rgba(255, 138, 30, 0.12); color: var(--copper); font-weight: 700;
    cursor: pointer; font-family: 'Kanit', sans-serif; font-size: 14px; padding: 8px 16px;
    border-radius: 999px; display: flex; align-items: center; gap: 6px;
  }
  .account-menu {
    position: absolute; right: 0; top: calc(100% + 10px); z-index: 50; min-width: 200px;
    padding: 8px; background: rgba(255,255,255,0.95); backdrop-filter: blur(20px);
    border: 1px solid var(--glass-border); border-radius: var(--radius-md);
    box-shadow: var(--shadow-float); display: none;
  }
  .account-menu.open { display: block; animation: fadeIn 0.2s ease; }
  .account-menu a {
    display: block; padding: 10px 14px; color: var(--ink); font-size: 14px; border-radius: 10px;
    transition: background 0.15s; font-weight: 500;
  }
  .account-menu a:hover { background: rgba(255,138,30,0.1); color: var(--copper); }
  .account-menu .logout { color: #dc2626; border-top: 1px solid rgba(0,0,0,0.06); margin-top: 4px; padding-top: 10px; }
  .account-menu .logout:hover { background: #fee2e2; color: #b91c1c; }

  /* ---------- NEW: Image Slider Section ---------- */
  .slider-section {
    position: relative;
    width: 100%;
    max-width: 1920px;
    margin: 0 auto;
    height: 70vh; /* ความสูงของแบนเนอร์ ปรับได้ตามชอบ */
    min-height: 450px;
    max-height: 800px;
    overflow: hidden;
    margin-top: 10px;
  }
  .slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    transition: opacity 0.8s ease-in-out;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;
  }
  .slide.active { opacity: 1; z-index: 2; }
  
  .slide img {
    position: absolute; inset: 0;
    width: 100%; height: 100%;
    object-fit: cover; /* ทำให้รูปเต็มกรอบเสมอ */
    z-index: -1;
  }
  
  /* ตัวไล่สีดำๆ ดรอปความสว่างรูปภาพให้ข้อความอ่านง่ายขึ้น */
  .slide::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(to right, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.1) 100%);
    z-index: 0;
  }

  .slide-content {
    position: relative; z-index: 1;
    width: 100%; max-width: 1280px;
    padding: 0 40px;
    color: #fff;
    text-align: left;
  }
  
  .slide-content h1 { font-size: clamp(36px, 5vw, 64px); font-weight: 900; margin: 0 0 15px; line-height: 1.1; letter-spacing: -1px; text-shadow: 0 4px 12px rgba(0,0,0,0.3); }
  .slide-content p { font-size: clamp(16px, 2vw, 20px); font-weight: 300; margin: 0 0 30px; max-width: 600px; text-shadow: 0 2px 8px rgba(0,0,0,0.5); }
  
  .btn-slide {
    display: inline-block;
    background: linear-gradient(180deg, var(--amber), var(--amber-deep));
    color: #fff; padding: 14px 32px; border-radius: 999px;
    font-weight: 700; font-size: 16px;
    box-shadow: 0 10px 20px -5px rgba(255, 138, 30, 0.5); transition: transform 0.2s;
  }
  .btn-slide:hover { transform: translateY(-2px); filter: brightness(1.1); }

  /* Slider Controls (ลูกศร และ จุด) */
  .slider-nav {
    position: absolute; top: 50%; transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.4); color: #fff;
    width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-size: 20px; cursor: pointer; z-index: 10; transition: background 0.3s;
  }
  .slider-nav:hover { background: rgba(255, 255, 255, 0.4); }
  .slider-nav.prev { left: 30px; }
  .slider-nav.next { right: 30px; }

  .slider-dots {
    position: absolute; bottom: 30px; width: 100%; text-align: center; z-index: 10;
  }
  .dot {
    display: inline-block; width: 10px; height: 10px; margin: 0 6px;
    background: rgba(255, 255, 255, 0.4); border-radius: 50%; cursor: pointer; transition: all 0.3s ease;
  }
  .dot.active, .dot:hover { background: #fff; transform: scale(1.3); }

  /* ---------- Features Strip ---------- */
  .features-strip { max-width: 1080px; margin: -50px auto 60px; padding: 0 20px; position: relative; z-index: 10; }
  .features-grid {
    display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 18px;
    background: var(--glass-bg); backdrop-filter: var(--glass-blur); -webkit-backdrop-filter: var(--glass-blur);
    padding: 26px; border-radius: var(--radius-lg); box-shadow: var(--shadow-ios), var(--glass-highlight); border: 1px solid var(--glass-border);
  }
  .feature-item { display: flex; align-items: center; gap: 16px; }
  .feature-icon { width: 48px; height: 48px; background: rgba(255, 138, 30, 0.1); color: var(--copper); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 21px; flex-shrink: 0; }
  .feature-text h4 { margin: 0 0 2px; font-size: 15px; color: var(--ink); font-weight: 700; }
  .feature-text p { margin: 0; font-size: 13px; color: var(--ink-soft); }

  /* ---------- Product Grid (iOS Cards) ---------- */
  .container { max-width: 1280px; margin: 60px auto; padding: 0 24px; }
  .section-title { text-align: center; margin-bottom: 46px; }
  .section-title h2 { font-size: 32px; color: var(--ink); margin: 0 0 10px; font-weight: 800; letter-spacing: -0.5px; }
  
  .codemonday-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 26px; }
  .cm-card {
    background: var(--glass-bg); backdrop-filter: var(--glass-blur); -webkit-backdrop-filter: var(--glass-blur);
    border-radius: var(--radius-lg); padding: 30px 26px; box-shadow: var(--shadow-ios), var(--glass-highlight);
    border: 1px solid var(--glass-border); display: flex; flex-direction: column; justify-content: space-between;
    transition: transform 0.35s ease;
  }
  .cm-card:hover { transform: translateY(-6px); box-shadow: var(--shadow-float), var(--glass-highlight); background: rgba(255, 255, 255, 0.7); }
  .cm-img-container { width: 100%; height: 190px; display: flex; align-items: center; justify-content: center; margin-bottom: 22px; background: rgba(255, 255, 255, 0.5); border-radius: var(--radius-md); overflow: hidden; }
  .cm-img-container img { max-width: 90%; max-height: 90%; object-fit: contain; transition: transform 0.5s ease; }
  .cm-card:hover .cm-img-container img { transform: scale(1.05); }
  .cm-tag { display: inline-block; background: rgba(255, 138, 30, 0.1); color: var(--copper); padding: 4px 14px; border-radius: 999px; font-size: 12px; font-weight: 700; margin-bottom: 14px; }
  .cm-title { font-size: 20px; font-weight: 800; color: var(--ink); margin: 0 0 10px; line-height: 1.3; }
  .cm-desc { font-size: 14px; color: var(--ink-soft); margin: 0 0 26px; line-height: 1.6; flex: 1; }
  .cm-footer { display: flex; align-items: center; justify-content: space-between; font-weight: 700; font-size: 15px; color: var(--ink); cursor: pointer; padding-top: 15px; border-top: 1px solid rgba(0, 0, 0, 0.05); }
  .cm-arrow-btn { width: 38px; height: 38px; background: var(--ink); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.2s; }
  .cm-card:hover .cm-arrow-btn { background: var(--amber); transform: translateX(4px); }

  /* ---------- Footer ---------- */
  footer { padding: 0 16px 30px; margin-top: 80px; }
  .footer-panel { max-width: 1280px; margin: 0 auto; background: var(--glass-bg); backdrop-filter: var(--glass-blur); -webkit-backdrop-filter: var(--glass-blur); border: 1px solid var(--glass-border); box-shadow: var(--shadow-ios), var(--glass-highlight); border-radius: var(--radius-xl); padding: 46px 40px 26px; color: var(--ink-soft); }
  .footer-content { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px; padding-bottom: 26px; border-bottom: 1px solid rgba(0, 0, 0, 0.05); }
  .footer-brand { color: var(--ink); font-size: 22px; font-weight: 800; }
  .footer-copy { margin: 22px auto 0; text-align: center; font-size: 13px; color: var(--ink-faint); }

  /* Responsive */
  @media (max-width: 992px) {
    .header-inner { flex-wrap: wrap; justify-content: center; border-radius: 28px; }
    .search-form { order: 3; max-width: 100%; width: 100%; }
    nav { order: 2; overflow-x: auto; width: 100%; justify-content: center; padding-bottom: 4px; }
    .slider-section { height: 50vh; }
  }
  @media (max-width: 600px) {
    header { padding: 0 10px; top: 10px; }
    .slider-nav { display: none; } /* ซ่อนลูกศรในมือถือ */
    .slide-content { padding: 0 20px; text-align: center; }
    .slide::before { background: rgba(0,0,0,0.4); }
    .codemonday-grid { grid-template-columns: 1fr; }
  }
</style>
</head>
<body>

  <!-- Background Effect -->
  <div class="liquid-bg" aria-hidden="true">
    <span class="blob blob-1"></span><span class="blob blob-2"></span>
  </div>

  <!-- Header -->
  <header>
    <div class="header-inner">
      <a href="index.php" class="brand">Maison Forme</a>
      <form action="search.html" method="GET" class="search-form">
        <input type="text" name="keyword" placeholder="ค้นหาเฟอร์นิเจอร์ หรือสไตล์ที่ชอบ...">
        <button type="submit">ค้นหา</button>
      </form>
      <nav aria-label="เมนูหลัก">
        <a href="index.php" class="active">หน้าหลัก</a>
        <a href="products.html">สินค้า</a>
        <a href="furniture-designer.html">The Perfect Match</a>
        <a href="services.html">บริการ</a>
        <a href="promo.html">โปรโมชั่น</a>
      </nav>
      <div class="header-actions">
        <a href="cart.html" class="cart-btn" aria-label="ตะกร้าสินค้า">🛒<span class="cart-badge"></span></a>
        <div class="auth-links">
          <a href="login.html" class="btn-login">เข้าสู่ระบบ</a>
          <a href="register.html" class="btn-register">สมัครสมาชิก</a>
        </div>
      </div>
    </div>
  </header>

  <!-- Hero Image Slider Section -->
  <section class="slider-section">
    
    <!-- สไลด์ที่ 1 -->
    <div class="slide active">
      <!-- แก้ไข url รูปภาพตรงนี้ให้เป็นรูปที่คุณมี (เช่น images/banner1.jpg) -->
      <img src="images/home-1.jpg" alt="Banner 1">
      <div class="slide-content">
        <h1>ยกระดับพื้นที่อยู่อาศัยด้วย<br>เฟอร์นิเจอร์ดีไซน์พรีเมียม</h1>
        <p>ผสานงานออกแบบที่เป็นเอกลักษณ์เข้ากับการคัดสรรวัสดุชั้นเยี่ยม พร้อมระบบค้นหาสไตล์เฉพาะตัวคุณ</p>
        <a href="furniture-designer.html" class="btn-slide">🚀 เริ่มค้นหาสไตล์ที่ใช่ (The Perfect Match)</a>
      </div>
    </div>

    <!-- สไลด์ที่ 2 -->
    <div class="slide">
      <img src="images/home-2.jpg" alt="Banner 2">
      <div class="slide-content">
        <h1>KUKA HOME<br>ตอบโจทย์ทุกการพักผ่อน</h1>
        <p>สัมผัสความนุ่มสบายระดับโลก ด้วยหนังแท้นำเข้า ดีไซน์ทันสมัยเข้ากับทุกยุคทุกสมัย</p>
        <a href="products.html" class="btn-slide">ช้อปคอลเลกชันใหม่เลย</a>
      </div>
    </div>

    <!-- ปุ่มเลื่อนซ้าย-ขวา -->
    <button class="slider-nav prev" onclick="moveSlide(-1)">&#10094;</button>
    <button class="slider-nav next" onclick="moveSlide(1)">&#10095;</button>

    <!-- จุดวงกลมด้านล่าง (Pagination Dots) -->
    <div class="slider-dots">
      <span class="dot active" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
    </div>
  </section>

  <!-- Features Strip (ดันขึ้นไปซ้อนทับกรอบแบนเนอร์นิดนึงให้ดูมีมิติ) -->
  <div class="features-strip">
    <div class="features-grid">
      <div class="feature-item">
        <div class="feature-text"><h4>ดีไซน์พรีเมียม</h4><p>คัดสรรวัสดุคุณภาพสูง ทนทาน</p></div>
      </div>
      <div class="feature-item">
        <div class="feature-text"><h4>แมตช์ได้ทุกสไตล์</h4><p>ระบบค้นหาดีไซน์ที่เหมาะกับคุณ</p></div>
      </div>
      <div class="feature-item">

        <div class="feature-text"><h4>รับประกันมั่นใจ</h4><p>บริการหลังการขายระดับมืออาชีพ</p></div>
      </div>
    </div>
  </div>

  <!-- Main Content (Products Grid) -->
  <main class="container">
    <div class="section-title">
      <h2>คอลเลกชันยอดนิยม</h2>
      <p>ผลงานการออกแบบที่ผสมผสานความสวยงามและฟังก์ชันการใช้งานได้อย่างลงตัว</p>
    </div>

    <div class="codemonday-grid">
      <?php
      require_once __DIR__ . '/config/db.php';
      $conn = get_mysqli_connection();
      if ($conn) {
          // แสดงเฉพาะสินค้า 6 รายการแรกในหน้าหลัก
          $sql = "SELECT * FROM products ORDER BY created_at DESC, id DESC LIMIT 6";
          $result = $conn->query($sql);
          if ($result && $result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  $id    = (int)$row['id'];
                  $title = htmlspecialchars($row['name'] ?? '');
                  $desc  = htmlspecialchars($row['description'] ?? '');
                  $image = htmlspecialchars(trim($row['image'] ?? 'chair.jpg'));
                  $badge = htmlspecialchars($row['badge'] ?? 'Featured');
                  $price = number_format((float)($row['price'] ?? 0), 0, '.', ',');
                  echo '
                  <div class="cm-card">
                    <div>
                      <div class="cm-img-container">
                        <img src="images/'.$image.'" alt="'.$title.'" onerror="this.src=\'https://placehold.co/280x160/f4f5f7/86868b?text=Maison+Forme\';">
                      </div>
                      <span class="cm-tag">'.$badge.'</span>
                      <h3 class="cm-title">'.$title.'</h3>
                      <p class="cm-desc">'.$desc.'</p>
                    </div>
                    <a href="product_detail.html?id='.$id.'" class="cm-footer">
                      <span>฿'.$price.'</span>
                      <div class="cm-arrow-btn">→</div>
                    </a>
                  </div>';
              }
          } else {
              echo '<p style="text-align:center; grid-column: 1/-1; color: var(--ink-faint); padding: 40px;">ยังไม่มีรายการสินค้า</p>';
          }
          $conn->close();
      } else {
          echo '<p style="text-align:center; grid-column: 1/-1; color: var(--ink-faint); padding: 40px;">ไม่สามารถเชื่อมต่อฐานข้อมูลได้ในขณะนี้ <a href="products.html" style="color:var(--copper);font-weight:700;">ดูสินค้าทั้งหมด →</a></p>';
      }
      ?>
    </div>

    <!-- ปุ่มดูสินค้าทั้งหมด -->
    <div style="text-align:center; margin-top: 48px;">
      <a href="products.html" style="
        display: inline-flex; align-items: center; gap: 10px;
        background: var(--ink); color: #fff;
        padding: 16px 40px; border-radius: 999px;
        font-weight: 700; font-size: 16px;
        box-shadow: 0 10px 30px -8px rgba(0,0,0,0.25);
        transition: transform 0.2s, filter 0.2s;
        text-decoration: none;
      " onmouseover="this.style.transform='translateY(-3px)';this.style.filter='brightness(1.15)'" onmouseout="this.style.transform='';this.style.filter=''">ดูสินค้าทั้งหมด <span style="font-size:18px;">→</span></a>
    </div>
  </main>

  <!-- Footer -->
  <footer>
    <div class="footer-panel">
      <div class="footer-content">
        <div class="footer-brand">Maison Forme</div>
        <div style="font-size: 14px;">ยกระดับไลฟ์สไตล์บ้านคุณด้วยเฟอร์นิเจอร์ดีไซน์พรีเมียม</div>
      </div>
      <div class="footer-copy"><p>© 2026 Maison Forme | ร้านเฟอร์นิเจอร์ All Rights Reserved.</p></div>
    </div>
  </footer>

  <!-- สคริปต์ควบคุมการเลื่อน Slider -->
  <script>
    let slideIndex = 1;
    let slideTimer;

    function initSlider() {
      showSlides(slideIndex);
      startAutoPlay();
    }

    function moveSlide(n) {
      showSlides(slideIndex += n);
      resetAutoPlay();
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
      resetAutoPlay();
    }

    function showSlides(n) {
      let slides = document.getElementsByClassName("slide");
      let dots = document.getElementsByClassName("dot");
      if (slides.length === 0) return;
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      
      for (let i = 0; i < slides.length; i++) {
        slides[i].classList.remove("active");
      }
      for (let i = 0; i < dots.length; i++) {
        dots[i].classList.remove("active");
      }
      
      slides[slideIndex-1].classList.add("active");
      if(dots.length > 0) dots[slideIndex-1].classList.add("active");
    }

    function startAutoPlay() {
      // เลื่อนรูปอัตโนมัติทุกๆ 5 วินาที
      slideTimer = setInterval(function() {
        moveSlide(1);
      }, 5000); 
    }

    function resetAutoPlay() {
      clearInterval(slideTimer);
      startAutoPlay();
    }

    // เริ่มทำงานเมื่อเว็บโหลดเสร็จ
    document.addEventListener("DOMContentLoaded", initSlider);
  </script>
  <script src="site.js"></script>
  <script src="account.js?v=4"></script>
</body>
</html>
