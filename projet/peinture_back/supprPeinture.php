<?php

//INITIALISATION BDD

try {
	$bdd = new PDO('mysql:host=localhost;dbname=test_back;charset=utf8', 'root', '');
}
catch(Exception $e) {
  die('Erreur : '.$e->getMessage());
}

$peintureId = $_GET['peintureId'];
$peintureImg = $_GET['peintureImg'];
echo $peintureId."<br>".$peintureImg;

$req = $bdd->prepare('DELETE FROM peintures_info WHERE id_peinture = ?');
if ($req->execute(array($peintureId))) {
  unlink('peintures/'.$peintureImg);
  header('Location: index.php');
}

?>
