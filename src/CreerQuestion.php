<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/interface.css">
    <title>Document</title>
</head>
<body>
   
<form class="formq" method="post">
<div class="containerquestion">
    <div class="headquizz">
        <h3>PARAMETRER VOTRE QUIZZ</h3>
    </div>
    <div class="creerQuestion">
            <div class="question">
                <h3>Questions</h3>
                <textarea name="questions" id="quest" ></textarea>
            </div>
            <div class="score">
                <h3>Nbre de points</h3>
                <input name="score" id="point" type="number" min="1" />
            </div>
            <div class="typ">
               <h3>Type de réponse</h3>
               <select id="choix" name="choix" >
                 <option value="">Donnez le type de réponse</option>
                 <option value="ChoixMultiple">Choix Multiple</option>
                 <option value="ChoixSimple">Choix Simple</option>
                 <option value="ChoixText">Choix Text</option>
               </select>
               <img id="plus"   src="../asset/Images/Icones/icajoutreponse.png">
            </div>
            <div class="rep" id="rep">
              
            </div>
            <div class="but">
               <button name="valider">Enregistrer</button>
            </div>
    </div> 

</div>

</form>
<script src="../asset/javascript/script.js"></script> 
<div class="messageq">
<?php
include("fonction.php");
validQuestion('valider','enregistrée')

?>
</div>
</body>
</html>