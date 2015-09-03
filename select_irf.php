<?php 
    $first = $_GET["first"];
    $dname = $_GET["dname"];
    $addr = $_GET['addr'];
    $brand = $_GET['brand'];
    $city = $_GET['city'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/signin.css" rel="stylesheet">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
.controls {
  margin-top: 10px;
  border: 1px solid transparent;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  height: 32px;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 300px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

.pac-container {
  font-family: Roboto;
}

#type-selector {
  color: #fff;
  background-color: #4d90fe;
  padding: 5px 11px 0px 11px;
}

#type-selector label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}
.list-area {
  overflow-y: scroll;
  width: 100%; 
}

    </style>
    <title>Places Searchbox</title>
    <style>
      #target {
        width: 345px;
      }
    </style>
  </head>
  <body>
    <div class="container-fluid" style="height:100%; width:100%; padding:0px;">
      <div class="row-fluid" style="height:100%; width:100%;">
        <div class="col-md-3" style="height:100%;">
          <div class="page-header" style="text-align: center;">
            <h5>Select IRFs you ship to regularly</h5>
          </div>
          <div class="list-area">
            <ul id="selectedLocations" class="list-group"></ul>
          </div>
          <button id="finBtn" class="btn btn-default btn-block" data-toggle="modal" data-target="#myModal">Skip</a>
        </div>
        <div class="col-md-9" style="height:100%;">
          <div style="height:100%; width:100%;">
          <input id="pac-input" class="controls" type="text" placeholder="Search Box">
          <div id="map"></div>
        </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!--<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">All Done</h4>
          </div>-->
          <div class="modal-body" style="text-align: center;">
            <h2>Setup Complete</h3>
              <div class="form-logo"><img src="assets/HotShotIcon.png"></div>
            <p>Thanks for registering your dealership with Hotshot!</p>
          </div>
          <div class="modal-footer">
            <a href="index.php" type="button" class="btn btn-danger">Continue to your dashboard</a>
            <a href="login.html" type="button" class="btn btn-default">Return to homepage</a>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>    
    <script>

// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.

function initAutocomplete() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -33.8688, lng: 151.2195},
    zoom: 13,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  var geocoder = new google.maps.Geocoder();
  geocodeAddress(geocoder, map);
  // Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  var markers = [];
  // [START region_getplaces]
  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }

    // Clear out the old markers.
    markers.forEach(function(marker) {
      marker.setMap(null);
    });
    markers = [];

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      var icon = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };

      var m = new google.maps.Marker({
        map: map,
        icon: icon,
        title: place.name,
        position: place.geometry.location
      });

      // Create a marker for each place.
      markers.push(m);
      google.maps.event.addListener(m, 'click', function() {
        var list = document.getElementById('selectedLocations');
        var li = document.createElement('li');
        li.setAttribute('class', 'list-group-item');
        li.innerHTML = "<span class='pull-right'><button type='button' class='close' aria-label='Close'><span aria-hidden='true'>&times;</span></button></span> "+place.name;
        li.onclick = function() {this.parentNode.removeChild(this);}
        list.appendChild(li);

        //then change the button if it needs to be done
        var btn = document.getElementById('finBtn');   
        btn.innerHTML = "Finish";
        btn.setAttribute('class', 'btn btn-danger btn-block');
      });

      if (place.geometry.viewport) {
        // Only geocodes have viewport.
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
  // [END region_getplaces]
}

function geocodeAddress(geocoder, resultsMap) {
  var address = "<?php echo $city ?>";
  geocoder.geocode({'address': address}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      resultsMap.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
        map: resultsMap,
        position: results[0].geometry.location
      });
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}


    </script>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete"
         async defer></script>
  </body>
</html>