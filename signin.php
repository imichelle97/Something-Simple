<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>

  <!-- Site Properties -->
  <title>Login</title>

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.css">

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
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }
    .input {
      width: 100%;
    }
  </style>
</head>
<body>

<div class="ui middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui green header">
      <div class="content">
        Log-in
      </div>
    </h2>

    <form method="post" actions="signin.php">

      <?php include('errors.php'); ?>

      <form class="ui large form">
        <div class="ui stacked segment">

        <div class="field">
            <div class="ui left icon input">
              <i class="envelope icon"></i>
              <input type="text" name="username" placeholder="Username">
            </div>
          </div>

          <div class="field">
            <div class="ui left icon input">
              <i class="lock icon"></i>
              <input type="password" name="password" placeholder="Password">
            </div>
          </div>

          <div class="field">
				    <button type="submit" class="ui fluid large green submit button" name="login_user">Login</button>
			    </div>
          <!-- <div class="ui fluid large green submit button" name="login_user">Login</div> -->
        </div>

      </form>

      <div class="ui message">
        If you don't have an account yet. <a href="signup.php">Sign up here.</a>
      </div>

      <a href="index.php">
        <button class="ui fluid large primary button">
          <i class="left arrow icon "></i>
          Home
        </button>
      </a>

  </form>

  </div>
</div>

</body>

</html>
