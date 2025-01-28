<?php
require_once 'conn.php';

$sql = "SELECT * FROM tblcard";
$all_product = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/search.css" />
    <link rel="stylesheet" href="css/home.css" />
    <title>responsive navbar</title>
  </head>
  <body>
    <!-- nav bar start -->
    <div style="background-color: rgba(97, 228, 228, 0.555); border: 1px solid; padding: 10px; box-shadow: 5px 8px 8px 25px #a2a1a1;">
    <header style="position: fixed; top: 0; left: 0; width: 100%; z-index: 1000; background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">

  <nav class="nav">
    <a href="home.html" class="logo"><img src="image/logo.jpg" style="height: 75px;"></a>

    <div class="hamburger">
      <span class="line"></span>
      <span class="line"></span>
      <span class="line"></span>
    </div>

    <div class="nav__link hide">
      <a style="font-size: 20px !important;" href="home2.php">Home</a>
      <a style="font-size: 20px !important;" href="about.php">About</a>
      <a style="font-size: 20px !important;" href="contact.php">Contact</a>
      <a style="font-size: 20px !important;" href="herbal.php">Ayurvedic</a>
    </div>

    <!--<div class="search" style="width: 500px; float: right;">
      <div class="search-input">
        <input type="text" placeholder="type to search..">
        <div class="autocom-box">
          <li>Avani</li>
          <li>Becozinc-G</li>
          <li>Dettol</li>
          <li>Evecaresyrup</li>
          <li>Cosmedicappure</li>
          <li>Ecc vial</li>
          <li>pudin</li>
          <li>Reosto</li>
          <li>Ophthacare</li>
        </div>
        <div class="icon"><i class="fas fa-search"></i></div>
      </div>
    </div>-->

    <div>
      <a style="font-size: 20px !important;" href="login.html">LogIn</a>
    </div>
  </nav>
</header>

    </div>
    <div class="slideshow-container">

      <div class="mySlides fade">
        <img src="image/natural_ayurveda.webp" style="width:65%">
        <div class="text">Sundarya-face-wash</div>
      </div>
      
      <div class="mySlides fade">
        <img src="image/aloevera-moisturizing.png" style="width:65%">
        <div class="text">aloevera-moisturizing</div>
      </div>
      
      <div class="mySlides fade">
        <img src="image/ayurvedic.webp" style="width:75%">
        <div class="text">screen-care-product</div>
      </div>
    </div>
    <br>
      
    <div style="text-align:center">
      <span class="dot"></span> 
      <span class="dot"></span> 
      <span class="dot"></span> 
    </div>

    <!-- design section start -->
    
    

  </body>

  <!-- footer start -->
  <footer>
    <div class="footer">
        <div class="row primary">
            <div class="column about">
              <h3>Connect</h3>
              <p style="color: black;">
                <i class="fa fa-map-marker" aria-hidden="true" ></i>
                Chandragiri , Kathmandu , Nepal
              </p>
            </div>
          
            <div class="column link">
              <h3>Links</h3>
              <ul>
                <li><a href="home.html">Home</a></li>
                <li><a href="about.html">ABOUT</a></li>
                <li><a href="herbal.html">herbal</a></li>
                <!--<li><a href="#support">DOCTOR</a></li>-->
              </ul>
            </div>
          
            <div class="column subscribe">
              <h3>Newsletter</h3>
              <div>
                <input type="email" placeholder="Your email id here" />
                <button>Subscribe</button>
              </div>
            </div>
          </div>

          <!--<div class="row copyright">
            
             <p style="text-align: center;">Copyright &copy; 2023</p>
          </div>-->
          
    </div>
  </footer>

  <script src="js/script.js"></script>
  <script src="js/search.js"></script>
  <script src="js/suggestions.js"></script>
</html>
