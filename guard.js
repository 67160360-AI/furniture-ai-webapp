document.addEventListener('DOMContentLoaded', () => {
    const pageRequiresLogin = document.body.dataset.protectedPage === 'true';
    const protectedLinks = document.querySelectorAll('a[data-login-required]');
    if (!pageRequiresLogin && !protectedLinks.length) return;

    fetch('api_session.php', {credentials: 'same-origin'})
        .then(response => response.json())
        .then(session => {
            if (pageRequiresLogin && !session.authenticated) {
                const next = `${window.location.pathname.split('/').pop()}${window.location.search}`;
                window.location.replace(`login.html?next=${encodeURIComponent(next)}`);
                return;
            }
            protectedLinks.forEach(link => {
                link.addEventListener('click', event => {
                    if (!session.authenticated) {
                        event.preventDefault();
                        alert('กรุณาเข้าสู่ระบบก่อนใช้งานส่วนนี้');
                        window.location.href = `login.html?next=${encodeURIComponent(link.getAttribute('href'))}`;
                    }
                });
            });
        })
        .catch(() => {
            if (pageRequiresLogin) {
                window.location.replace(`login.html?next=${encodeURIComponent(window.location.pathname.split('/').pop())}`);
                return;
            }
            protectedLinks.forEach(link => link.addEventListener('click', event => {
                event.preventDefault();
                window.location.href = `login.html?next=${encodeURIComponent(link.getAttribute('href'))}`;
            }));
        });
});
