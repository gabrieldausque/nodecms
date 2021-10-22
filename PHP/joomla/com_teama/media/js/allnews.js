document.addEventListener('DOMContentLoaded', async () => {
  const next = document.getElementById('next-news');
  next.addEventListener('click',async (evt) => {
    let request = new XMLHttpRequest();
    request.open(
        'post',
        'index.php?options=com_teama&task=news.nextNews&view=news&format=json',
        true
    )

    request.onload = async (evt) => {
      const newsTemplate = document.getElementById('teama-news-tmpl');
      if(request.status === 200){
        const response = JSON.parse(request.response);
        if(response && Array.isArray(response.news)){
          for(let otherNews of response.news){

            if(document.getElementById(`teama-news-${otherNews.id}`))
              continue;

            let newsCard = document.createElement('article');
            newsCard.innerHTML = newsTemplate.innerHTML;
            newsTemplate.classList.forEach(c => newsCard.classList.add(c))
            newsCard.setAttribute('id', `teama-news-${otherNews.id}`);
            newsCard.setAttribute('data-newslink',`${newsTemplate.attributes['data-newslink'].value}${otherNews.id}`);
            const img = newsCard.querySelector('.card-img-top');
            if(otherNews['header_media'].image){
              img.style.backgroundImage = `url('${otherNews['header_media'].image}')`;
              img.setAttribute('alt',otherNews['header_media'].alt);
              img.setAttribute('title', otherNews['header_media'].title);
            } else {
              newsCard.removeChild(img);
            }
            const title = newsCard.querySelector('#teama-thenews-title');
            title.innerText = otherNews.title;
            title.removeAttribute('id');
            const summary = newsCard.querySelector('#teama-thenews-summary')
            summary.innerText = otherNews.summary;
            summary.removeAttribute('id');
            next.parentElement.insertBefore(newsCard, next);
            newsCard.addEventListener('click',async() => {
              window.open(newsCard.attributes['data-newslink'].value, '_self')
            },500);
            window.setTimeout(() => {
              newsCard.classList.remove('hidden');
            });
          }
          if(response.next){
            next.setAttribute('data-start',response.next.base);
          } else {
            next.classList.add('hidden');
          }
        }
      } else {
        console.error(request.response)
      }
    };

    const data = new FormData();
    data.append('start',next.attributes['data-start'].value);
    data.append(`${next.attributes['data-token'].value}`, "1");
    request.send(data)
  })
})