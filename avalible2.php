<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
$i = 0;
$korinickoime = isset($_POST['korinickoime']) ? $_POST['korinickoime'] : false;
if(isset($korinickoime)){
    $upit = "SELECT ime, prezime,adresa,grad, korisnickoIme from korisnik where korisnickoIme = '$korinickoime'";
    if($test = $baza1->ostaliUpiti($upit)){
        $pod1 = $test->fetch_array();
        $json[$i] = $pod1[$i];
        $i += 1;
        $json[$i] = $pod1[$i];
        $i += 1;
        $json[$i] = $pod1[$i];
        $i += 1;
        $json[$i] = $pod1[$i];
        
        
    }
    echo json_encode($json);
}

?>