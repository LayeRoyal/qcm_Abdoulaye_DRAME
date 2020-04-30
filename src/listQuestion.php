 <!--nbre de question par je-->

 <?php
                    
             
                    if(isset($_POST['ok']))
                    {    $json= json_decode(file_get_contents('../asset/Json/admin.json'),true);
                        $json[$_SESSION['loginAdmin']]["QparJeu"]=$_POST['numb'] ;
                        $json= json_encode($json);
                        $json=file_put_contents('../asset/Json/admin.json',$json);
                    }
                    $json= json_decode(file_get_contents('../asset/Json/admin.json'),true);
                    $question= $json[$_SESSION['loginAdmin']]["QparJeu"];
        
       
        ?>  

<form class="formlq"  method="post">
<div class="containerlq">
    <div class="nbreQ">
        <label >Nbre de Question/Jeu</label>
        <input class="numb" name="numb" type="number"  value="<?php if(isset($question)){echo $question;}?>" min="5"/>
        <input class="ok" name="ok" type="submit" value="OK">
    </div>
    <div class="showQuestion">
        <?php
        
        $json= json_decode(file_get_contents('../asset/Json/question.json'),true);
        $nbrpage=ceil(count($json[$_SESSION['loginAdmin']])/5);
        $nbrElementParPage=5;
        if($_GET['list']<1 || !ctype_digit($_GET['list']))
        {
            $list=1;
        }
        elseif($_GET['list']>$nbrpage)
        {
            $list=$nbrpage;
        }
        else{
            $list=$_GET['list'];
        if(isset($json[$_SESSION['loginAdmin']]))
        {   
            $depart=($list-1)*$nbrElementParPage;
            $arrivee=($list-1)*$nbrElementParPage+$nbrElementParPage;
            for($i=$depart;$i<$arrivee;$i++)
            {   
                if(isset($json[$_SESSION['loginAdmin']][$i]))
                {
                     //affichage choix multiple
                if($json[$_SESSION['loginAdmin']][$i]["choix"]=="ChoixMultiple")
                {
                    echo '<h3>'.($i+1).'. '.$json[$_SESSION['loginAdmin']][$i]["questions"].'</h3>';
        
                    for($j=1;$j<=5;$j++)
                    {
                        if(isset($json[$_SESSION['loginAdmin']][$i]["ipt".$j]))
                        {   
                            if(isset($json[$_SESSION['loginAdmin']][$i]["ckbox".$j]) && $json[$_SESSION['loginAdmin']][$i]["ckbox".$j]=="on")
                            {
                                echo "<input type='checkbox' name='ckbox".$j."' checked/>";
                            }
                            else{
                                echo "<input type='checkbox' name='ckbox".$j."'/>";
                            }
                            echo $json[$_SESSION['loginAdmin']][$i]["ipt".$j].'<br>';
                        }
                        else
                        {
                        break;
                        }
                    }
                
                }
    
                //affichage choix simple
                if($json[$_SESSION['loginAdmin']][$i]["choix"]=="ChoixSimple")
                {
                    echo '<h3>'.($i+1).'. '.$json[$_SESSION['loginAdmin']][$i]["questions"].'</h3>';
                    while(key($json[$_SESSION['loginAdmin']][$i]) != 'ckbox') {next($json[$_SESSION['loginAdmin']][$i]);}                    $prev_val = prev($json[$_SESSION['loginAdmin']][$i]);
                    // and to get the key
                    $prev_key = key($json[$_SESSION['loginAdmin']][$i]);
                    for($j=1;$j<=5;$j++)
                    {       
                        if(isset($json[$_SESSION['loginAdmin']][$i]["ipt".$j]))
                        {   
                            if($prev_key=="ipt".$j)
                            {   
                                echo "<input type='radio' name='ckbox".$i."' checked/>";
                            }
                            else{
                                echo "<input type='radio' name='ckbox".$i."'/>";
                            }
                            echo $json[$_SESSION['loginAdmin']][$i]["ipt".$j].'<br>';
                        }
                        else
                        {
                            break;
                        }
                    }
                
                }
        
                    //affichage choix texte
                    if($json[$_SESSION['loginAdmin']][$i]["choix"]=="ChoixText")
                    {
                        echo '<h3>'.($i+1).'. '.$json[$_SESSION['loginAdmin']][$i]["questions"].'</h3>';
                            echo '<textarea readonly>'.$json[$_SESSION['loginAdmin']][$i]['ctext'].'</textarea>';
            
                    }
            
                }
             }
        
            }

        }    
        
               
            ?>
            </div>
        <div class="foot">
            <?php
        if($_GET['list']>1){echo "<a href='admin.php?page=listQuestion&list=".($list-1)."'><input id='prec' type='submit' value='Précédent'></a>";}

        if($_GET['list']<$nbrpage){echo "<a href='admin.php?page=listQuestion&list=".($list+1)."'><input id='suiv' type='submit' value='Suivant'></a>";}
        ?>
        </div>
    </div>
    
</form>

                   