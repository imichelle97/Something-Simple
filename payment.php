<?php 
  include('server.php');
  // session_start(); 
  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  if(!isset($_SESSION['checkout']))
  {
    $_SESSION['msg'] = "You must add items to your cart first";
    header('location: pantry.php');
  }
  if(!isset($_SESSION['proceed']))
  {
    $_SESSION['msg'] = "You must fill in your shipping information first";
    header('location: shipping.php');
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
    $firstName = "";
    $lastName = "";
		$address = "";
		$city = "";
		$state = "";
    $zipcode = "";
    $card_type = "";
		$card_number = "";
		$cvc = "";
		$expiration_date = "";
  }
    //UPDATE SHIPPING
  if (isset($_POST['payment_update'])) 
  {
    $result = mysqli_query($db, "SELECT * FROM customer_profile WHERE username='$username' AND card_number = NULL");
    $card_number = $_POST['card_number'];
    $card_type = $_POST['card_type'];
    $cvc = $_POST['cvc'];
    $expiration_date = $_POST['expiration_date'];

    if (mysqli_num_rows($result) == 0)
    {
      // Fetch input values from create profile form
      $query = "UPDATE customer_profile SET card_type='$card_type', card_number='$card_number', cvc='$cvc', expiration_date='$expiration_date' WHERE username='$username';";
    }
    else
    {
      $query = "INSERT INTO customer_profile (customer_id, first_name, last_name, username, phone_number, address, city, state, zipcode) 
            VALUES(NULL, '$first_name', '$last_name', '$username', '$phone_number', '$address', '$city', '$state', '$zipcode');";
    }
    mysqli_query($db, $query);
  }

  if(!empty($_GET["action"])) 
  {
    switch($_GET["action"]) 
    {

      case "confirm":
        $_SESSION["confirm"] = "true";
        header('location: confirmation.php');
        break;

      case "pantry":
        unset($_SESSION["checkout"]);
        unset($_SESSION["proceed"]);
        header('location: pantry.php');
        break;

      case "shipping":
        unset($_SESSION["checkout"]);
        header('location: shipping.php');
        break;

      case "home":
        unset($_SESSION["complete"]);
        unset($_SESSION["checkout"]);
        unset($_SESSION["proceed"]);
        unset($_SESSION["confirm"]);
        header('location: home.php');
        break;

      case "about":
        unset($_SESSION["complete"]);
        unset($_SESSION["checkout"]);
        unset($_SESSION["proceed"]);
        unset($_SESSION["confirm"]);
        header('location: home.php#about');
        break;

      case "team":
        unset($_SESSION["complete"]);
        unset($_SESSION["checkout"]);
        unset($_SESSION["proceed"]);
        unset($_SESSION["confirm"]);
        header('location: home.php#about');
        break;  

      case "contact":
        unset($_SESSION["complete"]);
        unset($_SESSION["checkout"]);
        unset($_SESSION["proceed"]);
        unset($_SESSION["confirm"]);
        header('location: home.php#contact');
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
            <a class="item" href="payment.php?action=home">Home</a>
            <a href="payment.php?action=about" class="item">About</a>
            <a href="payment.php?action=team" class="item">Team</a>
            <a href="payment.php?action=contact" class="item">Contact</a>
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
            
            <a href="payment.php?action=pantry" class="completed link step">
              <i class="cart icon"></i>
              <div class="content">
                <div class="title">Pantry</div>
                <div class="description">Choose items to order</div>
              </div>
            </a>
            <a href="payment.php?action=shipping" class="completed link step">
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

              <form method="post" actions="payment.php" class="ui form">
              
                <!-- CARDHOLDER'S NAME -->
                <div class="field">
                  <label>Cardholder's Name</label>
                  <input type="text" value="<?php echo $firstName . " " . $lastName?>">
                </div>

                <!-- CARD INFORMATION -->
                <div class="ui grid">
                  <div class="ui six wide column field">
                    <label>Card Number</label>
                    <input type="number" name="card_number" id="cardNumber" value="<?php echo $card_number; ?>">
                  </div>

                  <div class="ui five wide column field">
                    <label>Card Type</label>
                    <input type="text" name="card_type" id="cardType" value="<?php echo $card_type; ?>">
                  </div>

                  <div class="ui two wide column field">
                    <label>CVC</label>
                    <input type="text" name="cvc" id="cvc" value="<?php echo $cvc; ?>" maxlength="3">
                  </div>

                  <div class="ui six wide column field">
                        <label>Expiration Date</label>
                        <input type="month" name="expiration_date" value="<?php echo $expiration_date; ?>" id="cardDate" min="<?php echo date('Y-m'); ?>" required>
                  </div>

                  <div class="ui left aligned container">
                        <button type="submit" onmouseover="creditcardValidation()" class="ui big green submit button" name="payment_update">Save</button>
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
                	<?php 
                	if($card_number == "")
                	{
                		echo "<button class='ui disabled fluid green button'>Confirm</button>";
                	}
                	else
                	{
	                  echo "<a href='payment.php?action=confirm'>
	                    <button class='ui fluid green button' id='confirm_button'>Confirm</button>
	                  </a>";
              		}
                  ?>
                </div>
                 <script>
                  //credit card validation function
                    function creditcardValidation(cardNumber = document.getElementById("cardNumber").value, cardType = document.getElementById("cardType").value){
                        var cards = new Array();
                        cards [0] = {
                          type: "VISA",
                          length: "13, 16",
                          prefices: "4",
                          checkDigit: true
                        };
                        cards [1] = {
                          type: "Mastercard",
                          length: "16",
                          prefices: "51,52,53,54,55",
                          checkDigit: true
                        };
                        cards [2] = {
                          type: "Discover",
                          length: "16",
                          prefices: "6011, 622, 64, 65",
                          checkDigit: true
                        };
                        cards [3] = {
                          type: "American Express",
                          length: "15",
                          prefices: "34, 37",
                          checkDigit: true
                        };
                        //Make sure about Card Type
                        var cardTypeNumber = -1;
                        var cardType = document.getElementById("cardType").value;
                        var cardnumber = document.getElementById("cardNumber").value;
                        for (var i=0; i<cards.length; i++) {
                          // See if it is this card (ignoring the case of the string)
                          if (cardType.toLowerCase () == cards[i].type.toLowerCase()) {
                            cardTypeNumber = i;
                            // console.log(cards[i].type.toLowerCase()); //for testing
                            break;
                          }
                        }
                        // console.log(cardnumber); //for testing
                        
                        // If card type not found, report an error
                        if (cardTypeNumber == -1) {
                           alert("Unknown card type");
                           return false; 
                        }
                         
                        // Ensure that the user has provided a credit card number
                        if (cardnumber == "-" || cardnumber.length == 0)  {
                           alert("No card number provided");
                           return false; 
                        }
                          
                        // Now remove any spaces from the credit card number
                        cardnumber = cardnumber.replace (/\s/g, "");
                        
                        // Check that the number is numeric
                        var cardNo = cardnumber
                        var cardexp = /^[0-9]{13,19}$/;
                        if (!cardexp.exec(cardNo))  {
                           alert("Credit card number is in invalid format");
                           return false; 
                        }
                             
                        // Now check the modulus 10 check digit - if required
                        if (cards[cardTypeNumber].checkdigit) {
                          var checksum = 0;                                  // running checksum total
                          var mychar = "";                                   // next char to process
                          var j = 1;                                         // takes value of 1 or 2
                        
                          // Process each digit one by one starting at the right
                          var calc;
                          for (i = cardNo.length - 1; i >= 0; i--) {
                          
                            // Extract the next digit and multiply by 1 or 2 on alternative digits.
                            calc = Number(cardNo.charAt(i)) * j;
                          
                            // If the result is in two digits add 1 to the checksum total
                            if (calc > 9) {
                              checksum = checksum + 1;
                              calc = calc - 10;
                            }
                          
                            // Add the units element to the checksum total
                            checksum = checksum + calc;
                          
                            // Switch the value of j
                            if (j ==1) {j = 2} else {j = 1};
                          } 
                        
                          // All done - if checksum is divisible by 10, it is a valid modulus 10.
                          // If not, report an error.
                          if (checksum % 10 != 0)  {
                            alert("Credit card number is invalid");
                            return false; 
                          }
                        }  
                        // The following are the card-specific checks we undertake.
                        var LengthValid = false;
                        var PrefixValid = false; 
                        var undefined; 
                        // We use these for holding the valid lengths and prefixes of a card type
                        var prefix = new Array ();
                        var lengths = new Array ();
                          
                        // Load an array with the valid prefixes for this card
                        prefix = cards[cardTypeNumber].prefices.split(",");
                        
                            
                        // Now see if any of them match what we have in the card number
                        for (i=0; i<prefix.length; i++) {
                          var exp = new RegExp ("^" + prefix[i]);
                          if (exp.test (cardNo)) PrefixValid = true;
                        }
                            
                        // If it isn't a valid prefix there's no point at looking at the length
                        if (!PrefixValid) {
                            alert("Credit card number is invalid");
                            return false; 
                        }
                          
                        // See if the length is valid for this card
                        lengths = cards[cardTypeNumber].length.split(",");
                        for (j=0; j<lengths.length; j++) {
                          if (cardNo.length == lengths[j]) LengthValid = true;
                        }
                        
                        // See if all is OK by seeing if the length was valid. We only check the length if all else was 
                        // hunky dory.
                        if (!LengthValid) {
                           alert("Credit card number has an inappropriate number of digits");
                           return false; 
                        };   
                        // See if the expiration date has passed
                        // var now = new Date();
                        // if (document.getElementById("cardDate").value < now){
                        //   alert("Credit catd date is out of date");
                        //   return false;
                        // }

                        //Check if CVC isDigit
                        if (isNaN(document.getElementById("cvc").value)){
                          alert("CVC is invalid");
                          return false;
                        }
                        
                        // The credit card is in the required format.
                        return true;
                    }
                </script>
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
