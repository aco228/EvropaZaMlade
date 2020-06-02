<?php
    include ("engine/init.php");

    ukljuci_bazu();
    // PREUZIMANJE POSLEDNJIH VIJESTI
    $db = new BazaPodataka();
    $poslednjeVijesti = $db->qMul("SELECT idn, naslov, opis, tekst, adresa_slike FROM novost WHERE koristi_novost='da' ORDER BY idn DESC LIMIT 5;", false);
    $indeks_boksovi = $db->q("SELECT prvi_naslov, prvi_tekst, prvi_link, drugi_naslov, drugi_tekst, drugi_link, treci_naslov, treci_tekst, treci_link FROM indeks_admin WHERE idia=1;");

    $indeks_linkovi = $db->qMul("SELECT pripadnost, naslov, link FROM indeks_menu;");
    $indeks_linkovi1 = ""; $indeks_linkovi2 = ""; $indeks_linkovi3 = ""; 
    while($indLink = mysql_fetch_array($indeks_linkovi, MYSQL_ASSOC)){
        $iiii = "<a href=\"". $indLink['link'] ."\" target=\"_blank\"> <input type=\"button\" class=\"__dodatniMenu_btn\" value=\"". $indLink['naslov'] ."\"></a>";
             if($indLink['pripadnost'] == 1) $indeks_linkovi1.= $iiii;
        else if($indLink['pripadnost'] == 2) $indeks_linkovi2.= $iiii;
        else if($indLink['pripadnost'] == 3) $indeks_linkovi3.= $iiii;
    } 

    $admin_info = $db->q("SELECT site_offline FROM admin_info;");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>Evropa za mlade</title>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/index.css"/>
    <script src="js/_jQuery.js"></script>
    <script src="js/_jQueryUI.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
    <script src="js/index.js" type="text/javascript"></script>
    <script src="js/cekanjeSlika.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>
    <script type="text/javascript">
		<?php $sveSlike = glob("slike/index_prezent/slike/*.jpg"); ?>
		var __dostupneSlike = new Array(
			<?php 
				for($i=0; $i < sizeof($sveSlike); $i+=1){
					if($i == sizeof($sveSlike)-1) echo '"' . $sveSlike[$i] . '"';
					else echo '"' . $sveSlike[$i] . '",';	
				}
			?>
		);
        var __offline = "<?php if($admin_info['site_offline']=='da' && !isset($_GET['enter'])) echo "da"; else echo "ne"; ?>";
	</script>
</head>
<body>
    <div id="preloader_white"></div>
    <div id="preloader">
        <div id="preloader_logo"><img src="slike/index_prezent/loader_logo.png" alt=""/></div>
        <div id="preloader_tekst">Учитавање...</div>
        <div id="preloader_powered">aco228</div>
        <div id="preloader_doljnjaLinija">Почетна страница се припрема...</div>
    </div>
    <?php include('engine/sekcije/_header.php'); ?>

    <section class="__index_present">

    	<div id="kontenjer_informacija">

        	<div id="kontenjer_informacija_naslov">
            	<h1><?php echo $indeks_boksovi['prvi_naslov'];?></h1>
            	<h2><?php echo $indeks_boksovi['prvi_tekst'];?></h2>
            	<h3><a href="<?php echo $indeks_boksovi['prvi_link'];?>"><?php echo $_jezik['index_opsirnije']?> →</a></h3>

                <div id="__index_present_dodatniMenu"><?php echo $indeks_linkovi1; ?></div> <!--/__index_present_dodatniMenu-->
            </div><!--/naslov-->

            <div id="__index_present_grupe">
            		<div class="grupe_td" id="grupe_td_selektovan">
                    	<div class="td_naslov"><?php echo $indeks_boksovi['prvi_naslov'];?></div>
                    	<div class="td_opis"><?php echo $indeks_boksovi['prvi_tekst'];?></div>
                        <div class="td_sakrij" id="td_link"><a href="<?php echo $indeks_boksovi['prvi_link'];?>"><?php echo $_jezik['index_opsirnije']?> →</a></div>
                        <div class="td_sakrij" id="td_menu"><?php echo $indeks_linkovi1; ?></div>
                    </div>
                    <div class="grupe_td" >
                        <div class="td_naslov"><?php echo $indeks_boksovi['drugi_naslov'];?></div>
                        <div class="td_opis"><?php echo $indeks_boksovi['drugi_tekst'];?></div>
                        <div class="td_sakrij" id="td_link"><a href="<?php echo $indeks_boksovi['drugi_link'];?>"><?php echo $_jezik['index_opsirnije']?> →</a></div>
                        <div class="td_sakrij" id="td_menu"><?php echo $indeks_linkovi2; ?></div>
                    </div>
                    <div class="grupe_td">
                        <div class="td_naslov"><?php echo $indeks_boksovi['treci_naslov'];?></div>
                        <div class="td_opis"><?php echo $indeks_boksovi['treci_tekst'];?></div>
                        <div class="td_sakrij" id="td_link"><a href="<?php echo $indeks_boksovi['treci_link'];?>"><?php echo $_jezik['index_opsirnije']?> →</a></div>
                        <div class="td_sakrij" id="td_menu"><?php echo $indeks_linkovi3; ?></div>
                    </div>
            </div><!--/grupe-->
        </div><!--/kontenjer_informacija-->

    	<div id="sjenka"></div>
        <div id="kontenjer_slika">
        	<div class="ip_slika" id="s0"></div>
        	<div class="ip_slika" id="s1"></div>
        	<div class="ip_slika" id="s2"></div>
        	<div class="ip_slika" id="s3"></div>
        	<div class="ip_slika" id="s4"></div>
        	<div class="ip_slika" id="s5"></div>
        	<div class="ip_slika" id="s6"></div>
        	<div class="ip_slika" id="s7"></div>
        	<div class="ip_slika" id="s8"></div>
        	<div class="ip_slika" id="s9"></div>
        	<div class="ip_slika" id="s10"></div>
        	<div class="ip_slika" id="s11"></div>
        </div><!--/kontenjer_slika-->
    </section><!--/__index_present-->
    
    <section class="_index_poslednjeNovosti">
        
        <div id="pn_poslednjeNovosti"><?php echo $_jezik['index_poslednjeVijesti']; ?>: </div>

        <?php
            $i = 0;
            while($vijest = mysql_fetch_array($poslednjeVijesti, MYSQL_ASSOC)) {
                if($i==0){
                    echo "<div class=\"pn_boksovi_poslednja\" id=\"novost=". $vijest['idn'] . "\" style=\"background-image: url('". $vijest['adresa_slike'] ."');\">
                             <div id=\"pn_boksNaslov\">". $vijest['naslov'] ."</div>
                             <div id=\"pn_boksOpis\">". $vijest['tekst'] ."</div>
                          </div>";
                } else {
                    echo "<div class=\"boks\" id=\"novost=" . $vijest['idn'] ."\" style=\"background-image: url('". $vijest['adresa_slike']. "')"; if($i==3) echo "; margin-left:10%;"; echo ";\">
                             <div class=\"boksNaslov\">" . $vijest['naslov'] . "</div>
                             <div class=\"boksOpis\">" . $vijest['tekst'] . "</div>
                         </div>";
                }
                $i++;
            }
        ?>

    </section><!--/_index_poslednjeNovosti-->

    <?php include('engine/sekcije/_kontakt_futer.php'); ?>

</body>
</html>
