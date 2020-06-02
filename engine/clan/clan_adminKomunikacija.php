<?php
	if(!isset($_GET['akcija']) || !isset($_GET['data']) || empty($_GET['data'])|| empty($_GET['akcija'])) header("Location: index.php");
	$akcija = $_GET['akcija']; $data = $_GET['data'];
	require("../init.php");
	ukljuci_bazu(); $db = new BazaPodataka();

	switch ($akcija) {
		case 'izbrisi': $db->e("DELETE FROM clan " . $data);  echo "Korisnici su izbrisani!"; break;
		case 'addBan': $db->e("UPDATE clan SET status='ban' " . $data);  echo "Korisnici su banovani!"; break;
		case 'dellBan': $db->e("UPDATE clan SET status='da' " . $data);  echo "KKorisnici nisu vise banovani!"; break;
		case 'addAdmin': $db->e("UPDATE clan SET admin_level='ad' " . $data);  echo "Korisnici su postali admini!"; break;
		case 'dellAdmin': $db->e("UPDATE clan SET admin_level='ko' " . $data);  echo "Korisnici nisu vise admini!"; break;
		
		default: echo "Greska"; break;
	}

?>