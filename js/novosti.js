$(document).ready(function(){

	$('.blok').stop().hover(function(){
		$(this).children('.blok_slika').stop(false, false).animate({'background-size':'100%'}, 1500);
	}, function(){
		$(this).children('.blok_slika').stop(false, false).animate({'background-size':'200%'}, 1500);
	});
	$('.blok').click(function(){
		window.location = "novost.php?" + $(this).attr('id');
	});

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
		window.location = "novosti.php?str=" + $(this).attr('id');
	});
});