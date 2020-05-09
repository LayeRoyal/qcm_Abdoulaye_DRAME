<?php
session_start();

unset($_SESSION['loginPlayer']);
unset($_SESSION['admin']);
unset($_SESSION['nbrPage']);
unset($_SESSION['randomNumber']);
unset($_SESSION['questions']);
unset($_SESSION["reponse"]);
header('location: ../index.php');
?>

