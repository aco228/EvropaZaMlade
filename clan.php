<?php
	// POCETNE PROVJERE
	require("engine/init.php");
	if(!isset($_SESSION['user']) && !empty($_SESSION['user'])) header("Location: index.php");

	if(isset($_GET['odjava']) && !empty($_GET['odjava'])){ 
		if(isset($_SESSION['user']) && !empty($_SESSION['user'])) unset($_SESSION['user']);
		header("Location: index.php"); 
		exit();
	}
	if(!isset($_GET['user']) || empty($_GET['user'])){ header("Location: index.php"); }
	ukljuci_bazu(); 
	$db = new BazaPodataka();

	// 
	// PROMJENA INFORMACIJE
	//
	if(isset($_POST['potvrda_promjene'])){
		$mjesto = " "; if(isset($_POST['mjesto'])) $mjesto = mysql_real_escape_string($_POST['mjesto']);
		$kontakt_telefon = " "; if(isset($_POST['kontakt_telefon'])) $kontakt_telefon = mysql_real_escape_string($_POST['kontakt_telefon']);
		$zanimanje = " "; if(isset($_POST['zanimanje'])) $zanimanje = mysql_real_escape_string($_POST['zanimanje']);
		$zdravlje = " "; if(isset($_POST['zdravlje'])) $zdravlje = mysql_real_escape_string($_POST['zdravlje']);
		$jezik = " "; if(isset($_POST['jezik'])) $jezik = mysql_real_escape_string($_POST['jezik']);
		$nacionalnost = " "; if(isset($_POST['nacionalnost'])) $nacionalnost = mysql_real_escape_string($_POST['nacionalnost']);
		$broj_pasosa = " "; if(isset($_POST['broj_pasosa'])) $broj_pasosa = mysql_real_escape_string($_POST['broj_pasosa']);
		$pasos_kad = " "; if(isset($_POST['pasos_kad'])) $pasos_kad = mysql_real_escape_string($_POST['pasos_kad']);
		$pasos_doKad = " "; if(isset($_POST['pasos_doKad'])) $pasos_doKad = mysql_real_escape_string($_POST['pasos_doKad']);
		$ime_roditelja = " "; if(isset($_POST['ime_roditelja'])) $ime_roditelja = mysql_real_escape_string($_POST['ime_roditelja']);
		$iskustvo = " "; if(isset($_POST['iskustvo'])) $iskustvo = mysql_real_escape_string($_POST['iskustvo']);
		$zbog_cega = " "; if(isset($_POST['zbog_cega'])) $zbog_cega = mysql_real_escape_string($_POST['zbog_cega']);
		$opste_napomene = " "; if(isset($_POST['opste_napomene'])) $opste_napomene = mysql_real_escape_string($_POST['opste_napomene']);
		$preuzmi_drugiKamp = "No"; if(isset($_POST['preuzmi_drugiKamp'])) $preuzmi_drugiKamp = "Yes";
		$db->e("UPDATE clan SET mjestoStanovanja='".$mjesto."', zanimanje='".$zanimanje."', zdrastvene_napomene='".$zdravlje."',
								 jezik='".$jezik."', nacionalnost='".$nacionalnost."', broj_pasosa='".$broj_pasosa."',
								 pasos_kadaIzdat='".$pasos_kad."', pasos_doKadTraje='".$pasos_doKad."', ime_roditelja='".$ime_roditelja."',
								 predhodno_iskustvo='".$iskustvo."', zbog_cega='".$zbog_cega."', 
								 kontakt_telefon='".$kontakt_telefon."', preuzmi_drugiKamp='".$preuzmi_drugiKamp."', opste_napomene='".$opste_napomene."'
			WHERE username='".$_SESSION['user']."'");
	}

	//
	// PRIKUPLJANJE INFORMACIJE
	//
	$db_rez = $db->q("SELECT COUNT(*) AS br, ime, prezime, danRodjenja, mjesecRodjenja, godinaRodjenja, pol, mjestoStanovanja, status, admin_level, 
											   zanimanje, zdrastvene_napomene, jezik, nacionalnost, broj_pasosa, pasos_kadaIzdat, pasos_doKadTraje, 
											   ime_roditelja, predhodno_iskustvo, zbog_cega, 
											   kontakt_telefon, preuzmi_drugiKamp, opste_napomene
							FROM clan WHERE username='".$_GET['user']."';");
	if($db_rez['br'] != 1 || $db_rez['status'] == "ne" || $db_rez['status'] == "ban") { header("Location: index.php"); }

	$user = $_GET['user'];
	if($_SESSION['user'] != "admin" && $user != $_SESSION['user']) header("Location: index.php");
	$_iAdmin = 0; if($db_rez['admin_level'] == "ad") $_iAdmin = 2;

	$ime = $db->db_F['ime'];
	$prezime = $db->db_F['prezime'];
	$rDan = $db->db_F['danRodjenja'];
	$rMj = getMjesec($db->db_F['mjesecRodjenja']);
	$rGod = $db->db_F['godinaRodjenja'];
	$pol = getPol($db->db_F['pol']);
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
	$opste_napomene = $db->db_F['opste_napomene'];

	//
	//	PREUZIMANJE KORISNIKOVE LISTE, informacija za VEF_FORMU i LISTU
	//
	$lista_kampova = $db->qMul("SELECT id_kampa, ime_kampa, kod_kampa, zemlja_kampa, pocetakDan, pocetakMjesec, pocetakGodina, krajDan, krajMjesec, krajGodina
								FROM kamp_lista WHERE clan_lista='".$user."';");
	$db->q("SELECT lista_info, vefForma_info FROM admin_info WHERE idai=1;");
	$vefForma_info = $db->db_F['vefForma_info']; $lista_info = $db->db_F['lista_info'];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Clan: <?php echo $_SESSION['user']; ?></title>
    <script src="js/_jQuery.js"></script>
    <script src="js/_jQueryUI.js"></script>
    <script src="js/main.js" type="text/javascript"></script>
    <script src="js/clan.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/clan.css"/>
    <script type="text/javascript">var sacekaj_lang = '<?php echo $_jezik['registracija_btnSacekaj']; ?>';
    var user = '<?php echo $user; ?>'; 
    var nsa= <?php if($user==$_SESSION['user']) echo "false"; else echo "true"; ?>;
    </script>
</head>
<body>
	<?php include('engine/sekcije/_header.php'); ?>

	<div id="_naslov_naslov"><?php echo $_jezik['clan_naslov']; ?></div>
	<div class="_header_">
		<div id="_naslov_teksta"><?php echo $user; ?></div>
	</div><!--/_header_naslov-->

	<div class="clan_meni"> 
		<?php
			echo "<input type=\"button\" id=\"clan_btn_odjava\" value=\"". $_jezik['clan_meni_odjava']  ."\" /> 
				<input type=\"button\" id=\"clan_btn_posaljiListu\"  value=\"". $_jezik['clan_meni_posaljiListu'] ."\" />";
				if($_iAdmin == 2){
					  echo "<input type=\"button\" id=\"clan_btn_adminSekcija\"  value=\"".  $_jezik['clan_meni_admin'] ."\" /> ";
				}
		?>
	</div><!-- /clan_meni-->

	<div class="clan_sekcija">
			<table><td class="tdTable">
				<div class="info_boks_adminskaObavjestenja" id="registracija_info"><?php echo $vefForma_info; ?></div>
							
				<div class="clan_info"><?php echo $_jezik['clan_info_ime']; ?>:</div>
				<div class="clan_info_txt"><?php echo $ime . " " . $prezime; ?></div>

				<div class="clan_info"><?php echo $_jezik['clan_info_datumRodjenja']; ?>:</div>
				<div class="clan_info_txt"><?php echo $rDan; ?> <?php echo $rMj; ?> <?php echo $rGod; ?></div>



				<div class="clan_info">.</div>
				<div class="clan_info">VEF Form</div>
				<div class="clan_info">.</div>


			<form action="" method="POST">
				<div class="clan_info"><?php echo $_jezik['registracija_mjestoStanovanja']; ?>:</div>
				<input type="text" name="mjesto" class="info_promjena" value="<?php echo $mjesto; ?>" />

				<div class="clan_info"><?php echo $_jezik['vefForma_stranica_kontaktTelefon']; ?>:</div>
				<input type="text" name="kontakt_telefon" class="info_promjena" value="<?php echo $kontakt_telefon; ?>" />

				<div class="clan_info"><?php echo $_jezik['vefForma_stranica_zanimanje']; ?>:</div>
				<input type="text" name="zanimanje" class="info_promjena" value="<?php echo $zanimanje; ?>" />

				<div class="clan_info"><?php echo $_jezik['vefForma_stranica_zdrastveneNapomene']; ?>:</div>
				<input type="text" name="zdravlje" class="info_promjena" value="<?php echo $zdrastvene_napomene; ?>" />

				<div class="clan_info"><?php echo $_jezik['vefForma_stranica_jezik']; ?>:</div>
				<input type="text" name="jezik" class="info_promjena" value="<?php echo $jezik; ?>" />

				<div class="clan_info"><?php echo $_jezik['vefForma_stranica_nacionalnost']; ?>:</div>
				<input type="text" name="nacionalnost" class="info_promjena" value="<?php echo $nacionalnost; ?>" />

				<div class="clan_info"><?php echo $_jezik['vefForma_stranica_brojPasosa']; ?>:</div>
				<input type="text" name="broj_pasosa" class="info_promjena" value="<?php echo $broj_pasosa; ?>" />

				<div class="clan_info"><?php echo $_jezik['vefForma_stranica_izdataKadaIOdKoga']; ?>:</div>
				<input type="text" name="pasos_kad" class="info_promjena" value="<?php echo $pasos_kadaIzdat; ?>" />

				<div class="clan_info"><?php echo $_jezik['vefForma_stranica_vaziDO']; ?>:</div>
				<input type="text" name="pasos_doKad" class="info_promjena" value="<?php echo $pasos_doKadTraje; ?>" />

				<div class="clan_info"><?php echo $_jezik['vefForma_stranica_imeRoditelja']; ?>:</div>
				<input type="text" name="ime_roditelja" class="info_promjena" value="<?php echo $ime_roditelja; ?>" />				

				<div class="clan_info"><?php echo $_jezik['vefForma_stranica_predhodnoVolonterskoIskustvo']; ?>:</div>
				<textarea name="iskustvo" class="info_promjena_text"><?php echo $predhodno_iskustvo; ?></textarea>

				<div class="clan_info"><?php echo $_jezik['vefForma_stranica_zbogCegaZeliteVolonterskeProjekte']; ?>:</div>
				<textarea name="zbog_cega" class="info_promjena_text"><?php echo $zbog_cega; ?></textarea>

				<div class="clan_info"><?php echo $_jezik['vefForma_stranica_opsteNapomene']; ?>:</div>
				<textarea name="opste_napomene" class="info_promjena_text"><?php echo $opste_napomene; ?></textarea>

				<div class="clan_info"><?php echo $_jezik['vefForma_stranica_preuzmiDrugiAkoJePun']; ?>:
					<input type="checkbox" name="preuzmi_drugiKamp"  id="preuzmi_drugi" <?php if($preuzmi_drugiKamp=="Yes") echo "checked=\"yes\"";?> />
				</div>

				<div style="clear:both"></div>
				<input type="submit" id="potvrda_promjene" name="potvrda_promjene" value="<?php echo $_jezik['admin_indexMenu_sacuvaj']; ?>"/>
			</form>
		</td>
		<td id="desna_strana" class="tdTable">
			<div class="info_boks_adminskaObavjestenja" id="lista_info"><?php echo $lista_info; ?></div>
			<table>
				<tr>
					<td><?php echo $_jezik['kamp_imeKampa']; ?></td>
					<td><?php echo $_jezik['kamp_zemlja']; ?></td>
					<td><?php echo $_jezik['kamp_kodKampa']; ?></td>
					<td><?php echo $_jezik['kamp_pocetak']; ?></td>
					<td><?php echo $_jezik['kamp_kraj']; ?></td>
				</tr><!--
				<tr>
					<td><a href="kamp.php?id=2" target="_blank">Vokurac</a></td>
					<td>Austria</td>
					<td>SUPAK</td>
					<td>7 jun 2012</td>
					<td>25 april 2013</td>
				</tr>
				<tr>
					<td><a href="kamp.php?id=3">Bubilage</a></td>
					<td>Austria</td>
					<td>GIRA</td>
					<td>7 jun 2012</td>
					<td>25 april 2013</td>
				</tr>-->
				<?php
					while($r = mysql_fetch_array($lista_kampova, MYSQL_ASSOC)){
						echo "<tr>
								<td><a href=\"kamp.php?id=". $r['id_kampa'] ."\" target=\"_blank\">". $r['ime_kampa'] ."</a></td>
								<td>". $r['zemlja_kampa'] ."</td>
								<td>". $r['kod_kampa'] ."</td>
								<td>". $r['pocetakDan'] . " " . getMjesec($r['pocetakMjesec']) . " " . $r['pocetakDan'] ."</td>
								<td>". $r['krajDan'] . " " . getMjesec($r['krajMjesec']) . " " . $r['krajDan'] ."</td>
							  </tr>";
					}
				?>
			</table>
		</td></table>
	</div><!--/novost_tekst-->

	<?php include('engine/sekcije/_kontakt_futer.php'); ?>
</body>
</html>