<?php
ob_start();
include_once 'baza.class.php';
include_once 'greske.php';
include_once 'dnevnik.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
upisiLog("Rad s bazom", $_SESSION['korisnickoime']); 
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
    
    $i = 0;
    while($red = $mjesto->fetch_array()){
        $j = 0;
        $json[$i][$j] = $red[0];
        $j += 1;
        $json[$i][$j] = (int)$red[1];
        $j += 1;
        $i += 1;
      
    }
$fp = fopen('korisnikchart.json', 'wb');
fwrite($fp, json_encode($json));
fclose($fp);
    
}

?>

