$(document).ready(function($) {
	alert("load");
	$('#registracija_korisnickoime').keyup(function (e){
		
		var username = $(this).val();
		$.post('avalible.php'), {'username':username}, function(data){
			$("provjeraime").html(data);
		}
	});
});
