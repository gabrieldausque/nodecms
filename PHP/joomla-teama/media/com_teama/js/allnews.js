document.addEventListener('DOMContentLoaded', async () => {
  const next = document.getElementById('next-news');
  next.addEventListener('click',async (evt) => {
    let request = new XMLHttpRequest();
    request.open(
        'post',
        'index.php?options=com_teama&task=news.nextNews&format=json',
        true
    )

    request.onload = async (evt) => {
      console.log(request);
    };

    const data = {
      limit:next.attributes['data-limit'].value,
      limitstart:next.attributes['data-limitstart'].value
    }
    data[`${next.attributes['data-token'].value}`] = "1";
    request.send(data)
  })
})