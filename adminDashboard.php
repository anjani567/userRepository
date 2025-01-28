<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .header a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
        }
        .header a:hover {
            text-decoration: underline;
        }
        .content {
            padding: 20px;
        }
        .content h2 {
            margin-bottom: 20px;
        }
        table img {
            width: 100px;
            height: auto;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="header">
        <h1>Admin Dashboard</h1>
        <a href="uploadproduct.php">Upload Product</a>
    </div>
    
    <div class="content">
        <h2>Product List</h2>

        <!-- Product Table -->
        <div class="container">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Products</th>
                        <th>Category</th> <!-- Category Column -->
                        <th>Delete</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'conn.php';
                    $query = mysqli_query($conn, "SELECT * FROM tblcard");
                    while($row = mysqli_fetch_array($query)){
                        echo "
                            <tr>
                                <td>{$row['Id']}</td>
                                <td>{$row['Name']}</td>
                                <td>{$row['Price']}</td>
                                <td><img src='" . $row['Image'] . "' alt='Product Image' style='width:100px; height:auto;'></td>
                                <td>{$row['descriptions']}</td>
                                <td>{$row['products']}</td>
                                <td>{$row['category']}</td> <!-- Display Category -->
                                <td><a href='#' class='btn btn-danger delete-btn' data-id='{$row['Id']}'>Delete</a></td>
                                <td><a href='update.php?Id={$row['Id']}' class='btn btn-primary'>Update</a></td>
                            </tr>
                        ";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('.delete-btn').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            if(confirm('Are you sure you want to delete this product?')) {
                $.ajax({
                    url: 'delete.php',
                    type: 'GET',
                    data: {Id: id},
                    success: function(response) {
                        if(response == 'success') {
                            $(e.target).closest('tr').remove();
                        } else {
                            alert('Error deleting product');
                        }
                    }
                });
            }
        });
    });
    </script>

</body>
</html>
