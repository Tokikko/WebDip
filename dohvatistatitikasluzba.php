<?php

include_once 'baza.class.php';
$baza = new baza();
$baza->spojiBaza();
$json = array();
$upit = "SELECT ks.naziv, COUNT( r.naziv ) 
FROM kurirska_sluzba ks
JOIN ruta r ON ks.id_kurirskasluzba = r.kurirskasluzba
JOIN paketPostar pp ON pp.ruta = r.id_ruta
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