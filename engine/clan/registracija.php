<?php
	if(!isset($_GET['akcija']) || empty($_GET['akcija']) )  exit();
	$acc = $_GET['akcija'];

	require("../init.php");
	ukljuci_bazu(); $db = new BazaPodataka();

	if($acc == "proUser" && isset($_GET['unos']) && !empty($_GET['unos'])){
		$user = strtolower(mysql_real_escape_string($_GET['unos']));
		if(postojiUser($user)) echo $_jezik['registracija_greske_username_postojiUser']; else echo ""; 
		exit();
	} 

	if($acc == "proEmail" && isset($_GET['unos']) && !empty($_GET['unos'])){
		$email = strtolower(mysql_real_escape_string($_GET['unos']));
		if(postojiMail($email)) echo $_jezik['registracija_greske_email_postojiEmail']; else echo ""; 
		exit();
	}

	if($acc == "put"){

		$user = strtolower(mysql_real_escape_string($_GET['user']));
		if(postojiUser($user)) { echo $_jezik['registracija_greske_username_postojiUser']; exit(); }

		$pass = mysql_real_escape_string($_GET['pas']);
		$email = strtolower(mysql_real_escape_string($_GET['email']));
		if(postojiMail($email)) { echo $_jezik['registracija_greske_email_postojiEmail']; exit(); }

		$ime = mysql_real_escape_string($_GET['ime']);
		$prezime = mysql_real_escape_string($_GET['prez']);
		$rodjDan = mysql_real_escape_string($_GET['rdan']);
		$rodjMje = mysql_real_escape_string($_GET['rmje']);
		$rodjGod = mysql_real_escape_string($_GET['rgod']);
		$pol = mysql_real_escape_string($_GET['pol']);
		$mjesto = mysql_real_escape_string($_GET['mjesto']);
		$jedinstvenaSifra = md5($email + microtime());
		/* VEF */
		$zanimanje = mysql_real_escape_string($_GET['zanimanje']);
		$zdrastvene_napomene = mysql_real_escape_string($_GET['zdrastvene_napomene']);
		$jezik = mysql_real_escape_string($_GET['jezik']);
		$nacionalnost = mysql_real_escape_string($_GET['nacionalnost']);
		$broj_pasosa = mysql_real_escape_string($_GET['broj_pasosa']);
		$pasos_kadaIzdat = mysql_real_escape_string($_GET['pasos_kadaIzdat']);
		$pasos_doKadTraje = mysql_real_escape_string($_GET['pasos_doKadTraje']);
		$ime_roditelja = mysql_real_escape_string($_GET['ime_roditelja']);
		$predhodnoIskustvo = mysql_real_escape_string($_GET['predhodnoIskustvo']);
		$zbog_cega = mysql_real_escape_string($_GET['zbog_cega']);
		$opste_napomene = mysql_real_escape_string($_GET['opste_napomene']);

		// SLANJE MAILA
		$subject = "Evropa za mlade - Aktivacija korisnickog naloga: " . $user;
		$tekst = "Pozdrav ". $ime ." ". $prezime .".\n".
				"Registrovali ste se na sajtu 'Evropa za mlade'. Da bi koristili svoj nalog aktivirajte ga preko sledećeg linka: "  . 
					"http://evropazamlade.co.me/registracija.php?aktivacija=" . $jedinstvenaSifra . 
				"\n
				\n".
				"Vaši podaci za pristup nalogu su sledeći:\n".
				"Korisničko ime: ".$user ."\n".
				"Šifra: ".$pass ."\n".
				"\n
				\n".
				"________________________________________________________________________\n".
				"(Ova poruka je automatska i nemojte na nju odgovarati)\n".
				"Evropa za mlade";
		$from = "From: evropa-za-mlade";

		__setMail(); $Mail = new MailSender();
		$Mail->sendMail($email, $subject, $tekst);

		// UBACIVANJE U BAZU
		$db->e("INSERT INTO clan(username, sifra, email, ime, prezime, danRodjenja, mjesecRodjenja, godinaRodjenja, pol, mjestoStanovanja, jedinstvenaSifra,
					 zanimanje, zdrastvene_napomene, jezik, nacionalnost, broj_pasosa, pasos_kadaIzdat, pasos_doKadTraje, ime_roditelja, predhodno_iskustvo, 
					 zbog_cega, opste_napomene) VALUES(
			'". $user ."', 
			'". $pass ."', 
			'". $email ."',
			'". $ime ."', 
			'". $prezime ."', 
			". $rodjDan .", 
			". $rodjMje .", 
			". $rodjGod .", 
			'". $pol ."', 
			'". $mjesto ."', 
			'". $jedinstvenaSifra ."', 
			/* VEF */
			'". $zanimanje ."', 
			'". $zdrastvene_napomene ."', 
			'". $jezik ."', 
			'". $nacionalnost ."', 
			'". $broj_pasosa ."',
			'". $pasos_kadaIzdat ."', 
			'". $pasos_doKadTraje ."',
			'". $ime_roditelja ."', 
			'". $predhodnoIskustvo ."', 
			'". $zbog_cega ."', 
			'". $opste_napomene ."'
		);");
		
		echo "Poslali smo vam aktivacioni mail!";
	} 

	function postojiMail($email){
		global $db;
		$f = $db->q("SELECT COUNT(*) AS br FROM clan WHERE email='". $email . "';");
		if($f['br'] > 0) return true;
		return false;
	}
	function postojiUser($user){
		global $db;
		$f = $db->q("SELECT COUNT(*) AS br FROM clan WHERE username='". $user . "';");
		if($f['br'] > 0) return true;
		return false;
	}


?>