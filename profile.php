<?php 
  include('server.php'); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
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

?>
<!DOCTYPE html>
<html>
<head>

  <!-- Site Properties -->
  <title>Your Profile</title>

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
    body > .grid {
      height: 100%;
    }
    .input {
      width: 100%;
    }
    h1 {
      font-size: 5em !important;
      margin-bottom: 0.5em !important;
      font-family: 'Pacifico', cursive  !important;
    }
    .button {
			margin: 0 1em !important;
		}
    #account {
      margin-top: 0.5em !important;
      padding-top: 0.5em !important;
    }
  </style>
</head>
<body>

<div class="ui middle aligned center aligned grid container">
  <div class="column">
    <h1 class="ui left aligned header">
      Profile
    </h1>

    <div class="ui grid container">
      <div class="four wide column">
        <div class="ui green vertical menu">
        <a id="accountSection" class="item active">
          <h4 class="ui header">Account</h4>
          <p>Includes your name, username, and password</p>
        </a>
        <a id="shippingSection" class="item">
          <h4 class="ui header">Shipping</h4>
          <p>Add or remove shipping addresses</p>
        </a>
        <a id="paymentSection" class="item">
          <h4 class="ui header">Payment</h4>
          <p>Add or remove payment information</p>
        </a>
        </div>
      </div>
      <div class="twelve wide stretched column">
        <div class="ui segment">

          <!-- RENDER WHEN ACCOUNT IS ACTIVE -->
          <div id="account" class="ui grid">
            <div class="row">
              <div class="sixteen wide left aligned column">
                <h2><strong>Account Details</strong></h2>
              </div>
            </div>
            <div class="row">
              <div class="six wide left aligned column">
                <h3><strong>Name</strong></h3>
              </div>
              <div class="ten wide right aligned column">
                <p><?php echo $firstName . " " . $lastName ?></p>
              </div>
            </div>
          
            <div class="row">
              <div class="six wide left aligned column">
                <h3><strong>Username</strong></h3>
              </div>
              <div class="ten wide right aligned column">
                <p><?php echo $_SESSION['username']['username']; ?></p>
              </div>
            </div>

            <div class="row">
              <div class="six wide left aligned column">
                <h3><strong>Password</strong></h3>
              </div>
              <div class="ten wide right aligned column">
                <p>•••••••</p>
              </div>
            </div>
          </div>

          <!-- RENDER WHEN SHIPPING IS ACTIVE -->
          <div id="shipping" class="ui grid">
            <div class="row">
              <div class="sixteen wide left aligned column">
                <h2><strong>Shipping Addresses</strong></h2>
              </div>
            </div>
            
            <div class="row">
              <div class="six wide left aligned column">
                <h3><strong>Primary Shipping</strong></h3>
              </div>
              <div class="ten wide right aligned column">
                <p> <?php echo $address ?> <br>
                  <?php echo $city . ', ' . $state ?> <br>
                  <?php echo $zipcode ?>
                </p>
              </div>
            </div>
          </div>

          <!-- RENDER WHEN PAYMENT IS ACTIVE -->
          <div id="payment" class="ui grid">
            <div class="row">
              <div class="sixteen wide left aligned column">
                <h2><strong>Payment Information</strong></h2>
              </div>
            </div>
            
            <div class="row">
              <div class="six wide left aligned column">
                <h3><strong>Primary Payment</strong></h3>
              </div>
              <div class="ten wide right aligned column">
                <p> <?php echo $firstName . " " . $lastName ?> <br>
                  <?php echo $card_type . " ending in " . $substring ?> <br>
                  <?php echo "Expiring on " . $expiration_date ?>
                </p>
              </div>
            </div>
          </div>


        </div>

        <!-- EDIT AND HOME BUTTONS -->
        <div class="center aligned row">
          <a href="home.php">
            <button class="ui large animated fade blue button" tabindex="0">
              <div class="hidden content"><i class="home icon"></i></div>
              <div class="visible content">
                <span class="text">Go home</span>
              </div>
            </button>
          </a>
          <a href="createProfile.php">
            <button class="ui large animated fade gray button" tabindex="0">
              <div class="hidden content"><i class="edit icon"></i></div>
              <div class="visible content">
                <span class="text">Edit info</span>
              </div>
            </button>
          </a>
          <button class="ui large animated fade red button" tabindex="0">
            <div class="hidden content"><i class="trash alternate icon"></i></div>
            <div class="visible content">
              <span class="text">Delete account</span>
            </div>
          </button>
        </div>
      </div>
    </div>

  </div>

</div>

<div class="ui mini modal">
  <i class="close icon"></i>
  <div class="header">
    Delete Account
  </div>
  <div class="content">
    <div class="description">
      <p>Are you sure you want to delete your account?</p>
    </div>
  </div>
  <div class="actions">
    <div class="ui negative button">
      No
    </div>
    <div class="ui positive right labeled icon button">
      Yes
      <i class="checkmark icon"></i>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('.ui.green.menu')
        .on('click', '.item', function() {
          if(!$(this).hasClass('dropdown')) {
            $(this)
              .addClass('active')
              .siblings('.item')
              .removeClass('active');
          }
        });
  $('.red').on('click', function() {
    $('.ui.modal')
    .modal('show')
    ;
  });
  $(document).ready(function() {
    $('#account').show();
    $('#shipping').hide();
    $('#payment').hide();
  });
  $('#accountSection').on('click', function(){
    $('#account').show();
    $('#shipping').hide();
    $('#payment').hide();
  });
  $('#shippingSection').on('click', function(){
    $('#account').hide();
    $('#shipping').show();
    $('#payment').hide();
  });
  $('#paymentSection').on('click', function(){
    $('#account').hide();
    $('#shipping').hide();
    $('#payment').show();
  });
  
  </script>

</body>

</html>

