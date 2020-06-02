<?php 
	require("engine/init.php"); 
	if(isset($_SESSION['user']) && !empty($_SESSION['user'])) header("Location: index.php");
	ukljuci_bazu(); $db = new BazaPodataka();
	$_header_show = 0;
	$_korisnik = "";
	$_korisnikWelcome = $_jezik['registracija_potvrdjenMail'];

	if(isset($_GET['aktivacija']) && !empty($_GET['aktivacija']) ){
		$db_rez = $db->q("SELECT COUNT(*) AS br, username, status FROM clan WHERE jedinstvenaSifra='". mysql_real_escape_string($_GET['aktivacija']) ."';");
		if($db_rez['br'] == 1 && $db_rez['status'] == "ne"){
			$_korisnik = $db_rez['username'];
			$db->e("UPDATE clan SET status='da' WHERE username='". $_korisnik ."';");
			$_header_show = 1;
		}
	}

	/* PREUZIMANJE PORUKE */
	$db->q("SELECT registracija_info, vefForma_info FROM admin_info WHERE idai=1;");
	$porukaRegistracija = $db->db_F['registracija_info']; $porukaVefForma = $db->db_F['vefForma_info'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Registracija</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
    <script src="js/main.js" type="text/javascript"></script>
    <script src="js/registracija.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/registracija.css"/>
    <script type="text/javascript">
    	var _header_show = <?php echo $_header_show; ?>;
    	var err_prazanString = "<?php echo $_jezik['registracija_greske_prazan']; ?>";
    	var err_manjeOd3 = "<?php echo $_jezik['registracija_greske_manjeOd3']; ?>";
    	var err_nedozvoljenZnak = "<?php echo $_jezik['registracija_greske_nedozvoljenZnak']; ?>";
    	var unos_dan = "<?php echo $_jezik['registracija_datumRodjenja_dan'] ?>";
    	var unos_godina = "<?php echo $_jezik['registracija_datumRodjenja_godina'] ?>";
    	var err_datum = "<?php echo $_jezik['registracija_greske_datum_format']; ?>";
    	var err_ok = "<?php echo $_jezik['registracija_greske_potvrdi']; ?>";
    	var btn_potvrda = "<?php echo $_jezik['registracija_btnPotvrdi']; ?>";
    	var btn_sacekaj = "<?php echo $_jezik['registracija_btnSacekaj']; ?>";
    </script>
</head>
<body>
	<?php include('engine/sekcije/_header.php'); ?>

	<div id="_naslov_naslov"><?php echo $_jezik['registracija_naslov']; ?></div>
	<div class="_header_">
		<div id="_naslov_teksta"><?php echo $_korisnik; ?></div>
		<div id="_opis_teksta"><?php echo $_korisnikWelcome; ?></div>
	</div><!--/_header_naslov-->

	<div class="registracija_sekcija">

		<div class="lijeva_strana_unos">
			<div class="lijeva_strana_unos_naslov"><?php echo $_jezik['registracija_informacijeZaRegistraciju']; ?>:</div>
			<!-- USERNAME -->
			<div class="unos_naslov"><?php echo $_jezik['registracija_username']; ?>: </div>
			<input type="text" class="input_no_error" id="unos_Username" maxlength="10"/> <label class="greska_unos" id="err_unos_Username"></label>

			<!-- SIFRA -->
			<div class="unos_naslov"><?php echo $_jezik['registracija_sifra']; ?>: </div>
			<input type="password" class="input_no_error" id="unos_Sifra" maxlength="20" /> <label class="greska_unos" id="err_unos_Sifra"></label>

			<!-- EMAIL -->
			<div class="unos_naslov"><?php echo $_jezik['registracija_email']; ?>: </div>
			<input type="text" class="input_no_error" id="unos_Email" maxlength="40"/> <label class="greska_unos" id="err_unos_Email"></label>

			<!-- IME KORISNIKA -->
			<div class="unos_naslov"><?php echo $_jezik['registracija_imeKorisnika']; ?>: </div>
			<input type="text" class="input_no_error" id="unos_Ime" maxlength="15"/> <label class="greska_unos" id="err_unos_Ime"></label>

			<!-- PREZIME KORISNIKA -->
			<div class="unos_naslov"><?php echo $_jezik['registracija_prezimeKorisnika']; ?>: </div>
			<input type="text" class="input_no_error" id="unos_Prezime" maxlength="15" /> <label class="greska_unos" id="err_unos_Prezime"></label>

			<!-- DATUM RODJENJA -->
			<div class="unos_naslov"><?php echo $_jezik['registracija_datumRodjenja']; ?>: </div>
			<input type="text" class="input_no_error_dan" id="unos_dan" maxlength="2" /> 
			<select id="datum_rodjenja">
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
			<input type="text" class="input_no_error_dan" id="unos_godina" maxlength="4" /> <label class="greska_unos" id="err_unos_Datum"></label>
			<div style="clear:both"></div>

			<!-- POL -->
			<div class="unos_naslov"><?php echo $_jezik['registracija_polKorsnik']; ?>: </div>
			<select id="pol_korisnika">
				<option value="m"><?php echo $_jezik['registracija_polKorsnik_muski']; ?></option>
				<option value="z"><?php echo $_jezik['registracija_polKorsnik_zenski'];?></option>
				<option value="d"><?php echo $_jezik['registracija_polKorsnik_drugo'];?></option>
				</select>

			<!-- MJESTO STANOVANJA -->
			<div class="unos_naslov"><?php echo $_jezik['registracija_mjestoStanovanja']; ?>: </div>
			<input type="text" class="input_no_error" id="unos_Mjesto" maxlength="20"/> <label class="greska_unos" id="err_unos_Mjesto"></label>
		</div>
			<!-------------------------------------------------------------------------------

					VEF FORMA

			-------------------------------------------------------------------------------->

		<div class="lijeva_strana_unos" id="unosVefForma">
			<div class="lijeva_strana_unos_naslov"><?php echo $_jezik['registracija_informacijeZaVefFormu']; ?></div>

			<!-- ZANIMANJE-->
			<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_zanimanje']; ?>: </div>
			<input type="text" class="input_no_error" id="zanimanje" value="-"/> 

			<!-- ZDRASTVENE NAPOMENE -->
			<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_zdrastveneNapomene']; ?>: </div>
			<textarea class="unos_Opis" id="zdrastvene_napomene" cols="" rows="" >-</textarea>
			<div style="clear:both"></div>

			<!-- JEZIK GOVORA -->
			<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_jezik']; ?>: </div>
			<input type="text" class="input_no_error" id="jezik" value="-"/> 

			<!-- NACIONALNOST -->
			<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_nacionalnost']; ?>: </div>
			<input type="text" class="input_no_error" id="nacionalnost" value="-"/> 

			<!-- BROJ PASOSA -->
			<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_brojPasosa']; ?>: </div>
			<input type="text" class="input_no_error" id="broj_pasosa" value="-"/> 

			<!-- PASOS KADA IZDAT I OD KOGA -->
			<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_izdataKadaIOdKoga']; ?>: </div>
			<input type="text" class="input_no_error" id="pasos_kadaIzdat" value="-"/> 

			<!-- PASOS VAZI DO -->
			<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_vaziDO']; ?>: </div>
			<input type="text" class="input_no_error" id="pasos_doKadTraje" value="-"/> 

			<!-- IME RODITELJA -->
			<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_imeRoditelja']; ?>: </div>
			<input type="text" class="input_no_error" id="ime_roditelja" value="-"/> 

			<!-- PREDHODNO VOLONTERSKO ISKUSTVO -->
			<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_predhodnoVolonterskoIskustvo']; ?>: </div>
			<textarea class="unos_Opis" id="predhodno_volonterskoIskustvo" cols="" rows="" >-</textarea>
			<div style="clear:both"></div>

			<!-- ZBOG CEGA ZELITE DA VOLONTIRATE -->
			<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_zbogCegaZeliteVolonterskeProjekte']; ?>: </div>
			<textarea class="unos_Opis" id="zbog_cega" cols="" rows="" >-</textarea>

			<!-- OPSTE NAPOMENE -->
			<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_opsteNapomene']; ?>: </div>
			<textarea class="unos_Opis" id="opste_napomene" cols="" rows="" >I accept the conditions of participation according to the programme of this organization and fully understand and accept my responsibility to obtain health insurance for the duration of my travel.</textarea>
			<div style="clear:both"></div>

		</div>
		<div class="lijeva_strana_unos">
			<input type="submit" id="btnPotvrdi"/> <label class="greska_unos" id="err_btnPotvrdi"></label>
		</div><!--/lijeva_stana_unos-->
	</div><!--registracija_sekcija-->
		<div id="desna_strana">
			<div class="boks" <?php if($_header_show==1) echo "style=\"display:none;\""; ?>><?php echo $porukaRegistracija; ?></div>
			<div class="boks" <?php if($_header_show==1) echo "style=\"display:none;\""; ?>><?php echo $porukaVefForma; ?></div>
		</div><!-- DESNA STRANA -->

	<?php include('engine/sekcije/_kontakt_futer.php'); ?>
</body>
</html>