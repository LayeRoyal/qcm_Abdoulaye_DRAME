<?php
session_start();
if (isset($_SESSION['done']))
{
    header("location: resultat.php");
}
$json= json_decode(file_get_contents('../asset/Json/joueur.json'),true);
$_SESSION['rejouer']="rejouer";
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
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
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
                            <h4><?php if(isset($quest)){echo $quest;} ?></h4>
                        </div>
                         <div class="scoreQ">
                            <h4> <?php if(isset($scores)){echo $scores;}?> pts</h4>
                         </div>
                         <div class="ShowQuestion">
                         <form method="post">
                         <?php
                            //affichage choix multiple
                            if($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["choix"]=="ChoixMultiple")
                            {
                                                  
                                for($j=1;$j<=5;$j++)
                                {
                                    if(isset($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["ipt".$j]))
                                    {   
                                        // bonne reponse
                                        $rep=$json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["ipt".$j];
                                        if(isset($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["ckbox".$j]) && $json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["ckbox".$j]=="on")
                                        {
                                           $_SESSION['questions']['question'.$question]['ckbox'.$j]=$rep;
                                        }
                                         //verifions si c'etait coché ou pas
                                         if(isset( $_SESSION["reponse"]["reponse$question"]['ckbox'.$j]) && $_SESSION["reponse"]["reponse$question"]['ckbox'.$j]==$rep)
                                         {
                                             $check="checked";
                                         }
                                         else{
                                             $check="";
                                         }
                                        echo "<input type='checkbox' name='ckbox".$j."' value='$rep' $check/>";
                                        
                                        echo $rep.'<br>';
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
                                    {   $rep=$json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["ipt".$j];
                                        //valeur du input
                                        if($prev_key=="ipt".$j)
                                        {   
                                            $_SESSION['questions']['question'.$question]=$rep;
                                        }
                                        //verifions si c'etait coché ou pas
                                        if(isset( $_SESSION["reponse"]["reponse$question"]) && $_SESSION["reponse"]["reponse$question"]==$rep)
                                        {
                                            $check="checked";
                                        }
                                        else{
                                            $check="";
                                        }
                                        //affichage input
                                            echo "<input type='radio' name='ckbox".$question."' value='$rep' $check/>";
                                        
                                        echo $rep.'<br>';
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
                                    $_SESSION['questions']['question'.$question]=$json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["ctext"];
                                        echo '<textarea name="repText'.$question.'">';
                                        if(isset( $_SESSION["reponse"]["reponse$question"]))
                                        {
                                            echo  $_SESSION["reponse"]["reponse$question"];
                                        }
                                        echo '</textarea>';
                        
                                }
                     
        
                         ?>
                      
                         </div>
                         <div class="Page">
                            <?php
                                if($_GET['question']>1){echo "<input id='pre' name='pre' type='submit' value='Précédent'>";}

                                if($_GET['question']<$_SESSION['nbrPage']){echo "<input  name='nxt' id='nxt' type='submit' value='Suivant'>";}
                                if($_GET['question']==$_SESSION['nbrPage']){echo "<input id='done' name='done' type='submit' value='Terminer'>"; }
                            ?>
                         </div>
                        
                         </form>
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


<?php

    // Traitement php
    
    if(isset($_POST["nxt"]))
    {
        //choix texte
        if($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]['choix']=="ChoixText")
        {
            if(empty($_POST["repText$question"]))
            {
                header("location: play.php?question=$question");
            }
            else
            {
               $_SESSION["reponse"]["reponse$question"]=$_POST["repText$question"];
               $numb=$question+1;
               $nextAddress="location: play.php?question=$numb";
               header($nextAddress);
            }
           
        }

        //choix simple
        if($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]['choix']=="ChoixSimple")
        {
            if(isset($_POST["ckbox$question"]))
            {
                $_SESSION["reponse"]["reponse$question"]=$_POST["ckbox$question"];
                $numb=$question+1;
                $nextAddress="location: play.php?question=$numb";
                header($nextAddress);
            }
            else
            {
                header("location: play.php?question=$question");
            }
                  
        }

        //choix multiple
        if($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]['choix']=="ChoixMultiple")
        {
            $_SESSION["reponse"]["reponse$question"]=[];
            for($i=1;$i<=5;$i++)
            {
                if(isset($_POST["ckbox$i"]))
                {
                    $_SESSION["reponse"]["reponse$question"]["ckbox$i"]=$_POST["ckbox$i"];
                }
            }
            if(empty( $_SESSION["reponse"]["reponse$question"]))
            {
                header("location: play.php?question=$question"); 
            }
            else
            {
            $numb=$question+1;
            $nextAddress="location: play.php?question=$numb";
            header($nextAddress);
            }
        }
        
       
    }

    if(isset($_POST["pre"]))
    {
        $numb=$question-1;
        $prevAddress="location: play.php?question=$numb";
        header($prevAddress);
    }

    if(isset($_POST['done']))
    {
        $_SESSION['done']="terminée";
        unset($_SESSION['rejouer']);
        if($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]['choix']=="ChoixText")
        {
            if(empty($_POST["repText$question"]))
            {
                header("location: play.php?question=$question");
            }
            else
            {
               $_SESSION["reponse"]["reponse$question"]=$_POST["repText$question"];
              
               header("location: resultat.php");
            }
           
        }

        //choix simple
        if($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]['choix']=="ChoixSimple")
        {
            if(isset($_POST["ckbox$question"]))
            {
                $_SESSION["reponse"]["reponse$question"]=$_POST["ckbox$question"];
                header("location: resultat.php");   
            }
            else
            {
                header("location: play.php?question=$question");
            }
                  
        }

        //choix multiple
        if($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]['choix']=="ChoixMultiple")
        {
            $_SESSION["reponse"]["reponse$question"]=[];
            for($i=0;$i<5;$i++)
            {
                if(isset($_POST["ckbox$i"]))
                {
                    $_SESSION["reponse"]["reponse$question"]["ckbox$i"]=$_POST["ckbox$i"];
                }
            }
            if(empty( $_SESSION["reponse"]["reponse$question"]))
            {
                header("location: play.php?question=$question"); 
            }
            else
            {
                header("location: resultat.php");
            }
        }
    }
    

?>

</body>
</html>