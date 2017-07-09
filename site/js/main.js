var map;
var geocoder;

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
    getMeetings();
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

