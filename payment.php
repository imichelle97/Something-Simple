<?php 
  include('server.php');
  // session_start(); 
  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
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
    #payment .container {
      margin-bottom: 2em;
    }
    #payment .container .header span {
      font-family: 'Pacifico', cursive;
    }
    #payment .container .header i {
      padding: 0 0.5em;
    }
    #payment .container .right .button {
      margin: 0 1em !important;
    }
    #payment .navbar .container .right h3 {
      margin: 0 1em !important;
    }
    #payment .container .row h1 {
      font-size: 5em;
      margin-bottom: 0.5em;
      font-family: 'Pacifico', cursive;
    }
    #payment .container .message {
      margin-bottom: 2em;
    }
    #payment .container .field {
      margin-bottom: 1em;
    }
    #payment .container .checkbox {
      margin: 2em 0;
    }
    #payment .container .column {
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
    <section id="payment">
      
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
          <h1>Payment</h1>
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
            <a href="shipping.php" class="completed link step">
              <i class="truck icon"></i>
              <div class="content">
                <div class="title">Shipping</div>
                <div class="description">Choose your shipping options</div>
              </div>
            </a>

            <div class="active step">
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
              Please enter your payment information.
            </div>
            <div class="ui container">

              <form class="ui form">
              
                <!-- CARDHOLDER'S NAME -->
                <div class="field">
                  <label>Cardholder's Name</label>
                  <input type="text" value="<?php echo $firstName . " " . $lastName?>">
                </div>

                <!-- CARD INFORMATION -->
                <div class="ui grid">
                  <div class="ui six wide column field">
                    <label>Card Number</label>
                    <input type="text" name="card_number" value="<?php echo $card_number; ?>">
                  </div>

                  <div class="ui five wide column field">
                    <label>Card Type</label>
                    <input type="text" name="card_type" value="<?php echo $card_type; ?>">
                  </div>

                  <div class="ui two wide column field">
                    <label>CVC</label>
                    <input type="text" name="cvc" value="<?php echo $cvc; ?>">
                  </div>

                  <div class="ui six wide column field">
                        <label>Expiration Date</label>
                        <input type="month" name="expiration_date" value="<?php echo $expiration_date; ?>">
                  </div>

                </div>

                <div class="ui checkbox">
                  <input id="billingAdd" type="checkbox" name="example">
                  <label>Billing  address is the same as shipping address</label>
                </div>

                <!-- CARDHOLDER'S ADDRESS -->
                <div id="address">
                  <div class="field">
                    <label>Cardholder's Address</label>
                    <input type="text">
                  </div>
                  <div class="ui grid">
                    <div class="ui nine wide column field">
                      <label>City</label>
                      <input type="text">
                    </div>
                    <div class="ui three wide column field">
                      <label>State</label>
                      <input type="text">
                    </div>
                    <div class="ui four wide column field">
                      <label>Zip Code</label>
                      <input type="text">
                    </div>
                  </div>
                </div>

              </form>
              
            </div>
          </div>
          <div class="ui six wide column">
            <h1>Shipping to:</h1>
            <div class="ui grid">

              <!-- SHIPPING NAME AND ADDRESS -->
              <div class="row">
                <div class="ten wide column">
                  <p>
                  <?php echo $firstName . " " . $lastName?> <br>
                  <?php echo $address ?> <br>
                  <?php echo $city . ', ' . $state ?> <br>
                  <?php echo $zipcode ?>
                  </p>
                </div>
              </div>

              <!-- BUTTON -->
              <div class="row">
                <div class="sixteen wide column">
                  <a href="confirmation.php">
                    <button class="ui fluid green button">Confirm</button>
                  </a>
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
  $(document).ready(function() {
    $('#billingAdd').change(function() {
        $('#address').toggle();
    });
  });
  </script>

</body>
</html>
