<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="containerlistj">
    <div class="tete">
    <h3>LISTE DES JOUEURS PAR SCORE</h3>
    </div>
    <div class="listplayer">
    <table id="tab" >
    <tr class="thh">
        <th>Nom</th>
        <th>Prenom</th>
        <th id="scor">Score</th>
</tr>

<?php
 $score= json_decode(file_get_contents("../asset/Json/score.json"),true);
 krsort($score);
//  print_r($score);
$json= json_decode(file_get_contents("../asset/Json/joueur.json"),true);

foreach($score as $key=>$value)
{
    echo '<tr class="trr"><td>'.$json[$value]["nom"].'</td><td>'. $json[$value]["prenom"].'</td><td id="scor">'.$key.' pts</td></tr>';
}

?>
</table>
    </div>
    <div class="foot">
    <input type="submit" value="Suivant">

    </div>
    </div>
   
</body>
</html>