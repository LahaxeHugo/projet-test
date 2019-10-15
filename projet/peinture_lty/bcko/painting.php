
<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="master.css">
</head>
<body>
	<div id="blur-background"></div>
	<div class="confirm-overlay">
		<p></p>
		<button name="cancel">Annuler</button>
		<button name="suppr">Confirmer</button>
	</div>
	<form class="upload-peinture" action="painting-upload.php" method="post" enctype="multipart/form-data">
		<div>
			Choisissez une image :
			<input type='file' onchange="readURL(this);" name="peintureImg" required> <br>
			<div>
				<img id="preview">
			</div>
		</div>
		<div>
			<label for="peintureName">Choisissez un titre :</label><br>
			<input type="text" name="peintureName" required> <br>
			<label for"peintureType">Choisissez un type: </label> <br>
			<select name="peintureType">
				<option value="clc">Changeons les choses</option>
				<option value="clb">Couleurs et lumières du bassins</option>
			</select> <br>
			<label for="peintureDesc">Choisissez une description :</label><br>
			<textarea name="peintureDesc"></textarea> <br>
			<label for="peintureSize">Choisissez une taille (largeur x hauteur) :</label><br>
			<input type="text" name="peintureSize"> <br>
			<label for="peintureDesc">Choisissez un prix :</label><br>
			<input type="text" name="peinturePrice"> <br>
			<input type="submit" value="Upload Info" name="submit">
		</div>
	</form>

	<p id="error"></p>
	<table class="list-peinture">
		<caption><span class="total-count"></span> tableau(x)</caption>
		<thead>
			<tr>
				<th>Image</th>
				<th>Info</th>
				<th>Taille</th>
				<th>Prix</th>
				<th>Type</th>
				<th>Edition</th>
			</tr>
		</thead>
		<tbody id="filter_display">
		</tbody>
	</table>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script>
		var $painting = 'painting_all';
	</script>
	<script src="painting-back.js"></script>
	<script src="preview.js"></script>
</body>
</html>
