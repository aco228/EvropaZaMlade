    <section class="__headerNoSpace"></section>
	<section class="__header">
        <div id="__header_logo">
            <div id="__header_logo_naslov"> <a href="index.php"><?php echo $_jezik['logo_naslov']; ?></a></div>
            <div id="__header_logo_sjenka"><img id="__header_logo_zvijezde" src="slike/sys_logo/logo_zvijezde.png" alt="" /></div>

            <div id="__header_logo_innerInfo_cover">
                <div id="__header_logo_innerInfo">
                    <div id="__header_logo_innerInfo_opis"><?php echo $_jezik['logo_naslov_zid']; ?></div>
                    <a href="http://www.zid.org.me" id="__header_logo_innerInfo_slika" target="_blank"><img src="slike/sys_logo/logo.png"></a>
                </div>          
        </div><!--innerHTML-->
        
        </div><!--/__header_logo-->


    	<div id="__header_menu">
        	<ul>
            	<li id="__header_menu_jezici"><a href="#" class="_header_menuLink">Choose language</a>
                	<table>
                        <?php getSveJezike(); ?>
                    </table>
                </li>
            	<li id="_header_menu_projekti"><a href="#" class="_header_menuLink" ><?php echo $_jezik['meni_projekti']; ?></a>
                        <table>
                            <?php getProjektMenu(); ?>
                        </table>
                </li>
            	<li><a href="#" class="_header_menuLink"><a href="novosti.php" class="_header_menuLink"><?php echo $_jezik['meni_novosti']; ?></a></a></li>
            	<li><a href="#" class="_header_menuLink" id="__header_menu_pretraga"><?php echo $_jezik['meni_pretraga']; ?></a></li>
            	<li><a href="<?php echo $__login_link; ?>" class="_header_menuLink" <?php if($__login_link=="#") echo "id=\"_header_login_link\""; ?> ><?php echo $__korisnik ; ?></a></li>
            </ul>
        </div><!--/__header_menu-->
        
    </section><!--/__header-->

    <!-- COVER ZA CIJELU STRANICU -->
    <div id="__header_cover"></div>
    <!-- LOGIN SEKCIJA -->
    <div class="__header_login_sekcija">
        <div id="__header_login_sekcija_greska"></div>
        <div id="__header_login_sekcija_naslov"><?php echo $_jezik['login_naslov']; ?></div>
        <input type="text" id="__header_login_sekcija_user" value="Username" />
        <input type="password" id="__header_login_sekcija_pass" value="Sifra" />
        <div id="__header_cover_linkovi">
            <input type="button" value="<?php echo $_jezik['registracija_btnPotvrdi']; ?>" id="__header_login_sekcija_btnPotvrdi"/>
            <input type="button" value="<?php echo $_jezik['login_zatvori']?>" id="__header_login_sekcija_btnZatvori"/>
            <div><?php echo $_jezik['login_ukoliko_niste_registrovani']; ?> <a href="registracija.php"> <?php echo $_jezik['login_registrujSe'] ; ?></a> </div>
        </div>
    </div><!--/__header_login_sekcija-->

    <!-- PRETRAGA SEKCIJA -->
    <div class="__header_pretraga_sekcija">
        <div id="__header_login_sekcija_greska"></div>
        <div id="__header_login_sekcija_naslov"><?php echo $_jezik['pretraga_naslov']; ?></div>
        <input type="text" id="__header_pretraga_unos" value="<?php echo $_jezik['pretraga_naslov']; ?>" />
        <div id="__header_cover_linkovi">
            <input type="button" value="<?php echo $_jezik['registracija_btnPotvrdi']; ?>" id="__header_pretraga_btnPotvrdi"/>
            <input type="button" value="<?php echo $_jezik['login_zatvori']?>" id="__header_pretraga_btnZatvori"/>
        </div>
    </div><!--/__header_pretraga_sekcija-->