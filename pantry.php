<?php 
  session_start(); 
  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  function query($query)
  {
    $connect = mysqli_connect('localhost','OFS','sesame','OFS');
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
      case "addToCart":
        if(!empty($_POST["quantity"])) 
        {
          $products = query("SELECT * FROM item WHERE item_id='" . $_GET["item_id"] . "'");
          $itemArray = 
            array
            (
              $products[0]["item_id"]=>
                array
                (
                  'item_id'=>$products[0]["item_id"],
                  'image'=>$products[0]["image"],
                  'item_name'=>$products[0]["item_name"], 
                  'item_weight'=>$products[0]["item_weight"], 
                  'quantity'=>$_POST["quantity"], 
                  'item_price'=>$products[0]["item_price"]));
      
          if(!empty($_SESSION["cart"])) 
          { 
            if(in_array($products[0]["item_id"],array_keys($_SESSION["cart"]))) 
            {
              foreach($_SESSION["cart"] as $a => $b) 
              {
                if($products[0]["item_id"] == $a) 
                {
                  if(empty($_SESSION["cart"][$a]["quantity"])) 
                  {
                    $_SESSION["cart"][$a]["quantity"] = 0;
                  }
                  $_SESSION["cart"][$a]["quantity"] += $_POST["quantity"];
                }
              }
            } 
            else 
            {
              $_SESSION["cart"] = $_SESSION["cart"] + $itemArray;
            }
          } 
          else 
          {
            $_SESSION["cart"] = $itemArray;
          }
        }
        break;
  
      case "removeFromCart":
        if(!empty($_SESSION["cart"])) 
        {
          foreach($_SESSION["cart"] as $a => $b) 
          {
            if($_GET["item_id"] == $b["item_id"])
            {
              $_SESSION["cart"][$a]["quantity"]--;
              if($_SESSION["cart"][$a]["quantity"] == 0)
              {
                unset($_SESSION["cart"]);
              }
            }       
            if(empty($_SESSION["cart"]))
            {
              unset($_SESSION["cart"]);
            }
          }
        }
        break; 
      case "removeAll":
        unset($_SESSION["cart"]);
        break;
    }
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
    #toggle .text {
      display: none;
    }
    .sidebar .item .list .button i {
      margin: 0 !important;
    }
    .sidebar .item .list .item {
      padding-right: 1em !important;
    }
    .sidebar .item .remove .button {
      margin-top: 1em;
    }
    #pantry {
      min-height: 700px;
      padding: 0.5em 0em;
      background: #F5EAD1 url('images/web-graphics/leaf-watermark.png');
      background-size: 600px;
      background-repeat: no-repeat;
      background-position: left bottom;
      left: -2em;
      bottom: -2em;
    }
    #pantry .container {
      margin-bottom: 2em;
    }
    #pantry .navbar .header span {
      font-family: 'Pacifico', cursive;
    }
    #pantry .navbar .header i {
      padding: 0 0.5em;
    }
    #pantry .navbar .right .button {
      margin: 0 1em !important;
    }
    #pantry .navbar .right h3 {
      margin: 0 1em !important;
    }
    #pantry .container .row .left h1 {
      font-size: 5em;
      margin-bottom: 0em;
      font-family: 'Pacifico', cursive;
    }
    #pantry .container .eight .button {
      margin-top: 1.5em;
      margin-right: 1.5em;
    }
    #pantry .container .header > div {
      display: inline-block;
      vertical-align: bottom;
    }
    #pantry .image img {
      max-width: 100%;
      max-height: auto;
    }
    #weight {
      color: #ca3b33;
    }
  </style>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.js"></script>

</head>
<body>
<?php
  $total_weight = 0;
  $total_price = 0;
  $taxPerc = 0.0725;
  $tax = 0;
  $order_tot = 0;
  if(isset($_SESSION["cart"]))
  {
    foreach ($_SESSION["cart"] as $product)
    {
      $total_price += ($product["item_price"] * $product["quantity"]);
      $total_weight += ($product["item_weight"] * $product["quantity"]);
    }
  }
  $tax = $total_price * $taxPerc;
  $order_tot = $tax + $total_price;
  $_SESSION["weight"] = $total_weight;
  $_SESSION["price"] = $total_price;
  $_SESSION["tax"] = $tax;
  $_SESSION["orderTot"] = $order_tot;
