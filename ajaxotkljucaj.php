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
$email = isset($_POST['email']) ? $_POST['email'] : false;
$status = isset($_POST['status']) ? $_POST['status'] : false;
$json = array();
if(isset($email) && isset($status)){
    if($status == 1){
    $upit2 = "UPDATE korisnik SET status = 2 WHERE  email = '$email'";    
    if($baza->ostaliUpiti($upit2)){
           upisiLog("Rad s bazom", $_SESSION['korisnickoime']); 
           
            $upit = "SELECT korisnickoIme, ime, prezime,email, sifra, status, tipKorisnika  FROM korisnik";
            $pod = $baza->selectUpit($upit);
            $i = 0;
            while($pod1 = $pod->fetch_array()){
                $json[$i]['korisnickoIme']  = $pod1['korisnickoIme'];
                $json[$i]['ime']  = $pod1['ime']; 
                $json[$i]['prezime']  = $pod1['prezime']; 
                $json[$i]['email']  = $pod1['email']; 
                $json[$i]['sifra']  = $pod1['sifra']; 
                $json[$i]['statuss']  = $pod1['status'];
                $json[$i]['tipKorisnika']  = $pod1['tipKorisnika'];
                $i+=1;
}
        echo json_encode($json);
        }
    
    }
    
    if($status == 2){
    $upit2 = "UPDATE korisnik SET status = 1 WHERE  email = '$email'";    
    if($baza->ostaliUpiti($upit2)){
           upisiLog("Rad s bazom", $_SESSION['korisnickoime']); 
        
            $upit = "SELECT korisnickoIme, ime, prezime,email, sifra, status, tipKorisnika  FROM korisnik";
            $pod = $baza->selectUpit($upit);
            $i = 0;
            while($pod1 = $pod->fetch_array()){
                $json[$i]['korisnickoIme']  = $pod1['korisnickoIme'];
                $json[$i]['ime']  = $pod1['ime']; 
                $json[$i]['prezime']  = $pod1['prezime']; 
                $json[$i]['email']  = $pod1['email']; 
                $json[$i]['sifra']  = $pod1['sifra']; 
                $json[$i]['statuss']  = $pod1['status'];
                $json[$i]['tipKorisnika']  = $pod1['tipKorisnika'];
                $i+=1;
            }
            echo json_encode($json);
        }
    }
}
?>
