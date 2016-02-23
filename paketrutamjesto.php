<?php
include_once 'baza.class.php';
$baza1 = new baza();
$baza1->spojiBaza();
$json = array();

$ruta = isset($_POST['ruta']) ? $_POST['ruta'] : false;
$i = 0;
if(isset($ruta)){
    
$upit = "SELECT mhr.id_rutamjesto, m.naziv
        FROM paketPostar pp
        JOIN ruta r ON r.id_ruta = pp.ruta
        JOIN mjesto_has_ruta mhr ON mhr.ruta = r.id_ruta
        JOIN mjesto m ON m.id_mjesto = mhr.mjesto
        WHERE pp.ime =  '$ruta'";
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
