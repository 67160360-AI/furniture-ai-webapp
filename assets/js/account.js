document.addEventListener('DOMContentLoaded', () => {
    const account = document.querySelector('[data-account]');
    if (!account) return;

    const loginLinks = account.querySelector('[data-login-links]');
    const userMenu = account.querySelector('[data-user-menu]');
    const userName = account.querySelector('[data-user-name]');
    const userToggle = account.querySelector('[data-user-toggle]');

    fetch('api_session.php', {credentials: 'same-origin'})
        .then(response => response.json())
        .then(session => {
            if (!session.authenticated) return;
            loginLinks.hidden = true;
            loginLinks.style.display = 'none';
            userMenu.hidden = false;
            userMenu.style.display = 'block';
            userName.textContent = session.username;
        });

    userToggle.addEventListener('click', () => {
        userMenu.classList.toggle('open');
    });

    document.addEventListener('click', event => {
        if (!account.contains(event.target)) userMenu.classList.remove('open');
    });

    const logout = account.querySelector('[data-logout]');
    logout.addEventListener('click', async event => {
        event.preventDefault();
        await fetch('api_logout.php', {credentials: 'same-origin'});
        window.location.href = 'index.php';
    });
});
