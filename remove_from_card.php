<?php
// Include your database connection
include 'conn.php';

if (isset($_POST['remove'])) {
    // Sanitize the product_id to avoid SQL injection or unintended behavior
    $product_id = intval($_POST['product_id']); // Ensure it's an integer

    if ($product_id > 0) {
        // Delete the item from the cart using the specific product ID
        $delete_query = "DELETE FROM addtocard WHERE id = $product_id";

        if ($conn->query($delete_query) === TRUE) {
            // Redirect back to the cart page after deletion
            header('Location: viewCard.php');
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Invalid product ID.";
    }
}

// Close the connection
$conn->close();
?>
