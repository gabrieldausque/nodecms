let mapMetropole;
let geocoder;
let offshoots;
let distanceService;
let directionsService;
let directionRenderer;

function initMap() {
  offshoots = Joomla.getOptions('offshoots');
  offshoots = offshoots['offshoots'];
  mapMetropole = new google.maps.Map(document.getElementById("map-metropole"), {
    center: { lat: 46.966386, lng: 1.4735157 },
    zoom: 6,
  });
  geocoder = new google.maps.Geocoder();
  distanceService = new google.maps.DistanceMatrixService();
  directionsService = new google.maps.DirectionsService();
  directionRenderer = new google.maps.DirectionsRenderer({
    map: mapMetropole,
    panel: document.getElementById("steps")
  })
  directionRenderer.setMap(mapMetropole);
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
  map.setZoom(10);
  let allSummaries = document.querySelectorAll('.offshoot-summary');
  for(let summary of allSummaries){
    summary.classList.remove('active');
  }
  let activeSummary = document.getElementById(`offshoot-summary-${offshoot.id}`);
  if(activeSummary){
    activeSummary.classList.add('active');
    let offshootsContainer = document.getElementById('offshoots');
    window.setTimeout(() => {
      offshootsContainer.scrollTop = activeSummary.offsetTop;
    },1000);
  }

  let allDetails = document.querySelectorAll('.offshoot-details');
  for(let detailCard of allDetails) {
    detailCard.classList.remove('shown');
  }
  let detailCard = document.getElementById(`offshoot-details-${offshoot.id}`);
  if(detailCard) {
    detailCard.classList.add('shown');
  }


  let stepsPanel = document.getElementById('steps');
  if(stepsPanel)
    stepsPanel.classList.remove('shown');

  directionRenderer.setDirections({ routes: []});
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
          if(row.elements[0].status === 'OK' &&
              row.elements[0].duration &&
              (!nearestRow.elements[0].duration ||
              row.elements[0].duration.value < nearestRow.elements[0].duration.value))
            nearestRow = row;
        }
        if(nearestRow && Array.isArray(nearestRow.elements) && nearestRow.elements[0].status === 'OK'){
          let nearestRowAddress = request.origins[response.rows.indexOf(nearestRow)];
          let nearestOffshoot = offshoots.find(o => o.address === nearestRowAddress);
          zoomOnOffshoot(nearestOffshoot, mapMetropole);
          //display path to target
          try {
            let routeResponse = await directionsService.route({
              origin: { query : nearestOffshoot.address},
              destination: { query: locationForDistance.value},
              travelMode: google.maps.DirectionsTravelMode.DRIVING
            });
            await directionRenderer.setDirections(routeResponse);
            let focusOnDetail = async () => {
              let activeDetail = document.querySelector('.offshoot-details.shown')
              if(activeDetail)
                activeDetail.parentElement.scrollTop = activeDetail.offsetTop;
            }
            let displayPanel = async () => {
              let stepsPanel = document.getElementById('steps');
              if(stepsPanel)
                stepsPanel.classList.add('shown');
              window.setTimeout(async () => {
                await focusOnDetail();
              },1000)
            }
            await displayPanel();
          }catch(error){
            console.error(error)
          }
        }
      } else {
        //TODO : show a popup
        console.error('No results from google map api. Check offshoots address or destination address');
      }
    }catch(error) {
      console.error(error);
    }finally {
      searchNearestButton.removeAttribute('disabled');
    }
  })
})