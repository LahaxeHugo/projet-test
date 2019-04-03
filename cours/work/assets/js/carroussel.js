var $carrousselNb = $('.carroussel .carroussel-item').length;
var $carrousselCurrent = 1;
$carrousselNext = $carrousselCurrent+1;
if ($carrousselNext > $carrousselNb) {
  $carrousselNext = 1;
}

$('.carroussel-item').hide();
$('#carroussel' + $carrousselCurrent).show();
for (var i = 0; i < $carrousselNb; i++) {
  $('.carroussel-list').append('<div id="carroussel-list-'+ (i+1) +'"><div></div></div>');
}
$('.carroussel-list > div:nth-child('+ $carrousselCurrent +')').addClass('carroussel-list-active');


function carrousselProcess() {
  $('#carroussel'+$carrousselCurrent).fadeOut({queue: false},1000);
  $('#carroussel'+$carrousselNext).fadeIn({queue: false},1000);
  $('.carroussel-list > div:nth-child('+ $carrousselCurrent +')').removeClass('carroussel-list-active');
  $('.carroussel-list > div:nth-child('+ $carrousselNext +')').addClass('carroussel-list-active');
  $carrousselNext++;
  if ($carrousselNext > $carrousselNb) {
    $carrousselNext = 1;
  }
  $carrousselCurrent = $carrousselNext-1;
  if ($carrousselCurrent < 1) {
    $carrousselCurrent = $carrousselNb;
  }
}
var $carroussel = setInterval(carrousselProcess,3000);

$('.carroussel-info').on('mouseover', function() {
  clearInterval($carroussel);
})
$('.carroussel-info').on('mouseout', function() {
  $carroussel = setInterval(carrousselProcess,3000);
})

$('.carroussel-list > div').on('click', function() {
  var $carrousselActive = $(this).hasClass('carroussel-list-active');
  if (!$carrousselActive) {
    clearInterval($carroussel);
    var $carrousselListId = $(this).attr('id');
    $carrousselNext = $carrousselListId.replace(/[^0-9]/g, '');
    console.log($carrousselNext);
    carrousselProcess();
    $carroussel = setInterval(carrousselProcess,3000);
  }
})
