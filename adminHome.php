<?php 
  // session_start();
  include('server.php');
	
	// if (!isset($_SESSION['username'])) {
	// 	$_SESSION['msg'] = "You must log in first";
	// 	header('location: login.php');
    // }
  $negativeError = false;
  
    if (!isAdmin()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../login.php');
	}
  function query($query)
  {
      $connect = mysqli_connect('localhost','OFS','sesame','OFS');
      if (mysqli_connect_errno()) 
      {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      $result = mysqli_query($connect, $query);
      while($row=mysqli_fetch_assoc($result))
      {
          $set[] = $row;
      }
      if (!empty($set))
      {
        return $set;
      }
  }
 if(!empty($_GET["action"])) 
  {
    switch($_GET["action"]) 
    {
      case "addOrRemove":
        if(!empty($_POST["quantity"])) 
        {
          $product = query("SELECT * FROM item WHERE item_id='" . $_GET["item_id"] . "'");
          $itemArray = 
            array
            (
              $product[0]["item_id"]=>
                array
                (
                  'item_name'=>$product[0]["item_name"], 
                  'item_id'=>$product[0]["item_id"], 
                  'inventory'=>$product[0]["inventory"],
                  'item_price'=>$product[0]["item_price"], 
                )
            );
          
          if(!empty($_SESSION["inven"])) 
          {
            $id = $product[0]["item_id"];
            $updatedQ = 0;
            if(in_array($product[0]["item_id"],array_keys($_SESSION["inven"]))) 
            {
              foreach($_SESSION["inven"] as $a => $b) 
              {
                if($product[0]["item_id"] == $a) 
                {
                  if(empty($_SESSION["inven"][$a]["inventory"])) 
                  {
                    $_SESSION["inven"][$a]["inventory"] = 0;
                  }
                  if(isset($_POST["add"]))
                  {
                    $_SESSION["inven"][$a]["inventory"] += $_POST["quantity"];
                    $updatedQ = $product[0]["inventory"] + $_POST["quantity"];
                  }
                  else if (isset($_POST["remove"]))
                  {
                    if($_SESSION["inven"][$a]["inventory"] < $_POST["quantity"])
                    {
                      $negativeError = true;
                      $updatedQ = $_SESSION["inven"][$a]["inventory"];
                    }
                    else
                    {
                      $_SESSION["inven"][$a]["inventory"] -= $_POST["quantity"];
                      $updatedQ = $product[0]["inventory"] - $_POST["quantity"];
                    }
                  }
                }
              }
            } 
            else 
            {
              $_SESSION["inven"] = $_SESSION["inven"] + $itemArray; 
            }
            $sql = "UPDATE item SET inventory = '$updatedQ' WHERE item_id = $id";
            $connect = mysqli_connect('localhost','OFS','sesame','OFS');
            mysqli_query($connect,$sql);
          } 
          else 
          {
            $_SESSION["inven"] = $itemArray;
          }
        }
      break;
    }
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
          <a class="active item">Admin</a>
          <a href="contact.php" class="item">Contact</a>
          <div class="right item">
            <h3>Welcome, <?php echo $_SESSION['username']['username']; ?>!</h3>
            <!-- <a href="pantry.php">
              <div class="ui vertical animated green button" tabindex="0">
                <div class="hidden content">Shop</div>
                <div class="visible content">
                  <i class="shop icon"></i>
                </div>
              </div>
            </a> -->
            <a class="ui negative button" href="index.php">Log Out</a>
          </div>
        </div>

        <?php
        if ($negativeError) {
          echo "<div class='ui grid container'>
                  <div class='column'>
                      <div class='ui center aligned negative message'>
                          <div class='header'>
                              <i class='exclamation triangle icon'></i>
                              Item can't have negative inventory!
                          </div>
                      </div>
                  </div>
                </div>";
        }
        ?>

        <div class="ui raised segment container">
          <div class="ui grid">
            <?php
              $items = query("SELECT * FROM item");

              echo "<table class='ui striped table'>
              <thead>
                <tr>
                <th>Item Name</th>
                <th>Item Weight</th>
                <th>Item Price</th>
                <th>Inventory</th>
                <th>Quantity</th>
                <th></th>
                <th></th>
                </tr>
              </thead>";

              if (!empty($items)) 
              { 
                foreach($items as $key=>$value)
                {
            ?>
                  <form method="post" action="adminHome.php?action=addOrRemove&item_id=<?php echo $items[$key]["item_id"]; ?>">
                    <tr>
                      <td><?php echo $items[$key]["item_name"]; ?></td>
                      <td><?php echo $items[$key]["item_weight"];?></td>
                      <td><?php echo "$".$items[$key]["item_price"]; ?></td>
                      <td><?php echo $items[$key]["inventory"];?></td>
                      <td><span class="ui input"><input type="number"name="quantity" min="0" value="1"/></span></td>
                      <td><input class="ui bottom attached olive fluid button" type="submit" name="add" value ="Add to inventory"></></td>
                      <td><input class="ui fluid red button" type="submit" name="remove" value="Remove from inventory"></></td>
                    </tr>
                  </form>  
                  <?php
                }
                ?>
              </table>
              <?php
              }
            ?>
          </div>
        </div>

     
      
    </section>

  </div>


</body>

</html>