<?php 
	$greska = "";

	$db = new BazaPodataka();

	// POSTAVLJANJE NOVOG KAMPA
	if(isset($_POST['submit'])){
		$imeKampa = "";
		$kodKampa = "";
		$tipKampa = "";
		$zemlja = 0;
		$organizacija = "";
		$lokacijaKampa = "";
		$regijaKampa = "";
		$jezikKampa = "";
		$pocetakDan = -1;
		$pocetakMjesec = -1;
		$pocetakGodina = -1;
		$krajDan = -1;
		$krajMjesec = -1;
		$krajGodina = -1;
		$ukupanBrojVolontera = "";
		$dodatniTroskovi = "";
		$minimumGodina = "";
		$maksimumGodina = "";
		$opisKampa = "";
		$opisPosla = "";
		$opisLokacije = "";
		$opisPotreba = "";
		$dodatneInfo = "";

		/*
			 PROVJERA UNOSA
		*/
		if($greska=="" && isset($_POST['imeKampa']) && !empty($_POST['imeKampa'])){ $imeKampa = mysql_real_escape_string($_POST['imeKampa']); }
		if($imeKampa=="") $greska = $_jezik['kamp_greska'];
		if($greska=="" && isset($_POST['kodKampa']) && !empty($_POST['kodKampa'])){ $kodKampa = mysql_real_escape_string($_POST['kodKampa']); }
		if($kodKampa=="") $greska = $_jezik['kamp_greska'];
		if($greska=="" && isset($_POST['tipKampa']) && !empty($_POST['tipKampa'])){ $tipKampa = mysql_real_escape_string($_POST['tipKampa']); }
		if($greska=="" && isset($_POST['zemljaKampa']) && !empty($_POST['zemljaKampa'])){ $zemlja = mysql_real_escape_string($_POST['zemljaKampa']); }
		if($greska=="" && isset($_POST['organizacija']) && !empty($_POST['organizacija'])){ $organizacija = mysql_real_escape_string($_POST['organizacija']); }
		if($greska=="" && isset($_POST['lokacijaKampa']) && !empty($_POST['lokacijaKampa'])){ $lokacijaKampa = mysql_real_escape_string($_POST['lokacijaKampa']); }
		if($lokacijaKampa=="") $greska = $_jezik['kamp_greska'];
		if($greska=="" && isset($_POST['regijaKampa']) && !empty($_POST['regijaKampa'])){ $regijaKampa = mysql_real_escape_string($_POST['regijaKampa']); }
		if($greska=="" && isset($_POST['jezikKampa']) && !empty($_POST['jezikKampa'])){ $jezikKampa = mysql_real_escape_string($_POST['jezikKampa']); }
		if($jezikKampa=="") $greska = $_jezik['kamp_greska'];
		// POCETAK
			if($greska=="" && isset($_POST['pocetakDan']) && !empty($_POST['pocetakDan'])){ $pocetakDan = mysql_real_escape_string($_POST['pocetakDan']); }
			if($pocetakDan==-1 || !is_numeric($pocetakDan)) $greska = $_jezik['kamp_greska'];
			if($greska=="" && isset($_POST['pocetakMjesec']) && !empty($_POST['pocetakMjesec'])){ $pocetakMjesec = mysql_real_escape_string($_POST['pocetakMjesec']); }
			if($greska=="" && isset($_POST['pocetakGodina']) && !empty($_POST['pocetakGodina'])){ $pocetakGodina = mysql_real_escape_string($_POST['pocetakGodina']); }
			if($pocetakGodina==-1 || !is_numeric($pocetakGodina)) $greska = $_jezik['kamp_greska'];
		// KRAJ ***
			if($greska=="" && isset($_POST['krajDan']) && !empty($_POST['krajDan'])){ $krajDan = mysql_real_escape_string($_POST['krajDan']); }
			if($krajDan==-1 || !is_numeric($krajDan)) $greska = $_jezik['kamp_greska'];
			if($greska=="" && isset($_POST['krajMjesec']) && !empty($_POST['krajMjesec'])){ $krajMjesec = mysql_real_escape_string($_POST['krajMjesec']); }
			if($greska=="" && isset($_POST['krajGodina']) && !empty($_POST['krajGodina'])){ $krajGodina = mysql_real_escape_string($_POST['krajGodina']); }
			if($krajGodina==-1 || !is_numeric($krajGodina)) $greska = $_jezik['kamp_greska'];
		if($greska=="" && isset($_POST['ukupanBrojVolontera']) && !empty($_POST['ukupanBrojVolontera'])){ $ukupanBrojVolontera = mysql_real_escape_string($_POST['ukupanBrojVolontera']); }
		if($greska=="" && isset($_POST['dodatniTroskovi']) && !empty($_POST['dodatniTroskovi'])){ $dodatniTroskovi = mysql_real_escape_string($_POST['dodatniTroskovi']); }
		if($greska=="" && isset($_POST['minimumGodina']) && !empty($_POST['minimumGodina'])){ $minimumGodina = mysql_real_escape_string($_POST['minimumGodina']); }
		if($greska=="" && isset($_POST['maksimumGodina']) && !empty($_POST['maksimumGodina'])){ $maksimumGodina = mysql_real_escape_string($_POST['maksimumGodina']); }
		if($greska=="" && isset($_POST['opisKampa']) && !empty($_POST['opisKampa'])){ $opisKampa = mysql_real_escape_string($_POST['opisKampa']); }
		if($greska=="" && isset($_POST['opisPosla']) && !empty($_POST['opisPosla'])){ $opisPosla = mysql_real_escape_string($_POST['opisPosla']); }
		if($greska=="" && isset($_POST['opisLokacije']) && !empty($_POST['opisLokacije'])){ $opisLokacije = mysql_real_escape_string($_POST['opisLokacije']); }
		if($greska=="" && isset($_POST['opisPotreba']) && !empty($_POST['opisPotreba'])){ $opisPotreba = mysql_real_escape_string($_POST['opisPotreba']); }
		if($greska=="" && isset($_POST['dodatneInfo']) && !empty($_POST['dodatneInfo'])){ $dodatneInfo = mysql_real_escape_string($_POST['dodatneInfo']); }

		// UBACIVANJE U BAZU
		if($greska==""){
			$db->q("SELECT COUNT(*) AS br FROM kamp WHERE kod_kampa='".$kodKampa."';");
			if($db->db_F['br'] == 0){
				$db->q("SELECT ime_zemlje FROM zemlje WHERE idz=".$zemlja.";");
				$zemlja = $db->db_F['ime_zemlje'];
				
				$db->e("INSERT INTO kamp (ime_kampa, kod_kampa, zemlja, organizacija, lokacija_kampa, regija_kampa, jezik_kampa, tip_kampa, pocetakDan, pocetakMjesec, pocetakGodina, krajDan, krajMjesec, krajGodina, ukupanBrojVolontera, dodatniTroskovi, minimumGodina, maksimumGodina, opis_kampa, opis_posla, opis_lokacije, opis_potreba, dodatne_info) VALUES (
						'".$imeKampa."',
						'".$kodKampa."',
						'".$zemlja."',
						'".$organizacija."',
						'".$lokacijaKampa."',
						'".$regijaKampa."',
						'".$jezikKampa."',
						'".$tipKampa."',
						'".$pocetakDan."',
						'".$pocetakMjesec."',
						'".$pocetakGodina."',
						'".$krajDan."',
						'".$krajMjesec."',
						'".$krajGodina."',
						'".$ukupanBrojVolontera."',
						'".$dodatniTroskovi."',
						'".$minimumGodina."',
						'".$maksimumGodina."',
						'".$opisKampa."',
						'".$opisPosla."',
						'".$opisLokacije."',
						'".$opisPotreba."',
						'".$dodatneInfo."'
					)");

				$id = $db->q("SELECT intk FROM kamp WHERE ime_kampa='".$imeKampa."' AND kod_kampa='".$kodKampa."';");
				echo "<a href=\"kamp.php?id=" . $id['intk'] . "\" target=\"_blank\"> Kamp ID=" . $id['intk'] . "</a>";
			} else $greska = $_jezik['kamp_btn_greska_postojiKod'];
		}

	}

	// Trazenje zastarelih kampova
	$danasnjiDan = date('j'); $danasnjiMjesec = date('n'); $danasnjaGodina = date('Y');
	$ovajDan = $db->q("SELECT COUNT(*) AS br FROM kamp WHERE krajDan<" . $danasnjiDan . " AND krajMjesec=" . $danasnjiMjesec ." AND krajGodina=". $danasnjaGodina.";");
	$ovajMjesec = $db->q("SELECT COUNT(*) AS br FROM kamp WHERE krajMjesec<" . $danasnjiMjesec ." AND krajGodina=". $danasnjaGodina.";");
	$ovajGodina = $db->q("SELECT COUNT(*) AS br FROM kamp WHERE krajGodina<". $danasnjaGodina.";");
	$ukupnoNeaktivnih = $ovajDan['br'] + $ovajMjesec['br'] + $ovajGodina['br'];
	// Brisanje neaktivnih kampova
	if(isset($_POST['delete'])) {
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
		$ukupnoNeaktivnih = 0;
	}

	$drzave = $db->qMul("SELECT idz, ime_zemlje FROM zemlje;");
	$tipovi_kampova = $db->qMul("SELECT oznaka FROM tip_kampa;");

	if($greska!=""){
		print '<script type="text/javascript">'; 
		print 'alert("'. $greska.'")'; 
		print '</script>';
	} 
