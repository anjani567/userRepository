<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/addtocard.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/about.css" />
    <title>Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: rgba(97, 228, 228, 0.555);
            border-bottom: 1px solid #ccc;
        }

        .nav__link a {
            margin: 0 10px;
            text-decoration: none;
            color: #333;
            font-size: 20px;
        }

        .main-product {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
            max-width: 1200px;
            margin: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .product-details {
            flex: 1;
            margin: 10px;
            text-align: center;
        }

        .product-details img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            object-fit: cover; /* Ensures image covers the area */
        }

        h1 {
            font-size: 24px;
            margin: 10px 0;
        }

        p {
            font-size: 18px;
            margin: 5px 0;
        }

        input[type="number"] {
            width: 60px;
            padding: 5px;
            margin: 10px 0;
            font-size: 16px;
        }

        button {
            background-color: #28a745; /* Bootstrap success color */
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838; /* Darker green on hover */
        }

        footer {
             /* Dark footer */
            color: black;
            padding: 20px;
            text-align: center;
        }

        footer .column {
            margin: 20px 0;
        }

        footer a {
            color: white;
            text-decoration: none;
        }

        footer input[type="email"] {
            padding: 10px;
            width: 200px;
            margin-top: 10px;
        }

        footer button {
            background-color: #007bff; /* Bootstrap primary color */
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        footer button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>

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
                <a href="home2.php">Home</a>
                <a href="about.php">About</a>
                <a href="contact.php">Contact</a>
                <a href="herbal.php">Ayurvedic</a>
            </div>
            <a href="logout.php">Log Out</a>
        </nav>
    </header>
</div>

<?php
// Include the database connection file
include 'conn.php';

// Get the product ID and name from the query string and sanitize them
$product_id = isset($_GET['ViewCard']) ? mysqli_real_escape_string($conn, $_GET['ViewCard']) : '';
$product_name = isset($_GET['Name']) ? mysqli_real_escape_string($conn, $_GET['Name']) : '';

if (!empty($product_id) && !empty($product_name)) {
    // Fetch product details from the database
    $product_query = "SELECT * FROM tblcard WHERE products = ? AND Name = ?";
    $stmt = $conn->prepare($product_query);
    $stmt->bind_param('ss', $product_id, $product_name);
    $stmt->execute();
    $product_result = $stmt->get_result();

    if ($product_result && $product_result->num_rows > 0) {
        $product = $product_result->fetch_assoc();
        $img_src = $product['Image'];
        $price = $product['Price'];
        $description = $product['descriptions']; // Assuming the column is 'descriptions'
        ?>
        <div class="main-product">
            <div class="product-details">
                <img src="<?php echo htmlspecialchars($img_src); ?>" alt="Product Image" class="img-responsive" />
            </div>
            <div class="product-details">
                <h1><?php echo htmlspecialchars($product_name); ?></h1>
                <p>Price per unit: <b id="unit-price"><?php echo htmlspecialchars($price); ?></b></p>
                <p>Description: <?php echo htmlspecialchars($description); ?></p> <!-- Display the description -->

                <!-- Quantity input field -->
                <p>
                    Quantity: 
                    <input type="number" id="quantity" value="1" min="1" onchange="updateTotalPrice()">
                </p>

                <!-- Total price display -->
                <p>Total Price: <b id="total-price"><?php echo htmlspecialchars($price); ?></b></p>

                <!-- Add to cart button -->
                <form action="addCart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product_id); ?>">
                    <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product_name); ?>">
                    <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($img_src); ?>">
                    <input type="hidden" name="price" id="hidden-total-price" value="<?php echo htmlspecialchars($price); ?>">
                    <input type="hidden" name="quantity" id="hidden-quantity" value="1">
                    <input type="hidden" name="total_price" id="hidden-total-price" value="<?php echo htmlspecialchars($price); ?>">
                    <button type="submit">Add-To-Cart</button>
                </form>
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


<!-- Footer Start -->
<footer>
    <div class="footer">
        <div class="row primary">
            <div class="column about">
                <h3>Connect</h3>
                <p>
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

<script>
    function updateTotalPrice() {
        var unitPrice = parseFloat(document.getElementById('unit-price').innerText);
        var quantity = parseInt(document.getElementById('quantity').value);
        var totalPrice = unitPrice * quantity;

        document.getElementById('total-price').innerText = totalPrice.toFixed(2);
        document.getElementById('hidden-total-price').value = totalPrice.toFixed(2);
        document.getElementById('hidden-quantity').value = quantity;
    }
</script>
    
</body>
</html>
