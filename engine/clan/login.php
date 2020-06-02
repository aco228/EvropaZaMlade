<?php
	// PROVJERA UNOSA
	if(!isset($_GET['user']) || !isset($_GET['pass']) || empty($_GET['user']) || empty($_GET['pass'])) { exit(); }
	$user = $_GET['user'];
	$pass = $_GET['pass'];

	require("../init.php");
	if($user=="err"){
		switch($pass){
			case "noKIme": echo $_jezik['login_greska_nemaImena']; break;
			case "noPass": echo $_jezik['login_greska_nemaSifre']; break;
			case "noZnak": echo $_jezik['login_greska_znak']; break;
		}
		exit();
	} 

	ukljuci_bazu();	
	$db = new BazaPodataka("SELECT COUNT(*) AS br, username, sifra, status, admin_level FROM clan WHERE username='" . $user . "';");
	$user = strtolower(mysql_real_escape_string($user));
	$pass = mysql_real_escape_string($pass);

	if($db->db_F['br'] != 1){
		echo $_jezik['login_greska_korisnikNePostoji']; exit();
	} else if($db->db_F['sifra']  != $pass){
		echo $_jezik['login_greska_korisnikSifra']; exit();
	} else if($db->db_F['status'] == 'ne'){
		echo $_jezik['login_greska_statusNE']; exit();
	} else if($db->db_F['status'] == 'ban'){
		echo $_jezik['login_greska_statusBAN']; exit();
	} else {
		$_SESSION['user'] = $db->db_F['username'];
		if($db->db_F['admin_level'] == "ad") $_SESSION['ad'] = "ok";
		else $_SESSION['ad'] = "ko";
		//echo "ok";
		exit();
	}

?>