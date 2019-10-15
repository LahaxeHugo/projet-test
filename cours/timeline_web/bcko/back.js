function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#preview').attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}


$('#popup_outer').hide();
$('#popup2_outer').hide();
var $modified = 0;

$('.timeline-edit').on('click', function(e) {
	e.preventDefault();
	$('body').css('overflow','hidden');
	$('#popup_outer').show().addClass('hideBckgrnd');
	
	
	$id = $(this).closest('.timeline-el').data('id');
	
	$.ajax({
			url: 'timeline_popup.php?type=load',
			type: 'POST',
			dataType: 'json',
			data : {
				id: $id
			},
			success: function( responseData, textStatus, xhrobj) {
				$('#popup_content').html(responseData.popup_display);
			},
			error: function(xhrobj, textStatus, errorThrown) {
				console.log( "error : " + textStatus, errorThrown );
			}
		});
});

$('#popup_close').on('click', function(e) {
	$('body').css('overflow','scroll');
	$('#popup_outer').hide().removeClass('hideBckgrnd');
	if($modified == 1) {
		window.location.reload();
	}
});

$('#popup_inner').on('click', '#popup_edit', function(e) {
	$('#popup2_outer').show();
	$('#popup2_outer span').html('modify');
	$('#popup2_confirm').attr('value', 'modify');
});

$('#popup_inner').on('click', '#popup_delete', function(e) {
	$('#popup2_outer').show();
	$('#popup2_outer span').html('delete');
	$('#popup2_confirm').attr('value', 'delete');
});

$('#popup2_cancel').on('click', function(e) {
	$('#popup2_outer').hide();
});

$('#popup2_confirm').on('click', function(e) {
	$type = $('#popup2_confirm').attr('value');
	
	if ($type == 'modify') {
		$.ajax({
			url: 'timeline_popup.php?type=modify',
			type: 'POST',
			dataType: 'json',
			data : {
				id: $id,
				name: $('#popup_content .box-name input[name="name"]').val(),
				date: $('#popup_content .box-date input[name="date"]').val(),
				description: $('#popup_content .box-description textarea[name="description"]').text(),
				category: $('#popup_content .box-category select[name="category"] option:checked').val(),
				credits: $('#popup_content .box-credits textarea[name="credits"]').text(),
				image: $('#popup_content .box-image input[name="image"]').val()
			},
			success: function( responseData, textStatus, xhrobj) {
				$('#popup_content').html(responseData.popup_display);
				$('#popup2_outer').hide();
				$modified = 1;
			},
			error: function(xhrobj, textStatus, errorThrown) {
				console.log( "error : " + textStatus, errorThrown );
			}
		});
	}
	else if ($type == 'delete') {
		$.ajax({
			url: 'timeline_popup.php?type=delete',
			type: 'POST',
			dataType: 'json',
			data : {
				id: $id
			},
			success: function( responseData, textStatus, xhrobj) {
				window.location.reload();
			},
			error: function(xhrobj, textStatus, errorThrown) {
				console.log( "error : " + textStatus, errorThrown );
			}
		});
	}
});