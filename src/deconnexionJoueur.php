<?php
session_start();

unset($_SESSION['loginPlayer']);
header('location: ../index.php');
?>