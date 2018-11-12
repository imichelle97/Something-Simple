<?php 
	include("server.php");
  // session_start(); 
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
		$customerID = $profile['customer_id'];
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
	
	// echo $customerID;

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
    #confirmation .container {
      margin-bottom: 2em;
    }
		#confirmation .container .raised {
			padding: 2em 2em 3em 2em;
		}
    #confirmation .container .header span {
      font-family: 'Pacifico', cursive;
    }
    #confirmation .container .header i {
      padding: 0 0.5em;
    }
    #confirmation .container .right .button {
      margin: 0 1em !important;
    }
    #confirmation .navbar .container .right h3 {
      margin: 0 1em !important;
    }
    #confirmation .container .row h1 {
      font-size: 5em;
      margin-bottom: 0.5em;
      font-family: 'Pacifico', cursive;
    }
    #confirmation .container .field {
      margin-bottom: 1em;
    }
    #confirmation .container .grid .row {
      padding: 0.5em 0;
    }
  </style>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.js"></script>

</head>
<body>
  
  <div class="pusher">

    <!-- MASTER HEAD -->
    <section id="confirmation">
      
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
          <h1>Confirmation</h1>
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
            <a href="payment.php" class="completed link step">
              <i class="payment icon"></i>
              <div class="content">
                <div class="title">Billing</div>
                <div class="description">Enter billing information</div>
              </div>
            </a>

            <div class="active step">
              <i class="info icon"></i>
              <div class="content">
                <div class="title">Confirm Order</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
			<!-- SHOPPING INFO -->
			<div class="container">
				<div class="ui raised segment container">
					<div class="ui grid">
						<div class="ui eight wide column">
							<div class="ui container">

								<!-- SHOPPING CART -->
								<h1>Shopping Cart</h1>
								<div class="ui grid">
									<?php
										if(isset($_SESSION["cart"])) {
											foreach ($_SESSION["cart"] as $product) {
												$name = $product["item_name"];
												$item_id = $product["item_id"];
												$quantity = $product["quantity"];
												$item_price = $product["item_price"];
												$item_weight = $product["item_weight"];
												$inventory = $product["inventory"];
												$item_total_weight = $item_weight * $quantity;
												$suffix = "lbs";
												if ($item_total_weight == 1) {
													$suffix = "lb";
												}

												echo "<!-- ITEMS -->
												<div class='row'>
													<div class='ten wide column'>
														<span><strong>$name</strong></span>
													</div>
													<div class='three wide column right floated right aligned'>
														<span>$quantity</span>
													</div>
													<div class='three wide column right floated right aligned'>
														<span>$item_total_weight"." "."$suffix</span>
													</div>
												</div>";
												$username = $_SESSION['username']['username'];
												$order = "INSERT INTO orders(order_id, customer_id, username, item_id, quantity) VALUES (NULL, $customerID, '$username', $item_id, $quantity);";
												mysqli_query($db, $order);
												if($quantity > $inventory)
												{
													echo "Out of stock";
												}
												else
												{
													$updatedQuan = $inventory - $quantity;
													$inventoryQuery = "UPDATE item SET inventory = '$updatedQuan' WHERE item_id = $item_id";
													mysqli_query($db,$inventoryQuery);
												}

												// echo $order;
											}
											//Destroys cart session
											unset($_SESSION["cart"]);	
										}
											
									?>


								</div>
							</div>
						</div>
						<div class="ui eight wide column">

							<!-- ORDER SUMMARY -->
							<h1>Order Summary</h1>
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
							</div>
						</div>
					</div>
				</div>

				<!-- PAYMENT AND SHIPPING INFO -->
				<div class="ui raised segment container">
					<div class="ui grid">
						<div class="ui eight wide column">
							<div class="ui container">

								<!-- SHIPPING INFO -->
								<h1>Shipping Info</h1>
								<div class="ui grid">

									<!-- SHIPPING TO  -->
									<div class="row">
										<div class="sixteen wide column">
											<h3><strong>Shipping to:</strong></h3>
										</div>
									</div>

									<div class="row">
										<div class="sixteen wide column">
											<p>
											<?php echo $firstName . " " . $lastName?> <br>
											<?php echo $address ?> <br>
											<?php echo $city . ', ' . $state ?> <br>
											<?php echo $zipcode ?>
											</p>
										</div>
									</div>

								</div>
							</div>
						</div>
						<div class="ui eight wide column">

							<!-- PAYMENT INFO -->
							<h1>Payment Info</h1>
							<div class="ui grid">

								<!-- SHIPPING TO  -->
								<div class="row">
									<div class="sixteen wide column">
										<h3><strong>Billing to:</strong></h3>
									</div>
								</div>

								<div class="row">
									<div class="sixteen wide column">
										<p>
										<?php echo $firstName . " " . $lastName ?> <br>
										<?php echo $card_type . " ending in " . $substring ?> <br>
										<?php echo "Expiring on " . $expiration_date ?>
										</p>
									</div>
								</div>

							</div>
						</div>
					</div>
					
				</div>

				<!-- BUTTONS -->
				<div class="ui center aligned container">
					<a href="complete.php">
						<button class="ui big green button">Submit order</button>
					</a>
				</div>
				<div class="ui center aligned container">
					<a href="home.php">
						<button class="ui small gray button">Cancel order</button>
					</a>
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

</body>

</html>