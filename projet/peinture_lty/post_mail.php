<?php

function sanitize_my_email($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

if(
		(isset($_REQUEST['mail']) && !empty($_REQUEST['mail']) && mb_strlen($_REQUEST['mail']) < 3) 
		|| (isset($_REQUEST['num_tel']) && !empty($_REQUEST['num_tel']) && mb_strlen($_REQUEST['num_tel']) < 8)
		|| (mb_strlen($_REQUEST['nom']) < 3)
		|| (mb_strlen($_REQUEST['message']) < 3)
	) 
{
	error_log('html security & captcha bypassed while sending email : BOT');
	header('Location: contact.php'); exit();
}
else {
	$to_email = 'lty.atelier@gmail.com';
	$subject = 'Commentaire sur le site par :' .$_REQUEST['nom'];
	$message = ''
		.	'Mail : ' .(isset($_REQUEST['mail']) ? $_REQUEST['mail'] : '') ."\n"
		.	'Tel : ' .(isset($_REQUEST['num_tel']) ? $_REQUEST['num_tel'] : '') ."\n\n"
		.	$_REQUEST['message']
		.'';
	$headers = 'From: contact@lty.fr';
	//check if the email address is invalid $secure_check
	$secure_check = sanitize_my_email($to_email);
	if ($secure_check == false) {
	    echo "Invalid input";
	} else { //send email 
	    mail($to_email, $subject, $message, $headers);
	    header('Location: contact.php'); exit();
	}
}

?>