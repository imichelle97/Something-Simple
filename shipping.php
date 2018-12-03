<?php 
  // session_start(); 
  include('server.php');
  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  if(!isset($_SESSION['checkout']))
  {
    $_SESSION['msg'] = "You must add items to your cart first";
    header('location: pantry.php');
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


  // User Profile Contents
  $username = $_SESSION['username']['username'];
  $query = "SELECT * FROM customer_profile WHERE username='$username';";

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
  
  if(!empty($_GET["action"])) 
  {
    switch($_GET["action"]) 
    {
      case "proceed":
        $_SESSION["proceed"] = "true";
        header('location: payment.php');
        break;
    }
  }
?>

<!DOCTYPE html>
<html>
<head>

  <!-- Site Properties -->
  <title>Something Simple</title>
  <script   src="https://code.jquery.com/jquery-3.3.1.min.js"   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.css">
  <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">

  <style type="text/css">

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
    #shipping .container {
      margin-bottom: 2em;
    }
    #shipping .container .header span {
      font-family: 'Pacifico', cursive;
    }
    #shipping .container .header i {
      padding: 0 0.5em;
    }
    #shipping .container .right .button {
      margin: 0 1em !important;
    }
    #shipping .navbar .container .right h3 {
      margin: 0 1em !important;
    }
    #shipping .container .row h1 {
      font-size: 5em;
      margin-bottom: 0.5em;
      font-family: 'Pacifico', cursive;
    }
    #shipping .container .message {
      margin-bottom: 2em;
    }
    #shipping .container .field {
      margin-bottom: 1em;
    }
    #shipping .container .column {
      margin-bottom: 0;
    }
    /* .image {
      width: 217.5px;
      height: 217.5px;
    } */
  </style>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.js"></script>

</head>
<body>
  
  <div class="pusher">

    <!-- MASTER HEAD -->
    <section id="shipping">
      
      <!-- NAV BAR -->
      <div class="navbar">
        <div class="ui container">
          <div class="ui large secondary menu">
            <div class="header item">
              <span>something simple.</span>
              <i class="leaf icon"></i>
            </div>
            <a class="item" href="home.php">Home</a>
            <a href="home.php#about" class="item">About</a>
            <a href="home.php#about" class="item">Team</a>
            <a href="home.php#contact" class="item">Contact</a>
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
          <h1>Shipping</h1>
        </div>
        <div class="row">
          <div class="ui four small steps">
          
            <a href="pantry.php" class="completed link step">
              <i class="cart icon"></i>
              <div class="content">
                <div class="title">Pantry</div>
                <div class="description">Choose items to order</div>
              </div>
            </a>
            
            <div class="active step">
              <i class="truck icon"></i>
              <div class="content">
                <div class="title">Shipping</div>
                <div class="description">Choose your shipping options</div>
              </div>
            </div>
            <div class="disabled step">
              <i class="payment icon"></i>
              <div class="content">
                <div class="title">Billing</div>
                <div class="description">Enter billing information</div>
              </div>
            </div>
            <div class="disabled step">
              <i class="info icon"></i>
              <div class="content">
                <div class="title">Confirm Order</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="ui raised segment container">
        <div class="ui grid">
          <div class="ui ten wide column">
            <div class="ui info message">
              Please enter your shipping information.
            </div>
            <div class="ui container">

              <form method="post" actions="shipping.php" class="ui form">
                <div class="ui grid">
                  <div class="eight wide column">
                    <div class="field">
                      <label>First Name</label>
                      <input type="text" name="first_name" value=<?php echo $firstName; ?>>
                      <input type="hidden" name="username" value=<?php echo $username;?>>
                    </div>
                  </div>

                  
                  <div class="eight wide column">
                    <div class="field">
                      <label>Last Name</label>
                      <input type="text" name="last_name" value=<?php echo $lastName; ?>>
                      <input type="hidden" name="username" value=<?php echo $username;?>>
                    </div>
                  </div>
                </div>
                <!-- CARDHOLDER'S NAME -->
                

                <!-- CARDHOLDER'S ADDRESS -->
                    <div class="field">
                      <label>Address</label>
                      <input type="text" name="address" id="street_number" onFocus="geolocate()" value="<?php echo $address; ?>">
                    </div>

                    <div class="ui grid">
                      <div class="ui nine wide column field">
                        <label>City</label>
                        <input type="text" name="city" id = "locality" value="<?php echo $city; ?>">
                      </div>

                      <div class="ui three wide column field">
                        <label>State</label>
                        <input type="text" name="state" id = "administrative_area_level_1" value="<?php echo $state; ?>">
                      </div>

                      <div class="ui four wide column field">
                        <label>Zip Code</label>
                        <input type="text" name="zipcode" id="postal_code" value="<?php echo $zipcode; ?>">
                      </div>

                      <div class="ui left aligned container">
                        <button type="submit" class="ui big green submit button" name="shipping_update">Save</button>
			                </div>
                </div>

              </form>
              
            </div>
          </div>
          <div class="ui six wide column">
            <h1>Order Summary</h1>
            <div class="ui grid">

              <!-- WEIGHT  -->
              <div class="row">
                <div class="ten wide column">
                  <span>Weight:</span>
                </div>
                <div class="six wide column right floated right aligned">
                  <span><?php echo $weight." lbs"; ?></span>
                </div>
              </div>

              <!-- TOTAL BEFORE TAX -->
              <div class="row">
                <div class="ten wide column">
                  <span>Total before tax:</span>
                </div>
                <div class="six wide column right floated right aligned">
                  <span><?php echo "$ ".number_format($price, 2); ?></span>
                </div>
              </div>

              <!-- ESTIMATED TAX -->
              <div class="row">
                <div class="ten wide column">
                  <span>Estimated tax:</span>
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

              <!-- BUTTON -->
              <div class="row">
                <div class="sixteen wide column">
                  <?php
                    if(mysqli_num_rows($results) == 0 || $firstName == "-" || $lastName == "-" || $address == "-" || $city == "-" || $state == "-" || $zipcode == "-")
                    {
                      
                        echo"<button class='ui disabled fluid green button'>Proceed to payment</button>";
                    }
                    else
                    {
                      echo "<a href='shipping.php?action=proceed'>
                        <button class='ui fluid green button'>Proceed to payment</button>
                      </a>";
                    }
                    ?>
                </div>
              </div>

            </div>
          </div>
        </div>
        
      </div>

    </section>

  </div>

  <script>
  $(document)
    .ready(function() {
      $('.ui.dropdown')
        .dropdown({
          on: 'click'
        })
      ;
    })
  ;
  </script>
  <script>
    function initAutoComplete(){
    autocomplete = new google.maps.places.Autocomplete(
         /** @type {!HTMLInputElement} */(document.getElementById('street_number')),
        {types: ['geocode']});
    }
    function geolocate() {
        if (navigator.geolocation) {
           navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
      });
      }
    }
  </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZU_P11ldjxwdBWYQSX6Gzj-5aeoEUAUo&libraries=places&callback=initAutoComplete"

 async defer></script>
</body>

</html>