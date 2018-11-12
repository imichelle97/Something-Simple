<?php 
  include('server.php');
  
  // if (!isset($_SESSION['username'])) {
  //  $_SESSION['msg'] = "You must log in first";
  //  header('location: login.php');
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
  <script   src="https://code.jquery.com/jquery-3.3.1.min.js"   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.css">
  <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">

  <style type="text/css">

    section {
      padding: 4% 15% ;
    }

    p {
      font-size: 1.5em;
    }

    h2 {
      font-size: 2em;
    }

    .header h1 {
      font-family: 'Pacifico', cursive;
      font-size: 4em;
      text-align: center;
    }
    #masthead {
      min-height: 1000px;
      padding: 0.5em 0em;
      background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), #F5EAD1 url("https://harvest2u.com/wp-content/uploads/2015/07/iStock_67547707_LARGE.jpg") no-repeat center center fixed;
    }

    #masthead .container .header span {
      font-family: 'Pacifico', cursive;
    }

    #masthead .container .header i {
      padding: 0 0.5em;
    }

    #masthead .container .right .button {
      margin: 0 1em !important; 
    }

    #masthead .container .right h3 {
      margin: 0 1em !important;
    }

    #masthead .container h1 {
      font-size: 7em;
      margin-top: 2.5em;
      margin-bottom: 0.5em;
      font-family: 'Pacifico', cursive;
      color: white;
    }

    #masthead .container .column h2 {
      color: white;
    }

    #masthead .container .button {
      margin: 1em 1.5em;
    }

    #about {
      background: #F5EAD1;
    }

    #about .cards .button {
      margin: 3px;
    }

    #contact {
      background: #F2F2F2 url('images/web-graphics/leaf-watermark.png') no-repeat;
      background-size: 95%;
    }

    #contact .container {
      max-width: 600px !important;
    }


  </style>

