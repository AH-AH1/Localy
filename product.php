<?php
require_once "database.php";

if (!isset($_GET["product_ID"])) {
    echo "Product not found";
    exit();
}

$productID = $_GET["product_ID"];

$display = "
    SELECT
        p.product_name,
        p.product_cost,
        p.product_description,
        p.product_image,
        s.store_name,
        s.store_contact
    FROM products p
    JOIN sellers s ON p.seller_ID = s.seller_ID
    WHERE p.product_ID = '$productID'
";

$result = mysqli_query($connection, $display);
$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <style>
        body {
            background-color: #ffffff;
            min-height: 100vh;
            padding: 40px 0;
        }

        main {

            font-family: Arial, Helvetica, sans-serif;

        }

        .product {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }

        .nav-link {
            padding: 0.5rem 1rem;
        }


        .product-image {
            max-height: 400px;
            object-fit: cover;
        }

        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.3s ease;
        }

        .thumbnail:hover,
        .thumbnail.active {
            opacity: 1;
        }
    </style>

</head>

<body>

    <?php include('header.php'); ?>

    <main>

        <section class="product">

            <div class="container mt-5">

                <?php

                if (mysqli_num_rows($result) > 0): ?>

                    <div class="row">

                        <div class="col-md-5 mb-4">

                            <img src="Images/<?php echo htmlspecialchars($product['product_image']); ?>" alt="Product" class="img-fluid rounded mb-3 product-image" id="mainImage">

                        </div>

                        <div class="col-md-6">
                            <a href="shop.php" class="btn btn-danger mb-5">Back</a>
                            <h1 class="mb-3"><?php echo htmlspecialchars($product['product_name']); ?></h1>
                            <h6 class="mb-4">Sold by: <?php echo htmlspecialchars($product['store_name']); ?></h6>
                            <h6 class="mb-3">Contact: <?php echo htmlspecialchars($product['store_contact']); ?></h6>
                            <div class="mb-3">

                                <span class="h4 me-2">R<?php echo number_format($product['product_cost']); ?></span>

                            </div>

                            <p class="mb-4"><?php echo htmlspecialchars($product['product_description']); ?></p>

                            <form action="checkout.php" method="post">

                                <input type="hidden" name="productID" value="<?= $productID ?>" required />

                                <div class="mb-4">

                                    <label for="quantity" class="form-label">Quantity:</label>

                                    <input type="number" class="form-control" name="quantity" id="quantity" value="1" min="1" max="30" style="width: 80px;">

                                </div>

                                <button type="submit" class="btn btn-primary btn-lg mb-3 me-2" name="buyBtn">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="30" fill="currentColor"
                                        class="bi bi-bag-plus" viewBox="0 3 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5" />
                                        <path
                                            d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                                    </svg> &nbsp;Buy

                                </button>

                            </form>

                        </div>

                    </div>

                <?php else: ?>

                    <p>Product not found</p>

                <?php endif; ?>

            </div>

        </section>

    </main>

    <?php include('footer.php'); ?>


    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>