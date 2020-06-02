$(document).ready(function(e) {
	// ANIMACIJA ELEMENATA
    animacijeLinkovaILista();
	
	// ANIMACIJA LOGO- STRANICE
	animacijaLogoStranice();
	
	// UPDATE VELICINE FONTOVA
	updateFonts(); // pocetno prilagodjavanje
	$(window).resize(function(){ updateFonts(); });

	// LOGIN SEKCIJA
	loginSekcija(); //prikaziCover();prikaziLoginSekciju();

	// PRETRAGA SEKCIJA
	pretragaSekcija();

	// Mijenjanje jezika
	mijenjanjeJezika();
});

function animacijeLinkovaILista(){
	// Drop down menu
	$('#__header_menu > ul >li').hover(function(){
		$('ul', this).stop(true, true).fadeIn();
		$('table', this).stop(true, true).fadeIn();
	}, function(){
		$('ul', this).fadeOut();
		$('table', this).fadeOut();
	});
	
	// Linkovi
	$('a').hover(function(){
		
	}, function(){
		
	});
}

function animacijaLogoStranice(){
	$('#__header_logo_naslov').stop().hover(function(){

		$('#__header_logo_innerInfo_cover').fadeIn(800);
		$('#__header_logo_naslov').parent().css('overflow', 'visible');

		
	}, function(){
		$(this).parent().stop().mouseleave(function(){
			$('#__header_logo_innerInfo_cover').fadeOut(400, function(){
				$('#__header_logo_naslov').parent().css('overflow', 'hidden');
			});
		});
	});
	
	// Prikazi ZID
	$('#__header_logo_innerInfo_slika').stop().hover(function(){
		$('#__header_logo_innerInfo_opis').fadeIn(300);
	}, function(){
		$('#__header_logo_innerInfo_opis').fadeOut(300);
	});
}
var stepen = 0;
function rotateAnimation(el,brzina){
	var elem = document.getElementById(el);
	if(navigator.userAgent.match("Chrome")){
		elem.style.WebkitTransform = "rotate("+stepen+"deg)";
	} else if(navigator.userAgent.match("Firefox")){
		elem.style.MozTransform = "rotate("+stepen+"deg)";
	} else if(navigator.userAgent.match("MSIE")){
		elem.style.msTransform = "rotate("+stepen+"deg)";
	} else if(navigator.userAgent.match("Opera")){
		elem.style.OTransform = "rotate("+stepen+"deg)";
	} else {
		elem.style.transform = "rotate("+stepen+"deg)";
	}
	looper = setTimeout('rotateAnimation(\''+el+'\','+brzina+')',brzina);
	stepen++;
	if(stepen > 359){
		stepen = 1;
	}
}

/* UPDATE SVIH ELEMENATA */
function updateFonts(){
    var procent = 1366 / document.body.offsetWidth;
	var broj = 100 / procent;
	//alert(broj);
	if(broj < 75) return;
	$('body').css('font-size', broj+'pt');
}

