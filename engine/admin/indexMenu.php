<?php
	$db = new BazaPodataka();
	$poruka = "";

	if(isset($_POST['submit']) && isset($_POST['prviNaslov']) && !empty($_POST['prviNaslov']) && isset($_POST['prviTekst']) && !empty($_POST['prviTekst']) && isset($_POST['prviLink']) && !empty($_POST['prviLink'])
		 					   && isset($_POST['drugiNaslov']) && !empty($_POST['drugiNaslov']) && isset($_POST['drugiTekst']) && !empty($_POST['drugiTekst']) && isset($_POST['drugiLink']) && !empty($_POST['drugiLink'])
 							   && isset($_POST['treciNaslov']) && !empty($_POST['treciNaslov']) && isset($_POST['treciTekst']) && !empty($_POST['treciTekst']) && isset($_POST['treciLink']) && !empty($_POST['treciLink'])
 	){
 		$prviNaslov = mysql_real_escape_string($_POST['prviNaslov']);
 		$prviTekst = mysql_real_escape_string($_POST['prviTekst']);
 		$prviLink = mysql_real_escape_string($_POST['prviLink']);
 		$drugiNaslov = mysql_real_escape_string($_POST['drugiNaslov']);
 		$drugiTekst = mysql_real_escape_string($_POST['drugiTekst']);
 		$drugiLink = mysql_real_escape_string($_POST['drugiLink']);
 		$treciNaslov = mysql_real_escape_string($_POST['treciNaslov']);
 		$treciTekst = mysql_real_escape_string($_POST['treciTekst']);
 		$treciLink = mysql_real_escape_string($_POST['treciLink']);

		$db->e("UPDATE indeks_admin SET prvi_naslov='".$prviNaslov."', prvi_tekst='".$prviTekst."', prvi_link='".$prviLink."', 
										drugi_naslov='".$drugiNaslov."', drugi_tekst='".$drugiTekst."', drugi_link='".$drugiLink."',
										treci_naslov='".$treciNaslov."', treci_tekst='".$treciTekst."', treci_link='".$treciLink."';");
		//Brisanje kompletnih linkova
		$db->e("DROP TABLE IF EXISTS indeks_menu;"); 
		$db->e("CREATE TABLE indeks_menu(idim int primary key auto_increment,pripadnost int not null,naslov varchar(50) not null,link varchar(50) not null)DEFAULT charset utf8;");

		for($i1 = 1; $i1 < 21; $i1++){
			if(isset($_POST['n1_naslov_' . $i1]) && isset($_POST['n1_link_' . $i1]) && !empty($_POST['n1_naslov_' . $i1]) && !empty($_POST['n1_link_' . $i1])){
				$n1n = mysql_real_escape_string($_POST['n1_naslov_' . $i1]); $n1l = mysql_real_escape_string($_POST['n1_link_' . $i1]);
				$db->e("INSERT INTO indeks_menu (pripadnost, naslov, link) VALUES ( 1,'".$n1n."', '".$n1l."' );");
			}
		}

		for($i2 = 1; $i2 < 21; $i2++){
			if(isset($_POST['n2_naslov_' . $i2]) && isset($_POST['n2_link_' . $i2]) && !empty($_POST['n2_naslov_' . $i2]) && !empty($_POST['n2_link_' . $i2])){
				$n1n = mysql_real_escape_string($_POST['n2_naslov_' . $i2]); $n1l = mysql_real_escape_string($_POST['n2_link_' . $i2]);
				$db->e("INSERT INTO indeks_menu (pripadnost, naslov, link) VALUES ( 2,'".$n1n."', '".$n1l."' );");
			}
		}

		for($i3 = 1; $i3 < 21; $i3++){
			if(isset($_POST['n3_naslov_' . $i3]) && isset($_POST['n3_link_' . $i3]) && !empty($_POST['n3_naslov_' . $i3]) && !empty($_POST['n3_link_' . $i3])){
				$n1n = mysql_real_escape_string($_POST['n3_naslov_' . $i3]); $n1l = mysql_real_escape_string($_POST['n3_link_' . $i3]);
				$db->e("INSERT INTO indeks_menu (pripadnost, naslov, link) VALUES ( 3,'".$n1n."', '".$n1l."' );");
			}
		}

		$poruka = $_jezik['admin_indexMenu_nasloviUspjesnoPostavljeni'];
	}
	$infoNaslov = $db->q("SELECT prvi_naslov, prvi_tekst, prvi_link, drugi_naslov, drugi_tekst, drugi_link, treci_naslov, treci_tekst, treci_link FROM indeks_admin WHERE idia=1;");
	$linkovi1 = $db->qMul("SELECT naslov, link FROM indeks_menu WHERE pripadnost=1;");
	$linkovi2 = $db->qMul("SELECT naslov, link FROM indeks_menu WHERE pripadnost=2;");
	$linkovi3 = $db->qMul("SELECT naslov, link FROM indeks_menu WHERE pripadnost=3;");
?>
<style type="text/css">
	.boks{width: 100%; background-color: rgb(216, 233, 255); padding: 15px; margin-bottom: 10px; }
	.naslov{ width: 800px; height: 15px; }
	textarea { width: 800px; height: 50px;  margin-top: 5px; margin-bottom: 5px;}
	.links{margin-left: 200px; }
	.linkNaslov, .linkLink{width: 300px; height: 15px; margin-right: 5px; margin-top: 5px;}
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
	#greska{ margin-left: 15px; }
	.dodajLink{ cursor: hand; cursor: pointer; font-family: Calibri_B; font-size: 12px; margin-right: 5px; margin-top: 5px;}

</style>

<script type="text/javascript">
	$(document).ready(function (){
		$('.dodajLink').click(function(){
			var id = $(this).attr('id'); var num = $(this).parent().parent().children().length - 8;
			$(this).parent().parent().append("<div class=\"links\"> <input type=\"text\" name=\""+ id + "_naslov_" + num + "\" class=\"linkNaslov\" value=\"\"><input type=\"text\" name=\""+ id + "_link_" + num + "\" class=\"linkLink\" value=\"\"> </div>");
		});
	});
</script>

<form method="post">
	<div class="boks">
		<label><?php echo$_jezik['admin_indexMenu_prviNaslov']; ?>: </label><br/>
		<input type="text" class="naslov" name="prviNaslov" value = "<?php echo $infoNaslov['prvi_naslov']; ?>" maxlength="30"/><br/>
		<textarea cols="20" rows="5" maxlength="150" name="prviTekst"><?php echo $infoNaslov['prvi_tekst']; ?></textarea> <br/>
		<input type="text" class="naslov" name="prviLink" value="<?php echo $infoNaslov['prvi_link']; ?>"/><br/>
		<div class="links"><div class="dodajLink" id="n1"><?php echo $_jezik['admin_indexMenu_dodajLink']?></div></div>
		<?php
				$br = 1;
				while($ii = mysql_fetch_array($linkovi1, MYSQL_ASSOC)){
					echo "<div class=\"links\"><input type=\"text\" name=\"n1_naslov_".$br."\" class=\"linkNaslov\" value=\"". $ii['naslov'] ."\"><input type=\"text\" class=\"linkLink\" name=\"n1_link_".$br."\" value=\"". $ii['link'] ."\"><br/></div>";
					$br+=1;
				}
		?>
	</div>

	<div class="boks">
		<label><?php echo$_jezik['admin_indexMenu_drugiNaslov']; ?>: </label><br/>
		<input type="text" class="naslov" name="drugiNaslov" value="<?php echo $infoNaslov['drugi_naslov']; ?>" maxlength="30"/><br/>
		<textarea cols="20" rows="5" name="drugiTekst" maxlength="150"><?php echo $infoNaslov['drugi_tekst']; ?></textarea> <br/>
		<input type="text" class="naslov" name="drugiLink" value="<?php echo $infoNaslov['drugi_link']; ?>"/><br/>
		<div class="links"><div class="dodajLink" id="n2"><?php echo $_jezik['admin_indexMenu_dodajLink']?></div></div>
		<?php
				$br = 1;
				while($ii = mysql_fetch_array($linkovi2, MYSQL_ASSOC)){
					echo "<div class=\"links\"><input type=\"text\" class=\"linkNaslov\" name=\"n2_naslov_".$br."\" value=\"". $ii['naslov'] ."\"><input type=\"text\" class=\"linkLink\" name=\"n2_link_".$br."\" value=\"". $ii['link'] ."\"><br/></div>";
					$br+=1;
				}
		?>
	</div>

	<div class="boks">
		<label><?php echo$_jezik['admin_indexMenu_treciNaslov']; ?>: </label><br/>
		<input type="text" class="naslov" name="treciNaslov" value="<?php echo $infoNaslov['treci_naslov']; ?>" maxlength="30"/><br/>
		<textarea cols="20" rows="5" name="treciTekst" maxlength="150"><?php echo $infoNaslov['treci_tekst']; ?></textarea> <br/>
		<input type="text" class="naslov" name="treciLink" value="<?php echo $infoNaslov['treci_link']; ?>"/><br/>
		<div class="links"><div class="dodajLink" id="n3"><?php echo $_jezik['admin_indexMenu_dodajLink']?></div></div>
		<?php
				$br = 1;
				while($ii = mysql_fetch_array($linkovi3, MYSQL_ASSOC)){
					echo "<div class=\"links\"><input type=\"text\" class=\"linkNaslov\" name=\"n3_naslov_".$br."\" value=\"". $ii['naslov'] ."\"><input type=\"text\" class=\"linkLink\" name=\"n3_link_".$br."\" value=\"". $ii['link'] ."\"><br/></div>";
					$br+=1;
				}
		?>
	</div>
	<input type="submit" name="submit" value="<?php echo$_jezik['admin_indexMenu_sacuvaj']; ?>" /><span id="greska"><?php echo $poruka; ?></span>
</form>