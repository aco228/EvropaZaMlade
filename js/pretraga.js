$(document).ready(function(){

	$('.blok').stop().hover(function(){
		$(this).children('.blok_slika').stop(false, false).animate({'background-size':'100%'}, 1500);
	}, function(){
		$(this).children('.blok_slika').stop(false, false).animate({'background-size':'200%'}, 1500);
	});
	$('.blok').click(function(){
		//alert("kamp.php?id=" + $(this).attr('id'));
		window.location = $(this).attr('id');
	});
	
	$('#btnPotvrdi').click(function(){
		if($('#unos_Username').val() != "") window.location = "pretraga.php?kljuc=" + $('#unos_Username').val() + "&str=1";
	});
	/*
		Unos podataka (Brisanje podataka)
	*/
	// Brisanje podataka iz unosa vremena pocetka/kraja kampa
	$('.input_no_error_dan').click(function(){
		if($(this).attr('id') == 'unos_dan' && $(this).val().length > 2) $(this).val(""); 
		if($(this).attr('id') == 'unos_godina' && $(this).val().length > 4) $(this).val(""); 
	});
	var prviPut = true;
	$('.input_no_error').click(function(){
		if(prviPut) { $(this).val(""); prviPut = false;
	}});

	/*
		Navigacija
	*/
	$('#' + str).css('background-color', 'rgb(25, 93, 239)');
	$('.navBtn').stop().hover(function(){
		if($(this).attr('id') == str) return;
		$(this).animate({'background-color':'rgb(25, 93, 239)'}, 200);
	}, function(){
		if($(this).attr('id') == str) return;
		$(this).animate({'background-color':'#efbf19'}, 100);
	});
	$('.navBtn').click(function(){
		if($(this).attr('id') == str) return;
		window.location = "pretraga.php?kljuc=" + kljuc + "&str=" + $(this).attr('id');
	});
});