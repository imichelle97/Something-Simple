<?php 
  // session_start(); 
  include('server.php');
  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
	}
	$weight = 0;
  $price = 0;
  $tax = 0;
  $orderTot = 0;
  if(isset($_SESSION["weight"]) && isset($_SESSION["price"]) && isset($_SESSION["tax"]) && isset($_SESSION["orderTot"]))
  {
    $weight = $_SESSION["weight"];
    $price = $_SESSION["price"];
    $tax = $_SESSION["tax"];
    $orderTot = $_SESSION["orderTot"];
  }

  $username = $_SESSION['username']['username'];
  $query = "SELECT * FROM customer_profile WHERE username='$username';";
  // echo $query;

  $results = mysqli_query($db, $query);

  if(mysqli_num_rows($results) == 1) {
    $profile = mysqli_fetch_assoc($results);
    $firstName = $profile['first_name'];
    $lastName = $profile['last_name'];
    $address = $profile['address'];
    $city = $profile['city'];
    $state = $profile['state'];
    $zipcode = $profile['zipcode'];
    $card_type = $profile['card_type'];
    $card_number = $profile['card_number'];
    $cvc = $profile['cvc'];
    $expiration_date = $profile['expiration_date'];
  } else if(mysqli_num_rows($results) == 0) {
    $profile = mysqli_fetch_assoc($results);
    $firstName = "-";
    $lastName = "-";
    $address = "-";
    $city = "-";
    $state = "-";
    $zipcode = "-";
    $card_type = "-";
    $card_number = "-";
    $cvc = "-";
    $expiration_date = "-";
  }

  $substring = substr($card_number, -4);   
  $fullAddress = $address . ", " . $city . ", " . $state . " ,USA";
  // $addressString = settype($fullAddress, 'string');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Track Order</title>
	<script   src="https://code.jquery.com/jquery-3.3.1.min.js"   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.css">
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">


	<style>

	body {
      min-height: 700px;
      padding: 0.5em 0em;
      background: #F5EAD1 url('images/web-graphics/leaf-watermark.png');
      background-size: 600px;
      background-repeat: no-repeat;
      background-position: left bottom;
      left: -2em;
      bottom: -2em;
    }
    #tracking .container {
      margin-bottom: 2em;
    }
    #tracking .container .header span {
      font-family: 'Pacifico', cursive;
    }
    #tracking .container .header i {
      padding: 0 0.5em;
    }
    #tracking .container .right .button {
      margin: 0 1em !important;
    }
    #tracking .navbar .container .right h3 {
      margin: 0 1em !important;
    }
    #tracking .container .row h1 {
      font-size: 5em;
      margin-bottom: 0.5em;
      font-family: 'Pacifico', cursive;
    }
    #tracking .container .message {
      margin-bottom: 2em;
    }
    #tracking .container .field {
      margin-bottom: 1em;
    }
    #tracking .container .column {
      margin-bottom: 0;
    }
		#tracking .container .grid .row {
      padding: 1em 0;
    }
    #map{
		height: 600px;
		width: 100%;

	}

	</style>

