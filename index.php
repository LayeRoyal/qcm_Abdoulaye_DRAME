<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="asset/css/interface.css">

    <title>Connexion</title>
</head>
<body>
    <form method="post">
<div class="corp">
    <div class="container">
        <div class="header">
            <img src="asset/Images/logo-QuizzSA.png" />
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
                <p><a href="user.php">S'inscrire pour jouer?</a></p>
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
         //valeur session login
         $_SESSION['login']=$login;

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
                       
                        header('location: src/play.php');
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