/**
 * Maison Forme - Student Project Self-Evaluation & Progress Tracker (100%)
 * ควบคุมตรรกะการคำนวณคะแนนประเมินตนเองของนิสิต บันทึกข้อมูล และส่งออกรายงาน
 */

// โครงสร้างเกณฑ์การประเมิน 100% ครอบคลุม 6 ด้าน
const EVALUATION_RUBRICS = [
  {
    id: "req",
    name: "1. ด้านข้อกำหนดและการวิเคราะห์ระบบ (Requirements & Analysis)",
    weight: 15,
    items: [
      { id: "req_scope", title: "นิยามปัญหา วัตถุประสงค์ และขอบเขตโครงงานชัดเจน", desc: "มีที่มาและความสำคัญ วัตถุประสงค์หลัก และเป้าหมายของระบบชัดเจน", points: 5 },
      { id: "req_fn", title: "วิเคราะห์ Functional & Non-Functional Requirements ครบถ้วน", desc: "แจกแจงฟังก์ชันการทำงาน และข้อกำหนดด้านประสิทธิภาพ/ความปลอดภัย", points: 5 },
      { id: "req_story", title: "ออกแบบ Use Case Specifications และ User Stories", desc: "จัดทำเส้นทางประสบการณ์ผู้ใช้งาน (User Journey) และ Use Case หลัก", points: 5 }
    ]
  },
  {
    id: "arch",
    name: "2. ด้านสถาปัตยกรรมไมโครเซอร์วิส (Microservices Architecture Design)",
    weight: 20,
    items: [
      { id: "arch_decomp", title: "การแบ่ง Domain-Driven Services (7 Core Microservices)", desc: "แยกโมดูลตามความรับผิดชอบเดี่ยว (Auth, Catalog, 3D Studio, Cart, Content, AI, Eval)", points: 5 },
      { id: "arch_gw", title: "การออกแบบ API Gateway & Service Ingress Routing", desc: "มีทางเข้าคำขอเดี่ยว จัดการ Reverse Proxy, Routing และ Rate Limiting", points: 5 },
      { id: "arch_event", title: "การสื่อสารแบบ Event-Driven และ Polyglot Persistence", desc: "ออกแบบช่องทาง Event Bus (Kafka/RabbitMQ) และเลือกใช้ฐานข้อมูลตรงตามลักษณะงาน", points: 5 },
      { id: "arch_resilience", title: "การออกแบบ Fault Tolerance & Circuit Breaker ตามแนวคิด Netflix", desc: "มีระบบป้องกันความล้มเหลวแบบต่อเนื่อง (Hystrix Pattern) และ Fallback Response", points: 5 }
    ]
  },
  {
    id: "fe",
    name: "3. ด้านประสบการณ์ผู้ใช้และฟรอนต์เอนด์ (Frontend UI/UX Experience)",
    weight: 20,
    items: [
      { id: "fe_glass", title: "การประยุกต์ใช้ Apple iOS Glassmorphism Design Tokens", desc: "ดีไซน์หรูหราทันสมัย เอฟเฟกต์ Frosted Glass เบลอพื้นหลัง และชุดสี Amber/Copper", points: 5 },
      { id: "fe_studio", title: "ระบบ 3D Studio / Room Canvas Designer แบบ Interactive", desc: "สตูดิโอจำลองห้อง ปรับแต่งขนาด และจัดวางเฟอร์นิเจอร์แบบ Real-time", points: 5 },
      { id: "fe_responsive", title: "รองรับการแสดงผล Responsive ทุกอุปกรณ์ (Desktop/Tablet/Mobile)", desc: "หน้าเว็บจัดเรียงสวยงามทุก Viewport และรองรับ Touch Interaction", points: 5 },
      { id: "fe_guard", title: "ระบบ Client State, Navigation และ Auth Guard", desc: "มี Guard ป้องกันหน้าที่ต้อง Login และการซิงค์สถานะตะกร้าสินค้าข้ามหน้าเว็บ", points: 5 }
    ]
  },
  {
    id: "be",
    name: "4. ด้าน RESTful APIs และการจัดการข้อมูล (Backend & Data Layer)",
    weight: 20,
    items: [
      { id: "be_rest", title: "การพัฒนา Modular RESTful API Endpoints (JSON Standard)", desc: "API ส่งคืน JSON มาตรฐาน มี HTTP Status Codes ชัดเจน (Products, Auth, Search)", points: 5 },
      { id: "be_auth", title: "ระบบ Session/Token Authentication & Password Hashing", desc: "เข้ารหัสรหัสผ่านด้วย BCRYPT และจัดการสิทธิ์ผู้ใช้ผ่าน Session ปลอดภัย", points: 5 },
      { id: "be_db", title: "ฐานข้อมูล MySQL 8.0, Schema Design & Seed Data", desc: "มีตารางข้อมูลความสัมพันธ์ (InnoDB), Foreign Keys และข้อมูลทดสอบเริ่มต้น", points: 5 },
      { id: "be_sanitize", title: "การตรวจสอบความถูกต้องของข้อมูล (Validation & Sanitization)", desc: "ป้องกัน SQL Injection ด้วย Prepared Statements และกรองค่า Input", points: 5 }
    ]
  },
  {
    id: "devops",
    name: "5. ด้าน DevOps คอนเทนเนอร์และคลาวด์ (Docker & Deployment Ready)",
    weight: 15,
    items: [
      { id: "do_compose", title: "การสร้าง Multi-container ด้วย Docker & Docker Compose", desc: "คอนฟิก Web (Apache+PHP), DB (MySQL 8.0) และ phpMyAdmin รันได้ด้วยคำสั่งเดียว", points: 5 },
      { id: "do_env", title: "ระบบ Environment Detection รองรับทั้ง Local (XAMPP) และ Docker", desc: "ไฟล์ config/db.php ตรวจสอบสภาพแวดล้อมอัตโนมัติ ไม่ต้องแก้โค้ดข้ามเครื่อง", points: 5 },
      { id: "do_cloud", title: "ความพร้อมสำหรับการขยายตัวบน Cloud (Elasticity & CI/CD)", desc: "โครงสร้างพร้อมนำไปรันบน AWS ECS / Kubernetes หรือ Cloud Platform", points: 5 }
    ]
  },
  {
    id: "qa",
    name: "6. ด้านการทดสอบ ความปลอดภัย และการประเมินตนเอง (QA & Reflection)",
    weight: 10,
    items: [
      { id: "qa_test", title: "การทดสอบฟังก์ชันงานและ End-to-End User Journeys", desc: "ทดสอบการสมัครสมาชิก ค้นหา เพิ่มลงตะกร้า ออกแบบ 3D และชำระเงิน", points: 4 },
      { id: "qa_doc", title: "จัดทำเอกสารคู่มือ README, Microservices & Tech Stack ครบถ้วน", desc: "มีคู่มือติดตั้ง สถาปัตยกรรมไมโครเซอร์วิส และแผนภาพเทคโนโลยีชัดเจน", points: 3 },
      { id: "qa_reflect", title: "การสะท้อนผลการเรียนรู้ ปัญหาอุปสรรค และข้อเสนอแนะ", desc: "บันทึกสิ่งที่ได้เรียนรู้ อุปสรรคที่พบ และแนวทางการต่อยอดโครงงาน", points: 3 }
    ]
  }
];

