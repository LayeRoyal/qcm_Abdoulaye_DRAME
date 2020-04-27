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
                <textarea name="questions" ></textarea>
            </div>
            <div class="score">
                <h3>Nbre de points</h3>
                <input name="score" type="number" min="1" />
            </div>
            <div class="typ">
               <h3>Type de réponse</h3>
               <select id="choix" name="choix" onchange="emptyrep()">
                 <option value="">Donnez le type de réponse</option>
                 <option value="ChoixMultiple">Choix Multiple</option>
                 <option value="ChoixSimple">Choix Simple</option>
                 <option value="ChoixText">Choix Text</option>
               </select>
               <img id="plus" onclick="addinput()"  src="../asset/Images/Icônes/ic-ajout-réponse.png">
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

if(isset($_POST['valider']))
{       
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
        $json= json_decode(file_get_contents('../asset/Json/question.json'),true);
        $json[$_SESSION['login']][]=$tab;
        $json=json_encode($json);
        $json= file_put_contents('../asset/Json/question.json',$json);

        if($json)
        {
            echo "<p style='color:green;'>Question enregistrée avec succes</p>";   
             }
        else{
            echo '<p>L\'enregistrement a echoué Veuillez recommencer!</p>';
        }


    }

}

?>
</div>
</body>
</html>