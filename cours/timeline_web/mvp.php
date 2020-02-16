<?php

include_once 'include.php';
( $dbObj = getconnectionObj() ) or die( $stopScript );

$timeline = new TIMELINE_Obj($dbObj, TIMELINE_DATE);
$timelineData_array = $timeline->load('array');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Mvp Timeline</title>
  </head>
  <body>
  	<pre>
  		<?php print_r($timelineData_array);?>
  	</pre>
  </body>