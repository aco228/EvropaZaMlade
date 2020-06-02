$(document).ready(function(){
	if(_header_show == 1){
		$('._header_').css('display', 'block');
		$('#_naslov_teksta').css('display', 'block');
		$('#_opis_teksta').css('display', 'block');
	}
	provjeraUsername();
	provjeraSifre();
	provjeraEmail();
	provjeraImena();
	provjeraPrezimena();
	provjeraDatuma();
	provjeraMjesta();
	_potvrda();
});

/*
	USERNAME
*/
	var usernameBool = false;
	function provjeraUsername(){
		$('#unos_Username').focusout(function(){
			var back = bazicnaProvjera($('#unos_Username').val()); 
			if(back != ""){
				// BAZICKA PROVJERA
				$(this).removeClass("input_no_error").addClass("input_error");
				error('unos_Username', back);
				usernameBool = false;
			} else {
				ajax_provjera("User", $('#unos_Username').val())
			}
		});
	}
	function provjeraUsername_back(res){
		if(res != ""){
			$('#unos_Username').removeClass("input_no_error").addClass("input_error");
			error('unos_Username', res);
			usernameBool = false;
		} else {
			$('#unos_Username').removeClass("input_error").addClass("input_no_error");
			usernameBool = true;
		}	
	}


/*
	SIFRA
*/
	var sifraBool = false;
	function provjeraSifre(){
		$('#unos_Sifra').focusout(function(){
			var back = bazicnaProvjera($('#unos_Sifra').val()); 
			if(back != ""){
				// BAZICKA PROVJERA
				$(this).removeClass("input_no_error").addClass("input_error");
				error('unos_Sifra', back);
				sifraBool = false;
			} else {
				$(this).removeClass("input_error").addClass("input_no_error");
				sifraBool = true;
			}
		});
	}

/*
	EMAIL
*/
	var emailBool = false;
	function provjeraEmail(){
		$('#unos_Email').focusout(function(){
			var back = provjeraEmail_unos($('#unos_Email').val()); 
			if(back != ""){
				// BAZICKA PROVJERA
				$(this).removeClass("input_no_error").addClass("input_error");
				error('unos_Email', back);
				emailBool = false;
			} else {
				ajax_provjera("Email", $('#unos_Email').val())
			}
		});
	}
	function provjeraEmail_unos(unos){
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(unos == ""){ return err_prazanString; }
		if(unos.length < 4){ return err_manjeOd3; }
		if (!filter.test(unos)) return err_formatEmail;
		return ""; 
	}
	function provjeraEmail_back(res){
		if(res != ""){
			$('#unos_Email').removeClass("input_no_error").addClass("input_error");
			error('unos_Email', res);
			emailBool = false;
		} else {
			$('#unos_Email').removeClass("input_error").addClass("input_no_error");
			emailBool = true;
		}	
	}

/*
	IME KORISNIKA
*/
	var imeBool = false;
	function provjeraImena(){
		$('#unos_Ime').focusout(function(){
			var back = bazicnaProvjera($('#unos_Ime').val()); 
			if(back != ""){
				// BAZICKA PROVJERA
				$(this).removeClass("input_no_error").addClass("input_error");
				error('unos_Ime', back);
				imeBool = false;
			} else {
				$(this).removeClass("input_error").addClass("input_no_error");
				imeBool = true;
			}
		});
	}

/*
	PREZIME KORISNIKA
*/
	var prezimeBool = false;
	function provjeraPrezimena(){
		$('#unos_Prezime').focusout(function(){
			var back = bazicnaProvjera($('#unos_Prezime').val()); 
			if(back != ""){
				// BAZICKA PROVJERA
				$(this).removeClass("input_no_error").addClass("input_error");
				error('unos_Prezime', back);
				prezimeBool = false;
			} else {
				$(this).removeClass("input_error").addClass("input_no_error");
				prezimeBool = true;
			}
		});
	}

