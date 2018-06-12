@extends('layouts.app')

@section('title', 'Direccion de ' . $persona->nombre)

@section('content')
<div class="container-fluid" style="padding: 0px;">
    <div class="row" style="margin: 0px; padding: 0px;">
        <div class="col-md-12" style="margin: 0px; padding: 0px;">
            <input id="address" type="hidden" value="{{ $persona->direccion->localidad . ', ' . $persona->direccion->calle_1 . ' ' . $persona->direccion->numero}}">
            <div id="map" style="height:450px; width: 100%;"></div>
        </div>
	</div>
</div>
<script>
function llenarVentana() {
}
</script>
<script>
    var geocoder;
var map;
var infowindow;
function initialize() {
  geocoder = new google.maps.Geocoder();
  geocoder.geocode({
    'address': document.getElementById("address").value
  }, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
        map: map,
        position: results[0].geometry.location
      });
      var request = {
        location: results[0].geometry.location,
        radius: 50000,
        name: 'ski',
        keyword: 'mountain',
        type: ['park']
      };
      var contentString = '<div class="info-window">' +
                '<h4>{{ $persona->nombre }}</h4>' +
                '<div class="info-content">' +
                '<p>{{ $persona->observaciones }}</p>' +
                '</div>' +
                '</div>';
      infowindow = new google.maps.InfoWindow({
            content: contentString,
            maxWidth: 400
        });
        marker.addListener('click', function () {
            infowindow.open(map, marker);
        });
        infowindow.open(map, marker);
      var service = new google.maps.places.PlacesService(map);
      service.nearbySearch(request, callback);
    } else {
      alert("Geocode was not successful for the following reason: " + status);
    }
  });
  map = new google.maps.Map(document.getElementById('map'), {
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: location,
    zoom: 18
  });
}
function callback(results, status) {
  if (status == google.maps.places.PlacesServiceStatus.OK) {
    for (var i = 0; i < results.length; i++) {
      createMarker(results[i]);
    }
  }
}
function createMarker(place) {
  var placeLoc = place.geometry.location;
  var marker = new google.maps.Marker({
    map: map,
    position: place.geometry.location
  });
  google.maps.event.addListener(marker, 'mouseover', function() {
    infowindow.setContent(place.name);
    infowindow.open(map, this);
  });
}
google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endsection