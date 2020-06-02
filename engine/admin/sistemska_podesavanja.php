<?php 
	$db = new BazaPodataka();

	if(isset($_POST['submit'])){
		if(isset($_POST['email']) && !empty($_POST['email']) &&
			isset($_POST['registracija']) && !empty($_POST['registracija']) &&
			isset($_POST['vefforma']) && !empty($_POST['vefforma']) &&
			isset($_POST['lista']) && !empty($_POST['lista'])){

			$email = mysql_real_escape_string($_POST['email']);
			$registracija = mysql_real_escape_string($_POST['registracija']);
			$vefforma = mysql_real_escape_string($_POST['vefforma']);
			$lista = mysql_real_escape_string($_POST['lista']);
			$offline = 'ne'; if(isset($_POST['offline'])) $offline = 'da';
			
			$db->e("UPDATE admin_info SET email='". $email ."', registracija_info='". $registracija ."', vefForma_info='". $vefforma ."', 
						lista_info='". $lista ."', site_offline='".$offline."' WHERE idai=1;");
		} else echo "Sva polja moraju biti ispunjena!";
	}

	$podaci = $db->q("SELECT email, registracija_info, vefForma_info, lista_info, site_offline FROM admin_info WHERE idai=1;");
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
				width: 80%;
				height: 20px;
				padding: 2px;
				border:1px solid #b8baff;
				background-color: #f4f4ff;
			}
			.input_text{
				width: 80%;
				height: 300px;
				padding: 2px;
				border:1px solid #b8baff;
				background-color: #f4f4ff;
			}

			#unos_Tekst{
				width: 80%;
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
	<div class="unos_naslov">OFFLINE: <input type="checkbox" name="offline" <?php if($podaci['site_offline']=='da') echo "checked=\"yes\""; ?>/></div>

	<div class="unos_naslov"><?php echo $_jezik['admin_menu_vefForma']; ?>: </div>
	<input type="text" class="input_no_error" id="unos_Naslov" name="email" maxlength="30" value="<?php echo $podaci['email'];?>"/> 
	<div style="clear:both"></div>

	<div class="unos_naslov">Poruka za registraciju: </div>
	<textarea class="input_text" name="registracija"><?php echo $podaci['registracija_info'];?></textarea>
	<div style="clear:both"></div>

	<div class="unos_naslov">Poruka za VEF formu: </div>
	<textarea class="input_text" name="vefforma"><?php echo $podaci['vefForma_info'];?></textarea>
	<div style="clear:both"></div>

	<div class="unos_naslov">Poruka za listu kampova: </div>
	<textarea class="input_text" name="lista"><?php echo $podaci['lista_info'];?></textarea>
	<div style="clear:both"></div>

	<input type="submit" name='submit' id="btnPotvrdi"/> 
</form>