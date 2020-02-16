<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('max_execution_time', 300);

include_once '../include.php';
( $dbObj = getconnectionObj() ) or die( $stopScript );

$month_array = array(
	1		=>	'janvier',
	2		=>	'février',
	3		=>	'mars',
	4		=>	'avril',
	5		=>	'mai',
	6		=>	'juin',
	7		=>	'juillet',
	8		=>	'août',
	9		=>	'septembre',
	10	=>	'octobre',
	11	=>	'novembre',
	12	=>	'décembre'
);

$timeline_cat = new TIMELINE_Obj($dbObj, TIMELINE_CAT);
$timeline_cat->loadSelect('array');

$timeline_array = array();
$testCurrent = 0;
$testMax = 10;
$isTest = FALSE;


/*$zip = new ZipArchive;
$res = $zip->open('export_2020-01-28.zip');*/
$res = TRUE;
if ($res === TRUE) {
/*
	$folderToEmpty = glob('extracted_date/*');
	foreach($folderToEmpty as $file){
	  if(is_file($file))
	    unlink($file);
	}
  $zip->extractTo('extracted_date/');
  $zip->close();
 */
 
  $files = glob('extracted_date/*.md');
	foreach ($files AS $tFile) {
	 	if(($file = fopen($tFile, 'r')) === FALSE) {
	 		echo '<br> Unable to open '.$tFile;
	 	} else {
	 		$content = fread($file, filesize($tFile));
	 		$lines = explode("\n", $content);
	 		 		
	 		$credits_array = array();
	 		$credits = '';
	 		$description = array();
	 		$emptyLines = 0;
	 		$year = 0;
	 		$month = 0;
	 		$day = 0;
	 		$image = '';
	 		$text = '';
	 		$title = '';
	 		$category = '';
	 		$cat_array = array();
	 		$category_id = '';
	 		
	 		foreach($lines AS $tKey => $line) {
	 			
	 			//$line = str_replace($needle, $replacement, $haystack)
	 			
		
	 			if(strlen($line) == 0) {
	 				$emptyLines++;
	 			}
	 			
	 			if ($emptyLines < 2) {
	 				if ($tKey == 0) {
		 				$title = substr($line, 2);
		 			}
		 			
		 			//if(preg_match($pattern, $subject, $matches))
	 				if (preg_match('/^Année: ([0-9]{4})$/', $line, $tMatch)) {
		 				$year = $tMatch[1];
		 			} unset($tMatch);
		 			
		 			if (preg_match('/^Mois - Jour: (.*)$/', $line, $tMatch)) {
		 				$monthDay = $tMatch[1];
		 			} unset($tMatch);
		 			
		 			if (preg_match('/^Catégorie: ([a-zA-Z,\/ ]*).*$/', $line, $tMatch)) {
		 				$category = $tMatch[1];
		 				$cat_array = explode(',',trim($tMatch[1]));
		 				if(empty($cat_array)) {
		 					$category = 'undefined';
		 					$category_id = array_search(mb_strtolower($category), $timeline_cat->timeline_cat_array, TRUE);
		 				} else {
		 					foreach($cat_array AS $cat) {
		 						$temp_array[] = array_search(mb_strtolower($cat), $timeline_cat->timeline_cat_array, TRUE);
		 					} unset($cat);
		 					$category_id = implode(';', $temp_array);
		 					unset($temp_array);
		 				}
		 				
		 			} unset($tMatch);
		 			
		 			if (preg_match('/^Credits: (.*)$/', $line, $tMatch)) {
		 				if (preg_match('/^(.*)\[(.*)\]\((.*)\).*$/', $tMatch[1], $tempMatch)) {
		 					$credits_array[] = $tempMatch[1].$tempMatch[3];
		 				} else {
		 					$credits_array[] = $tMatch[1];
		 				} unset($tempMatch);
		 			} unset($tMatch);
	 			} else {
	 				if (strlen($line) == 0) {
	 					$description[] = "\r\n";
	 				} else {
	 					if (preg_match('/^!\[.*\]\((.*)\)$/', $line, $tMatch)) {
	 						$image = $tMatch[1];
	 						$description[] = '#image#';
	 					} else {
	 						if (preg_match('/^.*(\[(.+)\]\((.+)\)).*$/', $line, $tMatch)) {
	 							$description[] = str_replace($tMatch[1], '<a href="'.$tMatch[3].'">'.$tMatch[2].'</a>', $line);
	 						} else {
	 							$description[] = $line;
	 						}
	 					} unset($tMatch);
	 				}
	 			}
	 			
	 			
	 		} unset($tKey);
	 		
	 		unset($description[0]);
	 		$text = implode('', $description);
	 		
	 		if (preg_match('/^([0-9]*)(([a-zA-Zûé].* )?(.*))$/', $monthDay, $tMatch)) {
	 			$day = isset($tMatch[1]) ? str_pad($tMatch[1], 2, 0, STR_PAD_LEFT) : '00';
	 			$month = isset($tMatch[4]) ? str_pad(array_search(trim(mb_strtolower($tMatch[4])), $month_array, TRUE), 2, 0, STR_PAD_LEFT) : '';
	 		}
	 
	 		if(empty($category)) {
	 			$category = 'undefined';
		 		$category_id = array_search(mb_strtolower($category), $timeline_cat->timeline_cat_array, TRUE);
	 		}
	 		
	 		if(!empty($credits_array)) {
	 			$credits = implode("\r\n", $credits_array);
	 		}
	 		
	 		$timeline_array[$tFile] = array(
	 			'title'			=> $title,
	 			'date'			=> $year.'-'.$month.'-'.$day,
				'cat_id'		=> $category_id,
	 			'text'			=> $text,
	 			'image'			=> isset($image) ? $image : '',
	 			'credits'		=> $credits
	 		);
	 	}
	 	
	 	if ($isTest) {
	 		$testCurrent++;
		 	if ($testCurrent > $testMax) {
		 		echo '<pre>'.print_r($timeline_array, TRUE).'</pre>';
		 		exit();
		 	}
	 	}
	} unset($tFile);

	$dbObj->query('TRUNCATE '.TIMELINE_DATE);
	foreach ($timeline_array AS $timeline_el) {
		$timeline = new TIMELINE_Obj($dbObj, TIMELINE_DATE);
		$timeline->name = $timeline_el['title'];
		$timeline->desc = $timeline_el['text'];
		$timeline->date = $timeline_el['date'];
		$timeline->category = $timeline_el['cat_id'];
		$timeline->img_full = $timeline_el['image'];
		$timeline->credits = $timeline_el['credits'];
	
		$timeline->addMod();
		if(!empty($timeline_el['image'])) {
			rename('extracted_date/'.$timeline->img_full, '../timeline_img/'.$timeline->img_full);
		}
		unset($timeline);
	} 
	echo '<pre>'.print_r($timeline_array, TRUE).'</pre>';
  
} else {
  echo 'Error while extracting';
}



?>