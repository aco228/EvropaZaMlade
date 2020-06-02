<?php
	require("engine/init.php");
	$str = 1;

	ukljuci_bazu(); $db = new BazaPodataka();
	// PREUZIMAnJE BROJA STRANICA
	$br = $db->q("SELECT COUNT(*) AS br FROM novost WHERE koristi_novost='da';");
	$ukupanBrojStranica = ceil($br['br'] / 10);
	if(isset($_GET['str']) && !empty($_GET['str']) && is_numeric($_GET['str']) && $str <= $ukupanBrojStranica) $str = $_GET['str'];

	// PREZIMANJE PODATAKA
	$strMul = ($str-1)*10;
	$data = $db->qMul("SELECT idn, naslov, opis, adresa_slike, datumDan, datumMjesec, datumGodina FROM novost WHERE koristi_novost='da' ORDER BY idn DESC LIMIT ". $strMul .", 10;");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title><?php echo $_jezik['novosti_naslov'];?></title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/main.js" type="text/javascript"></script>
    <script src="js/novosti.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/novosti.css"/>
    <script type="text/javascript">
    	var str =<?php echo $str; ?>;
    </script>
</head>
<body>
	<?php include('engine/sekcije/_header.php'); ?>

	<div id="_naslov_naslov"><?php echo $_jezik['novosti_naslov'];?></div>

	<div class="novosti_sekcija">
		<div id="content">
			<?php
				while($r = mysql_fetch_array($data)){
					echo "<div class=\"blok\" id=\"novost=". $r['idn']."\">
								<div class=\"blok_slika\" style=\"background-image: url('". $r['adresa_slike'] ."')\"></div>
								<div class=\"blok_detail\">".$r['datumDan'] . ' '; echo getMjesec($r['datumMjesec']) . ' '; echo $r['datumGodina']."</div>
								<div class=\"blok_naslov\">".$r['naslov']."</div>
								<div class=\"blok_opis\">". $r['opis'] ."</div>
						  </div>";
				}
			?>

		</div><!--/content-->	
		<div id="navigacija">
			<?php
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
			?>
	</div><!--/novost_tekst-->

	<?php include('engine/sekcije/_kontakt_futer.php'); ?>
</body>
</html>