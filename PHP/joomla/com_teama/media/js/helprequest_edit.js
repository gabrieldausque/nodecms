console.log("help request loaded");

function createCardFromObjective(justCreatedObjective) {
    const template = document.getElementById('card-template');
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = template.outerHTML;
    const newCard = tempDiv.firstChild;
    newCard.setAttribute('id', `linked-objective-${justCreatedObjective.id}`);
    const title = newCard.querySelector('.card-body > .card-title');
    title.innerHTML = `${justCreatedObjective.lastname} ${justCreatedObjective.firstname}`;
    const photo = newCard.querySelector('img');
    photo.setAttribute('src',`/${justCreatedObjective.photo}`);
    const fields = newCard.querySelectorAll('.card-body > .card-text > span');
    const fieldLabels = ['age','sex','dangerousness','comment'];
    let fieldIndex = 0;
    for(let field of fields){
        field.innerHTML = justCreatedObjective[fieldLabels[fieldIndex]];
        fieldIndex++;
    }
    newCard.classList.remove('card-template');
    return newCard;
}

function resetObjectiveForm() {
    const form = document.getElementById('new-objective-form');
    form.querySelector('.button-clear').click();
    form.querySelector('#jform_lastname').value = '';
    form.querySelector('#jform_firstname').value = '';
    form.querySelector('#jform_age').value = '';
    const date = new Date();
    form.querySelector('#jform_birthdate').value = `${date.getFullYear()}-${date.getMonth()}-${date.getDate()}`;
    form.querySelector('#jform_birthplace').value = '';
    form.querySelector('#jform_size').value = '';
    form.querySelector('#jform_size').value = '';
    tinymce.activeEditor.resetContent();
}

async function addObjectiveOnClick() {
    let addButton = document.getElementById('add-objective-btn');
    const previousContent = addButton.innerHTML;
    addButton.setAttribute('disabled','disabled');
    addButton.innerHTML = "...";
    try{
        const postUrl = `${window.location.pathname}?option=com_teama&task=helprequestobjective.apply&id=0`;
        const form = document.getElementById('new-objective-form');
        const formData = new FormData(form);
        //get the comment value from the tinymce editor
        formData.set('jform[comment]',tinymce.activeEditor.getContent());
        let response = await fetch(postUrl,{
            method: 'POST',
            body: formData,
        })
        const returnUrl = new URL(response.url);
        const createdId = returnUrl.searchParams.get('id');
        if(createdId){
            const getNewObjectiveUrl = `${window.location.pathname}?option=com_teama&task=helprequestobjective.display&id=${createdId}&format=json`;
            response = await fetch(getNewObjectiveUrl);
            const justCreatedObjective = await response.json();
            console.log(justCreatedObjective)
            const inputField = document.getElementById('jform_objectives');
            const currentValue = JSON.parse(inputField.value);
            currentValue.push(justCreatedObjective.id);
            inputField.value = JSON.stringify(currentValue);
            const displayedObjectivesZone = document.querySelector('.teama-help-request-objectives-displayed');
            displayedObjectivesZone.appendChild(createCardFromObjective(justCreatedObjective))
            resetObjectiveForm();
            document.getElementById('add-objective-close-btn').click();
        } else {
            throw new Error('An error occured : no id for the new objective created');
        }
    }catch(error){
        console.error(error);
    } finally {
        addButton.removeAttribute('disabled')
        addButton.innerHTML = previousContent;
    }
}