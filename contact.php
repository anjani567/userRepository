<!DOCTYPE html>
<html>
<head>
    <title>contact</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/contact.css">
    
</head>
<body>
    <!-- Nav bar Start -->
    <div style="background-color: rgba(97, 228, 228, 0.555); border: 1px solid; padding: 10px; box-shadow: 5px 8px 8px 25px #a2a1a1;">
        <header>
            <nav class="nav">
              <a href="home.php" class="logo" ><img src="image/logo1.jpeg" style="height: 75px;"></a>
      
              <div class="hamburger">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
              </div>
      
              <div class="nav__link hide">
                <a href="home2.php">Home</a>
                <a href="about.php">About</a>
                <a href="contact.php">Contact</a>
                <a href="herbal.php">ayurvedic</a>
                <!--<a href="#">Doctor</a>-->
                
              </div>

              <div>
                <a href="#" >LogIn</a>
              </div>
            </nav>
        </header>
    </div>
    <!-- Nav Bar End -->

    <!--contact us start-->
  <h1 class="general-title">Contact us</h1>
  <div class="row" > 
      <div class="grid">
        <div class="contact-img">
          <img src="/image/contact.png">
        </div>
      </div>
    <div class="grid">
      <form id="contactus-form" onsubmit = "return validation()"  method="POST" action="php/contact.php">
        <div class="form-field">
          <div class="form-group">
            <label class="col-form-label" for="fullname">Your name</label>
            <span class="required">*</span><br>
            <input id="fullname" class="box" placeholder="Enter your name" type="text" data-val="true" data-val-required="Enter your name" name="fullname" value="" aria-required="true" aria-invalid="false">
            <span class="field-validation-error"></span>
            <span class="field-validation-valid" data-valmsg-for="fullName" data-valmsg-replace="true"></span>
          </div>
        </div>
        <div class="form-group">
            <label class="col-form-label" for="Email">your email:</label>
            <span class="required">*</span><br>
            <input id="email" class="box" placeholder="enter your email address" type="text" date-val="true" data-val-email="wrong email" data-val-
            required="enter email" name="email" value="" aria-required="true" aria-invalid="false">
            <span class="field-validation-error"></span>
            <span class="field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span>
            
        </div>
        <div class="conact-attributes mb-3">
          <div id="contact_attribute_label_5e0ed4533546290001b8a167" class="form-group col-12 px-o">
              <label class="col-form-label text-prompt" >your phone number:</label>
              <span class ="required">*</span>
              <label class="sr-only" for="contact_attribute_5e0ed4533546290001b8a167">
              </label><br>
              <input id="contact_attribute_label_5e0ed4533546290001b8a167" class="box" name="phone"
              type="taxt" placeholder="Please Enter Your Number">
          </div>
        </div>
        <div class="buttons" >
            <input class="btn btn-success contact-us-button" type="submit" name="submit" value="Submit" >
        </div>
  
      </form>
    </div>
    
  </div>
  
  <!--contact us end-->
    
      


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
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">ABOUT</a></li>
                <li><a href="herbal.php">HERBAL</a></li>
                <li><a href="contact.php">Contact</a></li>
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

          <div class="row copyright">
            
             <p>Copyright &copy; 2023</p>
          </div>
          
    </div>
  </footer>

  <script src="js/contact.js"></script>
</html>

