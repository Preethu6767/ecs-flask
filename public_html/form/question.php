<?php

///////////////// EDITABLE OPTIONS   /////////////////////


$receiving_email_address = "your_email_here";  // Set your email address here which you want to receive emails to

$receiving_email_address_name = "your_name_here"; // Add name that is associated with your email address above.

$custom_subject = "Hello From [Website Name] Contact Form"; // Change the subject line of email as per your choice.


// =============================  DO NOT EDIT BELOW THIS LINE  ======================================

if ((isset($_POST['qname'])) && (strlen(trim($_POST['qname'])) > 0)) {
	$qname = stripslashes(strip_tags($_POST['qname']));
} else {$qname = 'No name entered';}

if ((isset($_POST['qphone'])) && (strlen(trim($_POST['qphone'])) > 0)) {
	$qphone = stripslashes(strip_tags($_POST['qphone']));
} else {$qphone = 'No phone entered';}

if ((isset($_POST['qemail'])) && (strlen(trim($_POST['qemail'])) > 0)) {
	$qemail = stripslashes(strip_tags($_POST['qemail']));
} else {$qemail = 'No email entered';}


if ((isset($_POST['qcomment'])) && (strlen(trim($_POST['qcomment'])) > 0)) {
	$qcomment = stripslashes(strip_tags($_POST['qcomment']));
} else {$qcomment = 'No comment entered';}
ob_start();


// Email Building
$to 			= $receiving_email_address;
$qemail 			= $_POST['qemail'];
$qfromaddress 	= $_POST['qemail'];
$qfromname 		= $_POST['qname'];
$qbody = "Below are the details submitted by the user on your website.<br><br> Name: 
			 ".$_POST['qname']."<br><br>Email: ".$_POST['qemail']."<br><br>Phone: ".$_POST['qphone']."
			 <br><br>Comment: ".$_POST['qcomment']."";
			 
// Check if the security is filled
if ( $_POST['qsecurity'] == '' ) {

	require("phpmailer.php");
	$mail = new PHPMailer();
	
	$mail->From    					= "$qemail";
	$mail->FromName 			= "$qfromname";
	$mail->AddAddress("$receiving_email_address","$receiving_email_address_name");
	
	$mail->IsHTML(true);
	
	$mail->Subject  				= "$custom_subject";
	$mail->Body     					= $qbody;
	$mail->AltBody 					= "This is the text-only body";
	
	if(!$mail->Send()) {
		$recipient 					= '$receiving_email_address';
		$subject 						= 'Contact form failed';
		$content						= $qbody;	
		
	  // Send Mail
	  mail($recipient, $subject, $content, "From: $receiving_email_address\r\nReply-To: $email\r\nX-Mailer: DT_formmail");
	  exit;
	}
}
?>
