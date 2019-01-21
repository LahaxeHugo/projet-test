<?php

//INITIALISATION BDD

try {
	$bdd = new PDO('mysql:host=localhost;dbname=test_back;charset=utf8', 'root', '');
}
catch(Exception $e) {
  die('Erreur : '.$e->getMessage());
}

//RECUPERATION DONNEES

if(!isset($_POST['peintureName'])) {
  $uploadOk = 0;
}
if(!isset($_POST['peintureDesc'])) {
  $uploadOk = 0;
}
$peintureName = $_POST['peintureName'];
$peintureDesc = $_POST['peintureDesc'];
$peintureId = $_GET['peintureId'];
echo $peintureName."<br>" .$peintureDesc."<br>" .$peintureId;

$req = $bdd->prepare('UPDATE peintures_info SET name_peinture = ?, desc_peinture = ? WHERE id_peinture = ?');
if ($req->execute(array($peintureName,$peintureDesc,$peintureId))) {
  header('Location: index.php');
}

?>
