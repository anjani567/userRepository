<?php
// Include the database connection file
include 'conn.php';

// Get the POST data
$product_id = isset($_POST['product_id']) ? mysqli_real_escape_string($conn, $_POST['product_id']) : '';
$product_name = isset($_POST['product_name']) ? mysqli_real_escape_string($conn, $_POST['product_name']) : '';
$product_image = isset($_POST['product_image']) ? mysqli_real_escape_string($conn, $_POST['product_image']) : '';
$price = isset($_POST['price']) ? mysqli_real_escape_string($conn, $_POST['price']) : '';
$quantity = isset($_POST['quantity']) ? mysqli_real_escape_string($conn, $_POST['quantity']) : '';
$total_price = isset($_POST['total_price']) ? mysqli_real_escape_string($conn, $_POST['total_price']) : '';

// Check if data is provided
if (!empty($product_id) && !empty($quantity)) {
    // Prepare the SQL query to insert data into the cart table
    $cart_query = "INSERT INTO addtocard (id, name,image, price, quantity, total_price) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($cart_query);
    $stmt->bind_param('sssdid', $product_id, $product_name, $product_image, $price, $quantity, $total_price);

    if ($stmt->execute()) {
        echo "<p>Product added to cart successfully.</p>";
        header("Location: viewCard.php");
    } else {
        echo "<p>Error adding product to cart: " . $stmt->error . "</p>";
    }
} else {
    echo "<p>Invalid product information.</p>";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
