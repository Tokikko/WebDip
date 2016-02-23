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
$upit = "SELECT id_kurirskasluzba, ks.naziv, kilometraza, vrijemeDostava, id_ruta, m.naziv AS odrediste, m1.naziv AS polaziste
FROM kurirska_sluzba ks
JOIN ruta r ON ks.id_kurirskasluzba = r.kurirskaSluzba
JOIN mjesto m ON r.odrediste = m.id_mjesto
JOIN mjesto m1 ON r.polaziste = m1.id_mjesto";
$pod = $baza1->selectUpit($upit);
$i = 0;
while($pod1 = $pod->fetch_array()){
    $json[$i]['id_kurirskasluzba']  = $pod1['id_kurirskasluzba'];
    $json[$i]['naziv']  = $pod1['naziv']; 
    $json[$i]['kilometraza']  = $pod1['kilometraza']; 
    $json[$i]['vrijemeDostava']  = $pod1['vrijemeDostava']; 
    $json[$i]['id_ruta']  = $pod1['id_ruta']; 
    $json[$i]['odrediste']  = $pod1['odrediste'];
    $json[$i]['polaziste']  = $pod1['polaziste'];
    $i+=1;
}
echo json_encode($json);


?>

