function readURL(input) {

    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function (e) {

            $('#img').attr('src', e.target.result);

        }

        reader.readAsDataURL(input.files[0]);
        if((input.files[0].type)!="image/jpeg" && (input.files[0].type)!="image/jpg" && (input.files[0].type)!="image/png")
        {
            alert("Veuillez choisir une image au format png,jpg ou jpeg ")
        }

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

//image type verification

