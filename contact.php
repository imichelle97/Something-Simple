<?php 
  // session_start();
  include('server.php');
  
    if (!isAdmin()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../login.php');
    }
    
    $query = "SELECT * FROM admin_contact;";
    $results = mysqli_query($db, $query);
    if(mysqli_num_rows($results) == 1) {
      $contact = mysqli_fetch_assoc($results);
          $name = $contact['name'];
          $message = $contact['message'];
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
          <a class="item">Admin</a>
          <a href="contact.php" class="active item">Contact</a>
          <div class="right item">
            <h3>Welcome, <?php echo $_SESSION['username']['username']; ?>!</h3>
            <a class="ui negative button" href="index.php">Log Out</a>
          </div>
        </div>

        <div class="ui raised segment container">
          <div class="ui grid">
            <?php
              echo "<table class='ui striped table'>
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Message</th>
                </tr>
              </thead>";

              while($row = mysqli_fetch_array($results)) {
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['message'] . "</td>";
                echo "</tr>";
              }
              echo "</table>";
            ?>
          </div>
        </div>

     
      
    </section>

  </div>


</body>

</html>


