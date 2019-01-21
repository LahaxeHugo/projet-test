<?php

//INITIALISATION BDD

try {
	$bdd = new PDO('mysql:host=localhost;dbname=test_back;charset=utf8', 'root', '');
}
catch(Exception $e) {
  die('Erreur : '.$e->getMessage());
}

// INITIALISATION VAR

$target_dir = "peintures/";
$file_check = $target_dir . basename($_FILES["peintureImg"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($file_check,PATHINFO_EXTENSION));

// INITIALISATION + NEXT PEINTURE

$monfichier = fopen('current_peinture.txt', 'r+');
$current_peinture = fgets($monfichier);
$name_peinture = "peinture_" . $current_peinture . "." . $imageFileType;
$id_peinture = "peinture_" .$current_peinture;

// VERIFICATION NOM / DESCRIPTION

if(!isset($_POST['peintureName'])) {
  echo "Il n'y a pas de titre. ";
  $uploadOk = 0;
}
if (!isset($_POST['peintureDesc'])) {
  echo "Il n'y a pas de description. ";
  $uploadOk = 0;
}

// CHECK TYPE IMAGE

if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["peintureImg"]["tmp_name"]);

  if($check !== false) {
    echo "Le fichier est - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "Le fichier n'est pas une image. ";
    $uploadOk = 0;
  }
}

// CHECK FORMAT

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Désolé seulement les JPG, JPEG, PNG sont autorisés.";
    $uploadOk = 0;
}

// DERNIER CHECK + UPLOAD

if ($uploadOk == 0) {
  echo "Désolé, la peinture n'a pas pu être upload";
}
else {
	$req = $bdd->prepare("INSERT INTO peintures_info (id_peinture,current_peinture, name_peinture, desc_peinture) VALUES(?, ?, ?, ?)");
  if (move_uploaded_file($_FILES["peintureImg"]["tmp_name"], $target_dir.$name_peinture)
	&& $req->execute(array($id_peinture, $name_peinture, $_POST['peintureName'], $_POST['peintureDesc']))) {
		$current_peinture++;
		fseek($monfichier,0);
		fputs($monfichier, $current_peinture);
		fclose($monfichier);
    header('Location: index.php');
  }
  else {
    echo "Désolé, une erreur est survenu durant l'upload.";
  }
}
?>
