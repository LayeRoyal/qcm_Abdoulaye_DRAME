<?php

function inscription ($jsonfile){


                    
             // PHP inscription script
    
        echo '<div class="errorsignup">';
        if(isset($_POST['create']))
        {
        if(!empty($_POST['prenom']) && !empty($_POST['nom'])  && !empty($_POST['login'])  && !empty($_POST['pass']) && !empty($_POST['confpass']) )
        {   
            $prenom=$_POST['prenom'];
            $nom=$_POST['nom'];
            $login=$_POST['login'];
            $pass=$_POST['pass'];
            $confpass=$_POST['confpass'];

                // image not uploaded
            if(empty($_FILES['file']['name']))
            {
                echo 'Veuillez choisir une image</br>';
            }
            else   // image uploaded  but let's verify the extention
            {   $typeAccepted= array("jpg","jpeg","png");
               $imgtype= strtolower(pathinfo('../asset/uploads/'.basename($_FILES["file"]["name"]),PATHINFO_EXTENSION));
               if(!in_array($imgtype,$typeAccepted))
               {
                   echo 'Seuls les formats jpg, jpeg et png sont reconnus<br>';
               }

               else   // l'image a un bon format 
               {    
                   if($_FILES["file"]["size"]>2096000 || $_FILES["file"]["size"]==0)
                   {
                    echo 'Taille image trop grand 2MB maximum accepté<br>'; 
                   }
                   else{   //l'image est bon avec la bonne taille
                               //transferer l'image dans uploads
                                    $fileTmpName= $_FILES['file']['tmp_name'];
                                    
                                    $fileDestination= "../asset/uploads/".$login.".".$imgtype;
                                    move_uploaded_file($fileTmpName,$fileDestination);
                              //maintenant verifions si les mots de passe st identiques
                              
                                if($pass!= $confpass)
                                {
                                   echo 'Les mots de passe doivent etre identiques<br>'; 
                                }
                                //tout est bon
                              else
                                {
                                 $json= json_decode(file_get_contents($jsonfile),true);
                                 //eviter redondance de login qui est admin et joueur en meme temps
                                    if($jsonfile=="../asset/Json/joueur.json"){
                                    $json2= json_decode(file_get_contents('../asset/Json/admin.json'),true);}
                                    else{
                                    $json2= json_decode(file_get_contents('../asset/Json/joueur.json'),true);}

                                 //verifions si le login exist deja
                                 $checklogin=false;
                                 //Dans le json des joueur
                                 foreach($json as $key=> $value)
                                 {
                                     if($key==$login)
                                     {
                                         $checklogin=true;
                                        
                                     }
                                 }
                                 
                                 //Dans le json des admins
                                 foreach($json2 as $key=> $value)
                                 {
                                     if($key==$login)
                                     {
                                         $checklogin=true;
                                    
                                     }
                                 }
                                    //login already exist
                                 if($checklogin)
                                 {
                                     echo '<h3>Ce Login existe déjà</h3>';
                                 }
                                 else{
                                         //upload info for admin and user
                                        if($jsonfile=="../asset/Json/joueur.json")
                                        {
                                            $json[$login]= ["prenom"=>   $prenom,
                                                        "nom"   =>   $nom,
                                                        "login" =>   $login,
                                                        "mdp"  =>   $pass,
                                                        "image" =>   $fileDestination
                                                           ];  
                                        }
                                        if($jsonfile=="../asset/Json/admin.json")
                                        {
                                            $json[$login]= ["prenom"=>   $prenom,
                                                        "nom"   =>   $nom,
                                                        "login" =>   $login,
                                                        "mdp"  =>   $pass,
                                                        "image" =>   $fileDestination,
                                                        "QparJeu"=> "5"
                                                           ];  
                                        }

                                    $json=json_encode($json);
                                    $json= file_put_contents($jsonfile,$json);

                                   //upload score
                                   
                                            $score= json_decode(file_get_contents("../asset/Json/score.json"),true);   
                                            $score[$login]=  "0";
                                            $score=json_encode($score);   
                                            $score=file_put_contents("../asset/Json/score.json",$score);

                                    if($json && $score)
                                    {
                                        echo '<h3 style="color:green">Inscription réussie avec succes <a href="../index.php">clickez ici</a> pour se connecter</h3>';
                                                         
                                         }
                                    else{
                                        echo '<h3>L\'inscription a echoué Veuillez recommencer</h3>';
                                    }

                                 }
                                


                                }
                            }
                }
            }
        }
       
        //il y'a des champs non remplis
        else
        {
            echo 'Veuillez remplir tous les champs ';
        }
       
        }
        echo '</div>';
    }


    //foncion paginer

    function paginer()
    {
        
 $score= json_decode(file_get_contents("../asset/Json/score.json"),true);
 arsort($score);
 $scoreIndex=[];
 $scoreValue=[];
 foreach($score as $key=>$value)
 {
     $scoreIndex[]=$key;
     $scoreValue[]=$value;
 }
$json= json_decode(file_get_contents("../asset/Json/joueur.json"),true);

$nbrElementParPage=15;
$nbrpage=ceil(count($json)/$nbrElementParPage);

 if($_GET['list']<1 || !ctype_digit($_GET['list']))
 {
     $list=1;
 }
 elseif($_GET['list']>$nbrpage)
 {
    $list=$nbrpage;
 }
 else{
    
    $list=$_GET["list"];}
    echo ' <table id="tab" >
    <tr class="thh">
        <th>Nom</th>
        <th>Prenom</th>
        <th id="scor">Score</th>
    </tr>';

    if($list<=$nbrpage)
    {
        for($i=($list-1)*$nbrElementParPage,$j=($list-1)*$nbrElementParPage;$i<(($list-1)*$nbrElementParPage)+$nbrElementParPage,$j<(($list-1)*$nbrElementParPage)+$nbrElementParPage;$i++,$j++)
        {  
            if(isset($scoreIndex[$j]))
            {               
                 echo '<tr class="trr"><td>'.$json[$scoreIndex[$j]]["nom"].'</td><td>'. $json[$scoreIndex[$j]]["prenom"].'</td><td id="scor">'.$scoreValue[$i].' pts</td></tr>';
            }
            else{break;}
        }
    }  
 
   
   




echo '</table>
    </div>
    <div class="foot">';
     if($_GET['list']>1){echo "<a href='admin.php?page=listJoueur&list=".($list-1)."'><input id='prec' type='submit' value='Précédent'></a>";}

      if($_GET['list']<$nbrpage){echo "<a href='admin.php?page=listJoueur&list=".($list+1)."'><input id='suiv' type='submit' value='Suivant'></a>";}

   echo '</div>';
    }
        
    


    //meilleur scores

