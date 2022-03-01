var x = document.querySelector("#login");
var y = document.querySelector("#register");
var z = document.querySelector("#btn");

function moveToRegister(){
  x.style.left = "-400px";
  y.style.left = "50px";
  z.style.left = "110px";
}

// function to toggle show pass ckeckbox
function showPass() {
  const x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function moveToLogin(){
  // clear any error
  document.getElementById("msg").innerHTML = '';

  x.style.left = "50px";
  y.style.left = "450px";
  z.style.left = "0px";

  $('#register')[0].reset();
}

window.addEventListener('load', () => {
  document.getElementById("login").reset();
  document.getElementById("register").reset();
});


  // function to toggle show pass ckeckbox
  function showPass() {
    const x = document.getElementById("login").elements[1];
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

function chehckIfChecked(){
  const checkbox = document.getElementById("checkbox_id");
  if (checkbox.checked){
      checkbox.checked = false;
  }
}

window.addEventListener('load', () => {
  chehckIfChecked();
});

// on submit event 
	$(document).on('click','#reg-btn',function(e){
		
		e.preventDefault();
		
    var email 	 = document.getElementById('ml').value; 
		var username = document.getElementById('name').value; 
		var password = document.getElementById('pass').value; 
    
		var error =  '';

	  if(email == ''){ //check email not empty
			error = 'Email is required'; 
		}
    else if(!validateEmail(email)){
      error =  'Email is not valid'
    }
    else if(username == ''){ // check username not empty
      error = 'Username is required';
		}
    else if(!validateUsername(username)){
      error = 'Username is not valid';
    }
		else if(password == ''){ //check password not empty
		  error = 'Password is required'; 
		}
		else if(!validatePass(password)){ //check password value length six 
			error = 'Password must contain at least 8 chars, 1 upper, 1 lower and 1 special';
		} 
		else{			
			$.ajax({
				url: 'registration.php',
				type: 'POST',
				data: 
					{
            'email': email, 
            'username': username, 
            'password': password
					},
				success: function(response){
          if(response.status)
          {
            moveToLogin();
            document.getElementById("login").elements[0].value = email;
            document.getElementById("login").elements[1].value = password;
          }
          else
            document.getElementById("msg").innerHTML = 'Email already used';
				}
			});
				
		}
      document.getElementById("msg").innerHTML = error;
	});