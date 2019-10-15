<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/master.css">
		<link rel="stylesheet" href="assets/css/clb.css">
    <style media="screen">
      .header-title {
        background-color: #293542;
        color: white;
        font-size: 20px;
        text-align: center;
        padding: 40px 0;
        margin: auto;
      }

      .biographie-el {
        margin-top: 50px;
        margin-bottom: 150px;
        display: flex;
        flex-direction: row;
        justify-content: center;
      }
      .biographie-image {
        width: 430px;
        height: 430px;
        margin-right: 50px;
      }
      .biographie-image > img {
      	max-width: 100%;
      	max-height: 100%;
      }
      .biographie-info {
        width: 570px;
        font-size: 22px;
      }
      .biographie-button {
        margin: auto;
        border: 1px solid black;
        width: 250px;
        text-align: center;
        padding: 15px 0;
      }
      .biographie-button a {
        font-size: 16px;
        text-decoration: none;
        color: black;
      }

    </style>
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
    <div class="header-title">
      <h1>BIOGRAPHIE</h1>
    </div>

    <div class="main">
      <div class="biographie-el">
        <div class="biographie-image">
           <img src="assets/img/biographie2.jpg" alt="">
        </div>
        <div class="biographie-info">
          <p>LIAUTY Lty. vit depuis son enfance sur le bassin d'Arcachon. L'exceptionnelle beauté de sa région natale a été pour elle une source d'inspiration inépuisable pour cette artiste peintre. Sa rencontre avec un photographe reporter du National Geographic, lors du festival Visa pour l'image, a bouleversé son regard sur son environnement immédiat. Depuis, elle n'a de cesse de mêler son art à un engagement citoyen.</p>
          <p>Du bassin d'Arcachon à la barrière de corail australienne, LIAUTY Lty. imagine un monde où la main de l'homme peut être aussi prédatrice que généreuse...</p>
          <div class="biographie-button">
            <a href="boutique.php">VOIR LES OEUVRES</a>
          </div>
        </div>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
