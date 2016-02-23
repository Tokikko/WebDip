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
$baza1 = new baza();
$baza1->spojiBaza();
$json = array();
$mjesto = isset($_POST['grad']) ? $_POST['grad'] : false;
$tip = isset($_POST['paket']) ? $_POST['paket'] : false;
$i = 0;
if(isset($mjesto)){
    
    $upit = "SELECT DISTINCT ks.id_kurirskasluzba, ks.naziv  FROM kurirska_sluzba ks LEFT JOIN ruta r ON ks.id_kurirskasluzba = r.kurirskaSluzba LEFT JOIN mjesto_has_ruta mhr ON mhr.ruta = r.id_ruta
            LEFT JOIN mjesto m ON m.id_mjesto = mhr.mjesto
            WHERE m.naziv='$mjesto'";
    if($test = $baza1->ostaliUpiti($upit)){
       while( $pod1 = $test->fetch_array()){
        $json[$i] = $pod1[0];
        $i += 1;
        $json[$i] = $pod1[1];
        $i += 1;
       }
    }
    
    echo json_encode($json);
}
?>
