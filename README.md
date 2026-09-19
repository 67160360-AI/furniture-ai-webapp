# 🛋️ Maison Forme - Furniture & Smart Home WebApp

ระบบเว็บแอปพลิเคชันร้านค้าและสตูดิโอออกแบบเฟอร์นิเจอร์ออนไลน์ (Maison Forme) พัฒนาด้วย PHP, MySQL, JavaScript (ES6) และ CSS Glassmorphism รองรับการใช้งานทั้งแบบ Local Server (XAMPP) และ **Docker Container** สำหรับรันบนเครื่องอื่นได้อย่างสะดวกรวดเร็ว

---

## 📁 โครงสร้างโฟลเดอร์โปรเจกต์ (Project Structure)

```
furniture-ai/
├── api/                         # Backend REST API (PHP Endpoints)
│   ├── content.php              # API ดึงเนื้อหาหน้าบริการ/โปรโมชั่น
│   ├── login.php                # API เข้าสู่ระบบผู้ใช้งาน
│   ├── logout.php               # API ออกจากระบบและเคลียร์ Session
│   ├── product.php              # API รายละเอียดสินค้ารายชิ้น
│   ├── products.php             # API ดึงรายการสินค้าทั้งหมด (JSON)
│   ├── profile.php              # API อัปเดตข้อมูลส่วนตัว
│   ├── register.php             # API สมัครสมาชิกใหม่
│   ├── search.php               # API ค้นหาสินค้าตามคีย์เวิร์ด
│   └── session.php              # API ตรวจสอบสถานะการ Login
│
├── assets/                      # Static Assets สำหรับหน้าเว็บ
│   ├── css/
│   │   └── style.css            # Stylesheet หลักและ Design Tokens
│   ├── js/                      # JavaScript ควบคุมฟังก์ชัน Client-side
│   │   ├── account.js           # เมนูโปรไฟล์ผู้ใช้
│   │   ├── auth.js              # ฟอร์ม Login / Register
│   │   ├── content.js           # ดึงเนื้อหาไดนามิก
│   │   ├── guard.js             # ระบบล็อกสิทธิ์เข้าถึงหน้าที่ต้อง Login
│   │   ├── product_detail.js    # หน้าดูรายละเอียดสินค้า
│   │   ├── profile.js           # หน้าแก้ไขข้อมูลส่วนตัว
│   │   └── site.js              # ฟังก์ชันค้นหาและส่วนกลาง
│   └── images/                  # รูปภาพสินค้าและแบนเนอร์
│
├── config/                      # การตั้งค่าระบบ
│   └── db.php                   # จุดเชื่อมต่อฐานข้อมูล PDO & MySQLi (รองรับทั้ง XAMPP และ Docker)
│
├── database/                    # สคริปต์ฐานข้อมูล
│   └── init.sql                 # SQL Schema & Seed Data (Docker รันสร้างฐานข้อมูลให้อัตโนมัติ)
│
├── docker/                      # คอนฟิกสำหรับ Docker
│   ├── Dockerfile               # Base: php:8.2-apache + mysqli + pdo_mysql + rewrite
│   └── apache.conf              # Apache VirtualHost Configuration
│
├── [User Pages]                 # หน้าแสดงผลหลัก (Web Pages)
│   ├── index.php                # หน้าแรก (Glassmorphism + Slider + Featured Products)
│   ├── products.html            # แคตตาล็อกสินค้าทั้งหมด
│   ├── product_detail.html      # หน้ารายละเอียดสินค้า
│   ├── furniture-designer.php   # ระบบ The Perfect Match (Dynamic 3D Studio)
│   ├── furniture-designer.html  # หน้าสตูดิโอออกแบบ
│   ├── cart.html                # ตะกร้าสินค้า
│   ├── checkout.html            # สั่งซื้อและชำระเงิน
│   ├── history.html             # ประวัติการสั่งซื้อ
│   ├── profile.html             # บัญชีสมาชิก
│   ├── devices.html             # เครื่องมือออกแบบ
│   ├── promo.html               # โปรโมชั่น
│   ├── services.html            # บริการของเรา
│   ├── article.html             # บทความสาระน่ารู้
│   ├── search.html              # ผลการค้นหาสินค้า
│   ├── login.html               # เข้าสู่ระบบ
│   └── register.html            # สมัครสมาชิก
│
├── docker-compose.yml           # คำสั่งรัน Web + MySQL + phpMyAdmin ครบวงจร
├── .dockerignore                # กรองไฟล์ที่ไม่เกี่ยวข้องออกจาก Docker
├── .gitignore                   # กรองไฟล์สำหรับ Git
└── README.md                    # เอกสารคู่มือการติดตั้งและใช้งาน
```

