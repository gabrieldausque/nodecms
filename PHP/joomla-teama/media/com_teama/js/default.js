const convertToBoolean = (toConvert) => {
    if(toConvert && typeof toConvert === 'string')
        return toConvert.toLowerCase() === 'true' ||
            toConvert === '1';
    if(toConvert && typeof toConvert === 'number')
        return toConvert === 1;
    return false;
}

document.addEventListener('DOMContentLoaded', async () => {
    const linkButtons = document.querySelectorAll('.btn[data-link]');
    const toolbarConfirmOkButton = document.getElementById('teama-toolbar-ok');
    const toolbarConfirmCancelButton = document.getElementById('teama-toolbar-cancel');
    const toolbarModalElement = document.getElementById('teama-toolbar-modal');
    const toolbarModalBodyElement = document.getElementById('teama-toolbar-modal-body');
    const toolbarModal = new bootstrap.Modal(toolbarModalElement);
    toolbarConfirmCancelButton.addEventListener('click', () => {
        toolbarConfirmOkButton.setAttribute('data-link', '');
        toolbarModalBodyElement.innerText = '';
        toolbarModal.hide();
    });
    toolbarConfirmOkButton.addEventListener('click', () => {
        const actionUrl = toolbarConfirmOkButton.getAttribute('data-link')
        if(actionUrl){
            window.open(actionUrl,'_self');
        }
    })
    if(linkButtons && linkButtons.length > 0){
        for(let linkedButton of linkButtons){
            linkedButton.addEventListener('click',async() => {
                if(convertToBoolean(linkedButton.getAttribute('data-use-confirmation'))){
                    toolbarConfirmOkButton.setAttribute('data-link', linkedButton.getAttribute('data-link'));
                    toolbarModalBodyElement.innerText = linkedButton.getAttribute('data-confirmation-message')
                    toolbarModalElement.addEventListener('hidden.bs.modal', (evt) => {
                        console.log(evt);
                    }, {
                        once:true,
                        capture:true,
                        passive:false
                    });
                    toolbarModal.show();
                } else {
                    window.open(linkedButton.getAttribute('data-link'), '_self');
                }
            });
        }
    }
})