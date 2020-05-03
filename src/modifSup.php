<form method="POST" class="formModSup">
  <div class="tabs divsup">
        <ul class="modsup">
             <li class="activetab" id="modif" onclick="tab1('modif','supp','modify','delete')">Modifier</li>
             <li  id="supp" onclick="tab1('modif','supp','modify','delete')">Supprimer</li>
        </ul>
        <div id="updateQ" >
            <div id="modify">
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
                                <select id="choix" name="choix" >
                                    <option value="">Donnez le type de réponse</option>
                                    <option value="ChoixMultiple">Choix Multiple</option>
                                    <option value="ChoixSimple">Choix Simple</option>
                                    <option value="ChoixText">Choix Text</option>
                                </select>
                                <img id="plus"  alt="plus"  src="../asset/Images/Icônes/ic-ajout-réponse.png">
                            </div>
                            <div class="rep" id="rep">
                            
                            </div>
                            <div class="but">
                            <button id="modifier" name="modify">Modifier</button>

                            </div>
                            
                            <?php
                            include("fonction.php");
                            validQuestion('modify','modifiée')
                            
                            ?>
                </div>        

            </div>
            <div id="delete" >
                <div class="question">
                    <h3>Ecrivez la Question à supprimer</h3>
                    <textarea name="delQ" ></textarea>
                </div>
                <div class="delbut">
                    <button name="delete" id="deletebut" >SUPPRIMER</button>          
                </div>
                <?php
                
                supprimer();
                ?>
                </div>
        </div>

  </div>
  

</form>
<script src="../asset/javascript/script.js"></script>



