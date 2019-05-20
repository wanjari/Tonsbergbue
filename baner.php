<?php
	include ("start.html");
?>
<legend class="text-left"> <h2>Baner</h2></legend>
<p>På kartet under finner du treningsbanene våre.</p>
<p>Innendørs trener vi i kjelleren til Tønsberghallen. Utendørs trener vi på Auli ved semslinja (på andre siden av veien for jarlsberg travbane.</p>
<br/>
<div class="kart" id="map" style="width:100%;height:500px"></div>
<br/>

<script>
    var locations = [
        ['Innendørs: Tønsberg idrettshall(kjelleren)', 59.284056, 10.418111], 	// kordinater til idrettshallen
        ['Utendørs: Auli ved Semslinja', 59.283492, 10.365688],				// kordinater til utendørsbanen
    ];

    // When the user clicks the marker, an info window opens.

    function initMap() {
        var myLatLng = {lat: 59.28, lng: 10.38};

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: myLatLng
            });

        var count=0;


        for (count = 0; count < locations.length; count++) {  

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[count][1], locations[count][2]),
                map: map
                });

            marker.info = new google.maps.InfoWindow({
                content: locations [count][0]
                });


            google.maps.event.addListener(marker, 'click', function() {  
                // this = marker
                var marker_map = this.getMap();
                this.info.open(marker_map, this);
                // Note: If you call open() without passing a marker, the InfoWindow will use the position specified upon construction through the InfoWindowOptions object literal.
                });
        }
    }
</script>
<script async defer
    src="************">
</script>
</div>

<?php
	include ("slutt.html");
?>