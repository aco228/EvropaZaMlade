<?php
	session_start();
	$__bazaUkljucena = false;
	error_reporting(0);
	//error_reporting(E_ALL);

	include("jezici/jezici_init.php");

	// PROVJERA LOGOVANJA
	$__korisnik = $_jezik['login_naslov']; $__login_link = "#";
	if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
		$__korisnik = $_SESSION['user']; $__login_link = "clan.php?user=".$__korisnik; 
	}

	function ukljuci_bazu() { 
		require ("baza/connect.php"); 
		global $__bazaUkljucena; $__bazaUkljucena = true;
	}

	function getMjesec($br){
		include("jezici/jezici_init.php");
		$back = "";
		switch($br){
			case 1: $back = $_jezik['mjesec_januar']; break;
			case 2: $back = $_jezik['mjesec_februar']; break;
			case 3: $back = $_jezik['mjesec_mart']; break;
			case 4: $back = $_jezik['mjesec_april']; break;
			case 5: $back = $_jezik['mjesec_maj']; break;
			case 6: $back = $_jezik['mjesec_jun']; break;
			case 7: $back = $_jezik['mjesec_jul']; break;
			case 8: $back = $_jezik['mjesec_avgust']; break;
			case 9: $back = $_jezik['mjesec_septembar']; break;
			case 10: $back = $_jezik['mjesec_oktobar']; break;
			case 11: $back = $_jezik['mjesec_novembar']; break;
			case 12: $back = $_jezik['mjesec_decembar']; break;
		}
		return $back;
	}
	function getPol($p){
		include("jezici/jezici_init.php");
		$back = "";
		switch($p){
			case 'm': $back = $_jezik['registracija_polKorsnik_muski']; break;
			case 'z': $back = $_jezik['registracija_polKorsnik_zenski']; break;
			case 'd': $back = $_jezik['registracija_polKorsnik_drugo']; break;
		}
		return $back;
	}
	function getTipKampa($p){ include("jezici/jezici_init.php"); return $_jezik['kamp_tip_'.$p]; }
	function getTipKampa_multi($p){
		include("jezici/jezici_init.php");
		$back = "";

		$p = str_replace(' ', '', $p);
		$p = explode(',', $p);
		for($i=0;$i<sizeof($p);$i++){
			if(empty($p[$i])) break;
			$back .= "( " . $p[$i] ." ) " . $_jezik['kamp_tip_'.$p[$i]];
			$back.=',  ';
		}

		return $back;
	}

	function getProjektMenu(){
		global $__bazaUkljucena;
		if(!$__bazaUkljucena){ ukljuci_bazu(); $db = new BazaPodataka(); }
		else global $db;

		$naslovi = $db->q("SELECT prvi_naslov, drugi_naslov, treci_naslov FROM indeks_admin;");
		$l1 = $db->qMul("SELECT naslov, link FROM indeks_menu WHERE pripadnost=1;");
		$l2 = $db->qMul("SELECT naslov, link FROM indeks_menu WHERE pripadnost=2;");
		$l3 = $db->qMul("SELECT naslov, link FROM indeks_menu WHERE pripadnost=3;");

		$linkovi1 = array(); $linkovi2 = array(); $linkovi3 = array(); 
		while($l = mysql_fetch_array($l1, MYSQL_ASSOC)) { $row = array('naslov'=>$l['naslov'], 'link'=>$l['link']); $linkovi1[] = $row; }
		while($l = mysql_fetch_array($l2, MYSQL_ASSOC)) { $row = array('naslov'=>$l['naslov'], 'link'=>$l['link']); $linkovi2[] = $row; }
		while($l = mysql_fetch_array($l3, MYSQL_ASSOC)) { $row = array('naslov'=>$l['naslov'], 'link'=>$l['link']); $linkovi3[] = $row; }

		echo "<tr>
                <td>". $naslovi['prvi_naslov'] ."</td>
                <td>". $naslovi['drugi_naslov'] ."</td>
                <td>". $naslovi['treci_naslov'] ."</td>
             </tr>";
        $br_ponavljanja = sizeof($linkovi1);
        if(sizeof($linkovi2) > $br_ponavljanja) $br_ponavljanja = sizeof($linkovi2);
        if(sizeof($linkovi3) > $br_ponavljanja) $br_ponavljanja = sizeof($linkovi3);

        for($i = 0; $i < $br_ponavljanja; $i++){
        	$td1 = ""; $td2 = ""; $td3 = "";
        	if(isset($linkovi1[$i])) $td1 = "<a href=\"" . $linkovi1[$i]['link'] . "\">" . $linkovi1[$i]['naslov'] . "</a>";
        	if(isset($linkovi2[$i])) $td2 = "<a href=\"" . $linkovi2[$i]['link'] . "\">" . $linkovi2[$i]['naslov'] . "</a>";
        	if(isset($linkovi3[$i])) $td3 = "<a href=\"" . $linkovi3[$i]['link'] . "\">" . $linkovi3[$i]['naslov'] . "</a>";
			echo "<tr>
                	<td>". $td1 ."</td>
                	<td>". $td2 ."</td>
                	<td>". $td3 ."</td>
            	 </tr>";
        }
	}

	function getPretragaNaslov($i){
		include("jezici/jezici_init.php");
		switch($i){
			case "clan": return $_jezik['clan_naslov']; break;
			case "novost": return $_jezik['novost_naslov']; break;
			case "kamp": return $_jezik['kamp_imeKampa']; break;
		}
	}

	/*
		JEZICI
	*/
	function getSveJezike(){
		$jezici = glob("engine/jezici/jezici_php/*.php");
		//echo sizeof($jezici);
		for($i = 0; $i < sizeof($jezici); $i++){
			$kurac = explode('.', $jezici[$i]); $_jezik = $kurac[1];
			$_jezik_native = getNazivJezika($_jezik);
			if($_jezik_native=="") continue;
			echo "<tr><td><img src=\"slike/zastave/".$_jezik.".png\" height=\"15\"/></td></td><td><a href=\"#\" id=\"".$_jezik."\" class=\"__header_mijenjanjeJezika\">".$_jezik_native."</a></td></tr>";
		}
	}
	function getNazivJezika($jezik){
		switch($jezik){
			case "Albania"; return "Shqip"; break;
			case "Bulgaria"; return "Български"; break;
			case "Croatia"; return "Hrvatski"; break;
			case "Bosnia and Hercegoina"; return "Bosanski"; break;
			case "Montenegro"; return "Srpski"; break;
			case "Serbia"; return "Српски"; break;
			case "France"; return "Français"; break;
			case "Deutschland"; return "Deutsch"; break;
			case "Greece"; return "Ελληνικά"; break;
			case "Italy"; return "Italiano"; break;
			case "Macedonia"; return "Македонски"; break;
			case "Spain"; return "Español"; break;	
			case "United Kingdom": return "English"; break;		
		}
	}

	function __setMail(){ require("PhpMailer/MailSender.php"); }
?>