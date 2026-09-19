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
    /* -- Liquid Glass tokens -- */
    --bg-base: #eef1f7;
    --ink: #171a26;
    --ink-soft: #4c536a;
    --ink-faint: #838ba1;

    --amber: #ff8a1e;
    --amber-deep: #e6690a;
    --copper: #c2520a;
    --sky: #5fc9e8;
    --violet: #a78bfa;

    --glass: rgba(255, 255, 255, 0.5);
    --glass-strong: rgba(255, 255, 255, 0.72);
    --glass-border: rgba(255, 255, 255, 0.65);
    --glass-hairline: rgba(255, 255, 255, 0.85);

    --glass-dark: rgba(17, 19, 32, 0.58);
    --glass-dark-strong: rgba(14, 16, 27, 0.72);
    --glass-dark-border: rgba(255, 255, 255, 0.14);

    --radius-xl: 36px;
    --radius-lg: 28px;
    --radius-md: 20px;
    --radius-sm: 14px;

    --shadow-glass: 0 8px 32px -8px rgba(30, 40, 80, 0.18), inset 0 1px 0 rgba(255, 255, 255, 0.6);
    --shadow-glass-dark: 0 20px 60px -20px rgba(0, 0, 0, 0.55), inset 0 1px 0 rgba(255, 255, 255, 0.1);
    --shadow-float: 0 24px 60px -20px rgba(30, 40, 80, 0.22);
  }

  * { box-sizing: border-box; }
  html { scroll-behavior: smooth; }
  body {
    margin: 0;
    padding: 0;
    font-family: 'Kanit', sans-serif;
    background: var(--bg-base);
    color: var(--ink);
    line-height: 1.7;
    min-height: 100vh;
  }
  a { text-decoration: none; color: inherit; }
  img { max-width: 100%; display: block; }

  ::selection { background: rgba(255, 138, 30, 0.25); }

  /* focus visibility for accessibility */
  a:focus-visible, button:focus-visible, input:focus-visible {
    outline: 2px solid var(--amber);
    outline-offset: 2px;
  }

  /* ---------- Ambient liquid background ---------- */
  .liquid-bg {
    position: fixed;
    inset: 0;
    z-index: -1;
    overflow: hidden;
    background:
      radial-gradient(circle at 15% 10%, rgba(255, 138, 30, 0.10), transparent 45%),
      radial-gradient(circle at 85% 20%, rgba(95, 201, 232, 0.12), transparent 45%),
      var(--bg-base);
  }
  .blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(90px);
    will-change: transform;
  }
  .blob-1 { width: 520px; height: 520px; background: var(--amber); opacity: 0.35; top: -140px; left: -120px; animation: driftA 26s ease-in-out infinite; }
  .blob-2 { width: 460px; height: 460px; background: var(--sky); opacity: 0.30; top: 180px; right: -160px; animation: driftB 32s ease-in-out infinite; }
  .blob-3 { width: 480px; height: 480px; background: var(--violet); opacity: 0.28; bottom: -200px; left: 18%; animation: driftC 30s ease-in-out infinite; }
  .blob-4 { width: 320px; height: 320px; background: var(--amber-deep); opacity: 0.22; bottom: 60px; right: 12%; animation: driftA 22s ease-in-out infinite reverse; }

  @keyframes driftA {
    0%, 100% { transform: translate(0, 0) scale(1); }
    50% { transform: translate(50px, 40px) scale(1.12); }
  }
  @keyframes driftB {
    0%, 100% { transform: translate(0, 0) scale(1); }
    50% { transform: translate(-60px, 50px) scale(1.08); }
  }
  @keyframes driftC {
    0%, 100% { transform: translate(0, 0) scale(1); }
    50% { transform: translate(40px, -50px) scale(1.15); }
  }
  @media (prefers-reduced-motion: reduce) {
    .blob { animation: none !important; }
    html { scroll-behavior: auto; }
  }

  /* ---------- Header: floating glass pill ---------- */
  header {
    position: sticky;
    top: 14px;
    z-index: 1000;
    padding: 0 16px;
    margin-bottom: 6px;
  }
  .header-inner {
    max-width: 1280px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    background: var(--glass);
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
    border: 1px solid var(--glass-border);
    border-radius: 999px;
    box-shadow: var(--shadow-glass);
    padding: 10px 12px 10px 22px;
  }
  .brand {
    color: var(--copper);
    font-size: 22px;
    font-weight: 900;
    letter-spacing: -0.5px;
    white-space: nowrap;
  }

  /* Search Box */
  .search-form {
    display: flex;
    flex: 1;
    max-width: 280px;
    border: 1px solid rgba(255, 255, 255, 0.7);
    border-radius: 999px;
    overflow: hidden;
    background: rgba(255, 255, 255, 0.45);
    backdrop-filter: blur(6px);
    transition: all 0.3s ease;
  }
  .search-form:focus-within {
    border-color: var(--amber);
    box-shadow: 0 0 0 3px rgba(255, 138, 30, 0.18);
    background: rgba(255, 255, 255, 0.7);
  }
  .search-form input {
    flex: 1;
    border: 0;
    padding: 8px 16px;
    outline: none;
    font-family: 'Kanit', sans-serif;
    font-size: 13px;
    background: transparent;
    color: var(--ink);
  }
  .search-form input::placeholder { color: var(--ink-faint); }
  .search-form button {
    background: linear-gradient(180deg, var(--amber), var(--amber-deep));
    color: #fff;
    border: 0;
    padding: 0 18px;
    cursor: pointer;
    font-weight: 600;
    font-family: 'Kanit', sans-serif;
    transition: filter 0.2s;
  }
  .search-form button:hover { filter: brightness(1.08); }

  /* Navigation Links */
  nav {
    display: flex;
    gap: 4px;
    align-items: center;
  }
  nav a {
    font-weight: 500;
    font-size: 14px;
    color: var(--ink-soft);
    white-space: nowrap;
    padding: 8px 14px;
    border-radius: 999px;
    transition: background 0.2s, color 0.2s;
  }
  nav a:hover { background: rgba(255, 255, 255, 0.6); color: var(--ink); }
  nav a.active {
    color: var(--copper);
    font-weight: 700;
    background: rgba(255, 138, 30, 0.14);
  }

  /* Cart & Auth */
  .header-actions {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .cart-btn {
    font-size: 19px;
    position: relative;
    width: 42px; height: 42px;
    display: flex; align-items: center; justify-content: center;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    border: 1px solid var(--glass-border);
    transition: background 0.2s, transform 0.2s;
  }
  .cart-btn:hover { background: rgba(255, 255, 255, 0.8); transform: translateY(-1px); }
  .auth-links {
    display: flex;
    gap: 8px;
    align-items: center;
  }
  .auth-links a {
    font-size: 14px;
    font-weight: 600;
    padding: 9px 18px;
    border-radius: 999px;
    transition: all 0.2s;
  }
  .btn-login { color: var(--copper); background: rgba(255, 138, 30, 0.12); }
  .btn-login:hover { background: rgba(255, 138, 30, 0.2); }
  .btn-register {
    background: linear-gradient(180deg, #232838, var(--ink));
    color: #fff !important;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15);
  }
  .btn-register:hover { filter: brightness(1.2); }

  /* ---------- Hero: smoked glass panel ---------- */
  .hero {
    padding: 56px 16px 0;
  }
  .hero-panel {
    max-width: 980px;
    margin: 0 auto;
    background: var(--glass-dark);
    backdrop-filter: blur(28px) saturate(160%);
    -webkit-backdrop-filter: blur(28px) saturate(160%);
    border: 1px solid var(--glass-dark-border);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-glass-dark);
    padding: 68px 48px;
    text-align: center;
    color: #fff;
    position: relative;
    overflow: hidden;
    isolation: isolate;
  }
  .hero-panel::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(115deg, rgba(255, 255, 255, 0.14) 0%, transparent 30%, transparent 70%, rgba(255, 255, 255, 0.06) 100%);
    pointer-events: none;
    z-index: -1;
  }
  .hero-content {
    max-width: 720px;
    margin: 0 auto;
    position: relative;
  }
  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255, 138, 30, 0.16);
    color: #ffb066;
    padding: 7px 18px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 22px;
    border: 1px solid rgba(255, 138, 30, 0.35);
  }
  .hero h1 {
    font-size: clamp(32px, 4.6vw, 52px);
    margin: 0 0 20px;
    font-weight: 800;
    letter-spacing: -1px;
    line-height: 1.22;
  }
  .hero p {
    font-size: clamp(15px, 1.8vw, 18px);
    color: #b7bcce;
    margin: 0 0 36px;
    font-weight: 300;
  }
  .hero-btns {
    display: flex;
    justify-content: center;
    gap: 14px;
    flex-wrap: wrap;
  }
  .btn-hero-primary {
    background: linear-gradient(180deg, var(--amber) 0%, var(--amber-deep) 100%);
    color: #fff;
    padding: 15px 30px;
    border-radius: 999px;
    font-weight: 700;
    box-shadow: 0 14px 30px -8px rgba(255, 138, 30, 0.5), inset 0 1px 0 rgba(255, 255, 255, 0.35);
    transition: transform 0.2s, filter 0.2s;
  }
  .btn-hero-primary:hover {
    filter: brightness(1.06);
    transform: translateY(-2px);
  }
  .btn-hero-outline {
    background: rgba(255, 255, 255, 0.08);
    color: #fff;
    border: 1px solid rgba(255, 255, 255, 0.22);
    padding: 15px 30px;
    border-radius: 999px;
    font-weight: 600;
    backdrop-filter: blur(6px);
    transition: all 0.2s;
  }
  .btn-hero-outline:hover {
    background: rgba(255, 255, 255, 0.15);
    border-color: rgba(255, 255, 255, 0.4);
    transform: translateY(-2px);
  }

  /* ---------- Features Strip: floating glass cards ---------- */
  .features-strip {
    max-width: 1080px;
    margin: -34px auto 70px;
    padding: 0 20px;
    position: relative;
    z-index: 10;
  }
  .features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 18px;
    background: var(--glass-strong);
    backdrop-filter: blur(22px) saturate(180%);
    -webkit-backdrop-filter: blur(22px) saturate(180%);
    padding: 26px;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-float);
    border: 1px solid var(--glass-hairline);
  }
  .feature-item {
    display: flex;
    align-items: center;
    gap: 16px;
  }
  .feature-icon {
    width: 48px; height: 48px;
    background: rgba(255, 138, 30, 0.14);
    color: var(--copper);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 21px;
    flex-shrink: 0;
    border: 1px solid rgba(255, 138, 30, 0.2);
  }
  .feature-text h4 { margin: 0 0 2px; font-size: 15px; color: var(--ink); font-weight: 700; }
  .feature-text p { margin: 0; font-size: 13px; color: var(--ink-faint); }

  /* ---------- Product Grid ---------- */
  .container {
    max-width: 1280px;
    margin: 60px auto;
    padding: 0 24px;
  }
  .section-title {
    text-align: center;
    margin-bottom: 46px;
  }
  .section-title h2 {
    font-size: 32px;
    color: var(--ink);
    margin: 0 0 10px;
    font-weight: 800;
    letter-spacing: -0.5px;
  }
  .section-title p {
    color: var(--ink-faint);
    font-size: 16px;
    margin: 0;
  }

  .codemonday-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 26px;
  }

  /* Glass Product Card */
  .cm-card {
    background: var(--glass-strong);
    backdrop-filter: blur(18px) saturate(160%);
    -webkit-backdrop-filter: blur(18px) saturate(160%);
    border-radius: var(--radius-lg);
    padding: 30px 26px;
    box-shadow: var(--shadow-glass);
    border: 1px solid var(--glass-hairline);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform 0.35s ease, box-shadow 0.35s ease, background 0.35s ease;
    position: relative;
    overflow: hidden;
  }
  .cm-card::after {
    content: '';
    position: absolute;
    top: -60%; left: -60%;
    width: 60%; height: 220%;
    background: linear-gradient(115deg, rgba(255, 255, 255, 0.55), transparent 60%);
    transform: rotate(20deg);
    transition: transform 0.7s ease;
    pointer-events: none;
  }
  .cm-card:hover::after { transform: rotate(20deg) translateX(220%); }
  .cm-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-float);
    background: rgba(255, 255, 255, 0.85);
  }

  .cm-img-container {
    width: 100%;
    height: 190px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 22px;
    background: rgba(255, 255, 255, 0.4);
    border-radius: var(--radius-md);
    overflow: hidden;
    border: 1px solid rgba(255, 255, 255, 0.6);
  }
  .cm-img-container img {
    max-width: 90%;
    max-height: 90%;
    object-fit: contain;
    transition: transform 0.5s ease;
  }
  .cm-card:hover .cm-img-container img { transform: scale(1.05); }

  .cm-tag {
    display: inline-block;
    background: rgba(255, 138, 30, 0.14);
    color: var(--copper);
    padding: 4px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 14px;
    width: fit-content;
    border: 1px solid rgba(255, 138, 30, 0.2);
  }

  .cm-title {
    font-size: 21px;
    font-weight: 800;
    color: var(--ink);
    margin: 0 0 10px;
    line-height: 1.3;
  }
  .cm-desc {
    font-size: 14px;
    color: var(--ink-soft);
    margin: 0 0 26px;
    line-height: 1.6;
    flex: 1;
  }

  .cm-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-weight: 700;
    font-size: 15px;
    color: var(--ink);
    cursor: pointer;
    padding-top: 15px;
    border-top: 1px solid rgba(0, 0, 0, 0.08);
  }
  .cm-arrow-btn {
    width: 38px; height: 38px;
    background: rgba(23, 26, 38, 0.9);
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s, transform 0.2s;
    flex-shrink: 0;
  }
  .cm-card:hover .cm-arrow-btn {
    background: linear-gradient(180deg, var(--amber), var(--amber-deep));
    transform: translateX(4px);
  }

  /* ---------- Footer: smoked glass shell ---------- */
  footer {
    padding: 0 16px 30px;
    margin-top: 130px;
  }
  .footer-panel {
    max-width: 1280px;
    margin: 0 auto;
    background: var(--glass-dark-strong);
    backdrop-filter: blur(24px) saturate(160%);
    -webkit-backdrop-filter: blur(24px) saturate(160%);
    border: 1px solid var(--glass-dark-border);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-glass-dark);
    padding: 46px 40px 26px;
    color: #aeb3c6;
  }
  .footer-content {
    max-width: 1280px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
    padding-bottom: 26px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.12);
  }
  .footer-brand { color: #fff; font-size: 22px; font-weight: 800; }
  .footer-copy {
    max-width: 1280px;
    margin: 22px auto 0;
    text-align: center;
    font-size: 13px;
    color: #6d7288;
  }

  /* ---------- Responsive ---------- */
  @media (max-width: 992px) {
    .header-inner { flex-wrap: wrap; justify-content: center; border-radius: 28px; }
    .search-form { order: 3; max-width: 100%; width: 100%; }
    nav { order: 2; overflow-x: auto; width: 100%; justify-content: center; padding-bottom: 4px; }
  }
  @media (max-width: 600px) {
    header { padding: 0 10px; top: 10px; }
    .hero { padding: 40px 10px 0; }
    .hero-panel { padding: 44px 22px; border-radius: var(--radius-lg); }
    .codemonday-grid { grid-template-columns: 1fr; }
    .footer-panel { padding: 34px 22px 20px; border-radius: var(--radius-lg); }
  }

  /* ---------- The Perfect Match Studio & Wizard Styles ---------- */
  .designer-studio-section {
    max-width: 1280px;
    margin: 40px auto 30px;
    padding: 0 16px;
  }
  .studio-card {
    background: var(--glass-strong);
    backdrop-filter: blur(24px) saturate(180%);
    -webkit-backdrop-filter: blur(24px) saturate(180%);
    border: 1px solid var(--glass-border);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-float);
    padding: 44px;
    margin-bottom: 40px;
    position: relative;
    overflow: hidden;
  }
  .studio-header {
    text-align: center;
    max-width: 760px;
    margin: 0 auto 36px;
  }
  .studio-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 138, 30, 0.12);
    color: var(--copper);
    padding: 6px 18px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 700;
    margin-bottom: 12px;
    border: 1px solid rgba(255, 138, 30, 0.3);
  }
  .studio-header h2 {
    font-size: clamp(26px, 3.2vw, 36px);
    color: var(--ink);
    margin: 0 0 10px;
    font-weight: 800;
  }
  .studio-header p {
    color: var(--ink-soft);
    font-size: 15px;
    margin: 0;
  }

  /* Step Progress Bar */
  .wizard-progress {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 12px;
    margin-bottom: 34px;
    flex-wrap: wrap;
  }
  .step-indicator-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 600;
    color: var(--ink-faint);
    padding: 8px 18px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.6);
    border: 1px solid rgba(0,0,0,0.06);
    transition: all 0.3s;
  }
  .step-indicator-item.active {
    color: #fff;
    background: linear-gradient(135deg, var(--amber), var(--amber-deep));
    box-shadow: 0 4px 14px rgba(255, 138, 30, 0.35);
    border-color: transparent;
  }
  .step-indicator-item.completed {
    color: var(--copper);
    background: rgba(255, 138, 30, 0.14);
    border-color: rgba(255, 138, 30, 0.3);
  }

  /* Wizard Options Grid */
  .wizard-step-content h3 {
    text-align: center;
    font-size: 20px;
    font-weight: 700;
    margin: 0 0 8px;
    color: var(--ink);
  }
  .wizard-step-subtitle {
    text-align: center;
    color: var(--ink-soft);
    font-size: 14px;
    margin: 0 0 26px;
  }
  .wizard-options-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 18px;
    margin-bottom: 32px;
  }
  .wizard-card-option {
    background: rgba(255, 255, 255, 0.65);
    border: 2px solid rgba(255, 255, 255, 0.8);
    border-radius: var(--radius-md);
    padding: 24px 20px;
    cursor: pointer;
    transition: all 0.25s ease;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    position: relative;
  }
  .wizard-card-option:hover {
    transform: translateY(-4px);
    background: #fff;
    border-color: rgba(255, 138, 30, 0.4);
    box-shadow: 0 12px 28px -6px rgba(30, 40, 80, 0.12);
  }
  .wizard-card-option.selected {
    background: #fff;
    border-color: var(--amber);
    box-shadow: 0 10px 30px -5px rgba(255, 138, 30, 0.3), inset 0 0 0 1px var(--amber);
    transform: translateY(-2px);
  }
  .wizard-card-option .opt-icon {
    font-size: 34px;
    margin-bottom: 4px;
  }
  .wizard-card-option .opt-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--ink);
    margin: 0;
  }
  .wizard-card-option .opt-desc {
    font-size: 12.5px;
    color: var(--ink-soft);
    line-height: 1.45;
    margin: 0;
  }

  /* Wizard Controls */
  .wizard-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    border-top: 1px solid rgba(0,0,0,0.06);
    padding-top: 24px;
  }
  .btn-wizard-prev {
    background: rgba(255, 255, 255, 0.7);
    color: var(--ink);
    border: 1px solid var(--glass-border);
    padding: 10px 24px;
    border-radius: 999px;
    font-weight: 600;
    font-family: inherit;
    cursor: pointer;
    transition: all 0.2s;
  }
  .btn-wizard-prev:hover { background: #fff; }
  .btn-wizard-next, .btn-wizard-submit {
    background: linear-gradient(180deg, var(--amber), var(--amber-deep));
    color: #fff;
    border: 0;
    padding: 12px 30px;
    border-radius: 999px;
    font-weight: 700;
    font-size: 15px;
    font-family: inherit;
    cursor: pointer;
    box-shadow: 0 8px 20px rgba(255, 138, 30, 0.3);
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }
  .btn-wizard-next:hover, .btn-wizard-submit:hover {
    filter: brightness(1.08);
    transform: translateY(-2px);
    box-shadow: 0 12px 26px rgba(255, 138, 30, 0.4);
  }

  /* Result Header Card */
  .res-header-card {
    background: var(--glass-dark);
    color: #fff;
    border-radius: var(--radius-lg);
    padding: 36px 32px;
    margin-bottom: 28px;
    box-shadow: var(--shadow-glass-dark);
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 28px;
    align-items: center;
  }
  .res-badge-wrap {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
  }
  .match-score-badge {
    background: linear-gradient(135deg, #10b981, #059669);
    color: #fff;
    padding: 5px 14px;
    border-radius: 999px;
    font-weight: 800;
    font-size: 13px;
    letter-spacing: 0.5px;
  }
  .res-style-title {
    font-size: clamp(22px, 3vw, 30px);
    font-weight: 800;
    margin: 0 0 6px;
    color: #fff;
  }
  .res-style-tagline {
    color: #ffb066;
    font-size: 15px;
    font-weight: 500;
    margin: 0 0 14px;
  }
  .res-style-desc {
    color: #cbd2e1;
    font-size: 14px;
    line-height: 1.6;
    margin: 0;
  }
  .res-advice-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-top: 18px;
    padding-top: 16px;
    border-top: 1px solid rgba(255, 255, 255, 0.12);
  }
  .advice-item {
    background: rgba(255, 255, 255, 0.05);
    padding: 12px 16px;
    border-radius: var(--radius-sm);
    border: 1px solid rgba(255, 255, 255, 0.08);
  }
  .advice-label {
    font-size: 12px;
    font-weight: 700;
    color: var(--sky);
    margin-bottom: 4px;
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .advice-text {
    font-size: 12.5px;
    color: #e2e8f0;
    line-height: 1.45;
  }

  /* Color Palette Swatches */
  .palette-container {
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: var(--radius-md);
    padding: 20px;
    min-width: 220px;
  }
  .palette-container h4 {
    margin: 0 0 14px;
    font-size: 13px;
    color: #ffb066;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  .palette-swatches {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  .swatch-item {
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(0,0,0,0.2);
    padding: 6px 10px;
    border-radius: 8px;
  }
  .swatch-bubble {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    border: 2px solid rgba(255,255,255,0.4);
    box-shadow: 0 2px 6px rgba(0,0,0,0.3);
  }
  .swatch-name {
    font-size: 12px;
    font-weight: 600;
    color: #fff;
    flex: 1;
  }
  .swatch-hex {
    font-size: 11px;
    font-family: monospace;
    color: #94a3b8;
  }

  /* Visualizer Studio Canvas Box */
  .visualizer-wrapper {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 22px;
    margin-bottom: 34px;
    background: #fff;
    border: 1px solid var(--glass-border);
    border-radius: var(--radius-lg);
    padding: 20px;
    box-shadow: var(--shadow-glass);
  }
  .canvas-container {
    background: #11141d;
    border-radius: var(--radius-md);
    overflow: hidden;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: inset 0 2px 10px rgba(0,0,0,0.4);
  }
  #roomVisualizerCanvas {
    width: 100%;
    height: auto;
    max-height: 460px;
    display: block;
  }
  .visualizer-controls-panel {
    display: flex;
    flex-direction: column;
    gap: 16px;
  }
  .vis-control-group {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: var(--radius-sm);
    padding: 14px;
  }
  .vis-control-group h5 {
    margin: 0 0 10px;
    font-size: 13px;
    font-weight: 700;
    color: var(--ink);
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .vis-mode-toggle {
    display: flex;
    gap: 6px;
    background: #e2e8f0;
    padding: 4px;
    border-radius: 999px;
  }
  .vis-mode-btn {
    flex: 1;
    border: 0;
    background: transparent;
    padding: 7px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    font-family: inherit;
    color: var(--ink-soft);
    transition: all 0.2s;
  }
  .vis-mode-btn.active {
    background: #fff;
    color: var(--ink);
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  }
  .color-chips-row {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
  }
  .wall-color-btn {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.15);
    cursor: pointer;
    transition: transform 0.2s;
  }
  .wall-color-btn:hover { transform: scale(1.15); }
  .wall-color-btn.active {
    outline: 2px solid var(--amber);
    outline-offset: 2px;
    transform: scale(1.12);
  }
  .floor-type-row {
    display: flex;
    gap: 6px;
  }
  .floor-type-btn {
    flex: 1;
    border: 1px solid #cbd5e1;
    background: #fff;
    padding: 6px 4px;
    border-radius: 8px;
    font-size: 11px;
    font-weight: 600;
    color: var(--ink-soft);
    cursor: pointer;
    transition: all 0.2s;
  }
  .floor-type-btn.active {
    border-color: var(--amber);
    background: rgba(255, 138, 30, 0.1);
    color: var(--copper);
  }
  .vis-layer-toggles {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }
  .vis-layer-toggles label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12.5px;
    font-weight: 500;
    color: var(--ink-soft);
    cursor: pointer;
  }
  .btn-vis-action {
    width: 100%;
    border: 0;
    padding: 10px 14px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 700;
    font-family: inherit;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.2s;
  }
  .btn-export-png {
    background: #1e293b;
    color: #fff;
  }
  .btn-export-png:hover { background: #0f172a; }
  .btn-retake {
    background: #f1f5f9;
    color: var(--ink-soft);
    border: 1px solid #cbd5e1;
  }
  .btn-retake:hover { background: #e2e8f0; color: var(--ink); }

  /* Matched Products Grid */
  .matched-section-title {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 12px;
  }
  .matched-section-title h3 {
    margin: 0;
    font-size: 22px;
    font-weight: 800;
    color: var(--ink);
  }
  .matched-products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: 18px;
    margin-bottom: 30px;
  }
  .matched-card {
    background: #fff;
    border: 1px solid var(--glass-border);
    border-radius: var(--radius-md);
    overflow: hidden;
    box-shadow: var(--shadow-glass);
    display: flex;
    flex-direction: column;
    transition: transform 0.25s, box-shadow 0.25s;
  }
  .matched-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 30px -8px rgba(30, 40, 80, 0.16);
  }
  .matched-card-img-wrap {
    position: relative;
    width: 100%;
    height: 160px;
    background: #f1f5f9;
    overflow: hidden;
  }
  .matched-card-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .matched-card-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: rgba(17, 24, 39, 0.85);
    backdrop-filter: blur(4px);
    color: #ffb066;
    font-size: 11px;
    font-weight: 700;
    padding: 3px 9px;
    border-radius: 999px;
  }
  .matched-card-body {
    padding: 16px;
    display: flex;
    flex-direction: column;
    flex: 1;
  }
  .matched-card-title {
    font-size: 15px;
    font-weight: 700;
    margin: 0 0 6px;
    color: var(--ink);
  }
  .matched-card-desc {
    font-size: 12px;
    color: var(--ink-soft);
    line-height: 1.4;
    margin: 0 0 14px;
    flex: 1;
  }
  .matched-card-foot {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #f1f5f9;
    padding-top: 10px;
  }
  .matched-price {
    font-size: 17px;
    font-weight: 800;
    color: var(--amber-deep);
  }
  .btn-add-single-cart {
    background: rgba(255, 138, 30, 0.12);
    color: var(--copper);
    border: 1px solid rgba(255, 138, 30, 0.25);
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    font-family: inherit;
    transition: all 0.2s;
  }
  .btn-add-single-cart:hover {
    background: var(--amber);
    color: #fff;
  }

  /* Bundle Offer Card */
  .bundle-offer-card {
    background: linear-gradient(135deg, #181d28 0%, #293042 100%);
    color: #fff;
    border-radius: var(--radius-lg);
    padding: 28px 32px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
    box-shadow: 0 18px 40px -10px rgba(0,0,0,0.3);
    border: 1px solid rgba(255, 255, 255, 0.12);
  }
  .bundle-details h4 {
    font-size: 20px;
    font-weight: 800;
    margin: 0 0 6px;
    color: #fff;
  }
  .bundle-details p {
    margin: 0;
    font-size: 13.5px;
    color: #cbd5e1;
  }
  .bundle-pricing {
    display: flex;
    align-items: baseline;
    gap: 12px;
    margin-top: 8px;
  }
  .bundle-orig-price {
    font-size: 15px;
    text-decoration: line-through;
    color: #94a3b8;
  }
  .bundle-final-price {
    font-size: 28px;
    font-weight: 900;
    color: #ffb066;
  }
  .bundle-savings-badge {
    background: rgba(16, 185, 129, 0.2);
    border: 1px solid #10b981;
    color: #34d399;
    font-size: 12px;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 999px;
  }
  .btn-add-bundle-cart {
    background: linear-gradient(180deg, var(--amber), var(--amber-deep));
    color: #fff;
    border: 0;
    padding: 16px 36px;
    border-radius: 999px;
    font-size: 16px;
    font-weight: 800;
    font-family: inherit;
    cursor: pointer;
    box-shadow: 0 10px 28px rgba(255, 138, 30, 0.4);
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .btn-add-bundle-cart:hover {
    filter: brightness(1.1);
    transform: translateY(-2px);
    box-shadow: 0 14px 34px rgba(255, 138, 30, 0.5);
  }

  @media (max-width: 900px) {
    .res-header-card { grid-template-columns: 1fr; }
    .visualizer-wrapper { grid-template-columns: 1fr; }
    .bundle-offer-card { flex-direction: column; align-items: flex-start; }
    .btn-add-bundle-cart { width: 100%; justify-content: center; }
  }
</style>
</head>
<body>

  <!-- Ambient liquid glass background -->
  <div class="liquid-bg" aria-hidden="true">
    <span class="blob blob-1"></span>
    <span class="blob blob-2"></span>
    <span class="blob blob-3"></span>
    <span class="blob blob-4"></span>
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
        <a href="products.html">สินค้า</a>
        <a href="furniture-designer.html">The Perfect Match</a>
        <a href="services.html">บริการ</a>
        <a href="promo.html">โปรโมชั่น</a>
        <a href="evaluation.html">📊 ประเมินโครงงาน</a>
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

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-panel">
      <div class="hero-content">
        <div class="hero-badge">✨ ดีไซน์เพื่อไลฟ์สไตล์ที่เป็นคุณ</div>
        <h1>ยกระดับพื้นที่อยู่อาศัยด้วยเฟอร์นิเจอร์ดีไซน์พรีเมียม</h1>
        <p>ผสานงานออกแบบที่เป็นเอกลักษณ์เข้ากับการคัดสรรวัสดุชั้นเยี่ยม พร้อมระบบประเมินสไตล์เฉพาะตัวคุณ</p>
        <div class="hero-btns">
          <a href="#designer-studio" class="btn-hero-primary" id="start-designer-btn">🚀 เริ่มค้นหาสไตล์ที่ใช่ (The Perfect Match)</a>
          <a href="products.html" class="btn-hero-outline">ดูคอลเลกชันทั้งหมด</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Features Strip -->
  <div class="features-strip">
    <div class="features-grid">
      <div class="feature-item">
        <div class="feature-icon">💎</div>
        <div class="feature-text">
          <h4>ดีไซน์พรีเมียม</h4>
          <p>คัดสรรวัสดุคุณภาพสูง ทนทาน</p>
        </div>
      </div>
      <div class="feature-item">
        <div class="feature-icon">🎨</div>
        <div class="feature-text">
          <h4>แมตช์ได้ทุกสไตล์</h4>
          <p>ระบบค้นหาดีไซน์ที่เหมาะกับคุณ</p>
        </div>
      </div>
      <div class="feature-item">
        <div class="feature-icon">🛡️</div>
        <div class="feature-text">
          <h4>รับประกันมั่นใจ</h4>
          <p>บริการหลังการขายระดับมืออาชีพ</p>
        </div>
      </div>
    </div>
  <!-- The Perfect Match Studio & Interactive Style Assessment -->
  <section class="designer-studio-section" id="designer-studio">
    <div class="studio-card">
      <div class="studio-header">
        <div class="studio-badge">✨ The Perfect Match Studio</div>
        <h2>ประเมินสไตล์ & ออกแบบห้องในฝัน</h2>
        <p>ค้นหาเฟอร์นิเจอร์และพาเลทสีที่สะท้อนตัวตนของคุณ พร้อมห้องจำลองเสมือนจริงแบบเรียลไทม์</p>
      </div>

      <!-- Question Wizard Container -->
      <div id="wizard-question-container">
        <!-- Progress Steps -->
        <div class="wizard-progress">
          <div class="step-indicator-item active" data-step="1">
            <span>1</span> ประเภทห้อง 🛋️
          </div>
          <div class="step-indicator-item" data-step="2">
            <span>2</span> มู้ด & สไตล์ 🎨
          </div>
          <div class="step-indicator-item" data-step="3">
            <span>3</span> โทนสี & วัสดุ 🪵
          </div>
          <div class="step-indicator-item" data-step="4">
            <span>4</span> ขนาด & งบประมาณ 📐
          </div>
        </div>

        <!-- Step 1: Room Type -->
        <div class="wizard-step-content" id="wizard-step-1">
          <h3>เลือกพื้นที่ห้องที่คุณต้องการออกแบบ</h3>
          <p class="wizard-step-subtitle">เราจะช่วยวิเคราะห์การจัดวางและสัดส่วนที่เหมาะสมที่สุด</p>
          <div class="wizard-options-grid">
            <div class="wizard-card-option selected" data-field="roomType" data-value="living">
              <div class="opt-icon">🛋️</div>
              <h4 class="opt-title">ห้องนั่งเล่น (Living Room)</h4>
              <p class="opt-desc">พื้นที่ศูนย์รวมความผ่อนคลายและต้อนรับแขกคนสำคัญ</p>
            </div>
            <div class="wizard-card-option" data-field="roomType" data-value="bedroom">
              <div class="opt-icon">🛏️</div>
              <h4 class="opt-title">ห้องนอน (Bedroom)</h4>
              <p class="opt-desc">โอเอซิสแห่งการพักผ่อน หลับสบาย ไร้ความวุ่นวาย</p>
            </div>
            <div class="wizard-card-option" data-field="roomType" data-value="office">
              <div class="opt-icon">💼</div>
              <h4 class="opt-title">โฮมออฟฟิศ (Home Office)</h4>
              <p class="opt-desc">มุมทำงานที่เพิ่มสมาธิ ความคิดสร้างสรรค์ และสรีรศาสตร์</p>
            </div>
            <div class="wizard-card-option" data-field="roomType" data-value="condo">
              <div class="opt-icon">🏢</div>
              <h4 class="opt-title">สตูดิโอคอนโด (Condo Studio)</h4>
              <p class="opt-desc">ฟังก์ชันมัลติทาสก์ คุ้มค่าทุกตารางเมตร ดูโปร่งสบาย</p>
            </div>
          </div>
        </div>

        <!-- Step 2: Vibe & Style -->
        <div class="wizard-step-content" id="wizard-step-2" style="display: none;">
          <h3>บรรยากาศหรือสไตล์แบบใดที่คุณตกหลุมรัก?</h3>
          <p class="wizard-step-subtitle">ดีไซน์ที่สะท้อนตัวตนของคุณได้อย่างชัดเจนที่สุด</p>
          <div class="wizard-options-grid">
            <div class="wizard-card-option selected" data-field="vibe" data-value="japandi">
              <div class="opt-icon">🌿</div>
              <h4 class="opt-title">Japandi & Warm Minimalist</h4>
              <p class="opt-desc">ความสงบ อบอุ่น เรียบง่ายแบบเซน ผสานฟังก์ชันใช้งานจริง</p>
            </div>
            <div class="wizard-card-option" data-field="vibe" data-value="modern_luxury">
              <div class="opt-icon">✨</div>
              <h4 class="opt-title">Modern Luxury & Glamour</h4>
              <p class="opt-desc">หรูหรา สง่างาม หินอ่อน ทองเหลือง และหนังแท้พรีเมียม</p>
            </div>
            <div class="wizard-card-option" data-field="vibe" data-value="scandinavian">
              <div class="opt-icon">🌲</div>
              <h4 class="opt-title">Nordic Scandinavian</h4>
              <p class="opt-desc">สว่าง โปร่งตา ไม้สีอ่อน เส้นสายโค้งมนรับธรรมชาติ</p>
            </div>
            <div class="wizard-card-option" data-field="vibe" data-value="industrial_loft">
              <div class="opt-icon">🧱</div>
              <h4 class="opt-title">Industrial Loft</h4>
              <p class="opt-desc">ดิบ เท่ มั่นใจ ด้วยโครงสร้างเหล็กสีเข้ม หนังสีคอนยัค</p>
            </div>
          </div>
        </div>

        <!-- Step 3: Material & Tone -->
        <div class="wizard-step-content" id="wizard-step-3" style="display: none;">
          <h3>วัสดุและสัมผัสที่คุณโปรดปราน</h3>
          <p class="wizard-step-subtitle">เราจะเลือกเฟอร์นิเจอร์ที่มี Texture เข้ากันอย่างสมบูรณ์แบบ</p>
          <div class="wizard-options-grid">
            <div class="wizard-card-option selected" data-field="materials" data-value="oak">
              <div class="opt-icon">🪵</div>
              <h4 class="opt-title">ไม้โอ๊คธรรมชาติ & ครีม</h4>
              <p class="opt-desc">ลายไม้ธรรมชาตินุ่มนวล ผสานผ้าฝ้ายทอหนาโทนอบอุ่น</p>
            </div>
            <div class="wizard-card-option" data-field="materials" data-value="marble">
              <div class="opt-icon">🪨</div>
              <h4 class="opt-title">หินอ่อน & โลหะทองเหลือง</h4>
              <p class="opt-desc">ลวดลายหินขัดเงา สะท้อนแสงเงาสวยงาม ไร้ที่ติ</p>
            </div>
            <div class="wizard-card-option" data-field="materials" data-value="leather">
              <div class="opt-icon">🟤</div>
              <h4 class="opt-title">หนังแท้สีคอนยัค & วอลนัท</h4>
              <p class="opt-desc">ความคลาสสิกระดับเหนือกาลเวลา ยิ่งเก่ายิ่งสวยทรงคุณค่า</p>
            </div>
            <div class="wizard-card-option" data-field="materials" data-value="linen">
              <div class="opt-icon">⚪</div>
              <h4 class="opt-title">ผ้าลินินเอิร์ธโทน & งานสาน</h4>
              <p class="opt-desc">สัมผัสเป็นมิตร ระบายอากาศได้ดี ให้ความรู้สึกเป็นกันเอง</p>
            </div>
          </div>
        </div>

        <!-- Step 4: Size & Budget -->
        <div class="wizard-step-content" id="wizard-step-4" style="display: none;">
          <h3>ขนาดพื้นที่และระดับงบประมาณโดยประมาณ</h3>
          <p class="wizard-step-subtitle">เพื่อให้การคัดสรรชิ้นงานลงตัวทั้งขนาดและราคา</p>
          <div class="wizard-options-grid">
            <div class="wizard-card-option selected" data-field="budget" data-value="compact">
              <div class="opt-icon">📏</div>
              <h4 class="opt-title">ขนาดกะทัดรัด (< 25 ตร.ม.)</h4>
              <p class="opt-desc">เน้นเฟอร์นิเจอร์สเกลพอเหมาะ ประหยัดพื้นที่ งบประมาณสบายกระเป๋า</p>
            </div>
            <div class="wizard-card-option" data-field="budget" data-value="medium">
              <div class="opt-icon">📐</div>
              <h4 class="opt-title">ขนาดมาตรฐาน (25 - 50 ตร.ม.)</h4>
              <p class="opt-desc">สเกลยอดนิยมสำหรับบ้านและคอนโด จัดวางได้หลากหลายมิติ</p>
            </div>
            <div class="wizard-card-option" data-field="budget" data-value="large">
              <div class="opt-icon">🏰</div>
              <h4 class="opt-title">ขนาดใหญ่ (> 50 ตร.ม.)</h4>
              <p class="opt-desc">เปิดกว้างสำหรับการจัดวางชิ้นงาน Signature ชิ้นใหญ่เต็มพื้นที่</p>
            </div>
          </div>
        </div>

        <!-- Navigation Controls -->
        <div class="wizard-actions">
          <button type="button" class="btn-wizard-prev" id="wizard-prev-btn" style="visibility: hidden;">← ย้อนกลับ</button>
          <span id="wizard-current-step-text" style="font-size: 14px; font-weight: 600; color: var(--ink-faint);">ขั้นตอนที่ 1 จาก 4</span>
          <button type="button" class="btn-wizard-next" id="wizard-next-btn">ถัดไป →</button>
          <button type="button" class="btn-wizard-submit" id="wizard-submit-btn" style="display: none;">🚀 ประเมินและค้นหาสไตล์ที่ใช่</button>
        </div>
      </div>

      <!-- Evaluation Result & Visualizer Studio (Revealed on evaluate) -->
      <div id="evaluation-result-panel" style="display: none;">
        <!-- Match Summary Card -->
        <div class="res-header-card">
          <div>
            <div class="res-badge-wrap">
              <span class="match-score-badge" id="res-match-score">98% MATCH</span>
              <span style="color: #ffb066; font-size: 13px; font-weight: 600;">✨ ผลการประเมินสไตล์เฉพาะตัวคุณ</span>
            </div>
            <h3 class="res-style-title" id="res-style-title">สไตล์เจแปนดิ & มินิมอลอบอุ่น</h3>
            <p class="res-style-tagline" id="res-style-tagline">ความลงตัวระหว่างมินิมอลญี่ปุ่นและความอบอุ่นเรียบง่าย</p>
            <p class="res-style-desc" id="res-style-desc">เน้นความสงบ เป็นธรรมชาติ เส้นสายที่สะอาดตา ใช้วัสดุไม้โทนอุ่นและผ้าฝ้าย ให้ความรู้สึกผ่อนคลายในทุกมุมมอง</p>
            
            <div class="res-advice-grid">
              <div class="advice-item">
                <div class="advice-label">💡 คำแนะนำการจัดแสง (Lighting Advice)</div>
                <div class="advice-text" id="res-lighting-tip">ใช้แสงไฟ Warm White 2700K แบบ Indirect Light ซ่อนหลืบผนัง ผสานโคมไฟตั้งพื้น</div>
              </div>
              <div class="advice-item">
                <div class="advice-label">🎨 เคล็ดลับการตกแต่ง (Styling Tip)</div>
                <div class="advice-text" id="res-decor-tip">เลือกใช้แจกันดินเผาเซรามิก และต้นไม้ใบเขียวช่วยดึงพลังธรรมชาติเข้าสู่ห้อง</div>
              </div>
            </div>
          </div>

          <!-- Color Swatches -->
          <div class="palette-container">
            <h4>พาเลทคู่สีแนะนำ</h4>
            <div class="palette-swatches" id="res-color-palette">
              <!-- Rendered dynamically -->
            </div>
          </div>
        </div>

        <!-- 2D/3D Room Visualizer Studio -->
        <div class="visualizer-wrapper">
          <div class="canvas-container">
            <canvas id="roomVisualizerCanvas" width="760" height="460"></canvas>
          </div>
          
          <div class="visualizer-controls-panel">
            <div class="vis-control-group">
              <h5>📐 มุมมองห้อง (View Mode)</h5>
              <div class="vis-mode-toggle">
                <button type="button" class="vis-mode-btn active" id="view-mode-3d">3D Isometric</button>
                <button type="button" class="vis-mode-btn" id="view-mode-2d">2D Blueprint</button>
              </div>
            </div>

            <div class="vis-control-group">
              <h5>🎨 สีผนังห้อง (Wall Color)</h5>
              <div class="color-chips-row">
                <button type="button" class="wall-color-btn active" data-color="#f6f1eb" style="background-color: #f6f1eb;" title="Warm Cream"></button>
                <button type="button" class="wall-color-btn" data-color="#ffffff" style="background-color: #ffffff;" title="Nordic White"></button>
                <button type="button" class="wall-color-btn" data-color="#dce1e3" style="background-color: #dce1e3;" title="Slate Grey"></button>
                <button type="button" class="wall-color-btn" data-color="#d5ddd3" style="background-color: #d5ddd3;" title="Sage Mint"></button>
                <button type="button" class="wall-color-btn" data-color="#1e2530" style="background-color: #1e2530;" title="Midnight Navy"></button>
              </div>
            </div>

            <div class="vis-control-group">
              <h5>🪵 วัสดุพื้น (Flooring)</h5>
              <div class="floor-type-row">
                <button type="button" class="floor-type-btn active" data-floor="oak">ไม้โอ๊ค</button>
                <button type="button" class="floor-type-btn" data-floor="walnut">วอลนัท</button>
                <button type="button" class="floor-type-btn" data-floor="concrete">ลอฟท์ปูน</button>
              </div>
            </div>

            <div class="vis-control-group">
              <h5>🛋️ ชั้นเฟอร์นิเจอร์ (Layers)</h5>
              <div class="vis-layer-toggles">
                <label><input type="checkbox" id="toggle-sofa" checked> โซฟาหลัก (Sofa)</label>
                <label><input type="checkbox" id="toggle-table" checked> โต๊ะกลาง (Coffee Table)</label>
                <label><input type="checkbox" id="toggle-lamp" checked> โคมไฟบรรยากาศ (Floor Lamp)</label>
                <label><input type="checkbox" id="toggle-rug" checked> พรมปูพื้น (Area Rug)</label>
                <label><input type="checkbox" id="toggle-plant" checked> ต้นไม้ตกแต่ง (Houseplant)</label>
              </div>
            </div>

            <button type="button" class="btn-vis-action btn-export-png" id="btn-export-room-image">
              📸 บันทึกภาพแปลนห้อง (Export PNG)
            </button>

            <button type="button" class="btn-vis-action btn-retake" id="wizard-retake-btn">
              🔄 ประเมินสไตล์ใหม่อีกครั้ง
            </button>
          </div>
        </div>

        <!-- Matched Furniture Recommendation -->
        <div class="matched-section-title">
          <div>
            <h3>เซ็ตเฟอร์นิเจอร์ที่แมตช์เข้าชุดกัน</h3>
            <p style="color: var(--ink-soft); font-size: 14px; margin: 4px 0 0;">คัดสรรจากสินค้าในระบบเพื่อความลงตัวทั้งมิติและสไตล์</p>
          </div>
        </div>

        <div class="matched-products-grid" id="matched-products-grid">
          <!-- Populated by JavaScript -->
        </div>

        <!-- Bundle Offer Card -->
        <div class="bundle-offer-card">
          <div class="bundle-details">
            <h4>📦 สั่งซื้อยกเซ็ตพร้อมข้อเสนอพิเศษ</h4>
            <p>รับส่วนลดเซ็ตจับคู่ทันที พร้อมบริการจัดส่งและประกอบติดตั้งฟรีถึงห้องคุณ</p>
            <div class="bundle-pricing">
              <span class="bundle-orig-price" id="set-original-price">฿39,000</span>
              <span class="bundle-final-price" id="set-final-price">฿35,100</span>
              <span class="bundle-savings-badge" id="set-savings-amount">ประหยัด ฿3,900 (10%)</span>
            </div>
          </div>
          <button type="button" class="btn-add-bundle-cart" id="btn-add-bundle-cart">
            🛒 เพิ่มเซ็ตนี้ลงในตะกร้าทั้งหมด
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- Main Content -->
  <main class="container">
    <div class="section-title">
      <h2>คอลเลกชันยอดนิยม</h2>
      <p>ผลงานการออกแบบที่ผสมผสานความสวยงามและฟังก์ชันการใช้งานได้อย่างลงตัว</p>
    </div>

    <!-- Dynamic Grid from Database -->
    <div class="codemonday-grid">
      <?php
      require_once __DIR__ . '/config/db.php';
      $conn = get_mysqli_connection();

      if ($conn) {
          // แสดงเฉพาะสินค้า 6 รายการ (The Perfect Match page)
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
                        <img src="images/'.$image.'" alt="'.$title.'" onerror="this.src=\'https://placehold.co/280x160/eef1f7/838ba1?text=Maison+Forme\';">
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
              echo '<p style="text-align:center; grid-column: 1/-1; color: var(--ink-faint); padding: 40px;">ยังไม่มีรายการสินค้าในระบบหลังบ้าน กรุณาเพิ่มข้อมูลผ่าน phpMyAdmin</p>';
          }
          $conn->close();
      } else {
          echo '<p style="text-align:center; grid-column: 1/-1; color: var(--ink-faint); padding: 40px;">ไม่สามารถเชื่อมต่อฐานข้อมูลได้</p>';
      }
      ?>
    </div>
  </main>

  <!-- Footer -->
  <footer>
    <div class="footer-panel">
      <div class="footer-content">
        <div class="footer-brand">Maison Forme</div>
        <div style="color: #aeb3c6; font-size: 14px;">ยกระดับไลฟ์สไตล์บ้านคุณด้วยเฟอร์นิเจอร์ดีไซน์พรีเมียม</div>
      </div>
      <div class="footer-copy">
        <p>© 2026 Maison Forme | ร้านเฟอร์นิเจอร์ All Rights Reserved.</p>
      </div>
    </div>
  </footer>

  <script src="site.js"></script>
  <script src="account.js?v=4"></script>
  <script src="assets/js/furniture-designer.js"></script>
</body>
</html>