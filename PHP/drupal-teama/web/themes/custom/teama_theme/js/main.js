document.addEventListener('DOMContentLoaded', () => {
    const logoButton = document.getElementById('teama-site-logo');
    logoButton?.addEventListener('click', () => {
        const leftAside = document.getElementById('teama-left-side');
        if(leftAside){
          if(leftAside.classList.contains('shrink')){
            leftAside.classList.remove('shrink');
          } else {
            leftAside.classList.add('shrink');
          }
        }
    })
})
