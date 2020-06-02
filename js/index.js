var ucitaneSlike = new Array();
var neUcitaneSlike = new Array();
$(window).load(function(){ 
	if(__offline=='da') return;
	$('#preloader_white').hide();
	$('#preloader').fadeOut(500, function(){ 
		$("html, body").css('overflow', 'visible');

		// into animacije za naslov i tablu
		intoAnimate();
	});
});
$(document).ready(function(e) {
	// Ucitavanje, sakrivanje scrollera
	$("html, body").css('overflow', 'hidden');
	$('#preloader').fadeIn(1000); 

	// Ucitavanje slika. Prvo ceka da se ucitaju
	$('#sjenka').waitForImages(function(){
		$('#sjenka').fadeIn();	
		initSlike(); 
	});

	// Animacija table pri hoveru
	animateTablu();

	// Animate poslednjih vijesti
	animateVijesti();
});

function initSlike(){
	var kolicinaSlika = __dostupneSlike.length;
	var viseSlika = false;
	
	for(var i = 0; i < 12; i++){
		var rand = Math.floor(Math.random() * (__dostupneSlike.length - 1));
		var info_s = __dostupneSlike[rand];
		__dostupneSlike.splice(rand, 1);
		
		ucitaneSlike.push(info_s);
		$('#s'+i).hide();
		$('#s'+i).css('background-image', 'url('+info_s+')');
		$('#s'+i).waitForImages(function(){ $('#s'+i).fadeIn(5000); });
	}
	
	if(kolicinaSlika > 12){
		viseSlika = true;
		for(var ii=0; ii <= __dostupneSlike.length; ii++){
			neUcitaneSlike.push(__dostupneSlike[ii]);
		}
	}
	__dostupneSlike = new Array();
	if(!viseSlika) return;
	
	// ANIMACIJA PROMJENE
	setInterval(function(){
		// preuzimanje slucajnog diva i jnegov fade
		var indx_x = Math.floor(Math.random()*12);
		var indx_y = Math.floor(Math.random() * (neUcitaneSlike.length - 1));
		$('#s'+indx_x).animate({opacity: 0}, 1500, function(){
			//animacija promjene
			$('#s'+indx_x).css('background-image', 'url('+neUcitaneSlike[indx_y]+')');
			$('#s'+indx_x).load(function(){}).animate({opacity:1}, 1500);
			
			// rotacija promjene
			var info_trenutneSlike = ucitaneSlike[indx_x];
			ucitaneSlike[indx_x] = neUcitaneSlike[indx_y];
			neUcitaneSlike[indx_y] = info_trenutneSlike;			
		});		
	}, 5000);
}

// PROMJENA VIJESTI
function intoAnimate(){
	// Uvodna animacija
	$('#kontenjer_informacija_naslov').css({'top':'80%', 'opacity':0});
	$('#kontenjer_informacija_naslov').animate({'top':'25%', 'opacity':1}, 1000);

	animateDugmad();

	$('#__index_present_grupe').css({'top':'100%', 'opacity':0});
	$('#__index_present_grupe').animate({'top':'80%', 'opacity':1}, 500);

	$('.grupe_td').click(function(){
		animateNaslov($(this).children('.td_naslov').text(), $(this).children('.td_opis').text(), $(this).children('#td_link').html(), $(this).children('#td_menu').html());
		$('#grupe_td_selektovan').removeAttr('id');
		$(this).attr('id', 'grupe_td_selektovan');
	});
}
function animateDugmad(){
	$('#__index_present_dodatniMenu .__dodatniMenu_btn').hover(function(){
		$(this).stop().animate({'background-color':'rgba(255, 255, 255, 0.5)', 'color':'#000'}, 300);
	}, function(){
		$(this).stop().animate({'background-color':'rgba(0, 0, 0, 0.5)', 'color':'#FFF'}, 800);
	});
}
function animateNaslov(naslov, tekst, link, menu){
	$('#kontenjer_informacija_naslov').animate({'top':'10%', 'opacity':0}, 800, function() {
	$('#kontenjer_informacija_naslov').css({'top':'50%', 'opacity':0});

	$('#kontenjer_informacija_naslov').children('h1').html(naslov);
	$('#kontenjer_informacija_naslov').children('h2').html(tekst);
	$('#kontenjer_informacija_naslov').children('h3').html(link);
	$('#kontenjer_informacija_naslov').children('#__index_present_dodatniMenu').html(menu);
	$('#kontenjer_informacija_naslov').animate({'top':'25%', 'opacity':1}, 800);
	animateDugmad();
	});
}
// / PROMJENA VIJESTI

// Animacija table pri hoveru
function animateTablu(){
	//tabela sa naslovne strane
	$('.grupe_td').hover(function(){
		$(this).stop().animate({backgroundColor:'rgba(0, 0, 0, 0.5)'}, 800);
	}, function(){
		$(this).stop().animate({backgroundColor:'rgba(0, 0, 0, 0)'}, 1000);
	});	
}


/*
	POSLEDNJE VIJESTI
*/
function animateVijesti(){
	// LINK KA NOVOSTIMA
	$('#pn_poslednjeNovosti').hover(function(){
		$(this).animate({'color':'rgb(40, 102, 233)'}, 300);
	}, function(){
		$(this).animate({'color':'#000'}, 300);
	});
	$('#pn_poslednjeNovosti').click(function(){
		window.location = "novosti.php";
	});

	// POSLEDNJA
	$('.pn_boksovi_poslednja').stop().hover(function(){
		$(this).children('#pn_boksNaslov').stop(false, false).animate({top:'63.5%'}, 400);
		$(this).children('#pn_boksOpis').stop(false, false).animate({'opacity':1}, 600);
	}, function(){
		$(this).children('#pn_boksNaslov').stop(false, false).animate({top:'82%'}, 400);
		$(this).children('#pn_boksOpis').stop(false, false).animate({'opacity':0}, 600);
	});
	$('.pn_boksovi_poslednja').click(function(){
		window.location = "novost.php?" + $(this).attr('id');
	});

	// OSTALE
	$('.boks').stop().hover(function(){
		$(this).children('.boksNaslov').stop(false, false).animate({top:'40%'}, 400);
		$(this).children('.boksOpis').stop(false, false).animate({'opacity':1}, 600);
	}, function(){
		$(this).children('.boksNaslov').stop(false, false).animate({top:'65%'}, 400);
		$(this).children('.boksOpis').stop(false, false).animate({'opacity':0}, 600);
	});
	$('.boks').click(function(){
		window.location = "novost.php?" + $(this).attr('id');
	});
}
