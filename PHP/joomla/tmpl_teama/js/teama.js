document.addEventListener('DOMContentLoaded', async() => {
    const loginButton = document.getElementById('teama-login-button');
    if(loginButton){
        loginButton.addEventListener('click', () => {
            const loginForm = document.getElementById('teama-login-form');
            if(loginForm){
                loginForm.submit();
            }
        })
    }
})