<?php
@include 'conn.php';

$orderPlaced = false; // Flag to check if the order has been placed

if (isset($_POST['order_btn'])) {
    // Retrieve user input from form
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $method = $_POST['method'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $country = $_POST['country'];

    // Query to get all items from the cart
    $cart_query = mysqli_query($conn, "SELECT * FROM `addtocard`");
    if (!$cart_query) {
        die("Query failed: " . mysqli_error($conn));
    }
    $price_total = 0;
    $product_name = [];

    // Calculate total price and prepare product details
    if (mysqli_num_rows($cart_query) > 0) {
        while ($product_item = mysqli_fetch_assoc($cart_query)) {
            if(isset($product_item['quantity']) && isset($product_item['price'])) {
                $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
                $product_price = $product_item['price'] * $product_item['quantity'];
                $price_total += $product_price;
            }
        }
    }

    // Convert product details array to a string
    $total_product = implode(', ', $product_name);

    // Insert order details into the orders table
    $detail_query = mysqli_query($conn, "INSERT INTO `orders1`(name, number, email, method, street, city, country, total_products, total_price) VALUES('$name','$number','$email','$method','$street','$city','$country','$total_product','$price_total')") or die('query failed');

    // Display a success message if the order was processed successfully
    if ($detail_query) {
        $orderPlaced = true; // Set flag to true after successful order
        // Optionally, you can clear the cart after successful order processing
        mysqli_query($conn, "DELETE FROM `addtocard`") or die('query failed');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/style1.css">

    <style>
        .cart-item {
            display: flex;
            flex-direction: column; /* Stack image and details vertically */
            align-items: center; /* Center items horizontally */
            margin-bottom: 20px; /* Space between items */
        }
        .cart-item-image {
            width: 80px;  /* Image size */
            height: 80px; /* Image size */
            object-fit: cover;
            margin-bottom: 5px; /* Space between image and text */
        }
        .cart-item-details {
            text-align: center; /* Center text below the image */
        }
        .display-order {
            display: flex;
            flex-wrap: wrap; /* Wrap items to the next line if needed */
            justify-content: space-around; /* Space items evenly */
            margin-bottom: 20px; /* Spacing below the order display */
        }
        .grand-total {
            font-weight: bold;
            margin-top: 10px; /* Spacing above grand total */
        }
    </style>
</head>
<body>

<!-- Header removed -->

<div class="container">

    <section class="checkout-form">

        <h1 class="heading">Complete Your Order</h1>

        <?php if ($orderPlaced): ?>
            <div class='order-message-container'>
                <div class='message-container'>
                    <h3>Thank you for order!</h3>
                    <div class='order-detail'>
                        <span><?= $total_product; ?></span>
                        <span class='total'> Total: Rs. <?= number_format($price_total); ?></span>
                    </div>
                    <div class='customer-details'>
                        <p>Your name: <span><?= htmlspecialchars($name); ?></span></p>
                        <p>Your number: <span><?= htmlspecialchars($number); ?></span></p>
                        <p>Your email: <span><?= htmlspecialchars($email); ?></span></p>
                        <p>Your address: <span><?= htmlspecialchars($street) . ", " . htmlspecialchars($city) . ", " . htmlspecialchars($country); ?></span></p>
                        <p>Your payment mode: <span><?= htmlspecialchars($method); ?></span></p>
                        <p>(*pay when product arrives*)</p>
                    </div>
                </div>
            </div>
            <div>
                <a style="font-size: 20px !important;" href="herbal.php" >goto back</a>
            </div>
        <?php else: ?>
            <form action="" method="post">

                <div class="display-order">
                    <?php
                    $select_cart = mysqli_query($conn, "SELECT * FROM `addtocard`");
                    $grand_total = 0;

                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                            $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
                            $grand_total += $total_price;
                    ?>
                    <div class="cart-item">
                        <img src="<?= $fetch_cart['image']; ?>" alt="<?= $fetch_cart['name']; ?>" class="cart-item-image">
                        <div class="cart-item-details">
                            <span><?= $fetch_cart['name']; ?> (<?= $fetch_cart['quantity']; ?>)</span><br>
                            <span>Rs. <?= number_format($total_price); ?>/-</span>
                        </div>
                    </div>
                    <?php
                        }
                    } else {
                        echo "<div class='display-order'><span>Your cart is empty!</span></div>";
                    }
                    ?>
                    <span class="grand-total">Grand Total: Rs. <?= number_format($grand_total); ?>/-</span>
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>Your Name</span>
                        <input type="text" placeholder="Enter your name" name="name" required>
                    </div>
                    <div class="inputBox">
                        <span>Your Number</span>
                        <input type="number" placeholder="Enter your number" name="number" required>
                    </div>
                    <div class="inputBox">
                        <span>Your Email</span>
                        <input type="email" placeholder="Enter your email" name="email" required>
                    </div>
                    <div class="inputBox">
                        <span>Payment Method</span>
                        <select name="method">
                            <option value="E-sewa">E-sewa</option>
                            <option value="Khalti">Khalti</option>
                        </select>
                    </div>
                    <div class="inputBox">
                        <span>Address</span>
                        <input type="text" placeholder="e.g. street name" name="street" required>
                    </div>
                    <div class="inputBox">
                        <span>City</span>
                        <input type="text" placeholder="e.g. KTM" name="city" required>
                    </div>
                    <div class="inputBox">
                        <span>Country</span>
                        <input type="text" placeholder="e.g. Nepal" name="country" required>
                    </div>
                </div>
                <input type="submit" value="Order Now" name="order_btn" class="btn">
            </form>
        <?php endif; ?>

    </section>

</div>

<!-- Custom JS file link -->
<script src="js/script1.js"></script>

</body>
</html>
