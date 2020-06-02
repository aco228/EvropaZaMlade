<?php 
	require("engine/init.php"); 
	$_header_show = 0;
	$_opisNaslova = "";
	$_korisnikWelcome = $_jezik['registracija_potvrdjenMail'];

	ukljuci_bazu(); $db = new BazaPodataka();
	$tipovi_kampova = $db->qMul("SELECT oznaka FROM tip_kampa");
	$kampovi = $db->qMul("SELECT kod_kampa, ime_kampa, lokacija_kampa, zemlja FROM kamp");
	$options_kamp = "";
	while($tk = mysql_fetch_array($kampovi, MYSQL_ASSOC)){
		$options_kamp .= "<option value=\"".$tk['kod_kampa']."\">(<span class=\"bold\">".$tk['kod_kampa']."</span>) ". $tk['ime_kampa'] .", ". $tk['lokacija_kampa'] .", ". $tk['zemlja'] ."</option>";
	}

	if(isset($_POST['submit'])){
		$ime_prezime = "";
		$zanimanje = "";
		$mjesto_stanovanje = "";
		$kontakt_telefon = "";
		$email_adresa = "";
		$zdrastvene_napomene = "Nista nije upisano";
		$jezik = "Nista nije upisano";
		$rodjenje_dan = "";
		$rodjenje_mjesec = "";
		$rodjenje_godina = "";
		$mjesto_rodjenja = "";
		$nacionalnost = "Nista nije upisano";
		$pol = "";
		$broj_pasosa = "";
		$pasos_kadaIzdat = "Nista nije upisano";
		$pasos_doKadTraje = "Nista nije upisano";
		$ime_roditelja = "Nista nije upisano";
		$predhodno_volonterskoIskustvo = "Nista nije upisano";
		$kamp1 = "Nista nije upisano";
		$kamp2 = "Nista nije upisano";
		$kamp3 = "Nista nije upisano";
		$kamp4 = "Nista nije upisano";
		$kamp5 = "Nista nije upisano";
		$kamp6 = "Nista nije upisano";
		$preuzmi_drugi = "Da";
		$omiljeni_projekat = "Nista nije upisano";
		$zbog_cega = "Nista nije upisano";
		$greska = false;

		if(!$greska){ if(isset($_POST['ime_prezime']) && !empty($_POST['ime_prezime'])){
			$ime_prezime = $_POST['ime_prezime'];
		} else {$greska = true; $_header_show = 1; $_opisNaslova = "Error"; $_korisnikWelcome = $_jezik['vefForma_stranica_greska_ime_prezime']; }}

		if(!$greska){ if(isset($_POST['zanimanje']) && !empty($_POST['zanimanje'])){
			$zanimanje = $_POST['zanimanje'];
		} else {$greska = true; $_header_show = 1; $_opisNaslova = "Error"; $_korisnikWelcome = $_jezik['vefForma_stranica_greska_zanimanje']; }}

		if(!$greska){ if(isset($_POST['mjesto_stanovanje']) && !empty($_POST['mjesto_stanovanje'])){
			$mjesto_stanovanje = $_POST['mjesto_stanovanje'];
		} else { $greska = true; $_header_show = 1; $_opisNaslova = "Error"; $_korisnikWelcome = $_jezik['vefForma_stranica_greska_mjesto_stanovanja']; }}

		if(!$greska){ if(isset($_POST['kontakt_telefon']) && !empty($_POST['kontakt_telefon'])){
			$kontakt_telefon = $_POST['kontakt_telefon'];
		} else {$greska = true; $_header_show = 1; $_opisNaslova = "Error"; $_korisnikWelcome = $_jezik['vefForma_stranica_greska_kontakt_telefon']; }}

		if(!$greska){ if(isset($_POST['email']) && !empty($_POST['email'])){
			$email_adresa = $_POST['email'];
		} else {$greska = true; $_header_show = 1; $_opisNaslova = "Error"; $_korisnikWelcome = $_jezik['vefForma_stranica_greska_email']; }}

		if(isset($_POST['zdrastvene_napomene'])) $zdrastvene_napomene = $_POST['zdrastvene_napomene'];
		if(isset($_POST['jezik'])) $jezik = $_POST['jezik'];

		if(!$greska){ if(isset($_POST['rodjenje_dan']) && !empty($_POST['rodjenje_dan']) && is_numeric($_POST['rodjenje_dan'])){
			$rodjenje_dan = $_POST['rodjenje_dan'];
		} else {$greska = true; $_header_show = 1; $_opisNaslova = "Error"; $_korisnikWelcome = $_jezik['vefForma_stranica_greska_rodjenje_dan']; }}

		if(!$greska){ if(isset($_POST['rodjenje_godina']) && !empty($_POST['rodjenje_godina']) && is_numeric($_POST['rodjenje_godina'])){
			$rodjenje_godina = $_POST['rodjenje_godina'];
		} else {$greska = true; $_header_show = 1; $_opisNaslova = "Error"; $_korisnikWelcome = $_jezik['vefForma_stranica_greska_rodjenje_godina']; }}

		if(!$greska){ if(isset($_POST['mjesto_rodjenja']) && !empty($_POST['mjesto_rodjenja'])){
			$mjesto_rodjenja = $_POST['mjesto_rodjenja'];
		} else {$greska = true; $_header_show = 1; $_opisNaslova = "Error"; $_korisnikWelcome = $_jezik['vefForma_stranica_greska_mjesto_rodjenja']; }}

		if(!$greska && isset($_POST['nacionalnost'])) $nacionalnost = $_POST['nacionalnost'];
		if(!$greska && isset($_POST['pol'])) $pol = getPol($_POST['pol']);
		if(!$greska && isset($_POST['broj_pasosa'])) $broj_pasosa = $_POST['broj_pasosa'];
		if(!$greska && isset($_POST['pasos_kadaIzdat'])) $pasos_kadaIzdat = $_POST['pasos_kadaIzdat'];
		if(!$greska && isset($_POST['pasos_doKadTraje'])) $pasos_doKadTraje = $_POST['pasos_doKadTraje'];
		if(!$greska && isset($_POST['ime_roditelja'])) $ime_roditelja = $_POST['ime_roditelja'];
		if(!$greska && isset($_POST['predhodno_volonterskoIskustvo'])) $predhodno_volonterskoIskustvo = $_POST['predhodno_volonterskoIskustvo'];

		if(!$greska){ if(isset($_POST['broj_pasosa']) && !empty($_POST['broj_pasosa'])){
			$broj_pasosa = $_POST['broj_pasosa'];
		} else {$greska = true; $_header_show = 1; $_opisNaslova = "Error"; $_korisnikWelcome =$_jezik['vefForma_stranica_greska_broj_pasosa']; }}

		if(!$greska){
			$nekiKamp = false;
			if($_POST['kamp1'] != "no_kamp") { $kamp1 = $_POST['kamp1']; $nekiKamp = true; }
			if($_POST['kamp2'] != "no_kamp") { $kamp2 = $_POST['kamp2']; $nekiKamp = true; }
			if($_POST['kamp3'] != "no_kamp") { $kamp3 = $_POST['kamp3']; $nekiKamp = true; }
			if($_POST['kamp4'] != "no_kamp") { $kamp4 = $_POST['kamp4']; $nekiKamp = true; }
			if($_POST['kamp5'] != "no_kamp") { $kamp5 = $_POST['kamp5']; $nekiKamp = true; }
			if($_POST['kamp6'] != "no_kamp") { $kamp6 = $_POST['kamp6']; $nekiKamp = true; }
			if(!$nekiKamp){$greska = true; $_header_show = 1; $_opisNaslova = "Error"; $_korisnikWelcome = $_jezik['vefForma_stranica_greska_kamp']; }
		}

		if(!$greska && !isset($_POST['preuzmi_drugi'])) $preuzmi_drugi = "Ne ";
		if(!$greska && !isset($_POST['omiljeni_projekat'])) $omiljeni_projekat = $_POST['omiljeni_projekat'];
		if(!$greska && isset($_POST['zbog_cega'])) $zbog_cega = $_POST['zbog_cega'];

		if(!$greska){
			$db->q("SELECT email FROM admin_info WHERE idai=1;");
			$email = $db->db_F['email'];

			mail(
				$email, 
				"VEF FORMA - " . $ime_prezime , 
				"Ime i prezime: " . strtoupper($ime_prezime) . "\r\n" .
				"Zanimanje: " . strtoupper($zanimanje) . "\r\n" .
				"Mjesto stanovanja: " . strtoupper($mjesto_stanovanje) . "\r\n" .
				"Kontakt telefon: " . strtoupper($kontakt_telefon) . "\r\n" .
				"Email adresa: " . $email_adresa . "\r\n\r\n" .

				"Zdrastvene napomene: " . strtoupper($zdrastvene_napomene) . "\r\n" .
				"Jezik: " . strtoupper($jezik) . "\r\n" .
				"Datum rodjenja: " . $rodjenje_dan . ' ' . getMjesec($rodjenje_mjesec) . ' ' . $rodjenje_godina . "\r\n" .
				"Mjesto rodjenja: " . strtoupper($mjesto_rodjenja) . "\r\n" .
				"Nacionalnost: " . strtoupper($nacionalnost) . "\r\n" .
				"Pol: " . strtoupper($pol) . "\r\n" .
				"Broj pasosa: " . strtoupper($broj_pasosa) . "\r\n" .
				"Pasos izdat od: " . strtoupper($pasos_kadaIzdat) . "\r\n" .
				"Pasos traje do: " . strtoupper($pasos_doKadTraje) . "\r\n" .
				"Ime roditelja: " . strtoupper($ime_roditelja) . "\r\n" .
				"Predhodno volontersko iskustvo: " . strtoupper($predhodno_volonterskoIskustvo) . "\r\n\r\n" .
				
				"Kamp 1: " . $kamp1 . "\r\n" .
				"Kamp 2: " . $kamp2 . "\r\n" .
				"Kamp 3: " . $kamp3 . "\r\n" .
				"Kamp 4: " . $kamp4 . "\r\n" .
				"Kamp 5: " . $kamp5 . "\r\n" .
				"Kamp 6: " . $kamp6 . "\r\n\r\n" .

				"Preuzmi drugi kamp ako su navedeni zauzeti: " . $preuzmi_drugi . "\r\n" .
				"Omiljeni tip projekta: " . $omiljeni_projekat . "\r\n" .
				"Razlog zbog cega volontiram: " . $zbog_cega,
				"From: evropa_za_mlade VEF-FORMA"
			);
 			$_header_show = 1; $_opisNaslova = "Success"; $_korisnikWelcome = $_jezik['vefForma_stranica_success']; 
		}
		

	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title><?php echo $_jezik['vefForma_naslov']?></title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
    <script src="js/main.js" type="text/javascript"></script>
    <script src="js/vefForma.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/vefForma.css"/>
    <script type="text/javascript">
    	var _header_show = "<?php echo $_header_show; ?>";
    </script>
</head>
<body>
	<?php include('engine/sekcije/_header.php'); ?>

	<div id="_naslov_naslov"><?php echo $_jezik['vefForma_naslov']; ?></div>
	<div class="_header_">
		<div id="_naslov_teksta"><?php echo $_opisNaslova; ?></div>
		<div id="_opis_teksta"><?php echo $_korisnikWelcome; ?></div>
	</div><!--/_header_naslov-->

	<div class="registracija_sekcija">

		<div id="lijeva_strana_unos">
			<div class="lijeva_stana_unos">
			<form action="" method="POST">
				<!-- IME I PREZIME -->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_imePrezime']; ?>: </div>
				<input type="text" class="input_no_error" name="ime_prezime"/> 

				<!-- ZANIMANJE-->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_zanimanje']; ?>: </div>
				<input type="text" class="input_no_error" name="zanimanje"/> 

				<!-- MJESTO STANOVANJA -->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_sadasnjaAdresa']; ?>: </div>
				<input type="text" class="input_no_error" name="mjesto_stanovanje"/> 

				<!-- KONTAKT TELEFON -->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_kontaktTelefon']; ?>: </div>
				<input type="text" class="input_no_error" name="kontakt_telefon"/> 

				<!-- KONTAKT TELEFON -->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_email']; ?>: </div>
				<input type="text" class="input_no_error" name="email"/> 

				<!-- ZDRASTVENE NAPOMENE -->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_zdrastveneNapomene']; ?>: </div>
				<textarea class="unosOpis" name="zdrastvene_napomene" cols="" rows="" ></textarea>
				<div style="clear:both"></div>

				<!-- JEZIK GOVORA -->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_jezik']; ?>: </div>
				<input type="text" class="input_no_error" name="jezik"/> 

				<!-- DATUM RODJENJA -->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_datumRodjenja']; ?>: </div>
				<input type="text" class="input_no_error_dan" name="rodjenje_dan" maxlength="2" /> 
				<select id="datum_rodjenja" name="rodjenje_mjesec">
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
				<input type="text" class="input_no_error_dan" name="rodjenje_godina" maxlength="4" /> 
				<div style="clear:both"></div>

				<!-- MJESTO RODJENJA -->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_mjestoRodjenja']; ?>: </div>
				<input type="text" class="input_no_error" name="mjesto_rodjenja"/> 

				<!-- NACIONALNOST -->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_nacionalnost']; ?>: </div>
				<input type="text" class="input_no_error" name="nacionalnost"/> 

				<!-- POL -->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_pol']; ?>: </div>
				<select class="dropDown" name="pol">
					<option value="m"><?php echo getPol('m'); ?></option>
					<option value="z"><?php echo getPol('z'); ?></option>
					<option value="d"><?php echo getPol('d'); ?></option>
				</select>
				<div style="clear:both"></div>

				<!-- BROJ PASOSA -->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_brojPasosa']; ?>: </div>
				<input type="text" class="input_no_error" name="broj_pasosa"/> 

				<!-- PASOS KADA IZDAT I OD KOGA -->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_izdataKadaIOdKoga']; ?>: </div>
				<input type="text" class="input_no_error" name="pasos_kadaIzdat"/> 

				<!-- PASOS VAZI DO -->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_vaziDO']; ?>: </div>
				<input type="text" class="input_no_error" name="pasos_doKadTraje"/> 

				<!-- IME RODITELJA -->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_imeRoditelja']; ?>: </div>
				<input type="text" class="input_no_error" name="ime_roditelja"/> 

				<!-- PREDHODNO VOLONTERSKO ISKUSTVO -->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_predhodnoVolonterskoIskustvo']; ?>: </div>
				<textarea class="unosOpis" name="predhodno_volonterskoIskustvo" cols="" rows="" ></textarea>
				<div style="clear:both"></div>

				<!-- KAMPOVI -->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_kampoviOdabira']; ?>: </div>
				<select class="dropDown" name="kamp1">
					<option value="no_kamp">Kamp 1</option>
					<?php echo $options_kamp; ?>
				</select>
				<select class="dropDown" name="kamp2">
					<option value="no_kamp">Kamp 2</option>
					<?php echo $options_kamp; ?>
				</select>
				<select class="dropDown" name="kamp3">
					<option value="no_kamp">Kamp 3</option>
					<?php echo $options_kamp; ?>
				</select>
				<select class="dropDown" name="kamp4">
					<option value="no_kamp">Kamp 4</option>
					<?php echo $options_kamp; ?>
				</select>
				<select class="dropDown" name="kamp5">
					<option value="no_kamp">Kamp 5</option>
					<?php echo $options_kamp; ?>
				</select>
				<select class="dropDown" name="kamp6">
					<option value="no_kamp">Kamp 6</option>
					<?php echo $options_kamp; ?>
				</select>
				<div style="clear:both"></div>

				<!-- PREUZMI DRUGI AKO SU NAVEDENI PUNI -->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_preuzmiDrugiAkoJePun']; ?>: </div>
				<input type="checkbox" name="preuzmi_drugi" checked="checked"/> Da
				<div style="clear:both"></div>

				<!-- TIPOVI PROJEKATA -->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_tipoviProjekata']; ?>: </div>
				<select class="dropDown" name="omiljeni_projekat">
					<?php
						if(isset($tipovi_kampova)){
							while($tp = mysql_fetch_array($tipovi_kampova, MYSQL_ASSOC)){
								echo "<option value=\"".$tp['oznaka']."\">(".$tp['oznaka'].") ". getTipKampa($tp['oznaka']) ."</option>";
							}
						}
					?>
				</select>
				<div style="clear:both"></div>

				<!-- ZBOG CEGA ZELITE DA VOLONTIRATE -->
				<div class="unos_naslov"><?php echo $_jezik['vefForma_stranica_zbogCegaZeliteVolonterskeProjekte']; ?>: </div>
				<textarea class="unosOpis" name="zbog_cega" cols="" rows="" ></textarea>
				<div style="clear:both"></div>

				<input type="submit" name="submit"/>
			</form>
			</div><!-- /lijeva_stana_unos-->
		</div><!--/lijeva_stana_unos-->
	</div><!--registracija_sekcija-->

	<?php include('engine/sekcije/_kontakt_futer.php'); ?>
</body>
</html>