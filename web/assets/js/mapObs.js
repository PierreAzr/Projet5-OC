//Script de la carte pour observation.html.twig

//Recuperation des coordonnées de l'observation
var resultArray = (function getGeoDataArray() {
  var $coords = $('#coordonnees').find('div');
  var resultsArray = [];
  for (var i = 0; i < $coords.length; i++) {
      var lat = $($coords[i]).data('latitude');
      var lng = $($coords[i]).data('longitude');
      var coord = [lat, lng];
      resultsArray.push(coord);
  }
  return resultsArray;
})();

//Check si l'utilisateur est autorisé a voir les coordonnées exactes de l'observation
var autorisation = $('#autorisation').find('div');
var auto = $(autorisation).data('user');

//Initialisation de la carte
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: { lat: 46.52863469527167, lng: 2.43896484375 }
  });

  for (var i = 0; i < resultArray.length; i++) {
    var result = resultArray[i];
    if (auto == 'ALLOW') { //Si autorisé, on affiche les marqueurs position exacte
      var marker = new google.maps.Marker({
          position: {lat: result[0], lng: result[1]},
          map: map,
      });
      var geocoder = new google.maps.Geocoder;
      var lat = result[0];
      var lng = result[1];
      geocodeLatLng(geocoder, map, lat, lng);
      map.panTo({lat: result[0], lng: result[1]});
    } else if (auto == 'NOTALLOW') { // Si non autorisé, on affiche des cercles, position non precise
      var cityCircle = new google.maps.Circle({
        strokeColor: '#FF0000',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#FF0000',
        fillOpacity: 0.35,
        map: map,
        center: {lat: result[0], lng: result[1]},
        radius: Math.sqrt(500) * 100
      });
      var geocoder = new google.maps.Geocoder;
      var lat = result[0];
      var lng = result[1];
      geocodeLatLng(geocoder, map, lat, lng);
    }
  }
}

var marker
//Fonction geocodage
function geocodeLatLng(geocoder, map, lat, lng) {
  var latlng = {lat: lat, lng: lng};
  map.panTo(latlng);
  if(auto == 'ALLOW') { //Si autorisé, affichage latitude et longitude
    geocoder.geocode({'location': latlng}, function(results, status) {
      $(".obsPlaceText").html("<p class='bold'>" + results[1].formatted_address +
      "</p><p class='italic'>" +
      "long: " + lng + ", lat: " + lat );
    });
  }else if (auto == 'NOTALLOW') { // Si non autorisé, on affiche pas la latitude et longitude, juste l'adresse
    geocoder.geocode({'location': latlng}, function(results, status) {
      $(".obsPlaceText").html("<p class='bold'>" + results[1].formatted_address +
      "</p>");
    });
  }
}

//Permet d'afficher le formulaire pour modifier le nom de l'espece (sur obs non publiée)
$(".changeTaxrefname").click(function() {
  $(".changeName").removeClass("hidden");
  $('.changeBtn').addClass("hidden");
});

//Si on clique sur non conforme
$(".notconforme").click(function() {
  $(".notconformzone").removeClass("hidden");
});

//Si non conforme, on applique un masque sur l'observation
var $coords = $('#coordonnees').find('div');
if ($($coords).data('conform') == 1) {
  $('.observation').css('-webkit-filter', 'brightness(40%)');
}

//Affichage plein ecran de la photo de l'observation
function toggleFullscreen(elem) {
  elem = elem || document.documentElement;
  if (!document.fullscreenElement && !document.mozFullScreenElement &&
    !document.webkitFullscreenElement && !document.msFullscreenElement) {
    if (elem.requestFullscreen) {
      elem.requestFullscreen();
    } else if (elem.msRequestFullscreen) {
      elem.msRequestFullscreen();
    } else if (elem.mozRequestFullScreen) {
      elem.mozRequestFullScreen();
    } else if (elem.webkitRequestFullscreen) {
      elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    }
  } else {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    }
  }
}

document.getElementById('photo').addEventListener('click', function() {
  toggleFullscreen(this);
});