const STORAGE_KEY = "maison_forme_student_evaluation_v1";

document.addEventListener("DOMContentLoaded", () => {
  renderRubrics();
  loadSavedData();
  bindEvents();
  updateCalculation();
});

// เรนเดอร์รายการเกณฑ์ประเมินทั้ง 6 หมวด
function renderRubrics() {
  const container = document.getElementById("rubricsContainer");
  if (!container) return;

  container.innerHTML = EVALUATION_RUBRICS.map((category, catIndex) => {
    return `
      <div class="eval-card mb-4" data-category="${category.id}">
        <div class="eval-card-header">
          <div class="eval-card-title">
            <span class="badge-number">${catIndex + 1}</span>
            <h3>${category.name}</h3>
          </div>
          <div class="category-score-badge">
            <span id="cat_score_${category.id}">0</span> / ${category.weight}%
          </div>
        </div>

        <div class="cat-progress-track">
          <div class="cat-progress-fill" id="cat_fill_${category.id}" style="width: 0%"></div>
        </div>

        <div class="rubric-items-list">
          ${category.items.map(item => `
            <label class="rubric-item" for="${item.id}">
              <div class="rubric-checkbox-wrapper">
                <input type="checkbox" id="${item.id}" data-points="${item.points}" data-category="${category.id}" class="rubric-checkbox">
                <span class="custom-checkbox"></span>
              </div>
              <div class="rubric-info">
                <div class="rubric-item-header">
                  <span class="rubric-title">${item.title}</span>
                  <span class="rubric-points">+${item.points}%</span>
                </div>
                <p class="rubric-desc">${item.desc}</p>
              </div>
            </label>
          `).join("")}
        </div>
      </div>
    `;
  }).join("");
}

