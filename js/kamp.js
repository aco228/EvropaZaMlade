$(window).load(function(){ 
	$('#background_image').fadeIn(1500);
});
$(document).ready(function(){

	if(enable){
		$('.glavneInfo').attr("disabled",true);
		$('.kontenjerInfo').attr("disabled",true);
		$('.kontenjerText').attr("disabled",true);
	}

	$('#btn_addLista').click(function(){ 
		if(listUSER=="") return;
		var data = getData(); 
		if(data!="") ajax("addLista", getDataList()); 
		else alert("Greska");
	});
	$('#btn_dellLista').click(function(){ 
		if(listUSER=="") return;
		data = "&id_kampa="+listID+"&clan="+listUSER;
		ajax("dellLista", data); ;
	});
	$('#btn_save').click(function(){ 
		var data = getData(); 
		if(data!="") ajax("save", getData()); 
		else alert("Greska");
	});
	$('#btn_dell').click(function(){ ajax("dell", ""); });

	setAutoSize();

	$('#btn_dark').click(function(){ zamracenje_pozadine(); });
});

	function ajax(akcija, data){
		sacekaj(); 
		data = "&akcija="+akcija+"&id="+id+data;
		$.ajax({
           type: "POST",
           url: "engine/kamp/kamp_komunikator.php",
           data: data, 
           success: function(odgovor){
               alert(odgovor); location.reload();
           }
        }); 
	}
	function sacekaj(){
		$('#btn_addLista').val(sacekaj_lang);
		$('#btn_dellLista').val(sacekaj_lang);
		$('#btn_save').val(sacekaj_lang);
		$('#btn_dell').val(sacekaj_lang);
		$('#btn_addLista').attr("disabled", "true");
		$('#btn_dellLista').attr("disabled", "true");
		$('#btn_save').attr("disabled", "true");
		$('#btn_dell').attr("disabled", "true");
	}

	function getData(){
		if(isEmpty()) return ""; 
		var back = "";
			back+= "&ime_kampa="+$('#ime_kampa').val();
			back+= "&kod_kampa="+$('#kod_kampa').val();
			back+= "&organizacija="+$('#organizacija').val();

			back+= "&lokacija_kampa="+$('#lokacija_kampa').val();
			back+= "&regija_kampa="+$('#regija_kampa').val();
			back+= "&jezik_kampa="+$('#jezik_kampa').val();

			back+= "&ukupanBrojVolontera="+$('#ukupanBrojVolontera').val();
			back+= "&dodatniTroskovi="+$('#dodatniTroskovi').val();
			back+= "&minimumGodina="+$('#minimumGodina').val();
			back+= "&maksimumGodina="+$('#maksimumGodina').val();

			back+= "&opis_kampa="+$('#opis_kampa').val();
			back+= "&opis_posla="+$('#opis_posla').val();
			back+= "&opis_lokacije="+$('#opis_lokacije').val();
			back+= "&opis_potreba="+$('#opis_potreba').val();
			back+= "&dodatne_info="+$('#dodatne_info').val();
		return back;
	}
	function getDataList(){
		if(isEmpty()) return ""; 
		var back = "";
			back+= "&clan_lista="+listUSER;
			back+= "&id_kampa="+listID;
			back+= "&ime_kampa="+$('#ime_kampa').val();
			back+= "&kod_kampa="+$('#kod_kampa').val();
			back+= "&zemlja="+listZemlja;
			back+= "&pocetakDan="+listPD;
			back+= "&pocetakMjesec="+listPM;
			back+= "&pocetakGodina="+listPG;
			back+= "&krajDan="+listKD;
			back+= "&krajMjesec="+listKM;
			back+= "&krajGodina="+listKG;
		return back;
	}
	function isEmpty(){
		if($('#ime_kampa').val()=="") return true;
		if($('#kod_kampa').val()=="") return true;
		if($('#organizacija').val()=="") return true;

		return false;
	}
	function setAutoSize(){
		$('#ime_kampa').autosize();
		$('.kontenjerText').autosize();
	}

	/*
		ZAMRACENJE POZADINE
	*/
	var zamraceno = false;
	function zamracenje_pozadine(){
		if(!zamraceno){
			$('#bacground_image_shadow').stop().animate({'background-color':'rgba(83, 83, 83, 0.81);'}, 1000);
			$('#btn_dark').val(langOdmraci);
			zamraceno = true;
		} else {
			$('#bacground_image_shadow').stop().animate({'background-color':'rgba(83, 83, 83, 0);'}, 1000);
			$('#btn_dark').val(langZamraci);
			zamraceno = false;
		}
	}