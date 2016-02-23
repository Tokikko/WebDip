<?php


$directory = "img/galerija/";
$json = array();
$handle = openDir($directory);
$i = 0;
while ($file = readDir($handle)) { 
 if ($file != "." && $file != ".." && !is_dir($file)){
  if (strstr($file, ".gif") || strstr($file, ".png") || strstr($file, ".jpg")){
   $directory_file = $directory . $file;
   
   $json[$i] = $directory . $file;
   $i += 1;
   $info = getImageSize($directory_file);
   
  }

  }
}
closeDir($handle); 
echo json_encode($json);
?>
