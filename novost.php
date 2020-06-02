<?php
	require("engine/init.php"); $nemaGet = false;
	if(!isset($_GET['novost']) || empty($_GET['novost'])) $nemaGet = true;
	if(!isset($_POST['novost']) || empty($_POST['novost'])) if($nemaGet) header("Location: index.php");
	ukljuci_bazu();
	$db = new BazaPodataka();

	//
	//	PROMJENA NOVOSTI
	//
	if(isset($_POST['naslov']) && !empty($_POST['naslov']) && isset($_POST['opis']) && !empty($_POST['opis']) && isset($_POST['tekst']) && !empty($_POST['tekst'])){
		$naslov = mysql_real_escape_string($_POST['naslov']);
		$opis = mysql_real_escape_string($_POST['opis']);
		$tekst = mysql_real_escape_string($_POST['tekst']);

		$db->e("UPDATE novost SET naslov='". $naslov ."', opis='". $opis ."', tekst='". $tekst ."' WHERE idn=".$_POST['novost'].";");
		echo "Promjena uspješno izvršena!";
		die();
	}

	$data = $db->q("SELECT COUNT(*) as br, naslov, opis, tekst, adresa_slike, server_slika, autor, datumDan, datumMjesec, datumGodina FROM novost WHERE idn='". $_GET['novost'] ."';");
	if($data['br'] != 1) header("Location: index.php");

	// BRISANJE NOVOSTI
	if(isset($_GET['op']) && $_GET['op']==='op' && $_SESSION['ad']==='ok'){
		// Brisanje Slike
		if($data['server_slika']=='da' && file_exists($data['adresa_slike'])) unlink($data['adresa_slike']);

		// Brisanje novosti
		$db->e("DELETE FROM novost WHERE idn='". $_GET['novost'] ."';");

		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title><?php echo $data['naslov']; ?></title>
    <script src="js/_jQuery.js"></script>
    <script src="js/_jQueryUI.js"></script>
    <script src="js/main.js" type="text/javascript"></script>
    <script src="ekstra/plugins/autosize/jquery.autosize-min.js"></script>
    <script src="js/novost.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/novost.css"/>
    <script type="text/javascript">var ID=<?php echo "'" . $_GET['novost'] . "'"; ?>;</script>
</head>
<body>
	<?php include('engine/sekcije/_header.php'); ?>

	<div id="_naslov_naslov"><?php echo $_jezik['novost_naslov'];?> → <?php echo $data['naslov']; ?></div>

	<!-- MENU NOVOST-->
	<div class="novost_meni"> 
		<?php 
			if(isset($_SESSION['user']) && isset($_SESSION['ad']) && $_SESSION['ad']=='ok'){
				echo "<input type=\"button\" id=\"btn_promjeni\" value=\"" . $_jezik['novost_btnPromjeni'] ."\" />";
				echo "<input type=\"button\" id=\"dellon\" value=\"" . $_jezik['novost_btnIzbrisi'] ."\" />";
			}
		?>
	</div><!-- /novosr_meni-->

	<div class="novost_tekst_sekcija">
		<div id="novost_tekst">

			<div id="promjena_novosti">
				<input type="text" id="pNaslov" class="promjena_line" value="<?php echo $data['naslov']; ?>"/>
				<input type="text" id="pOpis" class="promjena_line" value="<?php echo $data['opis']; ?>"/>
				<textarea id="promjena_tekst"><?php echo $data['tekst']; ?></textarea>
				<input type="button" value="Sačuvaj" id="btn_save" />
			</div>

			<div class="novosti_tekst_slika_naslov" style="background-image: url('<?php echo $data['adresa_slike'];?>');">
				<div id="_autor"><?php echo $data['autor'] . " ( " .$data['datumDan'] . " " . getMjesec($data['datumMjesec']) . " " . $data['datumGodina'] . " )"; ?></div>
				<div id="_naslov"><?php echo $data['naslov']; ?></div>
				<div id="_opis"><?php echo $data['opis']; ?></div>
			</div><!--/novost_teskt-slika-naslov-->
			
			<div id="tekst_novosti">
				<?php echo nl2br(stripcslashes($data['tekst'])); ?>
			</div>
			
		</div><!--novost_tekst-->

		
	</div><!--/novost_tekst_sekcija-->

	<?php include('engine/sekcije/_kontakt_futer.php'); ?>
</body>
</html>