<?php 
  session_start(); 

  $outOfStockError = false;
  $differenceWarning = false;
  $num = 0;
  $name = "";
  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
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
  if(!empty($_POST["quantity"])) 
  {
    if(!empty($_GET["item_id"]))
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
              'quantity'=>number_format($_POST["quantity"]), 
              'item_price'=>$products[0]["item_price"],
              'inventory'=>$products[0]["inventory"],
              'itemHold'=>$products[0]["inventory"]-$_POST["quantity"]));
    }
  }
  if(!empty($_GET["action"])) 
  {
    switch($_GET["action"]) 
    {
      case "addToCart":
        if(!empty($_POST["quantity"])) 
        {
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
                  
                  if($_SESSION["cart"][$a]["itemHold"] == 0)
                  {
                    $outOfStockError = true;
                  }
                  else if ($_POST["quantity"] > $_SESSION["cart"][$a]["itemHold"])
                  {
                    $num = $_SESSION["cart"][$a]["itemHold"];
                    $name = $_SESSION["cart"][$a]["item_name"];
                    $differenceWarning = true;
                  }
                  else if($_POST["quantity"] <= $_SESSION["cart"][$a]["itemHold"])
                  {
                    $_SESSION["cart"][$a]["quantity"] += $_POST["quantity"];
                    $_SESSION["cart"][$a]["itemHold"] -= $_POST["quantity"];
                  }
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
              $_SESSION["cart"][$a]["itemHold"]++;
              if($_SESSION["cart"][$a]["quantity"] == 0)
              {
                unset($_SESSION["cart"][$a]);
              }
              
            }       
            if(empty($_SESSION["cart"]))
            {
              unset($_SESSION["cart"]);
            }
          }
        }
        break; 

      case "addOneToCart":
        if(!empty($_SESSION["cart"])) 
        {
          foreach($_SESSION["cart"] as $a => $b) 
          {
            if($_GET["item_id"] == $b["item_id"])
            {
              if ($_SESSION["cart"][$a]["itemHold"] == 0)
              {
                $outOfStockError = true;
              }
              else if(1 <= $_SESSION["cart"][$a]["itemHold"])
              {
                $_SESSION["cart"][$a]["quantity"]++;
                $_SESSION["cart"][$a]["itemHold"]--;
              }
              
            }       
          }
        }
        break; 

      case "removeAll":
        unset($_SESSION["cart"]);
        break;
      
      case "checkout":
        $_SESSION["checkout"] = "true";
        header('location: shipping.php');
        break;

      case "logout":
        session_destroy();
        unset($_SESSION["username"]);
        unset($_SESSION["complete"]);
        unset($_SESSION["checkout"]);
        unset($_SESSION["proceed"]);
        unset($_SESSION["confirm"]);
        header("location: index.php");
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
    body {
      min-height: 700px;
      padding: 0.5em 0em;
      background: #F5EAD1;
    }
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
      background: #F5EAD1;
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
    #pantry .header h1 {
      font-size: 4em;
      margin-bottom: 0em;
      font-family: 'Pacifico', cursive;
    }
    #pantry .categories {
      margin-top: 1.5em;
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
    #pantry .four .segment {
      margin: 1em 1em;
    }
    #pantry .cart .button {
      margin-top: 1em;
    }
    #weight {
      color: #ca3b33;
    }
    hr {
      opacity: 0.4;
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
                        <div class='eight wide column'>
                          <div class='content'>
                          $name
                          </div>
                        </div>
                        <div class='two wide column right aligned'>
                          <span>$quantity</span>
                        </div>
                        <div class='three wide column right aligned'>
                          <a href='pantry.php?action=removeFromCart&item_id=$item_id'>
                          <div class='ui mini button'><i class='ui minus icon'></i></div></a>
                        </div>
                        <div class='three wide column right aligned'>
                          <a href='pantry.php?action=addOneToCart&item_id=$item_id'>
                          <div class='ui mini button'><i class='ui plus icon'></i></div></a>
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
        echo "<a href='pantry.php?action=checkout'>
          <button class='ui fluid green button'>Checkout</button>
        </a>";
      }
      ?>
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
          <a href="home.php#about" class="item">About</a>
          <a href="home.php#about" class="item">Team</a>
          <a href="home.php#contact" class="item">Contact</a>
          <div class="right item">
            <h3>Welcome, <?php echo $_SESSION['username']['username']; ?>!</h3>
            <a class="ui primary button" href="profile.php">Profile</a>
            <a class="ui negative button" href="pantry.php?action=logout">Log Out</a>
          </div>
        </div>
      </div>

      <?php 
      if ($outOfStockError) 
      {
        echo "<div class='ui grid container'>
        <div class='column'>
            <div class='ui center aligned negative message'>
                <div class='header'>
                    <i class='exclamation triangle icon'></i>
                    Item is out of stock!
                </div>
            </div>
        </div>
      </div>";
      }
      if ($differenceWarning) 
      {
        echo "<div class='ui grid container'>
            <div class='column'>
              <div class='ui center aligned warning message'>
                <div class='header'>
                    <i class='info circle icon'></i>
                    Can only add $num $name.
                </div>
            </div>
          </div>
        </div>";
      }
      ?>

      <!-- STICKY BUTTON -->
      <div id="toggle" class="ui sticky green massive launch right attached fixed button">
        <i class="cart plus icon"></i>
        <span class="text">Cart</span>
      </div>

      <!-- <div class="ui grid container">
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
      </div>    -->

      <div class="ui header container">
        <div class="ui left aligned">
          <h1>Pantry</h1>
        </div>
      </div>

      <div class="ui raised green segment container">
        <h2>Categories:</h2>
        <form action="pantry.php" method="post">
          <div class="ui form">
            <div class="ui grid categories container">
              <div class="row">
                <div class="four wide column">
                  <div class="inline field">
                    <div class="ui checkbox">
                      <input type="checkbox" tabindex="0" class="hidden" name="category[]" value="Breads and Bakery">
                      <label><strong>Breads and Bakery</strong></label>
                    </div>
                  </div>
                </div>
                <div class="four wide column">
                  <div class="inline field">
                    <div class="ui checkbox">
                      <input type="checkbox" tabindex="0" class="hidden" name="category[]" value="Dairy, Cheese, and Eggs">
                      <label><strong>Dairy, Cheese, and Eggs</strong></label>
                    </div>
                  </div>
                </div>
                <div class="four wide column">
                  <div class="inline field">
                    <div class="ui checkbox">
                      <input type="checkbox" tabindex="0" class="hidden" name="category[]" value="Deli">
                      <label><strong>Deli</strong></label>
                    </div>
                  </div>
                </div>
                <div class="four wide column">
                  <div class="inline field">
                    <div class="ui checkbox">
                      <input type="checkbox" tabindex="0" class="hidden" name="category[]" value="Frozen">
                      <label><strong>Frozen</strong></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="four wide column">
                  <div class="inline field">
                    <div class="ui checkbox">
                      <input type="checkbox" tabindex="0" class="hidden" name="category[]" value="Meat and Seafood">
                      <label><strong>Meat and Seafood</strong></label>
                    </div>
                  </div>
                </div>
                <div class="four wide column">
                  <div class="inline field">
                    <div class="ui checkbox">
                      <input type="checkbox" tabindex="0" class="hidden" name="category[]" value="Meat Substitutes">
                      <label><strong>Meat Substitutes</strong></label>
                    </div>
                  </div>
                </div>
                <div class="four wide column">
                  <div class="inline field">
                    <div class="ui checkbox">
                      <input type="checkbox" tabindex="0" class="hidden" name="category[]" value="Produce">
                      <label><strong>Produce</strong></label>
                    </div>
                  </div>
                </div>
                <div class="four wide column">
                  <div class="inline field">
                    <div class="ui checkbox">
                      <input type="checkbox" tabindex="0" class="hidden" name="category[]" value="Soups, Stocks, and Broths">
                      <label><strong>Soups, Stocks, and Broths</strong></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="eight wide column">
                  <button class='ui green button' type='submit'>Apply</button>
                </div>
                <div class="eight wide column right aligned">
                  <form action="">
                    <button class='ui green button' type='submit'>Show All</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="ui container">
        <div class="ui four center aligned column doubling stackable grid container cards">

          <?php
            if(isset($_POST['category']))
            {
              $category = $_POST['category'];
              if(!empty($category))
              {
                $num = count($category);
                $string = "SELECT * FROM item WHERE ";
                for($i = 0; $i < $num; $i++)
                {
                  if($i < $num - 1)
                  {
                    $query = "$category[$i]";
                    $query = htmlspecialchars($query);
                    $string = $string."(`item_category` LIKE '%".$query."%') OR";
                  }
                  else
                  {
                    $query = "$category[$i]";
                    $query = htmlspecialchars($query);
                    $string = $string."(`item_category` LIKE '%".$query."%')";
                  }
                }
                $products = query($string);
              }
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
              <div class="ui column raised card">
                <form method="post" action="pantry.php?action=addToCart&item_id=<?php echo $products[$key]["item_id"]?>">
                  <div class="image">
                    <img src = <?php echo $image?> >
                  </div>
                  <hr>
                  <div class="content">
                    <h3 class="left aligned header"><?php echo $item_name ?></h3>
                    <div class="right floated meta">
                      <span><?php echo $item_weight." ".$weight_unit ?></span>
                    </div>
                    <div class="left aligned">
                      <p class="ui green label"><?php echo "$".$item_price ?></p>
                    </div>
                    <div class="left aligned description"><?php echo $item_description ?>
                    </div>
                  </div>
                  <div class="cart">
                    <div class="ui grid">
                      <div class="middle aligned row">
                        <div class="eight wide column">
                          <span class="left floated"><strong>Quantity:</strong></span>
                        </div>
                        <div class="eight wide column">
                            <span class="ui input right floated"><input class="ui input right floated" type="number" class="quantity" name="quantity" placeholder="0" min="0" max="<?php echo $item_inventory?>"></span>
                        </div>
                      </div>
                    </div>
                     <?php
                     if ($item_inventory < 1)
                     {
                      echo "<div class='ui negative fluid button'>
                      <i class='ban icon'></i>
                        Out of stock
                      </div>";
                     }
                     else {
                      echo "<button class='ui olive fluid button' type='submit'>
                      <i class='shop icon'></i>
                        Add to cart
                      </button>";
                     }
                     ?>

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
  $('.ui.checkbox').checkbox();
  </script>


</body>

</html>