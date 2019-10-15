var $url = 'painting-edition.php?painting=' +$painting +'&edition=';
var $thisId = 0;
var $thisTitle = '';
var $thisDesc = '';
var $thisSize = '';
var $thisPrice = 0;


function toggleDel() {
    $('.confirm-overlay').toggle();
    $('#blur-background').toggle();    
}
toggleDel();


function loadList() {
	$modifMax = 0;
	var $load = $.ajax({
		method : 'GET',
		url: $url +'load',
		dataType : 'json',
		
		success: function( responseData, textStatus, xhrobj) {
			console.log( "success : " + textStatus, responseData );
			if (responseData.error == 1) {
				$('#error').html(responseData.errorCode);
			}
			$totalCount = responseData.totalCount;
			$('.totalCount').html($totalCount);
			$('#filter_display').empty();
			
			$.each(responseData.painting, function (i, line) {
				$('#filter_display').append(line);
				//console.log(line);
			});
		},
		error: function(xhrobj, textStatus, errorThrown) {
			console.log( "error : " + textStatus, errorThrown );
		}
	})
}
loadList();



$('#filter_display')
	.on('click', '.edit-box > a', function(e) {
		e.preventDefault();
	})
	.on('click', '.edit-box > a.get-data', function(e) {
		$mainEl = $(this).closest('.paintingEl');
		$thisId = $mainEl.data('id');
		$thisTitle = $mainEl.find('.txt-box > p:first-child').html();
		$thisDesc = $mainEl.find('.txt-box > p:nth-child(2)').html();
		$thisDate = $mainEl.find('.date-box').html();
		$thisDateStart = $mainEl.find('.dateStart').html();
		$thisDateEnd = $mainEl.find('.dateEnd').html();
		$thisSize = $mainEl.find('.size-box').html();
		$thisPrice = $mainEl.find('.price-box').html();
		$thisType = $mainEl.find('.type-box').data('type');
		$thisTypeText = $mainEl.find('.type-box').html();
	})

	.on('click', '.delete', function(e) {
		toggleDel();
		$('.confirm-overlay > p').html('Voulez-vous supprimer <b>' +$thisTitle +'</b>?');
	})

	.on('click', '.edit-box > .modify', function(e) {
		$mainEl.find('.txt-box').html('<input name="title" value="' +$thisTitle +'"><textarea name="description">'+$thisDesc+'</textarea>');
		$mainEl.find('.date-box').html('<input name="dateStart" type="date" value="'+ $thisDateStart +'"><br><input name="dateEnd" type="date" value="'+ $thisDateEnd +'">');
		$mainEl.find('.size-box').html('<input name="size" value="' +$thisSize +'">');
		$mainEl.find('.price-box').html('<input name="price" value="' +$thisPrice +'">');
		$typeText = '<select name="type"><option value="clc">Changeons Choses</option><option value="clb">Lumieres bassins</option><select>';
		$typeText = $typeText.replace('value="'+$thisType+'"', 'value="'+$thisType+'" selected');
		$mainEl.find('.type-box').html($typeText);
		$mainEl.find('.edit-box').html('<a href="#" class="modify-confirm">Confirmer</a><br><a href="#" class="modify-cancel">Annuler</a>');
	})

	.on('click','.modify-cancel', function(e) {	
		$mainEl.find('.txt-box').html('<p>' +$thisTitle +'</p><p name="description">' +$thisDesc +'</p>');
		$mainEl.find('.date-box').html($thisDate);
		$mainEl.find('.size-box').html($thisSize);
		$mainEl.find('.price-box').html($thisPrice);
		$mainEl.find('.type-box').html($thisTypeText);
		$mainEl.find('.edit-box').html('<a href="#" class="modify">Modifier</a><br><a href="#" class="delete">Effacer</a>');
	})

	.on('click', '.modify-confirm', function(e) {
		$thisNewName = $mainEl.find('input[name=title]').val();
		$thisNewDesc = $mainEl.find('textarea[name=description]').val();
		$thisNewSize = $mainEl.find('input[name=size]').val();
		$thisNewPrice = $mainEl.find('input[name=price]').val();
		$thisNewType = $mainEl.find('select[name=type]').val();
		$thisNewDateStart = $mainEl.find('input[name=dateStart]').val();
		$thisNewDateEnd = $mainEl.find('input[name=dateEnd]').val();

		var $mod = $.ajax({
			method: 'POST',
			url: $url +'mod',
			data: {
				id: $thisId,
				newName: $thisNewName,
				newDesc: $thisNewDesc,
				newSize: $thisNewSize,
				newPrice: $thisNewPrice,
				newType: $thisNewType,
				newDateStart: $thisNewDateStart,
				newDateEnd: $thisNewDateEnd
			},
			dataType: 'json',
		
			success: function( responseData, textStatus, xhrobj) {
				console.log( "success : " + textStatus, responseData );
				if (responseData.error == 1) {
					$('#error').html(responseData.errorCode);
					scrollToEl($('#error'));
				} else {
					loadList();
				}
			},
			error: function(xhrobj, textStatus, errorThrown) {
				console.log( "error : " + textStatus, errorThrown );
			}
		});
	})

$('.confirm-overlay [name="cancel"]').on('click', function(e) {
    toggleDel();
});

$('.confirm-overlay [name="suppr"]').on('click', function(e) {
	var $del = $.ajax({
		method: 'POST',
		url: $url +'del',
		data: {
			id: $thisId,
		},
		dataType: 'json',

		success: function( responseData, textStatus, xhrobj) {
			console.log( "success : " + textStatus, responseData );
			if (responseData.error == 1) {
				$('#error').html(responseData.errorCode);
			} else {
				loadList();
			}
		},
		error: function(xhrobj, textStatus, errorThrown) {
			console.log( "error : " + textStatus, errorThrown );
		}
	});
	toggleDel();
})