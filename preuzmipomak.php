<?php
function preuzmiPomak(){
$xml = simplexml_load_file("pomakVremena.xml");
$pomak=0;
if($xml){
    $pomak = $xml->pomakVremena[0];
    }
$vrijeme=new DateTime(date("Y-m-d H:i:s", strtotime(sprintf("+%d hours", $pomak))));
$novoVrijeme = $vrijeme->format('Y-m-d H:i:s');
return $novoVrijeme;

}        

?>

