<?php
	require("../init.php");
	ukljuci_bazu(); $db = new BazaPodataka();
	$akcija = mysql_real_escape_string($_POST['akcija']); $id = mysql_real_escape_string($_POST['id']); 

	switch ($akcija) {
		case 'dell': 
			$db->e("DELETE FROM kamp WHERE intk='".$id."';");   
			$db->e("DELETE FROM kamp_lista WHERE id_kampa='".$id."';");  echo "Kamp je izbrisan!"; 
			break;
		case 'save': 
			$db->e("UPDATE kamp SET ". getData() ." WHERE intk='".$id."';"); echo "Promjene su sačuvane";
			break;
		case 'addLista': 
			$db->q("SELECT COUNT(*) AS br FROM kamp_lista WHERE id_kampa='". $_POST['id_kampa'] ."' AND clan_lista='". $_POST['clan_lista'] ."';");
			if($db->db_F['br'] != 0) { echo "Ovaj kamp se već nalazi na vašoj listi!"; die(); }
			$db->e("INSERT INTO kamp_lista (clan_lista, id_kampa, ime_kampa, kod_kampa, zemlja_kampa, pocetakDan, pocetakMjesec, pocetakGodina,krajDan,krajMjesec,krajGodina) 
					VALUES (".getDataList().");");  
			echo "Uspješno ste dodali kamp u vašu listu!"; 
			break;
		case 'dellLista': $db->e("DELETE FROM kamp_lista WHERE id_kampa='".$_POST['id_kampa']."' AND clan_lista='".$_POST['clan']."' ;"); echo "Uspješno ste izbrisali kamp iz vaše liste!"; break;
		default: echo "Greska"; break;
	}

	function getData(){
		$back = "";
			if(isset($_POST['ime_kampa']) && !empty($_POST['ime_kampa'])) 		$back.= "ime_kampa='".mysql_real_escape_string($_POST['ime_kampa'])."', ";
			if(isset($_POST['kod_kampa']) && !empty($_POST['kod_kampa'])) 		$back.= "kod_kampa='".mysql_real_escape_string($_POST['kod_kampa'])."', ";
			if(isset($_POST['organizacija']) && !empty($_POST['organizacija'])) 	$back.= "organizacija='".mysql_real_escape_string($_POST['organizacija'])."', ";

			if(isset($_POST['lokacija_kampa']) && !empty($_POST['lokacija_kampa'])) $back.= "lokacija_kampa='".mysql_real_escape_string($_POST['lokacija_kampa'])."', ";
			if(isset($_POST['regija_kampa']) && !empty($_POST['regija_kampa'])) 	$back.= "regija_kampa='".mysql_real_escape_string($_POST['regija_kampa'])."', ";
			if(isset($_POST['jezik_kampa']) && !empty($_POST['jezik_kampa'])) 	$back.= "jezik_kampa='".mysql_real_escape_string($_POST['jezik_kampa'])."', ";

			if(isset($_POST['ukupanBrojVolontera']) && !empty($_POST['ukupanBrojVolontera'])) $back.= "ukupanBrojVolontera='".mysql_real_escape_string($_POST['ukupanBrojVolontera'])."', ";
			if(isset($_POST['dodatniTroskovi']) && !empty($_POST['dodatniTroskovi']))	 $back.= "dodatniTroskovi='".mysql_real_escape_string($_POST['dodatniTroskovi'])."', ";
			if(isset($_POST['minimumGodina']) && !empty($_POST['minimumGodina'])) 		 $back.= "minimumGodina='".mysql_real_escape_string($_POST['minimumGodina'])."', ";
			if(isset($_POST['maksimumGodina']) && !empty($_POST['maksimumGodina']))      $back.= "maksimumGodina='".mysql_real_escape_string($_POST['maksimumGodina'])."', ";

			if(isset($_POST['opis_kampa']) && !empty($_POST['opis_kampa'])) 	$back.= "opis_kampa='".mysql_real_escape_string($_POST['opis_kampa'])."', ";
			if(isset($_POST['opis_posla']) && !empty($_POST['opis_posla'])) 	$back.= "opis_posla='".mysql_real_escape_string($_POST['opis_posla'])."', ";
			if(isset($_POST['opis_lokacije']) && !empty($_POST['opis_lokacije']))	$back.= "opis_lokacije='".mysql_real_escape_string($_POST['opis_lokacije'])."', ";
			if(isset($_POST['opis_potreba']) && !empty($_POST['opis_potreba'])) 	$back.= "opis_potreba='".mysql_real_escape_string($_POST['opis_potreba'])."', ";
			if(isset($_POST['dodatne_info']) && !empty($_POST['dodatne_info'])) 	$back.= "dodatne_info='".mysql_real_escape_string($_POST['dodatne_info'])."'";
		return $back;
	}
	function getDataList(){
		$back = "";
			$back .= "'" . mysql_real_escape_string($_POST['clan_lista']) . "',";
			$back .= mysql_real_escape_string($_POST['id_kampa']) . ",";
			$back .= "'" . mysql_real_escape_string($_POST['ime_kampa']) . "',";
			$back .= "'" . mysql_real_escape_string($_POST['kod_kampa']) . "',";
			$back .= "'" . mysql_real_escape_string($_POST['zemlja']) . "',";
			$back .= mysql_real_escape_string($_POST['pocetakDan']) . ",";
			$back .= mysql_real_escape_string($_POST['pocetakMjesec']) . ",";
			$back .= mysql_real_escape_string($_POST['pocetakGodina']) . ",";
			$back .= mysql_real_escape_string($_POST['krajDan']) . ",";
			$back .= mysql_real_escape_string($_POST['krajMjesec']) . ",";
			$back .= mysql_real_escape_string($_POST['krajGodina']);
		return $back;
	}
?>