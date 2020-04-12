<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="interface.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>Admin</title>
</head>
<body>
<div class="corp">
    <div class="container">
        <div class="header">
            <img src="Images/logo-QuizzSA.png" />
            <h1>Le plaisir de jouer</h1>
        </div>
        <div class="mid-listq">
            <div class="entete_logout">
            <h2>CRÉER ET PARAMÉRTER VOS QUIZZ</h2>
            <input type="submit" name="logout" value="Déconnexion" />
            </div>
          <div class="backmidlist">
           <div class="onglet">
                <div class="info">
                    <div class="avatar">
                    <img src="Images/backg.PNG"/>
                    </div>
                    <div class="name">
                    <h3>Laye</h3>
                    <h3>DRAME</h3> 
                    </div>
                </div>
                <div class="lien">
                  <a href="admin.php">
                    <div class="list " id="<?php if (!isset($_GET['page'])){echo  'activeborder';}  ?>">
                          <h3>Créer Questions</h3>
                          <img src="<?php if (!isset($_GET['page'])) 
                                          {echo  'Images\Icônes\ic-ajout-active.PNG';}
                                          else {echo 'Images\Icônes\ic-ajout.PNG';}     
                                      ?>"/>
                    </div>
                  </a>
                  <a href= "admin.php?page=listQuestion">    
                    <div class="list" id="<?php if (isset($_GET['page']) && $_GET['page']=='listQuestion'){echo  'activeborder';}  ?>">
                        
                        <h3>Liste Questions</h3>
                          <img src="<?php if (isset($_GET['page']) && $_GET['page']=='listQuestion') 
                                          {echo  'Images\Icônes\ic-ajout-active.PNG';}
                                          else {echo 'Images\Icônes\ic-ajout.PNG';}     
                                      ?>
                                  "/>
                       
                   
                    </div>
                  </a>
                  <a href="admin.php?page=creerAdmin">
                    <div class="list" id="<?php if (isset($_GET['page']) && $_GET['page']=='creerAdmin'){echo  'activeborder';}  ?>">
                     
                        <h3>Créer admin</h3>
                          <img src=" <?php if (isset($_GET['page']) && $_GET['page']=='creerAdmin') 
                                          {echo  'Images\Icônes\ic-ajout-active.PNG';}
                                          else {echo 'Images\Icônes\ic-ajout.PNG';}     
                                      ?>
                                   "/>
                    </div>
                  </a>
                  <a href="admin.php?page=listJoueur">
                    <div class="list" id="<?php if (isset($_GET['page']) && $_GET['page']=='listJoueur'){echo  'activeborder';} ?>">
                        
                        <h3>Liste Joueurs</h3>
                          <img src=" <?php if (isset($_GET['page']) && $_GET['page']=='listJoueur') 
                                           {echo  'Images\Icônes\ic-ajout-active.PNG';}
                                           else {echo 'Images\Icônes\ic-ajout.PNG';}
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
                  default:   include('CreerQuestion.php');break;
              }
         ?>
           </div>
          </div>

   </div>
</div>


