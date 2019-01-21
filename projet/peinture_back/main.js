$('.button-box > .button-El:nth-child(n+3)').hide();
// $('.button-box > button:nth-child(-n+2)').hide();
$('.modif-peinture').hide();
// $('.txt-box > p').hide();
$('.modif-peinture .confirm-overlay').hide();
$('.suppr-peinture .confirm-overlay').hide();
$('#blur-background').hide();

function modifier(id_p) {
  var $id_El = id_p.id;
  $('#'+ $id_El +' .button-box > .button-El:nth-child(n+3)').show();
  $('#'+ $id_El +' .button-box > .button-El:nth-child(-n+2)').hide();
  $('#'+ $id_El +' .modif-peinture').show();
  $('#'+ $id_El +' .txt-box > p').hide();
  var $pName = $('#'+ $id_El +' .txt-box > p:nth-child(1)').html();
  $('#'+ $id_El +' .modif-peinture > input').val($pName);
  var $pDesc = $('#'+ $id_El +' .txt-box > p:nth-child(2)').html();
  $('#'+ $id_El +' .modif-peinture > textarea').val($pDesc);
}
function annuler(id_p) {
  var $id_El = id_p.id;
  $('#'+ $id_El +' .button-box > .button-El:nth-child(n+3)').hide();
  $('#'+ $id_El +' .button-box > .button-El:nth-child(-n+2)').show();
  $('#'+ $id_El +' .modif-peinture').hide();
  $('#'+ $id_El +' .txt-box > p').show();
}

function supprimer(id_p) {
  var $id_El = id_p.id;
  $pNameFinal = $('#'+ $id_El +' .txt-box > p:nth-child(1)').html();
  $('#'+ $id_El +' .suppr-peinture .confirm-overlay  p').html('Voulez-vous vraiment supprimer :<br><b>'+ $pNameFinal+ '</b>');
  $('#'+ $id_El +' .suppr-peinture .confirm-overlay').show();
  $('#blur-background').show();
  $('body').css('overflow','hidden');
}

function confirmer(id_p) {
  var $id_El = id_p.id;
  $pNameFinal = $('#'+ $id_El +' .txt-box > .modif-peinture > input').val();
  $('#'+ $id_El +' .modif-peinture .confirm-overlay > p').html('Voulez-vous sauvegarder les changements de :<br><b>'+ $pNameFinal+ '</b>');
  $('#'+ $id_El +' .modif-peinture .confirm-overlay').show();
  $('#blur-background').show();
  $('body').css('overflow','hidden');
}

$('input[name=peintureCancel]').on('click', function() {
  $('.txt-box .confirm-overlay').hide();
  $('.suppr-peinture .confirm-overlay').hide();
  $('#blur-background').hide();
  $('body').css('overflow','auto');
})
