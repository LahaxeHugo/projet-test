<?php
	include '../include.php';
	( $dbObj = getconnectionObj() ) or die( $stopScript );

	$target_dir = '../peintures/';
	$uploadOk = 1;
	$msg_array = array();
	$imageExtension_array = array(
		'gif',
		'jpg',
		'jpeg',
		'png'
	);
	
	if(isset($_FILES['peintureImg']['name']) && isset($_REQUEST['peintureName'])) {
		if (preg_match('/^.+\..+$/', $_FILES['peintureImg']['name']) === FALSE) {
			$msg_array['error'] = 'Le fichier n\'est pas une image.';
		}
		else {
			if(($check = getimagesize($_FILES['peintureImg']['tmp_name'])) === false) {
				$msg_array['error'][] = 'Le fichier n\'est pas une image.';
			} else {
				$imageExtension = strtolower(pathinfo($_FILES['peintureImg']['name'], PATHINFO_EXTENSION));
				if (!in_array($imageExtension, $imageExtension_array)) {
					$msg_array['error'][] = 'D&eacute;sol&eacute, seulement les ' .implode(', ',$imageExtension_array) .' sont autoris&eacute;s.';
				}
				else {
					if (isset($_REQUEST['peintureType'])) {
						$type	= $_REQUEST['peintureType'];
					} else {
						$type = 'event';
					}
					$painting = new PAINTING_Obj($dbObj, $type);
					$painting->type = $type;
					$painting->name	= utf8_decode(addslashes($_REQUEST['peintureName']));
					$time = isset($_REQUEST['eventTime']) ? $_REQUEST['eventTime'] : '00:00';
					$painting->date_start = isset($_REQUEST['dateStart']) ? $_REQUEST['dateStart'] : '';
					$painting->date_end = isset($_REQUEST['dateEnd']) ? $_REQUEST['dateEnd'] : '';
					$painting->desc	= isset($_REQUEST['peintureDesc']) ? utf8_decode(addslashes($_REQUEST['peintureDesc'])) : '';
					$painting->size	= isset($_REQUEST['peintureSize']) ? $_REQUEST['peintureSize'] : '';
					$painting->price	= isset($_REQUEST['peinturePrice']) ? $_REQUEST['peinturePrice'] : 0;
					$painting->image_extension = $imageExtension;
					$painting->addModTable();
					if (move_uploaded_file($_FILES['peintureImg']['tmp_name'], $target_dir .$painting->image)) {
						if ($painting->type != 'event') {
							header('Location: painting.php');
						} else {
							header('Location: event.php');
						}
					}
				}
			}
		}
	} else {
		echo 'info non compl&eacute;te';
	}
	// print_r($msg_array);
?>
