<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="style.css">
    <title>View Cart</title>
    
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        header {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
        }

        nav a {
            color: #333;
            text-decoration: none;
            font-size: 1.1rem;
            margin-left: 15px;
        }

        nav a:hover {
            color: #16a085;
        }

        nav .logo img {
            height: 75px;
        }

        /* Cart Container */
        .container-fluid {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 2.5rem;
        }

        /* Table Styling */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .table th, .table td {
            padding: 15px;
            text-align: center;
        }

        .table th {
            background-color: #16a085;
            color: #fff;
            font-size: 1.2rem;
        }

        .table td {
            font-size: 1rem;
            color: #333;
        }

        .table img {
            width: 80px;
            height: 80px; /* Set a fixed height */
            object-fit: cover; /* Ensures image covers the box without distortion */
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .table img:hover {
            transform: scale(1.1);
        }

        /* Alternating Row Colors */
        .table tr:nth-child(even) {
            background-color: #ecf0f1;
        }

        .table tr:hover {
            background-color: #f4f9f9;
        }

        /* Button Styles */
        .btn-danger {
            padding: 8px 15px;
            background-color: #e74c3c;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c0392b;
        }

        /* Small button for checkout */
        .btn-checkout {
            padding: 8px 15px; /* Match the delete button's padding */
            background-color: #16a085; /* Match the theme color */
            color: #fff;
            margin: 20px auto; /* Add margin to center the button */
            display: block; /* Ensure button takes the full width */
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 0.9rem; /* Same font size */
            transition: background-color 0.3s ease;
        }

        .btn-checkout:hover {
            background-color: #149174; /* Darker shade on hover */
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .table img {
                width: 60px;
                height: 60px; /* Adjust height for smaller screens */
            }

            .table th, .table td {
                padding: 10px;
            }

            h1 {
                font-size: 2rem;
            }

            nav a {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            nav {
                flex-direction: column;
                align-items: flex-start;
            }

            .table {
                font-size: 0.8rem;
            }

            h1 {
                font-size: 1.8rem;
            }
        }

    </style>
</head>
<body>

<!-- Nav bar Start -->
<div>
    <header>
        <nav class="nav">
            <a href="home.html" class="logo"><img src="image/logo1.jpeg" alt="Logo"></a>
            <div class="nav__link hide">
                  <a style="font-size: 20px !important;" href="home2.php">Home</a>
                  <a style="font-size: 20px !important;" href="about.php">About</a>
                  <a style="font-size: 20px !important;" href="contact.php">Contact</a>
                  <a style="font-size: 20px !important;" href="herbal.php">Ayurvedic</a>
              </div>
              <div>
                <a style="font-size: 20px !important;" href="logout.php">Log Out</a>
              </div>
        </nav>
    </header>
</div>
<!-- Nav Bar End -->

<!-- Cart Section Start -->
<div class="container-fluid">
    <h1>My Cart</h1>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead class="bg-color">
                    <th>Index No.</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Product Total Price</th>
                    <th>Delete</th>
                </thead>
                
                <tbody>
                <?php
                include 'conn.php';  // Include your database connection file

                // Query to fetch data from addtocard table
                $cart_query = "SELECT * FROM addtocard";
                $result = $conn->query($cart_query);

                if ($result && $result->num_rows > 0) {
                    $index = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <form action='remove_from_card.php' method='POST'>
                            <tr>
                                <td>{$index}</td>
                                <td><img src='{$row['image']}' alt='Product Image'></td>
                                <td>{$row['name']}</td>
                                <td>{$row['price']}</td>
                                <td>{$row['quantity']}</td>
                                <td>{$row['total_price']}</td>
                                <td>
                                    <input type='hidden' name='product_id' value='{$row['id']}'>
                                    <button name='remove' class='btn-danger' type='submit'>Delete</button>
                                </td>
                            </tr>
                        </form>";
                        $index++;
                    }
                } else {
                    echo "<tr><td colspan='7'>Your cart is empty.</td></tr>";
                }

                // Close the connection
                $conn->close();
                ?>
                </tbody>
            </table>

            <!-- Proceed to Checkout Button -->
            <?php if ($result && $result->num_rows > 0): ?>
                <div style="text-align: right; margin-top: 20px;">
                    <form action="checkorder.php" method="POST">
                        <button type="submit" class="btn-checkout">
                            Proceed to Checkout
                        </button>
                    </form>
                </div>
            <?php endif; ?> 

        </div>
    </div>
</div>
<!-- Cart Section End -->

</body>
</html>
