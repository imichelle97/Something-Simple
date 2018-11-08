<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>

  <!-- Site Properties -->
  <title>Create Profile</title>

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
        Create Your Profile
      </div>
    </h2>
    
    <form method="post" actions="profile.php">

      <?php include('errors.php'); ?>

      <form class="ui large form">

        <div class="ui stacked segment">

          <div class="field">
            <div class="ui left icon input">
              <i class="user icon"></i>
              <input type="text" name="first_name" placeholder="First Name" value="<?php echo $first_name; ?>">
            </div>
          </div>

          <div class="field">
            <div class="ui left icon input">
              <i class="user icon"></i>
              <input type="text" name="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>">
            </div>
          </div>

          <div class="field">
            <div class="ui left icon input">
              <i class="user icon"></i>
              <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>">
            </div>
          </div>

          <div class="field">
            <div class="ui left icon input">
              <i class="user icon"></i>
              <input type="text" name="phone_number" placeholder="Phone Number" value="<?php echo $phone_number; ?>">
            </div>
          </div>

          <div class="field">
            <div class="ui left icon input">
              <i class="lock icon"></i>
              <input type="text" name="address" placeholder="Address" value="<?php echo $address; ?>">
            </div>
          </div>
          
          <div class="field">
            <div class="ui left icon input">
              <i class="envelope icon"></i>
              <input type="text" name="city" placeholder="City" value="<?php echo $city; ?>">
            </div>
          </div>
          
          <div class="field">
            <div class="ui left icon input">
              <i class="lock icon"></i>
              <input type="text" name="state" placeholder="State" value="<?php echo $state; ?>">
            </div>
          </div>

          <div class="field">
            <div class="ui left icon input">
              <i class="lock icon"></i>
              <input type="text" name="zipcode" placeholder="Zipcode" value="<?php echo $zipcode; ?>">
            </div>
          </div>

          <div class="field">
            <div class="ui left icon input">
              <i class="lock icon"></i>
              <input type="text" name="card_type" placeholder="Card Type" value="<?php echo $card_type; ?>">
            </div>
          </div>

          <div class="field">
            <div class="ui left icon input">
              <i class="lock icon"></i>
              <input type="text" name="card_number" placeholder="Card Number" value="<?php echo $card_number; ?>">
            </div>
          </div>
          
          <div class="field">
            <button type="submit" class="ui large fluid green submit button" name="create_profile">Create</button>
          </div>
          <!-- <div class="ui fluid large green submit button" name="reg_user">Sign up</div> -->

        </div>

      </form>

      <!-- <div class="ui message">
        Have an account already? <a href="signin.php">Log in here.</a>
      </div> -->
      
      <a href="home.php">    
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

