<?php
	require("engine/init.php");
	if(!isset($_GET['id']) || empty($_GET['id'])){ header("Location: index.php"); }
	ukljuci_bazu(); $db = new BazaPodataka();

	// Preuzimanje podataka o bazi
	$kamp = $db->q("SELECT COUNT(*) AS br, intk, ime_kampa, kod_kampa, zemlja, organizacija, lokacija_kampa, regija_kampa, jezik_kampa, tip_kampa, pocetakDan, pocetakMjesec, pocetakGodina, krajDan, krajMjesec, krajGodina, ukupanBrojVolontera, dodatniTroskovi, minimumGodina, maksimumGodina, opis_kampa, opis_posla, opis_lokacije, opis_potreba, dodatne_info FROM kamp WHERE intk=".$_GET['id'].";");
	if($kamp['br'] != 1) header("Location: index.php"); 

	// Preuzimanje podataka o korisniku (provjera da li je banovan, neaktivan ili admin)
	$status = "ne";
	if(isset($_SESSION['user'])){
	 	$r = $db->q("SELECT status, admin_level FROM clan WHERE username='".$_SESSION['user']."';");
	 	if($r['status']!="ne" && $r['status']!="ban"){
	 		$status = "da";
	 		if($r['admin_level']=="ad") $status = "ad";
	 	}
	}

	// Preuzimanje broja puta koliko je ovaj kamp u listama
	$db->q("SELECT COUNT(*) AS br FROM kamp_lista WHERE id_kampa=".$kamp['intk'].";"); $brojPutaUListu = $db->db_F['br'];
	// I da li se ovaj kamp nalazi na listi ovog korisnika
	$lista_vlasnik = "ne";
	if($status != "ne"){
		$db->q("SELECT COUNT(*) AS br FROM kamp_lista WHERE id_kampa=".$kamp['intk']." AND clan_lista='".$_SESSION['user']."';");
		if($db->db_F['br']==1) $lista_vlasnik = "da";
	}

	// Preuzimanje backgrounda
	$br_back = $db->q("SELECT COUNT(*) AS br FROM kamp_background;"); $br_back = $br_back['br']; $br_back = rand(1, $br_back);
	$back_adresa = "";
	if($br_back>0) $back_adresa = $db->q("SELECT adresa FROM kamp_background WHERE idkb=".$br_back.";"); $back_adresa = $back_adresa['adresa'];
	//echo $br_back . " " . $back_adresa;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title><?php echo $kamp['ime_kampa'] ?></title>
    <script src="js/_jQuery.js"></script>
    <script src="js/_jQueryUI.js"></script>
    <script src="js/main.js" type="text/javascript"></script>
    <script src="js/kamp.js" type="text/javascript"></script>
    <script src="ekstra/plugins/autosize/jquery.autosize-min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/kamp.css"/>
    <script type="text/javascript">var id=<?php echo $kamp['intk']; ?>; 
    var enable = <?php  if($status=="ad") echo "false"; else echo "true"; ?>; var sacekaj_lang = '<?php echo $_jezik['registracija_btnSacekaj']; ?>';

    /* INFO ZA LISTU */
    var listPD = <?php echo $kamp['pocetakDan']; ?>; var listPM = <?php echo $kamp['pocetakMjesec']; ?>; var listPG = <?php echo $kamp['pocetakGodina']; ?>;
    var listKD = <?php echo $kamp['krajDan']; ?>; var listKM = <?php echo $kamp['krajMjesec']; ?>; var listKG = <?php echo $kamp['krajGodina']; ?>;
    var listID = <?php echo $kamp['intk']; ?>; var listZemlja = <?php echo "'" . $kamp['zemlja'] . "'"; ?>; 

    var langZamraci = <?php echo "'" . $_jezik['kamp_zamraciBack'] . "'";?>;
    var langOdmraci = <?php echo "'" . $_jezik['kamp_odmraciBack'] . "'"; ?>;
    <?php if($status!="ne") echo "var listUSER = '" . $_SESSION['user'] . "';"; else echo "var listUSER = \"\";"; ?>

     </script>
     <style type="text/css">
     	<?php //if($back_adresa!= "")echo "body { background-image:url(".$back_adresa.");"; ?>
     </style>
