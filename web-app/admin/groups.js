          // js to load stats to tables
// #################################################################################################################### //
$(document).ready(() => {
    // get DOMS
    const visitGroup = document.querySelector('#visit-group > tbody');
    const covidGroup = document.querySelector('#covid-visit-group > tbody');
    populateTable(visitGroup, 'PHP/tableQueries/visits_choices.php');
    populateTable(covidGroup, 'PHP/tableQueries/covid_choices.php');
  });
  
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