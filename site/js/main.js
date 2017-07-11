var map;
var geocoder;

var panel;
var initialize;
var calculate;
var direction;

function encryptPassword() {
	var rawPassword 	= document.getElementById('rawPassword');
	var password 		= document.getElementById('password');
	password.value 		= md5(rawPassword.value);
	rawPassword.value 	= '';
}

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 44.863, lng: -0.621},
        zoom: 8
    });
	
	
	//Add listener

	
    getMeetings();
	
	direction = new google.maps.DirectionsRenderer({
		map   : map, 
		panel : panel 
	});
}

function displayMeetingsOnMap(meetings) {
    if (meetings.length <= 0)
        return;

    // Center map
    geocoder = new google.maps.Geocoder();
    geocoder.geocode( { 'address': meetings[0].location}, function(results, status) {
        if (status == 'OK') {
            map.setCenter(results[0].geometry.location);
        }
    });

    // Display markers on meetings
    meetings.forEach(function(meeting) {
        geocoder.geocode( { 'address': meeting.location}, function(results, status) {
            if (status == 'OK') {

                var contentString =
                    '<p><b>Ordre du jour : </b>' + meeting.title + '</p>' +
                    '<p><b>Début : </b>' + meeting.date_start + '</p>' +
                    '<p><b>Fin : </b>' + meeting.date_end + '</p>' +
                    '<p><b>Lieu : </b>' + meeting.location + '</p>' +
                    '</div>';

                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });


                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });
				
				google.maps.event.addListener(marker, "click", function(event) {
				  toggleBounce(marker);
				  showInfo(this.position);
				});
            }
        });
    })
}

function getMeetings() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            displayMeetingsOnMap(JSON.parse(this.responseText));
        }
    };
    xhttp.open("GET", "getMeetings.php", true);
    xhttp.send();
}



window.onload = function() {
	$('input[type="datetime"]').datetimepicker();

    handleClientLoad();

};

calculate = function(){
    origin      = document.getElementById('origin').value; // Le point départ
    destination = document.getElementById('destination').value; // Le point d'arrivé
    if(origin && destination){
        var request = {
            origin      : origin,
            destination : destination,
            travelMode  : google.maps.DirectionsTravelMode.DRIVING // Type de transport
        }
        var directionsService = new google.maps.DirectionsService(); // Service de calcul d'itinéraire
        directionsService.route(request, function(response, status){ // Envoie de la requête pour calculer le parcours
			if(status == google.maps.DirectionsStatus.OK){
                direction.setDirections(response); // Trace l'itinéraire sur la carte et les différentes étapes du parcours
            }
        });
    } //http://code.google.com/intl/fr-FR/apis/maps/documentation/javascript/reference.html#DirectionsRequest
};

   
function showInfo(latlng) {
  geocoder.geocode({
	'latLng': latlng
  }, function(results, status) {
	if (status == google.maps.GeocoderStatus.OK) {
	  if (results[1]) {
		// here assign the data to asp lables
		document.getElementById("destination").value = results[1].formatted_address;
	  } else {
		alert('Pas de résultat trouvé');
	  }
	} else {
	  alert('Geocoder en erreur à cause de : ' + status);
	}
  });
}

function toggleBounce(marker) {
	
	if (marker.getAnimation() != null) {
		marker.setAnimation(null);
	} else {
		marker.setAnimation(google.maps.Animation.BOUNCE);
	}
}
