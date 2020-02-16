<?php
	include '../include.php';
	( $dbObj = getconnectionObj() ) or die( $stopScript );

	$target_dir = '../timeline_img/';
	$msg_array = array();
	$imageExtension_array = array(
		'gif',
		'jpg',
		'jpeg',
		'png'
	);
	if (isset($_REQUEST['timelineName']) && isset($_REQUEST['timelineDate'])) {
		$timeline = new TIMELINE_Obj($dbObj, TIMELINE_DATE);
		$timeline->name = $_REQUEST['timelineName'];
		$timeline->desc = isset($_REQUEST['timelineDesc']) ? $_REQUEST['timelineDesc'] : '';
		$timeline->date = isset($_REQUEST['timelineDate']) ? $_REQUEST['timelineDate'] : '';
		$timeline->category = isset($_REQUEST['timelineCategory']) ? $_REQUEST['timelineCategory'] : '';
		$timeline->credits = isset($_REQUEST['timelineCredits']) ? $_REQUEST['timelineCredits'] : '';
		
		if(isset($_FILES['timelineImg']['name']) && !empty($_FILES['timelineImg']['name'])) {
			if (preg_match('/^.+\..+$/', $_FILES['timelineImg']['name']) === FALSE) {
				$msg_array['error'] = 'Le fichier n\'est pas une image.';
			}
			else {
				if(($check = getimagesize($_FILES['timelineImg']['tmp_name'])) === false) {
					$msg_array['error'][] = 'Le fichier n\'est pas une image.';
				} else {
					$imageExtension = strtolower(pathinfo($_FILES['timelineImg']['name'], PATHINFO_EXTENSION));
					if (!in_array($imageExtension, $imageExtension_array)) {
						$msg_array['error'][] = 'D&eacute;sol&eacute, seulement les ' .implode(', ',$imageExtension_array) .' sont autoris&eacute;s.';
					}
					else {
						$timeline->img_ext = $imageExtension;
					}
				}
			}
		}
		$timeline->addMod();
		
		if ($timeline->img_ext) {
			if (move_uploaded_file($_FILES['timelineImg']['tmp_name'], $target_dir .$timeline->img_full)) {
				header('Location: index.php');
			} else {
				echo 'error while uploading image';
			}
		} else {
			header('Location: index.php');
		}
		
	}
	
?>
