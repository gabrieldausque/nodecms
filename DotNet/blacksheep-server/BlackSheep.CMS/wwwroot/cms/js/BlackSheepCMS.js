document.addEventListener('SHOW_RIGHT_PANE', (event) => {
    let rightPanel = document.querySelector('#blacksheep-right-zone');
    rightPanel.classList.add('shown');
});

function hideRightPane() {
    let rightPanel = document.querySelector('#blacksheep-right-zone');
    rightPanel.classList.remove('shown');
}