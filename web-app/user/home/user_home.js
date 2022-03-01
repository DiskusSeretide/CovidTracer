//icons
var LeafIcon = L.Icon.extend({
    options: {
        shadowUrl: '../../images/leaf-shadow.png',
        iconSize:     [38, 95],
        shadowSize:   [50, 64],
        iconAnchor:   [22, 94],
        shadowAnchor: [4, 62],
        popupAnchor:  [-3, -76]
    }
});

var greenIcon = new LeafIcon({iconUrl: '../../images/leaf-green.png'}),
    redIcon = new LeafIcon({iconUrl: '../../images/leaf-red.png'}),
    orangeIcon = new LeafIcon({iconUrl: '../../images/leaf-orange.png'});



//load map and etc
async function loadMap(){
    
    // find user's location and center it within 5km radius
    async function onLocationFound(e)
    {

        let userMarker = L.marker(e.latlng, { draggable: "true" });
        userMarker.addTo(map);

        let circle = L.circle(e.latlng, {radius: 5000}).addTo(map);
        let center = circle.getBounds().getCenter();
        map.setView(center, 13);

    }

    // events for visits registration pop up
    $('#close').on('click', () => {
        $('.center').hide();
    });

    $("#submit-people").on('click', () =>{
        $('.center').hide("slow");
    });


    //function to parse data from db
    function createMarkers(data)
    {
        for (i in data)
        {   

            // store id for visit registration
            let storeId = data[i].id;

            // get current crowd based on visitors registers
            let peopleNow = Math.round(data.pop()['AVG(current_pop)']);

            // get hour
            let hour = parseInt(new Date().getHours());
            //get day
            let day = parseInt(new Date().getDay());

            // get from whole week the popularity for the current hour
            let weekDays = [JSON.parse(data[i].sun), JSON.parse(data[i].mon), JSON.parse(data[i].tue), JSON.parse(data[i].wedn), JSON.parse(data[i].thurs), JSON.parse(data[i].frid), JSON.parse(data[i].sat) ];
            // find population for same hour for each day
        
            // max population recorded of the day
            let maxPopulation = Math.max(...weekDays[day]);

            // crowd estimation for next 2 hours
            let peopleEstimate = parseInt( (weekDays[day][hour+1] + weekDays[day][hour+2]) / 2);

            // store name
            let name = data[i].name;

            // store's coordinates
            let loc = [parseFloat(data[i].co_lat), parseFloat(data[i].co_lng)];

            let iconColor = null;
            // decide what's the danger
            if (maxPopulation * 0.32 >= peopleEstimate)
                iconColor = greenIcon;
            else if (maxPopulation * 0.65 >= peopleEstimate)
                iconColor = orangeIcon;
            else 
                iconColor = redIcon;
                            
            // visit submission
            $("#popUp-form").submit( (event) => {            
            
                $.ajax({
                    type: "POST",
                    url: "submit_visit.php",
                    data: {
                            'storeId': storeId,
                            'people': $('#people-in').val()
                          },
                    dataType: 'json',
                    }).done( () => {
                        $(this).find("input").val("");
                        $("#popUp-form").trigger("reset");
                });
        
                event.preventDefault();
            });

                
            marker = new L.marker(L.latLng(loc), {icon: iconColor});  

            let html = $("<div>")
                        .append($("<h3 style='text-align: center;'>" + name.toUpperCase() + "</h3>"))
                        .append($("<ul>"))
                        .append($("<li> Crowd estimation: " + peopleEstimate + "</li>"))
                        .append($("<li> Based on visitors: " + peopleNow + "</li>"))
                        .append($("<br>"))
                        .append($("<button type='button' id='btn-pop' style='margin:0 auto; display:block;'> Sumbit your visit </button>")
                        .click( () => { $('.center').show(); })[0])[0];
        

            marker.bindPopup(html);
            
            marker.addTo(searchLayer);
            
        }
        map.fitBounds(searchLayer.getBounds(), {maxZoom: 17});
    }

    //search in db for stores
    async function searchByAjax(text, callback)
	{
		 return $.ajax({
			url: 'search.php',	
			type: 'GET',
			data: {store: text},
			dataType: 'json',
			success: (json) => {
				callback(json);
                createMarkers(json);
			}
		});
	}

    // create map
    const map = L.map('mapid').locate({setView: true, maxZoom: 13});
    map.on('locationfound', onLocationFound);

    const attribution = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';
    const tileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

    //add base layer
    L.tileLayer(tileUrl, { attribution}).addTo(map);
       
    const searchLayer = new L.featureGroup();
    map.addLayer(searchLayer);

    const searchControl =  new L.Control.Search({sourceData: searchByAjax, marker: false, markerLocation: true}).addTo(map);
    
    map.on('click', () => {
       searchLayer.clearLayers();
    });

    searchControl.on('search:cancel', () => {
       searchLayer.clearLayers();
    });
    
}
