<!DOCTYPE html>
<html>
<title>	Landing page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/landing.css" >
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<body >

<!-- Icon Bar (Sidebar - hidden on small screens) -->
<nav  id="navc" class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
  <!-- Avatar image in top left corner -->



  <img src="media/WhatsApp Image 2020-11-14 at 7.37.21 PM.jpeg" style="width:100%">
  
  <a style="text-decoration: none;border-radius: 10px;"  href="#home" class="w3-bar-item w3-button w3-padding-large w3-hover-white w3-hover-text-blue  ">
    <i id="a1" class="fa fa-home w3-xxlarge "></i>
    <p class="fontp">Home</p>
  </a>
  <a style="text-decoration: none;border-radius: 10px;" href="#about" class="w3-bar-item w3-button w3-padding-large w3-hover-white w3-hover-text-blue">
    <i class="fa fa-user w3-xxlarge"></i>
    <p class="fontp">About</p>
  </a>
  <a style="text-decoration: none;border-radius: 10px;" href="#Requirements" class="w3-bar-item w3-button w3-padding-large w3-hover-white w3-hover-text-blue">
    <i class="fa fa-book w3-xxlarge"></i>
    <p class="fontp">Requirements</p>
  </a>
   <a style="text-decoration: none;border-radius: 10px;" href="#How to apply to SIM" class="w3-bar-item w3-button w3-padding-large w3-hover-white w3-hover-text-blue">
    <i  class="fa fa-question w3-xxlarge"></i>
    <p class="fontp">How to apply to SIM</p>
  </a>
  <a style="text-decoration: none;border-radius: 10px;"  href="#contact" class="w3-bar-item w3-button w3-padding-large w3-hover-white w3-hover-text-blue">
    <i class="fa fa-envelope w3-xxlarge"></i>
    <p class="fontp">Contact</p>
  </a>
</nav>
 

<!-- Navbar on small screens (Hidden on medium and large screens)-->
<div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
  <div class="w3-bar w3-blue w3-opacity w3-hover-opacity-off w3-center w3-small">
    <a style="text-decoration: none;border-radius: 12px; font-size: 15px;" href="#" class="w3-bar-item w3-button w3-hover-white w3-hover-text-blue" style="width:14% !important">Home</a>
    <a style="text-decoration: none;border-radius: 12px; font-size: 15px;" href="#about" class="w3-bar-item w3-button w3-hover-white w3-hover-text-blue" style="width:18% !important">About</a>
    <a style="text-decoration: none;border-radius: 12px; font-size: 15px;" href="#Requirements" class="w3-bar-item w3-button w3-hover-white w3-hover-text-blue" style="width:18% !important">Requirements</a>
    <a style="text-decoration: none;border-radius: 12px; font-size: 15px;" href="#How to apply to SIM" class="w3-bar-item w3-button w3-hover-white w3-hover-text-blue" style="width:20% !important">How to apply to SIM</a>
    <a style="text-decoration: none;border-radius: 12px; font-size: 15px;" href="#contact" class="w3-bar-item w3-button w3-hover-white w3-hover-text-blue" style="width:18% !important">Contact</a>
  </div>
</div>


<!-- Page Content -->
<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
  <header style="background-image: url(media/back4.png); " class="w3-container w3-padding-32 w3-center " id="home">

 <a style="float: right;text-decoration: none; border-radius: 10px; " href=<?php echo "login.php" ?> class="w3-bar-item w3-button w3-padding-large w3-hover-text-blue w3-hover-light-grey w3-text-grey ">
    <i style=" size: 20px;" class="fa fa-sign-in w3-xxlarge  w3-hover-text-blue"></i>
    <p style="font-size: 22px;" >Login</p>
  </a>
  <center>
    <h1  id="welcomeh1" class="w3-jumbo w3-text-grey ">Welcome To SIM</h1>
    <p style="font-family:Verdana; text-indent: 10%;" class="w3-text-grey">Software industry & Multimedia</p>
