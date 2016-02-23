<?php

include_once 'baza.class.php';
$baza = new baza();
$baza->spojiBaza();
$json = array();
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];
$time1 = strtotime($date1);
$newformat1 = date('Y-m-d',$time1);
$time2 = strtotime($date2);
$newformat2 = date('Y-m-d',$time2);
$upit = "SELECT k.korisnickoIme, count(pz.korisnik)
FROM korisnik k
right JOIN paketZahtjev pz ON pz.korisnik = k.id_korisnik where pz.vrijeme > '$newformat1' and pz.vrijeme < '$newformat2'
GROUP BY 1 ";
if ($mjesto = $baza->selectUpit($upit)){
    $j = 0;
    $i = 1;
    while($red = $mjesto->fetch_array()){
        $json[$j] = $red[0];
        $j += 1;
        $json[$j] = $red[1];
        $j += 1;
        
      
    }
    
    echo json_encode($json);
}
?>