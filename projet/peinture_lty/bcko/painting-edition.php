<?php
	include_once '../include.php';
	( $dbObj = getconnectionObj() ) or die( $stopScript );

	//-----		TRAITEMENT

	if (!empty($_REQUEST['painting'])) {
		if (in_array($_REQUEST['painting'], array('painting_all', 'clb', 'clc', 'event'))) {
			$paintingObj = new PAINTING_Obj ($dbObj, $_REQUEST['painting']);
			


			//-----		LOAD

			if ($_REQUEST['edition'] === 'load') {
				$paintingObj->load('id', 'table');
			}


			//-----		DEL MOD/ADD

			if (in_array($_REQUEST['edition'], array('del','mod')) ) {
				$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
				$paintingObj->id = intval($id);


				//-----		DEL

				if ($_REQUEST['edition'] == 'del') {
					$paintingObj->delFromTable();
				}


				//-----		MOD

				if ($_REQUEST['edition'] === 'mod') {
					$newName = isset($_REQUEST['newName']) ? $_REQUEST['newName'] : '';
					$newDesc = isset($_REQUEST['newDesc']) ? $_REQUEST['newDesc'] : '';
					$newSize = isset($_REQUEST['newSize']) ? $_REQUEST['newSize'] : '';
					$newPrice = isset($_REQUEST['newPrice']) ? $_REQUEST['newPrice'] : '';
					$newType = isset($_REQUEST['newType']) ? $_REQUEST['newType'] : 'event';
					$newDateStart = isset($_REQUEST['newDateStart']) ? $_REQUEST['newDateStart'] : '00-00-00';
					$newDateEnd = isset($_REQUEST['newDateEnd']) ? $_REQUEST['newDateEnd'] : '00-00-00';
					$paintingObj->name = utf8_decode($newName);
					$paintingObj->desc = utf8_decode($newDesc);
					$paintingObj->size = utf8_decode($newSize);
					$paintingObj->price = utf8_decode($newPrice);
					$paintingObj->type = utf8_decode($newType);
					$paintingObj->date_start = utf8_decode($newDateStart);
					$paintingObj->date_end = utf8_decode($newDateEnd);

					$paintingObj->addModTable();
				}
				unset($id, $order, $newName, $newDesc, $newSize, $newPrice);
			}


			//-----		ERROR / END

			$json = json_encode($paintingObj->retArray);
			if($json) {
				echo $json;
			}
			else {
				echo json_last_error_msg();
				print_r($_REQUEST);
				//error_log(str_replace(DOCROOT,'',str_replace('\\', '/', __FILE__)).' ON L['.__LINE__. '] : ' .' error json : ' .json_last_error_msg());
				//error_log(str_replace(DOCROOT,'',str_replace('\\', '/', __FILE__)).' ON L['.__LINE__. '] : ' .print_r($_REQUEST, TRUE));
			}
		}
	}
	if( isset($dbObj) && $dbObj instanceof mysqli ) {
		$dbObj->close(); unset($dbObj);
	}

?>