</center>

    <center>
    <img  src="media/Software indusrty & multimedia.gif " alt="sim picture" class="w3-image" width="500" height="500">
    </center>
  </header>


<br><br>

<center>
<h2 class="carouselh2">Our News</h2>
<br>


<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="media/pexels-pixabay-267507.jpg" alt="First slide">
       <div class="carousel-caption d-none d-md-block">
    <h5>First slide</h5>
    <p>yes its the First slide</p>
  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="media/pexels-christina-morillo-1181298.jpg" alt="Second slide">
       <div class="carousel-caption d-none d-md-block">
    <h5>second slide</h5>
    <p>yes its the second slide</p>
  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="media/pexels-fauxels-3184454.jpg" alt="Third slide">
       <div class="carousel-caption d-none d-md-block">
    <h5>Third slide</h5>
    <p>yes its the Third slide</p>
  </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</center>




  <!-- About Section -->
  <div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
    <h2 >About SIM ?</h2>
    <hr style="width:200px" class="w3-opacity">
    <p> lorem ipsum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
      ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur
      adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
    </p>
  
   
    </div>
  
  <!-- Requirements Section -->
  <div class="w3-content w3-justify w3-text-grey w3-padding-64"  id="Requirements">
    <h2 >Requirements</h2>
    <hr style="width:200px" class="w3-opacity">
 <p> lorem ipsum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
      ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur
      adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
    </p>
     <h3 >To assign</h3>
    <div class="w3-row w3-center w3-padding-16 w3-section w3-light-grey">
      <div class="w3-quarter w3-section">
        <span class="w3-xlarge">60+</span><br>
      English
      </div>
      <div class="w3-quarter w3-section">
        <span class="w3-xlarge">4+</span><br>
        Pictures
      </div>
      <div class="w3-quarter w3-section">
        <span class="w3-xlarge">89+</span><br>
        Happy Clients
      </div>
      <div class="w3-quarter w3-section">
        <span class="w3-xlarge">150+</span><br>
        Meetings
      </div>
    </div>
    </div>
  <!-- End Requirements Section -->
  </div>



 <div class="w3-content w3-justify w3-text-grey w3-padding-64" id="How to apply to SIM">
    <h2 >How to apply to SIM</h2>
    <hr style="width:200px" class="w3-opacity">
    <p> lorem ipsum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
      ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur
      adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
    </p>
    </div>



  <!-- Contact Section -->
  <div class="col-12">
  <div class="w3-padding-64 w3-content w3-text-grey" id="contact">
    <h2 >Contact Us</h2>
    <hr style="width:200px" class="w3-opacity">

    <div class="w3-section">
      <p><i class="fa fa-map-marker fa-fw w3-text-white w3-xxlarge w3-margin-right"></i> Alexandria, Egypt</p>
      <p><i class="fa fa-phone fa-fw w3-text-white w3-xxlarge w3-margin-right"></i> Phone: +123456</p>
      <p><i class="fa fa-envelope fa-fw w3-text-white w3-xxlarge w3-margin-right"> </i> Email: sim.sim.sim@alexu.edu.eg.com</p>
    </div><br>
    <p>Let's get in touch. Send Us a message:</p>

    <form action="#" target="_blank">
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Name" required name="Name"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Email" required name="Email"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Subject" required name="Subject"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Message" required name="Message"></p>
      <p>
        <button class="w3-button w3-light-grey w3-padding-large" type="submit">
          <i class="fa fa-paper-plane"></i> SEND MESSAGE
        </button>
      </p>
    </form>
  <!-- End Contact Section -->
  </div>
  </div>

    <!-- Footer -->
  <footer class="w3-content w3-padding-64 w3-text-grey w3-xlarge">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-whatsapp w3-hover-opacity"></i>
    

  <!-- End footer -->
  </footer>

<!-- END PAGE CONTENT -->
</div>

</body>
</html>
