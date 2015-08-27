<?php 
	$part = $_GET["part"];
	$dest = $_GET["toaddr"];
	$driver = $_GET["driver"];
	$dest_txt = str_replace('_', ' ', $dest);
	$google_api_key = "AIzaSyCBD73K2lsxmmswnGWm05A6LpSsnWe_dvA";
	$google_js_api_key = "AIzaSyB-2nXgzKIDqNmgaAareAtmhXzCKZmAyY0";
	function buildReq($output, $parameters) {
		$req = "";
		$req .= "https://maps.googleapis.com/maps/api/directions/" . $output . "?";
		foreach($parameters as $key => $value) {
			$req .= $key ."=". $value ."&"  ;
		}
		//echo $req;

		return $req;
	}

	function translateAddr($d){
		return 'https://maps.googleapis.com/maps/api/geocode/json?address='.$d.'&key='.$google_api_key; 
	}

	function getCurrLoc(){ return "750+Camino+Del+Rio+N,+San+Diego,+CA+92108"; } //temp stub

	function getDestination() {
		$dest_esc = str_replace('_', '+', $_GET['toaddr']);
		/*$translated = translateAddr($dest_esc);
		echo $translated;*/
		return $dest_esc;
	}

	function getDriverDetails($driver){}

	function getPartDetails($part){}

	function getRoute(){
		$o = getCurrLoc();
		$d = getDestination();
		$params = array(
							"origin" => $o,
							"destination" => $d
						);

		return $params;

	}

	function execCurlReq($url){
	    // is cURL installed yet?
	    if (!function_exists('curl_init')){
	        die('Sorry cURL is not installed!');
	    }
	 
	    // OK cool - then let's create a new cURL resource handle
	    $ch = curl_init();
	 
	    // Now set some options (most are optional)
	 
	    // Set URL to download
	    curl_setopt($ch, CURLOPT_URL, $url);
	 
	    // Set a referer
	    //curl_setopt($ch, CURLOPT_REFERER, "http://www.example.org/yay.htm");
	 
	    // User agent
	    //curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
	 
	    // Include header in result? (0 = yes, 1 = no)
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	 
	    // Should cURL return or print out the data? (true = return, false = print)
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 
	    // Timeout in seconds
	    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	 
	    // Download the given URL, and return output
	    $output = curl_exec($ch);
	 
	    // Close the cURL resource, and free system resources
	    curl_close($ch);
	 
	    return $output;
	}

	$req = buildReq("json", getRoute());
	//echo $req;
	$resp = execCurlReq($req);
	$resp = json_decode($resp, true);
	$routes = $resp['routes'];
	$geo = execCurlReq(translateAddr(str_replace('_', '+', $_GET['toaddr'])));
	$geo = json_decode($geo, true);
	$dest_lat = $geo['results'][0]['geometry']['location']['lat'];
	$dest_lng = $geo['results'][0]['geometry']['location']['lng'];
	$home = execCurlReq(translateAddr("750+Camino+Del+Rio+N,+San+Diego,+CA+92108"));
	$home = json_decode($home, true);
	$home_lat = $home['results'][0]['geometry']['location']['lat'];
	$home_lng = $home['results'][0]['geometry']['location']['lng'];
	$home = "750 Camino Del Rio N, San Diego, CA 92108";
	//print_r($routes[0]['summary']);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Hotshot</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
      html, body { height: 100%; margin: 0; padding: 0; }
      #map { height: 50%; margin-bottom: 50px;}
      #activity { height: 50%; }
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<nav class="navbar navbar-default" style="margin-bottom: 0px;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img src="assets/HotShotIcon.png" height="100%"></a><p class="navbar-text">Signed in as Dealer Member</p>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <!--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
        </li>
      </ul>-->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    <div id="map"></div>
    <div id="activity">
    	<div class="container">
    		<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">My Drivers</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Hotshots</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
		<div class="list-group">
		  <a href="#" id="show" class="list-group-item list-group-item-success">
		    <h4 class="list-group-item-heading">Delivery to <?php echo $dest_txt ?></h4>
		    <p class="list-group-item-text">Driver: <?php echo $driver ?></p>
		    <p class="list-group-item-text">Part: <?php echo $part ?></p>
		   	<p class="list-group-item-text">Status: On Time</p>
		   	<p class="list-group-item-text">ETA: 19 min</p>
		  </a>
		</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="profile">
		<div class="list-group">
		  <a href="#" class="list-group-item list-group-item-warning">
		    <h4 class="list-group-item-heading">Delivery to 1234 Fake Address, San Diego CA 92131</h4>
		    <p class="list-group-item-text">Driver: Jennifer Aniston</p>
		    <p class="list-group-item-text">Part: xxxxxxxxxx</p>
		   	<p class="list-group-item-text">Status: En Route to Pick Up</p>
		   	<p class="list-group-item-text">ETA: 2 min</p>
		  </a>
		</div>
		<div class="list-group">
		  <a href="#" class="list-group-item list-group-item-danger">
		    <h4 class="list-group-item-heading">Delivery to 6675 Fake Address, San Diego CA 92131</h4>
		    <p class="list-group-item-text">Driver: Stevie Ray Vaughn</p>
		    <p class="list-group-item-text">Part: xxxxxxxxxx</p>
		   	<p class="list-group-item-text">Status: Idle</p>
		   	<p class="list-group-item-text">ETA: N/A </p>
		  </a>
		</div>
    </div>  
  </div>

