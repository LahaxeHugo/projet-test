<?php

include 'include.php';
( $dbObj = getconnectionObj() ) or die( $stopScript );

$type = 'clb';
$paintingStr = '';
$paintingObj = new PAINTING_Obj($dbObj, $type);
$paintingArr = $paintingObj->load('id','array');
foreach ($paintingArr as $tKey => $tVal) {
	$paintingStr .=
			'<div class="width50">'
		.	'<div class="flip-card">'
		.	'<div class="painting-el flip-card-inner" >'
		.		'<div class="painting-face flip-card-front">'
		.			'<div class="image-box">'
		.				'<img src=peintures/' .$tVal['image'] .'>'
		.			'</div>'
		.			'<h2>' .($tVal['name']) .'</h2>'
		.		'</div>'
		.		'<div class="painting-info flip-card-back">'
		.			'<h2>' .($tVal['name']) .'</h2>'
		.			'<hr>'
		.			'<p>Prix (€) : ' .($tVal['price']) .'</p>'
		.			'<p>Taille : ' .($tVal['size']) .'</p>'
		.			'<div>'
		.				'<p><a href="peintures/' .$tVal['image'] .'" target="blank">Agrandir l\'oeuvre</a></p>'
		.			'</div>'
		.		'</div>'
		.	'</div>'
		.	'</div>'
		.	'</div>';
}
unset($tKey, $tVal);


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/master.css">
		<link rel="stylesheet" href="assets/css/clb.css">
  </head>
  <body>


    <!-- HEADER -->

    <header class="sub-header">
      <p>Liauty LTY</p>
      <nav>
        <ul>
          <li><a href="index.php">Accueil</a></li>
          <li><a href="boutique.php">Boutique</a></li>
          <li><a href="biographie.php">Biographie</a></li>
          <li><a href="contact.php">Me contacter</a></li>
        </ul>
      </nav>
    </header>


    <!-- HERO -->

    <div class="hero">
        <h2>COULEURS ET LUMIERES DU BASSIN</h2>
        <p>
          Passionnée depuis son enfance par le Bassin d'Arcachon, bercée par le
          clapotis de l'eau sur les rivages des villages de la Presqu'île du Cap
          Ferret, LIAUTY accomplit un travail conceptuel, mêlant son imaginaire et le réalisme des paysages.
        </p>
    </div>

    <div class="main">
      <h3>TABLEAUX</h3>
      <div class="painting-list">
				<?php echo $paintingStr; ?>
			</div>
    </div>


    <!-- footer -->

    <?php include 'footer.php';?>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>
		<!-- <script src="assets/js/smoothScroll.js"></script> -->
		<script>
			
		</script>
  </body>
</html>