/*================*/
/* LOGIN SEKCIJA */
	var _cover_prikazan = false;
	function prikaziCover(){
		/* CRNI COVER */
		if(!_cover_prikazan){
			//$('#__header_cover').animate({overflow:'visible'}, 800);
			$('#__header_cover').fadeIn(800);
			$("html, body").css('overflow', 'hidden');
			_cover_prikazan=true;
		} else {
			//$('#__header_cover').animate({overflow:'hidden'}, 800);
			$('#__header_cover').fadeOut(800);
			$("html, body").css('overflow', 'visible');
			_cover_prikazan = false;
		}
	}
	function loginSekcija(){
		// SVI LINKOVI VEZANI ZA LOGIN
		$('#_header_login_link').click(function(){
			// klik iz menija
			prikaziCover();
			prikaziLoginSekciju();
		});

		// ZATVARANJE SEKCIJE
		$('#__header_login_sekcija_btnZatvori').click(function(){
			if(_cover_prikazan) {
				prikaziCover(); 
				prikaziLoginSekciju(); 
				$('#__header_login_sekcija_user').val("Username");
				$('#__header_login_sekcija_pass').val("Sifra");
			}
		});

		// ULAZNE INFORMACIJE
		$('#__header_login_sekcija_user').focus(function(){
			//fokus na unos username-a
			if($('#__header_login_sekcija_user').val() == "Username") $('#__header_login_sekcija_user').val("");
		});
		$('#__header_login_sekcija_user').focusout(function(){
			if($('#__header_login_sekcija_user').val() == "") $('#__header_login_sekcija_user').val("Username");
		});
		$('#__header_login_sekcija_pass').focus(function(){ // cistenje passworda
			$('#__header_login_sekcija_pass').val("");
		});

		// SLANJE PODATAKA
		$('#__header_login_sekcija_btnPotvrdi').click(function(){
			var err= provjeraUnosaZaLogin();
			if(err == "") {
				$('#__header_login_sekcija_btnPotvrdi').prop('disabled', true);
				ajax_slanje($('#__header_login_sekcija_user').val(), $('#__header_login_sekcija_pass').val());
			} else {
				$('#__header_login_sekcija_btnPotvrdi').prop('disabled', true);
				ajax_slanje("err", err);
			}
		});
	}
	function prikaziLoginSekciju(){
		if(_cover_prikazan){
			$('.__header_login_sekcija').fadeIn(1000);
		} else {
			$('.__header_login_sekcija').fadeOut(1000);
		}
	}
	function provjeraUnosaZaLogin(){
		var greska = "";
		if($('#__header_login_sekcija_user').val() == "" || $('#__header_login_sekcija_user').val() == "Username"){
			greska = "noKIme";
		} 
		if(greska==""&& provjeraKaraktra($('#__header_login_sekcija_user').val())) {
			greska = "noZnak";
		}
		if(greska=="" && $('#__header_login_sekcija_pass').val() == "" || greska=="" && $('#__header_login_sekcija_pass').val() == "Sifra"){
			greska = "noPass";
		} 
		if(greska=="" && provjeraKaraktra($('#__header_login_sekcija_pass').val())) {
			greska = "noZnak";
		}
		return greska;
	}
	function provjeraKaraktra(data){
		var iChars = "@#$%^&*()+=-[]\\\';/{}|\":<>~_., ";
   		for (var i = 0; i < data.length; i++) {
   			if (iChars.indexOf(data.charAt(i)) != -1) {
   				return true;
   			}
  		}
		return false;
	}
	function prikazGreska(msg){
		//alert(msg);  
		$('#__header_login_sekcija_greska').css('opacity', 0);
		$('#__header_login_sekcija_greska').text(msg);
		$('#__header_login_sekcija_greska').animate({'opacity':1}, 300);
		setTimeout(function(){
			$('#__header_login_sekcija_greska').animate({'opacity':0}, 300);
		}, 5000);
	}
	function ajax_slanje(user, pass){
		var x;
		if(window.XMLHttpRequest) x= new XMLHttpRequest();
		else x = new ActiveXObject("Microsoft.XMLHTTP");
		x.onreadystatechange = function(){
			if(x.readyState == 4 && x.status == 200) { 
				$('#__header_login_sekcija_btnPotvrdi').prop('disabled', false);
				if(x.responseText !="") prikazGreska(x.responseText);
				else location.reload();
			}
		};
		x.open("GET", "engine/clan/login.php?user="+user+"&pass="+pass); x.send();	
	}

	var __header_pretraga_unos_fisrt = true;
	function pretragaSekcija(){
		// SVI LINKOVI VEZANI ZA LOGIN
		$('#__header_menu_pretraga').click(function(){
			// klik iz menija
			prikaziCover();
			prikaziPretragaSekciju();
		});

		// ZATVARANJE SEKCIJE
		$('#__header_pretraga_btnZatvori').click(function(){
			if(_cover_prikazan) {
				prikaziCover(); 
				prikaziPretragaSekciju(); 
				$('#__header_pretraga_unos').val("Pretraga");
			}
		});

		// ULAZNE INFORMACIJE

		$('#__header_pretraga_unos').focus(function(){
			if(__header_pretraga_unos_fisrt) { $('#__header_pretraga_unos').val(""); __header_pretraga_unos_fisrt = false; }
		});

		$('#__header_pretraga_btnPotvrdi').click(function(){
			if($('#__header_pretraga_unos').val() != "") window.location = "pretraga.php?kljuc=" + $('#__header_pretraga_unos').val() + "&str=1";
		});
	}
	function prikaziPretragaSekciju(){
		if(_cover_prikazan){
			$('.__header_pretraga_sekcija').fadeIn(1000);
		} else {
			$('.__header_pretraga_sekcija').fadeOut(1000);
		}
	}

	/*
		MIJENJANJE JEZIKA
	*/
	function mijenjanjeJezika(){
		$('.__header_mijenjanjeJezika').click(function(){
			//alert("engine/jezici/jezici_init.php?postavi="+$(this).attr('id')+"&str="+window.location);
			window.location = "engine/jezici/jezici_init.php?postavi="+$(this).attr('id')+"&str="+window.location;
		});
	}