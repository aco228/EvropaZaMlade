<?php

	$db = new BazaPodataka();
	$err = "";

	if(isset($_GET['data']) && !empty($_GET['data'])){
		$db->e("DELETE FROM zemlje WHERE idz=".$_GET['data'].";");
		echo "Zemlje su izbrisane";
		die();
	}

	if(isset($_POST['submit']) && !empty($_POST['naslov']) && is_uploaded_file($_FILES['zastava']['tmp_name']) ){
		
		// Korak 1. provjera EKSTENZIJE
		$exe = explode(".",$_FILES['zastava']['name']); $exe = strtolower(end($exe));
		if($exe == "png"){

			// Korak 2. provjera VELICINE
			if($_FILES['zastava']['size'] <=  256000){

				// Korak 3. provjera postojanja drzave
				$db->q("SELECT COUNT(*) AS br FROM zemlje WHERE ime_zemlje='".$_POST['naslov']."';");
				if($db->db_F['br'] == 0){

					// Korak 4. POSTAVLJANJE SLIKE
					//echo "INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES ('".$_POST['naslov'].", '".$_POST['unos_Skracenica']."');";
					$db->e("INSERT INTO zemlje (ime_zemlje, jezik_zemlje) VALUES ('".$_POST['naslov']."', '".$_POST['unos_Skracenica']."');");
					move_uploaded_file($_FILES['zastava']['tmp_name'], "slike/zastave/" . $_POST['naslov'] . '.png');
					$err= $_jezik['admin_zemlje_uspjesnoPostavljeno'];

				} else $err = $_jezik['admin_zemlje_drzavaPostoji'];
			} else $err= $_jezik['admin_zemlje_slikaVelika'];
		} else $err= $_jezik['admin_zemlje_greskaSaZastavom'];
	}

	// PREUZIMANJE PODATAKA
	$data = $db->qMul("SELECT idz, ime_zemlje, jezik_zemlje FROM zemlje ORDER BY ime_zemlje;");
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
				width: 40%;
				height: 20px;
				padding: 2px;
				border:1px solid #b8baff;
				background-color: #f4f4ff;
			}
			input[class=input_no_errorshourt]{
				width: 40px;
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
				height: 28px;
				border:1px solid #f4f4ff;
				background-color: #b8baff;
				cursor:hand; cursor:pointer;
			}
			table{
				width: 100%;
				margin-top: 25px;
				margin-bottom: 25px;
			}
			#content tr:nth-child(odd){
				background-color: rgb(236, 243, 255);
			}
			#content tr:nth-child(1){
				background-color: rgb(255, 213, 213);
			}
			#content tr{
				padding: 5px;
			}
			.btnTable{
				background-color:rgb(161, 155, 224);
				border: 1px solid #4347ff;
				width: 100%;
				height: 25px;
				color:#FFF;
				-moz-border-radius: 5px;
				border-radius: 5px;
				cursor:hand; cursor:pointer;
				margin-right: 1px;
			}
			.btnUsr{
				background-color:rgb(161, 155, 224);
				border: 1px solid #4347ff;
				height: 25px;
				color:#FFF;
				-moz-border-radius: 5px;
				border-radius: 5px;
				cursor:hand; cursor:pointer;
				margin-right: 1px;
			}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$('#izbrisi').click(function(){
			var data = getData();
			if(data!="") ajax(data);
		});
	});
	function getData(){
		var data = "WHERE idz IN ("; var br = 0;
		$('.potvrda').each(function(){
			if(this.checked){
				br++;
				var zarez = ', '; if(br==1) zarez = '';
				data+= zarez + $(this).attr('id');
			}
		});	

		if(br!=0) { data+=');'; return data; } else return "";
	}
	function ajax(data){
		var x;
		if(window.XMLHttpRequest) x= new XMLHttpRequest();
		else x = new ActiveXObject("Microsoft.XMLHTTP");
		x.onreadystatechange = function(){
			if(x.readyState == 4 && x.status == 200) { 
				alert(x.responseText); location.reload();
			}
		};
		x.open("GET", "engine/admin/zemlje_brisanje.php?data="+data); x.send();	
	}
</script>
<form action="" method="post" enctype="multipart/form-data">
	<!-- NASLOV -->
	<div class="unos_naslov"><?php echo $_jezik['admin_zemlje_postaviZemlju']; ?> <a href="http://www.senojflags.com/#flags16" target="_BLANK">Link</a>: </div>
	<div><?php echo $err; ?></div>
	<input type="file" name="zastava" />
	<input type="text" class="input_no_error" id="unos_Naslov" name="naslov" maxlength="30" value=""/> 
	<input type="text" class="input_no_errorshourt" name="unos_Skracenica" maxlength="5" value=""/> 
	<input type="submit" name='submit' id="btnPotvrdi" value="<?php echo $_jezik['admin_slika_postaviNovuSliku_potvrdi'];?>"/>
	<br /> <input type="button" id="izbrisi" value="Izbrisi selektovane zemlje" />
</form>
	<table id="content">
		<tr>
			<td><?php echo $_jezik['admin_zemlje_zastava']; ?></td>
			<td><?php echo $_jezik['admin_zemlje_ime'] ; ?></td>
			<td>Skracenica</td>
			<td><?php echo $_jezik['admin_zemlje_izbrisi']; ?></td>
		</tr>
		<?php
			while($r = mysql_fetch_array($data, MYSQL_ASSOC)){
				echo    "<tr>
							<td><img src=\"slike/zastave/". $r['ime_zemlje'] .".png\"></td>
							<td>". $r['ime_zemlje'] ."</td>
							<td>". $r['jezik_zemlje'] ."</td>
							<td><input type=\"checkbox\" class=\"potvrda\" id=\"".$r['idz']."\"/></td>
						</tr>";
			}
		?>
	</table>