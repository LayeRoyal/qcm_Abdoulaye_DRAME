<?php

session_start();
       

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="asset/css/interface.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,100&display=swap">

    <title>Connexion</title>
</head>
<body>
    <form method="post">
<div class="corp">
    <div class="container">
        <div class="header">
            <img src="asset/Images/logo-QuizzSA.png" alt="logo SA" />
            <h1>Le plaisir de jouer</h1>
        </div>
        <div class="mid">
          <div class="midform">
            <div class="login_form">
                <h2>Login Form</h2>
                <h1>&times;</h1>
            
            </div>
            <div class="login">
                <div class="log">
                    <input type="text" name="login" placeholder="Login" value="<?php if(isset($_POST['login'])){echo $_POST['login'];} ?>"/>
                    <img src="asset/Images/Icônes/ic-login.PNG" alt="login"/>            
                </div>
                <div class="log">
                    <input type="password"  name="pass" placeholder="Password"/>
                    <img src="asset/Images/Icônes/ic-password.PNG" alt="mdp"/>  
                </div>
                <div class="loggedin">
                <input name="connexion" type="submit" value="Connexion"/>
                <p><a href="src/user.php">S'inscrire pour jouer?</a></p>
                </div>
            </div>
          </div>
        </div>
    
    </div>
</div>
</form>

                        <!-- PHP TREATMENT -->
<div id="errorsignin">
 <?php

 if( isset($_POST['connexion']))
 {
     if(empty($_POST['login']) || empty($_POST['pass']))
     {
         echo 'Veuillez remplir tous les champs SVP';
     }
     else
     {  
         $login=$_POST['login'];
         $mdp=$_POST['pass'];
        
        $json= json_decode(file_get_contents('asset/Json/admin.json'),true);
        //verifions s'il est deja inscrit
        $checklogin=false;
        foreach($json as $key=> $value)
        {
            if($key==$login)
            {
                $checklogin=true;
            }
        }

        if($checklogin)
        {   
            //verifions le mot de pass admin
            if(($json[$login]["mdp"])==$mdp)
            {
                 //valeur session login
                     $_SESSION['loginAdmin']=$login;

              header('location: src/admin.php');
            }
            else{
                echo 'Mot de pass admin incorrect';
            }
           
         
        }
        // SI C'EST PAS UN ADMIN ON VERIFIE S'IL EST JOUEUR
        else
        {   
                    $login=$_POST['login'];
                $mdp=$_POST['pass'];
                $json= json_decode(file_get_contents('asset/Json/joueur.json'),true);
                //verifions s'il est deja inscrit
                $checklogin=false;
                if( !empty($json))
                {
                    foreach($json as $key=> $value)
                    {
                        if($key==$login)
                        {
                            $checklogin=true;
                        }
                    }
                }
                if($checklogin)
                {   
                    //verifions le mot de pass
                    if(($json[$login]["mdp"])==$mdp)
                    {
                        //valeur session login
                          $_SESSION['loginPlayer']=$login;
                            //traitement pour jouer
                            if(isset($_SESSION['loginPlayer']))
                            {    
                                $json= json_decode(file_get_contents('asset/Json/question.json'),true);
                                $_SESSION['admin']=array_rand($json);
                                while(count($json[$_SESSION['admin']])<5)
                                {
                                    $_SESSION['admin']=array_rand($json);
                                }
                                $json= json_decode(file_get_contents('asset/Json/question.json'),true);
                                $json2= json_decode(file_get_contents('asset/Json/admin.json'),true); 
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
                                unset($_SESSION['done']);
                            }
                        header('location: src/play.php?question=1');
                    }
                    else{
                        echo 'Mot de pass joueur incorrect';
                    }
                
                
                }
                else
                {
                    echo 'Login inexistant';
                }
            }
     }
 }



 
?>

</div>
</body>
</html>