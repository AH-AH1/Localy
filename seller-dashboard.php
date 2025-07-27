<?php

session_start();

require_once "database.php";

require_once "msg.php";

if (!isset($_SESSION["seller_ID"])) {

    header("Location: seller-registration.php");

    exit();
}

$sellerID = $_SESSION['seller_ID'];

$count = 0;
$productCount = "SELECT COUNT(*) AS product_count FROM products WHERE seller_ID = '$sellerID'";
$result = mysqli_query($connection, $productCount);

if ($result && mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);

    $count = $row['product_count'];
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

        .dashboard {
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

        <section class="dashboard">

            <div class="container">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h1 class="mb-2">Seller Dashboard</h1>

                        <p class="text-muted large mb-3">Manage your products and store</p>

                    </div>

                </div>

                <div class="row g-4 mb-4 text-center">

                    <div class="col-12 col-lg-4">

                        <div class="card border-0 shadow-lg ">

                            <div class="card-header bg-white border-0">

                                <h5 class="mb-0">Quick Actions</h5>

                            </div>

                            <div class="card-body">

                                <div class="d-grid gap-2">

                                    <a href="product-upload.php" class="btn btn-outline-primary">

                                        <i class="fas fa-plus me-2"></i>Add Product

                                    </a>

                                    <a href="store-settings.php" class="btn btn-outline-success">

                                        <i class="fas fa-gear me-2"></i>Manage Store

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-12 col-md-6 col-lg-3">

                        <div class="card shadow-sm stat-card">

                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center">

                                    <div>

                                        <h6 class="text-muted mb-2">Total Product Listings</h6>

                                        <h3 class="mb-0 text-success"><?= $count ?></h3>

                                    </div>

                                    <div class="bg-primary bg-opacity-0 p-3 rounded">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" fill="white" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z" />
                                        </svg>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="row g-3">

                    <div class="col-12 col-lg-8">

                        <?= alertSuccessMessage(); ?> <?= alertFailMessage(); ?>

                        <div class="card border-0 shadow-lg">

                            <div class="card-header bg-white border-0">

                                <div class="d-flex justify-content-between align-items-center">

                                    <h5 class="mb-0">Recently Added Products</h5>

                                </div>

                            </div>

                            <div class="card-body">

                                <div class="listing">

                                    <?php

                                    $query = "SELECT * FROM products WHERE seller_ID = '$sellerID' ORDER BY product_ID  DESC";

                                    $result = mysqli_query($connection, $query);

                                    if (mysqli_num_rows($result) > 0) {

                                        while ($product = mysqli_fetch_assoc($result)) {

                                    ?>

                                            <div class="d-flex mb-3 align-items-start border-bottom pb-3">

                                                <div class="flex-shrink-0">

                                                    <div class="bg-primary bg-opacity-10 p-2 rounded">

                                                        <img src="Images/<?php echo htmlspecialchars($product['product_image']); ?>" alt="Product Image" width="120" height="90" style="object-fit: cover;" />

                                                    </div>

                                                </div>

                                                <div class="flex-grow-1 ms-3">

                                                    <h6 class="mb-1"><?= $product['product_name']; ?></h6>

                                                    <p class="text-success fw-bold mb-2">R<?= $product['product_cost']; ?></p>

                                                </div>

                                                <div class="d-flex gap-3">

                                                    <a href="product-edit.php?product_ID=<?= $product['product_ID'] ?>" class="btn btn-outline-primary float-end">Edit</a>

                                                    <a href="product-delete.php?product_ID=<?= $product['product_ID'] ?>" onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-danger float-end">Delete</a>


                                                </div>

                                            </div>

                                        <?php

                                        }
                                    } else {

                                        ?>

                                        <p class="mb-0">No Records Found</p>

                                    <?php

                                    }

                                    ?>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-12 col-lg-4">

                        <div class="card border-0 shadow-lg ">

                            <div class="card-header bg-white border-0">

                                <h5 class="mb-0">Incoming Orders</h5>

                            </div>

                            <div class="card-body">

                                <div class="d-grid border-black gap-2">

                                    <?php
                                    $query = "SELECT u.first_name, p.product_name, o.order_quantity, o.order_price FROM orders o JOIN products p ON o.product_ID = p.product_ID JOIN users u ON o.user_ID = u.user_ID WHERE p.seller_ID = '$sellerID' ORDER BY o.order_ID DESC";

                                    $result = mysqli_query($connection, $query);

                                    if (mysqli_num_rows($result) > 0) {

                                        while ($order = mysqli_fetch_assoc($result)) {

                                    ?>
                                            <div class="d-flex align-items-start mb-4 pb-3 border-bottom">

                                                <div class="flex-grow-1">

                                                    <h6 class="mb-1">Product: <?= htmlspecialchars($order['product_name']); ?></h6>

                                                    <p class="order-meta mb-1">Customer: <?= htmlspecialchars($order['first_name']); ?></p>

                                                    <p class="order-meta mb-0">Quantity: <?= $order['order_quantity'] ?> |
                                                        <span class="fw-bold total-label">Total: R<?= $order['order_price'] ?></span>
                                                    </p>

                                                </div>

                                            </div>
                                    <?php
                                        }
                                    } else {

                                        echo "No orders placed yet";

                                    }
                                    ?>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>

    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>