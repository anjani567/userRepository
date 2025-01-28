<?php
require 'config.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $pname = $row['product_name'];
    $price = $row['product_price'];
    $delivery_charge = $row['delivery_charge'];
    $total_price = $price + $delivery_charge;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete your Order</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-5">
                <h2 class="text-center p-2 text-primary">Fill the details to complete your order</h2>
                <h3>Product Details:</h3>
                <table class="table table-bordered" width="500px">
                    <tr>
                        <th>Product Name:</th>
                        <td><?php echo $pname; ?></td>
                    </tr>
                    <tr>
                        <th>Product Price:</th>
                        <td><?php echo $price; ?></td>
                    </tr>
                    <tr>
                        <th>Delivery charge:</th>
                        <td><?php echo $delivery_charge; ?></td>
                    </tr>
                    <tr>
                        <th>Total Price:</th>
                        <td><?php echo $total_price; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>