?>
<style>
	/* LIJEVA STANA UNOS */
			#lijeva_strana_unos{
				float:left;
				width: 60%;
				background-color:#dbdcfe;
				border:1px solid #b8baff;
				padding: 15px;
			}
			.unos_naslov{
				text-transform: uppercase;
				font-size: 11pt;
				margin-top: 12px; 
				color:#a0a0a0;
			}
			input[class=input_no_error]{
				width: 50%;
				height: 20px;
				padding: 2px;
				border:1px solid #b8baff;
				background-color: #f4f4ff;
			}

			#unos_Tekst{
				width: 50%;
				height: 350px;
				padding: 2px;
				border:1px solid #b8baff;
				background-color: #f4f4ff;
			}
			#btnPotvrdi{
				width: 25%;
				height: 35px;
				margin-top: 25px;
				border:1px solid #f4f4ff;
				background-color: #b8baff;
				cursor:hand; cursor:pointer;
			}
			.greska_unos{
				color:#b30000;
			}
			input[class=input_no_error_dan]{
				float:left;
				width: 16.5%;
				height: 20px;
				padding: 2px;
				border:1px solid #b8baff;
				background-color: #f4f4ff;
			}
			#datum_rodjenja{
				float:left;
				width: 16.5%;
				height: 26px;
				padding: 2px;
				border:1px solid #b8baff;
				background-color: #f4f4ff;
			}
			#tipKampa{
				float:left;
				width: 50%;
				height: 26px;
				padding: 2px;
				border:1px solid #b8baff;
				background-color: #f4f4ff;
			}
