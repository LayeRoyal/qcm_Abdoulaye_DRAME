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

 // traitement
       
        if($_GET['question']<1 || !ctype_digit($_GET['question']))
        {
            $question=1;
        }
        elseif($_GET['question']>$_SESSION['nbrPage'])
        {
            $question=$_SESSION['nbrPage'];
        }
        else{
            $question=$_GET['question'];
        }
        $json= json_decode(file_get_contents('../asset/Json/question.json'),true);
        $quest=$json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]['questions'];
        $scores=$json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]['score'];
        

    


?>
<!DOCTYPE html>
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
            <img src="../asset/Images/logo-QuizzSA.png" alt="logo ODC" />
            <h1>Le plaisir de jouer</h1>
        </div>
        <div class="mid-listq">
            <div class="entete_logout entete_logout_player">
            
            <img src="<?php if(isset($img)){echo $img;} ?>"  alt="my face"/>
          
            <p> <?php if(isset($firstName)){echo $firstName.'   ';} ?><?php if(isset($lastName)){echo $lastName;} ?></p>

            <h3 id="welcomePlayer">BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ <br>JOUER ET TESTER VOTRE NIVEAU DE CULTURE GÉNÉRALE</h3>
            <a id="address" href="deconnexionJoueur.php"><input type="submit" name="logout" value="Déconnexion" /></a>
            </div>
            <div class="backmidlist " id="playback">
                <div class="centerdiv">
                     <div id="leftq">
                         <div class="questions">
                            <h3><u>Question <?php echo $question."/".$_SESSION['nbrPage'];?>:</u></h3>
                            <h4><?php if(isset($quest)){echo $quest;} ;?></h4>
                        </div>
                         <div class="scoreQ">
                            <h4> <?php if(isset($scores)){echo $scores;}?> pts</h4>
                         </div>
                         <div class="ShowQuestion">
                         <?php
                            //affichage choix multiple
                            if($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["choix"]=="ChoixMultiple")
                            {
                                                  
                                for($j=1;$j<=5;$j++)
                                {
                                    if(isset($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["ipt".$j]))
                                    {   
                                        if(isset($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["ckbox".$j]) && $json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["ckbox".$j]=="on")
                                        {
                                           $_SESSION['questions']['question'.$question]['ckbox'.$j]="bonne Réponse";
                                        }
                                        
                                        echo "<input type='checkbox' name='ckbox".$j."'/>";
                                        
                                        echo $json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["ipt".$j].'<br>';
                                    }
                                    else
                                    {
                                    break;
                                    }
                                }
                            
                            }

                            //affichage choix simple
                            if($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["choix"]=="ChoixSimple")
                            {
                                while(key($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]) != 'ckbox') {next($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]);}                    $prev_val = prev($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]);
                                // and to get the key
                                $prev_key = key($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]);
                                for($j=1;$j<=5;$j++)
                                {       
                                    if(isset($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["ipt".$j]))
                                    {   
                                        if($prev_key=="ipt".$j)
                                        {   
                                            $_SESSION['questions']['question'.$question]['ckbox'.$j]="bonne Réponse";
                                        }
                                        
                                            echo "<input type='radio' name='ckbox".$question."'/>";
                                        
                                        echo $json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["ipt".$j].'<br>';
                                    }
                                    else
                                    {
                                        break;
                                    }
                                }
                            
                            }
                    
                                //affichage choix texte
                                if($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["choix"]=="ChoixText")
                                {
                                    $_SESSION['questions']['question'.$question]['reponse']=$json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["ctext"];
                                        echo '<textarea name="repText"></textarea>';
                        
                                }
                        
                            
                        
                    
                        
        
                         ?>
                         </div>
                         <div class="Page">
                            <?php
                                if($_GET['question']>1){echo "<a href='play.php?question=".($question-1)."'><input id='pre' type='submit' value='Précédent'></a>";}

                                if($_GET['question']<$_SESSION['nbrPage']){echo "<a href='play.php?question=".($question+1)."'><input id='nxt' type='submit' value='Suivant'></a>";}
                                if($_GET['question']==$_SESSION['nbrPage']){echo "<a href='play.php?question=resultat'><input id='done' type='submit' value='Terminer'></a>";}
                            ?>
                         </div>
                        

                     </div>
                     <div class="tabs">
                             <ul>
                                <li class="activetab" id="topScore" onclick="tab1('topScore','bestScore','bestScores','mybest')">Top Scores</li>
                                <li  id="bestScore" onclick="tab1('topScore','bestScore','bestScores','mybest')">Mon Meilleur Score</li>
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