<?php
include 'conn.php';

if(isset($_GET['Id'])) {
    $id = $_GET['Id'];
    $query = "DELETE FROM tblcard WHERE Id = $id";
    if(mysqli_query($conn, $query)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>