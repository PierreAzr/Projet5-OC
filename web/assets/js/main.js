//Script principal du site

//Adaptation affichage liste et carte sur mobile
if($(window).width()<=767) {
  $('.Liste').addClass('hidden');
  $('.glyphicon-map-marker').css("color", "white");
  $('.glyphicon-tasks').css("color", "#00c4b6");
}

//Changement du ccs du bouton orange quand le bouton vert est survolé
if ($(".btnIndex1").hover(function() {
  if ($(".btnIndex2").hasClass('btn-site-orange')) {
    $(".btnIndex2").removeClass('btn-site-orange');
    $(".btnIndex2").addClass('btn-site');
  } else {
    $(".btnIndex2").removeClass('btn-site');
    $(".btnIndex2").addClass('btn-site-orange');
  }
})) {}

//Affiche la liste des observation sur mobile
$('.btnListe').click(function() {
  if ($('.Liste').hasClass("hidden")) {
    $('.Liste').removeClass('hidden');
    $('#Carte').addClass('hidden');
    $('.glyphicon-map-marker').css("color", "#00c4b6");
    $('.glyphicon-tasks').css("color", "white");
  }
});

//Affiche la carte sur mobile
$('.btnCarte').click(function() {
  if ($('#Carte').hasClass("hidden")) {
    $('.Liste').addClass('hidden');
    $('#Carte').removeClass('hidden');
    $('.glyphicon-map-marker').css("color", "white");
    $('.glyphicon-tasks').css("color", "#00c4b6");
    initMap();
  }
});

//Ajoute les fleches sous les boutons menu du mobile quand liste ouverte
$('.usermenubutton').click(function () {
  if ($('div.usermenu').hasClass('in')) {
    $('.usermenubutton').removeClass('arrow');
  } else {
    $('.usermenubutton').addClass('arrow');
    $('div.menu').removeClass('in');
    $('.menubutton').removeClass('arrow2');
  }
});

$('.menubutton').click(function () {
  if ($('div.menu').hasClass('in')) {
    $('.menubutton').removeClass('arrow2');
  } else {
    $('.menubutton').addClass('arrow2');
    $('div.usermenu').removeClass('in');
    $('.usermenubutton').removeClass('arrow');
  }
});
