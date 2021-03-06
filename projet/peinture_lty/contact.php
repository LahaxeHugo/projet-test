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
      .main {
        text-align: center;
        margin-bottom: 150px;
      }
      .main h3 {
        font-size: 38px;
        font-weight: normal;
      }
      .main h3 + p {
        font-size: 25px;
        margin-top: 5px;
      }

      .contact-image {
        width: 1200px;
        height: 320px;
        margin: auto;
      }
      .contact-image > img {
      	max-width: 100%;
      	max-height: 100%;
      }

      .contact-form {
        width: 530px;
        margin: auto;
        font-size: 22px;
      }
      .contact-form > p:first-child {
        font-size: 38px;
      }
      .contact-form > p:nth-child(2) {
        text-align: left;
      }

      #post_mail > div:first-child {
      	display: flex;
      	flex-direction: row;
      	justify-content: space-between;
      }
      input[type="text"], input[type="tel"] {
        width: 245px;
        height: 55px;
      }
      input[type="mail"] {
        width: calc(100% - 5px);
        height: 55px;
        margin: 15px 0;
      }
      textarea {
        width: calc(100% - 5px);
        height: 200px;
      }
      input, textarea {
        font-size: 20px;
      }
      input::placeholder, textarea::placeholder {
        font-size: 20px;
        padding-left: 15px;
      }
      textarea::placeholder {
        padding-top: 10px;
      }

      .contact-form-submit {
        font-size: 16px;
        color: white;
        background-color: #2E2E2E;
        width: 250px;
        margin: auto;
        margin-top: 15px;
        padding : 3px 0;
        cursor: pointer;
      }
			
			.recaptcha-box {
				margin: 10px 0 20px 0;
			}
			.g-recaptcha > div {
				margin: auto;
			}
			.recaptcha-error {
				color: red;
				font-size: 14px;
				margin: 0;
			}
			.recaptcha-box-error {
				border: 1px solid red;
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
      <h1>ME CONTACTER</h1>
    </div>

    <div class="main">
      <h3>L'atelier 23</h3>
      <p>avenue du moulin à Andernos-les-Bains</p>

      <div class="contact-image">
        <img src="assets/img/contact.jpg" alt="">
      </div>

      <div class="contact-form">
        <p>Me contacter</p>
        <p>Une oeuvre vous intéresse ?<br>
					Remplissez ce formulaire pour me contacter par mail !</p>
        <form id="post_mail" action="post_mail.php" method="post">
        	<div>
	          <input type="text" name="nom" value="" placeholder="Nom" pattern=".{0}|.{10,}" required>
	          <input type="tel" name="num_tel" value="" placeholder="Numéro de téléphone" pattern=".{3,}" required>
	         </div>
          <input type="mail" name="mail" value="" placeholder="Adresse email" pattern=".{0}|.{5,}" required> <br>
          <textarea name="message" placeholder="Votre message..." pattern=".{3,}" required></textarea><br>
          <div class="recaptcha-box">
          	<div class="g-recaptcha" data-sitekey="6Lewv8YUAAAAANB5SoqVLGpmAzBq_bm83Zv3sD55"></div>
          	<p class="recaptcha-error">Veuillez prouver que vous n'êtes pas un robot.</p>
          </div>
          <input type="submit" id="submit-hidden" style="display: none;" value="Send">
        </form>
        <div class="contact-form-submit">
          <p>ENVOYER LE MESSAGE</p>
        </div>
      </div>
    </div>
    <?php include 'footer.php';?>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script async defer>
    	$(function() {
    		
    		$('.recaptcha-error').hide();
    		
	    	$('.contact-form-submit').on('click', function(e) {
          
	    		var captchaChecked = grecaptcha.getResponse().length;
	    		
	    		if (!$("#post_mail")[0].checkValidity()) {
				    $("#post_mail").find("#submit-hidden").click();
				    
				    if(captchaChecked == 0) {
				    	$('.recaptcha-error').show();
				    }
				  } else {
				  	if(captchaChecked != 0) {
		    			$('#post_mail').submit();
		    		} else {
		    			$('.recaptcha-error').show();
		    		}
					}
	    	});
    	});
    </script>
  </body>
</html>
