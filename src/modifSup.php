<script src="../asset/javascript/script.js"></script>  

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
                            <button name="valider">Modifier</button>
                            </div>
                </div>        

            </div>
            <div id="delete" >
                <div class="question">
                    <h3>Questions</h3>
                    <textarea name="questions" ></textarea>
                </div>
            </div>
        </div>

</div>