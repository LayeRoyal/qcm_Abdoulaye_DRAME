<?php
            include("fonction.php");
         
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../asset/css/interface.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Admin</title>
</head>
<body>

  <form method="post" enctype="multipart/form-data">
  
          <div class="backmid-admin">
             <div class="left">
                 <div class="titre">
                    <h1>S'INSCRIRE</h1>
                    <p>Pour proposer des quizz</p>
                 </div>
                 <hr>
                 <div class="data  admindata">
                    <h4> Prénom </h4>
                    <input name="prenom" id="fname" type="text" value="<?php if(isset($_POST['prenom'])){echo $_POST['prenom'];} ?>" />
                    <h4> Nom </h4>
                    <input name="nom" id="lname" type="text" value="<?php if(isset($_POST['nom'])){echo $_POST['nom'];} ?>" />
                    <h4> Login </h4>
                    <input name="login" id="login" type="text" value="<?php if(isset($_POST['login'])){echo $_POST['login'];} ?>" />
                    <h4> Password </h4>
                    <input name="pass" id="pass" type="password" value="<?php if(isset($_POST['pass'])){echo $_POST['pass'];} ?>"/>
                    <h4> Confirmer Password </h4>
                    <input name="confpass" id="confpass" type="password" value="<?php if(isset($_POST['confpass'])){echo $_POST['confpass'];} ?>"/>
                    <div class="avatar">
                    <p>Avatar</p>
                    <input type="file" name="file" id="file" accept="image/*" >
                    <label for="file">Choisir un fichier</label>
                    </div>
                    <button name="create" class="conex">Créer compte</button>
                    <br>
                    </div>
                  
                </div>
             <div class="right">
                 <img class="imgA" id="img" src="../asset/Images/back.png"/>
                 <p>Avatar Admin</p>
                   <?php if(isset($msg)) 
                   
                    $msg;?>
             </div>
             <script type="text/javascript" src="../asset/javascript/script.js"></script>
            
          </div>

</form>




                        <!-- PHP backend -->

            <?php
            inscription("../asset/Json/admin.json");
            ?>

</div>
</body>
</html>