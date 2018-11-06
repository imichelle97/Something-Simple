<!DOCTYPE html>
<html>
<head>

  <!-- Site Properties -->
  <title>Something Simple</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.css">
  <link href="https://fonts.googleapis.com/css?family=Permanent+Marker|Pacifico" rel="stylesheet">

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

    #complete .container h1 {
      font-size: 5em;
      margin-top: 2em;
      margin-bottom: 0em;
      font-family: 'Pacifico', cursive;
    }

		#complete .header {
			margin-top: 20%;
		}

		#complete .header h1 {
			font-family: 'Permanent Marker', cursive;
			font-size: 5em;
		}

		#complete .buttons {
			margin: 3em;
		}

		#complete .buttons .button {
			margin: 0 2em;
		}

		#complete .container .logo {
			margin: 2em 0;
			font-family: 'Pacifico', cursive;
			font-size: 1.5em;
		}


  </style>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.js"></script>

</head>
<body>

  
  <div class="pusher">

    <section id="complete">
			<div class="ui center aligned container">
				<div class="header">
					<h1>Thank you for your purchase!</h1>
				</div>
				<div class="ui raised segment container buttons">
					<h3>
						Hi, Michelle! Thank you from purchasing from our organic food store. Your order has been placed and will be arriving soon.
					</h3>
					<a href="home.php">
						<div class="ui large blue button">
							<i class="home icon"></i>
							<span class="text">Go home</span>
						</div>
					</a>
					<a href="pantry.php">
						<div class="ui large gray button">
							<i class="cart icon"></i>
							<span class="text">Continue shopping</span>
						</div>
					</a>
					<a href="tracking.php">
						<div class="ui large green button">
							<i class="thumbtack icon"></i>
							<span class="text">Track order</span>
						</div>
					</a>
					<div class="logo">
						<span>something simple.</span>
						<i class="leaf icon"></i>
					</div>
				</div>
			</div>
    </section>

  </div>


</body>

</html>


