<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Upload and Management</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .main {
            margin-top: 50px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            max-width: 400px; /* Reduced width for a smaller form */
            margin: 0 auto; /* Center the form */
        }

        .main label {
            font-weight: bold;
            margin-top: 10px;
            display: inline-block;
            width: 100px;
        }

        .main input[type="text"],
        .main input[type="file"] {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .main button {
            background-color: #4a90e2;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .main button:hover {
            background-color: #357abd;
        }

        .container {
            margin-top: 50px;
        }

        .table img {
            object-fit: cover;
            width: 100px;
            height: 70px;
            border-radius: 5px;
        }

        .btn-update {
            background-color: #28a745;
            color: white;
        }

        .btn-update:hover {
            background-color: #218838;
        }
    </style>

</head>
<body>

    <div class="container text-center">
        <div class="main">
            <h2>Upload Product</h2>
            <form action="insert.php" method="POST" enctype="multipart/form-data">
                <label for="">Name:</label>
                <input type="text" name="name" required><br>
                <label for="">Price :</label>
                <input type="text" name="price" id="" required><br>
                <label for="">Image:</label>
                <input type="file" name="image" id="" required><br>
                <label for="">Descriptions :</label>
                <input type="text" name="descriptions" id="" required><br>
                <label for="">Products :</label>
                <input type="text" name="products" id="" required><br>
                <button type="submit" name="upload">Upload</button>
            </form>
        </div>
    </div>

    <!-- Fetch Data -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Product List</h2>

        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Image</th>
                    <th scope="col">Descriptions</th>
                    <th scope="col">Products</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'conn.php';
                $pic = mysqli_query($conn, "SELECT * FROM `tblcard`");
                while ($row = mysqli_fetch_array($pic)) {
                    echo "
                    <tr>
                        <td>{$row['Id']}</td>
                        <td>{$row['Name']}</td>
                        <td>{$row['Price']}</td>
                        <td><img src='{$row['Image']}' alt='Product Image'></td>
                        <td>{$row['descriptions']}</td>
                        <td>{$row['products']}</td>
                        <td><a href='delete.php?Id={$row['Id']}' class='btn btn-danger'>Delete</a></td>
                        <td><a href='update.php?Id={$row['Id']}' class='btn btn-update'>Update</a></td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1BXXqnn5Q5Mr5M1xLddFy8sw87qpVhFbvv8/oklTInD+9pZicVn/wxzTGy9CI3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0z8qTrXZBecEPFsmJAKeA/EOyXic2nZfkho74kKeh4Z1fDuxWEAAhff+77Kbsaw" crossorigin="anonymous"></script>

</body>
</html>
