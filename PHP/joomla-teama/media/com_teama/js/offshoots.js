let mapMetropole;
let geocoder;
let offshoots;
let distanceService;

function initMap() {
  offshoots = Joomla.getOptions('offshoots');
  offshoots = offshoots['offshoots'];
  mapMetropole = new google.maps.Map(document.getElementById("map-metropole"), {
    center: { lat: 46.966386, lng: 1.4735157 },
    zoom: 6,
  });
  geocoder = new google.maps.Geocoder();
  distanceService = new google.maps.DistanceMatrixService();

  for(let offshoot of offshoots){
      displayOffshoot(offshoot, mapMetropole).catch(console.error);
  }
  let mapInitializedEvent = new CustomEvent('GMAP_INITIALIZED');
  window.dispatchEvent(mapInitializedEvent);
}

async function displayOffshoot(offshoot, map){
  let address = offshoot.address
  let results = await geocoder.geocode({
    address: address
  })
  if(results && Array.isArray(results.results) && results.results[0])
  {
    let result = results.results[0];
    let marker = new google.maps.Marker({
      position: result.geometry.location,
      icon: {url:`${document.location.origin}/media/com_teama/images/fontawesome/solid/shield.svg`, scaledSize: new google.maps.Size(32, 32)},
      map: map,
    });
    offshoot.position = result.geometry.location;
    marker.addListener('click', () => {
      zoomOnOffshoot(offshoot, map);
    })
  } else {
    console.warn(`Location with address ${address} seems to be unprecised. Please check the address and complete if needed for it to be displayed`);
  }
}

function zoomOnOffshoot(offshoot, map) {
  map.setCenter(offshoot.position);
  map.setZoom(13);
  let allSummaries = document.querySelectorAll('.offshoot-summary');
  for(let summary of allSummaries){
    summary.classList.remove('active');
  }
  let activeSummary = document.getElementById(`offshoot-summary-${offshoot.id}`);
  if(activeSummary){
    activeSummary.classList.add('active');
    document.getElementById('offshoots').scrollTop = activeSummary.offsetTop;
  }

  let allDetails = document.querySelectorAll('.offshoot-details');
  for(let detailCard of allDetails) {
    detailCard.classList.remove('shown');
  }
  let detailCard = document.getElementById(`offshoot-details-${offshoot.id}`);
  if(detailCard)
      detailCard.classList.add('shown');
}

document.addEventListener('DOMContentLoaded',() => {
  let allOffshootsFromList = document.querySelectorAll('.offshoot-summary');
  if(allOffshootsFromList){
    for(let offshootFromList of allOffshootsFromList){
      offshootFromList.addEventListener('click', () => {
        for(let other of allOffshootsFromList){
          if(other !== offshootFromList){
            other.classList.remove('shown');
          }
        }
        let offshootId = 0;
        try{
          offshootId = parseInt(offshootFromList.getAttribute('data-offshoot-id'));
          if(Array.isArray(offshoots)){
            let offshoot = offshoots.find(o => o.id === offshootId);
            if(offshoot){
              zoomOnOffshoot(offshoot, mapMetropole);
            }
          }
        }catch(error){
          console.error(`No offshoot summary from ${offshootId}`);
        }
      })
    }
  }

  let inputChangeTimer = null;
  let locationForDistance = document.getElementById('location-for-distance');
  let searchNearestButton = document.getElementById('search-nearest-distance')
  locationForDistance.addEventListener('keyup', () => {
      if(inputChangeTimer != null){
        window.clearTimeout(inputChangeTimer);
      }
      inputChangeTimer = window.setTimeout(async () => {
          console.log('Checking the address');
          let addressToTest = locationForDistance.value;
          let searchResults = await geocoder.geocode({ address: addressToTest});
          if(searchResults && Array.isArray(searchResults.results) && searchResults.results.length > 0){
            searchNearestButton.removeAttribute('disabled');
          } else {
            searchNearestButton.setAttribute('disabled','disabled');
          }
      }, 2000)
  });
  searchNearestButton.addEventListener('click', async () => {
    searchNearestButton.setAttribute('disabled', 'disabled');
    try{
      let origins = [];
      for(let offshoot of offshoots){
        origins.push(offshoot.address);
      }
      let request = {
        origins: origins,
        destinations: [ locationForDistance.value ],
        travelMode: 'DRIVING',
        unitSystem: google.maps.UnitSystem.METRIC
      }
      let response = await distanceService.getDistanceMatrix(request);
      if(response && Array.isArray(response.rows) && response.rows.length > 0){
        let nearestRow = response.rows[0]
        for(let row of response.rows){
          if(row.elements[0].duration.value < nearestRow.elements[0].duration.value)
            nearestRow = row;
        }
        let nearestRowAddress = request.origins[response.rows.indexOf(nearestRow)];
        let nearestOffshoot = offshoots.find(o => o.address === nearestRowAddress);
        zoomOnOffshoot(nearestOffshoot, mapMetropole);
      } else {
        console.error('No results from google map api. Check offshoots address or destination address');
      }
    }catch(error) {
      console.error(error);
    }finally {
      searchNearestButton.removeAttribute('disabled');
    }
  })
})