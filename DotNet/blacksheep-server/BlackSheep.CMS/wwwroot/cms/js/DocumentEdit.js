document.addEventListener("DOMContentLoaded", (e) => {
    let allEditorBlocs = document.querySelectorAll('.blacksheep-bloc-cell');
    if (allEditorBlocs) {
        for (let blocElement of allEditorBlocs) {
            blocElement.addEventListener('contextmenu', (e) => {
                e.preventDefault();
                let others = document.querySelectorAll('.blacksheep-editor-menu');
                for (let other of others) {
                    other.classList.remove('shown');
                }
                let menu = blocElement.querySelector('.blacksheep-editor-menu');
                menu.classList.add('shown');
                menu.style.top = `${e.clientY}px`;
                menu.style.left = `${e.clientX}px`;
            });
        }
    }
});