// GLOBAL VAR INIT

$switchScroll = false;


// MAIN VAR INIT

var $scrollBarWidth = $('#custom_scrollbar').outerWidth();
$('#content').css('marginRight', $scrollBarWidth);
var $contentHeight = 0;
var $windowHeight = 0;
var $maxScrollHeight = 0;
var $maxHeightCursor = 0;

var $popupContentHeight = 0;
var $popupHeight = 0;
var $popupMaxScrollHeight = 0;
var $popupMaxHeightCursor = 0;


// INIT MAIN

function initMain() {
	$contentHeight = $('#content').height();
	$windowHeight = $(window).height();
	$maxScrollHeight = $contentHeight-$windowHeight;
	$maxHeightCursor = $('#custom_scrollbar_cursor_box').height() - $('#custom_scrollbar_cursor').outerHeight();
	resizeMain();

	$contentTop = parseInt($('#content').css('top'));
	if($contentHeight < $contentTop+$windowHeight) {
		$('#content').css('top',$contentHeight-$windowHeight);
	}
}


// INIT POPUP

function initPopup() {
	$popupContentHeight = $('#editor_frame .editor-contentZone').outerHeight();
	$popupHeight = $('#editor_frame .editor-content').height();
	$popupMaxScrollHeight = $popupContentHeight-$popupHeight;
	$popupMaxHeightCursor = $('#editor_scroll .scrollbar-main').height() - $('#editor_scroll .scrollbar-cursor').outerHeight();
	resizePopup();
	$('#editor_scroll .scrollbar-cursor').css('top', 0);
}


// RESIZE MAIN

function resizeMain() {
	$windowHeight = $(window).height();
	$maxScrollHeight = $contentHeight-$windowHeight;
	$contentTop = parseInt($('#content').css('top'));
	if ($contentHeight > $windowHeight) {
		if(-$maxScrollHeight > $contentTop) {
			$('#content').css('top', -$maxScrollHeight);
		}
	} else {
		$('#content').css('top', 0);
	}
	$maxHeightCursor = $('#custom_scrollbar_cursor_box').height() - $('#custom_scrollbar_cursor').outerHeight();
	$cursorPosition = $maxHeightCursor*($contentTop/-$maxScrollHeight);
	if($cursorPosition > $maxHeightCursor) {
		$cursorPosition = $maxHeightCursor;
	}
	$('#custom_scrollbar_cursor').css('top', $cursorPosition);
}


// RESIZE POPUP

function resizePopup() {
	$popupHeight = $('#editor_frame .editor-content').height();
	$popupMaxScrollHeight = $popupContentHeight-$popupHeight;
	$popupContentTop = parseInt($('#editor_frame .editor-contentZone').css('top'));
	if (-$popupContentHeight > $popupContentTop) {
		$('#editor_frame .editor-contentZone').css('top', -$popupMaxScrollHeight);
	} else {
		$('#editor_frame .editor-contentZone').css('top', 0);
	}
	$popupMaxHeightCursor = $('#editor_scroll .scrollbar-main').height() - $('#editor_scroll .scrollbar-cursor').outerHeight();
	$popupCursorPosition = $popupMaxHeightCursor*($popupContentTop/-$popupMaxScrollHeight);
	if ($popupCursorPosition > $popupMaxHeightCursor) {
		$popupCursorPosition = $popupMaxHeightCursor;
	}
	$('#editor_scroll .scrollbar-cursor').css('top', $popupCursorPosition);
}


// SCROLL UP MAIN

function scrollUpMain(increment) {
	$contentTop = parseInt($('#content').css('top'));
	$newContentTop = $contentTop+increment;
	if ($newContentTop > 0) {
		$newContentTop = 0;
	}
	$('#content').css('top', $newContentTop);
	$cursorPosition = $maxHeightCursor*($newContentTop/-$maxScrollHeight);
	$('#custom_scrollbar_cursor').animate({top: $cursorPosition},10);
	
	changeVersion();
}


// SCROLL DOWN MAIN

function scrollDownMain(increment) {
	$contentTop = parseInt($('#content').css('top'));
	if($contentHeight > $windowHeight) {
  	$newContentTop = $contentTop-increment;
  	if ($newContentTop < -$maxScrollHeight) {
  		$newContentTop = -$maxScrollHeight;
  	}
		$('#content').css('top', $newContentTop);
		$cursorPosition = $maxHeightCursor*($newContentTop/-$maxScrollHeight);
		$('#custom_scrollbar_cursor').css('top', $cursorPosition);
		
		changeVersion();
	}
}


// SCROLL UP POPUP

function scrollUpPopup(increment) {
	$popupContentTop = parseInt($('#editor_frame .editor-contentZone').css('top'));
	$newPopupContentTop = $popupContentTop+increment;
	if ($newPopupContentTop > 0) {
		$newPopupContentTop = 0;
	}
	$('#editor_frame .editor-contentZone').css('top', $newPopupContentTop);
	$popupCursorPosition = $popupMaxHeightCursor*($newPopupContentTop/-$popupMaxScrollHeight);
	$('#editor_scroll .scrollbar-cursor').animate({top: $popupCursorPosition},10);
}


// SCROLL DOWN POPUP

function scrollDownPopup(increment) {
	$popupContentTop = parseInt($('#editor_frame .editor-contentZone').css('top'));
	$newPopupContentTop = $popupContentTop-increment;
	if ($newPopupContentTop < -$popupMaxScrollHeight) {
		$newPopupContentTop = -$popupMaxScrollHeight;
	}
	$('#editor_frame .editor-contentZone').css('top', $newPopupContentTop);
	$popupCursorPosition = $popupMaxHeightCursor*($newPopupContentTop/-$popupMaxScrollHeight);
	$('#editor_scroll .scrollbar-cursor').animate({top: $popupCursorPosition},10);
}


// DRAG HANDLER MAIN

$('#custom_scrollbar_cursor').draggable({
	axis: 'y',
	containment: 'parent',
	scroll: 'false',
	scrollSpeed: 0,
	drag: function() {
		$cursorPosition = parseInt($(this).css('top'));
		$contentTop = -$cursorPosition*($maxScrollHeight/$maxHeightCursor);
		$('#content').css('top', $contentTop);
		changeVersion();
  }
});


// DRAG HANDLER POPUP

$('#editor_scroll .scrollbar-cursor').draggable({
	axis: 'y',
	containment: 'parent',
	scroll: 'false',
	scrollSpeed: 0,
	drag: function() {
		$popupCursorPosition = parseInt($(this).css('top'));
		$popupContentTop = -$popupCursorPosition*($popupMaxScrollHeight/$popupMaxHeightCursor);
		$('#editor_frame .editor-contentZone').css('top', $popupContentTop);
		console.log($popupCursorPosition);
  }
});


initMain();

$(window).resize(function() {
	resizeMain();
	resizePopup();
});


$(window).bind('mousewheel', function(e) {
	if (e.originalEvent.wheelDelta >= 0) {
		if($switchScroll === false) {
  		scrollUpMain(50);
  	} else {
  		scrollUpPopup(50);
  	}
  } else {
  	if($switchScroll === false) {
  		scrollDownMain(50);
  	} else {
  		scrollDownPopup(50);
  	}
  }
});

$(window).on('keydown', function(e) {
	$keyPressed = e.which;
	if ($keyPressed == 38) {
		if($switchScroll === false) {
  		scrollUpMain(50);
  	} else {
  		scrollUpPopup(50);
  	}
	}
	else if($keyPressed == 40) {
		if($switchScroll === false) {
  		scrollDownMain(50);
  	} else {
  		scrollDownPopup(50);
  	}
	}
});