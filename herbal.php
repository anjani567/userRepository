<?php
session_start(); // Start the session

require_once 'conn.php';

// Check if the user is already logged in and display their name
$userName = isset($_SESSION['username']) ? $_SESSION['username'] : "";

$sql1 = "SELECT * FROM `login`";
$sql = "SELECT * FROM tblcard";
$all_product = $conn->query($sql);
$all_login = $conn->query($sql1);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Ayurvedic Products</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Arial', sans-serif;
        }

        /* Sticky Header */
        #header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: rgba(97, 228, 228, 0.555);
            padding: 10px 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav a {
            color: black;
            font-size: 18px;
            text-decoration: none;
            margin: 0 10px;
        }

        .nav a:hover {
            text-decoration: underline;
        }

        /* Product Section */
        .product-category {
            text-align: center;
            margin: 20px 0;
            font-size: 2rem;
            color: #00796b;
            font-weight: bold;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 20px auto;
        }

        .card {
            background-color: white;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            width: 250px;
            padding: 15px;
            text-align: center;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .product_name {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            margin: 10px 0;
        }

        .price {
            font-size: 1.1rem;
            color: #e74c3c;
            font-weight: bold;
        }

        .buttons {
            margin-top: 15px;
        }

        .add {
            background-color: #00796b;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 5px;
            transition: background-color 0.3s ease;
        }

        .add:hover {
            background-color: #004d40;
        }

        /* Footer */
        footer {
            background-color: #frgb(229, 228, 228);
            color: white;
            padding: 20px 0;
        }

        .footer {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            text-align: center;
        }

        .footer h3 {
            color: black;
            margin-bottom: 15px;
        }

        .footer p, .footer a {
            color: black;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .footer input {
            padding: 8px;
            border-radius: 5px;
            border: none;
        }

        .footer button {
            padding: 8px 20px;
            background-color: #004d40;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .footer button:hover {
            background-color: #00332e;
        }
    </style>
</head>
<body>
    <!-- Nav bar Start -->
    <div id="header">
        <header id="my_header">
            <nav class="nav">
              <a href="home.html" class="logo"><img src="image/logo1.jpeg" style="height: 75px;"></a>
      
              <div class="nav__link">
                  <a href="home2.php">Home</a>
                  <a href="about.php">About</a>
                  <a href="contact.php">Contact</a>
                  <a href="herbal.php">Ayurvedic</a>
              </div>

              <div>
                <a href="logout.php">Logout</a>
              </div>
            </nav>
        </header>
    </div>
    <!-- Nav Bar End -->

    <!-- Product Section Start -->
    <section class="product">
        <h2 class="product-category">All Medicine</h2>
        <div class="product-container">
            <?php
            while ($row = mysqli_fetch_assoc($all_product)) {
                echo "
                  <div class='card'>
                     <a href='recommendations.php?category=" . urlencode($row['category']) . "&product_id=" . $row['Id'] . "&price=" . $row['Price'] . "'>
                          <div class='image'>
                              <img src='{$row["Image"]}' alt='Product Image'>
                          </div>
                          <div class='caption'>
                              <p class='product_name'>{$row["Name"]}</p>
                              <p class='price'>{$row["Price"]}</p>
                          </div>
                      </a>
                      <div class='buttons'>
                          <a href='Add-to-card.php?ViewCard=" . $row['products'] . "&Name=" . $row['Name'] . "'>
                            <button class='add' name='cart' type='button'>Add to Cart</button>
                          </a>
                          <a href='checkout.php?BuyProduct=" . $row['products'] . "&Name=" . $row['Name'] . "'>
                          </a>
                      </div>
                  </div>
                  ";
            }
            ?>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Footer Start -->
    <footer>
        <div class="footer">
            <div class="about">
              <h3>Connect</h3>
              <p><i class="fa fa-map-marker"></i> Chandragiri, Kathmandu, Nepal</p>
            </div>
          
            <div class="link">
              <h3>Links</h3>
              <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="herbal.php">Herbal</a></li>
                <li><a href="contact.php">Contact</a></li>
              </ul>
            </div>
          
            <div class="subscribe">
              <h3>Newsletter</h3>
              <div>
                <input type="email" placeholder="Your email" />
                <button>Subscribe</button>
              </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
