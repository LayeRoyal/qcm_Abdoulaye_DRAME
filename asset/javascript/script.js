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
             var reader = new FileReader();

            reader.onload = function (e) {

                $('#img').attr('src', e.target.result);

                                        }

       
        }

        reader.readAsDataURL(input.files[0]);
       
      

    }

}

$("#file").change(function(){

    readURL(this);

});
 
//verifier si le login existe fonction
function verifier(js, champ)
{
$.getJSON(js, function(data) {
    for(let element in data)
    {
        if(element==champ.value)
        {
            champ.className="error";
            
        }
    }
        });
}
//javascript form validation

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

//Page creer question



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
        rep.appendChild(div)
        let i= (rep.children.length);
        let label=document.createElement("label");
        let input=document.createElement("input");
        let  cb=document.createElement("input");
        let img=document.createElement('img');
         label.id="lab";
         label.innerHTML="Réponse "+(i)+" :";
         input.id="ipt";
         input.setAttribute("required","");
         input.name="ipt"+i;
         cb.className="ckbox";
         img.setAttribute("src","../asset/Images/Icônes/ic-supprimer.PNG")

         if(choice.value=="ChoixMultiple")
         {  
            cb.type="checkbox";
            cb.name="ckbox"+i;               
            
            div.appendChild(label);
            div.appendChild(input);
            div.appendChild(cb);
            div.appendChild(img);

         }
         else
         {               
            cb.type="radio";
            cb.name="ckbox";
            
            div.appendChild(label);
            div.appendChild(input);
            div.appendChild(cb);
            div.appendChild(img);

         }
        
         

       }
           
    }     
    else if(choice.value=="ChoixText")
    {              
        rep.innerHTML="";
        let text=document.createElement("TEXTAREA");
        let label=document.createElement("label");
        text.name="ctext";
        text.setAttribute("required","");
        label.innerHTML="Réponse";

        rep.append(label);
        rep.append(text);
       
    }
    else{
        rep.innerHTML="";
    }
 }