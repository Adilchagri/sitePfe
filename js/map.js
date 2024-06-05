// Initialize and add the map
let map;
function initMap() {

  // The map, centered at Uluru
  var BJ={lat:  32.90109300, lng: -6.77616860 } 
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 10,
    center: BJ
  });

  // Create the markers on the map using the marker data list
  for (var i = 0; i < markerDataList.length; i++) {
    var markerData = JSON.parse(markerDataList[i]);
    var latLng = new google.maps.LatLng(markerData[0], markerData[1]);
    var marker = new google.maps.Marker({
      position: latLng,
      map: map,
      title: "Marker " + (i+1)
    });
  }
}

initMap();