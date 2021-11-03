document.addEventListener('DOMContentLoaded',() => {
   const filterFields = document.querySelectorAll('.js-stools-field-filter > .visually-hidden');
   for(let fieldsLabel of filterFields){
     fieldsLabel.classList.remove('visually-hidden');
   }
})