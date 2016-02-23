<?php
ob_start();
include_once 'baza.class.php';
include_once 'greske.php';
include_once 'dnevnik.php';
$baza = new baza();
$baza->spojiBaza();

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
upisiLog("Rad s bazom", $_SESSION['korisnickoime']); 
$j = 0;
$json = array();
$upit = "select ruta, ime from paketPostar where statusIsporuke = '0'";
 if($test = $baza->ostaliUpiti($upit)){
        $j = 0;
 
        while($red = $test->fetch_array()){
        $json[$j] = $red[0];
        $j += 1;
        $json[$j] = $red[1];
        $j += 1;
    }
            
           
     
     }
      echo json_encode($json);

?>
