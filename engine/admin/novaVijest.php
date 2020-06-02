<?php 

	$naslov = "";
	$opis = "";
	$tekst = "";
	$adresa_slike = "";
	$greska = "";
	$db = new BazaPodataka();

	if(isset($_POST['submit'])) {
			// Korak 1. Provjera inicijalnog unosa
	   		$naslov = $_POST['naslov']; if(empty($naslov)) { $greska = $_jezik['registracija_admin_vijest_greska_prazanNaslov']; } 
			$opis = $_POST['opis'];     if($greska==="" && empty($opis)) { $greska = $_jezik['registracija_admin_vijest_greska_prazanOpis']; } 
			$tekst = $_POST['tekst'];   if($greska==="" && empty($tekst)) { $greska = $_jezik['registracija_admin_vijest_greska_prazanTekst']; } 

			// Korak 2. Provjera Slike
			if($greska===""){
				$server_slika = false;
				if(isset($_POST['adresa']) && !empty($_POST['adresa'])) { $adresa_slike = mysql_real_escape_string($_POST['adresa']); $server_slika = "ne"; }
				else if (is_uploaded_file($_FILES['slika']['tmp_name'])) { 
					$exe = explode('.', $_FILES['slika']['name']); $exe = end($exe);
					if(provjeraSlike($_FILES['slika']['name'])) $greska = $_jezik['registracija_admin_vijest_greska_slikaEkstenzija'];
					else if ($_FILES['slika']['size'] > 2621440) $greska = $_jezik['registracija_admin_vijest_greska_slikaVelicina'];
					else{
						$adresa_slike = "slike/novosti/" . substr(str_shuffle(MD5(microtime())), 0, 20) . '.' . $exe;
						move_uploaded_file($_FILES['slika']['tmp_name'], $adresa_slike);
					}
					$server_slika = "da";
				}  else {
					$greska = $_jezik['registracija_admin_vijest_greska_slikaNepostoji'];
				}
			}
			
			// Korak 3. Unos podataka
			if($greska===""){
				$datumDan = date('j');
				$datumMjesec = date('n');
				$datumGodina = date('Y');
				$autor = $_SESSION['user'];

	   			$naslov = mysql_real_escape_string($naslov);
				$opis = mysql_real_escape_string($opis); 
				$tekst = mysql_real_escape_string($tekst); 

				if(isset($_POST['koristiNovost'])) $koristiNovost = 'da';
				else $koristiNovost = 'ne';

				$db->e("INSERT INTO novost (naslov, opis, tekst, adresa_slike, server_slika, autor, datumDan, datumMjesec, datumGodina, koristi_novost) VALUES (
							'". $naslov ."',
							'". $opis ."',
							'". $tekst ."',
							'". $adresa_slike ."',
							'". $server_slika ."',
							'". $autor ."',
							'". $datumDan ."',
							'". $datumMjesec ."',
							'". $datumGodina ."',
							'". $koristiNovost ."'
					   )");

				$a = $db->q("SELECT idn FROM novost WHERE naslov='".$naslov."' AND opis='".$opis."';");
				echo "<a href=\" novost.php?novost=".$a['idn'] . "\">novost.php?novost=".$a['idn'] . "</a>";

				$naslov = "";
				$opis = "";
				$tekst = "";
				$greska = $_jezik['registracija_admin_vijest_greska_uspjesno'];
			}
	}
function provjeraSlike($path){		
	// Provjera ekstenzije
	$dozvoljene = array("jpg", "png");	
	foreach($dozvoljene as $d) { if($path === $d) return true; }
	return false;
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
</style>

<form action="" method="post" enctype="multipart/form-data">
	<!-- NASLOV -->
	<div class="unos_naslov"><?php echo $_jezik['registracija_admin_vijest_naslov']; ?>: </div>
	<input type="text" class="input_no_error" id="unos_Naslov" name="naslov" maxlength="30" value="<?php echo $naslov; ?>"/> 

	<!-- KRATAK OPIS -->
	<div class="unos_naslov"><?php echo $_jezik['registracija_admin_vijest_opis']; ?>: </div>
	<input type="text" class="input_no_error" id="unos_Opis" name="opis" maxlength="130" value="<?php echo $opis; ?>" /> 

	<!-- SLIKA ODABIR -->
	<div class="unos_naslov"><?php echo $_jezik['registracija_admin_vijest_imgWeb']; ?>: </div>
	<input type="text" class="input_no_error" name="adresa"/> 

	<!-- Upload Slike -->
	<div class="unos_naslov"><?php echo $_jezik['registracija_admin_vijest_imgComp']; ?>: </div>
	<input type="file" class="input_no_error" name="slika"/> 

	<!-- KORISTI VIJEST -->
	<div class="unos_naslov"><?php echo $_jezik['registracija_admin_vijest_koristiNovost'] ; ?>: </div>
	<input type="checkbox" name="koristiNovost" checked="checked"/> 

	<!-- TEKST VIJESI -->
	<div class="unos_naslov"><?php echo $_jezik['registracija_admin_vijest_tekst']; ?>: </div>
	<textarea id="unos_Tekst" cols="" rows="" name="tekst"><?php echo $tekst; ?></textarea>
	<div style="clear:both"></div>


	<input type="submit" name='submit' id="btnPotvrdi"/> <label class="greska_unos" id="err_btnPotvrdi"><?php echo $greska; ?></label>
</form>