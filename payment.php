<?php
session_start();
@include 'conn.php';

// Handle quantity updates
if(isset($_POST['update_update_btn'])){
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    
    // Update session cart
    $_SESSION['cart'][$update_id]['quantity'] = $update_value;

    // Update quantity in the database
    $query = "UPDATE cart SET quantity = ? WHERE product_id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iii", $update_value, $update_id, $_SESSION['user_id']); // Assuming you have the user ID stored in the session
    $stmt->execute();
}

// Handle item removal
if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    
    // Remove from session cart
    unset($_SESSION['cart'][$remove_id]);
    
    // Remove item from the database
    $query = "DELETE FROM cart WHERE product_id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $remove_id, $_SESSION['user_id']);
    $stmt->execute();
}

// Handle cart clearance
if(isset($_GET['delete_all'])){
    // Clear session cart
    unset($_SESSION['cart']);
    
    // Clear cart in the database
    $query = "DELETE FROM cart WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
}

// Calculate total number of items in the cart
$total_items = 0;
if(isset($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $item){
        $total_items += $item['quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link -->
   <link rel="stylesheet" href="style/style1.css">

</head>
<body>

<?php include 'header.php'; ?>

<!-- Cart Icon with Total Items -->
<div class="cart-icon">
    <!-- <a href="cart.php"><i class="fas fa-shopping-cart"></i> Cart </a> -->
</div>

<div class="container">

<section class="shopping-cart">

   <h1 class="heading">shopping cart</h1>

   <table>

      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
         <th>total price</th>
         <th>action</th>
      </thead>

      <tbody>

         <?php 
         $grand_total = 0;
         if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
            foreach($_SESSION['cart'] as $item){
               $sub_total = $item['price'] * $item['quantity'];
               $grand_total += $sub_total;
         ?>

         <tr>
            <td><img src="assets/<?php echo $item['image']; ?>" height="100" alt=""></td>
            <td><?php echo $item['name']; ?></td>
            <td>Rs. <?php echo number_format($item['price']); ?>/-</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id" value="<?php echo $item['id']; ?>" >
                  <input type="number" name="update_quantity" min="1" value="<?php echo $item['quantity']; ?>" >
                  <input type="submit" value="update" name="update_update_btn">
               </form>   
            </td>
            <td>Rs. <?php echo number_format($sub_total); ?>/-</td>
            <td><a href="cart.php?remove=<?php echo $item['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
         </tr>
         <?php
            }
         } else {
            echo "<tr><td colspan='6'>Your cart is empty!</td></tr>";
         }
         ?>
         <tr class="table-bottom">
            <td><a href="items.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
            <td colspan="3">grand total</td>
            <td>Rs. <?php echo number_format($grand_total); ?>/-</td>
            <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
         </tr>

      </tbody>

   </table>

   <div class="checkout-btn">
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
   </div>

</section>

</div>
   
<!-- custom js file link -->
<script src="script.js"></script>

</body>
</html>
