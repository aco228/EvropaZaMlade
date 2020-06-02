<?php
	require("engine/init.php");


	ukljuci_bazu(); $db = new BazaPodataka();
	$contentNaslov = "";
	$data = NULL;
	$ukupanBrojStranica = 0;
	$str = 1;

	/* 
		PRETRAGA KAMPOVA
	*/
	if(isset($_POST['submit'])){
		$zemlja = "";
		$tipKampa = "";
		$pocetak = "";
		$kraj = "";
		$kljucnaRijec = "";

		if($_POST['zemljaKampa'] != "-1"){
			$zemlj = mysql_real_escape_string($_POST['zemljaKampa']);
			$zemlja = "zemlja='". $zemlj . "'";
		} 
		if($_POST['tipKampa'] != "-1"){
			$tip = mysql_real_escape_string($_POST['tipKampa']);
			$tipKampa = "tip_kampa LIKE '%". $tip . "%' ";
			if($zemlja != "") $tipKampa  = " AND " . $tipKampa;
		}
		if(isset($_POST['pocetakDan']) && $_POST['pocetakDan']!=$_jezik['kamp_pocetakDan'] && isset($_POST['pocetakGodina']) && $_POST['pocetakGodina']!=$_jezik['kamp_pocetakGodina']){
			$Pdan = mysql_real_escape_string($_POST['pocetakDan']); $Pgodina = mysql_real_escape_string($_POST['pocetakGodina']);
			$pocetak = "pocetakDan=". $Pdan . " AND pocetakMjesec=". $_POST['pocetakMjesec'] . " AND pocetakGodina=" . $Pgodina . " ";
			if($tipKampa != "" || $zemlja != "") $pocetak = " AND " . $pocetak;
		}
		if(isset($_POST['krajDan']) && $_POST['krajDan']!=$_jezik['kamp_krajDan'] && isset($_POST['krajGodina']) && $_POST['krajGodina']!=$_jezik['kamp_krajGodina']){
			$Kdan = mysql_real_escape_string($_POST['krajDan']); $Kgodina = mysql_real_escape_string($_POST['krajGodina']);
			$kraj = "krajDan=". $Kdan . " AND krajMjesec=". $_POST['krajMjesec'] . " AND krajGodina=" . $Kgodina . " ";
			if($tipKampa != "" || $zemlja != "" || $pocetak!="") $kraj = " AND " . $kraj;
		}
		if(isset($_POST['kljucnaRijec']) && $_POST['kljucnaRijec'] != $_jezik['kamp_kljucnaRijec']){
			$klju = mysql_real_escape_string($_POST['kljucnaRijec']);
			$kljucnaRijec = "ime_kampa LIKE '%".$klju."%' OR kod_kampa LIKE '%".$klju."%' OR zemlja LIKE '%".$klju."%' OR organizacija LIKE '%".$klju."%' OR lokacija_kampa LIKE '%".$klju."%' OR regija_kampa LIKE '%".$klju."%' OR opis_kampa LIKE '%".$klju."%' OR opis_posla LIKE '%".$klju."%' OR opis_lokacije LIKE '%".$klju."%' OR opis_potreba LIKE '%".$klju."%' OR dodatne_info LIKE '%".$klju . "%' ";
			if($tipKampa != "" || $zemlja != "" || $pocetak!="" || $kraj!="") $kljucnaRijec = " AND " . $kljucnaRijec;
		}
		if($zemlja != "" || $tipKampa != "" || $pocetak != "" || $kraj != "" || $kljucnaRijec != ""){
			$db->q("SELECT COUNT(*) AS br FROM kamp WHERE ". $zemlja . $tipKampa . $pocetak . $kraj . $kljucnaRijec . ";", true);
			$ukupanBrojStranica = ceil($db->db_F['br']/25);
			if($str > $ukupanBrojStranica || $str <= 0) $data = NULL;
			$data = $db->qMul("SELECT intk, ime_kampa, kod_kampa, zemlja, lokacija_kampa, tip_kampa, pocetakDan, pocetakMjesec, pocetakGodina, krajDan, krajMjesec, krajGodina, opis_kampa FROM kamp WHERE ". $zemlja . $tipKampa . $pocetak . $kraj . $kljucnaRijec . " LIMIT ". ($str-1)*25 .", 25;", true);
		}
		$contentNaslov = $_jezik['kamp_contentRezultatiPretrage'];
	} 
	/* 
		MJENJANJE STRANICE 
	*/
	else if(isset($_GET['str']) && is_numeric($_GET['str'])){
		$str = $_GET['str'];
		$zemlja = "";
		$tipKampa = "";
		$pocetak = "";
		$kraj = "";
		$kljucnaRijec = "";

		if(isset($_GET['zemlja']) && !empty($_GET['zemlja'])){
			//$zemlj = mysql_real_escape_string($_GET['zemlja']);
			$zemlja = "zemlja=". $_GET['zemlja'] ;
		} 
		if(isset($_GET['tipKampa']) && !empty($_GET['tipKampa'])){
			//$tip = mysql_real_escape_string($_GET['tipKampa']);
			$tipKampa = "tip_kampa='". $tip . "' ";
			if($zemlja != "") $tipKampa  = " AND " . $tipKampa;
		}
		if(isset($_GET['kljucnaRijec']) && $_GET['kljucnaRijec'] != $_jezik['kamp_kljucnaRijec']){
			$klju = mysql_real_escape_string($_GET['kljucnaRijec']);
			$kljucnaRijec = "ime_kampa LIKE '%".$klju."%' OR kod_kampa LIKE '%".$klju."%' OR zemlja LIKE '%".$klju."%' OR organizacija LIKE '%".$klju."%' OR lokacija_kampa LIKE '%".$klju."%' OR regija_kampa LIKE '%".$klju."%' OR opis_kampa LIKE '%".$klju."%' OR opis_posla LIKE '%".$klju."%' OR opis_lokacije LIKE '%".$klju."%' OR opis_potreba LIKE '%".$klju."%' OR dodatne_info LIKE '%".$klju . "%' ";
			if($tipKampa != "" || $zemlja != "" || $pocetak!="" || $kraj!="") $kljucnaRijec = " AND " . $kljucnaRijec;
		}
		if($zemlja != "" || $tipKampa != "" || $pocetak != "" || $kraj != "" || $kljucnaRijec != ""){
			$db->q("SELECT COUNT(*) AS br FROM kamp WHERE ". $zemlja . $tipKampa . $pocetak . $kraj . $kljucnaRijec . ";", true);
			$ukupanBrojStranica = ceil($db->db_F['br']/25);
			if($str > $ukupanBrojStranica || $str <= 0) $data = NULL;
			$data = $db->qMul("SELECT intk, ime_kampa, kod_kampa, zemlja, lokacija_kampa, tip_kampa, pocetakDan, pocetakMjesec, pocetakGodina, krajDan, krajMjesec, krajGodina, opis_kampa FROM kamp WHERE ". $zemlja . $tipKampa . $pocetak . $kraj . $kljucnaRijec . " LIMIT ". ($str-1)*25 .", 25;", true);
			//echo "SELECT intk, ime_kampa, kod_kampa, zemlja, lokacija_kampa, tip_kampa, pocetakDan, pocetakMjesec, pocetakGodina, krajDan, krajMjesec, krajGodina, opis_kampa FROM kamp WHERE ". $zemlja . $tipKampa . $pocetak . $kraj . $kljucnaRijec . " LIMIT ". ($str-1)*25 .", 25;"; die();
		}
		$contentNaslov = $_jezik['kamp_contentRezultatiPretrage'];
	} 
	/* 
		STAMPANJE POSLEDNJIH 25 KAMPOVA 
	*/
	else {
		$contentNaslov = $_jezik['kamp_contentPoslednjih25'];
		$data = $db->qMul("SELECT intk, ime_kampa, kod_kampa, zemlja, lokacija_kampa, tip_kampa, pocetakDan, pocetakMjesec, pocetakGodina, krajDan, krajMjesec, krajGodina, opis_kampa FROM kamp ORDER BY intk DESC LIMIT 0, 25", true);
		$ukupanBrojStranica = ceil($db->Num/25);
	}

	$drzave = $db->qMul("SELECT idz, ime_zemlje FROM zemlje;");
	$tipovi_kampova = $db->qMul("SELECT oznaka FROM tip_kampa;");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title><?php echo $_jezik['kamp_pretragaKampova']; ?></title>
    <script src="js/_jQuery.js"></script>
    <script src="js/_jQueryUI.js"></script>
    <script src="js/main.js" type="text/javascript"></script>
    <script src="js/pretragaKampova.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/pretragaKampova.css"/>
