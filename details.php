<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['product_id'];
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $description = $_POST['product_description'];
    $image = $_POST['product_image'];

    // Now you can use $id to fetch more details from the database or display the data
    echo "<h1>Product Details</h1>";
    echo "<p>Product ID: $id</p>";
    echo "<p>Product Name: $name</p>";
    echo "<p>Price: $price</p>";
    echo "<p>Description: $description</p>";
    echo "<img src='$image' alt='Product Image'>";
    
    // Additional processing depending on your needs
}
?>
