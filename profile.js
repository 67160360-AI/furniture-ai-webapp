document.addEventListener('DOMContentLoaded', async () => {
    const form = document.querySelector('[data-profile-form]');
    if (!form) return;
    const status = form.querySelector('[data-profile-status]');
    const username = form.querySelector('[name="username"]');

    try {
        const response = await fetch('api_profile.php', {credentials: 'same-origin'});
        const user = await response.json();
        if (!response.ok) throw new Error(user.error || 'กรุณาเข้าสู่ระบบ');
        username.value = user.username;
    } catch (error) {
        status.textContent = error.message;
        form.querySelector('button').disabled = true;
        return;
    }

    form.addEventListener('submit', async event => {
        event.preventDefault();
        const button = form.querySelector('button');
        button.disabled = true;
        status.textContent = 'กำลังบันทึกข้อมูล...';
        try {
            const response = await fetch('api_profile.php', {
                method: 'POST',
                credentials: 'same-origin',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(Object.fromEntries(new FormData(form)))
            });
            const result = await response.json();
            if (!response.ok) throw new Error(result.error || 'บันทึกข้อมูลไม่สำเร็จ');
            status.style.color = '#2f5750';
            status.textContent = 'บันทึกข้อมูลเรียบร้อยแล้ว';
        } catch (error) {
            status.style.color = '#b3453a';
            status.textContent = error.message;
        } finally {
            button.disabled = false;
        }
    });
});
