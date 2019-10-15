<?php 

	include_once '../include.php';
	( $dbObj = getconnectionObj() ) or die( $stopScript );
	
	$returnArray = array();
	
	if (isset($_REQUEST['id']) && isset($_REQUEST['type'])) {
		$id = $_REQUEST['id'];
		$type = $_REQUEST['type'];
		
		$timeline = new TIMELINE_Obj($dbObj, 'timeline_date');
		$timeline->id = $id;
		
		if($type == 'modify') {
			$timeline->name = $_REQUEST['name'];
			$timeline->date = $_REQUEST['date'];
			$timeline->desc = $_REQUEST['description'];
			$timeline->category = $_REQUEST['category'];
			$timeline->credits = $_REQUEST['credits'];
			$timeline->img_full = $_REQUEST['image'];
			$timeline->addMod();
		}
		
		
		
		if ($type == 'load' || $type == 'modify') {
			
			$timelineData_array = $timeline->load('array');
			$timelineData = $timelineData_array[0];
		
			$timelineCat = new TIMELINE_Obj($dbObj, 'timeline_category');
			$timelineCat_str = $timelineCat->loadSelect();
			
			$timelineCat_str = str_replace('option value="'.$timelineData['cat_id'].'"', 'option value="'.$timelineData['cat_id'].'" selected', $timelineCat_str);
			

			$display	=	''
								.	'<h2>TIMELINE ' .$timelineData['id'] .'</h2>'
								.	'<div class="box-name">'
								.		'<p>Name :</p>'
								.		'<input name="name" value="' .$timelineData['name'] .'">'
								.	'</div>'
								.	'<div class="box-date">'
								.		'<p>Date : </p>'
								.		'<input name="date" type="date" value="' .date('Y-m-d', strtotime($timelineData['date'])) .'">'
								.	'</div>'
								.	'<div  class="box-description">'
								.		'<p>Description : </p>'
								.		'<textarea name="description">' .$timelineData['description'] .'</textarea>'
								.	'</div>'
								.	'<div class="box-category">'
								.		'<p>Category : </p>'
								.		'<select name="category">' .$timelineCat_str .'</select>'
								.	'</div>'
								.	'<div class="box-credits">'
								.		'<p>Credits : </p>'
								.		'<textarea name="credits">' .$timelineData['credits'] .'</textarea>'
								.	'</div>'
								.	'<div class="box-image">'
								.		'<p>Image : </p>'
								.		'<input name="image" value="' .$timelineData['image'] .'">'
								.	'</div>'
								.	'<div class="box-button">'
								.		'<button id="popup_edit">Modify</button>'
								.		'<button id="popup_delete">Delete</button>'
								.	'</div>'
								.'';
								
			$returnArray['popup_display'] = $display;
		}
		
		if ($type == 'delete') {
			$timeline->delete();
		}
	}
	
	
	
	$json = json_encode($returnArray);
	if($json) {
		echo $json;
	}
	else {
		error_log(str_replace(DOCROOT,'',str_replace('\\', '/', __FILE__)).' ON L['.__LINE__. '] : ' .' error json : ' .json_last_error_msg());
		error_log(str_replace(DOCROOT,'',str_replace('\\', '/', __FILE__)).' ON L['.__LINE__. '] : ' .print_r($_REQUEST, TRUE));
	}

?>