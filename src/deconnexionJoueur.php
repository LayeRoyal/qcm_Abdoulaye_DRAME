<?php
session_start();

unset($_SESSION['loginPlayer']);
unset($_SESSION['admin']);
unset($_SESSION['nbrPage']);
unset($_SESSION['randomNumber']);
header('location: ../index.php');
?>

