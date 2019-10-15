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

      .link-peintures {
        margin-top: 60px;
        text-align: center;
        display: flex;
        flex-direction: row;
        justify-content: center;
      }
      .link-peintures > a:first-child {
        margin-right: 30px;
      }
      .link-peintures > a {
        text-decoration: none;
      }

      .link-peintures div {
        height: 490px;
        width: 560px;
        display: flex;
        align-items: center;
      }
      .link-peintures > a:first-child > div {
      	background-image : url(http://liauty-lty.com/assets/img/CHANGEONS-CHOSES-BANNIERE.png);
      }
      .link-peintures > a:last-child > div {
      	background-image : url(http://liauty-lty.com/assets/img/COULEURS-LUMIERES-BANNIERE.png) ;
      }

      .link-peintures div > p {
        color: white;
        font-size: 43px;
        padding: 0 120px;
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
      <h1>BOUTIQUE</h1>
    </div>

    <div class="main">
      <div class="link-peintures">
        <a href="changeons-les-choses.php">
          <div>
            <p>CHANGEONS LES CHOSES</p>
          </div>
        </a>
        <a href="couleurs-et-lumieres-du-bassin.php">
          <div>
            <p>COULEURS ET LUMIERES DU BASSIN</p>
          </div>
        </a>
      </div>
    </div>
    <?php include 'footer.php';?>
  </body>
</html>
