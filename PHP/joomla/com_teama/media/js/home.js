document.addEventListener('DOMContentLoaded', (evt) => {
  document.querySelectorAll('article[data-newslink]').forEach((elt) => {
    elt.addEventListener('click',async () => {
      window.open(elt.attributes['data-newslink'].value,'_self')
    })
  })
  document.querySelectorAll('div[data-newslink]').forEach((elt) => {
    elt.addEventListener('click',async () => {
      window.open(elt.attributes['data-newslink'].value, '_self')
    })
  })
})