</head>
<body>

  
  <div class="pusher">

    <!-- MASTER HEAD -->
    <section id="masthead">
      
      <!-- NAV BAR -->
      <div class="ui container">
        <div class="ui inverted large secondary menu">
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
      <div class="ui center aligned container">
        <!-- LEFT SIDE TEXTS -->
        <div class="column">
          <h1>something simple.</h1>
          <h2>Creating a hearty world one drone at a time</h2>
          <a href="pantry.php">
            <div class="ui massive olive button">Get Started <i class="right arrow icon"></i></div>
          </a>
          <div class="ui container">
            <a href="#about">
              <button class="ui inverted large black button">Learn more</button>
            </a>
            <a href="tracking.php">
              <button class="ui inverted large black button">Track order</button>
            </a>
          </div>
        </div>
      </div>
      
    </section>

    <section id="about">
      <div class="row">
        <div class="header">
          <h1>About</h1>
          <hr>
        </div>
      </div>
      <div class="ui grid center aligned container">

        <div class="center aligned row">
          <h2>Our Goal</h2>
          <p>Something Simple is a delivery company that provides organic, fresh produce right to your doorsteps.  
          Started in the Bay Area, we strive to bring our consumers the highest quality of produce at the click of a button.  
          With our advanced drone technology, skip the traffic and commute, and have your ingredients ready right after a long work day.  
          Our drones are installed with GPS tracking and security camera system to estimate delivery time and ensure any problems resolved.
          <br> <br>
          In the busyness of everyday, it's easy to lose passion for a healthy lifestyle and give in to temptation of fast, time saving meals.  
          Something simple is pushing for a change, to create a hearty world one drone at a time.
          </p>
        </div>
        <hr>
        <div class="center aligned row">
          <h2>The Team</h2>
          <div class="ui five doubling special cards">
          
            <div class="card">
              <div class="blurring dimmable image">
                <div class="ui inverted dimmer">
                  <div class="content">
                    <div class="center">
                      <a target="_blank" href="https://github.com/karllapuz"><div class="ui black button"><i class="github icon"></i>Github</div></a>
                      <a target="_blank" href="https://www.linkedin.com/in/karllapuz/"><div class="ui linkedin button"><i class="linkedin icon"></i> LinkedIn</div></a>
                    </div>
                  </div>
                </div>
                <img src="https://picsum.photos/200">
              </div>
              <div class="content">
                <a class="header">Abraham Kong</a>
                <div class="meta">
                  <span class="date">Project Role</span>
                </div>
              </div>
            </div>


            <div class="card">
              <div class="blurring dimmable image">
                <div class="ui inverted dimmer">
                  <div class="content">
                    <div class="center">
                      <a target="_blank" href="https://github.com/karllapuz"><div class="ui black button"><i class="github icon"></i>Github</div></a>
                      <a target="_blank" href="https://www.linkedin.com/in/karllapuz/"><div class="ui linkedin button"><i class="linkedin icon"></i> LinkedIn</div></a>
                    </div>
                  </div>
                </div>
                <img src="https://picsum.photos/200">
              </div>
              <div class="content">
                <a class="header">Karl Lapuz</a>
                <div class="meta">
                  <span class="date">Project Role</span>
                </div>
              </div>
            </div>


            <div class="card">
              <div class="blurring dimmable image">
                <div class="ui inverted dimmer">
                  <div class="content">
                    <div class="center">
                      <a target="_blank" href="https://github.com/imichelle97"><div class="ui black button"><i class="github icon"></i>Github</div></a>
                      <a target="_blank" href="https://www.linkedin.com/in/michelle-luong/"><div class="ui linkedin button"><i class="linkedin icon"></i> LinkedIn</div></a>
                    </div>
                  </div>
                </div>
                <img src="https://picsum.photos/200">
              </div>
              <div class="content">
                <a class="header">Michelle Luong</a>
                <div class="meta">
                  <span class="date">Project Role</span>
                </div>
              </div>
            </div>


            <div class="card">
              <div class="blurring dimmable image">
                <div class="ui inverted dimmer">
                  <div class="content">
                    <div class="center">
                      <a target="_blank" href="https://github.com/KaterTot"><div class="ui black button"><i class="github icon"></i>Github</div></a>
                      <a target="_blank" href="https://www.linkedin.com/in/katelynn-tran-4b2160140/"><div class="ui linkedin button"><i class="linkedin icon"></i> LinkedIn</div></a>
                    </div>
                  </div>
                </div>
                <img src="https://picsum.photos/200">
              </div>
              <div class="content">
                <a class="header">Katelynn Tran</a>
                <div class="meta">
                  <span class="date">Project Role</span>
                </div>
              </div>
            </div>


            <div class="card">
              <div class="blurring dimmable image">
                <div class="ui inverted dimmer">
                  <div class="content">
                    <div class="center">
                      <div class="ui black button"><i class="github icon"></i>Github</div>
                      <div class="ui linkedin button"><i class="linkedin icon"></i> LinkedIn</div>
                    </div>
                  </div>
                </div>
                <img src="https://picsum.photos/200">
              </div>
              <div class="content">
                <a class="header">Vincent Tran</a>
                <div class="meta">
                  <span class="date">Project Role</span>
                </div>
              </div>
            </div>
 

          </div>
        </div>
      </div>
    </section>

    <section id="contact">
      <div class="row">
        <div class="header">
          <h1>Contact</h1>
          <hr>
        </div>
      </div>
      <div class="ui grid center aligned container">

        <div class="center aligned row">
          <h2><i class="paper plane icon"></i></h2>
          <div class="ui raised segment container">
            <form class="ui form" action="">
              <h3>Leave us a note!</h3>
              <div class="field">
                <label>Name</label>
                <input type="text">
              </div>
              <div class="field">
                <label>Message</label>
                <textarea></textarea>
              </div>
              <div class="field">
                <div class="ui fluid primary submit button">Submit</div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

  </div>

<script>
  $('.special.cards .image').dimmer({
    on: 'hover'
  });
</script>

</body>

</html>

