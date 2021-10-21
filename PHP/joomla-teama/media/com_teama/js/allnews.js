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
      console.log(request);
    };

    const data = new FormData();
    data.append('limit', next.attributes['data-limit'].value);
    data.append('limitstart',next.attributes['data-limitstart'].value);
    data.append(`${next.attributes['data-token'].value}`, "1");
    request.send(data)
  })
})