<?php

///////////////// EDITABLE OPTIONS   /////////////////////


$receiving_email_address = "sreejith@vibgyorworld.net";  // Set your email address here which you want to receive emails to

$receiving_email_address_name = "info@vibgyorworld.net"; // Add name that is associated with your email address above.

$custom_subject = "Hello From vibgyorworld.net Contact Form"; // Change the subject line of email as per your choice.


// =============================  DO NOT EDIT BELOW THIS LINE  ======================================

if ((isset($_POST['name'])) && (strlen(trim($_POST['name'])) > 0)) {
	$name = stripslashes(strip_tags($_POST['name']));
} else {$name = 'No name entered';}

if ((isset($_POST['phone'])) && (strlen(trim($_POST['phone'])) > 0)) {
	$phone = stripslashes(strip_tags($_POST['phone']));
} else {$phone = 'No phone entered';}

if ((isset($_POST['email'])) && (strlen(trim($_POST['email'])) > 0)) {
	$email = stripslashes(strip_tags($_POST['email']));
} else {$email = 'No email entered';}

if ((isset($_POST['datetimepicker'])) && (strlen(trim($_POST['datetimepicker'])) > 0)) {
	$datetimepicker = stripslashes(strip_tags($_POST['datetimepicker']));
} else {$datetimepicker = 'No Date selected';}


if ((isset($_POST['comment'])) && (strlen(trim($_POST['comment'])) > 0)) {
	$comment = stripslashes(strip_tags($_POST['comment']));
} else {$comment = 'No comment entered';}
ob_start();


// Email Building
$to 			= $receiving_email_address;
$email 			= $_POST['email'];
$fromaddress 	= $_POST['email'];
$fromname 		= $_POST['name'];
$body = "Below are the details submitted by the user on your website.<br><br> Name: 
			 ".$_POST['name']."<br><br>Email: ".$_POST['email']."<br><br>Phone: ".$_POST['phone']."
			 <br><br>Date & Time: ".$_POST['datetimepicker']."<br><br>Comment: ".$_POST['comment']."";
			 
// Check if the security is filled
if ( $_POST['security'] == '' ) {

	require("phpmailer.php");
	$mail = new PHPMailer();
	
	$mail->From    					= "$email";
	$mail->FromName 			= "$fromname";
	$mail->AddAddress("$receiving_email_address","$receiving_email_address_name");
	
	$mail->IsHTML(true);
	
	$mail->Subject  				= "$custom_subject";
	$mail->Body     					= $body;
	$mail->AltBody 					= "This is the text-only body";
	
	if(!$mail->Send()) {
		$recipient 					= '$receiving_email_address';
		$subject 						= 'Contact form failed';
		$content						= $body;	
		
	  // Send Mail
	  mail($recipient, $subject, $content, "From: $receiving_email_address\r\nReply-To: $email\r\nX-Mailer: DT_formmail");
	  exit;
	}
}
?>
