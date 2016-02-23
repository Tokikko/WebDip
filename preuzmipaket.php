<?php
ob_start();
include_once 'baza.class.php';
include_once 'greske.php';
include_once 'dnevnik.php';
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
$baza = new baza();
$baza->spojiBaza();
$ime = $_SESSION['id_korisnik'];
upisiLog("Rad s bazom", $_SESSION['korisnickoime']); 
$json = array();
$upit = "SELECT pz.id_zahtjev,concat(pz.ime, pz.prezime) as imeprezim
FROM paketZahtjev pz
LEFT JOIN kurirska_sluzba ks ON ks.id_kurirskasluzba = pz.sluzba
LEFT JOIN kurirskasluzbapostar ON kurirskasluzbapostar.kurirskasluzba = pz.sluzba
WHERE kurirskasluzbapostar.postar =  '$ime' and pz.status = 0";
if ($mjesto = $baza->selectUpit($upit)){
    $j = 0;
 
    while($red = $mjesto->fetch_array()){
        $json[$j] = $red[0];
        $j += 1;
        $json[$j] = $red[1];
        $j += 1;
        
      
    }
    
    echo json_encode($json);
}

?>

