<?php
include 'conn.php';

function getRecommendedProducts($conn, $category, $currentProductId, $currentPrice, $limit = 5) {
    $query = mysqli_query($conn, "SELECT *, 
                            ABS(Price - $currentPrice) as price_diff,
                            (SELECT COUNT(*) FROM orders WHERE Id = tblcard.Id) as popularity
                            FROM tblcard
                            WHERE category = '$category' AND Id != '$currentProductId'
                            ORDER BY popularity DESC, price_diff ASC
                            LIMIT $limit");

    if (!$query) {
        die("Query failed: " . mysqli_error($conn));
    }

    $recommendations = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $recommendations[] = $row;
    }

    return $recommendations;
}

$category = isset($_GET['category']) ? $_GET['category'] : '';
$productId = isset($_GET['product_id']) ? $_GET['product_id'] : '';
$price = isset($_GET['price']) ? floatval($_GET['price']) : 0;

if ($category && $productId && $price) {
    $recommendations = getRecommendedProducts($conn, $category, $productId, $price);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommended Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="css/style.css" />
    <style>
        /* Global Styles */
        body {
            background-color: #f4f4f9;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
        }

        h2 {
            font-size: 2.5rem;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .product {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 30px;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        .product img {
            max-width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .product:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .product h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #2c3e50;
            font-weight: bold;
        }

        .product-description {
            font-size: 3.1rem;
            color: #666;
            margin-bottom: 15px;
            height: 40px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product p {
            margin-bottom: 10px;
            font-size: 2.1rem;
        }

        /* Name Styling */
        .product h3 {
            font-size: 2.1rem;
            color: #00796b;
            font-weight: 700;
        }

        /* Price Styling */
        .product .price {
            font-size: 2.1rem;
            color: #black;
            font-weight: bold;
        }

        /* Popularity Styling */
        .product .popularity {
            font-size: 2.1rem;
            color: #black;
            margin-bottom: 10px;
        }

        /* Similarity Styling */
        .product .similarity {
            font-size: 2.1rem;
            font-weight: bold;
            color: black;
            background-color: #e8f5e9;
            padding: 5px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 5px;
        }

        /* Footer Styles */
        footer {
            margin-top: 40px;
            padding: 20px 0;
            background-color: #00796b;
            color: #fff;
            text-align: center;
        }
    </style>
</head>
<body>

<div style="background-color: rgba(97, 228, 228, 0.555); border: 1px solid; padding: 10px; box-shadow: 5px 8px 8px 25px #a2a1a1;">
        <header id="my_header">
            <nav class="nav">
              <a href="home.html" class="logo"><img src="image/logo1.jpeg" style="height: 75px;"></a>

              <div class="hamburger">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
              </div>

              <div class="nav__link hide">
                  <a style="font-size: 20px !important;" href="home2.php">Home</a>
                  <a style="font-size: 20px !important;" href="about.php">About</a>
                  <a style="font-size: 20px !important;" href="contact.php">Contact</a>
                  <a style="font-size: 20px !important;" href="herbal.php">Ayurvedic</a>
              </div>

              <div>
                <a style="font-size: 20px !important;" href="logout.php">logout</a>
              </div>
            </nav>
        </header>
</div>

    <div class="container">
        <h2>Recommended Ayurvedic Products in <?= htmlspecialchars($category) ?></h2>
        <div class="row">
            <?php foreach ($recommendations as $row): 
                $similarityScore = 100 - (abs($row['Price'] - $price) / $price * 100);
            ?>
                <div class="col-md-4">
                    <div class="product">
                        <img src="<?= htmlspecialchars($row['Image']) ?>" alt="<?= htmlspecialchars($row['Name']) ?>">
                        <h3><?= htmlspecialchars($row['Name']) ?></h3>
                        <p class="product-description"><?= htmlspecialchars($row['descriptions']) ?></p>
                        <p class="price">Price: <?= htmlspecialchars($row['Price']) ?></p>
                        <p class="similarity">Similarity: <?= number_format($similarityScore, 2) ?>%</p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
} else {
    echo "<p>Insufficient parameters for recommendations.</p>";
}
?>
