<?php
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST['name'])) {
        $errors[] = "Name is required";
    }

    // Validate price
    if (empty($_POST['price'])) {
        $errors[] = "Price is required";
    } elseif (!is_numeric($_POST['price'])) {
        $errors[] = "Price must be a number";
    }

    // Validate image
    if (empty($_FILES['image']['name'])) {
        $errors[] = "Image is required";
    } else {
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($file_extension, $allowed_extensions)) {
            $errors[] = "Invalid image format. Allowed formats: jpg, jpeg, png, gif";
        }
    }

    // Validate descriptions
    if (empty($_POST['descriptions'])) {
        $errors[] = "Description is required";
    }

    // Validate products
    if (empty($_POST['products'])) {
        $errors[] = "Products field is required";
    }

    // Validate category
    if (empty($_POST['category'])) {
        $errors[] = "Category is required";
    }

    // If no errors, process the form
    if (empty($errors)) {
        include 'conn.php';  // Include your database connection file

        // Prepare the image for upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        // Use the relative path when inserting into the database
        $image_path = $target_file;
        
        // Insert the product into the database
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $descriptions = mysqli_real_escape_string($conn, $_POST['descriptions']);
        $products = mysqli_real_escape_string($conn, $_POST['products']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);

        $query = "INSERT INTO tblcard (Name, Price, Image, descriptions, products, category) 
                  VALUES ('$name', '$price', '$image_path', '$descriptions', '$products', '$category')";

        if(mysqli_query($conn, $query)) {
            // Successful insertion
            header("Location: adminDashboard.php");
            exit();
        } else {
            $errors[] = "Error uploading product: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Upload</title>

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
    </style>
</head>
<body>

    <div class="container text-center">
        <div class="main">
            <h2>Upload Product</h2>
            <div class="nav__link hide">
                <a style="font-size: 20px !important;" href="adminDashboard.php">admin</a>
            </div>
            <?php
            if (!empty($errors)) {
                echo "<div class='alert alert-danger'>";
                foreach ($errors as $error) {
                    echo "<p>$error</p>";
                }
                echo "</div>";
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required><br>
                
                <label for="price">Price:</label>
                <input type="text" name="price" value="<?php echo isset($_POST['price']) ? htmlspecialchars($_POST['price']) : ''; ?>" required><br>
                
                <label for="image">Image:</label>
                <input type="file" name="image" required><br>
                
                <label for="descriptions">Descriptions:</label>
                <input type="text" name="descriptions" value="<?php echo isset($_POST['descriptions']) ? htmlspecialchars($_POST['descriptions']) : ''; ?>" required><br>
                
                <label for="products">Products:</label>
                <input type="text" name="products" value="<?php echo isset($_POST['products']) ? htmlspecialchars($_POST['products']) : ''; ?>" required><br>

                <label for="category">Category:</label>
                <input type="text" name="category" value="<?php echo isset($_POST['category']) ? htmlspecialchars($_POST['category']) : ''; ?>" required><br>
                
                <button type="submit" name="upload">Upload</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1BXXqnn5Q5Mr5M1xLddFy8sw87qpVhFbvv8/oklTInD+9pZicVn/wxzTGy9CI3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0z8qTrXZBecEPFsmJAKeA/EOyXic2nZfkho74kKeh4Z1fDuxWEAAhff+77Kbsaw" crossorigin="anonymous"></script>

</body>
</html>
