<?php
ob_start();
include_once 'baza.class.php';
include_once 'greske.php';
include_once 'dnevnik.php';
$baza = new baza();
$baza->spojiBaza();
$ruta = $_POST['ruta'];
$j = 0;
$json = array();
$upit = "select m.naziv from mjesto m left join mjesto_has_ruta mhr on m.id_mjesto = mhr.mjesto left JOIN ruta r on r.id_ruta = mhr.ruta where r.id_ruta = '$ruta'";
 if($test = $baza->ostaliUpiti($upit)){
        $j = 0;
 
        while($red = $test->fetch_array()){
        $json[$j] = $red[0];
        $j += 1;
        
      
    }
            
           
     
     }
      echo json_encode($json);

?>