/*
	PROVJERA DATUMA
*/
	var datum1Bool = false;
	var datum2Bool = false;
	function provjeraDatuma(){
		// DAN
		$('#unos_dan').val(unos_dan); 
		$('#unos_dan').focus(function(){
			if($('#unos_dan').val() == unos_dan) $('#unos_dan').val("");
		});
		$('#unos_dan').focusout(function(){
			if($('#unos_dan').val() == "") $('#unos_dan').val(unos_dan);
			else {
				if(!IsNum($('#unos_dan').val()) || $('#unos_dan').val() <1 || $('#unos_dan').val() > 31) {
					$(this).removeClass("input_no_error_dan").addClass("input_error_dan");
					error('unos_Datum', err_datum);
					datum1Bool = false;
				} else {
					$(this).removeClass("input_error_dan").addClass("input_no_error_dan");
					datum1Bool = true;
				}
			}
		});

		// GODINA
		$('#unos_godina').val(unos_godina);
		$('#unos_godina').focus(function(){
			if($('#unos_godina').val() == unos_godina) $('#unos_godina').val("");
		});
		$('#unos_godina').focusout(function(){
			if($('#unos_godina').val() == "") $('#unos_godina').val(unos_dan);
			else {
				if(!IsNum($('#unos_godina').val()) || $('#unos_godina').val() < 1900 || $('#unos_godina').val() > 2200) {
					$(this).removeClass("input_no_error_dan").addClass("input_error_dan");
					error('unos_Datum', err_datum);
					datum2Bool = false;
				} else {
					$(this).removeClass("input_error_dan").addClass("input_no_error_dan");
					datum2Bool = true;
				}
			}
		});
	}

/*
	MJESTO STANOVANJA
*/
	var mjestoBool = false;
	function provjeraMjesta(){
		$('#unos_Mjesto').focusout(function(){
			var back = bazicnaProvjera($('#unos_Mjesto').val()); 
			if(back != ""){
				// BAZICKA PROVJERA
				$(this).removeClass("input_no_error").addClass("input_error");
				error('unos_Mjesto', back);
				mjestoBool = false;
			} else {
				$(this).removeClass("input_error").addClass("input_no_error");
				mjestoBool = true;
			}
		});
	}

/*
	PROVJERA VEF FORME
*/
	function provjeraVefForme(){
		if($('#zanimanje').val()=="") return true;
		if($('#zdrastvene_napomene').val()=="") return true;
		if($('#jezik').val()=="") return true;
		if($('#nacionalnost').val()=="") return true;
		if($('#broj_pasosa').val()=="") return true;
		if($('#pasos_kadaIzdat').val()=="") return true;
		if($('#pasos_doKadTraje').val()=="") return true;
		if($('#ime_roditelja').val()=="") return true;
		if($('#predhodno_volonterskoIskustvo').val()=="") return true;
		if($('#zbog_cega').val()=="") return true;
		if($('#opste_napomene').val()=="") return true;
		return false;
	}


/*
	POTVRDA
*/
	function _potvrda(){
		$('#btnPotvrdi').val(btn_potvrda);
		$('#btnPotvrdi').click(function(){
			provjeraSifre();
			provjeraEmail();
			provjeraMjesta();

			if(usernameBool && sifraBool && emailBool && imeBool && prezimeBool && datum1Bool && datum2Bool && mjestoBool && !provjeraVefForme()){
				//alert($('#zanimanje').val()); return;
				$(this).prop('disabled', true); $('#btnPotvrdi').val(btn_sacekaj);
				ajax($('#unos_Username').val(), $('#unos_Sifra').val(), $('#unos_Email').val(), 
					$('#unos_Ime').val(), $('#unos_Prezime').val(), $('#unos_dan').val(),
					$('#datum_rodjenja').val(), $('#unos_godina').val(), $('#pol_korisnika').val(), $('#unos_Mjesto').val(), 
					$('#zanimanje').val(), $('#zdrastvene_napomene').val(), $('#jezik').val(), $('#nacionalnost').val(), $('#broj_pasosa').val(),
					$('#pasos_kadaIzdat').val(), $('#pasos_doKadTraje').val(), $('#ime_roditelja').val(), $('#predhodno_volonterskoIskustvo').val(), 
					$('#zbog_cega').val(), $('#opste_napomene').val());
			} else {
				error('btnPotvrdi', err_ok);
			}
		});
	}