</style>
<form action="" method="post">
	<input type="submit" name='delete' id="btnPotvrdi" value="<?php echo $_jezik['kamp_btn_IzbrisiNeaktivneKampove'] . " (" . $ukupnoNeaktivnih . ")"; ?>"/>
</form>
<form action="" method="post" enctype="multipart/form-data">
	<!-- IME KAMPA -->
	<div class="unos_naslov"><?php echo $_jezik['kamp_imeKampa']; ?>: </div>
	<input type="text" class="input_no_error" id="unos_Naslov" name="imeKampa" maxlength="50" value=""/> 

	<!-- KOD KAMPA -->
	<div class="unos_naslov"><?php echo $_jezik['kamp_kodKampa'] ; ?>: </div>
	<input type="text" class="input_no_error" id="unos_Opis" name="kodKampa" maxlength="50" value="" /> 

	<!-- TIP KAMPA -->	
	<div class="unos_naslov"><?php echo $_jezik['kamp_tipKampa']; ?>: </div>
		<select id="tipKampa" name="tipKampa">
			<?php
				while($tpp = mysql_fetch_array($tipovi_kampova, MYSQL_ASSOC)){
					echo "<option value=\"". $tpp['oznaka'] ."\">(". $tpp['oznaka'] .") ". getTipKampa($tpp['oznaka']) ."</option>";
				}
			?>
		</select>
	<div style="clear:both"></div>

	<!-- ZEMLJA -->
	<div class="unos_naslov"><?php echo $_jezik['kamp_zemlja']; ?>: </div>
		<select id="tipKampa" name="zemljaKampa">
			<?php
				while($tpp = mysql_fetch_array($drzave, MYSQL_ASSOC)){
					echo "<option value=\"". $tpp['idz'] ."\">". $tpp['ime_zemlje'] ."</option>";
				}
			?>
		</select>
	<div style="clear:both"></div>

	<!-- ORGANIZACIJA -->
	<div class="unos_naslov"><?php echo $_jezik['kamp_organizacija']; ?>: </div>
	<input type="text" class="input_no_error" name="organizacija" maxlength="50"/> 

	<!-- LOKACIJA KAMPA -->
	<div class="unos_naslov"><?php echo $_jezik['kamp_lokacijaKampa']; ?>: </div>
	<input type="text" class="input_no_error" name="lokacijaKampa"  maxlength="100"/> 

	<!-- REGIJA KAMPA -->
	<div class="unos_naslov"><?php echo $_jezik['kamp_regijaKampa']; ?>: </div>
	<input type="text" class="input_no_error" name="regijaKampa" maxlength="100"/> 

	<!-- JEZIK KAMPA -->
	<div class="unos_naslov"><?php echo $_jezik['kamp_jezikKampa']; ?>: </div>
	<input type="text" class="input_no_error" name="jezikKampa" maxlength="50"/> 

	<!-- ADRESA SLIKE -->
	<div class="unos_naslov"><?php echo $_jezik['kamp_adresaSlike'] ; ?>: </div>
	<input type="text" class="input_no_error" name="adresaSlike"/> 

	<!-- -->

	<!-- POCETAK KAMPA -->
	<div class="unos_naslov"><?php echo $_jezik['kamp_pocetak']; ?>: </div>
	<input type="text" class="input_no_error_dan" id="unos_dan" maxlength="2" name="pocetakDan"/> 
		<select id="datum_rodjenja" name="pocetakMjesec">
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
	<input type="text" class="input_no_error_dan" id="unos_dan" name="pocetakGodina" maxlength="4" /> 
	<div style="clear:both"></div>

	<!-- KRAJ KAMPA -->
	<div class="unos_naslov"><?php echo $_jezik['kamp_kraj']; ?>: </div>
	<input type="text" class="input_no_error_dan" id="unos_dan" name="krajDan" maxlength="2" /> 
		<select id="datum_rodjenja" name="krajMjesec">
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
	<input type="text" class="input_no_error_dan" id="unos_dan" name="krajGodina" maxlength="4" /> 
	<div style="clear:both"></div>

	<!-- UKUPAN BROJ VOLONTERA -->
	<div class="unos_naslov"><?php echo $_jezik['kamp_ukupanBrojVolontera']; ?>: </div>
	<input type="text" class="input_no_error" name="ukupanBrojVolontera" maxlength="3"/> 

	<!-- DODATNI TROSKOVI -->
	<div class="unos_naslov"><?php echo $_jezik['kamp_dodatniTroskovi'] ; ?>: </div>
	<input type="text" class="input_no_error" name="dodatniTroskovi"  maxlength="50"/> 

	<!-- MINIMUM GODINA -->
	<div class="unos_naslov"><?php echo $_jezik['kamp_minimumGodina']; ?>: </div>
	<input type="text" class="input_no_error" name="minimumGodina" maxlength="20"/> 

	<!-- MAKSIMUM GODINA -->
	<div class="unos_naslov"><?php echo $_jezik['kamp_maksimumGodina']; ?>: </div>
	<input type="text" class="input_no_error" name="maksimumGodina" maxlength="20"/> 

	<!-- -->

	<!-- OPIS KAMPA -->
	<div class="unos_naslov"><?php echo $_jezik['kamp_opisKampa']; ?>: </div>
	<textarea id="unos_Tekst" cols="" rows="" name="opisKampa"></textarea>
	<div style="clear:both"></div>

	<!-- OPIS POSLA-->
	<div class="unos_naslov"><?php echo $_jezik['kamp_opisPosla']; ?>: </div>
	<textarea id="unos_Tekst" cols="" rows="" name="opisPosla"></textarea>
	<div style="clear:both"></div>

	<!-- OPIS LOKACIJE-->
	<div class="unos_naslov"><?php echo $_jezik['kamp_opisLokacije']; ?>: </div>
	<textarea id="unos_Tekst" cols="" rows="" name="opisLokacije"></textarea>
	<div style="clear:both"></div>

	<!-- OPIS POTREBA-->
	<div class="unos_naslov"><?php echo $_jezik['kamp_opisPotreba']; ?>: </div>
	<textarea id="unos_Tekst" cols="" rows="" name="opisPotreba"></textarea>
	<div style="clear:both"></div>

	<!-- DODATNE INFORMACIJE -->
	<div class="unos_naslov"><?php echo $_jezik['kamp_dodatneInfo']; ?>: </div>
	<textarea id="unos_Tekst" cols="" rows="" name="dodatneInfo"></textarea>
	<div style="clear:both"></div>

	<input type="submit" name='submit' id="btnPotvrdi"/> <label class="greska_unos" id="err_btnPotvrdi"><?php echo $greska; ?></label>
</form>