</head>
<script type="text/javascript">
	var str = <?php echo $str; ?>;
	<?php 
		if(isset($zemlja)){ echo "var zemlja=\"".$zemlja."\";"; } else echo "var zemlja=\"\";";
		if(isset($tipKampa)){ echo "var tipKampa=\"".$tipKampa."\";"; } else echo "var tipKampa=\"\";";
		if(isset($klju)){ echo "var kljucnaRijec=\"kljucnaRijec=".$klju."\";"; } else echo "var kljucnaRijec=\"\";";
	?>
</script>
<body>
	<?php include('engine/sekcije/_header.php'); ?>

	<div id="_naslov_naslov"><?php echo $_jezik['kamp_pretragaKampova']; ?></div>

	<div class="novosti_sekcija">
		<div class="content">
			<div class="unos_naslov"><?php echo $_jezik['kamp_pretragaKampova']; ?>:</div>
			<form method="POST" action="">
				<select class="dropDown" name="zemljaKampa">	
					<option value="-1"><?php echo $_jezik['kamp_zemlja']; ?></option>	
					<?php
						while($tpp = mysql_fetch_array($drzave, MYSQL_ASSOC)){
							echo "<option value=\"". $tpp['ime_zemlje'] ."\">". $tpp['ime_zemlje'] ."</option>";
						}
					?>
				</select>
				<div style="clear:both"></div>

				<select class="dropDown" name="tipKampa">	
					<option value="-1"><?php echo $_jezik['kamp_tipKampa']; ?></option>
					<?php
						while($tpp = mysql_fetch_array($tipovi_kampova, MYSQL_ASSOC)){
							echo "<option value=\"". $tpp['oznaka'] ."\">(". $tpp['oznaka'] .") ". getTipKampa($tpp['oznaka']) ."</option>";
						}
					?>
				</select>
				<div style="clear:both"></div>

				<input type="text" class="input_no_error_dan" id="unos_dan" maxlength="2" name="pocetakDan" value="<?php echo $_jezik['kamp_pocetakDan']; ?>" /> 
				<select class="datum_rodjenja" name="pocetakMjesec" >
					<option value="1"><?php echo $_jezik['mjesec_januar']; ?></option>
					<option value="2"><?php echo $_jezik['mjesec_februar']; ?></option>
					<option value="3"><?php echo $_jezik['mjesec_mart']; ?></option>
					<option value="4"><?php echo $_jezik['mjesec_april']; ?></option>
					<option value="5"><?php echo $_jezik['mjesec_maj']; ?></option>
					<option value="6"><?php echo $_jezik['mjesec_jun']; ?></option>
					<option value="7"><?php echo $_jezik['mjesec_jul']; ?></option>
					<option value="8"><?php echo $_jezik['mjesec_avgust']; ?></option>
					<option value="9"><?php echo $_jezik['mjesec_septembar']; ?></option>
					<option value="10"><?php echo $_jezik['mjesec_oktobar']; ?></option>
					<option value="11"><?php echo $_jezik['mjesec_novembar']; ?></option>
					<option value="12"><?php echo $_jezik['mjesec_decembar']; ?></option>
				</select>
				<input type="text" class="input_no_error_dan" id="unos_godina" maxlength="4" name="pocetakGodina" value="<?php echo $_jezik['kamp_pocetakGodina']; ?>"  /> 
				<div style="clear:both"></div>

				<input type="text" class="input_no_error_dan" id="unos_dan" maxlength="2" name="krajDan" value="<?php echo $_jezik['kamp_krajDan']; ?>" /> 
				<select class="datum_rodjenja" name="krajMjesec" >
					<option value="1"><?php echo $_jezik['mjesec_januar']; ?></option>
					<option value="2"><?php echo $_jezik['mjesec_februar']; ?></option>
					<option value="3"><?php echo $_jezik['mjesec_mart']; ?></option>
					<option value="4"><?php echo $_jezik['mjesec_april']; ?></option>
					<option value="5"><?php echo $_jezik['mjesec_maj']; ?></option>
					<option value="6"><?php echo $_jezik['mjesec_jun']; ?></option>
					<option value="7"><?php echo $_jezik['mjesec_jul']; ?></option>
					<option value="8"><?php echo $_jezik['mjesec_avgust']; ?></option>
					<option value="9"><?php echo $_jezik['mjesec_septembar']; ?></option>
					<option value="10"><?php echo $_jezik['mjesec_oktobar']; ?></option>
					<option value="11"><?php echo $_jezik['mjesec_novembar']; ?></option>
					<option value="12"><?php echo $_jezik['mjesec_decembar']; ?></option>
				</select>
				<input type="text" class="input_no_error_dan" id="unos_godina" maxlength="4" name="krajGodina" value="<?php echo $_jezik['kamp_krajGodina']; ?>"  /> 
				<div style="clear:both"></div>

				<input type="text" class="input_no_error" id="unos_Username" name="kljucnaRijec" value="<?php echo $_jezik['kamp_kljucnaRijec']; ?>"/> 
				<div style="clear:both"></div>

				<input type="submit" name='submit' id="btnPotvrdi" value="<?php echo $_jezik['admin_slika_postaviNovuSliku_potvrdi'];?>"/> 

			</form>
		</div>

		<div class="content">
			<div class="unos_naslov"><?php echo $contentNaslov; ?>:</div><br/>

			<?php 
				if(!is_null($data)){
					$iBroj = 0;
 					while($dt = mysql_fetch_array($data, MYSQL_ASSOC)){
 						$opisKampa = str_replace("DESCRIPTION:", "", $dt['opis_kampa']);
 						$opisKampa = str_replace("DESCRIPTION ACCOMODATION AND FOOD:", "", $opisKampa);

						   echo "<a href=\"kamp.php?id=". $dt['intk'] ."\">
						   		 <div class=\"blok\" \">
									<div class=\"blok_slika\" style=\"background-image: url('slike/zastave/Velike/".$dt['zemlja'].".png')\"></div>
									<div class=\"blok_detail\">".$dt['lokacija_kampa']." (".$dt['zemlja'].") <b>".$dt['kod_kampa']."</b></div>
									<div class=\"blok_naslov\">". $dt['ime_kampa'] ."</div>
									<div class=\"blok_opis\">". $opisKampa ."</div>
									<div class=\"blok_detail\">".$dt['pocetakDan']." ".getMjesec($dt['pocetakMjesec'])." ".$dt['pocetakGodina']." - ".$dt['krajDan']." ".getMjesec($dt['krajMjesec'])." ".$dt['krajGodina']." <b>(".$dt['tip_kampa'].") </b></div>
								</div>
								</a>";
					}
				}
			?>

		</div><!--/content-->	
		<div id="navigacija">
			<?php
			if($ukupanBrojStranica!=0){
				if($str <= 3){
					for($i = 1; $i < 7; $i++){
						if($i==6) { echo "<div class=\"navBtnSpace\">...</div>"; echo "<div class=\"navBtn\" id=\""; echo $ukupanBrojStranica; echo"\">Poslednja (".$ukupanBrojStranica.")</div>"; break; }
						echo "<div class=\"navBtn\" id=\"". $i ."\">".$i."</div>";
						if($i==$ukupanBrojStranica) break;
					}
				} else {
					echo "<div class=\"navBtn\" id=\"1\">Prva</div>";  echo "<div class=\"navBtnSpace\">...</div>";
					for($i = $str-2; $i < $str+4; $i++){
						if($i==$str+3) { echo "<div class=\"navBtnSpace\">...</div>"; echo "<div class=\"navBtn\" id=\""; echo $ukupanBrojStranica; echo"\">Poslednja (".$ukupanBrojStranica.")</div>"; break;}
						echo "<div class=\"navBtn\" id=\"". $i ."\">".$i."</div>";
						if($i==$ukupanBrojStranica) break;
					}
				}
			}
			?>
	</div><!--/novost_tekst-->

	<?php include('engine/sekcije/_kontakt_futer.php'); ?>
</body>
</html>