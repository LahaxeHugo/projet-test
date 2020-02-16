$('#filter_date_popup').hide();
$('#filter_cat_popup').hide();

$('#filter_date_popup')
	.draggable({
		handle: '.filter-header'
	})
	.on('mousedown', function(e) {
		$(this).css('z-index',10);
		$('#filter_cat_popup').css('z-index',9);
	})
	
$('#filter_cat_popup')
	.draggable({
		handle: '.filter-header'
	})
	.on('mousedown', function(e) {
		$(this).css('z-index',10);
		$('#filter_date_popup').css('z-index',9);
	});
	
	/* FILTERS POPUP INIT */

$('#filter_date').on('click', function(e) {
	$('#filter_date_popup').toggle().css('z-index',10).css('top',50).css('left',50);
	$('#filter_cat_popup').css('z-index',9);
})
$('#filter_date_popup .filter-close').on('click', function(e) {
	$('#filter_date_popup').hide();
});
$('#filter_category').on('click', function(e) {
	$('#filter_cat_popup').toggle().css('top',100).css('left',100).css('z-index',10);
	$('#filter_date_popup').css('z-index',9);
});
$('#filter_cat_popup .filter-close').on('click', function(e) {
	$('#filter_cat_popup').hide();
});


var $filterDate = [];
var $filterDateAdded = [];
var $filterDateInit = [];

$('#timelineEl_box .decade-box').each(function(i, obj) {
	$decade = $(this).data('decade');
	$('#filter_date_popup .filter-filters').append(
			'<div class="desktop-icon" data-decade="'+$decade+'">'
		+		'<img src="assets/img/icon/file_mac-0'+$version+'.svg" alt="desktop icon" isselect="0">'
		+		'<p>' +$decade +'-' +($decade+10) +'</p>'
		+ '</div>'
	);
	$filterDate.push($decade);
	$filterDateInit.push($decade);
});
var $filterDateMax = $filterDate.length;

var $filterCat = [];
var $filterCatAdded = [];
var $filterCatInit = [];

$('#filter_cat_popup .filter-filters > div').each(function(i, obj) {
	$category = $(this).data('category');
	$filterCat.push($category);
	$filterCatInit.push($category);
});
var $filterCatMax = $filterCat.length;


/* FILTER DATE */

$('#filter_date_popup .filter-filters > div').on('click', function(e) {
	$decade = $(this).data('decade');
	var $filterFound = $.inArray($decade, $filterDate);
	
	if($filterFound >= 0) {
		$filterDate.splice($filterFound, 1);
		$(this).find('img').attr('src','assets/img/icon/file_selected_mac-0'+$version+'.svg').attr('isselect', '1');
		$.each($filterDate, function(index, value) {
			$('.decade-box[data-decade='+value+']').hide();
		});
	} else {
		$filterDate.push($decade);
		$(this).find('img').attr('src','assets/img/icon/file_mac-0'+$version+'.svg').attr('isselect', '0');
		
		$.each($filterDate, function(index, value) {
			$('.decade-box[data-decade='+value+']').hide();
		});
	}
	
	var $filterFoundAdded = $.inArray($decade, $filterDateAdded);
	if($filterFoundAdded >=0) {
		$filterDateAdded.splice($filterFoundAdded, 1);
	} else {
		$filterDateAdded.push($decade);
		
		$.each($filterDateAdded, function(index, value) {
			$('.decade-box[data-decade='+value+']').show();
		});
		
		$.each($filterCatAdded, function(index, value) {
			$('.category_'+value).show();
		});
	}
	
	$filterDateCurrent = $filterDateMax - $filterDate.length;
	$('#filter_date_popup .filter-activated > span').html($filterDateCurrent);
	
	if($filterDateCurrent == 0) {
		$('.decade-box').show();
	}
	$('.decade-box').each(function() {
		$el = $(this);
		hideEl($el);
	});
	initMain();	
	changeVersion();
});


/* FILTER CATEGORY */

$('#filter_cat_popup .filter-filters > div').on('click', function(e) {
	$category = $(this).data('category');
	$filterFound = $.inArray($category, $filterCat);
	
	if($filterFound >= 0) {
		$filterCat.splice($filterFound, 1);
		$(this).find('img').attr('src','assets/img/icon/file_selected_mac-0'+$version+'.svg').attr('isselect', '1');
		$.each($filterCat, function(index, value) {
			$('.category_'+value).hide();
		});
		
	} else {
		$filterCat.push($category);
		$(this).find('img').attr('src','assets/img/icon/file_mac-0'+$version+'.svg').attr('isselect', '0');
		
		$.each($filterCat, function(index, value) {
			$('.category_'+value).hide();
		});
	}
	
	$('.decade-box').each(function() {
		$el = $(this);
		hideEl($el);
	});
	
	
	$filterFoundAdded = $.inArray($category, $filterCatAdded);
	if($filterFoundAdded >=0) {
		$filterCatAdded.splice($filterFoundAdded, 1);
	} else {
		$filterCatAdded.push($category);
		
		$.each($filterCatAdded, function(index, value) {
			$('.category_'+value).show();
			
			if($.inArray($('.category_'+value).parents('.decade-box').data('decade'), $filterDateAdded) < 0) {
				//$('.category_'+value).parents('.decade-box').show();
			}
		});
	}
	$filterCatCurrent = $filterCatMax - $filterCat.length;
	$('#filter_cat_popup .filter-activated > span').html($filterCatCurrent);
	
	if($filterCatCurrent == 0) {
		$('.date-box').show();
		
		if($filterDateAdded == 0) {
			$('.decade-box').show();
		} else {
			$.each($filterDateAdded,function(i, val) {
				$('.decade-box[data-decade="'+val+'"]').show();
			});
		}
	}
	initMain();
	changeVersion();
});

$('#reset_filter').on('click', function(e) {
	$('.decade-box').show();
	$('.date-box').show();
	$filterDate = $filterDateInit;
	$filterCat = $filterCatInit;
	$filterDateAdded = [];
	$filterCatAdded = [];
	$('.filter-filters > .desktop-icon > img').attr('src', 'assets/img/icon/file_mac-0'+$version+'.svg').attr('isselect', '0');
	$('.filter-activated > span').html('0');
	changeVersion();
});