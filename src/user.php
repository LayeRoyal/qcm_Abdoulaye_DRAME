<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../asset/css/interface.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,100&display=swap">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Joueur</title>
</head>
<body>
<div class="corp">
  <form method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="header">
            <img src="../asset/Images/logo-QuizzSA.png" />
            <h1>Le plaisir de jouer</h1>
        </div>
        <div class="mid-u">
          <div class="backmid">
             <div class="left">
                 <div class="titre">
                    <h1>S'INSCRIRE</h1>
                    <p>Pour tester votre niveau de culture générale</p>
                 </div>
                 <hr>
                 <div class="data">
                    <h4> Prénom </h4>
                    <input name="prenom"  id="fname" type="text" value="<?php if(isset($_POST['prenom'])){echo $_POST['prenom'];} ?>" />
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
                    </div>
                </div>
             <div class="right">
                 <img class="img" id="img" src="../asset/Images/back.png"/>
                 <p>Avatar du joueur</p>
             </div>
            
            
          </div>
        </div>

   </div>
</form>
<script src="../asset/javascript/script.js"></script>
<script src="../asset/Json/admin.json"></script>

</div>



                        <!-- PHP backend -->

                        <?php
            include("fonction.php");
            inscription("../asset/Json/joueur.json");
            ?>


</body>
</html>