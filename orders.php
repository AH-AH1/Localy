<?php

session_start();

require_once "msg.php";

require_once "database.php";

if (!isset($_SESSION['user_ID']) && empty($_SESSION['user_ID'])) {

    header('location: login.php');

    exit();

} else {

    $userID = $_SESSION['user_ID'];

    if (isset($_POST['productID'])) {

        $productID = $_POST['productID'];
    } else {

        $productID = null;
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

        .orders {

            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);

            padding: 60px 0;

            position: relative;

            overflow: hidden;

        }

        .order-card:hover {

            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);

        }

        .order-img {

            width: 120px;

            height: 90px;

            object-fit: cover;

            border-radius: 10px;

        }

        .order-meta {

            font-size: 0.9rem;

            color: #666;

        }

        .total-label {

            color: #555;

        }

        .empty-state {

            padding: 2rem;

            text-align: center;

            color: #999;

        }
    </style>

</head>

<body>

    <?php include('header.php'); ?>

    <main>

        <section class="orders">

            <div class="container">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h1 class="text-3xl font-bold">Your Orders</h1>
                        <p class="text-gray-600 mt-1">View all your recently placed orders</p>

                    </div>

                </div>

                <div class="row">

                    <div class="col-lg-10 mx-auto">

                        <div class="card border-1 shadow-sm order-card">

                            <div class="card-header bg-white border-0">

                                <h5 class="mb-3">Recently Ordered Products</h5>

                            </div>

                            <div class="card-body">

                                <div class="listing">

                                    <?php
                                    $query = "SELECT s.store_name, p.product_image, p.product_name, o.order_quantity, o.order_price FROM orders o JOIN products p ON o.product_ID = p.product_ID JOIN sellers s ON p.seller_ID = s.seller_ID WHERE o.user_ID = '$userID' ORDER BY o.order_ID DESC";

                                    $result = mysqli_query($connection, $query);

                                    if (mysqli_num_rows($result) > 0) {

                                        while ($order = mysqli_fetch_assoc($result)) {

                                    ?>
                                            <div class="d-flex align-items-start mb-4 pb-3 border-bottom">

                                                <img src="Images/<?php echo htmlspecialchars($order['product_image']); ?>" alt="Product Image" class="order-img me-3">

                                                <div class="flex-grow-1">

                                                    <h6 class="mb-1"><?= htmlspecialchars($order['product_name']); ?></h6>

                                                    <p class="order-meta mb-1">Store: <?= htmlspecialchars($order['store_name']); ?></p>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>