</head>
<body>
	<?php include('engine/sekcije/_header.php'); ?>

	<div id="bacground_image_shadow"></div>
	<div id="background_image" <?php if($back_adresa!= "")echo "style=\"background-image:url(".$back_adresa.")\""; ?>></div>

	<div class="kamp_glavneInfo">
		<div class="clan_info"><?php echo $_jezik['kamp_imeKampa']; ?>:</div>
		<textarea id="ime_kampa" class="glavneInfo" ><?php echo $kamp['ime_kampa']; ?></textarea> 

		<div class="clan_info"><?php echo $_jezik['kamp_kodKampa']; ?>:</div>
		<input type="text" value="<?php echo $kamp['kod_kampa']; ?>" class="glavneInfo" id="kod_kampa" />

		<div class="clan_info"><?php echo $_jezik['kamp_organizacija']; ?>:</div>
		<input type="text" value="<?php echo $kamp['organizacija']; ?>" class="glavneInfo" id="organizacija" />

		<br/><br/>

		<div class="clan_info"><?php echo $_jezik['kamp_zemlja']; ?>:</div>
		<div class="clan_info_txt" style="vertical-align: top;"><img src="slike/zastave/<?php echo $kamp['zemlja']; ?>.png" width="20" height="20"/><?php echo "  " . $kamp['zemlja']; ?></div>

		<div class="clan_info"><?php echo $_jezik['kamp_dodatUListu']; ?>:</div>
		<div class="clan_info_txt"><?php echo $brojPutaUListu; echo $_jezik['kamp_dodatUListuPuta']; ?></div>
	</div>

	<div id="opcije">
		<?php
			if($status!="ne"){
				if($lista_vlasnik=="ne") echo "<input type=\"button\" id=\"btn_addLista\" value=\"".$_jezik['kamp_dodajUListu']."\" />";
				else  echo "<input type=\"button\" id=\"btn_dellLista\" value=\"".$_jezik['kamp_izbrisiIzListe']."\" />";
			}
			if($status=="ad"){
				echo "<input type=\"button\" id=\"btn_save\" value=\"". $_jezik['kamp_sacuvaj'] ."\" />";
				echo "<input type=\"button\" id=\"btn_dell\" value=\"". $_jezik['kamp_izbrisi'] ."\" />";
			}
		?>
		<input type="button" id="btn_dark" value="<?php echo  $_jezik['kamp_zamraciBack'];?>" />;
	</div>

	<div class="kamp_dodatneInfo">
		<?php
			if($lista_vlasnik=="da"){ 
				echo "<div class=\"kontenjer\">
							<span id=\"kamp_pripada\">". $_jezik['kamp_nalaziSeUListi'] ."</span>
						</div>";
			}
		?>

		<div class="kontenjer">
			<table>
				<tr>
					<td> <div class="clan_info"><?php echo $_jezik['kamp_tipKampa']; ?>:</div> </td>
					<td> <input type="text" class="kontenjerInfo" value="<?php echo getTipKampa_multi($kamp['tip_kampa']); ?>"/> </td>
				</tr>
				<tr>
					<td><div class="clan_info"><?php echo $_jezik['kamp_lokacijaKampa'] ; ?>:</div></td>
					<td><input type="text" class="kontenjerInfo" value="<?php echo $kamp['lokacija_kampa']; ?>"  id="lokacija_kampa" /></td>
				</tr>
				<tr>
					<td><div class="clan_info"><?php echo $_jezik['kamp_regijaKampa'] ; ?>:</div></td>
					<td><input type="text" class="kontenjerInfo" value="<?php echo $kamp['regija_kampa']; ?>" id="regija_kampa" /></td>
				</tr>
				<tr>
					<td><div class="clan_info"><?php echo $_jezik['kamp_jezikKampa']; ?>:</div></td>
					<td><input type="text" class="kontenjerInfo" value="<?php echo $kamp['jezik_kampa']; ?>" id="jezik_kampa" /></td>
				</tr>
				<tr>
					<td><div class="clan_info"><?php echo $_jezik['kamp_pocetak']; ?>:</div></td>
					<td><input type="text" class="kontenjerInfo" value="<?php echo $kamp['pocetakDan'] .' '. getMjesec($kamp['pocetakMjesec']) .' '. $kamp['pocetakGodina']; ?>"/></td>
				</tr>
				<tr>
					<td><div class="clan_info"><?php echo $_jezik['kamp_kraj']; ?>:</div></td>
					<td><input type="text" class="kontenjerInfo" value="<?php echo $kamp['krajDan'] .' '. getMjesec($kamp['krajMjesec']) .' '. $kamp['krajGodina']; ?>"/></td>
				</tr>
				<tr>
					<td><div class="clan_info"><?php echo $_jezik['kamp_ukupanBrojVolontera']; ?>:</div></td>
					<td><input type="text" class="kontenjerInfo" value="<?php echo $kamp['ukupanBrojVolontera']; ?>" id="ukupanBrojVolontera" /></td>
				</tr>
				<tr>
					<td><div class="clan_info"><?php echo $_jezik['kamp_dodatniTroskovi']; ?>:</div></td>
					<td><input type="text" class="kontenjerInfo" value="<?php echo $kamp['dodatniTroskovi']; ?>" id="dodatniTroskovi" /></td>
				</tr>
				<tr>
					<td><div class="clan_info"><?php echo $_jezik['kamp_minimumGodina']; ?>:</div></td>
					<td><input type="text" class="kontenjerInfo" value="<?php echo $kamp['minimumGodina']; ?>" id="minimumGodina" /></td>
				</tr>
				<tr>
					<td><div class="clan_info"><?php echo $_jezik['kamp_maksimumGodina']; ?>:</div></td>
					<td><input type="text" class="kontenjerInfo" value="<?php echo $kamp['maksimumGodina']; ?>" id="maksimumGodina" /></td>
				<tr>
			</table>
		</div>

		<div class="kontenjer">
			<div class="clan_info"><?php echo $_jezik['kamp_opisKampa']; ?>:</div>
			<textarea id="opis_kampa" class="kontenjerText"><?php echo $kamp['opis_kampa']; ?></textarea>
		</div>

		<div class="kontenjer">
			<div class="clan_info"><?php echo $_jezik['kamp_opisPosla']; ?>:</div>
			<textarea id="opis_posla" class="kontenjerText"><?php echo $kamp['opis_posla']; ?></textarea>
		</div>

		<div class="kontenjer">
			<div class="clan_info"><?php echo $_jezik['kamp_opisLokacije']; ?>:</div>
			<textarea id="opis_lokacije" class="kontenjerText"><?php echo $kamp['opis_lokacije']; ?></textarea>
		</div>

		<div class="kontenjer">
			<div class="clan_info"><?php echo $_jezik['kamp_opisPotreba']; ?>:</div>
			<textarea id="opis_potreba" class="kontenjerText"><?php echo $kamp['opis_potreba']; ?></textarea>
		</div>

		<div class="kontenjer">
			<div class="clan_info"><?php echo $_jezik['kamp_dodatneInfo']; ?>:</div>
			<textarea id="dodatne_info" class="kontenjerText"><?php echo $kamp['dodatne_info']; ?></textarea>
		</div>
	</div><!--/novost_tekst-->

</body>
</html>