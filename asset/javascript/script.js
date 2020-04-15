function readURL(input) {

    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function (e) {

            $('#img').attr('src', e.target.result);

        }

        reader.readAsDataURL(input.files[0]);

    }

}

$("#file").change(function(){

    readURL(this);

});


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
	} else {
		input.className="success";
	}

}
}
