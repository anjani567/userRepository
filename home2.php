<?php
session_start();
require_once 'conn.php';

$userName = isset($_SESSION['username']) ? $_SESSION['username'] : "";

$sql1 = "SELECT * FROM `login`";
$sql = "SELECT * FROM tblcard";
$all_product = $conn->query($sql);
$all_login = $conn->query($sql1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMjM6LU27WzF4iZPQ6eqi2tB4R+R4xRhQ1ZANP" crossorigin="anonymous" />
    <title>Responsive Navbar</title>
</head>
<body>
    <!-- nav bar start -->
    <div style="background-color: rgba(97, 228, 228, 0.555); border: 1px solid; padding: 10px; box-shadow: 5px 8px 8px 25px #a2a1a1;">
        <header>
            <nav class="nav">
                <a href="home.html" class="logo"><img src="image/logo1.jpeg" style="height: 75px;"></a>
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
                <div>
                    <a href="viewCard.php" style="font-size: 20px !important;">
                        <i class="fas fa-shopping-cart" style="font-size: 24px;"></i> Cart
                    </a>
                </div>
                <div>
                    <a style="font-size: 20px !important;" href=""><?php echo "Welcome " . htmlspecialchars($_SESSION['user_name']); ?></a>
                </div>
                <div>
                    <a style="font-size: 20px !important;" href="logout.php">
                        <i class="fas fa-sign-out-alt" style="font-size: 24px;"></i> Log Out
                    </a>
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
            <img src="image/nano.jpeg" style="width:65%">
            <div class="text">Nano</div>
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
    <!-- nav bar end -->

    

    <!-- footer start -->
    <footer>
        <div class="footer">
            <div class="row primary">
                <div class="column about">
                    <h3>Connect</h3>
                    <p style="color: black;">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        Chandragiri, Kathmandu, Nepal
                    </p>
                </div>
                <div class="column link">
                    <h3>Links</h3>
                    <ul>
                        <li><a href="home.html">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="herbal.html">Herbal</a></li>
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
        </div>
    </footer>
    <script src="js/script.js"></script>
</body>
</html>
