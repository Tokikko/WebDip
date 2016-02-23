<?php
include_once 'baza.class.php';
include_once 'dnevnik.php';
$baza = new baza();
$baza->spojiBaza();
$id = isset($_POST['id']) ? $_POST['id'] : false;
$tablica = isset($_POST['tablica']) ? $_POST['tablica'] : false;
$json = array();
$json2 = array();
if(isset($tablica) && isset($id)){
    if($tablica == "korisnik"){
     $upit = "SELECT * from ".$tablica." "."where id_korisnik = $id" ."";
    }
    
    if($tablica == "log"){
        $upit = "SELECT * from ".$tablica." "."where id_log = $id" ."";
    }
    if($tablica == "galerija"){
        $upit = "SELECT * from ".$tablica." "."where id_galerija = $id" ."";
    }
    
     if($tablica == "kurirskasluzbapostar"){
        $upit = "SELECT * from ".$tablica." "."where kurirskasluzbapostar = $id" ."";
    }
    
      if($tablica == "kurirska_sluzba"){
        $upit = "SELECT * from ".$tablica." "."where id_kurirskasluzba = $id" ."";
    }
    
      if($tablica == "mjesto"){
        $upit = "SELECT * from ".$tablica." "."where id_mjesto = $id" ."";
    }
    
      if($tablica == "mjesto_has_ruta"){
        $upit = "SELECT * from ".$tablica." "."where id_rutamjesto = $id" ."";
    }
    
      if($tablica == "paketPostar"){
        $upit = "SELECT * from ".$tablica." "."where id_paket = $id" ."";
    }
      if($tablica == "paketZahtjev"){
        $upit = "SELECT * from ".$tablica." "."where id_zahtjev = $id" ."";
    }
    
     if($tablica == "ruta"){
        $upit = "SELECT * from ".$tablica." "."where id_ruta = $id" ."";
    }
    
    if($tablica == "tippaket"){
        $upit = "SELECT * from ".$tablica." "."where id_tip = $id" ."";
    }
    
     if($test = $baza->ostaliUpiti($upit)){
            
            $i = 0;
            $pod1 = $test->fetch_array();
            while($imeStupaca = mysqli_fetch_field($test)) {
            $json2[$i]  = $imeStupaca->name;
            $i=$i+1;
        }
            
            $test = count($pod1);
            $test = $test /2;
            //$json[0] = $test;
            for ($j = 0; $j < $test; $j++){
                $json[$j][$json2[$j]] = $pod1[$j];
           
            }
            
          
            
          // echo json_encode($json);
           /* $json[$i]['korisnickoIme']  = $pod1['korisnickoIme'];
            $json[$i]['ime']  = $pod1['ime']; 
            $json[$i]['prezime']  = $pod1['prezime']; 
            $json[$i]['email']  = $pod1['email']; 
            $json[$i]['sifra']  = $pod1['sifra']; 
            $json[$i]['statuss']  = $pod1['status'];
            $json[$i]['tipKorisnika']  = $pod1['tipKorisnika'];
            $i+=1;
*/
     
     }
      echo json_encode($json);
     
}
?>
