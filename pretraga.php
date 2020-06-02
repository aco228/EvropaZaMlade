<?php
	require("engine/init.php");


	ukljuci_bazu(); $db = new BazaPodataka();

	if(!isset($_GET['kljuc']) || empty($_GET['kljuc']) || !isset($_GET['str']) || empty($_GET['str']) || !is_numeric($_GET['str'])) header("Location: index.php");
	$str = $_GET['str']; if($str <= 0) header("Location: index.php");
	$kljuc = mysql_real_escape_string($_GET['kljuc']);

	$db->q("SELECT COUNT(*) AS br FROM novost WHERE naslov LIKE '%".$kljuc."%' OR opis LIKE '%".$kljuc."%' OR tekst LIKE '%".$kljuc."%';"); $ukupanBrojStranica = $db->db_F['br'];
	$db->q("SELECT COUNT(*) AS br FROM kamp WHERE ime_kampa LIKE '%".$kljuc."%' OR zemlja LIKE '%".$kljuc."%' OR organizacija LIKE '%".$kljuc."%' OR lokacija_kampa LIKE '%".$kljuc."%' OR lokacija_kampa LIKE '%".$kljuc."%' OR jezik_kampa LIKE '%".$kljuc."%' OR dodatniTroskovi LIKE '%".$kljuc."%' OR opis_kampa LIKE '%".$kljuc."%' OR opis_posla LIKE '%".$kljuc."%' OR dodatne_info LIKE '%".$kljuc."%';"); $ukupanBrojStranica += $db->db_F['br'];
	$db->q("SELECT COUNT(*) AS br FROM clan WHERE username LIKE '%".$kljuc."%';"); $ukupanBrojStranica += $db->db_F['br'];

	$data = $db->qMul(" (SELECT 'novost' as tip, 'novost' as link, naslov, opis, adresa_slike as slika, idn as id, 'null' AS zemlja FROM novost WHERE naslov LIKE '%".$kljuc."%' OR opis LIKE '%".$kljuc."%' OR tekst LIKE '%".$kljuc."%')
							UNION ALL
						(SELECT 'kamp' as tip, 'id' as link, ime_kampa as naslov, opis_kampa as opis, '' as slika, intk AS id, zemlja FROM kamp WHERE ime_kampa LIKE '%".$kljuc."%' OR zemlja LIKE '%".$kljuc."%' OR organizacija LIKE '%".$kljuc."%' OR lokacija_kampa LIKE '%".$kljuc."%' OR lokacija_kampa LIKE '%".$kljuc."%' OR jezik_kampa LIKE '%".$kljuc."%' OR dodatniTroskovi LIKE '%".$kljuc."%' OR opis_kampa LIKE '%".$kljuc."%' OR opis_posla LIKE '%".$kljuc."%' OR dodatne_info LIKE '%".$kljuc."%')
						");

	$ukupanBrojStranica = ceil($ukupanBrojStranica/25);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title><?php echo $_jezik['pretraga_naslov']; ?></title>
    <script src="js/_jQuery.js"></script>
    <script src="js/_jQueryUI.js"></script>
    <script src="js/main.js" type="text/javascript"></script>
    <script src="js/pretraga.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/pretraga.css"/>
</head>
<script type="text/javascript">
	var str = <?php echo $str; ?>;
	var kljuc = "<?php echo $kljuc; ?>";
</script>
<body>
	<?php include('engine/sekcije/_header.php'); ?>

	<div id="_naslov_naslov"><?php echo $_jezik['pretraga_naslov']; ?></div>

	<div class="novosti_sekcija">
		<div class="content">
			<div class="unos_naslov"><?php echo $_jezik['pretraga_naslov']; ?>:</div>
				<input type="text" class="input_no_error" id="unos_Username" name="kljucnaRijec" value="<?php echo $_jezik['kamp_kljucnaRijec']; ?>"/> 
				<div style="clear:both"></div>
				<input type="submit" name='submit' id="btnPotvrdi" value="<?php echo $_jezik['admin_slika_postaviNovuSliku_potvrdi'];?>"/> 
		</div>

		<div class="content">
			<div class="unos_naslov"><?php echo $_jezik['kamp_contentRezultatiPretrage']; ?>:</div><br/>

			<?php
				$start = ($str-1)*25; $i = 0; $finish = $start + 25;
				while($dt = mysql_fetch_array($data, MYSQL_ASSOC)){
					if($i >= $start){
						$slika = "background-image: url('".$dt['slika']."')";
						if($dt['tip']=="kamp") $slika = "background-image: url('slike/zastave/Velike/".$dt['zemlja'].".png')";
						echo "	<div class=\"blok\" id=\"".$dt['tip'].".php?".$dt['link']."=".$dt['id']."\">
									<div class=\"blok_slika\" style=\"".$slika."\"></div>
									<div class=\"blok_detail_".$dt['tip']."\">".getPretragaNaslov($dt['tip'])."</div>
									<div class=\"blok_naslov\">".$dt['naslov']."</div>
									<div class=\"blok_opis\">".$dt['opis']."</div>
								</div>";
					}
					if($i==$finish) break;
					$i++;
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