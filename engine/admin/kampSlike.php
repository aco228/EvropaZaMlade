<?php
	$db = new BazaPodataka();

	if(isset($_POST['potvrdi'])){
		$db->e("DROP TABLE IF EXISTS kamp_background;");
		$db->e("CREATE TABLE kamp_background(
					idkb int primary key auto_increment,
					adresa text
				);");

		for($i = 0; $i < 300; $i++){
			if(isset($_POST[$i]) && !empty($_POST[$i])) $db->e("INSERT INTO	kamp_background (adresa) VALUES ('".$_POST[$i]."');");
		}
	}
	$linkovi = $db->qMul("SELECT adresa FROM kamp_background ORDER BY idkb DESC;", true);
	$br = $db->Num;
?>
<style type="text/css">
	.boks{
		background-color: #E9E7E7;;
		margin-bottom: 5px;
		height: 50px;
		padding: 10px;
	}
	.boks a{
		color:#000;
	}
	.boks input[type=text] {width: 350px;}
	#sekcija input[type=text] {width: 850px;}
	.boks_slika{
		float:left;
		width: 100px;
		height: 50px;
		background-size: cover;
		margin-right: 15px;
	}
	input[type=submit]{
		background-color:rgb(92, 95, 255);
		border: 1px solid #4347ff;
		padding: 5px; padding-left: 10px; padding-right: 10px;
		color:#FFF;
		-moz-border-radius: 5px;
		border-radius: 5px;
		cursor:hand; cursor:pointer;
		margin-right: 1px;
	}
	#dodajSliku{
		font-weight: bold;
		cursor: hand; cursor: pointer;
		font-size: 12pt;
		margin-bottom: 20px;
	}
</style>

<script type="text/javascript">
var br = <?php echo $br; ?>; br++;
$(document).ready(function(){
	$('#dodajSliku').click(function(){
		if(br>300) return;
		$('#sekcija').prepend("<input type=\"text\" name=\""+br+"\" /> ");
		br++;
	});
});
</script>

<form action="" method="post">
	<span>Brisanje slike se radi tako sto izbrisete link te slike i kliknete potvrdi!</span>
	<div id="dodajSliku">Dodaj sliku</div>
	<div id="sekcija">
		<?php
			$brI = 0;
			while($r = mysql_fetch_array($linkovi, MYSQL_ASSOC)){
				echo "<div class=\"boks\">
						<div class=\"boks_slika\" style=\"background-image:url(".$r['adresa'].");\"></div>
						<input type=\"text\" name=\"".$brI."\" value=\"".$r['adresa']."\"/> <br />
						<a href=\"".$r['adresa']."\" target=\"_BLANK\">Link</a>
					</div>";
					$brI++;
			}
		?> <!--
		<div class="boks">
			<div class="boks_slika" style="background-image:url(http://barcelona-home.com/cms/wp-content/uploads/2012/09/hoteles-en-barcelona-confortel.jpg);"></div>
			<input type="text" name="0"/> <br />
			<a href="http://barcelona-home.com/cms/wp-content/uploads/2012/09/hoteles-en-barcelona-confortel.jpg" target="_BLANK">Link</a>
		</div>-->
	</div>

	<input type="submit" value="Potvrdi" name="potvrdi" />
</form>