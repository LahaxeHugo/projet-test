<?php

include 'include.php';
( $dbObj = getconnectionObj() ) or die( $stopScript );

$type = 'event';
$eventsStr = '';
$eventObj = new PAINTING_Obj($dbObj, $type);
$eventArr = $eventObj->load('id','array');

foreach ($eventArr as $tKey => $tVal) {
		$eventsStr .=
				'<div class="events-el">'
      .		'<div class="text-box">'
      .			'<h2>' .($tVal['name']) .'</h2>'
      .			'<p>Du '.date('d/m/Y', strtotime($tVal['date_start'])).' au '.date('d/m/Y', strtotime($tVal['date_end'])).'</p>'
      .			'<p>' .($tVal['description']) .'</p>'
			.		'</div>'
      .		'<div class="image-box">'
      .			'<img src=peintures/' .$tVal['image'] .'>'
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
    <link rel="stylesheet" href="assets/css/index.css">
  </head>
  <body>


    <!-- HEADER -->

    <header>
      <p>Liauty LTY</p>
      <h1>Ses oeuvres, ses engagements</h1>
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
      <img src="assets/img/CHANGE-THINGS.png" alt="">
    </div>

    <div class="main">

      <div class="discover">
        <p>Venez découvrir l’artiste dans son </p>
        <p><a href="boutique.php">Atelier</a></p>
      </div>

      <div class="events">
        <?php echo $eventsStr; ?>
      </div>
    </div>


    <!-- footer -->

    <?php include 'footer.php';?>

    <script src="http://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>
    <!-- <script src="assets/js/smoothScroll.js"></script> -->
  </body>
</html>
