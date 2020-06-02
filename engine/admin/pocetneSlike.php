<?php
	$err = "";
	if(isset($_POST['submit']) && is_uploaded_file($_FILES['slika']['tmp_name']) ){
		
		// Korak 1. provjera EKSTENZIJE
		$exe = explode(".",$_FILES['slika']['name']); $exe = strtolower(end($exe));
		if($exe == "jpg"){

			// Korak 2. provjera VELICINE
			if($_FILES['slika']['size'] <= 2097152){

				// Korak 3. POSTAVLJANJE SLIKE
				move_uploaded_file($_FILES['slika']['tmp_name'], "slike/index_prezent/slike/" . substr(str_shuffle(MD5(microtime())), 0, 20) . '.jpg');
				$err=$_jezik['admin_slika_uspjesnoPostavljena'];

			} else $err= $_jezik['admin_slika_velikaSlika'];
		} else $err= $_jezik['admin_slika_pogresanFormat'];
	} 
?>
<style type="text/css">
	.centere{
		padding: 5%;
	}
	.btn{
		background-color:rgb(161, 155, 224);
		border: 1px solid #4347ff;
		height: 25px;
		color:#FFF;
		-moz-border-radius: 5px;
		border-radius: 5px;
		cursor:hand; cursor:pointer;
		margin: 5px;
	}
	.boks{
		width: 200px;
		height: 200px;
		background-size: 200%;
		background-repeat: no-repeat;
		background-position: center;

		background-color: #000;
		box-shadow: 0px 0px 5px #000;
		border: 1px solid #000;
		float:left;
		margin: 20px;
	}
</style>

<script type="text/javascript">
$(document).ready(function(){

	$('.boks').stop().hover(function(){
		$(this).stop(false, false).animate({'background-size':'100%'}, 500);
	}, function(){
		$(this).stop(false, false).animate({'background-size':'200%'}, 1500);
	});

	$('.btn').click(function(){
		ajax($(this).attr('id'));
	});
});
function ajax(d){
	var x;
	if(window.XMLHttpRequest) x= new XMLHttpRequest();
	else x = new ActiveXObject("Microsoft.XMLHTTP");
	x.onreadystatechange = function(){
		if(x.readyState == 4 && x.status == 200) { 
			alert(x.responseText); location.reload();
		}
	};
	x.open("GET", "engine/admin/pocetneSlike_dell.php?lok="+d); x.send();	
}
</script>

<form action="" method="post" enctype="multipart/form-data">
<div class="centere">
	<label><?php echo $_jezik['admin_slika_postaviNovuSliku']; ?>: </label>
	<input type="file" name="slika"/> 
	<input type="submit" name="submit" class="btn" value="<?php echo $_jezik['admin_slika_postaviNovuSliku_potvrdi']; ?>"/></div> 
</form>
<div class="err"><?php echo $err; ?></div>
<div style="clear:both"></div>

<?php
	$slike = glob("slike/index_prezent/slike/*.jpg");

	for($i=0; $i<sizeof($slike); $i++){
		echo "<div class=\"boks\" style=\"background-image: url('". $slike[$i] ."')\">
				<input type=\"button\" class=\"btn\" id=\"". $slike[$i] ."\" value=\"". $_jezik['admin_slika_izbrisi'] ."\"/>
<			  </div>";
	}
?>