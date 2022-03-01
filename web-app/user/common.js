  // email validator
  const validateEmail = (email) => {
    return String(email)
      .toLowerCase()
      .match(
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
      );
  };
  
  // At least: 8 chars, 1 Upper, 1 lower, 1 special char
  const validatePass = (password) => {
    return String(password)
        .match(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/);
  };
  
  // username allowed to be from 6-20 chars long, contain lower, upper, digits and '_'
  const validateUsername = (username) => {
    return String(username)
      .match(/^[a-zA-Z0-9_]{6,20}[a-zA-Z]+[0-9]*$/);
  };
  
  

/* When the user scrolls down, hide the navbar. When the user scrolls up, show the navbar */
const prevScrollpos = window.pageYOffset;
window.onscroll = () => {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) 
        document.getElementById("bar-section").style.top = "0";
    else 
    document.getElementById("bar-section").style.top = "-60px";

    prevScrollpos = currentScrollPos;
}

window.onbeforeunload = function () {
window.scrollTo(0, 0);
}


// XMLHT request with promise
function fetchTableData(url) {
    return new Promise( (resolve, reject) => {
        const request = new XMLHttpRequest();

        request.onload = () => {
            if (request.readyState === 4) {
                if ((request.status == 200) && (request.responseText != null))
                    resolve(JSON.parse(request.responseText));
                else
                    reject('Error Code: ' +  request.status + ' Error Message: ' + request.statusText);
            }
        };

        request.open('GET' ,url, true);
        request.send();
    });
}

// parse data and fill table
async function populateTable(tableId, url){
    try {
       const data = await fetchTableData(url);
       // clear table
        while (tableId.firstChild){
            tableId.removeChild(tableId.firstChild);
        }
        data.forEach((row) => {
            const tr = document.createElement('tr');
            for (i in row){
                const td = document.createElement('td');
                td.textContent = row[i];
                tr.appendChild(td);
            }
            
            tableId.appendChild(tr);
        })
    } catch(error) {
        console.log("Error fetching remote HTML: ", error);
    }              
}
