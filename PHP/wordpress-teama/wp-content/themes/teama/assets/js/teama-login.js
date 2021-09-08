document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('login');
    loginForm.remove();
    const loginModalContent = document.getElementById('login-modal-content');
    loginModalContent.append(loginForm);
})