<?php
session_start();

$json= json_decode(file_get_contents('../asset/Json/joueur.json'),true);

//Pour acceder au jeu il faut se connecter
if(!isset($_SESSION['loginPlayer']) )
{ header('location: ../index.php');}


// Affichage image et noms

 $firstName=$json[$_SESSION['loginPlayer']]["prenom"];
 $lastName=$json[$_SESSION['loginPlayer']]["nom"];
 $img= $json[$_SESSION['loginPlayer']]['image'];


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../asset/css/interface.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;1,100;1,300;1,400;1,700&display=swap">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>  
    <script src="../asset/javascript/script.js"></script>  

    <title>Joueur</title>
</head>
<body>
<div class="corp">
    <div class="container">
        <div class="header">
            <img src="../asset/Images/logo-QuizzSA.png" />
            <h1>Le plaisir de jouer</h1>
        </div>
        <div class="mid-listq">
            <div class="entete_logout entete_logout_player">
            
            <img src="<?php if(isset($img)){echo $img;} ?>"/>
          
            <p> <?php if(isset($firstName)){echo $firstName.'   ';} ?><?php if(isset($lastName)){echo $lastName;} ?></p>

            <h3 id="welcomePlayer">BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ <br>JOUER ET TESTER VOTRE NIVEAU DE CULTURE GÉNÉRALE</h3>
            <a id="address" href="deconnexionJoueur.php"><input type="submit" name="logout" value="Déconnexion" /></a>
            </div>
            <div class="backmidlist " id="playback">
                <div class="centerdiv">
                     <div id="leftq">
                    
                     </div>
                     <div class="tabs">
                             <ul>
                                <li class="Top activetab" id="topScore" onclick="bestscore()">Top Scores</li>
                                <li  id="bestScore" onclick="mybest()">Mon Meilleur Score</li>
                            </ul>
                            <div id="rightscore">
                                <div id="bestScores">
                                <?php
                                include('fonction.php');
                                topscore();
                                ?>

                                </div>
                                <div id="myScore" >
                                <?php
                                    $score= json_decode(file_get_contents("../asset/Json/score.json"),true);
                                    echo '<h1 id="mybest">'.$score[$_SESSION['loginPlayer']].' pts</h1>';
                                ?>
                            </div>
                        </div>

                    </div>
                  </div>
                 </div>
             </div>
        </div>

</body>
</html>