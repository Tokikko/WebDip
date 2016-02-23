var statistika = document.getElementById("btnStatistika");

var datum1 = document.getElementById("datepicker");
var datum2 = document.getElementById("datepicker1");

function pretrazi(){

	alert (datum2.value);
	alert (datum1.value);
	var vrijednost = datum1.value + "???" + datum2.value;
	alert(vrijednost);
	window.location.href = "statistikapretraga.php?vrijednost=" + vrijednost;
	}


statistika.addEventListener("click", pretrazi);