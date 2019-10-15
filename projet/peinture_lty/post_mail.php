<?php

function sanitize_my_email($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}
$to_email = 'namerake@gmail.com';
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
    header('Location: contact.php');
}

?>