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
if(isset($_POST['btnCRUD'])){
    //$tablica = $_POST['imeTablica'];
    //echo $tablica;
    foreach ($_POST as $kljuc=>$vrijednost){
            $polje[$kljuc]=$vrijednost;
            
        }
    $tablica = $polje['imeTablica'];
    $upit = "UPDATE ".$tablica." SET ";
    array_pop($polje);
    array_pop($polje);
    foreach($polje as $kljuc=>$vrijednost){
        $upit .= $kljuc. "="."'".$vrijednost."'".",";
    }
    
    substr($upit, 0, -2);
    $upit2 = mb_substr($upit, 0, -1, 'UTF-8');
    
     foreach($polje as $kljuc=>$vrijednost){
        $upit2 .= " WHERE " .$kljuc."="."'".$vrijednost."'"."";
        break;
    }
    
    if($baza->ostaliUpiti($upit2)){
        upisiLog("Rad s bazom", "ASMO TEST"); 
    
    }
    
    header( 'Location: administracijatablica.php' ) ;
}
?>