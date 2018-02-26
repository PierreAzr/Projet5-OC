$("input[data-id=listedesespeces]").autocomplete({
    source: function (request, response) {
        var oiseau = $("input[data-id=listedesespeces]").val();
        var objData = 'oiseau=' + oiseau;
        var url = $(this.element).attr('data-url');

        $.ajax({
            url: url,
            dataType: "json",
            data : objData,
            type: 'POST',
            success: function (data) {
                response($.map(data, function (espece) {
                    return {
                    label: espece.nomVern
                    }
                }));
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
  })
  //Affichage et récupération de la valeur sélectionnée
  $("input[data-id=listedesespeces]").on('autocompleteselect',function(event, ui) {

  	event.preventDefault();

      var contact = ui.item.label;
          id = ui.item.value;
      console.log('Event: ', event);
      console.log('UI :', ui.item);
      $(event.currentTarget).val(contact);

  });