?>
  <!-- SIDEBAR SHOPPING CART -->
  <div class="ui vertical inverted wide sidebar menu">
    <div class="item">
      <h1>Order Summary</h1> <br>
      <div class="ui grid">

        <!-- WEIGHT  -->
        <div class="row">
          <div class="ten wide column">
            <span>Weight:</span>
          </div>
          <div class="six wide column right floated right aligned">
            <?php 
              $suffix = "lbs";
              if ($total_weight == 1) {
                $suffix = "lb";
              }
              if ($total_weight > 20) {
                echo "<span id='weight'><i class='exclamation triangle icon'></i>".$total_weight." lbs</span>";
              }
              else {
                echo "<span>".$total_weight." ".$suffix."</span>";
              }
            ?>
          </div>
        </div>

        <!-- TOTAL BEFORE TAX -->
        <div class="row">
          <div class="ten wide column">
            <span>Total before tax:</span>
          </div>
          <div class="six wide column right floated right aligned">
            <span><?php echo "$ ".number_format($total_price, 2); ?></span>
          </div>
        </div>

        <!-- ESTIMATED TAX -->
        <div class="row">
          <div class="ten wide column">
            <span>Estimated tax:</span>
          </div>
          <div class="six wide column right floated right aligned">
            <span><?php echo "$ ".number_format($tax, 2); ?></span>
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <!-- ORDER TOTAL -->
      <div class="ui grid">
        <div class="row">
          <div class="ten wide column">
            <span><h3>Order Total:</h3></span>
          </div>
          <div class="six wide column right floated right aligned">
            <span><h3><?php echo "$ ".number_format($order_tot, 2); ?></h3></span>
          </div>
        </div>
      </div>
    </div>
    <div class="item">
      <?php
        if($total_weight > 20)
        {
          echo "<div class='ui negative limit message'>
                    <div class='header'>
                      Weight exceeds 20-lb limit!
          </div>
          <p>Please remove items in cart to make it lighter</p>
        </div>
        <button class='ui disabled fluid green button'>Checkout</button>";
      }
      else if ($total_weight <= 0) {
        echo "<button class='ui disabled fluid green button'>Checkout</button>";
      }
      else {
        echo "<a href='shipping.php'>
          <button class='ui fluid green button'>Checkout</button>
        </a>";
      }
      ?>
    </div>

    <!-- SHOPPING CART -->
    <div class="item">
      <h1>Shopping Cart</h1> <br>
      <div class="ui grid">
        <div class="row">
          <div class="sixteen wide column">
          <div class="ui middle aligned divided list">
            <?php
              if(isset($_SESSION["cart"]))
              {
                foreach ($_SESSION["cart"] as $product)
                {
                  $name = $product["item_name"];
                  $item_id = $product["item_id"];
                  $quantity = $product["quantity"];
                  $suffix = "lbs";
                  echo 
                  "<div class='item'>
                    <div class='ui grid'>
                      <div class='row'>
                        <div class='ten wide column'>
                          <div class='content'>
                          $name
                          </div>
                        </div>
                        <div class='three wide column right aligned'>
                          <span>$quantity</span>
                        </div>
                        <div class='three wide column right aligned'>
                          <a href='pantry.php?action=removeFromCart&item_id=$item_id'>
                          <div class='ui mini button'><i class='ui minus icon'></i></div></a>
                        </div>
                      </div>
                    </div>
                  </div>";
                }
                echo "
                <div class='remove'>
                  <a href='pantry.php?action=removeAll'>
                    <button class='ui fluid red button'>
                      Remove all items
                    </button>
                  </a>
                </div>";
              }
              else
              {
                echo "<h3>No items in cart.</h3>";
              }
            ?>
          </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  
  <div class="pusher">

    <!-- MASTER HEAD -->
    <section id="pantry">
      
      <!-- NAV BAR -->
      <div class="navbar ui container">
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

      <!-- STICKY BUTTON -->
      <div id="toggle" class="ui sticky green massive launch right attached fixed button">
        <i class="cart plus icon"></i>
        <span class="text">Cart</span>
      </div>

      <div class="ui grid container">
        <div class="bottom aligned row">
          <div class="ui left aligned left floated six wide column">
            <h1>Pantry</h1>
          </div>
          <form action="Pantry.php" method="GET">
            <div class="ui right aligned right floated six wide column">
              <div class="ui right aligned category search">
                <div class="ui action input">
                  <input class="prompt" type="text" name="query" placeholder="Search...">
                  <button class="ui icon button" type="submit" value="Search">
                    <i class="search icon"></i>
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>   

      <div class="ui grid container">
        <div class="ui four doubling cards">

           <?php
            
            if (isset($_GET['query']))
            {
              $query = $_GET['query'];
              $query = htmlspecialchars($query);
              $products = query("SELECT * FROM item WHERE (`item_name` LIKE '%".$query."%') OR (`item_desc` LIKE '%".$query."%') OR (`item_category` LIKE '%".$query."%')");
            }
            else
            {
              $products = query("SELECT * FROM item");
            }
            if(!empty($products))
            {
              foreach($products as $key => $value)
              {
                $item_name = $products[$key]["item_name"];
                $item_price = $products[$key]["item_price"];
                $item_weight = $products[$key]["item_weight"];
                $weight_unit = $products[$key]["item_weight_unit"];
                $item_description = $products[$key]["item_desc"];
                $item_inventory = $products[$key]["inventory"];
                $image = $products[$key]["image"];
                // print_r($image);
            ?>
                <div class="card">
                  <form method="post" action="pantry.php?action=addToCart&item_id=<?php echo $products[$key]["item_id"]?>">  
                    <div class="image">
                      <!-- <img src="$image"> -->
                      <img src = <?php echo $image?> >
                    </div>
                    <div class="content">
                      <h3 class="header"><?php echo $item_name ?></h3>
                      <div class="meta">
                        <span class="date"><?php echo "$ ".$item_price ?></span> <br>
                        <span class="date"><?php echo $item_weight." ".$weight_unit ?></span>
                      </div>
                      <div class="description"><?php echo
                        $item_description ?>
                      </div>
                    </div>
                    <div class="cart">
                      <span>Quantity:</span>
                      <span class="ui input">
                        <input type="number" class="quantity" name="quantity" placeholder="0" min="0">
                      </span>
                      <button class="ui bottom attached olive fluid button" type="submit">
                        <i class="shop icon"></i>
                        Add to cart
                      </button>
                    </div>
            
                  </form>
                </div>
              <?php
            }
          }
            else
            {
              echo "<h3>No results found.</h3>";
            }
          ?>
        </div>
      </div>


    </section>

  </div>

  <script type="text/javascript">
  $('#toggle').click(function(){
    $('.ui.sidebar').sidebar('toggle');
  });
  $(".launch.button").mouseenter(function(){
        $(this).stop().animate({width: '150px'}, 200, 
             function(){$(this).find('.text').show();});
    }).mouseleave(function (event){
        $(this).find('.text').hide();
        $(this).stop().animate({width: '70px'}, 200);
    });
  </script>


</body>

</html>