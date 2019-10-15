<?php

include 'include.php';
( $dbObj = getconnectionObj() ) or die( $stopScript );

$type = 'clc';
$paintingStr = '';
$paintingObj = new PAINTING_Obj($dbObj, $type);
$paintingArr = $paintingObj->load('id','array');
foreach ($paintingArr as $tKey => $tVal) {
		$paintingStr .=
				'<div class="painting-el">'
			.		'<div class="image-box">'
			.			'<img src=peintures/' .$tVal['image'] .'>'
			.		'</div>'
			.		'<div class="text-box">'
			.			'<h2>' .($tVal['name']) .'</h2>'
			.			'<p>' .($tVal['description']) .'</p>'
			.		'</div>'
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
		<link rel="stylesheet" href="assets/css/clc.css">
  </head>
  <body>


    <!-- HEADER -->

    <header class="sub-header">
      <p>LIAUTY Lty.</p>
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
        <h2>CHANGEONS LES CHOSES</h2>
        <p>
					Je me sens témoin, acteur, victime de ce qu’il se passe sur notre planète; qui nous héberge. <br>
					Ma série « Changeons les choses » écrite en multiples langues est un constat sur la déforestation,
					la pollution, la pisciculture, l’élevage... INTENSIFS. <br>
					Les coulures présentes sur mes toiles-affiches sont la représentation des éléments qui se déchainent.
					Ce témoignage est un appel AU SECOURS, de plus un message porteur d’ESPOIR. Les bandes de balisage de
					chaque coté de mes affiches démontrent l’URGENCE de cette prise de conscience. Nous avons un énorme travail
					à développer; avec ce bel exploit s’exprimera notre détermination massive. <br>
					Une part des bénéfices, produit de la vente de mes toiles-affiches sera reversée à des associations oeuvrant
					à la préservation de notre magnifique planète.
        </p>
    </div>

    <div class="main">
      <h3>LES TOILES AFFICHES</h3>
			<?php echo $paintingStr; ?>
    </div>


    <!-- footer -->

    <?php include 'footer.php';?>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>
		<script>
			$('.painting-face').hide();
		</script>
    <!-- <script src="assets/js/smoothScroll.js"></script> -->
  </body>
</html>
