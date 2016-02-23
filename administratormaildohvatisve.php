<?php
include_once 'baza.class.php';
include_once 'greske.php';
include_once 'dnevnik.php';
$baza = new baza();
$baza->spojiBaza();
$json = array();
$upit = "SELECT k.korisnickoIme, k.adresa, k.grad, pp.statusIsporuke
FROM korisnik k
LEFT JOIN paketZahtjev pz ON k.id_korisnik = pz.korisnik
LEFT JOIN paketPostar pp ON pz.id_zahtjev = pp.zahtjev
WHERE pp.statusIsporuke =  '2'";
if ($postari = $baza->selectUpit($upit)){
    $j = 0;
    $i = 1;
    while($red = $postari->fetch_array()){
        $json[$j] = $red['korisnickoIme'];
        $j += 1;
        $json[$j] = $red['adresa'];
        $j += 1;
        $json[$j] = $red['grad'];
        $j += 1;
        $json[$j] = $red['statusIsporuke'];
        $j += 1;
        
      
    }
    
    echo json_encode($json);
}
?>


