<?php
	$db = new BazaPodataka();

	//
	//	UPDATE BAZE
	//
	$err = ""; $naslov = "";
	if(isset($_POST['submit']) && is_uploaded_file($_FILES['file']['tmp_name']) ){
		// Korak 1. provjera EKSTENZIJE
		$exe = explode(".",$_FILES['file']['name']); $exe = strtolower(end($exe));
		if($exe == "xml"){
			// Korak 2. provjera VELICINE
			if($_FILES['file']['size'] <= 6242880){

				// Korak 3. POSTAVLJANJE BAZE
				if(file_exists("ekstra/kamp_update/baza.xml")) unlink("ekstra/kamp_update/baza.xml");
				move_uploaded_file($_FILES['file']['tmp_name'], "ekstra/kamp_update/baza.xml");

				require("engine/kamp/kamp_update_xml.php");
				$xml = @simplexml_load_file("ekstra/kamp_update/baza.xml");
				if($xml) xml_engine(simplexml_load_file("ekstra/kamp_update/baza.xml"));
				else echo "Greska sa validacijom xml-a";
				
			} else $err = "Fajl je preko 6 megabjata";
		} else $err = "Pogresan format baze";
	}
	
	if(isset($_GET['neaktivni'])){
		$danasnjiDan = date('j'); $danasnjiMjesec = date('n'); $danasnjaGodina = date('Y');
		$getStvari = " intk, ime_kampa, kod_kampa, zemlja, pocetakDan, pocetakMjesec, pocetakGodina, krajDan, krajMjesec, krajGodina ";
		$kampovi = $db->qMUL("(SELECT ". $getStvari . " FROM kamp WHERE krajDan<" . $danasnjiDan . " AND krajMjesec=" . $danasnjiMjesec ." AND krajGodina=". $danasnjaGodina.")
								UNION ALL (SELECT ". $getStvari . " FROM kamp WHERE krajMjesec<" . $danasnjiMjesec ." AND krajGodina=". $danasnjaGodina.")
								UNION ALL(SELECT ". $getStvari . " FROM kamp WHERE krajGodina<". $danasnjaGodina.")");
		$naslov = "Prikazuju se neaktivni kampovi!";
	} else {
		$kampovi = $db->qMul("SELECT intk, ime_kampa, kod_kampa, zemlja, pocetakDan, pocetakMjesec, pocetakGodina, krajDan, krajMjesec, krajGodina FROM kamp ORDER BY intk DESC;");
	}
?>
<style type="text/css">
	#tabla{
		width: 100%;
		font-size: 10pt;
		margin: 5px;
		text-align: center;
	}
	#tabla tr:nth-child(odd){
		background-color: #EDFFEE;
	}
	#tabla a {color:#000; font-weight: bold; }
	#tabla tr:first-child{
		background-color: #000;
		color:#FFF;
		font-weight: bold;
	}
	.opcije{
		margin: 5px;
	}
	.opcije a{
		color: #002AD5;
		margin-right: 25px;
		margin-bottom: 20px;
	}
	.opcije a:hover{
		color: #000;
		text-shadow: 0px 0px 2px rgba(0, 0, 0, 0.5);
	}
	input[name=rijec]{
		width: 400px;
	}
	.opcije input[type=submit]{
		padding: 3px;
	}
	#naslov { color:red; font-weight: bold; }
</style>
<script type="text/javascript">
$(document).ready(function(){
	<?php
		if($err!="") echo "alert('".$err."');"; 
	?>
	$('#izbrisi').click(function(){
		var data = getData(); if(data=="") return;
		ajax("izbrisi", data);
	});
	$('#neaktivni').click(function(){
		window.location = "admin.php?akcija=kampovi&neaktivni=a";
	});
	$('#dellNeaktivni').click(function(){
		ajax("dellNeaktivni", "X");
	});
	$('#selektujSve').click(function(){
		if($('#selektujSve').is(':checked')){
			$('.potvrda').each(function(){ $(this).prop('checked', true); });
		} else {
			$('.potvrda').each(function(){ $(this).prop('checked', false); });
		}
	});
});

	function getData(){
		var data = "IN ("; var br = 0;
		$('.potvrda').each(function(){
			if(this.checked){
				br++;
				var zarez = ', '; if(br==1) zarez = '';
				data+= zarez + $(this).attr('id');
			}
		});	

		if(br!=0) { data+=');'; return data; } else return "";
	}
	function ajax(akcija,data){
		var x;
		if(window.XMLHttpRequest) x= new XMLHttpRequest();
		else x = new ActiveXObject("Microsoft.XMLHTTP");
		x.onreadystatechange = function(){
			if(x.readyState == 4 && x.status == 200) { 
				alert(x.responseText); location.reload();
			}
		};
		x.open("GET", "engine/kamp/kamp_administracija.php?akcija="+akcija+"&data="+data); x.send();	
	}
</script>
<div class="opcije">
	<a href="#" id="izbrisi">Izbrisi selektovane</a>
	<a href="#" id="neaktivni">Prikazi neaktivne</a>
	<a href="#" id="dellNeaktivni">Izbrisi neaktivne</a>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="file" name="file" id="file">
		<input type="submit" name="submit" value="Update baze">
	</form>
</div>
<div id="naslov"><?php echo $naslov; ?></div>
<table id="tabla">
	<tr>
		<td><input type="checkbox" id="selektujSve"/></td>
		<td>Ime kampa</td>
		<td>Kod kampa</td>
		<td>Zemlja</td>
		<td>Pocetak</td>
		<td>Kraj</td>
	</tr><!--
	<tr>
		<td><input type="checkbox" class="potvrda" id="1"/></td>
		<td>aco228</td>
		<td>admin</td>
		<td>admin</td>
		<td>Aleksandar Konatar</td>
		<td>loga@a.c</td>
	</tr>
	<tr>
		<td><input type="checkbox" class="potvrda" id="2"/></td>
		<td>aco228</td>
		<td>admin</td>
		<td>admin</td>
		<td>Aleksandar Konatar</td>
		<td>loga@a.c</td>
	</tr>-->
	<?php
		while($r = mysql_fetch_array($kampovi, MYSQL_ASSOC)){
			echo "<tr>
					<td><input type=\"checkbox\" class=\"potvrda\" id=\"".$r['intk']."\"/></td>
					<td><a href=\"kamp.php?id=".$r['intk']."\" target=\"_BLANK\">".$r['ime_kampa']."</a></td>
					<td>".$r['kod_kampa']."</td>
					<td>".$r['zemlja']."</td>
					<td>".$r['pocetakDan']. " " . getMjesec($r['pocetakMjesec']) . " " . $r['pocetakGodina'] ."</td>
					<td>".$r['krajDan']. " " . getMjesec($r['krajMjesec']) . " " . $r['krajGodina'] ."</td>
				</tr>";
		}
	?>
</table>