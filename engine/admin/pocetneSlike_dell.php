<?php
	if(!isset($_GET['lok']) || empty($_GET['lok']) ) header("Location: index.php");

	require("../init.php");
	if(file_exists("../../" . $_GET['lok'])){
		unlink("../../" . $_GET['lok']);
		echo $_jezik['admin_slika_brisanjeUspjesno'];
	} else echo $_jezik['admin_slika_brisanjeGreska'];
?>