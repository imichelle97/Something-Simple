<?php 
  include('server.php');
	
	// if (!isset($_SESSION['username'])) {
	// 	$_SESSION['msg'] = "You must log in first";
	// 	header('location: login.php');
  // }
  
  if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

?>

<!DOCTYPE html>
<html>
<head>

  <!-- Site Properties -->
  <title>Something Simple</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.css">
  <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">

  <style type="text/css">

    .masthead {
      min-height: 700px;
      padding: 0.5em 0em;
      background: #F5EAD1 url('images/web-graphics/leaf-watermark.png');
      background-size: 600px;
      background-repeat: no-repeat;
      background-position: left bottom;
      left: -2em;
      bottom: -2em;
    }

    .masthead .container .header span {
      font-family: 'Pacifico', cursive;
    }

    .masthead .container .header i {
      padding: 0 0.5em;
    }

    .masthead .container .right .button {
      margin: 0 1em !important; 
    }

    .masthead .container .right h3 {
      margin: 0 1em !important;
    }

    .masthead .container h1 {
      font-size: 5em;
      margin-top: 2em;
      margin-bottom: 0em;
      font-family: 'Pacifico', cursive;
    }

    .masthead .container .eight .button {
      margin-top: 1.5em;
      margin-right: 1.5em;
    }


  </style>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.js"></script>

</head>
<body>

  
  <div class="pusher">

    <!-- MASTER HEAD -->
    <section class="masthead">
      
      <!-- NAV BAR -->
      <div class="ui container">
        <div class="ui large secondary menu">
          <div class="header item">
            <span>something simple.</span>
            <i class="leaf icon"></i>
          </div>
          <a class="active item">Home</a>
          <a class="item">About</a>
          <a class="item">Team</a>
          <a class="item">Contact</a>
          <div class="right item">
            <h3>Welcome, <?php echo $_SESSION['username']['username']; ?>!</h3>
            <a href="pantry.php">
              <div class="ui vertical animated green button" tabindex="0">
                <div class="hidden content">Shop</div>
                <div class="visible content">
                  <i class="shop icon"></i>
                </div>
              </div>
            </a>
            <a class="ui primary button" href="profile.php">Account</a>
            <a class="ui negative button" href="index.php">Log Out</a>
          </div>
        </div>
      </div>

      <!-- HEADER CONTENTS -->
      <div class="ui container">
        <!-- LEFT SIDE TEXTS -->
        <div class="eight wide column">
          <h1>something simple.</h1>
          <h2>We Make Bananas That Can Dance.</h2>
          <a href="pantry.php">
            <div class="ui huge olive button">Get Started <i class="right arrow icon"></i></div>
          </a>
          <div class="ui container">
            <a href="#">
              <button class="ui medium black button">Learn more</button>
            </a>
            <a href="#">
              <button class="ui medium black button">Track order</button>
            </a>
          </div>
        </div>
        <!-- RIGHT SIDE IMAGES -->
      </div>
      
    </section>

  </div>


</body>

</html>