// ผูก Event Listeners
function bindEvents() {
  // Event เมื่อคลิกเลือก Checkbox เกณฑ์ประเมิน
  document.querySelectorAll(".rubric-checkbox").forEach(cb => {
    cb.addEventListener("change", () => {
      updateCalculation();
      autoSaveLocal();
    });
  });

  // Event Input ข้อมูลส่วนตัว
  ["studentId", "studentName", "projectTitle", "githubUrl", "demoUrl", "reflections"].forEach(id => {
    const el = document.getElementById(id);
    if (el) {
      el.addEventListener("input", autoSaveLocal);
    }
  });

  // ปุ่มกดต่าง ๆ
  document.getElementById("btnSave")?.addEventListener("click", saveToServerAndLocal);
  document.getElementById("btnPreset100")?.addEventListener("click", () => applyPreset(100));
  document.getElementById("btnPreset80")?.addEventListener("click", () => applyPreset(80));
  document.getElementById("btnReset")?.addEventListener("click", resetAll);
  document.getElementById("btnExportJSON")?.addEventListener("click", exportEvaluationJSON);
  document.getElementById("btnPrint")?.addEventListener("click", () => window.print());
}

// คำนวณคะแนนรวมและเปอร์เซ็นต์แบบ Real-time
function updateCalculation() {
  let totalScore = 0;
  const categoryScores = { req: 0, arch: 0, fe: 0, be: 0, devops: 0, qa: 0 };

  document.querySelectorAll(".rubric-checkbox").forEach(cb => {
    if (cb.checked) {
      const points = parseFloat(cb.dataset.points) || 0;
      const cat = cb.dataset.category;
      totalScore += points;
      if (categoryScores[cat] !== undefined) {
        categoryScores[cat] += points;
      }
    }
  });

  totalScore = Math.min(100, Math.round(totalScore * 10) / 10);

  // อัปเดตคะแนนรายหมวด
  EVALUATION_RUBRICS.forEach(cat => {
    const scoreEl = document.getElementById(`cat_score_${cat.id}`);
    const fillEl = document.getElementById(`cat_fill_${cat.id}`);
    const score = categoryScores[cat.id] || 0;
    const pct = Math.round((score / cat.weight) * 100);

    if (scoreEl) scoreEl.textContent = score;
    if (fillEl) fillEl.style.width = `${pct}%`;
  });

  // อัปเดต Gauge หลัก
  const percentageEl = document.getElementById("gaugePercentage");
  const circleEl = document.getElementById("gaugeCircle");
  const gradeEl = document.getElementById("gradeBadge");
  const statusEl = document.getElementById("statusBadge");
  const progressFillMain = document.getElementById("mainProgressFill");

  if (percentageEl) percentageEl.textContent = `${totalScore}%`;
  if (progressFillMain) progressFillMain.style.width = `${totalScore}%`;

  // อัปเดต SVG Circular Progress
  // เส้นรอบวง r=65 -> 2 * PI * 65 ≈ 408.4
  if (circleEl) {
    const circumference = 408.4;
    const offset = circumference - (totalScore / 100) * circumference;
    circleEl.style.strokeDashoffset = offset;

    // เปลี่ยนสีวงกลมตามระดับคะแนน
    if (totalScore >= 85) {
      circleEl.style.stroke = "#10b981"; // Emerald
    } else if (totalScore >= 70) {
      circleEl.style.stroke = "#06b6d4"; // Cyan
    } else if (totalScore >= 50) {
      circleEl.style.stroke = "#f59e0b"; // Amber
    } else {
      circleEl.style.stroke = "#ef4444"; // Red
    }
  }

  // คำนวณเกรดและสถานะ
  let grade = "F";
  let status = "เริ่มต้นโครงการ (Initial)";
  let statusColor = "#ef4444";

  if (totalScore >= 85) {
    grade = "A (ดีเยี่ยม - Production Ready)";
    status = "พร้อมใช้งานระดับโปรดักชัน (100% Complete)";
    statusColor = "#10b981";
  } else if (totalScore >= 75) {
    grade = "B+ (ดีมาก - MVP Ready)";
    status = "พร้อมทดสอบฟังก์ชันหลัก (MVP Candidate)";
    statusColor = "#06b6d4";
  } else if (totalScore >= 65) {
    grade = "B (ดี - Core Done)";
    status = "ฟังก์ชันสำคัญแล้วเสร็จ (Core Features Done)";
    statusColor = "#3b82f6";
  } else if (totalScore >= 50) {
    grade = "C (ผ่านเกณฑ์ - In Progress)";
    status = "อยู่ระหว่างการพัฒนาขั้นกลาง (In Progress)";
    statusColor = "#f59e0b";
  } else {
    grade = "D/F (กำลังเริ่มต้น)";
    status = "กำลังพัฒนาโครงร่างแรก (Prototyping)";
    statusColor = "#ef4444";
  }

  if (gradeEl) gradeEl.textContent = grade;
  if (statusEl) {
    statusEl.textContent = status;
    statusEl.style.color = statusColor;
    statusEl.style.borderColor = statusColor;
  }

  return { totalScore, categoryScores, grade, status };
}

