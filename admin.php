<?php
	require("engine/init.php");
	if(!isset($_SESSION['user']) || empty($_SESSION['user']) || !isset($_SESSION['ad']) || empty($_SESSION['ad']) || $_SESSION['ad'] != "ok") header("Location: index.php");
	$ucitaj = 'novost';
	if(isset($_GET['akcija']) || !empty($_GET['akcija'])) $ucitaj = $_GET['akcija'];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Admin</title>
    <script src="js/_jQuery.js"></script>
    <script src="js/_jQueryUI.js"></script>
    <script src="js/main.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/admin.css"/>
    <script type="text/javascript">
    	$(document).ready(function(){
    		$('#admin_menu_btnNovost').click(function(){ window.location = "admin.php?akcija=novost";});
    		$('#admin_menu_btnKamp').click(function(){ window.location = "admin.php?akcija=dodajKamp";});
    		$('#admin_menu_btnKorisnici').click(function(){ window.location = "admin.php?akcija=korisnici";});
    		$('#admin_menu_btnSlikePocetne').click(function(){ window.location = "admin.php?akcija=pocetneSlike";});
    		$('#admin_menu_btnIndexMenu').click(function(){ window.location = "admin.php?akcija=indexMenu";});
    		$('#admin_menu_btnZemlje').click(function(){ window.location = "admin.php?akcija=zemlje";});
    		$('#admin_menu_btnKontakt').click(function(){ window.location = "admin.php?akcija=kontakt";});
    		$('#admin_menu_btnKampSlike').click(function(){ window.location = "admin.php?akcija=kampSlike";});
    		$('#admin_menu_btnKampovi').click(function(){ window.location = "admin.php?akcija=kampovi";});
    	});
    </script>
</head>
<body>
	<?php include('engine/sekcije/_header.php'); ?>

	<div id="admin_menu">
		<input type="button" value="<?php echo $_jezik['admin_menu_dodajVijest']; ?>" id="admin_menu_btnNovost"/>
		<input type="button" value="<?php echo $_jezik['admin_menu_dodajKamp']; ?>" id="admin_menu_btnKamp"/>
		<input type="button" value="Kampovi" id="admin_menu_btnKampovi"/>
		<input type="button" value="<?php echo $_jezik['admin_menu_korisnici']; ?>" id="admin_menu_btnKorisnici" />
		<input type="button" value="<?php echo $_jezik['admin_menu_slikeSaPocetne']; ?>" id="admin_menu_btnSlikePocetne"/>
		<input type="button" value="<?php echo $_jezik['admin_menu_indexMenu']; ?>" id="admin_menu_btnIndexMenu"/>
		<input type="button" value="<?php echo $_jezik['admin_menu_jeziciZemlje']; ?>" id="admin_menu_btnZemlje"/>
		<input type="button" value="Sistemska Podesavanja" id="admin_menu_btnKontakt"/>
		<input type="button" value="Slike Kampovi" id="admin_menu_btnKampSlike"/>
	</div><!--/admin_menu-->

	<div id="admin_content">
		<?php
			switch($ucitaj){
				case 'novost': include("engine/admin/novaVijest.php"); break;
				case 'dodajKamp': include("engine/admin/dodajKamp.php"); break;
				case 'korisnici': include("engine/admin/korisnici.php"); break;
				case 'pocetneSlike': include("engine/admin/pocetneSlike.php"); break;
				case 'indexMenu': include("engine/admin/indexMenu.php"); break;
				case 'zemlje': include("engine/admin/zemlje.php"); break;
				case 'kontakt': include("engine/admin/sistemska_podesavanja.php"); break;
				case 'kampSlike': include("engine/admin/kampSlike.php"); break;
				case 'kampovi': include("engine/admin/kampovi.php"); break;
			}
		?>
	</div><!--/admin_content-->

	<?php include('engine/sekcije/_kontakt_futer.php'); ?>
</body>
</html>