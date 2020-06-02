<?php

	// MIJENJANJE JEZIKA
	if(isset($_GET['postavi']) && !empty($_GET['postavi']) && isset($_GET['str']) && !empty($_GET['str']) && file_exists("jezici_php/jezik." .$_GET['postavi'] . ".php")){
		setcookie("jezik", $_GET['postavi'] , time() + (3600*24*30), "/");
		header("Location: ".$_GET['str']."");
	}

	$DEF_JEZIK = "Serbia";
	if(!isset($_COOKIE['jezik']) || !file_exists(realpath(dirname(__FILE__)) . "/jezici_php/jezik.".$_COOKIE['jezik'].".php")){
		//echo realpath(dirname(__FILE__)) . "jezici_php/jezik.".$_COOKIE['jezik'].".php";
		setcookie("jezik", $DEF_JEZIK , time() + (3600*24*30), "/");
		print '<script type="text/javascript">'; 
		print 'location.reload();'; 
		print '</script>';
	}

	// UKLJUCIVANJE JEZIKA
	include "jezici_php/jezik.".$_COOKIE['jezik']. ".php";


?>