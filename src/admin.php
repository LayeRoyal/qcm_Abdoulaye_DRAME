<?php
session_start();

$json= json_decode(file_get_contents('../asset/Json/admin.json'),true);

//Pour acceder admin il faut se connecter
if(!isset($_SESSION['loginAdmin']) )
{ header('location: ../index.php');}

// Affichage image et noms


 $firstName=$json[$_SESSION['loginAdmin']]["prenom"];
 $lastName=$json[$_SESSION['loginAdmin']]["nom"];
 $img= $json[$_SESSION['loginAdmin']]['image'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../asset/css/interface.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;1,100;1,300;1,400;1,700&display=swap">
    <title>Admin</title>
</head>
<body>
<div class="corp">
    <div class="container">
        <div class="header">
            <img src="../asset/Images/logo-QuizzSA.png" />
            <h1>Le plaisir de jouer</h1>
        </div>
        <div class="mid-listq">
            <div class="entete_logout">
            <h2>CRÉER ET PARAMÉRTER VOS QUIZZ</h2>
            <a href="deconnexion.php"><input type="submit" name="logout" value="Déconnexion" /></a>
            </div>
          <div class="backmidlist">
           <div class="onglet">
                <div class="info">
                    <div class="avatar">
                    <img src="<?php if(isset($img)){echo $img;} ?>"/>
                    </div>
                    <div class="name">
                    <h3><?php if(isset($firstName)){echo $firstName;} ?></h3>
                    <h3><?php if(isset($lastName)){echo $lastName;} ?></h3> 
                    </div>
                </div>
                <div class="lien">
                <a href= "admin.php?page=listQuestion&list=1">    
                    <div class="list" id="<?php if (isset($_GET['page']) && $_GET['page']=='listQuestion'){echo  'activeborder';}  ?>">
                        
                        <p>Liste Questions</p>
                          <img src="<?php if (isset($_GET['page']) && $_GET['page']=='listQuestion') 
                                          {echo  '..\asset\Images\Icônes\ic-liste-active.PNG';}
                                          else {echo '..\asset\Images\Icônes\ic-liste.PNG';}     
                                      ?>
                                  "/>
                       
                   
                    </div>
                  </a>
                  <a href="admin.php">
                    <div class="list " id="<?php if (!isset($_GET['page'])){echo  'activeborder';}  ?>">
                          <p>Créer Questions</p>
                          <img src="<?php if (!isset($_GET['page'])) 
                                          {echo  '..\asset\Images\Icônes\ic-ajout-active.PNG';}
                                          else {echo '..\asset\Images\Icônes\ic-ajout.PNG';}     
                                      ?>"/>
                    </div>
                  </a>
                 
                  <a href="admin.php?page=modifSup">
                    <div class="list" id="<?php if (isset($_GET['page']) && $_GET['page']=='modifSup'){echo  'activeborder';} ?>">
                        
                        <p>Modifier/Supprimer Question</p>
                          <img src=" <?php if (isset($_GET['page']) && $_GET['page']=='modifSup') 
                                           {echo  '..\asset\Images\Icônes\ic-liste-active.PNG';}
                                           else {echo '..\asset\Images\Icônes\ic-liste.PNG';}
                                     ?>
                                   "/>
                    </div>
                   </a>

                   <a href="admin.php?page=creerAdmin">
                    <div class="list" id="<?php if (isset($_GET['page']) && $_GET['page']=='creerAdmin'){echo  'activeborder';}  ?>">
                     
                        <p>Créer admin</p>
                          <img src=" <?php if (isset($_GET['page']) && $_GET['page']=='creerAdmin') 
                                          {echo  '..\asset\Images\Icônes\ic-ajout-active.PNG';}
                                          else {echo '..\asset\Images\Icônes\ic-ajout.PNG';}     
                                      ?>
                                   "/>
                    </div>
                  </a>

                  <a href="admin.php?page=listJoueur&list=1">
                    <div class="list" id="<?php if (isset($_GET['page']) && $_GET['page']=='listJoueur'){echo  'activeborder';} ?>">
                        
                        <p>Liste Joueurs</p>
                          <img src=" <?php if (isset($_GET['page']) && $_GET['page']=='listJoueur') 
                                           {echo  '..\asset\Images\Icônes\ic-liste-active.PNG';}
                                           else {echo '..\asset\Images\Icônes\ic-liste.PNG';}
                                     ?>
                                   "/>
                    </div>
                   </a>
              </div>
            <h2>
           </div>
           <div class="includeside">
           <?php
           $pg = isset($_GET['page']) ? $_GET['page'] : '';
              switch($pg) { 
                  case 'listQuestion': include('listQuestion.php'); break; 
                  case 'creerAdmin': include('CreerAdmin.php'); break;  
                  case 'listJoueur': include('listJoueur.php'); break; 
                  case'modifSup': include('modifSup.php'); break; 
                  default:   include('CreerQuestion.php');break;
              }
         ?>
           </div>
          </div>

   </div>
</div>
