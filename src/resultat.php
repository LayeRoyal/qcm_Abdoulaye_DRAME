<?php
session_start();
if (isset($_SESSION['rejouer']))
{
    header("location: play.php?question=1");
}

$json= json_decode(file_get_contents('../asset/Json/question.json'),true);
$jsonJ= json_decode(file_get_contents('../asset/Json/joueur.json'),true);
$jsonScore= json_decode(file_get_contents('../asset/Json/score.json'),true);

//traitement rejouer


if(isset($_POST['replay']))
{
    unset($_SESSION['done']);
    unset($_SESSION['questions']);
    unset($_SESSION['reponse']);
    

                 //traitement pour jouer
                            if(isset($_SESSION['loginPlayer']))
                            {    
                              $_SESSION['admin']="";
                              $_SESSION['nbrPage']="";
                                $_SESSION['admin']=array_rand($json);
                                while(count($json[$_SESSION['admin']])<5)
                                {
                                    $_SESSION['admin']=array_rand($json);
                                }
                               
                                $json2= json_decode(file_get_contents('../asset/Json/admin.json'),true); 
                                $_SESSION['nbrPage']=$json2[$_SESSION['admin']]["QparJeu"];
                                $_SESSION['randomNumber'] =[];
                                for ($i=0; $i < $_SESSION['nbrPage']; $i++) { 
                                    $num=rand(0,$_SESSION['nbrPage']);
                                        while(in_array($num,$_SESSION['randomNumber']))
                                        {
                                            $num=rand(0,$_SESSION['nbrPage']-1);
                                        }
                                        $_SESSION['randomNumber'][]=$num;
                                    
                                }                               
                            }
                            header('location: play.php?question=1');
                       
}


// Affichage image et noms

 $firstName=$jsonJ[$_SESSION['loginPlayer']]["prenom"];
 $lastName=$jsonJ[$_SESSION['loginPlayer']]["nom"];
 $img= $jsonJ[$_SESSION['loginPlayer']]['image'];
// echo'<pre>';
//         var_dump( $_SESSION);
//         var_dump( $_SESSION["questions"]);
//         echo'</pre>';
        $myscore=0;
        for ($i=1; $i <=$_SESSION['nbrPage'] ; $i++) { 
            if( $_SESSION["reponse"]["reponse$i"]== $_SESSION["questions"]["question$i"])
            {
                $myscore+=$json[$_SESSION['admin']][ $_SESSION['randomNumber'][$i-1]]['score'];
            }
        }
