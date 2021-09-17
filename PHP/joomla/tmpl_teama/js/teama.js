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

    const brandLogoButton = document.getElementById('teama-brand-logo');
    if(brandLogoButton) {
        brandLogoButton.addEventListener('click', async() => {
            const leftPanel = document.querySelector('.teama-left-panel');
            if(leftPanel){
                if(leftPanel.classList.contains('shrink')){
                    leftPanel.classList.remove('shrink');
                } else {
                    leftPanel.classList.add('shrink');
                }
            }
        })
    }

    const leftPanel = document.querySelector('.teama-left-panel');
    if(leftPanel){
        leftPanel.addEventListener('transitionstart', async() => {
            if(leftPanel.classList.contains('shrink')){
                const title = document.querySelector('.teama-brand-container > h5');
                if(leftPanel.classList.contains('shrink')){
                    title.style.display = 'none';
                }

                const navItems = [].slice.call(leftPanel.querySelectorAll('.OtherLetters'));
                navItems.map(ol => {
                    ol.style.display = 'none';
                })
            }
        });
        leftPanel.addEventListener('transitionend', async() => {
            const title = document.querySelector('.teama-brand-container > h5');
            if(!leftPanel.classList.contains('shrink')){
                title.style.display = 'block';
                const navItems = [].slice.call(leftPanel.querySelectorAll('.OtherLetters'));
                navItems.map(ol => {
                    ol.style.display = 'block';
                })
            }
        });
    }

    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map((tooltipTriggerEl) => {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
})