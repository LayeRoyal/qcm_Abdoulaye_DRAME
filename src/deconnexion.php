
<?php
  session_start();
  
    unset($_SESSION['loginAdmin']);
  header('location: ../index.php');
?>