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
$json = array();
$upit = "SELECT id_kurirskasluzba,naziv from kurirska_sluzba";
if ($postari = $baza->selectUpit($upit)){
    $j = 0;
    $i = 1;
    while($red = $postari->fetch_array()){
        $json[$j] = $red['id_kurirskasluzba'];
        $j += 1;
        $json[$j] = $red['naziv'];
        $j += 1;
        
      
    }
    
    echo json_encode($json);
}
?>
