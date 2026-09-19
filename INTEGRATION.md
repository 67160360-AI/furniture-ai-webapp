# 📦 รายการไฟล์และโมดูลที่ได้รับการ Integrate (Integration Manifest)
## โครงการ Maison Forme — Furniture & Smart Home WebApp

เอกสารนี้รวบรวมและแจกแจงรายละเอียดสิ่งที่ได้รับการ **Integrate เพิ่มเติม** ทั้งหมดในระบบ เพื่อให้นิสิตและอาจารย์ผู้สอนสามารถตรวจสอบรายการไฟล์ ตรรกะการทำงาน สถาปัตยกรรม และการเชื่อมต่อระบบได้อย่างสะดวกรวดเร็ว

---

## 📑 สารบัญการ Integrate (Table of Contents)
1. [ตารางสรุปรายการไฟล์ทั้งหมดที่ Integrate (Files Manifest)](#1-ตารางสรุปรายการไฟล์ทั้งหมดที่-integrate-files-manifest)
2. [โมดูลที่ 1: ระบบประเมินผลงานตนเองของนิสิต (0-100% Evaluation Tool)](#2-โมดูลที่-1-ระบบประเมินผลงานตนเองของนิสิต-0-100-evaluation-tool)
3. [โมดูลที่ 2: เอกสารและแผนภาพ Microservices Architecture](#3-โมดูลที่-2-เอกสารและแผนภาพ-microservices-architecture)
4. [โมดูลที่ 3: เอกสารและแผนภาพ Technology Stack Diagram (Netflix Model)](#4-โมดูลที่-3-เอกสารและแผนภาพ-technology-stack-diagram-netflix-model)
5. [โมดูลที่ 4: Backend REST API และระบบจัดเก็บข้อมูล (Data Persistence)](#5-โมดูลที่-4-backend-rest-api-และระบบจัดเก็บข้อมูล-data-persistence)
6. [โมดูลที่ 5: การเชื่อมต่อระบบนำทางเดิม (Navigation & UI Integration)](#6-โมดูลที่-5-การเชื่อมต่อระบบนำทางเดิม-navigation--ui-integration)
7. [วิธีการเข้าใช้งานและคำสั่งทดสอบ (Verification & Quick Run)](#7-วิธีการเข้าใช้งานและคำสั่งทดสอบ-verification--quick-run)

---

## 1. ตารางสรุปรายการไฟล์ทั้งหมดที่ Integrate (Files Manifest)

| สถานะ | ลำดับ | เส้นทางไฟล์ (File Path) | หมวดหมู่ | คำอธิบายสิ่งที่ Integrate เข้าไป |
|:---:|:---:|---|---|---|
| 🟢 **NEW** | 1 | [`evaluation.html`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/evaluation.html) | User Interface | หน้าระบบประเมินผลงานตนเองของนิสิต ดีไซน์ Apple iOS Glassmorphism พร้อมเกจวัดความสำเร็จ 0-100% และ Checklist 6 มิติ |
| 🟢 **NEW** | 2 | [`evaluation.php`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/evaluation.php) | Server Entry | Wrapper รองรับการเข้าถึงหน้าประเมินผ่านเว็บเซิร์ฟเวอร์ PHP/Apache บนพอร์ต 8080 |
| 🟢 **NEW** | 3 | [`assets/js/evaluation.js`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/assets/js/evaluation.js) | Client Logic | ตรรกะคำนวณคะแนน Rubrics รวม 100%, แอนิเมชัน SVG Gauge, ระบบเซฟ LocalStorage/API และ Export JSON |
| 🟢 **NEW** | 4 | [`api/evaluation.php`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/api/evaluation.php) | Backend API | REST API รองรับ `GET` (ดึงข้อมูลประเมินล่าสุด) และ `POST` (บันทึกข้อมูลประเมินลงฐานข้อมูลและไฟล์ JSON) |
| 🟢 **NEW** | 5 | [`api_evaluation.php`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/api_evaluation.php) | API Forwarder | รูท Forwarder สำหรับเรียกใช้งาน API จาก Root URL ตามแพตเทิร์นของสถาปัตยกรรมเดิม |
| 🟢 **NEW** | 6 | [`assets/images/microservices_architecture.svg`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/assets/images/microservices_architecture.svg) | Architecture Vector | แผนภาพเวกเตอร์ SVG แสดงสถาปัตยกรรมไมโครเซอร์วิส 7 โดเมน, API Gateway, Event Bus และ Polyglot Persistence |
| 🟢 **NEW** | 7 | [`assets/images/tech_stack_diagram.svg`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/assets/images/tech_stack_diagram.svg) | Architecture Vector | แผนภาพเวกเตอร์ SVG แสดง Technology Stack 6 เลเยอร์ อิงตามแบบจำลองของ Netflix |
| 🟢 **NEW** | 8 | [`docs/MICROSERVICES_ARCHITECTURE.md`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/docs/MICROSERVICES_ARCHITECTURE.md) | Documentation | เอกสารสถาปัตยกรรมไมโครเซอร์วิสฉบับเต็ม พร้อมแผนภาพ Mermaid, ตารางแจกแจงหน้าที่ และกลไก Circuit Breaker |
| 🟢 **NEW** | 9 | [`docs/TECH_STACK_DIAGRAM.md`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/docs/TECH_STACK_DIAGRAM.md) | Documentation | เอกสารวิเคราะห์และเปรียบเทียบการถอดบทเรียน 10 ข้อจาก Netflix สู่โครงงานของนิสิต |
| 🟢 **NEW** | 10 | [`database/evaluation_data.json`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/database/evaluation_data.json) | Data Store | ไฟล์จัดเก็บประวัติผลการประเมินตนเองของนิสิตแบบ Document Store สำหรับอ่าน/เขียนแบบรวดเร็ว |
| 🔵 **MOD** | 11 | [`README.md`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/README.md) | Project Guide | เพิ่มโครงสร้างโฟลเดอร์ใหม่, เพิ่มคู่มือระบบประเมิน 100%, แนบแผนภาพสถาปัตยกรรมและลิงก์เอกสาร |
| 🔵 **MOD** | 12 | [`index.php`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/index.php) | Navigation | เพิ่มเมนูนำทาง `📊 ประเมินโครงงาน (100%)` ในแถบ Navbar |
| 🔵 **MOD** | 13 | [`index.html`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/index.html) | Navigation | เพิ่มเมนูนำทาง `📊 ประเมินโครงงาน (100%)` ในแถบ Navbar |
| 🔵 **MOD** | 14 | [`dashboard.html`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/dashboard.html) | Dashboard & Nav | เพิ่มการ์ดทางลัดเข้าสู่ระบบประเมิน และเพิ่มลิงก์ในเมนูนำทาง |
| 🔵 **MOD** | 15 | [`products.html`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/products.html) | Navigation | เพิ่มเมนูนำทาง `📊 ประเมินโครงงาน` ในแถบ Navbar |
| 🔵 **MOD** | 16 | [`furniture-designer.html`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/furniture-designer.html) | Navigation | เพิ่มเมนูนำทาง `📊 ประเมินโครงงาน` ในแถบ Navbar |
| 🔵 **MOD** | 17 | [`furniture-designer.php`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/furniture-designer.php) | Navigation | เพิ่มเมนูนำทาง `📊 ประเมินโครงงาน` ในแถบ Navbar |

---

## 2. โมดูลที่ 1: ระบบประเมินผลงานตนเองของนิสิต (0-100% Evaluation Tool)

### ไฟล์ที่เกี่ยวข้อง:
- ฟรอนต์เอนด์: [`evaluation.html`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/evaluation.html) และ [`evaluation.php`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/evaluation.php)
- ตรรกะการทำงาน: [`assets/js/evaluation.js`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/assets/js/evaluation.js)

### ฟังก์ชันหลักที่ทำงานร่วมกัน:
1. **Circular Progress Gauge (SVG)**:
   - คำนวณเส้นรอบวง $2 \times \pi \times 65 \approx 408.4$
   - แอนิเมชันปรับเปลี่ยน `stroke-dashoffset` และสีของขอบวงกลมแบบไดนามิก (แดง $\rightarrow$ ส้ม $\rightarrow$ ฟ้า $\rightarrow$ เขียวมรกต)
2. **คำนวณเกรดและสถานะแบบ Real-time**:
   - $85 - 100\%$: เกรด **A** (ระดับดีเยี่ยม - Production Ready)
   - $75 - 84\%$: เกรด **B+** (ระดับดีมาก - MVP Ready)
   - $65 - 74\%$: เกรด **B** (ระดับดี - Core Features Complete)
   - $50 - 64\%$: เกรด **C** (ระดับผ่านเกณฑ์ - In Progress)
   - $0 - 49\%$: เกรด **D/F** (ระดับเริ่มต้นโครงงาน)
3. **เกณฑ์การประเมิน 6 มิติ (รวม 100% เต็ม)**:
   - ด้านที่ 1: ข้อกำหนดและการวิเคราะห์ระบบ (15%)
   - ด้านที่ 2: สถาปัตยกรรมไมโครเซอร์วิส (20%)
   - ด้านที่ 3: ประสบการณ์ผู้ใช้และฟรอนต์เอนด์ (20%)
   - ด้านที่ 4: RESTful APIs และการจัดการข้อมูล (20%)
   - ด้านที่ 5: DevOps คอนเทนเนอร์และคลาวด์ (15%)
   - ด้านที่ 6: การทดสอบ ความปลอดภัย และการประเมินตนเอง (10%)
4. **Interactive Actions**:
   - บันทึกข้อมูลลง LocalStorage + REST API
   - ปุ่ม Preset ดึงข้อมูลตัวอย่าง: `✦ ตัวอย่าง 100%` และ `✦ ตัวอย่าง 80%`
   - ส่งออกไฟล์รายงาน JSON (`exportEvaluationJSON`)
   - พิมพ์รายงานสรุป (`window.print`) พร้อมตัดส่วน UI ที่ไม่จำเป็นออกสำหรับแนบรายงาน

---

## 3. โมดูลที่ 2: เอกสารและแผนภาพ Microservices Architecture

### ไฟล์ที่เกี่ยวข้อง:
- เอกสารคู่มือ: [`docs/MICROSERVICES_ARCHITECTURE.md`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/docs/MICROSERVICES_ARCHITECTURE.md)
- แผนภาพเวกเตอร์: [`assets/images/microservices_architecture.svg`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/assets/images/microservices_architecture.svg)

### 7 ไมโครเซอร์วิสที่ออกแบบไว้:
```
Client (Web / Mobile / 3D Canvas)
   │
   ▼
[API Gateway & Reverse Proxy (Zuul / Kong Pattern)]
   │
   ├── 1. Auth & User Service (Port 8082)
   ├── 2. Product Catalog & Search Service (Port 8083)
   ├── 3. 3D Studio & Room Customizer Service (Port 8084)
   ├── 4. Cart & Order Service (Port 8085)
   ├── 5. Content & Promotion Service (Port 8086)
   ├── 6. AI Smart Match Recommendation (Port 8087)
   └── 7. Student Evaluation & Analytics (Port 8088)
   │
   ▼
[Event Bus (Apache Kafka / RabbitMQ)]
   │
   ▼
[Polyglot Persistence Layer: MySQL 8.0 + Redis Cache + S3 Storage]
```

---

## 4. โมดูลที่ 3: เอกสารและแผนภาพ Technology Stack Diagram (Netflix Model)

### ไฟล์ที่เกี่ยวข้อง:
- เอกสารคู่มือ: [`docs/TECH_STACK_DIAGRAM.md`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/docs/TECH_STACK_DIAGRAM.md)
- แผนภาพเวกเตอร์: [`assets/images/tech_stack_diagram.svg`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/assets/images/tech_stack_diagram.svg)

### การจำแนก 6 เลเยอร์ทางเทคโนโลยี:
1. **Tier 1: Presentation & CDN Layer** (HTML5, Vanilla CSS3 Glassmorphism, JavaScript ES6, Canvas 2D/3D API)
2. **Tier 2: API Gateway & Fault Tolerance** (Apache Reverse Proxy, Auth Token Guard, Circuit Breaker)
3. **Tier 3: Business Microservices Layer** (PHP 8.2 Strict, RESTful APIs, Domain Separation)
4. **Tier 4: Messaging & Multi-tier Caching** (Kafka Event Streaming, Redis EVCache Pattern)
5. **Tier 5: Polyglot Persistence & Data Storage** (MySQL 8.0 InnoDB, MinIO/S3 Storage, JSON Document Store)
6. **Tier 6: DevOps, Cloud Scalability & Observability** (Docker, Docker Compose, Prometheus, Chaos Engineering Mindset)

---

## 5. โมดูลที่ 4: Backend REST API และระบบจัดเก็บข้อมูล (Data Persistence)

### ไฟล์ที่เกี่ยวข้อง:
- [`api/evaluation.php`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/api/evaluation.php)
- [`api_evaluation.php`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/api_evaluation.php)
- [`database/evaluation_data.json`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/database/evaluation_data.json)

### พฤติกรรมการทำงานของ API:
- **`GET /api_evaluation.php`**:
  - ส่งคืนค่าข้อมูลประเมินผลล่าสุดที่บันทึกไว้ในรูปแบบ JSON
  - หากยังไม่มีข้อมูล จะส่งคืนสถานะ `data: null`
- **`POST /api_evaluation.php`**:
  - รับข้อมูล JSON Body: `student_id`, `student_name`, `project_title`, `percentage`, `total_score`, `grade`, `status`, `rubrics`, `reflections`
  - ตรวจสอบความถูกต้องและบันทึกลงในไฟล์ `database/evaluation_data.json` ทันที
  - หากเชื่อมต่อกับ MySQL ได้ จะบันทึกลงในตาราง `student_evaluations` อัตโนมัติ (พร้อมคำสั่ง Auto-create Table)

---

## 6. โมดูลที่ 5: การเชื่อมต่อระบบนำทางเดิม (Navigation & UI Integration)

เพื่อความต่อเนื่องของประสบการณ์ผู้ใช้งาน ระบบประเมินผลงานและเอกสารสถาปัตยกรรมได้รับการเชื่อมโยงผ่านแถบนำทาง (Navbar) ในทุกหน้าของระบบ:

1. **[`index.php`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/index.php)**: เพิ่ม `<a href="evaluation.html">📊 ประเมินโครงงาน (100%)</a>`
2. **[`index.html`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/index.html)**: เพิ่ม `<a href="evaluation.html">📊 ประเมินโครงงาน (100%)</a>`
3. **[`dashboard.html`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/dashboard.html)**: เพิ่มการ์ด `📊 ประเมินโครงงาน (100%)` ใน Grid แดชบอร์ด
4. **[`products.html`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/products.html)**: เพิ่มลิงก์ `📊 ประเมินโครงงาน`
5. **[`furniture-designer.html`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/furniture-designer.html)** และ **[`furniture-designer.php`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/furniture-designer.php)**: เพิ่มลิงก์ `📊 ประเมินโครงงาน`
6. **[`README.md`](file:///d:/Documents/Downloads/furniture-ai-webapp-main/furniture-ai-webapp-main/README.md)**: อัปเดตผังโฟลเดอร์โปรเจกต์และเพิ่มส่วนอธิบายระบบประเมินและสถาปัตยกรรม

---

## 7. วิธีการเข้าใช้งานและคำสั่งทดสอบ (Verification & Quick Run)

### ช่องทางการเปิดดูผลลัพธ์ผ่านเบราว์เซอร์:
- 🌐 **หน้าระบบประเมินผลงานของนิสิต**: [http://localhost:8080/evaluation.html](http://localhost:8080/evaluation.html)
- 🏠 **หน้าแรกของเว็บไซต์**: [http://localhost:8080/index.php](http://localhost:8080/index.php)
- 📊 **หน้าแดชบอร์ดบัญชีผู้ใช้**: [http://localhost:8080/dashboard.html](http://localhost:8080/dashboard.html)
- 🔌 **API ตรวจสอบผลการประเมิน**: [http://localhost:8080/api_evaluation.php](http://localhost:8080/api_evaluation.php)

### คำสั่งทดสอบการทำงานผ่าน Terminal:
```bash
# 1. ดูสถานะของคอนเทนเนอร์ทั้งหมด
docker compose ps

# 2. ทดสอบเรียก API ดึงข้อมูลประเมินผล
curl -i http://localhost:8080/api_evaluation.php

# 3. ดูไฟล์ JSON ที่บันทึกผลการประเมิน
cat database/evaluation_data.json
```
