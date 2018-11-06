<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>

  <!-- Site Properties -->
  <title>Sign Up</title>

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.css">

  <style type="text/css">
    body {
      background-color: #F5EAD1;
    }
    body > .grid {
      height: 100%;
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
        Create an account
      </div>
    </h2>
    
    <form method="post" actions="signup.php">

      <?php include('errors.php'); ?>

      <form class="ui large form">

        <div class="ui stacked segment">

          <div class="field">
            <div class="ui left icon input">
              <i class="user icon"></i>
              <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
            </div>
          </div>
          
          <div class="field">
            <div class="ui left icon input">
              <i class="envelope icon"></i>
              <input type="text" name="email" placeholder="E-mail address" value="<?php echo $email; ?>">
            </div>
          </div>
          
          <div class="field">
            <div class="ui left icon input">
              <i class="lock icon"></i>
              <input type="password" name="password_1" placeholder="Password">
            </div>
          </div>
          
          <div class="field">
            <div class="ui left icon input">
              <i class="lock icon"></i>
              <input type="password" name="password_2" placeholder="Confirm Password">
            </div>
          </div>
          
          <div class="field">
				    <button type="submit" class="ui large fluid green submit button" name="reg_user">Register</button>
			    </div>
          <!-- <div class="ui fluid large green submit button" name="reg_user">Sign up</div> -->

        </div>

      </form>

      <div class="ui message">
        Have an account already? <a href="signin.php">Log in here.</a>
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

