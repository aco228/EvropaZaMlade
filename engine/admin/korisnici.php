<?php
	$db = new BazaPodataka();

	if(isset($_POST['rijec']) && !empty($_POST['rijec'])) $rijec = mysql_real_escape_string($_POST['rijec']);
	else $rijec = "";

	if($rijec!=""){
		$korisnici = $db->qMul("SELECT idc, username, email, ime, prezime, status, admin_level FROM clan WHERE username LIKE '%" .$rijec. "%' OR email  LIKE '%".$rijec."%' OR ime LIKE '%".$rijec."%' OR prezime LIKE '%".$rijec."%' AND idc>1;");
	} else $korisnici = $db->qMul("SELECT idc, username, email, ime, prezime, status, admin_level FROM clan WHERE idc>1 ORDER BY idc DESC");
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
</style>
<script type="text/javascript">
$(document).ready(function(){
	$('#izbrisi').click(function(){
		var data = getData(); if(data=="") return;
		ajax("izbrisi", data);
	});
	$('#addAdmin').click(function(){
		var data = getData(); if(data=="") return;
		ajax("addAdmin", data);
	});
	$('#dellAdmin').click(function(){
		var data = getData(); if(data=="") return;
		ajax("dellAdmin", data);
	});
	$('#addBan').click(function(){
		var data = getData(); if(data=="") return;
		ajax("addBan", data);
	});
	$('#dellBan').click(function(){
		var data = getData(); if(data=="") return;
		ajax("dellBan", data);
	});
});

	function getData(){
		var data = "WHERE idc IN ("; var br = 0;
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
		x.open("GET", "engine/clan/clan_adminKomunikacija.php?akcija="+akcija+"&data="+data); x.send();	
	}
</script>

<div class="opcije">
	<a href="#" id="izbrisi">Izbrisi</a>
	<a href="#" id="addAdmin">Postavi za admina</a>
	<a href="#" id="dellAdmin">Ukloni admina</a>
	<a href="#" id="addBan">Banuj</a>
	<a href="#" id="dellBan">Ukloni ban</a>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="text" name="rijec" value=""/> 
		<input type="submit" name='submit' value="<?php echo $_jezik['admin_slika_postaviNovuSliku_potvrdi'];?>"/>
	</form>
</div>

<table id="tabla">
	<tr>
		<td>X</td>
		<td>Korisnicko ime</td>
		<td>Informacije</td>
		<td>Ime i prezime</td>
		<td>Email</td>
	</tr><!--
	<tr>
		<td><input type="checkbox" class="potvrda" id="1"/></td>
		<td>aco228</td>
		<td>admin</td>
		<td>Aleksandar Konatar</td>
		<td>loga@a.c</td>
	</tr>
	<tr>
		<td><input type="checkbox" class="potvrda" id="2"/></td>
		<td>aco228</td>
		<td>admin</td>
		<td>Aleksandar Konatar</td>
		<td>loga@a.c</td>
	</tr>-->
	<?php
		while($r = mysql_fetch_array($korisnici, MYSQL_ASSOC)){
			echo "<tr>
					<td><input type=\"checkbox\" class=\"potvrda\" id=\"".$r['idc']."\"/></td>
					<td>".$r['username']."</td>
					<td>". getInfo($r['admin_level'], $r['status']) ."</td>
					<td>".$r['ime'] . " " . $r['prezime'] ."</td>
					<td>". $r['email'] ."</td>
				</tr>";
		}

		function getInfo($admin, $status){
			$back = "| ";
			if($admin == "ad") $back .= "Admin | ";
			if($status=="ban") $back .= "Banovan | ";
			if($status=="ne") $back .= "Neaktiviran | ";
			return $back;
		}
	?>
</table>