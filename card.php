<?php

session_start();
// session_destroy();
// if($_SERVER["REQUEST_METHOD"]=="POST")
// {
    if (isset($_POST['cart'])) 
    {

        $product_name = $_POST['Item_Name'];
        $product_price = $_POST['Price'];
        $product_image = $_POST['Image'];
        $_SESSION['cart'][]=array('productImage'=>$product_image ,'productName'=>$product_name,'productPrice'=>$product_price);
        // print_r($_SESSION['cart']);
        header("location:viewCard.php");

    }
// }
    //remove cart
    if(isset($_POST['remove'])){
        foreach($_SESSION['cart'] as $key => $value){
            if($value['productName'] === $_POST['item']){
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                header("location:viewCard.php");
            }
        }
    }
?>
