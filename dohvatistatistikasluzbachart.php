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
$upit = "SELECT ks.naziv, COUNT( r.naziv ) 
FROM kurirska_sluzba ks
JOIN ruta r ON ks.id_kurirskasluzba = r.kurirskasluzba
JOIN paketPostar pp ON pp.ruta = r.id_ruta
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
$fp = fopen('sluzbachart.json', 'wb');
fwrite($fp, json_encode($json));
fclose($fp);
    
}

?>

