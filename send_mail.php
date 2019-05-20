<?php
	$mail_to = '******'; // specify your email here

	// Assigning data from $_POST array to variables
	$name = $_POST['navn'];
	$mail_from = $_POST['email'];
	$phone = $_POST['telefon'];
	$message = $_POST['melding'];
	
	// Construct subject of the email
	$subject = 'Forespørsel fra tønsbergbueskyttere.no. ' . $name;

	// Construct email body
	$body_message = 'Fra: ' . $name . "\r\n";
	$body_message .= 'Telefon: ' . $phone . "\r\n" . "\r\n";
	$body_message .= $message;

	// Construct headers of the message
	$headers = 'From: ' . $mail_from . "\r\n";
	$headers .= 'Reply-To: ' . $mail_from . "\r\n";

	$mail_sent = mail($mail_to, $subject, $body_message, $headers);

	if ($mail_sent == true){ ?>
		<script language="javascript" type="text/javascript">
		alert('Takk for at du tok kontakt med oss! vi svarer deg om ikke så alt for lenge.');
		window.location = 'kontakt_oss.php';
		</script>
	<?php } else { ?>
    <script language="javascript" type="text/javascript">
        alert('Meldingen ble ikke sendt. ta kontakt med oss på tonsberg@bueklubb.no for å si ifra om feilen!');
        window.location = 'kontakt_oss.php';
    </script>
	<?php
	}
?>