</div>

    		<!--<div class="btn-group" role="group" aria-label="..." style="margin-bottom: 15px;">
			  <button type="button" class="btn btn-default">My Drivers</button>
			  <button type="button" class="btn btn-default">Hotshots</button>
			</div>
			<div class="list-group">
			  <a href="#" id="show" class="list-group-item list-group-item-success">
			    <h4 class="list-group-item-heading">Delivery to <?php echo $dest_txt ?></h4>
			    <p class="list-group-item-text">Driver: <?php echo $driver ?></p>
			    <p class="list-group-item-text">Part: <?php echo $part ?></p>
			   	<p class="list-group-item-text">Status: On Time</p>
			   	<p class="list-group-item-text">ETA: 10 min</p>
			   	
			  </a>
			</div>-->
		</div>
    </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">

	var map;
	function initMap() {
		var directionsService = new google.maps.DirectionsService;
  		var directionsDisplay = new google.maps.DirectionsRenderer;
		map = new google.maps.Map(document.getElementById('map'), {
		   center: {lat: <?php echo $home_lat ?>, lng: <?php echo $home_lng ?>},
		   zoom: 17
		});
		directionsDisplay.setMap(map);
		var onClickHandler = function() {
		   calculateAndDisplayRoute(directionsService, directionsDisplay);
		};
		document.getElementById('show').addEventListener('click', onClickHandler);


		var carLatLng1 = {lat: 32.767012, lng: -117.157791};
		var carLatLng2 = {lat: 32.766849, lng: -117.158349};
		var carLatLng3 = {lat: 32.767345, lng: -117.156611};
		var marker1 = new google.maps.Marker({
		    position: carLatLng1,
		    map: map,
		    title: 'Hello World!',
		    icon: "assets/hotshoticonsmall.png",
		    animation: google.maps.Animation.DROP
	  	});
	  	var marker2 = new google.maps.Marker({
		    position: carLatLng2,
		    map: map,
		    title: 'Hello World!',
		    icon: "assets/hotshoticonsmall.png"
	  	});
	  	var marker3 = new google.maps.Marker({
		    position: carLatLng3,
		    map: map,
		    title: 'Hello World!',
		    icon: "assets/hotshoticonsmall.png"
	  	});
	}
	function calculateAndDisplayRoute(directionsService, directionsDisplay) {
	  directionsService.route({
	    origin: <?php echo "'".$home."'" ?>,
	    destination: <?php echo "'9756 Aero Drive, San Diego, CA'" ?>,
	    travelMode: google.maps.TravelMode.DRIVING
	  }, function(response, status) {
	    if (status === google.maps.DirectionsStatus.OK) {
	      directionsDisplay.setDirections(response);
	    } else {
	      window.alert('Directions request failed due to ' + status);
	    }
	  });
	}

    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-2nXgzKIDqNmgaAareAtmhXzCKZmAyY0&callback=initMap">
    </script>
  </body>
</html>
<!--<!DOCTYPE html>
<html>
  <head>
    <style type="text/css">
      html, body { height: 100%; margin: 0; padding: 0; }
      #map { height: 100%; }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script type="text/javascript">

	var map;
	function initMap() {
	  map = new google.maps.Map(document.getElementById('map'), {
	    center: {lat: -34.397, lng: 150.644},
	    zoom: 8
	  });
	}

    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-2nXgzKIDqNmgaAareAtmhXzCKZmAyY0&callback=initMap">
    </script>
  </body>
</html>-->