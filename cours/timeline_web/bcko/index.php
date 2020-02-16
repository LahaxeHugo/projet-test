<?php

include_once '../include.php';
( $dbObj = getconnectionObj() ) or die( $stopScript );


$timeline = new TIMELINE_Obj($dbObj, TIMELINE_DATE);
$timelineData_str = $timeline->load('bcko');


$timelineCat = new TIMELINE_Obj($dbObj, 'timeline_category');
$timelineCat_str = $timelineCat->loadSelect();



$dbObj = null; unset($dbObj);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="../assets/css/back.css"> 
  </head>
  <body>
  	<div id="popup_outer">
  		<div id="popup_inner">
  			<div id="popup_close">X</div>
  			<div id="popup_content"></div>
  		</div>
  	</div>
  	<div id="popup2_outer">
  		<div id="popup2_inner">
	  		<p>Are you sure you want to <span></span> it ?</p>
	  		<button id="popup2_confirm">Confirm</button>
	  		<button id="popup2_cancel">Cancel</button>
	  	</div>
  	</div>
  	
  	
  	<h2>Add Date</h2>
  	
  	<form class="upload-timeline" action="timeline_upload.php" method="post" enctype="multipart/form-data">
			<div class="upload-left">
				Choisissez une image :
				<input type='file' onchange="readURL(this);" name="timelineImg"> <br>
				<div class="preview-box">
					<img id="preview">
				</div>
			</div>
			<div class="upload-right">
				<div>
					<label for="timelineName">Choose a title:</label><br>
					<input type="text" name="timelineName" required>
				</div>
				
				<div>
					<label for="timelineDesc">Choose a description :</label><br>
					<textarea name="timelineDesc"></textarea>
				</div>
				
				<div>
					<label for="timelineDate">Choose a date :</label>
					<input type="date" name="timelineDate" required>
				</div>
				
				<div>
					<label for="timelineCategory">Choose a category :</label>
					<select name="timelineCategory">
						<?php echo $timelineCat_str; ?>
					</select>
				</div>
				
				<div>
					<label for="timelineCredits">Choose credits :</label><br>
					<textarea name="timelineCredits"></textarea> 
				</div>
				
				<input type="submit" value="Upload Date" name="submit">
			</div>
		</form>
  	<h2>Date List</h2>
    <table id="timeline_data">
    	<thead>
    		<tr>
    			<th>Date</th>
    			<th>Id</th>
    			<th>Nom</th>
    			<th>Category</th>
    			<th>Edit</th>
    		</tr>
    	</thead>
    	<tbody>
		  	<?php echo $timelineData_str; ?>
		  </tbody>
    </table>
    <script src="../assets/js/jquery-3.4.1.min.js"></script>
    <script src="back.js"></script>
  </body>
</html>