---

## 🚀 วิธีเปิดใช้งานผ่าน Docker (แนะนำสำหรับเครื่องอื่น)

ข้อดี: **ไม่ต้องติดตั้ง PHP หรือ MySQL บนเครื่องเลย** เพียงมี [Docker Desktop](https://www.docker.com/products/docker-desktop/) ติดตั้งไว้

### ขั้นตอนการรันจาก GitHub:

1. **Clone โปรเจกต์ลงเครื่อง**:
   ```bash
   git clone https://github.com/67160360-AI/furniture-ai-webapp.git
   cd furniture-ai-webapp
   ```

2. **สั่งรันคอนเทนเนอร์ด้วย Docker Compose**:
   ```bash
   docker compose up -d
   ```
   *(Docker จะดาวน์โหลด Image, สร้างคอนเทนเนอร์ และรันไฟล์ `database/init.sql` เพื่อสร้างตารางและข้อมูลสินค้าเริ่มต้นให้อัตโนมัติทันที)*

3. **เข้าใช้งานผ่านเบราว์เซอร์**:
   - 🌐 **หน้าเว็บไซต์หลัก**: [http://localhost:8080](http://localhost:8080)
   - 🗄️ **phpMyAdmin จัดการฐานข้อมูล**: [http://localhost:8081](http://localhost:8081)
     - **Server**: `db`
     - **Username**: `root`
     - **Password**: `rootpassword`

4. **คำสั่งควบคุมอื่น ๆ**:
   - ดูสถานะคอนเทนเนอร์: `docker compose ps`
   - ดู Logs การทำงาน: `docker compose logs -f`
   - ปิดการทำงาน: `docker compose down`

---

## 💻 วิธีเปิดใช้งานผ่าน XAMPP (Local แบบเดิม)

หากต้องการรันผ่าน XAMPP โดยไม่ใช้ Docker:

1. นำโฟลเดอร์ `furniture-ai` ไปไว้ใน `C:\xampp\htdocs\`
2. เปิด **XAMPP Control Panel** แล้วกด **Start** ที่โมดูล **Apache** และ **MySQL**
3. เข้า [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
4. สร้างฐานข้อมูลชื่อ `furniture_db` และนำเข้าไฟล์ `database/init.sql`
5. เข้าชมเว็บไซต์ผ่าน: [http://localhost/furniture-ai/](http://localhost/furniture-ai/)

---

## 🔒 ข้อมูลการเชื่อมต่อฐานข้อมูล (Database Credentials)

ไฟล์ [`config/db.php`](config/db.php) ได้รับการออกแบบให้ตรวจสอบสภาพแวดล้อมอัตโนมัติ:

| ตัวแปร Environment | ค่าเริ่มต้น (XAMPP) | ค่าเมื่อรันใน Docker |
|---|---|---|
| `DB_HOST` | `127.0.0.1` | `db` |
| `DB_PORT` | `3306` | `3306` |
| `DB_NAME` | `furniture_db` | `furniture_db` |
| `DB_USER` | `root` | `root` |
| `DB_PASS` | `""` (ว่าง) | `rootpassword` |
