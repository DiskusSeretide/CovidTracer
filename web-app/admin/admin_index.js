          //    load stats to cards
// #################################################################################################################### //

// ajax request for total visits
$(document).ready(() => {
  $.ajax({

    url: "PHP/cardQueries/fetch_total_visits.php",
    type: "POST",
    dataType:"json",
    success: (row) => {
        $("#outputvisits").html(row);
    }

  });
});


// ajax request for total Covid Cases
$(document).ready(() => {
  $.ajax({

    url: "PHP/cardQueries/fetch_total_covid_cases.php",
    type: "POST",
    dataType:"json",
    success: (row) => {
        $("#outputcovid").html(row);
    }

  });
});


// ajax request for active Covid Cases
$(document).ready(() => {
    $.ajax({

        url: "PHP/cardQueries/fetch_active_covid_cases.php",
        type: "POST",
        dataType:"json",
        success: (row) => {
            $("#outputactive").html(row);
        }
    });
  });


          // js for charts
// #################################################################################################################### //
  // start end dates
  function getDatesForGraph(){
    const start = document.getElementById('startdate').value;
    const end = document.getElementById('enddate').value; 
    return {start, end};
  }

  // single date
  function getDateForGraph(){
    const date = document.getElementById('onlyDate').value;
    return {date};
}

// XMLHT request with promise
function fetchData(url, callback) {
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

      const param = callback();
      request.open('GET' ,url+"?q="+JSON.stringify(param), true);
      request.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
      request.send();

  });
}


function parseData(d){

  // return a 2d array
  // first dim contains visits per day
  // second contains visits from active cases per day

  // for first graph
  const visitsXs = [];
  const visitsYs = [];

  // for covid graph
  const covidXs = [];
  const covidYs = [];

  // check for empty dataset
  if (typeof(d.length) === 'undefined'){
    visitsXs[0] = visitsYs[0] = covidXs[0] = covidYs[0] = 0;
    return {visitsXs, visitsYs, covidXs, covidYs};
  }

  // apply data for visits
  d[0].forEach( (cell) => {
    visitsXs.push(cell.date);
    visitsYs.push(cell.cnt);
  });

  // apply data for covid visits
  d[1].forEach( (cell) => {
    covidXs.push(cell.date);
    covidYs.push(cell.cnt);
  });
  
  return {visitsXs, visitsYs, covidXs, covidYs};
}


function chehckIfChecked()
{
    var inputs = document.getElementsByTagName("input");
    for(var i = 0; i < inputs.length; i++)
    {
        if(inputs[i].type == "checkbox") 
            inputs[i].checked = true; 
    }
}

window.addEventListener('load', () => {
  chehckIfChecked();
});