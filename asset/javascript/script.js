function readURL(input) {
    if (input.files && input.files[0]) 
    {                //image type verification
          if((input.files[0].type)!="image/jpeg" && (input.files[0].type)!="image/jpg" && (input.files[0].type)!="image/png")
        {
            alert("Veuillez choisir une image au format png,jpg ou jpeg ")
        }
                 //image size verification
        else if((input.files[0].size)>2096000)
        {
            alert("Taille trop grande \n Veuillez choisir une taille inferieur à 2MB")
        }

        else
        {
            var output = document.getElementById('img');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
              URL.revokeObjectURL(output.src) // free memory
            }
       
        }
     

    }

}
try{
    const quest = document.getElementById('quest');
    const nbrPoint = document.getElementById('point');
    
    valider(quest);
    valider(nbrPoint);
    
    //fonction qui verifie si c bon
    function valider(check){
        check.addEventListener('keyup', e => {
            e.preventDefault();
            
            checkTexte();
        });
        
        function checkTexte()
        {  
        const checkValue=check.value;
            if(checkValue === '') {
                check.className="error";
            }
            else {
                check.className="success";
            }
        }
    }
}
catch{
    console.log(EvalError);
}

try{
var file=document.getElementById('file');
file.addEventListener("change",function(){

    readURL(this);

});
 
//verifier si le login existe fonction
function verifier(js, champ)
{
fetch(js).then(function (reponse)
{
    return reponse.json();
}).then(function(data) {
    for(let element in data)
    {
        if(element==champ.value)
        {
            champ.className="error";
            
        }
    }
        }
        );
}
}
catch{
    console.log(EvalError);
    
}


//javascript form validation

try{
const fname = document.getElementById('fname');
const login = document.getElementById('login');
const lname = document.getElementById('lname');
const pass = document.getElementById('pass');
const confpass = document.getElementById('confpass');

validate(login);
validate(fname);
validate(lname);
validate(pass);
validate(confpass);

//fonction qui verifie si c bon
function validate(input){
input.addEventListener('keyup', e => {
	e.preventDefault();
	
	checkInputs();
});

function checkInputs()
{  
const inputValue=input.value;
    if(inputValue === '') {
		input.className="error";
	}
    else {
        input.className="success";
        //verifions si le login existe deja
        if(input==login)
        {
            verifier('../asset/Json/admin.json', login);
            verifier('../asset/Json/joueur.json', login);

        }
        // verifier si les 2 mdp sont identiques 
        if(input==confpass && pass.value==confpass.value)
        {
            confpass.className="success";
        }
        else if(pass.value!=confpass.value){
            confpass.className="error";
        }
		
    }
   

}
}
}
catch{
    console.log(EvalError);
    
}
//Page creer question

try{
var choice=document.getElementById("choix");
var rep=document.getElementById("rep");
choice.addEventListener("change",emptyrep);
function emptyrep(){
    
    var choice=document.getElementById("choix");
    var rep=document.getElementById("rep");
   if(choice.value=="ChoixText")
    {              
        rep.innerHTML="";
        let div=document.createElement("div");
        div.id="textdiv";
        rep.appendChild(div)
        let text=document.createElement("TEXTAREA");
        let label=document.createElement("h3");
        text.name="ctext";
        text.id="textrep";
        label.innerHTML="Réponse";
        label.id="textlab";

        div.append(label);
        div.append(text);
       
    }
    else {
        rep.innerHTML="";
    }
       
}
}
catch{
    console.log(EvalError);
    
}


try{
var adding=document.getElementById("plus");

adding.addEventListener("click",addinput);

function addinput() {
    var choice=document.getElementById("choix");
    var rep=document.getElementById("rep");

    if( (choice.value=="ChoixMultiple") || (choice.value=="ChoixSimple") )
    {
       if(rep.children.length<5)
       {
        let div=document.createElement("div");
        div.id="multisimple";
        div.className=(rep.children.length)+1;

        rep.appendChild(div);
        let i= (rep.children.length);
        let label=document.createElement("label");
        let input=document.createElement("input");
        let  cb=document.createElement("input");
        let img=document.createElement('img');
         label.id="lab";
         label.innerHTML="Réponse "+(i)+" :";
         input.id="ipt";
         input.name="ipt"+i;
         cb.id="ckbox";
         img.setAttribute("src","../asset/Images/Icônes/ic-supprimer.PNG");
        img.id="imgsup";
        img.className=i;

        //boutton supprimer
        img.addEventListener("click", suprep);
        function suprep()
        {
           if(i==div.className)
           {
               div.remove();
           } 
        }

         if(choice.value=="ChoixMultiple")
         {  
            cb.type="checkbox";
            cb.name="ckbox"+i;               
         }
         else
         {               
            cb.type="radio";
            cb.name="ckbox";
         }
            div.appendChild(label);
            div.appendChild(input);
            div.appendChild(cb);
            div.appendChild(img);
         

       }
           
    }     

    else if(choice.value==""){
        rep.innerHTML="";
    }
 }
}
catch{
    console.log(EvalError);
    
}

 //Tabulation score page joueur

  function tab1(option1,option2,container1,container2)
  {  
      
 
  var best=document.getElementById(option2);
  best.addEventListener("click", onglet1);
  var top=document.getElementById(option1);
  top.addEventListener("click", onglet2);
  var supp=document.getElementById("deletebut");
  supp.addEventListener("click", onglet1);

function onglet1(){
    var gauche=document.getElementById(option1);  
    var droite=document.getElementById(option2);
    let divTop=document.getElementById(container1);
    let hbest=document.getElementById(container2);
    divTop.style.visibility="hidden";
    hbest.style.visibility="visible";
    droite.className="activetab";
    gauche.className='';
}
  

  
  function onglet2()
  {  
    var gauche=document.getElementById(option1);  
    var droite=document.getElementById(option2);
    let divTop=document.getElementById(container1);
    let hbest=document.getElementById(container2);
    divTop.style.visibility="visible";
    hbest.style.visibility="hidden";
    gauche.className="activetab";
    droite.className='';

  }
}