// โหลดข้อมูลที่เคยบันทึกไว้ (LocalStorage หรือ REST API)
async function loadSavedData() {
  let loaded = false;

  // 1. ลองดึงจาก LocalStorage ก่อน
  const localData = localStorage.getItem(STORAGE_KEY);
  if (localData) {
    try {
      const parsed = jsonDecodeSafe(localData);
      if (parsed) {
        applyDataToUI(parsed);
        loaded = true;
      }
    } catch (e) {
      console.warn("Could not parse local data", e);
    }
  }

  // 2. หากใน LocalStorage ไม่มี ลองดึงจาก REST API
  if (!loaded) {
    try {
      const res = await fetch("api_evaluation.php");
      if (res.ok) {
        const json = await res.json();
        if (json && json.data) {
          applyDataToUI(json.data);
          loaded = true;
        }
      }
    } catch (e) {
      console.log("No remote evaluation data found or running on file protocol.");
    }
  }

  // หากไม่มีข้อมูลเลย โหลดค่าเริ่มต้น 100% ตัวอย่างโครงงานที่เสร็จสมบูรณ์
  if (!loaded) {
    applyPreset(100);
  } else {
    updateCalculation();
  }
}

// นำ Object ข้อมูลมาใส่ลง Form & Checkbox
function applyDataToUI(data) {
  if (!data) return;

  if (data.student_id) setValue("studentId", data.student_id);
  if (data.student_name) setValue("studentName", data.student_name);
  if (data.project_title) setValue("projectTitle", data.project_title);
  if (data.github_url) setValue("githubUrl", data.github_url);
  if (data.demo_url) setValue("demoUrl", data.demo_url);
  if (data.reflections) setValue("reflections", data.reflections);

  if (data.rubrics && typeof data.rubrics === "object") {
    document.querySelectorAll(".rubric-checkbox").forEach(cb => {
      cb.checked = Boolean(data.rubrics[cb.id]);
    });
  }

  updateCalculation();
}

function setValue(id, val) {
  const el = document.getElementById(id);
  if (el) el.value = val;
}

function getValue(id) {
  const el = document.getElementById(id);
  return el ? el.value.trim() : "";
}

// บันทึกลง LocalStorage อัตโนมัติ
function autoSaveLocal() {
  const payload = getPayload();
  localStorage.setItem(STORAGE_KEY, JSON.stringify(payload));
}

// รวบรวม Payload ทั้งหมด
function getPayload() {
  const calc = updateCalculation();
  const rubricsState = {};
  document.querySelectorAll(".rubric-checkbox").forEach(cb => {
    rubricsState[cb.id] = cb.checked;
  });

  return {
    student_id: getValue("studentId") || "67160360-AI",
    student_name: getValue("studentName") || "นิสิตตัวอย่าง (Maison Forme Team)",
    project_title: getValue("projectTitle") || "Maison Forme - Furniture & Smart Home Studio",
    github_url: getValue("githubUrl") || "https://github.com/67160360-AI/furniture-ai-webapp",
    demo_url: getValue("demoUrl") || "http://localhost:8080",
    total_score: calc.totalScore,
    percentage: calc.totalScore,
    grade: calc.grade,
    status: calc.status,
    category_scores: calc.categoryScores,
    rubrics: rubricsState,
    reflections: getValue("reflections") || "การนำสถาปัตยกรรม Microservices และแนวคิดของ Netflix มาประยุกต์ใช้ ช่วยให้แบ่งงานเป็นระบบ รองรับการขยายตัวและการทดสอบแบบคอนเทนเนอร์ได้อย่างดีเยี่ยม",
    updated_at: new Date().toISOString()
  };
}