/*
	=========================================================
	GLOBALNE FUNKCIJE
	=========================================================
*/
function ajax_provjera(acc, unos){
		var x;
		if(window.XMLHttpRequest) x= new XMLHttpRequest();
		else x = new ActiveXObject("Microsoft.XMLHTTP");
		x.onreadystatechange = function(){
			if(x.readyState == 4 && x.status == 200) { 
				if(acc=="User") provjeraUsername_back(x.responseText);
				else if(acc=="Email") provjeraEmail_back(x.responseText);
			}
		};
		x.open("GET", "engine/clan/registracija.php?akcija=pro"+acc+"&unos="+unos); x.send();	
}
function ajax(u,p,e,i,pre,rd,rm,rg,pol,mjesto, zanimanje, zdrastvene_napomene, jezik, nacionalnost, broj_pasosa, pasos_kadaIzdat, pasos_doKadTraje, ime_roditelja, predhodno_volonterskoIskustvo, zbog_cega, opste_napomene){
		/*alert(u + "\n" + p + "\n" + e + "\n" + i + "\n" + pre + "\n" + rd + "\n" + rm + "\n" + rg + "\n" + pol + "\n" + mjesto + "\n" + opis 
				+ "\n" + zanimanje + "\n" + zdrastvene_napomene + "\n" + jezik + "\n" + nacionalnost + "\n" + broj_pasosa + "\n" + pasos_kadaIzdat
				+ "\n" + pasos_doKadTraje + "\n" + ime_roditelja + "\n" + predhodno_volonterskoIskustvo);
		return;*/
		var x;
		if(window.XMLHttpRequest) x= new XMLHttpRequest();
		else x = new ActiveXObject("Microsoft.XMLHTTP");
		x.onreadystatechange = function(){
			if(x.readyState == 4 && x.status == 200) { 
				$('#btnPotvrdi').val(btn_potvrda);
				$('#btnPotvrdi').prop('disabled', false);
				error('btnPotvrdi', x.responseText);
			}
		};
		x.open("GET", "engine/clan/registracija.php?akcija=put&user="+u+"&pas="+p+"&email="+e+"&ime="+i+"&prez="+pre+"&rdan="+rd+"&rmje="+rm+"&rgod="+rg+
			"&pol="+pol+"&mjesto="+mjesto+"&zanimanje="+zanimanje+"&zdrastvene_napomene="+zdrastvene_napomene+"&jezik="+jezik+
			"&nacionalnost="+nacionalnost+"&broj_pasosa="+broj_pasosa+"&pasos_kadaIzdat="+pasos_kadaIzdat+"&pasos_doKadTraje="+pasos_doKadTraje+
			"&ime_roditelja="+ime_roditelja+"&predhodnoIskustvo="+predhodno_volonterskoIskustvo+"&zbog_cega="+zbog_cega+"&opste_napomene="+opste_napomene); x.send();	
}
function IsNum(input)
{
    return (input - 0) == input && (input+'').replace(/^\s+|\s+$/g, "").length > 0;
}
function bazicnaProvjera(unos){
	if(unos == ""){ return err_prazanString; }
	if(unos.length < 4){ return err_manjeOd3; }
	if(provjeraKaraktra(unos)) return err_nedozvoljenZnak;
	return "";
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
function error(id, err){
	$('#err_'+id).css('opacity',0);
	$('#err_'+id).text(err);
	$('#err_'+id).animate({'opacity':1}, 800);
	setTimeout(function(){
		$('#err_'+id).animate({'opacity':0});
	}, 8000);
}