$(document).ready(function(){
	$('#clan_btn_odjava').click(function(){ window.location="clan.php?odjava=true"; });
	$('#clan_btn_adminSekcija').click(function(){ window.location = "admin.php"; });
	
	//
	//	Slanje aplikacije
	//
	$('#clan_btn_posaljiListu').click(function(){
		var broj_kampova = $('#desna_strana>table tr').size()-1;
		if(broj_kampova==0) { alert("Nemate kampova u vašoj listi!"); return; }
		else if(broj_kampova<4) { alert("Morate imati najmanje 4 kampa u vašoj listi!"); return; }
		else if(confirm('Da li ste sigurni da želite da pošaljete listu kampova?')) {
			ajax("posaljiListu"); 
		}
	});

	if(nsa) nsaHandle();
});

	function ajax(akcija){
		sacekaj(); 
		akcija = "&akcija="+akcija+"&user="+user;
		$.ajax({
           type: "POST",
           url: "engine/clan/clan_pozadinaEngine.php",
           data: akcija, 
           success: function(odgovor){
               sacekajOff();
               alert(odgovor); location.reload();
           }
        }); 
	}
	var odjavaCache = ""; var adminCache = ""; var posaljiCache = "";
	function sacekaj(){
		odjavaCache = $('#clan_btn_odjava').val();
		adminCache = $('#clan_btn_adminSekcija').val();
		posaljiCache = $('#clan_btn_posaljiListu').val();

		$('#clan_btn_odjava').val(sacekaj_lang);
		$('#clan_btn_odjava').attr("disabled", "true");
		$('#clan_btn_adminSekcija').val(sacekaj_lang);
		$('#clan_btn_adminSekcija').attr("disabled", "true");
		$('#clan_btn_posaljiListu').val(sacekaj_lang);
		$('#clan_btn_posaljiListu').attr("disabled", "true");

	}
	function sacekajOff(){
		$('#clan_btn_odjava').val(odjavaCache);
		$('#clan_btn_odjava').attr("disabled", "false");
		$('#clan_btn_adminSekcija').val(adminCache);
		$('#clan_btn_adminSekcija').attr("disabled", "false");
		$('#clan_btn_posaljiListu').val(posaljiCache);
		$('#clan_btn_posaljiListu').attr("disabled", "false");
	}
	function nsaHandle(){ 
		$('#clan_btn_odjava').hide();
		$('#clan_btn_adminSekcija').hide();
		$('#clan_btn_posaljiListu').hide();
		$('#potvrda_promjene').hide()
	}