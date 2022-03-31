function publicNavOpenLink(btn) {
    if(btn){
        const link = btn.getAttribute('data-link');
        if(link) {
            let linkElement = document.createElement('a');
            linkElement.href = link;
            linkElement.click();
        }
    }
}