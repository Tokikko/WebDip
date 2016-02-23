<?php

include_once 'baza.class.php';

$baza = new baza();
$baza->spojiBaza();
$json = array();
$upit = "SELECT * from tippaket";
if ($mjesto = $baza->selectUpit($upit)){
    $j = 0;
    $i = 1;
    while($red = $mjesto->fetch_array()){
        $json[$j] = $red['id_tip'];
        $j += 1;
        $json[$j] = $red['opis'];
        $j += 1;
        
      
    }
    
    echo json_encode($json);
}
?>
