<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="css/search.css" />
    <link rel="stylesheet" href="css/addtocard.css" />
    <title>Document</title>
</head>
<body>
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
    <a style="font-size: 20px !important;" href="logout.html">Logout</a>
  </div>
</nav>
</header>

    <!-- Nav Bar End -->
    
    <?php
    // Include the database connection file
    include 'conn.php';

    // Get the product ID and name from the query string and sanitize them
    $product_id = isset($_GET['BuyProduct']) ? mysqli_real_escape_string($conn, $_GET['BuyProduct']) : '';
    $product_name = isset($_GET['Name']) ? mysqli_real_escape_string($conn, $_GET['Name']) : '';

    if (!empty($product_id) && !empty($product_name)) {
        $product_query = "SELECT * FROM tblcard WHERE products = ? AND Name = ?";
        $stmt = $conn->prepare($product_query);
        $stmt->bind_param('ss', $product_id, $product_name);
        $stmt->execute();
        $product_result = $stmt->get_result();

        if ($product_result && $product_result->num_rows > 0) {
            $product = $product_result->fetch_assoc();
            $img_src = $product['Image'];
            $price = $product['Price'];
            $description = $product['descriptions'];
            ?>
            <div class="main-product">
                <div class="product-details">
                    <img src="<?php echo htmlspecialchars($img_src); ?>" alt="Product Image" class="img-responsive" />
                </div>
                <div class="product-details">
                    <h1><?php echo htmlspecialchars($product_name); ?></h1>
                    <p>Price per unit: <b id="unit-price"><?php echo htmlspecialchars($price); ?></b></p>
                    <p>Description: <?php echo htmlspecialchars($description); ?></p>
                    
                    <!-- Quantity input field -->
                    <p>
                        Quantity: 
                        <input type="number" id="quantity" value="1" min="1" onchange="updateTotalPrice()">
                    </p>
                    
                    <!-- Total price display -->
                    <p>Total Price: <b id="total-price"><?php echo htmlspecialchars($price); ?></b></p>
                    
                    <!-- Buy button -->
                    <form action="" method="GET">
                        <input type="hidden" name="BuyProduct" value="<?php echo htmlspecialchars($product_id); ?>">
                        <input type="hidden" name="price" id="hidden-total-price" value="<?php echo htmlspecialchars($price); ?>">
                        
                    </form>
                    <div>
                        <a href="checkorder.php?BuyProduct=<?php echo htmlspecialchars($product_id); ?>&Name=<?php echo htmlspecialchars($product_name); ?>" class="btn">Buy</a>
                    </div>
                    
                </div>
            </div>
            <?php
        } else {
            echo "<p>No product found with the given ID.</p>";
        }
    } else {
        echo "<p>Invalid product ID.</p>";
    }
    ?>
    
    <script>
        function updateTotalPrice() {
            var unitPrice = parseFloat(document.getElementById('unit-price').innerText);
            var quantity = parseInt(document.getElementById('quantity').value);
            var totalPrice = unitPrice * quantity;

            document.getElementById('total-price').innerText = totalPrice.toFixed(2);
        }
    </script>
    
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

</body>
</html>
