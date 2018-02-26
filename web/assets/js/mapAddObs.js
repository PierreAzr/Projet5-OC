//Script pour la page addObservation.html.twig

//Rend la photo obligatoire si non sur de soi pour le nom de l'espece
$('#observation_notsur').change(function() {
  if ($('#observation_notsur').is(":checked")) {
    $('#observation_picture_image').attr("required", true);
    $('.imageLabel').addClass('addEtoile');
  } else {
    $('#observation_picture_image').attr("required", false);
    $('.imageLabel').removeClass('addEtoile');
  }
});

//Affiche la photo en aperçu
$("#observation_picture_image").change(function(){
    readURL(this);
});
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#blah').attr('src', e.target.result);
        $('.image').removeClass('hidden');
    }
    reader.readAsDataURL(input.files[0]);
  }
}

//datepicker pour la date d'observation
$('#observation_dateObs').datepicker({
  format: "dd/mm/yyyy",
  endDate: '0',
  todayBtn: true,
  language: "fr",
  autoclose: true,
  todayHighlight: true,
});


//Gestionb des coordonnées geographique de l'observation

//Recuperation des champs
var inputLatitude = document.getElementById("observation_latitude");
var inputLongitude = document.getElementById("observation_longitude");
var inputVille = document.getElementById("observation_ville");
inputLatitude.value = null;
inputLongitude.value = null;
inputVille.value = null;

//Ititialisation de la carte
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 5,
    center: { lat: 46.52863469527167, lng: 2.43896484375 }
  });
    if (navigator.geolocation) { //Si geolocalisation activé
      navigator.geolocation.getCurrentPosition(function(position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        map.setCenter(pos);
        map.setZoom(14);
      })
    }
  var geocoder = new google.maps.Geocoder;
  map.addListener('click', function(e) {
    geocodeLatLng(geocoder, map, e.latLng);
  });
}

var marker

//Fonction de geocodage pour avoir l'adresse + remplissage champs latitute et longitude de l'observation
function geocodeLatLng(geocoder, map, latLng) {
  var latlng = {lat: latLng.lat(), lng: latLng.lng()};
  geocoder.geocode({'location': latlng}, function(results, status) {
    if (status === 'OK') {
      if (results[1]) {
        if(marker) {
          marker.setPosition(latLng);
        }else{
           marker = new google.maps.Marker({
            position: latLng,
            map: map
          });
        }
        map.panTo(latLng);
        inputLatitude.value = latLng.lat();
        inputLongitude.value = latLng.lng();
        var ville = (results[1].formatted_address +
        " (long: " + inputLongitude.value + ", lat: " + inputLatitude.value + ")");
        console.log(ville, inputVille);
        inputVille.value = ville;
      } else {
        window.alert('No results found');
      }
    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
  });
}
