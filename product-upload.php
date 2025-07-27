<?php

session_start();

require_once "database.php";

require_once "msg.php";

if (!isset($_SESSION["seller_ID"])) {

    header("Location: seller-registration.php");

    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $productName = filter_input(INPUT_POST, "productName", FILTER_SANITIZE_SPECIAL_CHARS);
    $productCost = filter_input(INPUT_POST, "productCost", FILTER_SANITIZE_NUMBER_FLOAT);
    $productDescription = filter_input(INPUT_POST, "productDescription", FILTER_SANITIZE_SPECIAL_CHARS);


    $sellerID = $_SESSION["seller_ID"];

    if (empty($productName) || empty($productCost) || empty($productDescription)) {

        redirect('product-upload.php', 'Please fill in all the input fields');
    } else {

        $imageName = $_FILES['productImage']['name'];
        $tempName = $_FILES['productImage']['tmp_name'];

        $target_dir = "Images/";
        $target_file = $target_dir . $imageName;

        $connection->query("INSERT INTO products (seller_ID, product_name, product_cost, product_description, product_image) VALUES ('$sellerID', '$productName', '$productCost', '$productDescription', '$imageName')");

        if (move_uploaded_file($tempName, $target_file)) {

            redirect('seller-dashboard.php', 'Product successfully added');
        } else {

            redirect('product-upload.php', 'The image failed to upload');
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

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

        .card {
            border-radius: 12px;
            background-color: white;
        }

        .btn-primary {
            background-color: #4caf50;
            border: none;
        }

        .btn-primary:hover {
            background-color: #277a29;
        }

        .back-btn {

            margin-bottom: 21px;
            color: #4caf50;
            font-weight: bold;
            text-decoration: none;
            display: inline-flex;
            align-items: center;

        }

        form-label {

            font-weight: bold;

        }

        .form-text {
            color: #333333;
            font-size: 1rem;
        }
    </style>

</head>

<body>

    <?php include('header.php'); ?>

    <main>

        <section class="product">

            <div class="container">

                <div class="row justify-content-center">

                    <div class="col-lg-10 col-md-12">

                        <a href="seller-dashboard.php" class="back-btn">Back</a>

                        <div class="card shadow-lg p-4">

                            <h2 class="text-center mb-2">Add Your Product</h2>

                            <p class="text-center mb-4">Start you journey as a Localy seller</p>

                            <?= alertFailMessage(); ?>

                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" id="registrationForm" enctype="multipart/form-data">

                                <div class="mb-3">

                                    <label for="productName" class="form-label">Product Name</label>

                                    <input type="text" class="form-control" id="productName" name="productName" />

                                </div>

                                <div class="mb-3">

                                    <label for="productDescription" class="form-label">Product Description</label>

                                    <textarea class="form-control" id="productDescription" name="productDescription" rows="3"></textarea>

                                </div>

                                <div class="mb-3">

                                    <label for="productCost" class="form-label">Price</label>

                                    <input type="number" class="form-control" id="productCost" name="productCost" min="0" placeholder="R0" />

                                </div>

                                <div class="mb-3">

                                    <label for="productImage" class="form-label">Product Images</label>

                                    <input type="file" class="form-control" name="productImage" id="productImage" accept="image/*">

                                </div>

                                <div class="pt-3">

                                    <button type="submit" name="productAddBtn" id="productAddBtn" class="btn btn-primary btn-lg">Add Product</button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>

    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>