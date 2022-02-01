let map;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 46.966386, lng: 1.4735157 },
    zoom: 5,
  });
}