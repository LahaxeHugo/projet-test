$('.wrapper').hide();

$('.validate-box').on('click',function() {
  $('.verification').hide();
  $('.wrapper').show();
  verification();
})

function verification() {

  var $cognacNb = $(".cognac-txt > div").length;
  var $windowHeight = $(window).height();
  var $cognacBuyOffset = ($cognacNb-1)*$windowHeight;
  var $cognacBuyScroll = ($cognacNb)*$windowHeight;

  $(function() {
    $('html, body').animate({ scrollTop: 0}, 200);
  })
  $(window).resize(function() {
    $windowHeight = $(window).height();
    $cognacBuyOffset = ($cognacNb-1)*$windowHeight;
  })

  function offsetUp() {
    var $topPage = $(window).scrollTop();
    var $offset = $(document).scrollTop();
    var $offsetTemp = Math.round($offset/$windowHeight);
    $offset = $offsetTemp*$windowHeight;
    var $offsetUp = $offset - $windowHeight;
    if ($cognacBuyScroll > $topPage) {
      $('html, body').stop(true).animate({ scrollTop: $offsetUp}, 800);
    }
  }

  function offsetDown() {
    var $topPage = $(window).scrollTop();
    var $offset = $(document).scrollTop();
    var $offsetTemp = Math.round($offset/$windowHeight);
    $offset = $offsetTemp*$windowHeight;
    var $offsetDown = $offset + $windowHeight;
    if ($cognacBuyScroll > $topPage) {
      $('html, body').stop(true).animate({ scrollTop: $offsetDown}, 800);
    }
  }

  $(window).on('scroll', function() {



    var $topPage = $(window).scrollTop();
    if ($cognacBuyOffset < $topPage) {
      $('.cognac-img').css('position','static');
      $('.cognac-background').css('position','absolute');
      $('.cognac-img').css('margin-top', $windowHeight*2);
      $('.cognac-background').css('margin-top', $windowHeight*2);
    }
    else {
      $('.cognac-img, .cognac-background').css('position','fixed');
      $('.cognac-img, .cognac-background').css('margin-top','0');
    }

    // if ($topPage > ($('.cognac-txt-2').offset().top)-$windowHeight/2) {
    //   $('.cognac-img').addClass('cognac-img-transition-1');
    // }
    // else {
    //   $('.cognac-img').removeClass('cognac-img-transition-1');
    // }
    // if ($topPage > ($('.cognac-txt-3').offset().top)-$windowHeight/2) {
    //   $('.cognac-img').addClass('cognac-img-transition-2');
    // }
    // else {
    //   $('.cognac-img').removeClass('cognac-img-transition-2');
    // }

  })

  $(window).bind('mousewheel', function(event) {
    if (event.originalEvent.wheelDelta >= 0) { offsetUp() }
    else { offsetDown() }
  })
  $(document).keydown(function(e){
    if (e.which == 38) { offsetUp() }
    if (e.which == 40) { offsetDown() }
  })

  $('.cognac-img, .cognac-background').css('position','fixed');
  $('.cognac-buy').css('top','calc(100vh + '+$cognacBuyOffset +'px)');
}
