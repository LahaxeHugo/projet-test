<?php

include_once 'include.php';
( $dbObj = getconnectionObj() ) or die( $stopScript );

$timeline = new TIMELINE_Obj($dbObj, TIMELINE_DATE);
$timeline_str = $timeline->load('main', 'main');

$timelineCat = new TIMELINE_Obj($dbObj, 'timeline_category');
$timelineCat->loadSelect('array');
$timelineCat_array = $timelineCat->timeline_cat_array;

$timelineCat_str = '';
foreach ($timelineCat_array AS $cat_id => $cat_name) {
 	$timelineCat_str .=
 			'<div class="desktop-icon" data-category="' .$cat_id .'">'
 		.		'<img src="assets/img/icon/file_mac-01.svg" alt="desktop icon" isselect="0">'
 		.		'<p>' .$cat_name .'</p>'
 		.	'</div>'
 		.'';
 		
} unset($cat_id, $cat_name);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="assets/css/reset.css">
    <link rel="stylesheet" type="text/css" href="assets/css/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="assets/css/master.css">
    <link rel="stylesheet" type="text/css" id="custom_style" href="">
  </head>
  <body>
  	<div id="popup_info">
  		<div id="editor_frame">
  			<div class="editor-header">
  				<div class="editor-close"></div>
  				<div class="editor-reduce"></div>
  				<div class="editor-minimize"></div>
  				<p class="editor-title"></p>
  				<div class="editor-nav">
  					<p>File</p>
  					<p>Edit</p>
  					<p>Object</p>
  				</div>
  			</div>
  			<div class="editor-edit">
  				<div class="editor-save">
  					<img src="assets/img/icon/save_mac-01.svg" alt="save icon">
  				</div>
  				<div class="editor-font editor-fontFamily">
  					<p>Comic Sans</p>
  					<img src="assets/img/icon/arrow-dropdown_mac-01.svg" alt="dropdown arrow">
  				</div>
  				<div class="editor-font editor-fontSize">
  					<p>12</p>
  					<img src="assets/img/icon/arrow-dropdown_mac-01.svg" alt="dropdown arrow">
  				</div>
  				<div class="editor-emph editor-bold">B</div>
  				<div class="editor-emph editor-italic">I</div>
  				<div class="editor-emph editor-underline">U</div>
  				<div class="editor-align editor-align-left">
  					<hr><hr class="editor-align-hrLeft"><hr><hr class="editor-align-hrLeft">
  				</div>
  				<div class="editor-align editor-align-center">
  					<hr><hr class="editor-align-hrCenter"><hr><hr class="editor-align-hrCenter">
  				</div>
  				<div class="editor-align editor-align-right">
  					<hr><hr class="editor-align-hrRight"><hr><hr class="editor-align-hrRight">
  				</div>
  				<div class="editor-align editor-align-justify">
  					<hr><hr><hr><hr>
  				</div>
  				<div class="editor-font editor-emph editor-fontColor">
  					<p>A</p>
  					<img src="assets/img/icon/arrow-dropdown_mac-01.svg" alt="dropdown arrow">
  				</div>
  				<div class="editor-search editor-font">Search ...</div>
  			</div>
  			
  			<div class="editor-content">
  				<div class="editor-contentZone">
  					<div class="editor-pageOuter">
  						<div class="editor-pageInner">
  							<div class="editor-pageInner-header">
  								<p class="editor-pageInner-date"></p>
  								<p class="editor-pageInner-category">Category : <span></span></p>
  							</div>
  							<div class="editor-pageInner-main">
  								<h2></h2>
  								<p class="content-txt"></p>
  								<span class="content-credits"></p>
  							</div>
  						</div>
  					</div>
  				</div>
  				<div id="editor_scroll">
  					<div class="scrollbar-top">
  						<img src="assets/img/icon/arrow_mac-01.svg">
  					</div>
  					<div class="scrollbar-main">
  						<div class="scrollbar-cursor"></div>
  					</div>
  					<div class="scrollbar-bottom">
  						<img src="assets/img/icon/arrow_mac-01.svg">
  					</div>
  				</div>
  			</div>
  			<div class="editor-footer">
  				<p>Page 1</p>
  				<p>Words <span class="editor-wordCount">0</span></></p>
  				<div></div>
  			</div>
  		</div>
  	</div>
  	<div id="content">
  		
  		<div id="filter_date_popup">
  			<div class="filter-header">
  				<div class="filter-close"></div>
  				<div class="filter-reduce"></div>
  				<div class="filter-minimize"></div>
  				<p class="filter-title"></p>
  			</div>
  			<div class="filter-edit">
  				<div class="editor-prev">
						<img src="assets/img/icon/arrow_mac-01.svg">
					</div>
					<div class="editor-next">
						<img src="assets/img/icon/arrow_mac-01.svg">
					</div>
					<div class="editor-align">
						<hr><hr><hr>
					</div>
					<div class="editor-option">
						<div></div>
						<div></div>
						<div></div>
						<div></div>
					</div>
					<div class="filter-search filter-font">Search ...</div>
  			</div>
  			<div class="filter-content">
  				<p class="filter-activated">Filters activated : <span>0</span></p>
  				<div class="filter-filters">
  					
  				</div>
  			</div>
  		</div>
  		
  		<div id="filter_cat_popup">
  			<div class="filter-header">
  				<div class="filter-close"></div>
  				<div class="filter-reduce"></div>
  				<div class="filter-minimize"></div>
  				<p class="filter-title"></p>
  			</div>
  			<div class="filter-edit">
  				<div class="editor-prev">
						<img src="assets/img/icon/arrow_mac-01.svg">
					</div>
					<div class="editor-next">
						<img src="assets/img/icon/arrow_mac-01.svg">
					</div>
					<div class="editor-align">
						<hr><hr><hr>
					</div>
					<div class="editor-option">
						<div></div>
						<div></div>
						<div></div>
						<div></div>
					</div>
					<div class="filter-search filter-font">Search ...</div>
  			</div>
  			<div class="filter-content">
  				<p class="filter-activated">Filters activated : <span>0</span></p>
  				<div class="filter-filters">
  					<?php echo $timelineCat_str;?>
  				</div>
  			</div>
  		</div>
  		
  		
  		<div class="left-fixed-column">
  			<div id="filter_date" class="desktop-icon">
	  			<img src="assets/img/icon/file_mac-01.svg" alt="desktop icon">
					<p>Filter by date</p>
	  		</div>
	  		<div id="filter_category" class="desktop-icon">
	  			<img src="assets/img/icon/floppy_disk_mac-01.svg" alt="floppy disk icon">
					<p>Filter by category</p>
	  		</div>
	  		<div id="reset_filter" class="desktop-icon">
	  			<img src="assets/img/icon/bin_mac-01.svg" alt="floppy disk icon">
					<p>Reset Filter</p>
	  		</div>
  		</div>
  		
  		<div id="timelineEl_box">
  			<?php echo $timeline_str; ?>
  		</div>
  	</div>
  	<div id="custom_scrollbar">
  		<div id="custom_scrollbar_top" class="scrollbar-top">
				<img src="assets/img/icon/arrow_mac-01.svg">
  		</div>
  		<div id="custom_scrollbar_cursor_box" class="scrollbar-main">
  			<div id="custom_scrollbar_cursor" class="scrollbar-cursor"></div>
  		</div>
  		<div id="custom_scrollbar_bottom" class="scrollbar-bottom">
				<img src="assets/img/icon/arrow_mac-01.svg">
  		</div>
  	</div>
  	
  	<script src="assets/js/jquery-3.4.1.min.js"></script>
  	<script src="assets/js/jquery-ui.min.js"></script>
  	<script src="assets/js/init.js"></script>
		<script src="assets/js/scrollBar.js"></script>
		<script src="assets/js/filter.js"></script>
		<script src="assets/js/main.js"></script>
  </body>
</html>