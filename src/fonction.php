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
                                         //upload info for admin
                                 if($jsonfile=="../asset/Json/joueur.json"){ 
                                    $json[$login]= ["prenom"=>   $prenom,
                                                    "nom"   =>   $nom,
                                                    "login" =>   $login,
                                                    "mdp"  =>   $pass,
                                                    "image" =>   $fileDestination,
                                                    "score"=>   "0"
                                                    ];
                                    }
                                    else            //upload info for admin
                                    {
                                        $json[$login]= ["prenom"=>   $prenom,
                                                        "nom"   =>   $nom,
                                                        "login" =>   $login,
                                                        "mdp"  =>   $pass,
                                                        "image" =>   $fileDestination
                                                       ]; 
                                    }

                                    $json=json_encode($json);
                                    $json= file_put_contents($jsonfile,$json);
                                    if($json)
                                    {
                                        echo '<h3 style="color:green">Inscription réussie avec succes <a href="../index.php">clickez ici</a> pour se connecter</h3>';
                                    
                                            print_r($_FILES);                      
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
            
?>