$oldscore=$jsonScore[$_SESSION['loginPlayer']];
if($myscore>$oldscore)
{
    $jsonScore[$_SESSION['loginPlayer']]="$myscore";
    $jsonScore=json_encode($jsonScore);   
    $jsonScore=file_put_contents("../asset/Json/score.json",$jsonScore);
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../asset/css/interface.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
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

            <h3 id="welcomePlayer">MERCI D'AVOIR FAIT UN TOUR SUR LA PLATEFORME DE JEU DE QUIZZ POUR JOUER ET TESTER VOTRE NIVEAU DE CULTURE GÉNÉRALE</h3>
            <a id="address" href="deconnexionJoueur.php"><input type="submit" name="logout" value="Déconnexion" /></a>
            </div>
            <div class="backmidlist " id="playback">
                <div class="centerdiv">
                     <div id="leftq" class="done">
                        <div class="score">
                            <h2>SCORE FINALE </h2>
                            <h2><?php if(isset($myscore)){echo $myscore;}?>pts</h2>
                        </div>
                        <div class="recap">
                        <?php
                           for($question=1;$question<=$_SESSION['nbrPage'];$question++)
                           {
                               echo "<div id=div$question>";
                            $quest=$json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]['questions'];
                                     //affichage choix multiple
                                                    if($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["choix"]=="ChoixMultiple")
                                                    {
                                                        if(isset($quest)){echo "<h4>$question. ".$quest."</h4>";}                    
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
                                                                  //veirifions la reponse
                                                                  if(in_array( $rep,$_SESSION["questions"]["question$question"]))
                                                                {
                                                                        if($check=="checked"){                                                                   
                                                                            echo "<div><input type='checkbox' name='ckbox".$j."' value='$rep' $check/>";
                                                                            echo '<p id="good">'.$rep.'</p>';
                                                                            echo "<img src='../asset/Images/Icones/valid.png' alt='bon' /></div>";
                                                                         }
                                                                        elseif( count($_SESSION["questions"]["question$question"])>1){
                                                                            echo "<div><input type='checkbox' name='ckbox".$question."' value='$rep' $check/>";
                                                                            echo '<p id="missing">'.$rep.'</p>';
                                                                            echo "<img src='../asset/Images/Icones/missing.png' alt='missing' /></div>";
                                                                        }
                                                                         else{                                                                   
                                                                            echo "<div><input type='checkbox' name='ckbox".$j."' value='$rep' $check/>";
                                                                            echo '<p id="good">'.$rep.'</p>';
                                                                            echo "<img src='../asset/Images/Icones/valid.png' alt='bon' /></div>";
                                                                         }
}
                                                                  
                                                                elseif($check=="checked" )
                                                                {
                                                                    echo "<div><input type='checkbox' name='ckbox".$j."' value='$rep' $check/>";                                                                   
                                                                    echo '<p id="bad">'.$rep.'</p>';
                                                                    echo "<img src='../asset/Images/Icones/bad.jpg' alt='mauvaise' /></div>";
                                                                }
                                                                else
                                                                {
                                                                    echo "<div><input type='checkbox' name='ckbox".$j."' value='$rep' $check/>";                                                                   
                                                                    echo '<p >'.$rep.'</p></div>';
                                                                }
                                                            }
                                                            else
                                                            {
                                                            break;
                                                            }
                                                        }
                                                    
                                                    }
                        
                                                    //affichage choix simple
                                                    if($json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["choix"]=="ChoixSimple")
                                                    {   if(isset($quest)){echo "<h4>$question. ".$quest."</h4>";}
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
                                                                if( $rep== $_SESSION["questions"]["question$question"])
                                                                {                                                                   
                                                                    echo "<div><input type='radio' name='ckbox".$question."' value='$rep' $check/>";
                                                                    echo '<p id="good">'.$rep.'</p>';
                                                                    echo "<img src='../asset/Images/Icones/valid.png' alt='bon' /></div>";
                                                                    
                                                                }
                                                                  
                                                                elseif($check=="checked" )
                                                                {
                                                                    echo "<div><input type='radio' name='ckbox".$question."' value='$rep' $check/>";                                                                   
                                                                    echo '<p id="bad">'.$rep.'</p>';
                                                                    echo "<img src='../asset/Images/Icones/bad.jpg' alt='mauvaise' /></div>";
                                                                }
                                                                else
                                                                {
                                                                    echo "<div><input type='radio' name='ckbox".$question."' value='$rep' $check/>";                                                                   
                                                                    echo '<p >'.$rep.'</p></div>';
                                                                }
                                                                
                                                               
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
                                                            if(isset($quest)){echo "<h4>$question. ".$quest."</h4>";}
                                                            $_SESSION['questions']['question'.$question]=$json[$_SESSION['admin']][ $_SESSION['randomNumber'][$question-1]]["ctext"];
                                                            if( $_SESSION['questions']['question'.$question]== $_SESSION['reponse']['reponse'.$question]) 
                                                            {  
                                                                echo '<div><textarea readonly id="good" >';                                                                
                                                                echo  $_SESSION["reponse"]["reponse$question"];                                                                
                                                                echo '</textarea>';
                                                                echo "<img src='../asset/Images/Icones/valid.png' alt='bon' /></div>";
                                                            }                                                            
                                                            else
                                                            {
                                                                echo '<div><textarea readonly id="bad" >';
                                                                echo  $_SESSION["reponse"]["reponse$question"];
                                                                echo '</textarea>';
                                                                echo "<img id='badimg' src='../asset/Images/Icones/bad.jpg' alt='mauvaise' /></div>
                                                                <span>La bonne reponse est: <u>".$_SESSION['questions']['question'.$question]."</u></span>";
                                                            }
                                                
                                                        }
                                   echo "</div>";            
                                }       
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
                        <form method="post"><div><input id="replay" name="replay" type="submit" value="Rejouer" /></div></form>
                    </div>
                  </div>
                 </div>
             </div>
        </div>
        
</body>
</html>