// บันทึกทั้ง Server API และ LocalStorage
async function saveToServerAndLocal() {
  const payload = getPayload();
  autoSaveLocal();

  const toast = document.getElementById("toastNotify");
  showToast("กำลังบันทึกข้อมูล...", "info");

  try {
    const res = await fetch("api_evaluation.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(payload)
    });

    const json = await res.json();
    if (json.success) {
      showToast(`✅ บันทึกผลการประเมินสำเร็จ (${payload.percentage}%)`, "success");
    } else {
      showToast(`บันทึกใน LocalStorage เรียบร้อย (API: ${json.error || "บันทึกในเครื่อง"})`, "success");
    }
  } catch (err) {
    showToast(`✅ บันทึกผลการประเมินใน LocalStorage เรียบร้อยแล้ว`, "success");
  }
}

// นำ Preset มาใช้ (เช่น 100% เต็ม หรือ 80% หรือ รีเซ็ต)
function applyPreset(score) {
  if (score === 100) {
    document.querySelectorAll(".rubric-checkbox").forEach(cb => { cb.checked = true; });
    setValue("studentId", "67160360-AI");
    setValue("studentName", "นายชาญวิทย์ พัฒนากุล (ตัวแทนกลุ่มโครงงาน)");
    setValue("projectTitle", "Maison Forme - Furniture & Smart Home WebApp");
    setValue("githubUrl", "https://github.com/67160360-AI/furniture-ai-webapp");
    setValue("demoUrl", "http://localhost:8080");
    setValue("reflections", "โครงงานได้ดำเนินการเสร็จสมบูรณ์ 100% ตามข้อกำหนดวิศวกรรมซอฟต์แวร์: มีระบบสถาปัตยกรรมไมโครเซอร์วิส 7 โมดูล, หน้าเว็บ Glassmorphism สวยงาม, 3D Studio, REST APIs, และ Docker Multi-container พร้อมเอกสารสมบูรณ์");
  } else if (score === 80) {
    document.querySelectorAll(".rubric-checkbox").forEach((cb, idx) => {
      // ติ๊กประมาณ 80% ของรายการทั้งหมด
      cb.checked = (idx % 5 !== 0);
    });
    setValue("reflections", "โครงงานหลักแล้วเสร็จ 80% อยู่ในระดับ MVP ที่พร้อมทดสอบ เหลือการเก็บตกการทดสอบระบบโหลดสูงและความทนทาน");
  }
  updateCalculation();
  autoSaveLocal();
  showToast(`นำเข้าชุดข้อมูลตัวอย่าง (${score}%) สำเร็จ`, "info");
}

// ล้างข้อมูลทั้งหมดเป็น 0
function resetAll() {
  if (!confirm("คุณต้องการรีเซ็ตค่าการประเมินทั้งหมดใช่หรือไม่?")) return;
  document.querySelectorAll(".rubric-checkbox").forEach(cb => { cb.checked = false; });
  setValue("reflections", "");
  updateCalculation();
  autoSaveLocal();
  showToast("รีเซ็ตเกณฑ์การประเมินเป็น 0% เรียบร้อย", "info");
}

// ส่งออกไฟล์ JSON รายงานผล
function exportEvaluationJSON() {
  const payload = getPayload();
  const dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(payload, null, 2));
  const downloadAnchor = document.createElement("a");
  const filename = `evaluation_report_${payload.student_id || "student"}_${payload.percentage}pct.json`;

  downloadAnchor.setAttribute("href", dataStr);
  downloadAnchor.setAttribute("download", filename);
  document.body.appendChild(downloadAnchor);
  downloadAnchor.click();
  downloadAnchor.remove();

  showToast(`ส่งออกรายงาน ${filename} สำเร็จ`, "success");
}

// แสดง Toast Notification แบบ Glassmorphism
function showToast(message, type = "info") {
  let toast = document.getElementById("evalToast");
  if (!toast) {
    toast = document.createElement("div");
    toast.id = "evalToast";
    document.body.appendChild(toast);
  }

  toast.className = `eval-toast eval-toast-${type} show`;
  toast.textContent = message;

  setTimeout(() => {
    toast.className = "eval-toast";
  }, 3500);
}

function jsonDecodeSafe(str) {
  try {
    return JSON.parse(str);
  } catch (e) {
    return null;
  }
}
