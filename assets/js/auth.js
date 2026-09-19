document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('[data-auth-form]');
    if (!form) return;

    form.addEventListener('submit', async event => {
        event.preventDefault();
        const button = form.querySelector('button[type="submit"]');
        const status = form.querySelector('[data-auth-status]');
        
        // ดึงข้อมูลจากฟอร์มทั้งหมดแปลงเป็น Object
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        button.disabled = true;
        if (status) {
            status.textContent = 'กำลังดำเนินการ...';
            status.style.color = '#263238';
        }

        try {
            // เช็คว่าฟอร์มนี้เป็นหน้าสมัครสมาชิกหรือเข้าสู่ระบบ
            const isRegister = form.dataset.authForm === 'register';
            const endpoint = isRegister ? 'api_register.php' : 'api_login.php';

            const response = await fetch(endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json; charset=utf-8'
                },
                body: JSON.stringify(data)
            });

            const rawText = await response.text();
            let result;
            try {
                result = JSON.parse(rawText);
            } catch (e) {
                throw new Error('เซิร์ฟเวอร์ตอบกลับไม่ถูกต้อง: ' + rawText);
            }

            if (!response.ok) {
                throw new Error(result.error || 'เกิดข้อผิดพลาดในการทำรายการ');
            }

            alert(result.message || (isRegister ? 'สมัครสมาชิกสำเร็จ' : 'เข้าสู่ระบบสำเร็จ'));
            
            // พาไปหน้าถัดไป
            if (isRegister) {
                window.location.href = 'login.html';
            } else {
                const next = new URLSearchParams(window.location.search).get('next');
                window.location.href = next || 'index.php';
            }

        } catch (error) {
            if (status) {
                status.textContent = error.message;
                status.style.color = '#b3453a';
            } else {
                alert(error.message);
            }
        } finally {
            button.disabled = false;
        }
    });
});