/**
 * account.js — Universal Auth UI Manager
 * ทำงานได้กับทุกหน้า ทั้งแบบ data-account และแบบปุ่ม static
 */
document.addEventListener('DOMContentLoaded', () => {

    // ============================================================
    // 1. Toast System — แสดง notification ต้อนรับ / แจ้งเตือน
    // ============================================================
    function showToast(message, type = 'success', duration = 4000) {
        // ลบ toast เก่าถ้ามี
        document.querySelectorAll('.mf-toast').forEach(t => t.remove());

        const toast = document.createElement('div');
        toast.className = 'mf-toast mf-toast--' + type;
        toast.innerHTML = `
            <span class="mf-toast-icon">${type === 'success' ? '✅' : type === 'info' ? 'ℹ️' : '⚠️'}</span>
            <span class="mf-toast-msg">${message}</span>
            <button class="mf-toast-close" onclick="this.parentElement.remove()">✕</button>
        `;
        document.body.appendChild(toast);

        // inject styles ถ้ายังไม่มี
        if (!document.getElementById('mf-toast-style')) {
            const style = document.createElement('style');
            style.id = 'mf-toast-style';
            style.textContent = `
                .mf-toast {
                    position: fixed; bottom: 28px; right: 28px; z-index: 99999;
                    display: flex; align-items: center; gap: 12px;
                    background: rgba(255,255,255,0.92); backdrop-filter: blur(20px) saturate(180%);
                    border: 1px solid rgba(255,255,255,0.85);
                    border-radius: 18px; padding: 14px 20px 14px 18px;
                    box-shadow: 0 16px 48px -12px rgba(0,0,0,0.18), inset 0 1px 0 rgba(255,255,255,1);
                    font-family: 'Kanit', sans-serif; font-size: 14px; color: #1d1d1f;
                    animation: mfToastIn 0.4s cubic-bezier(0.34,1.56,0.64,1) both;
                    max-width: 360px; min-width: 240px;
                }
                .mf-toast--success { border-left: 4px solid #22c55e; }
                .mf-toast--info    { border-left: 4px solid #3b82f6; }
                .mf-toast--warning { border-left: 4px solid #f59e0b; }
                .mf-toast-icon { font-size: 18px; flex-shrink: 0; }
                .mf-toast-msg  { flex: 1; font-weight: 500; line-height: 1.4; }
                .mf-toast-close {
                    background: none; border: none; cursor: pointer; font-size: 14px;
                    color: #86868b; padding: 2px 4px; border-radius: 6px;
                    transition: color 0.2s; flex-shrink: 0;
                }
                .mf-toast-close:hover { color: #1d1d1f; }
                .mf-toast.hiding { animation: mfToastOut 0.3s ease forwards; }
                @keyframes mfToastIn  { from { transform: translateY(20px) scale(0.95); opacity: 0; } to { transform: translateY(0) scale(1); opacity: 1; } }
                @keyframes mfToastOut { from { transform: translateY(0); opacity: 1; } to { transform: translateY(20px); opacity: 0; } }
            `;
            document.head.appendChild(style);
        }

        // auto-dismiss
        setTimeout(() => {
            toast.classList.add('hiding');
            setTimeout(() => toast.remove(), 300);
        }, duration);
    }

    // ตรวจสอบ URL params เพื่อแสดง toast
    const params = new URLSearchParams(window.location.search);
    if (params.get('toast') === 'login') {
        const username = decodeURIComponent(params.get('u') || '');
        showToast(username ? `ยินดีต้อนรับกลับมา, <strong>${username}</strong>! 👋` : 'เข้าสู่ระบบสำเร็จ ยินดีต้อนรับ! 👋', 'success');
        // ลบ query params ออกจาก URL โดยไม่ reload
        const cleanUrl = window.location.pathname + (window.location.hash || '');
        window.history.replaceState({}, '', cleanUrl);
    } else if (params.get('toast') === 'registered') {
        showToast('สมัครสมาชิกสำเร็จแล้ว! กรุณาเข้าสู่ระบบ 🎉', 'success');
        const cleanUrl = window.location.pathname + (window.location.hash || '');
        window.history.replaceState({}, '', cleanUrl);
    }

    // ============================================================
    // 2. Auth UI Updater — อัปเดต header ตามสถานะ session
    // ============================================================
    async function updateAuthUI() {
        let session;
        try {
            const res = await fetch('api_session.php', { credentials: 'same-origin' });
            session = await res.json();
        } catch (e) {
            return; // ไม่มี API ไม่ต้องทำอะไร
        }

        const isAuth = session && session.authenticated;
        const username = session && session.username ? session.username : 'บัญชีของฉัน';

        // --- Pattern A: data-account (search.html, cart.html) ---
        const accountEl = document.querySelector('[data-account]');
        if (accountEl) {
            const loginLinks = accountEl.querySelector('[data-login-links]');
            const userMenu   = accountEl.querySelector('[data-user-menu]');
            const userNameEl = accountEl.querySelector('[data-user-name]');
            const userToggle = accountEl.querySelector('[data-user-toggle]');
            const logoutBtn  = accountEl.querySelector('[data-logout]');

            if (isAuth) {
                if (loginLinks)  { loginLinks.hidden = true; loginLinks.style.display = 'none'; }
                if (userMenu)    { userMenu.hidden = false; userMenu.style.display = ''; }
                if (userNameEl)  { userNameEl.textContent = username; }
            } else {
                if (loginLinks)  { loginLinks.hidden = false; loginLinks.style.display = ''; }
                if (userMenu)    { userMenu.hidden = true; userMenu.style.display = 'none'; }
            }

            if (userToggle) {
                userToggle.addEventListener('click', (e) => {
                    e.stopPropagation();
                    accountEl.querySelector('.account-menu')?.classList.toggle('open');
                });
            }
            document.addEventListener('click', (e) => {
                if (!accountEl.contains(e.target)) {
                    accountEl.querySelector('.account-menu')?.classList.remove('open');
                }
            });
            if (logoutBtn) {
                logoutBtn.addEventListener('click', async (e) => {
                    e.preventDefault();
                    await fetch('api_logout.php', { credentials: 'same-origin' });
                    window.location.href = 'index.php';
                });
            }
        }

        // --- Pattern B: Static header (index.php, products.html, etc.) ---
        // หาปุ่ม auth-links แบบ static ที่ไม่ได้อยู่ใน data-account
        const authLinksEl = document.querySelector('.auth-links:not([data-login-links])');
        const staticUserMenu = document.querySelector('.account-menu:not([data-user-menu])');

        if (authLinksEl) {
            if (isAuth) {
                // ซ่อนปุ่ม login/register และแทนด้วย user toggle
                authLinksEl.style.display = 'none';

                // สร้าง user widget ถ้ายังไม่มี
                if (!document.getElementById('mf-user-widget')) {
                    const widget = document.createElement('div');
                    widget.id = 'mf-user-widget';
                    widget.style.cssText = 'position:relative; display:flex; align-items:center;';
                    widget.innerHTML = `
                        <button id="mf-user-toggle" style="
                            border:0; background: rgba(255,138,30,0.12); color:#c2520a;
                            font-weight:700; cursor:pointer; font-family:'Kanit',sans-serif;
                            font-size:14px; padding:8px 16px; border-radius:999px;
                            display:flex; align-items:center; gap:6px; transition:all 0.2s;
                        " onmouseover="this.style.background='rgba(255,138,30,0.22)'"
                          onmouseout="this.style.background='rgba(255,138,30,0.12)'">
                            <span style="font-size:16px;">👤</span>
                            <span id="mf-username-label">${username}</span>
                            <span style="font-size:10px;">▾</span>
                        </button>
                        <div id="mf-user-dropdown" style="
                            display:none; position:absolute; right:0; top:calc(100% + 10px);
                            min-width:200px; background:rgba(255,255,255,0.97);
                            backdrop-filter:blur(20px); border:1px solid rgba(255,255,255,0.85);
                            border-radius:20px; box-shadow:0 24px 60px -20px rgba(0,0,0,0.18);
                            padding:8px; z-index:1000; animation:mfDropIn 0.2s ease;
                        ">
                            <a href="profile.html" style="display:block;padding:10px 14px;color:#1d1d1f;font-size:14px;border-radius:10px;font-family:'Kanit',sans-serif;font-weight:500;transition:background 0.15s;" onmouseover="this.style.background='rgba(255,138,30,0.1)';this.style.color='#c2520a'" onmouseout="this.style.background='';this.style.color='#1d1d1f'">👤 แก้ไขโปรไฟล์</a>
                            <a href="dashboard.html" style="display:block;padding:10px 14px;color:#1d1d1f;font-size:14px;border-radius:10px;font-family:'Kanit',sans-serif;font-weight:500;transition:background 0.15s;" onmouseover="this.style.background='rgba(255,138,30,0.1)';this.style.color='#c2520a'" onmouseout="this.style.background='';this.style.color='#1d1d1f'">📦 ประวัติคำสั่งซื้อ</a>
                            <div style="border-top:1px solid rgba(0,0,0,0.06);margin:4px 0;"></div>
                            <a id="mf-logout-btn" href="#" style="display:block;padding:10px 14px;color:#dc2626;font-size:14px;border-radius:10px;font-family:'Kanit',sans-serif;font-weight:500;transition:background 0.15s;" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background=''">🚪 ออกจากระบบ</a>
                        </div>
                    `;
                    authLinksEl.parentElement.appendChild(widget);

                    // dropdown toggle
                    const toggle = document.getElementById('mf-user-toggle');
                    const dropdown = document.getElementById('mf-user-dropdown');
                    toggle.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const isOpen = dropdown.style.display === 'block';
                        dropdown.style.display = isOpen ? 'none' : 'block';
                    });
                    document.addEventListener('click', () => { dropdown.style.display = 'none'; });

                    // logout
                    document.getElementById('mf-logout-btn').addEventListener('click', async (e) => {
                        e.preventDefault();
                        await fetch('api_logout.php', { credentials: 'same-origin' });
                        window.location.href = 'index.php';
                    });

                    // dropdown animation
                    if (!document.getElementById('mf-dropdown-style')) {
                        const st = document.createElement('style');
                        st.id = 'mf-dropdown-style';
                        st.textContent = `@keyframes mfDropIn { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:translateY(0); } }`;
                        document.head.appendChild(st);
                    }
                }
            } else {
                // ยังไม่ได้ล็อกอิน: แสดงปุ่มปกติ
                authLinksEl.style.display = '';
                const widget = document.getElementById('mf-user-widget');
                if (widget) widget.style.display = 'none';
            }
        }
    }

    updateAuthUI();
});
