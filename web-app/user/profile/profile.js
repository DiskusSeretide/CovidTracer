// do this on page load
window.addEventListener('load', (event) => {
    // get DOM
    const visitTable = document.querySelector('#visits-table > tbody');
    populateTable(visitTable, 'visit_table.php');
});


// function to toggle show pass ckeckbox
function showPass() {
    const x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }


function chehckIfChecked(){
    const checkbox = document.getElementById("showpass");
    if (checkbox.checked){
        checkbox.checked = false;
        document.getElementById("password").type = "password";
    }
}
// function to save changes for profile via ajax request
function saveChanges(){
    
    const fullname = document.getElementById('fullname').value; 
    const username = document.getElementById('username').value; 
    const password = document.getElementById('password').value; 
    let elem = document.getElementById('error-label');

    var error =  '';
    elem.style.color = 'red';

    if(fullname == '')
        error = 'Full Name cannot be empty'; 

    else if(username == '')
        error = 'Username is required';

    else if(!validateUsername(username))
        error = 'Username is not valid';
    
    else if(password == '')
        error = 'Password is required'; 

    else if(!validatePass(password)) //check password value length six 
        error = 'Password must contain at least 8 chars, 1 upper, 1 lower and 1 special';

    else{			
        $.ajax({
            type: 'POST',
            url: 'submit_personal.php',
            data: 
                {
                    'fl': fullname, 
                    'us': username, 
                    'pass': password
                },
            success: function(response){
            const msg = JSON.parse(response);
                if(msg.status){
                    chehckIfChecked();
                    elem.style.color = 'rgb(0, 128, 0)';
                    elem.innerHTML = 'Changes Completed';
                }
                else
                    elem.innerHTML = 'Something went wrong';
            }
        });
            
    }
    elem.innerHTML = error;
    setTimeout( () => { elem.innerHTML = '';}, 5000);
}

window.addEventListener('load', () => {
    chehckIfChecked();
});
