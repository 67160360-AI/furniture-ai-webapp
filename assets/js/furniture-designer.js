/**
 * Maison Forme - The Perfect Match & Furniture Designer Studio Engine
 * Handles interactive 4-step style assessment, 2D/3D canvas room visualizer,
 * product matching from store API, and cart integration.
 */

(function () {
  'use strict';

  // --- Assessment Configuration & Aesthetic Profiles ---
  const STYLE_PROFILES = {
    japandi: {
      id: 'japandi',
      name: 'Japandi & Warm Minimalist',
      titleTh: 'สไตล์เจแปนดิ & มินิมอลอบอุ่น',
      matchBase: 97,
      tagline: 'ความลงตัวระหว่างมินิมอลญี่ปุ่นและความอบอุ่นเรียบง่าย',
      desc: 'เน้นความสงบ เป็นธรรมชาติ เส้นสายที่สะอาดตา ใช้วัสดุไม้โทนอุ่นและผ้าฝ้าย ให้ความรู้สึกผ่อนคลายในทุกมุมมอง',
      palette: [
        { name: 'Warm Cream', hex: '#f6f1eb' },
        { name: 'Muted Oak', hex: '#cfb997' },
        { name: 'Earth Clay', hex: '#a68a72' },
        { name: 'Charcoal Ink', hex: '#2b2d35' }
      ],
      lightingTip: 'ใช้แสงไฟ Warm White (2700K-3000K) แบบซ่อนผนัง (Indirect Light) ผสานโคมไฟกระดาษสาหรือไม้ ช่วยขับเน้นลวดลายธรรมชาติ',
      decorTip: 'ตกแต่งด้วยแจกันเซรามิกดินเผาทำมือ กิ่งไม้แห้ง และพรมสานจากเส้นใยธรรมชาติ',
      keywords: ['เจแปนดิ', 'มินิมอล', 'ไม้โอ๊ค', 'อบอุ่น'],
      defaultWall: '#f6f1eb',
      defaultFloor: '#cfb997'
    },
    modern_luxury: {
      id: 'modern_luxury',
      name: 'Modern Luxury & Glamour',
      titleTh: 'สไตล์โมเดิร์น ลักชัวรี่',
      matchBase: 96,
      tagline: 'ความสง่างามเหนือกาลเวลาด้วยวัสดุชั้นเลิศและงานฝีมือประณีต',
      desc: 'ผสมผสานความเรียบหรูของหินอ่อน โลหะทองเหลืองขัดเงา และหนังแท้ ให้พื้นที่ของคุณโดดเด่นสะท้อนรสนิยมระดับไฮเอนด์',
      palette: [
        { name: 'Pure Alabaster', hex: '#f7f7f9' },
        { name: 'Brushed Brass', hex: '#d4af37' },
        { name: 'Smoked Walnut', hex: '#4a3b32' },
        { name: 'Deep Onyx', hex: '#161922' }
      ],
      lightingTip: 'ใช้โคมไฟแชนเดอเลียร์ดีไซน์มินิมอลโมเดิร์นร่วมกับไฟสปอตไลท์ส่องเน้นงานประติมากรรมหรือผนังหินอ่อน',
      decorTip: 'ประดับด้วยถาดหินอ่อน กระจกขอบทองเหลือง และหมอนอิงผ้ากำมะหยี่สีเข้ม',
      keywords: ['ลักชัวรี่', 'โมเดิร์น', 'ทองเหลือง', 'หินขัด', 'พรีเมียม'],
      defaultWall: '#f7f7f9',
      defaultFloor: '#4a3b32'
    },
    scandinavian: {
      id: 'scandinavian',
      name: 'Nordic Scandinavian',
      titleTh: 'สไตล์นอร์ดิก สแกนดิเนเวียน',
      matchBase: 98,
      tagline: 'โปร่ง โล่ง สบายตา เติมเต็มพลังบวกด้วยแสงธรรมชาติและไม้สว่าง',
      desc: 'เอกลักษณ์แห่งยุโรปเหนือ ดีไซน์โค้งมนรับสรีระ ผสานไม้สีอ่อนกับผ้าลินินสีคลาสสิก ให้ความรู้สึกเป็นมิตรและปลอดโปร่ง',
      palette: [
        { name: 'Nordic White', hex: '#ffffff' },
        { name: 'Light Ash', hex: '#e3dac9' },
        { name: 'Soft Sage', hex: '#bac5b8' },
        { name: 'Slate Grey', hex: '#5f6975' }
      ],
      lightingTip: 'เน้นรับแสงธรรมชาติในเวลากลางวัน และใช้โคมไฟตั้งพื้นทรงโค้งเปิดรับแสงกระจายแบบ Diffused Light ในเวลากลางคืน',
      decorTip: 'ต้นไม้ฟอกอากาศใบเขียวอย่างมอนสเตอร่า พรมขนแกะเทียม และรูปภาพภาพถ่ายธรรมชาติกรอบไม้เบิร์ช',
      keywords: ['สแกนดิเนเวียน', 'ไม้โอ๊ค', 'โปร่ง', 'ธรรมชาติ'],
      defaultWall: '#ffffff',
      defaultFloor: '#e3dac9'
    },
    industrial_loft: {
      id: 'industrial_loft',
      name: 'Contemporary Industrial Loft',
      titleTh: 'สไตล์คอนเทมโพรารี อินดัสเทรียล ลอฟท์',
      matchBase: 95,
      tagline: 'ความเท่ ดิบ แต่มีคลาสด้วยเสน่ห์โครงสร้างโลหะและหนังแท้',
      desc: 'เน้นสัจจะวัสดุ เหล็กพ่นสีดำด้าน ไม้วอลนัทธรรมชาติ และหนังสีคอนยัค สะท้อนบุคลิกที่มั่นใจ แปลกใหม่ และทรงพลัง',
      palette: [
        { name: 'Raw Concrete', hex: '#cfd2d6' },
        { name: 'Cognac Leather', hex: '#9d5c31' },
        { name: 'Cast Iron', hex: '#2f343b' },
        { name: 'Matte Black', hex: '#111317' }
      ],
      lightingTip: 'โคมไฟแทร็กไลท์สีดำด้าน โคมไฟห้อยหลอดเอดิสัน (Edison Filament) สีส้มสลัว สร้างบรรยากาศบาร์ส่วนตัว',
      decorTip: 'หนังสือศิลปะเล่มโต นาฬิกาติดผนังเหล็กเรือนใหญ่ และชั้นวางของท่อเหล็กสไตล์เวิร์กช็อป',
      keywords: ['อินดัสเทรียล', 'เหล็ก', 'วอลนัท', 'ดิบเท่'],
      defaultWall: '#cfd2d6',
      defaultFloor: '#2f343b'
    }
  };

  // State
  const state = {
    step: 1,
    answers: {
      roomType: 'living',
      vibe: 'japandi',
      materials: 'oak',
      budget: 'medium'
    },
    evaluated: false,
    matchedProfile: STYLE_PROFILES.japandi,
    matchedProducts: [],
    bundleDiscountPercent: 10,
    // Visualizer canvas state
    viewMode: '3d', // '3d' or '2d'
    wallColor: '#f6f1eb',
    floorType: 'oak', // 'oak', 'walnut', 'concrete'
    furnitureVisibility: {
      sofa: true,
      table: true,
      lamp: true,
      rug: true,
      plant: true
    }
  };

  // Cached all products from API
  let allProducts = [];

  // Initialize on DOM ready
  document.addEventListener('DOMContentLoaded', () => {
    initHeroButton();
    initWizard();
    initVisualizer();
    loadStoreProducts();
  });

  // 1. Hook the hero button smoothly
  function initHeroButton() {
    const heroBtn = document.querySelector('.btn-hero-primary');
    if (heroBtn) {
      heroBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const studioEl = document.getElementById('designer-studio');
        if (studioEl) {
          studioEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    }
  }

  // 2. Fetch products for matching
  async function loadStoreProducts() {
    try {
      const res = await fetch('api_products.php');
      if (res.ok) {
        const data = await res.json();
        if (Array.isArray(data)) {
          allProducts = data;
        }
      }
    } catch (err) {
      console.warn('Could not load api_products.php, using curated fallback items', err);
    }
  }

  // 3. Wizard Step Logic
  function initWizard() {
    const optionCards = document.querySelectorAll('.wizard-card-option');
    optionCards.forEach((card) => {
      card.addEventListener('click', () => {
        const field = card.dataset.field;
        const val = card.dataset.value;
        if (!field || !val) return;

        // deselect siblings
        const parent = card.closest('.wizard-options-grid');
        if (parent) {
          parent.querySelectorAll('.wizard-card-option').forEach((c) => c.classList.remove('selected'));
        }
        card.classList.add('selected');
        state.answers[field] = val;
      });
    });

    // Step navigation buttons
    const prevBtn = document.getElementById('wizard-prev-btn');
    const nextBtn = document.getElementById('wizard-next-btn');
    const submitBtn = document.getElementById('wizard-submit-btn');
    const retakeBtn = document.getElementById('wizard-retake-btn');

    if (prevBtn) {
      prevBtn.addEventListener('click', () => {
        if (state.step > 1) {
          setStep(state.step - 1);
        }
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener('click', () => {
        if (state.step < 4) {
          setStep(state.step + 1);
        }
      });
    }

    if (submitBtn) {
      submitBtn.addEventListener('click', () => {
        calculateEvaluation();
      });
    }

    if (retakeBtn) {
      retakeBtn.addEventListener('click', () => {
        state.evaluated = false;
        document.getElementById('evaluation-result-panel').style.display = 'none';
        document.getElementById('wizard-question-container').style.display = 'block';
        setStep(1);
        const studioEl = document.getElementById('designer-studio');
        if (studioEl) {
          studioEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    }

    // Set initial step
    setStep(1);
  }

  function setStep(newStep) {
    state.step = newStep;
    // Hide all step sections
    document.querySelectorAll('.wizard-step-content').forEach((sec) => {
      sec.style.display = 'none';
    });
    const currentSec = document.getElementById(`wizard-step-${newStep}`);
    if (currentSec) {
      currentSec.style.display = 'block';
    }

    // Update progress indicator
    document.querySelectorAll('.step-indicator-item').forEach((dot, idx) => {
      const stepNum = idx + 1;
      dot.classList.remove('active', 'completed');
      if (stepNum === newStep) {
        dot.classList.add('active');
      } else if (stepNum < newStep) {
        dot.classList.add('completed');
      }
    });

    const stepLabel = document.getElementById('wizard-current-step-text');
    if (stepLabel) {
      stepLabel.textContent = `ขั้นตอนที่ ${newStep} จาก 4`;
    }

    // Update buttons
    const prevBtn = document.getElementById('wizard-prev-btn');
    const nextBtn = document.getElementById('wizard-next-btn');
    const submitBtn = document.getElementById('wizard-submit-btn');

    if (prevBtn) prevBtn.style.visibility = newStep === 1 ? 'hidden' : 'visible';
    if (nextBtn) nextBtn.style.display = newStep === 4 ? 'none' : 'inline-flex';
    if (submitBtn) submitBtn.style.display = newStep === 4 ? 'inline-flex' : 'none';
  }

  // 4. Calculate Evaluation Result & Match Products
  function calculateEvaluation() {
    state.evaluated = true;
    const vibe = state.answers.vibe || 'japandi';
    const profile = STYLE_PROFILES[vibe] || STYLE_PROFILES.japandi;
    state.matchedProfile = profile;

    // Set visualizer defaults to match profile
    state.wallColor = profile.defaultWall;
    if (vibe === 'industrial_loft') state.floorType = 'concrete';
    else if (vibe === 'modern_luxury') state.floorType = 'walnut';
    else state.floorType = 'oak';

    // Calculate score with slight variation based on material match
    let finalScore = profile.matchBase;
    if (state.answers.materials === 'oak' && (vibe === 'japandi' || vibe === 'scandinavian')) finalScore += 2;
    if (state.answers.materials === 'leather' && vibe === 'industrial_loft') finalScore += 3;
    if (state.answers.materials === 'marble' && vibe === 'modern_luxury') finalScore += 2;
    if (finalScore > 99) finalScore = 99;

    // Render result UI
    renderEvaluationResult(profile, finalScore);

    // Render matched products
    findAndRenderMatchedProducts(profile);

    // Update visualizer canvas
    renderCanvas();

    // Show result panel, hide question container
    document.getElementById('wizard-question-container').style.display = 'none';
    const resultPanel = document.getElementById('evaluation-result-panel');
    resultPanel.style.display = 'block';
    resultPanel.scrollIntoView({ behavior: 'smooth', block: 'start' });
  }

  function renderEvaluationResult(profile, score) {
    const scoreBadge = document.getElementById('res-match-score');
    const titleEl = document.getElementById('res-style-title');
    const taglineEl = document.getElementById('res-style-tagline');
    const descEl = document.getElementById('res-style-desc');
    const paletteList = document.getElementById('res-color-palette');
    const lightingTipEl = document.getElementById('res-lighting-tip');
    const decorTipEl = document.getElementById('res-decor-tip');

    if (scoreBadge) scoreBadge.textContent = `${score}% MATCH`;
    if (titleEl) titleEl.textContent = profile.titleTh;
    if (taglineEl) taglineEl.textContent = profile.tagline;
    if (descEl) descEl.textContent = profile.desc;
    if (lightingTipEl) lightingTipEl.textContent = profile.lightingTip;
    if (decorTipEl) decorTipEl.textContent = profile.decorTip;

    if (paletteList) {
      paletteList.innerHTML = profile.palette.map((color) => `
        <div class="swatch-item">
          <div class="swatch-bubble" style="background-color: ${color.hex};" title="${color.name}"></div>
          <span class="swatch-name">${color.name}</span>
          <span class="swatch-hex">${color.hex}</span>
        </div>
      `).join('');
    }
  }

  // 5. Select and Render Matched Products
  function findAndRenderMatchedProducts(profile) {
    const matched = [];
    const keywords = profile.keywords;

    // Helper: find product by category & keywords
    function findBest(catName, altFallback) {
      if (allProducts.length > 0) {
        // filter by category first
        const inCat = allProducts.filter((p) => p.category && p.category.includes(catName));
        // try to find with matching keyword
        const withKeyword = inCat.filter((p) => {
          const text = `${p.name} ${p.description || ''}`.toLowerCase();
          return keywords.some((kw) => text.includes(kw.toLowerCase()));
        });
        if (withKeyword.length > 0) return withKeyword[0];
        if (inCat.length > 0) return inCat[0];
      }
      return altFallback;
    }

    // Four core pieces of a matched room:
    // 1. Seating
    const sofaItem = findBest('โซฟา', {
      id: 101,
      name: `โซฟา 3 ที่นั่ง ${profile.titleTh}`,
      price: 18900,
      image: 'chair.jpg',
      badge: 'Hero Piece',
      category: 'โซฟา',
      description: `ออกแบบให้สอดคล้องกับ ${profile.titleTh} มอบความสบายและสง่างาม`
    });
    matched.push(sofaItem);

    // 2. Table / Desk
    const tableItem = findBest('โต๊ะกาแฟ', {
      id: 102,
      name: `โต๊ะกลางพรีเมียม สไตล์ ${profile.name}`,
      price: 7500,
      image: 'chair.jpg',
      badge: 'Accent',
      category: 'โต๊ะกาแฟ',
      description: 'เส้นสายประณีต พื้นผิวสัมผัสเป็นธรรมชาติ ทนทานต่อการใช้งาน'
    });
    matched.push(tableItem);

    // 3. Storage / Shelf
    const shelfItem = findBest('ชั้นวาง', {
      id: 103,
      name: `ชั้นวางของมินิมัลลิสต์ เข้าชุด`,
      price: 9200,
      image: 'chair.jpg',
      badge: 'Featured',
      category: 'ชั้นวาง',
      description: 'ฟังก์ชันจัดเก็บครบครัน เพิ่มความโปร่งโล่งสบายตาให้ห้อง'
    });
    matched.push(shelfItem);

    // 4. Lighting / Decor
    const lampItem = findBest('โคมไฟ', {
      id: 104,
      name: `โคมไฟตั้งพื้นสร้างบรรยากาศ`,
      price: 3400,
      image: 'chair.jpg',
      badge: 'Atmosphere',
      category: 'โคมไฟ',
      description: 'แสงกระจายนุ่มนวล เสริมมิติให้พื้นที่พักผ่อนดูอบอุ่นยิ่งขึ้น'
    });
    matched.push(lampItem);

    state.matchedProducts = matched;

    // Render cards
    const container = document.getElementById('matched-products-grid');
    if (!container) return;

    let totalOriginal = 0;
    container.innerHTML = matched.map((p) => {
      const priceNum = parseFloat(p.price || 0);
      totalOriginal += priceNum;
      const formattedPrice = priceNum.toLocaleString('th-TH', { minimumFractionDigits: 0 });
      const img = p.image || 'chair.jpg';
      return `
        <div class="matched-card">
          <div class="matched-card-img-wrap">
            <img src="images/${encodeURIComponent(img)}" alt="${escapeHtml(p.name)}" onerror="this.src='https://placehold.co/280x180/eef1f7/838ba1?text=Maison+Forme';">
            <span class="matched-card-badge">${escapeHtml(p.badge || 'Recommended')}</span>
          </div>
          <div class="matched-card-body">
            <h4 class="matched-card-title">${escapeHtml(p.name)}</h4>
            <p class="matched-card-desc">${escapeHtml(p.description || '')}</p>
            <div class="matched-card-foot">
              <span class="matched-price">฿${formattedPrice}</span>
              <button class="btn-add-single-cart" data-product-id="${p.id}" data-name="${escapeHtml(p.name)}" data-price="${priceNum}" data-image="${encodeURIComponent(img)}">
                + เพิ่ม
              </button>
            </div>
          </div>
        </div>
      `;
    }).join('');

    // Bind individual Add buttons
    container.querySelectorAll('.btn-add-single-cart').forEach((btn) => {
      btn.addEventListener('click', () => {
        addItemToCart({
          id: btn.dataset.productId,
          name: btn.dataset.name,
          price: parseFloat(btn.dataset.price),
          image: btn.dataset.image,
          quantity: 1
        });
        showToast(`เพิ่ม "${btn.dataset.name}" ลงในตะกร้าเรียบร้อยแล้ว`);
      });
    });

    // Update Set Pricing Summary
    const discountAmount = totalOriginal * (state.bundleDiscountPercent / 100);
    const finalSetPrice = totalOriginal - discountAmount;

    const origEl = document.getElementById('set-original-price');
    const finalEl = document.getElementById('set-final-price');
    const saveEl = document.getElementById('set-savings-amount');

    if (origEl) origEl.textContent = `฿${totalOriginal.toLocaleString('th-TH', { minimumFractionDigits: 0 })}`;
    if (finalEl) finalEl.textContent = `฿${finalSetPrice.toLocaleString('th-TH', { minimumFractionDigits: 0 })}`;
    if (saveEl) saveEl.textContent = `ประหยัด ฿${discountAmount.toLocaleString('th-TH', { minimumFractionDigits: 0 })} (${state.bundleDiscountPercent}%)`;

    // Hook whole set add to cart
    const addAllBtn = document.getElementById('btn-add-bundle-cart');
    if (addAllBtn) {
      addAllBtn.onclick = () => {
        matched.forEach((item) => {
          addItemToCart({
            id: item.id,
            name: item.name,
            price: parseFloat(item.price || 0),
            image: item.image || 'chair.jpg',
            quantity: 1
          });
        });
        showToast(`🎉 เพิ่มเซ็ตเฟอร์นิเจอร์ ${profile.titleTh} ทั้งหมดลงในตะกร้าแล้ว!`);
      };
    }
  }

  // 6. Cart Storage Helper
  function addItemToCart(newItem) {
    let cart = [];
    try {
      cart = JSON.parse(localStorage.getItem('furniture-cart') || '[]');
    } catch (e) {
      cart = [];
    }

    const existingIndex = cart.findIndex((i) => String(i.id) === String(newItem.id));
    if (existingIndex > -1) {
      cart[existingIndex].quantity = (cart[existingIndex].quantity || 1) + 1;
    } else {
      cart.push(newItem);
    }

    localStorage.setItem('furniture-cart', JSON.stringify(cart));
    if (typeof window.updateHeaderCartBadge === 'function') {
      window.updateHeaderCartBadge();
    }
  }

  // 7. Visualizer Canvas Engine
  let canvas, ctx;

  function initVisualizer() {
    canvas = document.getElementById('roomVisualizerCanvas');
    if (!canvas) return;
    ctx = canvas.getContext('2d');

    // Wall Color Buttons
    document.querySelectorAll('.wall-color-btn').forEach((btn) => {
      btn.addEventListener('click', () => {
        document.querySelectorAll('.wall-color-btn').forEach((b) => b.classList.remove('active'));
        btn.classList.add('active');
        state.wallColor = btn.dataset.color;
        renderCanvas();
      });
    });

    // Floor Type Buttons
    document.querySelectorAll('.floor-type-btn').forEach((btn) => {
      btn.addEventListener('click', () => {
        document.querySelectorAll('.floor-type-btn').forEach((b) => b.classList.remove('active'));
        btn.classList.add('active');
        state.floorType = btn.dataset.floor;
        renderCanvas();
      });
    });

    // View Mode Toggle
    const mode3d = document.getElementById('view-mode-3d');
    const mode2d = document.getElementById('view-mode-2d');
    if (mode3d && mode2d) {
      mode3d.addEventListener('click', () => {
        mode3d.classList.add('active');
        mode2d.classList.remove('active');
        state.viewMode = '3d';
        renderCanvas();
      });
      mode2d.addEventListener('click', () => {
        mode2d.classList.add('active');
        mode3d.classList.remove('active');
        state.viewMode = '2d';
        renderCanvas();
      });
    }

    // Furniture Toggles
    ['sofa', 'table', 'lamp', 'rug', 'plant'].forEach((item) => {
      const toggle = document.getElementById(`toggle-${item}`);
      if (toggle) {
        toggle.addEventListener('change', (e) => {
          state.furnitureVisibility[item] = e.target.checked;
          renderCanvas();
        });
      }
    });

    // Export Canvas Image
    const exportBtn = document.getElementById('btn-export-room-image');
    if (exportBtn) {
      exportBtn.addEventListener('click', () => {
        try {
          const dataUrl = canvas.toDataURL('image/png');
          const a = document.createElement('a');
          a.href = dataUrl;
          a.download = `maison-forme-${state.matchedProfile.id}-room-design.png`;
          document.body.appendChild(a);
          a.click();
          document.body.removeChild(a);
          showToast('📸 บันทึกภาพแปลนห้องสำเร็จแล้ว');
        } catch (err) {
          showToast('ไม่สามารถส่งออกภาพได้ในขณะนี้');
        }
      });
    }

    // Initial draw
    resizeAndRenderCanvas();
    window.addEventListener('resize', resizeAndRenderCanvas);
  }

  function resizeAndRenderCanvas() {
    if (!canvas) return;
    const rect = canvas.getBoundingClientRect();
    canvas.width = Math.min(rect.width || 720, 800);
    canvas.height = 460;
    renderCanvas();
  }

  function renderCanvas() {
    if (!canvas || !ctx) return;
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    if (state.viewMode === '3d') {
      draw3DRoom(ctx, canvas.width, canvas.height);
    } else {
      draw2DBlueprint(ctx, canvas.width, canvas.height);
    }
  }

  // Draw 3D Isometric / Perspective Room
  function draw3DRoom(ctx, w, h) {
    const centerX = w / 2;
    const centerY = h * 0.48;
    const roomW = w * 0.44;
    const roomD = h * 0.38;
    const wallH = h * 0.42;

    // Corner points
    const pBack = { x: centerX, y: centerY - roomD * 0.6 };
    const pLeft = { x: centerX - roomW, y: centerY };
    const pRight = { x: centerX + roomW, y: centerY };
    const pFront = { x: centerX, y: centerY + roomD * 0.8 };

    // --- 1. Background Fill ---
    const bgGrad = ctx.createLinearGradient(0, 0, 0, h);
    bgGrad.addColorStop(0, '#1c1f2b');
    bgGrad.addColorStop(1, '#0e1017');
    ctx.fillStyle = bgGrad;
    ctx.fillRect(0, 0, w, h);

    // Subtle Ambient Glow
    const glow = ctx.createRadialGradient(centerX, centerY, 40, centerX, centerY, w * 0.6);
    glow.addColorStop(0, 'rgba(255, 138, 30, 0.12)');
    glow.addColorStop(1, 'rgba(0,0,0,0)');
    ctx.fillStyle = glow;
    ctx.fillRect(0, 0, w, h);

    // --- 2. Left Wall ---
    ctx.beginPath();
    ctx.moveTo(pBack.x, pBack.y - wallH);
    ctx.lineTo(pBack.x, pBack.y);
    ctx.lineTo(pLeft.x, pLeft.y);
    ctx.lineTo(pLeft.x, pLeft.y - wallH);
    ctx.closePath();
    ctx.fillStyle = state.wallColor;
    ctx.fill();

    // Left wall shadow
    const leftShadow = ctx.createLinearGradient(pLeft.x, 0, pBack.x, 0);
    leftShadow.addColorStop(0, 'rgba(0,0,0,0.18)');
    leftShadow.addColorStop(1, 'rgba(0,0,0,0.02)');
    ctx.fillStyle = leftShadow;
    ctx.fill();

    // Left Wall Artwork / Window
    ctx.beginPath();
    const artW = roomW * 0.45;
    const artH = wallH * 0.4;
    const artX = pLeft.x + (pBack.x - pLeft.x) * 0.45;
    const artY = pLeft.y - wallH * 0.7 + (pBack.y - pLeft.y) * 0.45;
    ctx.moveTo(artX, artY);
    ctx.lineTo(artX + artW * 0.6, artY - artH * 0.3);
    ctx.lineTo(artX + artW * 0.6, artY + artH * 0.7);
    ctx.lineTo(artX, artY + artH);
    ctx.closePath();
    ctx.fillStyle = 'rgba(255,255,255,0.75)';
    ctx.fill();
    ctx.strokeStyle = '#c2520a';
    ctx.lineWidth = 2;
    ctx.stroke();

    // --- 3. Right Wall ---
    ctx.beginPath();
    ctx.moveTo(pBack.x, pBack.y - wallH);
    ctx.lineTo(pBack.x, pBack.y);
    ctx.lineTo(pRight.x, pRight.y);
    ctx.lineTo(pRight.x, pRight.y - wallH);
    ctx.closePath();
    ctx.fillStyle = state.wallColor;
    ctx.fill();

    // Right wall light gradient
    const rightShadow = ctx.createLinearGradient(pBack.x, 0, pRight.x, 0);
    rightShadow.addColorStop(0, 'rgba(0,0,0,0.04)');
    rightShadow.addColorStop(1, 'rgba(0,0,0,0.22)');
    ctx.fillStyle = rightShadow;
    ctx.fill();

    // --- 4. Floor (Isometric Diamond) ---
    ctx.beginPath();
    ctx.moveTo(pBack.x, pBack.y);
    ctx.lineTo(pRight.x, pRight.y);
    ctx.lineTo(pFront.x, pFront.y);
    ctx.lineTo(pLeft.x, pLeft.y);
    ctx.closePath();

    let floorFill = '#d7bc97';
    if (state.floorType === 'walnut') floorFill = '#4a3b32';
    else if (state.floorType === 'concrete') floorFill = '#9ea5ad';

    ctx.fillStyle = floorFill;
    ctx.fill();

    // Parquet lines
    ctx.strokeStyle = 'rgba(0,0,0,0.08)';
    ctx.lineWidth = 1;
    for (let i = 1; i < 7; i++) {
      const t = i / 7;
      ctx.beginPath();
      ctx.moveTo(pLeft.x + (pFront.x - pLeft.x) * t, pLeft.y + (pFront.y - pLeft.y) * t);
      ctx.lineTo(pBack.x + (pRight.x - pBack.x) * t, pBack.y + (pRight.y - pBack.y) * t);
      ctx.stroke();
    }

    // Floor Baseboard Lines
    ctx.beginPath();
    ctx.moveTo(pLeft.x, pLeft.y);
    ctx.lineTo(pBack.x, pBack.y);
    ctx.lineTo(pRight.x, pRight.y);
    ctx.strokeStyle = 'rgba(0,0,0,0.25)';
    ctx.lineWidth = 2;
    ctx.stroke();

    // --- 5. Furniture Items in 3D ---

    // A. Rug
    if (state.furnitureVisibility.rug) {
      const rugW = roomW * 0.7;
      const rugH = roomD * 0.6;
      ctx.save();
      ctx.beginPath();
      ctx.ellipse(centerX + 10, centerY + roomD * 0.28, rugW * 0.7, rugH * 0.5, -0.1, 0, Math.PI * 2);
      ctx.fillStyle = 'rgba(235, 230, 222, 0.82)';
      ctx.fill();
      ctx.strokeStyle = 'rgba(180, 160, 140, 0.5)';
      ctx.lineWidth = 2;
      ctx.stroke();
      ctx.restore();
    }

    // B. Sofa
    if (state.furnitureVisibility.sofa) {
      const sofaX = centerX - roomW * 0.28;
      const sofaY = centerY + roomD * 0.05;
      const sW = roomW * 0.62;
      const sH = 54;

      // Drop shadow
      ctx.beginPath();
      ctx.ellipse(sofaX + sW * 0.45, sofaY + sH + 18, sW * 0.48, 16, 0.1, 0, Math.PI * 2);
      ctx.fillStyle = 'rgba(0,0,0,0.25)';
      ctx.fill();

      // Sofa Backrest
      let sofaColor = '#c9b097';
      let sofaAccent = '#b3957a';
      if (state.matchedProfile.id === 'modern_luxury') {
        sofaColor = '#2b303a';
        sofaAccent = '#d4af37';
      } else if (state.matchedProfile.id === 'industrial_loft') {
        sofaColor = '#8e5428';
        sofaAccent = '#6e3f1b';
      }

      ctx.fillStyle = sofaColor;
      // Main Body
      ctx.beginPath();
      ctx.roundRect(sofaX, sofaY, sW, sH, [16, 16, 8, 8]);
      ctx.fill();

      // Cushions / Seat
      ctx.fillStyle = sofaAccent;
      ctx.beginPath();
      ctx.roundRect(sofaX + 6, sofaY + 16, sW - 12, sH - 12, [10, 10, 6, 6]);
      ctx.fill();

      // Throw pillows
      ctx.fillStyle = '#ff8a1e';
      ctx.beginPath();
      ctx.roundRect(sofaX + 12, sofaY + 8, 24, 26, 6);
      ctx.fill();

      ctx.fillStyle = '#5fc9e8';
      ctx.beginPath();
      ctx.roundRect(sofaX + sW - 36, sofaY + 8, 24, 26, 6);
      ctx.fill();
    }

    // C. Coffee Table
    if (state.furnitureVisibility.table) {
      const tblX = centerX + 10;
      const tblY = centerY + roomD * 0.35;
      const tblRadX = 46;
      const tblRadY = 24;

      // Table shadow
      ctx.beginPath();
      ctx.ellipse(tblX, tblY + 22, tblRadX * 0.9, tblRadY * 0.8, 0, 0, Math.PI * 2);
      ctx.fillStyle = 'rgba(0,0,0,0.22)';
      ctx.fill();

      // Table legs
      ctx.strokeStyle = '#222';
      ctx.lineWidth = 3;
      ctx.beginPath();
      ctx.moveTo(tblX - 28, tblY + 4); ctx.lineTo(tblX - 32, tblY + 24);
      ctx.moveTo(tblX + 28, tblY + 4); ctx.lineTo(tblX + 32, tblY + 24);
      ctx.moveTo(tblX, tblY + 6); ctx.lineTo(tblX, tblY + 26);
      ctx.stroke();

      // Table top
      let tableTopColor = '#dfcfbc';
      if (state.matchedProfile.id === 'modern_luxury') tableTopColor = '#f2f2f4';
      else if (state.matchedProfile.id === 'industrial_loft') tableTopColor = '#4a3b32';

      ctx.beginPath();
      ctx.ellipse(tblX, tblY, tblRadX, tblRadY, 0, 0, Math.PI * 2);
      ctx.fillStyle = tableTopColor;
      ctx.fill();
      ctx.strokeStyle = 'rgba(0,0,0,0.15)';
      ctx.lineWidth = 2;
      ctx.stroke();

      // Coffee cup on table
      ctx.beginPath();
      ctx.ellipse(tblX - 8, tblY - 2, 5, 3, 0, 0, Math.PI * 2);
      ctx.fillStyle = '#ff8a1e';
      ctx.fill();
    }

    // D. Floor Lamp
    if (state.furnitureVisibility.lamp) {
      const lampX = centerX + roomW * 0.65;
      const lampY = centerY + roomD * 0.08;

      // Lamp shadow
      ctx.beginPath();
      ctx.ellipse(lampX, lampY + 12, 16, 7, 0, 0, Math.PI * 2);
      ctx.fillStyle = 'rgba(0,0,0,0.2)';
      ctx.fill();

      // Pole
      ctx.strokeStyle = state.matchedProfile.id === 'modern_luxury' ? '#d4af37' : '#2b2d35';
      ctx.lineWidth = 3;
      ctx.beginPath();
      ctx.moveTo(lampX, lampY + 12);
      ctx.lineTo(lampX - 10, lampY - wallH * 0.55);
      ctx.stroke();

      // Shade
      ctx.beginPath();
      ctx.ellipse(lampX - 10, lampY - wallH * 0.55, 18, 10, 0, 0, Math.PI * 2);
      ctx.fillStyle = '#ffc83b';
      ctx.fill();

      // Lamp Light Cone (Soft Warm Glow)
      const lampGlow = ctx.createRadialGradient(lampX - 10, lampY - wallH * 0.55, 6, lampX - 10, lampY + 10, 80);
      lampGlow.addColorStop(0, 'rgba(255, 200, 80, 0.45)');
      lampGlow.addColorStop(1, 'rgba(255, 200, 80, 0)');
      ctx.fillStyle = lampGlow;
      ctx.beginPath();
      ctx.moveTo(lampX - 10, lampY - wallH * 0.55);
      ctx.lineTo(lampX - 60, lampY + 30);
      ctx.lineTo(lampX + 40, lampY + 30);
      ctx.closePath();
      ctx.fill();
    }

    // E. Houseplant
    if (state.furnitureVisibility.plant) {
      const plantX = centerX - roomW * 0.72;
      const plantY = centerY + roomD * 0.12;

      // Pot
      ctx.fillStyle = '#a66a44';
      ctx.beginPath();
      ctx.roundRect(plantX - 12, plantY, 24, 26, [2, 2, 8, 8]);
      ctx.fill();

      // Foliage
      ctx.fillStyle = '#3f7344';
      ctx.beginPath();
      ctx.ellipse(plantX, plantY - 14, 18, 22, 0.1, 0, Math.PI * 2);
      ctx.fill();

      ctx.fillStyle = '#57945d';
      ctx.beginPath();
      ctx.ellipse(plantX - 8, plantY - 24, 12, 16, -0.3, 0, Math.PI * 2);
      ctx.fill();

      ctx.beginPath();
      ctx.ellipse(plantX + 8, plantY - 22, 14, 16, 0.3, 0, Math.PI * 2);
      ctx.fill();
    }

    // Room Style Label on Canvas
    ctx.fillStyle = 'rgba(255, 255, 255, 0.9)';
    ctx.font = '600 14px Kanit, sans-serif';
    ctx.fillText(`✨ ${state.matchedProfile.titleTh} | Perspective 3D`, 20, 32);

    ctx.fillStyle = 'rgba(255, 255, 255, 0.5)';
    ctx.font = '12px Kanit, sans-serif';
    ctx.fillText(`ผนัง: ${state.wallColor} | พื้น: ${state.floorType}`, 20, 52);
  }

  // Draw 2D Architectural Floor Plan Blueprint
  function draw2DBlueprint(ctx, w, h) {
    const pad = 48;
    const roomW = w - pad * 2;
    const roomH = h - pad * 2;

    // Background: Dark Blueprint Navy
    ctx.fillStyle = '#111726';
    ctx.fillRect(0, 0, w, h);

    // Grid lines
    ctx.strokeStyle = 'rgba(95, 201, 232, 0.12)';
    ctx.lineWidth = 1;
    const gridSize = 24;
    for (let x = 0; x < w; x += gridSize) {
      ctx.beginPath(); ctx.moveTo(x, 0); ctx.lineTo(x, h); ctx.stroke();
    }
    for (let y = 0; y < h; y += gridSize) {
      ctx.beginPath(); ctx.moveTo(0, y); ctx.lineTo(w, y); ctx.stroke();
    }

    // Main Room Boundary Walls
    ctx.strokeStyle = '#5fc9e8';
    ctx.lineWidth = 6;
    ctx.strokeRect(pad, pad, roomW, roomH);

    // Inner Wall Line
    ctx.strokeStyle = 'rgba(95, 201, 232, 0.4)';
    ctx.lineWidth = 1;
    ctx.strokeRect(pad + 8, pad + 8, roomW - 16, roomH - 16);

    // Doorway Arc (Bottom Right)
    const doorX = pad + roomW - 80;
    const doorY = pad + roomH;
    ctx.strokeStyle = '#ff8a1e';
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.arc(doorX, doorY, 50, Math.PI, Math.PI * 1.5);
    ctx.stroke();
    ctx.beginPath();
    ctx.moveTo(doorX, doorY);
    ctx.lineTo(doorX - 50, doorY);
    ctx.stroke();

    // 2D Furniture Blocks:
    // 1. Rug
    if (state.furnitureVisibility.rug) {
      ctx.strokeStyle = 'rgba(255, 255, 255, 0.4)';
      ctx.fillStyle = 'rgba(255, 255, 255, 0.08)';
      ctx.lineWidth = 1.5;
      ctx.setLineDash([4, 4]);
      ctx.beginPath();
      ctx.roundRect(pad + roomW * 0.2, pad + roomH * 0.22, roomW * 0.55, roomH * 0.55, 12);
      ctx.fill();
      ctx.stroke();
      ctx.setLineDash([]);
      ctx.fillStyle = 'rgba(255, 255, 255, 0.5)';
      ctx.font = '11px Kanit, sans-serif';
      ctx.fillText('RUG / พรมปูพื้น', pad + roomW * 0.2 + 10, pad + roomH * 0.22 + 20);
    }

    // 2. Sofa (Top Wall)
    if (state.furnitureVisibility.sofa) {
      ctx.fillStyle = 'rgba(255, 138, 30, 0.25)';
      ctx.strokeStyle = '#ff8a1e';
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.roundRect(pad + roomW * 0.25, pad + 20, roomW * 0.46, 70, 8);
      ctx.fill();
      ctx.stroke();
      ctx.fillStyle = '#fff';
      ctx.font = '600 12px Kanit, sans-serif';
      ctx.fillText('🛋️ 3-SEATER SOFA', pad + roomW * 0.25 + 16, pad + 60);
    }

    // 3. Coffee Table (Center)
    if (state.furnitureVisibility.table) {
      ctx.fillStyle = 'rgba(95, 201, 232, 0.25)';
      ctx.strokeStyle = '#5fc9e8';
      ctx.lineWidth = 2;
      ctx.beginPath();
      ctx.roundRect(pad + roomW * 0.35, pad + roomH * 0.44, roomW * 0.26, 50, 20);
      ctx.fill();
      ctx.stroke();
      ctx.fillStyle = '#fff';
      ctx.font = '600 11px Kanit, sans-serif';
      ctx.fillText('COFFEE TABLE', pad + roomW * 0.35 + 12, pad + roomH * 0.44 + 30);
    }

    // 4. Floor Lamp
    if (state.furnitureVisibility.lamp) {
      const lampX = pad + roomW * 0.78;
      const lampY = pad + 45;
      ctx.fillStyle = '#ffc83b';
      ctx.beginPath();
      ctx.arc(lampX, lampY, 14, 0, Math.PI * 2);
      ctx.fill();
      ctx.strokeStyle = '#fff';
      ctx.stroke();
      ctx.fillStyle = '#ffc83b';
      ctx.font = '10px Kanit, sans-serif';
      ctx.fillText('💡 LAMP', lampX - 16, lampY + 28);
    }

    // 5. Houseplant
    if (state.furnitureVisibility.plant) {
      const plantX = pad + 38;
      const plantY = pad + 40;
      ctx.fillStyle = '#48bb78';
      ctx.beginPath();
      ctx.arc(plantX, plantY, 16, 0, Math.PI * 2);
      ctx.fill();
      ctx.fillStyle = '#fff';
      ctx.font = '10px Kanit, sans-serif';
      ctx.fillText('🌿 PLANT', plantX - 18, plantY + 30);
    }

    // Dimensions text
    ctx.fillStyle = '#5fc9e8';
    ctx.font = '12px Kanit, sans-serif';
    ctx.fillText(`↔ 5.40 M`, w / 2 - 25, pad - 12);
    ctx.fillText(`↕ 4.20 M`, pad - 42, h / 2);

    // Label
    ctx.fillStyle = '#ffffff';
    ctx.font = '600 14px Kanit, sans-serif';
    ctx.fillText(`📐 Architectural 2D Blueprint | ${state.matchedProfile.titleTh}`, 20, 26);
  }

  // Toast Notification Helper
  function showToast(msg) {
    let toast = document.getElementById('designer-toast');
    if (!toast) {
      toast = document.createElement('div');
      toast.id = 'designer-toast';
      toast.style.position = 'fixed';
      toast.style.bottom = '28px';
      toast.style.right = '28px';
      toast.style.background = 'rgba(23, 26, 38, 0.94)';
      toast.style.color = '#ffffff';
      toast.style.padding = '14px 24px';
      toast.style.borderRadius = '999px';
      toast.style.fontSize = '14px';
      toast.style.fontWeight = '500';
      toast.style.boxShadow = '0 12px 36px rgba(0,0,0,0.3)';
      toast.style.zIndex = '9999';
      toast.style.border = '1px solid rgba(255, 138, 30, 0.4)';
      toast.style.transition = 'opacity 0.3s, transform 0.3s';
      toast.style.backdropFilter = 'blur(12px)';
      toast.style.display = 'flex';
      toast.style.alignItems = 'center';
      toast.style.gap = '8px';
      document.body.appendChild(toast);
    }
    toast.textContent = msg;
    toast.style.opacity = '1';
    toast.style.transform = 'translateY(0)';
    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateY(10px)';
    }, 3200);
  }

  function escapeHtml(str) {
    return String(str || '').replace(/[&<>"']/g, (c) => ({
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#39;'
    }[c]));
  }

})();
