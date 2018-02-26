//Script JS pour la page recherche.html.twig + results.html.twig

//Recuperation des coordonnées des observations
var markers = []; // mise en place des marqueurs dans une ilste
var resultArray = (function getGeoDataArray() {
  var $coords = $('#coordonnees').find('div');
  var resultsArray = [];
  for (var i = 0; i < $coords.length; i++) {
      var lat = $($coords[i]).data('latitude');
      var lng = $($coords[i]).data('longitude');
      var src = $($coords[i]).data('src').toString();
      var date = $($coords[i]).data('date');

      var content = '<div class="miniObs"><img class="miniPic" src="'+ src + '">'
      + '<div class="descriptionMini"><h4>' + $($coords[i]).data("espece") + '</h4>' + '<div class="col-md-6 col-xs-6"><h5>'
      + $($coords[i]).data("username") + '.' + '</h5></div><div class="col-md-6 col-xs-6"><h5 class="italic">'
      + date + '.' + '</h5></div></div></div>';

      var coord = [lat, lng, content];
      resultsArray.push(coord);
  }
  return resultsArray;
})();

//Recupere si l'utilisateur est autorisé a voir la position exacte ou non
var autorisation = $('#autorisation').find('div');
var auto = $(autorisation).data('user');

//Initialisation de la carte
function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 5,
    center: { lat: 46.52863469527167, lng: 2.43896484375 }
  });

  setMarkers(map);
  if (auto == 'ALLOW') { //Si autorisé, regroupement des marqueurs avec markerCluster
    var markerCluster = new MarkerClusterer(map, markers,
      {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
  }
}

//Definition des marqueurs ou cercles
function setMarkers(map) {
  for (var i = 0; i < resultArray.length; i++) {
    var result = resultArray[i];
    if (auto == 'ALLOW') { //Si autorisé, affichage des marqueurs avec fenetre d'info
      var infowindow = new google.maps.InfoWindow({
        content: result[2],
        minWidth: 300,
      });
      var marker = new google.maps.Marker({
          position: {lat: result[0], lng: result[1]},
          map: map,
          infowindow: infowindow
      });
      markers.push(marker);

      google.maps.event.addListener(marker,'click', function(){
        hideAllInfoWindows(map);
        this.infowindow.open(map,this);
        // Recupere la fenetre info
        var iwOuter = $('.gm-style-iw');

        //On recupere la div precedante pour le background
        var iwBackground = iwOuter.prev();

        // On enleve le background
        iwBackground.children(':nth-child(2)').css({'display' : 'none'});
        iwBackground.children(':nth-child(4)').css({'display' : 'none'});

        // Deplace la fenetre d'info
        iwOuter.parent().parent().css({left: '15px'});

        // On deplace la fleche de la fenetre
        iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 176px !important;'});
        // Ainsi que son ombre
        iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 176px !important;'});

        //On change la couleur du background
        iwBackground.children(':nth-child(3)').children(':nth-child(2)').children(':nth-child(1)').css('background-color', '#ff5b00');
        iwBackground.children(':nth-child(3)').children(':nth-child(1)').children(':nth-child(1)').css('background-color', '#ff5b00');

        //On recupere le bouton de fermeture
        var iwCloseBtn = iwOuter.next();
        var iwCloseImage = iwOuter.next().next();

        // On appliquer different style en fonction de la taille d'ecran
        if($(window).width()<=767) {
          iwCloseBtn.css({
            opacity: '0.7',
            right: '-15px', top: '20px', //Repositionnement du bouton
            });
          //Deplacement de la fleche et son ombre sur mobile (sinon decalage)
          iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 140px !important;'});
          iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 140px !important;'});
        } else {
          iwCloseBtn.css({
            opacity: '0.7',
            right: '60px', top: '20px',
            });
          iwCloseImage.css({
            right: '40px',
          })
        }

        //redefini l'opacité du bouton fermer sur 1
        iwCloseBtn.mouseout(function(){
          $(this).css({opacity: '1'});
        });
      });
    }
    else if (auto == 'NOTALLOW') { //Si non autorisé, affichage des cercles
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
    }
  }
}

//Fonction qui ferme les fenetre ouverte quand on clique sur un autre marqueuers 
function hideAllInfoWindows(map) {
   markers.forEach(function(marker) {
     marker.infowindow.close(map, marker);
  });
}
