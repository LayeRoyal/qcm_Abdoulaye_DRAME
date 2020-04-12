<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="interface.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Joueur</title>
</head>
<body>
<div class="corp">
  <form method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="header">
            <img src="Images/logo-QuizzSA.png" />
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
                    <input name="prenom" type="text" value="<?php if(isset($_POST['prenom'])){echo $_POST['prenom'];} ?>" />
                    <h4> Nom </h4>
                    <input name="nom" type="text" value="<?php if(isset($_POST['nom'])){echo $_POST['nom'];} ?>" />
                    <h4> Login </h4>
                    <input name="login" type="text" value="<?php if(isset($_POST['login'])){echo $_POST['login'];} ?>" />
                    <h4> Password </h4>
                    <input name="pass" type="password" value="<?php if(isset($_POST['pass'])){echo $_POST['pass'];} ?>"/>
                    <h4> Confirmer Password </h4>
                    <input name="confpass" type="password" value="<?php if(isset($_POST['confpass'])){echo $_POST['confpass'];} ?>"/>
                    <div class="avatar">
                    <p>Avatar</p>
                    <input type="file" name="file" id="file" accept="image/*" >
                    <label for="file">Choisir un fichier</label>
                    </div>
                    <button name="create" class="conex">Créer compte</button>
                    </div>
                </div>
             <div class="right">
                 <img class="img" id="img" src="Images/back.png"/>
                 <p>Avatar du joueur</p>
             </div>
             <script type="text/javascript" src="script.js"></script>
            
          </div>
        </div>

   </div>
</form>
</div>



                        <!-- PHP backend -->

                        <?php
            include("fonction.php");
            inscription("joueur.json");
            ?>


</body>
</html>