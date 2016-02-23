<?php
$vrijednost = $_GET['vrijednost'];
echo $vrijednost;

$fp = fopen('stranicenje.json', 'wb');
fwrite($fp, "{".'"stranica"'.":".$vrijednost."}");
fclose($fp);

?>

