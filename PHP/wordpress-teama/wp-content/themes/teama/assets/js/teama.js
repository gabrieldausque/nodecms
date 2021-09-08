async function reduceLeftPanel() {
    const leftPanel = document.getElementById('teama-left-panel');
    if(leftPanel.classList.contains('shrink'))
        leftPanel.classList.remove('shrink')
    else
        leftPanel.classList.add('shrink')
}

document.addEventListener('DOMContentLoaded', () => {
    console.log('hoho');
    document.getElementById('teama-brand-logo').addEventListener(
        'click',
        reduceLeftPanel
    )
})