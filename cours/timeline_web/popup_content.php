<?php

include_once 'include.php';
( $dbObj = getconnectionObj() ) or die( $stopScript );

$returnArray = array();

if(isset($_REQUEST['id'])) {
	
	$id = $_REQUEST['id'];

	$timelineEl = new TIMELINE_Obj($dbObj, TIMELINE_DATE);
	$timelineEl->id = $id;
	
	$timelineData = $timelineEl->load('array','full');
	$returnArray = $timelineData[0];
	
	$timelineCat = new TIMELINE_Obj($dbObj, 'timeline_category');
	$timelineCat->loadSelect('array');
	$timelineCat_array = $timelineCat->timeline_cat_array;
	$catID_array = explode(';',$returnArray['cat_id']);
	$catName_array = array();
	foreach ($catID_array as $cat) {
		$catName_array[] = ucfirst($timelineCat_array[$cat]);
	} unset($cat,$catID_array);
	
	$returnArray['cat_name'] = implode(', ',$catName_array);
	
	$returnArray['word_count'] = str_word_count($returnArray['description']);
	
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