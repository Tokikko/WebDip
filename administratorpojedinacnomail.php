<?php


include_once 'baza.class.php';
$baza = new baza();
$baza->spojiBaza();
$json = array();
$korIme = $_POST['korIme'];
$upit = "SELECT email from korisnik where korisnickoIme = '$korIme'";
if ($mjesto = $baza->selectUpit($upit)){

    $red = $mjesto->fetch_array();
    $email = $red['email'];
    
    $poruka = "Molimo da se obratiti našoj službi jer nismo uspjeli isporučiti vaš paket.";
    mail($email,"Neisporučen paket", $poruka);
    
}

?>

