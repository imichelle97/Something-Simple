<?php 
  include('server.php');
  // session_start(); 
  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }

  // echo "session user now: " . $_SESSION['username']['username'];
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
            <a class="item">About</a>
            <a class="item">Team</a>
            <a class="item">Contact</a>
            <div class="right item">
              <h3>Welcome, <?php echo $_SESSION['username']['username']; ?>!</h3>
              <!-- <a class="ui primary button" href="profile.php">Profile</a> -->
              <a class="ui negative button" href="index.php">Log Out</a>
            </div>
          </div>
        </div>
      </div>


      <div class="ui container">
        <div class="row">
          <h1>Create Your Profile</h1>
        </div>
      </div>

      
      <form method="post" actions="createProfile.php" class="ui form">
      <?php include('errors.php'); ?>
      <div class="ui raised segment container">
        <div class="ui grid">
          <div class="ui sixteen wide column">
            <div class="ui info message">
              Personal Information.
            </div>
            <div class="ui container">
              <!-- <form class="ui form" method="post" actions="createProfile.php"> -->
                <!-- CARDHOLDER'S ADDRESS -->
                    <div class="ui grid">
                      <div class="ui four wide column field">
                        <label>First Name</label>
                        <input type="text" name="first_name" value="<?php echo $first_name; ?>">
                      </div>

                      <div class="ui four wide column field">
                        <label>Last Name</label>
                        <input type="text" name="last_name" value="<?php echo $last_name; ?>">
                      </div>

                      <div class="ui four wide column field">
                        <label>Username</label>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                      </div>

                      <div class="ui four wide column field">
                        <label>Phone Number</label>
                        <input type="text" name="phone_number" value="<?php echo $phone_number; ?>">
                      </div>
                  </div>
              <!-- </form> -->
            </div>

          <div class="ui sixteen wide column">
            <div class="ui info message">
              Shipping Information.
            </div>
            <div class="ui container">
              <!-- <form class="ui form" method="post" actions="createProfile.php"> -->
                <!-- CARDHOLDER'S ADDRESS -->
                    <div class="field">
                      <label>Address</label>
                      <input type="text" name="address" id="autocomplete" onFocus="geolocate()" value="<?php echo $address; ?>">
                    </div>

                    <div class="ui grid">
                      <div class="ui nine wide column field">
                        <label>City</label>
                        <input type="text" name="city" value="<?php echo $city; ?>">
                      </div>

                      <div class="ui three wide column field">
                        <label>State</label>
                        <input type="text" name="state" value="<?php echo $state; ?>">
                      </div>

                      <div class="ui four wide column field">
                        <label>Zip Code</label>
                        <input type="text" name="zipcode" value="<?php echo $zipcode; ?>">
                      </div>
                  </div>
              <!-- </form> -->
            </div>
          </div>

          <div class="ui sixteen wide column">
            <div class="ui info message">
              Payment Information.
            </div>
            <div class="ui container">
              <!-- <form class="ui form" method="post" actions="createProfile.php"> -->
                <!-- CARDHOLDER'S ADDRESS -->
                    <div class="ui grid">
                      <div class="ui four wide column field">
                        <label>Card Number</label>
                        <input type="text" name="card_number" value="<?php echo $card_number; ?>">
                      </div>

                      <div class="ui four wide column field">
                        <label>Card Type</label>
                        <input type="text" name="card_type" value="<?php echo $card_type; ?>">
                      </div>

                      <div class="ui four wide column field">
                        <label>CVC</label>
                        <input type="text" name="cvc" value="<?php echo $cvc; ?>">
                      </div>

                      <div class="ui four wide column field">
                        <label>Expiration Date</label>
                        <input type="date" name="expiration_date" value="<?php echo $expiration_date; ?>">
                      </div>
                  </div>
              <!-- </form> -->
            </div>

          <div class="ui center aligned container">
            <!-- <a href="profile.php"> -->
              <!-- <button class="ui big green button">Save Profile</button> -->
              <button type="submit" class="ui big green submit button" name="create_profile">Save Profile</button>
            <!-- </a> -->
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
         /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
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