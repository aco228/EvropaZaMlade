<?php
	if(!isset($_POST['akcija']) || empty($_POST['akcija']) || !isset($_POST['user']) || empty($_POST['user'])) header("Location: index.php");
	$akcija = $_POST['akcija']; $user = $_POST['user'];
	require("../init.php");
	ukljuci_bazu(); $db = new BazaPodataka();

	//
	//	SLANJE VEF FORME
	//
	if($akcija=="posaljiListu"){
		// 
		//	PRIKUPLJANJE POTREBNIH INFORMACIJA
		//
		// Preuzimanje informacija o korisniku
		$db->q("SELECT COUNT(*) AS br, ime, prezime, danRodjenja, mjesecRodjenja, godinaRodjenja, pol, mjestoStanovanja, status, admin_level, 
									   zanimanje, zdrastvene_napomene, jezik, nacionalnost, broj_pasosa, pasos_kadaIzdat, pasos_doKadTraje, 
									   ime_roditelja, predhodno_iskustvo, zbog_cega, kontakt_telefon, preuzmi_drugiKamp, email
						FROM clan WHERE username='".$user."';");
		if($user != $_SESSION['user'] || $db->db_F['br']!=1) { echo "Greška! Korisnik ne postoji ili nije prijavljen!"; die(); }

		$ime = $db->db_F['ime'];
		$prezime = $db->db_F['prezime'];
		$rDan = $db->db_F['danRodjenja'];
		$rMj = getMjesec_English($db->db_F['mjesecRodjenja']);
		$rGod = $db->db_F['godinaRodjenja'];
		$pol = getSexInfo($db->db_F['pol']);
		$mjesto = $db->db_F['mjestoStanovanja'];
		$zanimanje = $db->db_F['zanimanje'];
		$zdrastvene_napomene = $db->db_F['zdrastvene_napomene'];
		$jezik = $db->db_F['jezik'];
		$nacionalnost = $db->db_F['nacionalnost'];
		$broj_pasosa = $db->db_F['broj_pasosa'];
		$pasos_kadaIzdat = $db->db_F['pasos_kadaIzdat'];
		$pasos_doKadTraje = $db->db_F['pasos_doKadTraje'];
		$ime_roditelja = $db->db_F['ime_roditelja'];
		$predhodno_iskustvo = $db->db_F['predhodno_iskustvo'];
		$zbog_cega = $db->db_F['zbog_cega'];
		$kontakt_telefon = $db->db_F['kontakt_telefon'];
		$preuzmi_drugiKamp = $db->db_F['preuzmi_drugiKamp'];
		$email_adresa = $db->db_F['email'];

		// Preuzimanje liste kampova
		$db->q("SELECT COUNT(*) AS br FROM kamp_lista WHERE clan_lista='".$user."';"); 
		if($db->db_F['br'] <= 0) { echo "Greška! Korisnik nema listu kampova!"; die(); }
		$lista_kampova = $db->qMul("SELECT id_kampa, ime_kampa, kod_kampa, pocetakDan, pocetakMjesec, pocetakGodina, krajDan, krajMjesec, krajGodina
								FROM kamp_lista WHERE clan_lista='".$user."';");

		// Preuzimanje maila za slanje
		$db->q("SELECT email FROM admin_info WHERE idai=1;"); $email_slanje = $db->db_F['email'];

		//
		//	Priprema teksta za mail
		//
		$tekst = "VOLUNTEER EXCHANGE FORM for - " . $ime . " " . $prezime . " (User: " . $user . ")\r\n\r\n" .
				"Name and surname: " . strtoupper($ime . " " . $prezime) . "\r\n" .
				"Occupation: " . strtoupper($zanimanje) . "\r\n" .
				"Present address: " . strtoupper($mjesto) . "\r\n" .
				"Telephone number: " . strtoupper($kontakt_telefon) . "\r\n" .
				"Email: " . $email_adresa . "\r\n\r\n" .

				"Remarks on health/special diet: " . strtoupper($zdrastvene_napomene) . "\r\n" .
				"Languages spoken: " . strtoupper($jezik) . "\r\n" .
				"Birth date: " . $rDan . ' ' . $rMj . ' ' . $rGod . "\r\n" .
				"Nationality: " . strtoupper($nacionalnost) . "\r\n" .
				"Sex: " . strtoupper($pol) . "\r\n" .
				"Passport number: " . strtoupper($broj_pasosa) . "\r\n" .
				"Issued when and by: " . strtoupper($pasos_kadaIzdat) . "\r\n" .
				"Valid until: " . strtoupper($pasos_doKadTraje) . "\r\n" .
				"Parents’ name: " . strtoupper($ime_roditelja) . "\r\n" .
				"Past volunteer experiences/general skills: " . strtoupper($predhodno_iskustvo) . "\r\n\r\n" .
				
				"CAMPS:\n".
				"(Camp code / Camp name / Start date - End date) (DD.MM.YYYY):\r\n".
				getKampInfo($lista_kampova) .
				
				"\r\n" .

				"Book another camp for me if all above are full: " . strtoupper($preuzmi_drugiKamp) . "\r\n" .
				"Why do you wish to take part in a volunteer project?: " . $zbog_cega;

		// Brisanje kampova iz liste
		$db->e("DELETE FROM kamp_lista WHERE clan_lista='".$user."';");

		// Slanje emaila
		__setMail(); $Mail = new MailSender();
		$Mail->sendMail($email_slanje, "VEF FORM - " . $ime . " " . $prezime, $tekst);

		echo "Lista kampova je uspješno poslata!";
	}

	function getKampInfo($kampovi){
		$back = ""; $br = 1;
		while($k = mysql_fetch_array($kampovi)){
			$kod = $k['kod_kampa'];
			$ime = $k['ime_kampa'];
			$pD = $k['pocetakDan']; $pM = $k['pocetakMjesec']; $pG = $k['pocetakGodina'];
			$kD = $k['krajDan']; $kM = $k['krajMjesec']; $kG = $k['krajGodina'];
			$back .= "Camp ".$br.": ".$kod." / ".$ime." / ".$pD.".".$pM.".".$pG." - ".$kD.".".$kM.".".$kG." \r\n";
			$br++;
		}
		return $back;
	}
	function getSexInfo($sex){
		if($sex=="m") return "Male";
		else return "Female";
	}

	function getMjesec_English($br){
		$back = $br;
		switch($br){
			case 1 : $back = "January"; break; 
			case 2 : $back = "February"; break; 
			case 3 : $back = "March"; break; 
			case 4 : $back = "April"; break; 
			case 5 : $back = "May"; break; 
			case 6 : $back = "June"; break; 
			case 7 : $back = "July"; break; 
			case 8 : $back = "August"; break; 
			case 9 : $back = "September"; break; 
			case 10: $back = "October"; break;
			case 11: $back = "November"; break; 
			case 12: $back = "December"; break; 
		}
		return $back;
	}
?>