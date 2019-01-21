<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="master.css">
  </head>
  <body>
    <form class="upload-peinture" action="uploadPeinture.php" method="post" enctype="multipart/form-data">
      <div>
        Choisissez une image :
        <input type='file' onchange="readURL(this);" name="peintureImg"> <br>
        <div>
          <img id="preview">
        </div>
      </div>
      <div>
        Choisissez un titre : <br>
        <input type="text" name="peintureName" required> <br>
        Choisissez une description : <br>
        <textarea name="peintureDesc" required></textarea> <br>
        <input type="submit" value="Upload Info" name="submit">
      </div>
    </form>

    <?php

    //INITIALISATION BDD

    try {
    	$bdd = new PDO('mysql:host=localhost;dbname=test_back;charset=utf8', 'root', '');
    }
    catch(Exception $e) {
      die('Erreur : '.$e->getMessage());
    }

    // RECUPERATION DATA BDD + IMG

    $reponse = $bdd->query('SELECT id_peinture AS ID, current_peinture AS IMG, name_peinture AS NAME, desc_peinture AS DESCRIPTION FROM peintures_info ');
    echo "<ul class='list-peinture'>";
    while ($data = $reponse->fetch()) {
      echo
      "<li id='" .$data['ID'] ."'>
        <div class='img-box'><div><img src='peintures/" .$data['IMG'] ."'></div></div>
        <div class='txt-box'>
          <p>" .$data['NAME'] ."</p><p>" .$data['DESCRIPTION'] ."</p>
          <form class='modif-peinture' action='modifPeinture.php?peintureId=" .$data['ID'] ."' method='post'>
            <input type='text' name='peintureName'> <br>
            <textarea type='text' name='peintureDesc'></textarea>
            <div class='confirm-overlay'>
              <p></p>
              <input type='button' name='peintureCancel' value='Annuler'>
              <input type='submit' name='peintureModif' value='Confirmer'>
            </div>
          </form>
        </div>
        <div class='button-box'>
          <div class='button-El'><a onclick='modifier(" .$data['ID'] .")'>Modifier</a></div>
          <div class='button-El'><a onclick='supprimer(" .$data['ID'] .")'>Supprimer</a></div>
          <div class='button-El'><a onclick='confirmer(" .$data['ID'] .")'>Confirmer</a></div>
          <div class='button-El'><a onclick='annuler(" .$data['ID'] .")'>Annuler</a></div>
        </div>
        <form class='suppr-peinture' action='supprPeinture.php?peintureId=" .$data['ID'] ."&peintureImg=" .$data['IMG'] ."' method='post'>
          <div class='confirm-overlay'>
            <p></p>
            <input type='button' name='peintureCancel' value='Annuler'>
            <input type='submit' name='peintureDel' value='Confirmer'>
          </div>
        </form>
      </li>";
    }
    echo "</ul>";
    $reponse->closeCursor();

    ?>
    <div id="blur-background"></div>

    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="main.js"></script>
    <script src="preview.js"></script>
  </body>
</html>
