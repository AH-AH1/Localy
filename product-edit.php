<?php
session_start();
require_once "msg.php";
require_once "database.php";

if (isset($_GET['product_ID'])) {

    $productID = $_GET['product_ID'];
} else {

    $productID = null;
}

if (!is_numeric($productID)) {

    echo '<h5>' . $productID . '</h5>';

    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $productName = filter_input(INPUT_POST, "productName", FILTER_SANITIZE_SPECIAL_CHARS);

    $productCost = filter_input(INPUT_POST, "productCost", FILTER_SANITIZE_NUMBER_FLOAT);

    $productDescription = filter_input(INPUT_POST, "productDescription", FILTER_SANITIZE_SPECIAL_CHARS);

    $seller = mysqli_query($connection, "SELECT seller_ID FROM products WHERE product_ID = '$productID'");

    if (mysqli_num_rows($seller) > 0) {

        $row = mysqli_fetch_assoc($seller);

        $sellerID = $row['seller_ID'];
    }

    if (empty($productName) || empty($productDescription) || empty($productCost)) {

        redirect('products-edit.php?id=' . $productID, 'Please fill in all the input fields');
    } else {

        $update = mysqli_query($connection, "UPDATE products SET product_name = '$productName', product_description = '$productDescription', product_cost = '$productCost' WHERE product_ID = '$productID'");

        redirect('seller-dashboard.php', 'Product updated successfully');
    }
}

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
    </style>

</head>

<body>

    <?php include('header.php'); ?>

    <main>

        <section class="product">

            <div class="container">

                <?php

                $profile = mysqli_query($connection, "SELECT * FROM products WHERE product_ID = '$productID'");

                if (mysqli_num_rows($profile) > 0) {

                    $fetch = mysqli_fetch_assoc($profile);

                    $sellerID = $fetch['seller_ID'];
                } else {

                    echo "<p>Error retrieving profile. </p>";
                }

                ?>

                <?= alertFailMessage(); ?> <?= alertSuccessMessage(); ?>

                <h2 class="mb-4">Product Edit</h2>

                <form action="product-edit.php?product_ID=<?= $productID ?>" method="post" enctype="multipart/form-data">

                    <div class="row mb-4">

                        <div class="col-md-6">

                            <h4 class="mb-3">Product Information</h4>

                            <div class="mb-3">

                                <label class="form-label" for="productName">Product Name</label>

                                <input type="text" name="productName" id="productName" class="form-control" value="<?php echo htmlspecialchars($fetch['product_name']) ?>" />

                            </div>

                            <div class="mb-3">

                                <label for="productDescription" class="form-label">Product Description</label>

                                <textarea class="form-control" id="productDescription" name="productDescription" rows="3"><?php echo htmlspecialchars($fetch['product_description']) ?></textarea>

                            </div>

                            <div class="mb-3">

                                <label for="productCost" class="form-label">Price (R)</label>

                                <input type="number" class="form-control" id="productCost" name="productCost" min="0" value="<?php echo htmlspecialchars($fetch['product_cost']) ?>" />

                            </div>

                        </div>

                        <div class="col-md-6">

                            <h4>Change Product Image</h4>

                            <div class="mb-3">

                                <label for="productImage" class="form-label">Product Image</label>

                                <divcl>

                                    <img src="Images/<?= htmlspecialchars($fetch['product_image']) ?>" alt="Product Image" class="img-thumbnail mb-2" width="180" height="210" style="object-fit: cover;">

                                    <input type="file" class="form-control" name="productImage" id="productImage" accept="image/*">

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                        <button type="button" onclick="history.back()" class="btn btn-secondary me-md-2">Cancel</button>
                        <button type="submit" name="updateUser" class="btn btn-primary">Save Changes</button>

                    </div>

                </form>

            </div>

        </section>

    </main>

    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>