</head>
<body>

	<div class="pusher">

		<!-- MASTER HEAD -->
		<section id="tracking">
		
			<!-- NAV BAR -->
			<div class="navbar">
				<div class="ui container">
					<div class="ui large secondary menu">
						<div class="header item">
							<span>something simple.</span>
							<i class="leaf icon"></i>
						</div>
						<a class="item" href="home.php">Home</a>
						<a class="item">About</a>
						<a class="item">Team</a>
						<a class="item">Contact</a>
						<div class="right item">
							<h3>Welcome, <?php echo $_SESSION['username']['username']; ?>!</h3>
							<a class="ui primary button" href="profile.php">Profile</a>
							<a class="ui negative button" href="index.php">Log Out</a>
						</div>
					</div>
				</div>
			</div>
			<div class="ui container">
				<div class="row">
					<h1>Track Order</h1>
				</div>
			</div>

			<div class="ui container">
				<h2 id = "order">Your order will arrive in <span id="timeLeft"></span> </h2>
				<div class="ui indicating progress">
					<div class="bar"></div>
					<div id = "processing" class="label">Processing</div>
				</div>
				<div class="ui grid">
					<div class="ten wide column">
						<div class="ui raised segment">
							<div id="map"></div>
						</div>
					</div>
					<div class="six wide column">
						<div class="ui raised segment">
							<div class="ui container">

								<!-- SHOPPING CART -->
								<div class="row">
									<h2>Your Order</h2>
								</div>
								<div class="ui grid">
								<?php
							        	if(isset($_SESSION["cart"]))
							          	{
							            	foreach ($_SESSION["cart"] as $product)
							            	{
									            $name = $product["item_name"];
									            $quantity = $product["quantity"];
															$item_weight = $product["item_weight"];
															$item_total_weight = $item_weight * $quantity;
															$suffix = "lbs";
															if ($item_total_weight <= 1) {
																$suffix = "lb";
															}
												
												echo "<!-- ITEMS -->
												<div class='row'>
													<div class='two wide column'>
														<span><strong>$quantity</strong></span>
													</div>
													<div class='eleven wide column left floated left aligned'>
														<span><strong>$name</strong></span>
													</div>
													<div class='three wide column right floated right aligned'>
														<span>$item_total_weight"." "."$suffix</span>
													</div>
												</div>";
											}
										}
								?>
								</div>
								
							</div>
							
							<!-- ORDER DETAILS -->
							<div class="row">
								<h2>Order Summary</h2>
							</div>
							
							<div class="ui grid">
								<!-- WEIGHT  -->
								<div class="row">
									<div class="ten wide column">
										<span>Weight</span>
									</div>
									<div class="six wide column right floated right aligned">
										<span><?php echo $weight." lbs"; ?></span>
									</div>
								</div>

								<!-- TOTAL BEFORE TAX -->
								<div class="row">
									<div class="ten wide column">
										<span>Total before tax</span>
									</div>
									<div class="six wide column right floated right aligned">
										<span><?php echo "$ ".number_format($price, 2); ?></span>
									</div>
								</div>

								<!-- ESTIMATED TAX -->
								<div class="row">
									<div class="ten wide column">
										<span>Estimated tax</span>
									</div>
									<div class="six wide column right floated right aligned">
										<span><?php echo "$ ".number_format($tax, 2); ?></span>
									</div>
								</div>

								<!-- ORDER TOTAL -->
								<div class="row">
									<div class="ten wide column">
										<span><h3>Order Total:</h3></span>
									</div>
									<div class="six wide column right floated right aligned">
										<span><h3><?php echo "$ ".number_format($orderTot, 2); ?></h3></span>
									</div>
								</div>

								<!-- HOME BUTTON -->
								<div class="row">
									<div class="sixteen wide column">
										<a href="home.php">
											<button class="ui fluid blue button"><i class="home icon"></i> Home</button>
										</a>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				
				
			</div>

		</section>
	</div>

	

	
	<script>
        var SanJose = {lat: 37.34411, lng: -121.88155};
        var SanMateo = {lat: 37.562992, lng: -122.325523};
        var markersArray = [];
        var start;
        //var autoDriveSteps = new Array();
    var speedFactor = 10;
        var map;
    var movingMarker;
        function init(){
            initMap();
            calculateRoute();
        }
        function initMap() {
            directionsDisplay = new google.maps.DirectionsRenderer();
            directionsService = new google.maps.DirectionsService();
            service = new google.maps.DistanceMatrixService;
            geocoder = new google.maps.Geocoder();
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: SanJose
            });
            directionsDisplay.setMap(map);
        }  
        function calculateRoute(){
            var count = 0;
            var distanceFromSJ;
            var distanceFromSM;
            var autoDriveSteps = new Array();
            var points;
            var durationSJ;
            var durationSM;
            var duration;

            var origin1 = {lat: 37.335168, lng: -121.887195}//San jose
            var origin2 = {lat: 37.563931, lng: -122.325181}// San Mateo
            var destination1 = <?php echo " ' " . $fullAddress . " ' " ?>;
            var destination2 = <?php echo " ' " . $fullAddress . " ' " ?>;
            console.log(destination1);
            service.getDistanceMatrix({
                origins: [origin1,origin2],
                destinations: [destination1, destination2],
                travelMode: 'DRIVING',
                unitSystem: google.maps.UnitSystem.METRIC,
                avoidHighways: false,
                avoidTolls: false
            }, function(response, status) {
                if (status !== 'OK') {
                    alert('Error was: ' + status);
                } else {
                    var originList = response.originAddresses;
                    var destinationList = response.destinationAddresses;
                    deleteMarkers(markersArray);
                    var showGeocodedAddressOnMap = function(asDestination) {
                    return function(results, status) {
                        if (status === 'OK') {
                        } else {
                            alert('Geocode was not successful due to: ' + status);
                        }
                    };
                    };
                for (var i = 0; i < originList.length; i++) {
                    var results = response.rows[i].elements;
                    geocoder.geocode({'address': originList[i]},
                    showGeocodedAddressOnMap(false));
                    for (var j = 0; j < results.length; j++) {
                        geocoder.geocode({'address': destinationList[j]},
                        showGeocodedAddressOnMap(true));
                        if(count === 0 ){
                            distanceFromSJ = results[j].duration.value;
                            durationSJ = results[j].duration.value;
                        }
                        else if(count === 1){
                            distanceFromSM = results[j].duration.value;
                            durationSM = results[j].duration.value;
                        }
                    }
                    count++
                }
                if(distanceFromSJ < distanceFromSM){
                    var request = {
                        origin: origin1,
                        destination: destination1,
                        travelMode: 'DRIVING',
                        drivingOptions:{
                            departureTime: new Date(Date.now())
                        }
                    }
            duration = durationSJ;
                    start = origin1;
                }   
                else{
                    var request = {
                        origin: origin2,
                        destination: destination1,
                        travelMode: 'DRIVING',
                        drivingOptions:{
                            departureTime: new Date(Date.now())
                        }
                    }
                    start = origin2;
                    duration = durationSM;
                }
                directionsService.route(request, function(result, status){
                    if(status == "OK"){
                       directionsDisplay.setDirections(result);
                        var image = "https://cdn2.iconfinder.com/data/icons/love-nature/600/green-Leaves-nature-leaf-tree-garden-environnement-512.png";
                        var movingMarker = new google.maps.Marker({
                          map: map,
                          position: start,
                          icon:{
                          url: image,
                          size: new google.maps.Size(40, 40),
                          scaledSize: new google.maps.Size(40, 40)
                        }
                       });
                    }
                    else{
                        window.alert("Directions request failed due to " + status);
                    }
              
              //Calculate remaining time
              var hoursLeft = Math.trunc(duration / 3600);
              var minutesLeft = Math.trunc((duration - (hoursLeft * 3600)) / 60) ;
              var secondsLeft = hoursLeft * 3600 + minutesLeft * 60;
              console.log("hoursleft: "+ hoursLeft);
              console.log("minutesleft: " + minutesLeft);
              if(hoursLeft === 0){
                var text = document.getElementById("timeLeft");
                text.innerHTML = minutesLeft.toString() + " minutes";
                var timer = setInterval(function(){
                  if(minutesLeft === 1){
                    clearInterval(timer);
                    var orderText = document.getElementById('order');
                    orderText.innerHTML = "Your order has arrived!";
                    var processingText = document.getElementById("processing");
                    processingText.innerHTML = "Completed";
                    unset($_SESSION["cart"]);
                    $_SESSION["hasOrder"] = "false";
                    $('.progress').progress({
                      percent: 100 
                    });
                  }
                  else{
                    --minutesLeft;
                    text.innerHTML = minutesLeft.toString() + " minutes";
                  }
                }, 60000);
              }
              else{
                document.getElementById("timeLeft").innerHTML = hoursLeft.toString() + " hours and "+ minutesLeft.toString() + " minutes";
                seconds = hoursLeft * 60 * minutesLeft * 60;
              }

              var interval  = secondsLeft / result.routes[0].overview_path.length * 1000;
              movingMarker.setMap(map);
              //Starts the Route animation here
              startRouteAnimation(movingMarker,result.routes[0].overview_path, interval);

              // var processTime = 5;
              // var deliveryTime = 20;
              // var totalTime = processTime + deliveryTime;
              // var percentDone = (totalTime - timeLeft / totalTime) * 100;
              


             });//close of directionService braces
            }
        });
        
        }

        //Helper method to erase previous markers on map
        function deleteMarkers(markersArray) {
            for (var i = 0; i < markersArray.length; i++) {
                markersArray[i].setMap(null);
            }
            markersArray = [];
        }
    function getPointBetween(a, b, ratio) {
        return new google.maps.LatLng(a.lat() + (b.lat() - a.lat()) * ratio, a.lng() + (b.lng() - a.lng()) * ratio);
        }
        //Start animation google maps
    function startRouteAnimation(marker,list,interval){
         var percent = 0;
         var add = (1 / (list.length -1))*100; 
         console.log("list length is "+ list.length);
         var autoDriveTimer = setInterval(function(){
        //stop the timer if the route is finished
        if(list.length === 0){
                clearInterval(autoDriveTimer);
                $('.progress').progress({
                 percent: 100 
              });
        } else {
         //move marker to the next position (always the first in the array)
         marker.setPosition(list[0]);
          //remove the processed position
          list.shift();
          console.log(list.length);
          $('.progress').progress({
                 percent: percent 
              });
          console.log(percent);
          percent = percent + add;
        }
      }, interval);
    }
    </script>


	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZU_P11ldjxwdBWYQSX6Gzj-5aeoEUAUo&libraries=places&callback=init"

        async defer></script>



</body>
</html>