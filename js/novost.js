$(document).ready(function(){

	$('#btn_promjeni').click(function(){
		$('#promjena_novosti').fadeIn(1000);
	$('#promjena_tekst').autosize();
	})

	$('#btn_save').click(function(){
		if( $('#pNaslov').val()=="" || $('#pOpis').val()=="" || $('#promjena_tekst').val()==""){ alert("Sva polja moraju biti ispunjena!"); return; }
		ajax("&novost="+ID+"&naslov="+$('#pNaslov').val()+"&opis="+$('#pOpis').val()+"&tekst="+$('#promjena_tekst').val());
	});	
});

	function ajax(data){
		$('#btn_save').val("Sačekajte...");
		$('#btn_save').attr("disabled", "true");
		$.ajax({
           type: "POST",
           url: "novost.php",
           data: data, 
           success: function(odgovor){
               alert(odgovor); location.reload();
           }
        }); 
	}