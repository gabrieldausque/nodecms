document.addEventListener('DOMContentLoaded', async () => {
    const linkButtons = document.querySelectorAll('.btn[data-link]');
    if(linkButtons && linkButtons.length > 0){
        for(let linkedButton of linkButtons){
            linkedButton.addEventListener('click',async() => {
                window.open(linkedButton.getAttribute('data-link'), '_self');
            })
        }
    }
})