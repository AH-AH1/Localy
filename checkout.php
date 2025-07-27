<?php

session_start();

require_once "msg.php";

require_once "database.php";

if (!isset($_SESSION['user_ID']) && empty($_SESSION['user_ID'])) {

    header('location: login.php');

    exit();
} else {

    if (isset($_POST['productID'])) {

        $productID = $_POST['productID'];
    } else {

        $productID = null;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["checkoutBtn"])) {

            $userID = $_SESSION['user_ID'];
            $productID = filter_input(INPUT_POST, "productID", FILTER_SANITIZE_NUMBER_INT);
            $quantity = filter_input(INPUT_POST, "quantity", FILTER_SANITIZE_NUMBER_INT);
            $total = filter_input(INPUT_POST, "total", FILTER_SANITIZE_NUMBER_FLOAT);

            $cardholder = filter_input(INPUT_POST, "cardholder", FILTER_SANITIZE_SPECIAL_CHARS);
            $cardNumber = filter_input(INPUT_POST, "cardNumber", FILTER_SANITIZE_NUMBER_INT);
            $cardExpire = filter_input(INPUT_POST, "cardExpire", FILTER_SANITIZE_SPECIAL_CHARS);
            $cardCvv = filter_input(INPUT_POST, "cardCvv", FILTER_SANITIZE_NUMBER_INT);

            $connection->query("INSERT INTO orders (user_ID, product_ID, order_quantity, order_price) VALUES ('$userID', '$productID', '$quantity','$total')");

            redirect('confirm.php', 'Order processed successfully');
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

        .h-custom {
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

        <section class="h-100 h-custom">

            <div class="container h-100">

                <div class="row d-flex justify-content-center align-items-center h-100">

                    <div class="col">

                        <div class="card">

                            <div class="card-body p-4">

                                <div class="row">

                                    <div class="col-lg-7">

                                        <h5 class="mb-3">

                                            <a href="product.php?product_ID=<?= $productID ?>" class="btn btn-danger">Change Order</a>

                                        </h5>

                                        <hr>

                                        <div class="d-flex justify-content-between align-items-center mb-4">

                                            <div>

                                                <p class="mb-1">Shopping cart</p>

                                            </div>

                                        </div>

                                        <div class="card mb-3">

                                            <?php

                                            if (isset($_POST['quantity'])) {

                                                $quantity = $_POST['quantity'];
                                            } else {

                                                $quantity = 1;
                                            }

                                            if (is_numeric($productID)) {

                                                $query = mysqli_query($connection, "SELECT * FROM products WHERE product_ID = '$productID'");

                                                $product = mysqli_fetch_assoc($query);

                                                if ($product) {

                                                    $subTotal = $product['product_cost'] * $quantity;
                                                } else {

                                                    redirect('checkout.php', 'Product not found.');
                                                }
                                            } else {

                                                redirect('checkout.php', $productID);
                                            }


                                            ?>

                                            <div class="card-body">

                                                <div class="d-flex justify-content-between">

                                                    <div class="d-flex flex-row align-items-center">

                                                        <div>

                                                            <img src="Images/<?php echo htmlspecialchars($product['product_image']); ?>" class="img-fluid rounded-3" alt="Product Image" width="120" height="90" style="object-fit: cover;" />

                                                        </div>

                                                        <div class="ms-3">

                                                            <h5 class="mb-1"><?= $product['product_name']; ?></h5>

                                                            <p class="mb-0">Price: R<?= $product['product_cost']; ?></p>

                                                        </div>

                                                    </div>

                                                    <div class="d-flex flex-row align-items-center">

                                                        <div style="margin-right: 60px;">

                                                            <h5 class="fw-normal mb-0">

                                                                <p class="small mb-0">Quantity: <?= $quantity ?></p>

                                                            </h5>

                                                        </div>

                                                        <div>

                                                            <h5 class="mb-0">

                                                                <p class="small mb-0">Total: R<?= $subTotal ?></p>

                                                            </h5>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-lg-5">

                                        <div class="card bg-light rounded-3">

                                            <div class="card-body">

                                                <div class="d-flex justify-content-between align-items-center mb-4">

                                                    <h5 class="mb-0">Card details</h5>

                                                </div>

                                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" id="registrationForm" class="mt-4">

                                                    <input type="hidden" name="productID" value="<?= $productID ?>">

                                                    <input type="hidden" name="quantity" value="<?= $quantity ?>">

                                                    <input type="hidden" name="total" value="<?= $subTotal ?>">

                                                    <div class="form-outline form-white mb-4">

                                                        <input type="text" id="cardholder" name="cardholder" class="form-control form-control-lg" size="17" placeholder="Cardholder's Name" required />

                                                        <label class="form-label" for="cardholder">Cardholder's Name</label>

                                                    </div>

                                                    <div class="form-outline form-white mb-4">

                                                        <input type="tel" id="cardNumber" name="cardNumber" class="form-control form-control-lg" size="17" placeholder="1234 5678 9012 3457" minlength="16" maxlength="16" required />

                                                        <label class="form-label" for="cardNumber">Card Number</label>

                                                    </div>

                                                    <div class="row mb-4">

                                                        <div class="col-md-6">

                                                            <div class="form-outline form-white">

                                                                <input type="text" id="cardExpire" name="cardExpire" class="form-control form-control-lg" placeholder="MM/YY" size="7" minlength="5" maxlength="5" required />

                                                                <label class="form-label" for="cardExpire">Expiration</label>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-6">

                                                            <div class="form-outline form-white">

                                                                <input type="password" id="cardCvv" name="cardCvv" class="form-control form-control-lg" placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" required />

                                                                <label class="form-label" for="cardCvv">Cvv</label>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <hr class="my-4">

                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-2">Total</p>
                                                        <p class="mb-2">R<?= $subTotal ?></p>
                                                    </div>

                                                    <button type="submit" name="checkoutBtn" class="btn btn-success btn-lg">

                                                        <div class="d-flex justify-content-between">

                                                            <span>Checkout</span>

                                                        </div>

                                                    </button>

                                                </form>

                                            </div>

                                        </div>

                                    </div>

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