function topscore ()
{
    $score= json_decode(file_get_contents("../asset/Json/score.json"),true);
    arsort($score);
    $scoreIndex=[];
    $scoreValue=[];
    foreach($score as $key=>$value)
    {
        $scoreIndex[]=$key;
        $scoreValue[]=$value;
    }
   //  print_r($score);
   $json= json_decode(file_get_contents("../asset/Json/joueur.json"),true);
   for ($i=0; $i < 5; $i++) { 
       if(isset($json[$scoreIndex[$i]]))
       {
       echo "<div class='bestScorer' id='bestScorer'><h4>".$json[$scoreIndex[$i]]["prenom"]."  ".$json[$scoreIndex[$i]]["nom"]."</h4> <p id='para".($i+1)."'>".$scoreValue[$i]." pts</p></div>";
       }
    }

}   

function validQuestion($button,$case)
{
    
if(isset($_POST[$button]))
{      
    if($case=="modifiée")
    {
        unset($_POST['delQ']);
    } 
    array_pop($_POST);
    $tab=$_POST;
    $cpt=true;
    $check=false;
    if($tab["choix"]=="ChoixMultiple" || $tab["choix"]=="ChoixSimple")
    {
        foreach($tab as $key=>$value)
        {
            if(empty($value))
            {
            $cpt=false;  
            break;
            }
            if($value=="on")
            {
                $check=true;
            }
        }
    }
    else
    {
        foreach($tab as $key=>$value)
        {
            if(empty($value))
            {
               $cpt=false; 
               $check= false;
            break;
            }
            else
            {
                $check=true;
            }
        } 
    }

    if(!$cpt || !$check)
    {
        echo "<p style='color:red;'>Information incomplete</p>";
    }
    else
    {
        if($case=="enregistrée")
        {
                //ajouter
             $json= json_decode(file_get_contents('../asset/Json/question.json'),true);
                $json[$_SESSION['loginAdmin']][]=$tab;
                $json=json_encode($json);
                $json= file_put_contents('../asset/Json/question.json',$json);

                if($json)
                {
                    echo "<p style='color:green;'>Question $case avec succes</p>";   
                    }
                else{
                    echo '<p>L\'enregistrement a echoué Veuillez recommencer!</p>';
                }
        }
        
        if($case=="modifiée")
        {
            //modifier Question
            
            $json= json_decode(file_get_contents('../asset/Json/question.json'),true);
            $checking=false;
            for($i=0;$i<count($json[$_SESSION['loginAdmin']]);$i++)
                {
                    if($json[$_SESSION['loginAdmin']][$i]['questions']==$tab['questions'])
                    {
                    $json[$_SESSION['loginAdmin']][$i]=$tab;
                        $checking=true;
                        break;
                    }
                }
                if($checking)
                {
                    $json=json_encode($json);
                    $json= file_put_contents('../asset/Json/question.json',$json);
                    
                    if($json)
                    {
                        echo "<p style='color:green;'>Question modifiée avec succes</p>";   
                        }
                    else{
                        echo "<p style='color:red;'>La modification a echoué Veuillez recommencer!</p>";
                    }
                }
                else
                {
                    echo "<p style='color:red;'>Cette question n'existe pas encore</p>";
                }
            
            
        }
    }
     
      
    }
}



//supprimer question

function supprimer()
{
    if(isset($_POST['delete']))
    {     
        $delQuestion=$_POST['delQ'];
        $json= json_decode(file_get_contents('../asset/Json/question.json'),true);
        $check=false;
        for($i=0;$i<count($json[$_SESSION['loginAdmin']]);$i++)
        {
            if($json[$_SESSION['loginAdmin']][$i]['questions']==$delQuestion)
            {
                unset($json[$_SESSION['loginAdmin']][$i]);
                $check=true;
                break;
            }
        }
      $json[$_SESSION['loginAdmin']]=array_values($json[$_SESSION['loginAdmin']]);
        
        if($check)
        {
            $json=json_encode($json);
            $json= file_put_contents('../asset/Json/question.json',$json);
            
            if($json)
            {
                echo "<p style='color:green;'>Question supprimée avec succes</p>";   
                 }
            else{
                echo "<p style='color:red;'>La suppression a echoué Veuillez recommencer!</p>";
            }
        }
        else
        {
            echo "<p style='color:red;'>Cette question n'existe pas encore</p>";
        }

        

    }
  
}




?>