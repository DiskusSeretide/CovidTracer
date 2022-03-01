
// do this on page load
window.addEventListener('load', (event) => {
    // get DOM
    const covidTable = document.querySelector('#mycovid-table > tbody');
    populateTable(covidTable, 'covid_table.php');
});


function submitCovidDate(){
    let datepicker = document.getElementById('datePicker');
    $.ajax({
        url: "submit_covid.php",
        type: "GET",
        data: {
            'date': datepicker.value,
        },
        success: function(message){
            const msg = JSON.parse(message);
           if(msg.statusCode == 200)
           {
                const covidTable = document.querySelector('#mycovid-table > tbody');
                populateTable(covidTable, 'covid_table.php');
           }
           else if(msg.statusCode == 201)
              alert('Something occured. Was not able submit date.');
           else if(msg.statusCode == 202)
              alert('Covid submtions are not valid unless 14 days have passed.');
        }
    });
}

