<!DOCTYPE html>
<html>
<head>

  <!-- Site Properties -->
  <title>Something Simple</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.css">
  <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">

  <style type="text/css">

    #masthead {
      min-height: 700px;
      padding: 0.5em 0em;
      background: #F5EAD1 url('images/web-graphics/leaf-watermark3.png');
      background-size: 600px;
      background-repeat: no-repeat;
      background-position: left bottom;
      left: -2em;
      bottom: -2em;
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

    #masthead .container h1 {
      font-size: 5em;
      margin-top: 2em;
      margin-bottom: 0em;
      font-family: 'Pacifico', cursive;
    }

    #masthead .container .eight .button {
      margin-top: 1.5em;
      margin-right: 1.5em;
    }


  </style>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.3/semantic.js"></script>

</head>
<body>

  
  <div class="pusher">

    <!-- MASTER HEAD -->
    <section id="masthead">
      
      <!-- NAV BAR -->
      <div class="ui container">
        <div class="ui large secondary menu">
          <div class="header item">
            <span>something simple.</span>
            <i class="leaf icon"></i>
          </div>
          <a class="active item">Home</a>
          <a class="item">About</a>
          <a class="item">Team</a>
          <a class="item">Contact</a>
          <div class="right item">
            <a class="ui green button" href="signin.php">Log in</a>
            <a class="ui green button" href="signup.php">Sign Up</a>
          </div>
        </div>
      </div>

      <!-- HEADER CONTENTS -->
      <div class="ui container">
        <!-- LEFT SIDE TEXTS -->
        <div class="eight wide column">
          <h1>something simple.</h1>
          <h2>We Make Bananas That Can Dance.</h2>
          <a href="signin.php">
            <div class="ui huge olive button">Get Started <i class="right arrow icon"></i></div>
          </a>
          <div class="ui container">
            <a href="#">
              <button class="ui medium black button">Learn more</button>
            </a>
            <a href="#">
              <button class="ui medium black button">Track order</button>
            </a>
          </div>
        </div>
        <!-- RIGHT SIDE IMAGES -->
      </div>
      
    </section>

    <!-- ABOUT SECTION -->
    <section id="about">
      <div class="ui vertical stripe center aligned segment">
        <h1>About Us</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a rhoncus nisl. Quisque pulvinar tempus imperdiet. Vestibulum rhoncus ipsum at nulla pretium vestibulum. Mauris facilisis vitae elit quis accumsan. Sed eget sapien rutrum, feugiat lectus vel, pulvinar turpis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent fermentum pulvinar sodales. Maecenas tempus elit dui, at pharetra urna vulputate id. Fusce aliquam mauris et eros vulputate euismod.

        Aenean arcu libero, volutpat quis mollis vel, tempus eu dui. Curabitur at orci rutrum nunc tempor bibendum a eget ligula. Suspendisse potenti. Donec augue mi, accumsan eget justo eu, sodales faucibus massa. Praesent in commodo augue, vel porta mauris. Fusce luctus magna at urna laoreet, condimentum porttitor metus blandit. Etiam volutpat dignissim molestie.

        Sed efficitur mi nec facilisis malesuada. Suspendisse mollis, ipsum at vestibulum placerat, arcu quam hendrerit urna, ut malesuada nibh elit fringilla felis. Sed id libero ut sem aliquam pulvinar. Praesent aliquam massa eu dui posuere eleifend. Fusce dictum molestie quam. Proin id erat sed nibh varius imperdiet. Nullam pharetra convallis placerat. Nulla feugiat id ex varius suscipit. Curabitur ornare justo id tellus aliquet, vel accumsan nisl tempus. Aliquam a diam consequat, hendrerit leo sed, mattis dolor. Suspendisse imperdiet congue diam. Donec semper nec nibh in pulvinar.</p>
      </div>
    </section>

  </div>


</body>

</html>


