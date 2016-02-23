<?php
$vrijednost = $_GET['vrijednost'];
echo $vrijednost;

$fp = fopen('brojprijava.json', 'wb');
fwrite($fp, "{".'"prijava"'.":".$vrijednost."}");
fclose($fp);

?>
