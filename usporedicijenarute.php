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
$upit = "select r.naziv as Ruta,r.cijena as Cijena,r.vrijemeDostava as VrijemeDostave, r.kilometraza as Kilometraza,  ks.naziv as KurirskaSluzba, opis as TipDostave from ruta r left join kurirska_sluzba ks on r.kurirskaSluzba = ks.id_kurirskasluzba  left join tippaket tp on r.tip = tp.id_tip where r.naziv = '$ruta'";
 if($test = $baza->ostaliUpiti($upit)){
            
            $i = 0;
        
                $x = 0;
                while($test1 = $test->fetch_array()){
                    for ($j = 0; $j < 6; $j++){
                $json[$x] = $test1[$j];
                $x += 1;
                }
           
            }
            
            
           
     
     }
      echo json_encode($json);

?>
