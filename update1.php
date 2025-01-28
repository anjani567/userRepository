<?php
include 'conn.php';
if (isset($_POST['update'])) {
    $ID = $_POST['Id'];
    $NAME = $_POST['name'];
    $PRICE = $_POST['price'];
    
    // Check if a new image is being uploaded
    if (!empty($_FILES['image']['name'])) 
    {
        $img_loc = $_FILES['image']['tmp_name'];
        $img_name = $_FILES['image']['name'];
        $img_des = "uploadImage/" . $img_name;
        
        // Move the uploaded image to its destination
        move_uploaded_file($img_loc, 'uploadImage/' . $img_name);
        
        // Update the image path in the database
        mysqli_query($conn, "UPDATE `tblcard` SET `Name`='$NAME', `Price`='$PRICE', `Image`='$img_des' WHERE `Id`='$ID'");
    } else {
        // No new image is being uploaded, update only the text and price
        mysqli_query($conn, "UPDATE `tblcard` SET `Name`='$NAME', `Price`='$PRICE' WHERE `Id`='$ID'");
    }

    header("location: adminDashboard.php");
}
?>