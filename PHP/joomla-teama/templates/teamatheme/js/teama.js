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
            const brandingPanel = document.querySelector('.teama-brand-container');
            if(leftPanel && brandingPanel){
                if(leftPanel.classList.contains('shrink')){
                    leftPanel.classList.remove('shrink');
                    brandingPanel.classList.remove('shrink');
                } else {
                    leftPanel.classList.add('shrink');
                    brandingPanel.classList.add('shrink');
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

    const submenuButtons = document.querySelectorAll('button.btn-submenu')
    for(let button of submenuButtons){
        button.addEventListener('click', () => {
            if(button.classList.contains('show-submenu'))
                button.classList.remove('show-submenu');
            else
                button.classList.add('show-submenu');
        })
    }

    const messageZone = document.getElementById('system-message-container');
    const messageHiddenHandler = () => {
        const alert = document.querySelectorAll('joomla-alert');
        if(alert.length <= 0) {
            messageZone?.classList.add('hidden');
        } else {
            messageZone?.classList.remove('hidden');
        }
    };
    messageZone.addEventListener('click',async() => {
        window.setTimeout(async() => messageHiddenHandler(), 1000);
    })
    window.setTimeout(async() => messageHiddenHandler(), 500);
})