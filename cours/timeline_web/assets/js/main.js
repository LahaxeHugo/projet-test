/* FUNCTION HIDE ELEMENT */

function hideEl(el) {
	el.each(function() {
		if($(this).children('.date-box:hidden').length == $(this).children('.date-box').length) {
			$(this).hide();
		} else {
			$(this).show();
		}
		
		//console.log($(this).children('.date-box').filter(':hidden').length +' === '+$(this).children('.date-box').length);
	});
}


/* INIT & DRAG HANDLER */

$('#popup_info').hide();

$('#editor_frame').draggable({
	handle: '.editor-header'
});


/* POPUP INFO */

$('.date-box > .date-button').on('click', function(e) {
	$switchScroll = true;
	$idDate = $(this).closest('.date-box').data('id');
	
	$.ajax({
		url: 'popup_content.php',
		type: 'POST',
		dataType: 'json',
		data : {
			id: $idDate
		},
		success: function( responseData, textStatus, xhrobj) {
			$('#editor_frame .editor-content .editor-pageInner-date').html(responseData.dateTxt);
			$('#editor_frame .editor-content .editor-pageInner-category > span').html(responseData.cat_name);
			$('#editor_frame .editor-content .editor-pageInner-main > h2').html(responseData.name);
			$('#editor_frame .editor-wordCount').html(responseData.word_count);
			$text = responseData.description;
			if (responseData.image) {
				 $text = $text.replace('#image#','<p class="editor-img"><img src="timeline_img/'+responseData.image+'"></p>');
			 //$('#editor_frame .editor-content .editor-pageInner-main > img').attr('src','timeline_img/'+responseData.image);
			}
			$credits_arr = responseData.credits.split("\r\n");
			$credits_html = '';
			$.each($credits_arr, function(i, val) {
				//$credits_html = $credits_html + '<a href="'+val+'">'+val+'</a><br>';
				$credits_html = $credits_html + val +'<br>';
			});
			$text = $text + '<br><br><span class="content-credits">' +$credits_html +'</span>';
			$('#editor_frame p.content-txt').html($text);
			
			
			//$('#editor_frame span.content-credits').html($credits_html).appendTo('#editor_frame p.content-txt');
			
			if (responseData.name.length > 50) {
				$('#editor_frame .editor-header > .editor-title').html(responseData.name.substring(0, 50) + '...');
			} else {
				$('#editor_frame .editor-header > .editor-title').html(responseData.name);
			}
			$('#popup_info').show();
			initPopup();
		},
		error: function(xhrobj, textStatus, errorThrown) {
			console.log( "error : " + textStatus, errorThrown );
		}
	});
});

$('#editor_frame .editor-close').on('click', function(e) {
	$switchScroll = false;
	$('#popup_info').hide();
});

function switchDesign(version) {
	if(version == 1) {
		$('#custom_style').attr('href', '');
	} else {
		$('#custom_style').attr('href', 'assets/css/mac-0'+version+'.css');
	}
	
	$('.date-icon > img, #filter_date > img').attr('src', 'assets/img/icon/file_mac-0'+version+'.svg');
	$('#filter_category > img').attr('src', 'assets/img/icon/floppy_disk_mac-0'+version+'.svg');
	$('.filter-filters > .desktop-icon > img[isselect="0"]').attr('src', 'assets/img/icon/file_mac-0'+version+'.svg');
	$('.filter-filters > .desktop-icon > img[isselect="1"]').attr('src', 'assets/img/icon/file_selected_mac-0'+version+'.svg');
	$('#custom_scrollbar_top > img, #custom_scrollbar_bottom > img, .editor-prev > img, .editor-next > img').attr('src', 'assets/img/icon/arrow_mac-0'+version+'.svg');
	$('.editor-save > img').attr('src', 'assets/img/icon/save_mac-0'+version+'.svg');
	$('.editor-font > img').attr('src', 'assets/img/icon/arrow-dropdown_mac-0'+version+'.svg');
	$('#reset_filter > img').attr('src', 'assets/img/icon/bin_mac-0'+version+'.svg');
	
	initMain();
}


$designBreakpoint = $maxScrollHeight/7;

function changeVersion() {
	$version = Math.floor(-$contentTop/$designBreakpoint)+1;
	if($version > 7) $version = 7;
	switchDesign($version);
}

//$('body').on('click', function(e) {
//	$version++;
//	if($version > 7) $version = 1;
//	switchDesign($version);
//});
