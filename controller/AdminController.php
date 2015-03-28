<?php
require_once WWW_ROOT . 'controller' . DS . 'AppController.php';

class AdminController extends AppController {

	public function __construct()
	{
		require_once WWW_ROOT . 'dao' . DS . 'BandsDAO.php';
		$this -> bandsDAO = new BandsDAO();

		require_once WWW_ROOT . 'dao' . DS . 'InvitesDAO.php';
		$this -> invitesDAO = new InvitesDAO();
	}

	public function adminPanel () {

		if($this -> checkIsAdmin() == false){
			$this -> addError('loginReq', "Please log in as admin");
			$this -> redirect('index.php?p=login');
		}

		/* ---- Action: Send Invite -------------------------------------------------- */

		if(!empty($_GET['action']) && $_GET['action'] == "sendInvite"){

			if(empty($_POST['email'])){
				$this -> addError('email', "Cannot mail invite code without band email");
			}elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
				$this -> addError('email', "Please enter a valid email-address");
			}

			if($this -> checkErrors() == false){
				$uniqid = uniqid();
				$this -> invitesDAO -> insertInvite($uniqid);

				$to = $_POST['email'];
				$from = "admin@bandbattle.komenspelen.be";
				$subject = "Uw registratie bij BandBattle";

				$headers = "MIME-Version: 1.0\r\n";
				$date = date('D, d\t\h M Y h:i:s O');
				$headers .= "Date: {$date}\r\n";
				$headers .= "From: {$from}\r\n";
				$headers .= "Reply-To: {$from}\r\n";
				$headers .= "Subject: {$subject}\r\n";
				$headers .= "X-Sender: {$from}\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

				$message = "<html>\r\n";
				$message .= "<body>\r\n";
				$message .= "	<h2>Welkom! Jij en je band zijn uitgenodigd voor de 'Komen Spelen' Bandbattle:</h2>";
				$message .= "	<p>-------------------------------</p>";
				$message .= "	<h1>Klik op onderstaande link om de registratie van jouw band te voltooien:</h1>";
				$message .= "	<p><a href=\"http://student.howest.be/thorr.stevens/20142015/MAIV/KOMEN/?p=login&amp;invite={$uniqid}\" target=\"_blank\">http://student.howest.be/thorr.stevens/20142015/MAIV/KOMEN/?p=login&amp;invite={$uniqid}</a></p>\r\n";
				$message .= "</body>\r\n";
				$message .= "</html>\r\n";

				mail($to, $subject, $message, $headers);
			}

		}

		/* ---- Action: Change Date -------------------------------------------------- */

		// code

	}

}
