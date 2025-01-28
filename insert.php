<?php
// include db connection
include 'conn.php';

if(isset($_POST['upload'])){
    $NAME = $_POST['name'];
    $PRICE = $_POST['price'];
    $IMAGE = $_FILES['image'];
    $img_loc = $_FILES['image']['tmp_name'];
    $img_name = $_FILES['image']['name'];
    $img_des = "uploadImage/".$img_name;
    move_uploaded_file($img_loc,'uploadImage/'.$img_name);

    $DESCRIPTIONS = $_POST['descriptions'];
    $PRODUCTS = $_POST['products'];

    // insert data

    mysqli_query($conn,"INSERT INTO `tblcard`( `Name`, `Price`, `Image`, `descriptions`, `products`) VALUES ('$NAME','$PRICE','$img_des', '$DESCRIPTIONS', '$PRODUCTS')");
    if($query_run)
    {
        // Product uploaded successfully
        header("Location: adminDashboard.php");
        exit();
    }

}

?>