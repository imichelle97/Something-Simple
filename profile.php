<?php include('server.php') ?>
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
    hr {
      width: 90%;
      opacity: 0.4;
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
        <a class="item active">
          <h4 class="ui header">Account</h4>
          <p>Includes your name, username, and password</p>
        </a>
        <a class="item">
          <h4 class="ui header">Shipping</h4>
          <p>Add or remove shipping addresses</p>
        </a>
        <a class="item">
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
              <div class="six wide left aligned column">
                <h3><strong>Name</strong></h3>
              </div>
              <div class="ten wide right aligned column">
                <p>Karl Adrian Lapuz</p>
              </div>
            </div>
          
            <div class="row">
              <div class="six wide left aligned column">
                <h3><strong>Username</strong></h3>
              </div>
              <div class="ten wide right aligned column">
                <p>karl</p>
              </div>
            </div>

            <div class="row">
              <div class="six wide left aligned column">
                <h3><strong>Password</strong></h3>
              </div>
              <div class="ten wide right aligned column">
                <p>*********</p>
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
                <h3><strong>Shipping #1</strong></h3>
              </div>
              <div class="ten wide right aligned column">
                <p>Address #1 <br>
                  San Jose, CA <br>
                  95111
                </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="six wide left aligned column">
                <h3><strong>Shipping #2</strong></h3>
              </div>
              <div class="ten wide right aligned column">
                <p>Address #2 <br>
                  San Jose, CA <br>
                  95111
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
                <h3><strong>Payment #1</strong></h3>
              </div>
              <div class="ten wide right aligned column">
                <p>Cardholder's Name #1 <br>
                  2132 Banana Lane <br>
                  San Jose, CA 95111
                </p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="six wide left aligned column">
                <h3><strong>Payment #2</strong></h3>
              </div>
              <div class="ten wide right aligned column">
              <p>Cardholder's Name #1 <br>
                  2132 Banana Lane <br>
                  San Jose, CA 95111
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
          <a href="home.php">
            <button class="ui large animated fade red button" tabindex="0">
              <div class="hidden content"><i class="trash alternate icon"></i></div>
              <div class="visible content">
                <span class="text">Delete account</span>
              </div>
            </button>
          </a>
        </div>
      </div>
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
  </script>

</body>

</html>

