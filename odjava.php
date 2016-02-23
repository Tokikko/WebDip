<?php
ob_start();
include_once 'dnevnik.php';
session_start();
upisiLog("Uspjesna odjava", $_SESSION['korisnickoime']);
session_destroy();
header("Location: registracija.php");
?>