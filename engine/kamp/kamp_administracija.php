<?php
	if(!isset($_GET['akcija']) || !isset($_GET['data']) || empty($_GET['data'])|| empty($_GET['akcija'])) header("Location: index.php");
	$akcija = $_GET['akcija']; $data = $_GET['data'];
	require("../init.php");
	ukljuci_bazu(); $db = new BazaPodataka();

	switch ($akcija) {
		case 'izbrisi': 
		$db->e("DELETE FROM kamp WHERE intk " . $data);  
		$db->e("DELETE FROM kamp_lista WHERE id_kampa " . $data);  
		echo "Kampovi su izbrisani!"; 
		break;
		case 'dellNeaktivni': 		
			$danasnjiDan = date('j'); $danasnjiMjesec = date('n'); $danasnjaGodina = date('Y');
			$rez1 = $db->qMul("SELECT intk FROM kamp WHERE krajDan<" . $danasnjiDan . " AND krajMjesec=" . $danasnjiMjesec ." AND krajGodina=". $danasnjaGodina.";");
			$rez2 = $db->qMul("SELECT intk FROM kamp WHERE krajMjesec<" . $danasnjiMjesec ." AND krajGodina=". $danasnjaGodina.";");
			$rez3 = $db->qMul("SELECT intk FROM kamp WHERE krajGodina<". $danasnjaGodina.";");

			while($r1 = mysql_fetch_array($rez1, MYSQL_ASSOC)){
				$db->e("DELETE FROM kamp WHERE intk='" . $r1['intk'] . "';");
				$db->e("DELETE FROM kamp_lista WHERE id_kampa='" . $r1['intk'] . "';");
			}
			while($r2 = mysql_fetch_array($rez2, MYSQL_ASSOC)){
				$db->e("DELETE FROM kamp WHERE intk='" . $r2['intk'] . "';");
				$db->e("DELETE FROM kamp_lista WHERE id_kampa='" . $r2['intk'] . "';");
			}
			while($r3 = mysql_fetch_array($rez3, MYSQL_ASSOC)){
				$db->e("DELETE FROM kamp WHERE intk='" . $r3['intk'] . "';");
				$db->e("DELETE FROM kamp_lista WHERE id_kampa='" . $r3['intk'] . "';");
			}
			echo "Neaktivni kampovi obrisani";
			break;
		
		default: echo "Greska"; break;
	}

?>