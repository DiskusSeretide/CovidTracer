function fetch_data()
{
    var dataTable = $('#user_data').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
                url:"PHP/tableQueries/fetch_records.php",
                type:"POST",
               },
        "scrollX": true,
        "scrollY":        "400px",
        "scrollCollapse": true,
    });
}

function update_data(id, column_name, value)
{
   $.ajax({
        url: "PHP/tableQueries/update_record.php",
        method: "POST",
        data: {
                id: id,
                column_name: column_name,
                value: value
            },
        success: (flag) =>{
            let msg = 'Data Updated';
            let c = 'success';
            if(!flag){
                msg = 'Data Cound Not Update';
                c = 'danger';
            }
            
            $('#alert_message').html("<div class='alert alert-" + c + "'>" + msg + "</div>");
            $('#user_data').DataTable().destroy();

            fetch_data();
        }
    });

    setTimeout( () => {
        $('#alert_message').html('');
    }, 5000);
}

function delete_record(id){
    $.ajax({
    url: "PHP/tableQueries/delete_record.php",
    method: "POST",
    data: {id:id},
    success: (flag) => {
        let msg = 'Row Deleted';
        let c = 'success';
        if(!flag){
            msg = 'Row could not be deleted';
            c = 'danger';
        }
            
          $('#alert_message').html("<div class='alert alert-" + c + "'>" + msg + "</div>");
          $('#user_data').DataTable().destroy();

          fetch_data();
       }
    });

    setTimeout( () => {
    $('#alert_message').html('');
    }, 5000);
 }

 function delete_all(){
    $.ajax({
    url: "PHP/tableQueries/delete_all.php",
    method: "POST",
    success: (flag) => {
        let msg = 'Table Deleted';
        let c = 'success';
        if(!flag){
            msg = 'Could not delete table';
            c = 'danger';
        }
            
          $('#alert_message').html("<div class='alert alert-" + c + "'>" + msg + "</div>");
          $('#user_data').DataTable().destroy();

          fetch_data();
       }
    });

    setTimeout( () => {
    $('#alert_message').html('');
    }, 5000);
 }

 // add blank row for new insert
$('#add').click(function(){
   
    let html = '<tr>';
    html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
    html += '<td contenteditable id="data1"></td>';
    html += '<td contenteditable id="data2"></td>';
    html += '<td contenteditable id="data3"></td>';
    html += '<td contenteditable id="data4"></td>';
    html += '<td contenteditable id="data5"></td>';
    html += '<td contenteditable id="data6"></td>';
    html += '<td contenteditable id="data7"></td>';
    html += '<td contenteditable id="data8"></td>';
    html += '<td contenteditable id="data9"></td>';
    html += '<td contenteditable id="data10"></td>';
    html += '<td contenteditable id="data11"></td>';
    html += '<td contenteditable id="data12"></td>';
    html += '<td contenteditable id="data13"></td>';
    html += '<td contenteditable id="data14"></td>';
    html += '<td contenteditable id="data15"></td>'; 
    html += '</tr>';
    
    $('#user_data tbody').prepend(html);
});

function insert_record(name, address, types, coords, rating, votes, cp, mon, tue, wedn, thur, frid, sat, sun, dur){
    $.ajax({
        url:"PHP/tableQueries/insert_record.php",
        method:"POST",
        data: {
                name: name,
                address: address,
                types: types,
                coords: coords,
                rating: rating,
                votes: votes,
                cp: cp,
                mon: mon,
                tue: tue,
                wedn: wedn,
                thu: thur,
                frid: frid,
                sat: sat,
                sun: sun,
                time_spent: dur
            },
            success: (flag) => {
                console.log(flag);
                let msg = 'Row Inserted';
                let c = 'success';
                if(!flag){
                    msg = 'Row could not be Inserted';
                    c = 'danger';
                }
                  // manipulate class based on outcome
                  $('#alert_message').html("<div class='alert alert-" + c + "'>" + msg + "</div>");
                  $('#user_data').DataTable().destroy();

                  fetch_data();
               }
        });
        
        setTimeout( () => { $('#alert_message').html('');}, 5000);
}


async function loadfileData(){
    // get file name
    const myFile = document.getElementById("my-file");
    const filename = "../data/".concat(myFile.files[0].name);
    // load data asychronously from file
    const response = await fetch(filename);
    const data = await response.json();
    return data;
}

async function insertFiledata(){

    let fileData = await loadfileData();
    // iterate data before storing
    const ids = [];
    const names = [];
    const addresses = [];
    const types = [];
    const coords = [];
    const ratings = [];
    const ratings_n = [];
    const current_popularities = [];
    const populartimess = [];
    const times_spent = [];

    // parse, clean and store to arrays
    for (let store of fileData) {

        ids.push(store['id']);

        names.push(store['name']);

        addresses.push(store['address']);

        // every element in types list is a concatenated set item for db
        // remove these 3 types
        //store,establishment
        /*
        if(store['types'].length > 1){
            for(let i = 0; i < store['types'].length; i++){
                if ( store['types'][i] === 'point_of_interest')
                store['types'].splice(i, 1);
                if (store['types'][i] === 'establishment')
                    store['types'].splice(i, 2);
                if (store['types'][i] === 'store')
                    store['types'].splice(i, 3);
            }
        }
        */
        types.push(store['types'].join());
        
        coords.push(JSON.stringify(store['coordinates']));
        
        // chech for undefined values
        if (typeof(store['rating']) === 'undefined')
            store['rating'] = 0.0;
        ratings.push(store['rating']);

        // chech for undefined values
        if (typeof(store['rating_n']) === 'undefined')
            store['rating_n'] = 0;
        ratings_n.push(store['rating_n']);

        // chech for undefined values
        if (typeof(store['current_popularity']) === 'undefined')
            store['current_popularity'] = 0;
        current_popularities.push(store['current_popularity']);
        // list of json for popular times

        temp = [];
        store['populartimes'].forEach((element) => {
            temp.push(JSON.stringify(element['data']));
        })
        populartimess.push(temp);

        // chech for undefined values
        if (typeof(store['time_spent']) === 'undefined'){
            store['time_spent'] = [0, 0];
        }   
        times_spent.push(store['time_spent']);
    }

    // give arrays to php
        $.ajax({
            url: "PHP/bulk_insert.php",
            type: "POST",
            datatype: 'json',
            data:
                {
                    ids: ids,
                    names: names,
                    addresses: addresses,
                    typess: types,
                    coords: coords,
                    ratings: ratings,
                    ratings_n: ratings_n,
                    current_popularities: current_popularities,
                    populartimess: populartimess,
                    times_spent: times_spent,
                },

            cache: false,
            success: (message) => {
                var msg = JSON.parse(message);
                if(msg.statusCode){
                    $('#user_data').DataTable().destroy();
                    fetch_data();					
                }
                else
                    $('#alert_message').html("<div class='alert alert-danger'>Error occured. Unable to load data!</div>");
                    setTimeout( () => { $('#alert_message').html('');}, 5000);
            }
        });
    
}