$('#form_2').hide();
$('#form_3').hide();

$('#next_page_2').on('click',function() {
  $('.form').hide();
  $('#form_2').show();
  $('html, body').animate({ scrollTop: 0}, 0);
  $('.step-2').addClass('step-active');
})
$('#back_page_1').on('click',function() {
  $('.form').hide();
  $('#form_1').show();
  $('html, body').animate({ scrollTop: 0}, 0);
  $('.step-2').removeClass('step-active');
})
$('#next_page_3').on('click',function() {
  $('.form').hide();
  $('#form_3').show();
  $('html, body').animate({ scrollTop: 0}, 0);
  $('.step-3').addClass('step-active');
})

var $quantite = 1;
var $price = 5;

$("#quantite_remove").on('click', function() {
  $quantite--;
  if ($quantite <= 0 ) {
    $quantite = 1;
  }
  $('.quantite_number').text($quantite);
  $('.quantite_price > span').text($quantite*$price);
  console.log($quantite);
})
$("#quantite_add").on('click', function() {
  $quantite++;
  $('.quantite_number').text($quantite);
  $('.quantite_price > span').text($quantite*$price);
  console.log($quantite);
})
