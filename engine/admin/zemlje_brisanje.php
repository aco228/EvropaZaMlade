<?php
	require("../init.php");
	ukljuci_bazu(); $db = new BazaPodataka();

	if(isset($_GET['data']) && !empty($_GET['data'])){
		$db->e("DELETE FROM zemlje ".$_GET['data']."");
		echo "Zemlje su izbrisane";
		die();
	} else echo "Greska sa unosom!";

?>