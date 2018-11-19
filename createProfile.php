<?php 
  include('server.php');
  // session_start(); 
  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
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
    #createProf .container {
      margin-bottom: 2em;
    }
    #createProf .container .header span {
      font-family: 'Pacifico', cursive;
    }
    #createProf .container .header i {
      padding: 0 0.5em;
    }
    #createProf .container .right .button {
      margin: 0 1em !important;
    }
    #createProf .navbar .container .right h3 {
      margin: 0 1em !important;
    }
    #createProf .container .row h1 {
      font-size: 5em;
      margin-bottom: 0.5em;
      font-family: 'Pacifico', cursive;
    }
    #createProf .container .message {
      margin-bottom: 2em;
    }
    #createProf .container .field {
      margin-bottom: 1em;
    }
    #createProf .container .column {
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
    <section id="createProf">
      
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
                        <!-- <input type="text" name="username" value="<?php echo $username; ?>"> -->
                        <input type="text" name="username" value="<?php echo $_SESSION['username']['username']; ?>">
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
                        <input type="text" name="card_number" value="<?php echo $card_number; ?>" id="cardNumber">
                        <label>No spaces</label>
                      </div>

                      <div class="ui four wide column field">
                        <label>Card Type</label>
                        <input type="text" name="card_type" value="<?php echo $card_type; ?>" id="cardType">
                        <label>(Discover, Visa, Mastercard, American Express)</label>
                      </div>

                      <div class="ui four wide column field">
                        <label>CVC</label>
                        <input type="text" name="cvc" value="<?php echo $cvc; ?>">
                      </div>

                      <div class="ui four wide column field">
                        <label>Expiration Date</label>
                        <input type="month" name="expiration_date" value="<?php echo $expiration_date; ?>" id="cardDate">
                      </div>
                  </div>
              <!-- </form> -->
            </div>

          <div class="ui center aligned container">
            <a href="profile.php">
              <!-- <button class="ui big green button">Save Profile</button> -->
              <button type="submit" class="ui big green submit button" name="create_profile" onmouseover="creditcardValidation()" id="confirm_button">Save Profile</button>
            </a>
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
                        var now = new Date();
                        if (document.getElementById("cardDate").value < now){
                          alert("Credit card date is out of date");
                          return false;
                        }
                        
                        // The credit card is in the required format.
                        return true;
                    }
                </script>
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

    var componentForm = {
      locality: 'long_name',
      administrative_area_level_1: 'short_name',
      postal_code: 'short_name'
      };
    var autocomplete;


    function initAutoComplete(){
      autocomplete = new google.maps.places.Autocomplete(
      (document.getElementById('street_number')),
        {types: ['geocode']});
      autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        var place = autocomplete.getPlace();
        // Resets the text fields
        for (var component in componentForm) {
          document.getElementById(component).value = '';
        }
        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
        var address_with_number = document.getElementById("street_number").value;
        document.getElementById("street_number").value = address_with_number.substring(0,address_with_number.indexOf(','));
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