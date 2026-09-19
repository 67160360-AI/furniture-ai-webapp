document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('[data-auth-form]');
    if (!form) return;

    form.addEventListener('submit', async event => {
        event.preventDefault();
        const button = form.querySelector('button[type="submit"]');
        const status = document.querySelector('[data-auth-status]');

        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        button.disabled = true;
        button.textContent = 'กำลังดำเนินการ...';
        if (status) {
            status.textContent = '';
            status.className = 'auth-status';
        }

        try {
            const isRegister = form.dataset.authForm === 'register';
            const endpoint = isRegister ? 'api_register.php' : 'api_login.php';

            const response = await fetch(endpoint, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json; charset=utf-8' },
                body: JSON.stringify(data)
            });

            const rawText = await response.text();
            let result;
            try { result = JSON.parse(rawText); }
            catch (e) { throw new Error('เซิร์ฟเวอร์ตอบกลับไม่ถูกต้อง: ' + rawText); }

            if (!response.ok) {
                throw new Error(result.error || 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง');
            }

            if (isRegister) {
                // สมัครสมาชิกสำเร็จ → ไปหน้า login พร้อม toast
                window.location.href = 'login.html?toast=registered';
            } else {
                // เข้าสู่ระบบสำเร็จ → ไปหน้าหลัก พร้อม toast ต้อนรับ
                const next = new URLSearchParams(window.location.search).get('next');
                const username = encodeURIComponent(result.username || data.username || '');
                window.location.href = (next || 'index.php') + '?toast=login&u=' + username;
            }

        } catch (error) {
            if (status) {
                status.textContent = '⚠️ ' + error.message;
                status.className = 'auth-status error';
            }
        } finally {
            button.disabled = false;
            button.textContent = form.dataset.authForm === 'register' ? 'สมัครสมาชิก' : 'เข้าสู่ระบบ';
        }
    });
});