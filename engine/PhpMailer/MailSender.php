<?php
	class MailSender{
		
		private $mail;

		public function __construct(){
			require("class.phpmailer.php");
			$this->mail = new PHPMailer(); 
			$this->mail->IsSMTP(); 
			$this->mail->SMTPDebug = false; // debugging: 1 = errors and messages, 2 = messages only
			$this->mail->SMTPAuth = true; 
			$this->mail->SMTPSecure = 'ssl'; // mora za Gmail
			$this->mail->Host = "smtp.gmail.com";
			$this->mail->Port = 465; // ili 587
			//$this->mail->IsHTML(true);
			$this->mail->Username = "iqsproduction@gmail.com";
			$this->mail->Password = "aco2284ever";
			$this->mail->SetFrom("neOdgovarajteNaOvajMail@nikako.com", "Evropa za mlade");
		}
		public function __destruct(){}

		public function sendMail($email, $subject, $tekst){
			$this->mail->AddAddress($email);
			$this->mail->Body = $tekst;
			$this->mail->Subject = $subject;
			$this->mail->Send();
			$this->mail->ClearAddresses();
		}
	}

?>