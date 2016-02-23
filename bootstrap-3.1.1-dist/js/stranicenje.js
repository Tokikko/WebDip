var stranicenje = document.getElementById("btnStranicenje");
var uzmiStranicenje = document.getElementById("stranicenje");
var prijava = document.getElementById("btnBrojPrijava");
var uzmiPrijavu = document.getElementById("brojprijava");
function stran(){
	var vrijednost = uzmiStranicenje.value;
	window.location.href = "stranicenje.php?vrijednost=" + vrijednost;
}

function prijavaOgr(){
	var vrijednost = uzmiPrijavu.value;

	window.location.href = "brojprijava.php?vrijednost=" + vrijednost;
}
prijava.addEventListener("click", prijavaOgr);
stranicenje.addEventListener("click", stran);
