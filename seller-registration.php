<?php

session_start();

require_once "database.php";

require_once "msg.php";

if (!isset($_SESSION["user_ID"])) {

    header("Location: login.php");

    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $storeName = filter_input(INPUT_POST, "storeName", FILTER_SANITIZE_SPECIAL_CHARS);
    $storeDescription = filter_input(INPUT_POST, "storeDescription", FILTER_SANITIZE_SPECIAL_CHARS);
    $storeContact = filter_input(INPUT_POST, "storeContact", FILTER_SANITIZE_NUMBER_INT);
    $storeType = filter_input(INPUT_POST, "storeType", FILTER_SANITIZE_SPECIAL_CHARS);
    $storeLocation = filter_input(INPUT_POST, "storeLocation", FILTER_SANITIZE_SPECIAL_CHARS);

    $userID = $_SESSION["user_ID"];

    if (empty($storeName) || empty($storeDescription) || empty($storeContact) || empty($storeType) || empty($storeLocation)) {

        redirect('seller-registration.php', 'Please fill in all the input fields');
    } else {

        $checkAccount = $connection->query("SELECT * FROM sellers WHERE user_ID = '$userID'");

        if (mysqli_num_rows($checkAccount) > 0) {

            $row = mysqli_fetch_assoc($checkAccount);
            $_SESSION["seller_ID"] = $row["seller_ID"];

            redirect('seller-dashboard.php', 'You already have a seller account');
        } else {

            $connection->query("INSERT INTO sellers (user_ID, store_name, store_description, store_contact, store_type, store_location) VALUES ('$userID', '$storeName', '$storeDescription','$storeContact', '$storeType', '$storeLocation')");

            $_SESSION["seller_ID"] = $connection->insert_id;

            redirect('seller-dashboard.php', 'Seller account successfully created');
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

        .seller {

            padding: 60px 0;
            position: relative;
            overflow: hidden;
            z-index: 2;
            
        }

        .card {
            border-radius: 10px;
            max-width: 800px;
            margin: auto;
        }

        .card-body {
            padding: 2rem;
        }

        .card-title {
            margin-bottom: 1.5rem;
            color: #4caf50 !important;

        }

        .btn-primary {
            background-color: #4caf50 !important;
            border-color: rgba(76, 175, 79, 0.41) !important;
        }

        .btn-primary:hover {
            background-color: rgb(0, 137, 5) !important;
            border-color: rgba(76, 175, 79, 0.41) !important;
        }

        .form-control:invalid {
            border-color: #dc3545;
        }

        .form-text {
            color: rgb(150, 150, 150);
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .form-control.is-valid {
            border-color: #198754;
        }

        .form-control-feedback {
            display: none;
        }

        .form-control-feedback.show {
            display: block;
        }
    </style>

</head>

<body>

    <?php include('header.php'); ?>

    <main>

        <section class="seller">

            <div class="container">

                <div class="row justify-content-center">

                    <div class="col-lg-10 col-md-12 col-sm-12">

                        <div class="card shadow-lg">

                            <div class="card-body">

                                <h3 class="card-title text-center mb-4">Seller Registration Form</h3>

                                <p class="card-title text-center mb-4">Start you journey as a Localy seller</p>

                                <?= alertFailMessage(); ?>

                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" id="registrationForm">

                                    <div class="mb-3">

                                        <label for="storeName" class="form-label">Store Name</label>

                                        <input type="text" class="form-control" id="storeName" name="storeName" placeholder="Enter your store name" />

                                        <div class="form-text">This will be your public store name</div>

                                    </div>

                                    <div class="mb-3">

                                        <label for="storeDescription" class="form-label">Store Description</label>

                                        <textarea class="form-control" id="storeDescription" name="storeDescription" rows="3" placeholder="Tell customers about your store and what you sell"></textarea>

                                        <div class="form-text">Tell customers about your store and what you sell</div>

                                    </div>

                                    <div class="mb-3">

                                        <label for="storeContact" class="form-label">Phone Number</label>

                                        <input type="tel" class="form-control" id="storeContact" name="storeContact" placeholder="Enter your phone number" />

                                        <div class="form-text">Provide your contact details to customers</div>

                                    </div>

                                    <div class="mb-3">
                                        <label for="storeType" class="form-label">Category</label>

                                        <select id="storeType" name="storeType" class="form-select">
                                            <option disabled selected>Select your category</option>
                                            <option value="1">Vegetables</option>
                                            <option value="2">Fruit</option>
                                            <option value="3">Prepared Meat</option>
                                            <option value="4">Livestock</option>
                                            <option value="5">Groceries</option>
                                            <option value="6">Snacks</option>
                                            <option value="7">Takeaway/Fast Food</option>
                                            <option value="8">Tradiotional Meals</option>
                                            <option value="9">Beauty & Hair</option>
                                            <option value="10">Toiletries</option>
                                            <option value="11">Medicine & Herbs</option>
                                            <option value="12">Baby Products</option>
                                            <option value="13">Clothes</option>
                                            <option value="14">Arts & Crafts</option>
                                            <option value="15">Other</option>
                                        </select>

                                    </div>

                                    <div class="mb-3">

                                        <label for="storeLocation" class="form-label">Location</label>

                                        <select id="storeLocation" name="storeLocation" class="form-select">
                                            <option disabled selected>Select your location</option>
                                            <option disabled>Paarl</option>
                                            <option value="1">&nbsp;&nbsp;&nbsp;&nbsp;Klein Drakenstein Road</option>
                                            <option value="2">&nbsp;&nbsp;&nbsp;&nbsp;Lady Grey Street</option>
                                            <option value="3">&nbsp;&nbsp;&nbsp;&nbsp;New Street</option>
                                            <option value="4">&nbsp;&nbsp;&nbsp;&nbsp;Paarl East</option>
                                            <option disabled>Mbekweni</option>
                                            <option value="5">&nbsp;&nbsp;&nbsp;&nbsp;Donkervliet Street</option>
                                            <option value="6">&nbsp;&nbsp;&nbsp;&nbsp;Wamkelekile Street</option>
                                            <option value="7">&nbsp;&nbsp;&nbsp;&nbsp;Mohajane Street</option>
                                            <option value="8">&nbsp;&nbsp;&nbsp;&nbsp;Phokeng Street</option>
                                            <option value="9">&nbsp;&nbsp;&nbsp;&nbsp;Ntshamba Street</option>
                                            <option disabled>Groenheuwel</option>
                                            <option value="10">&nbsp;&nbsp;&nbsp;&nbsp;Bartolomeu Street</option>
                                            <option disabled>New Orleans</option>
                                            <option value="11">&nbsp;&nbsp;&nbsp;&nbsp;Springbok Street</option>
                                            <option disabled>Wellington</option>
                                            <option value="12">&nbsp;&nbsp;&nbsp;&nbsp;Market/Melling Street</option>
                                            <option value="13">&nbsp;&nbsp;&nbsp;&nbsp;Hoofweg Road</option>
                                            <option value="14">&nbsp;&nbsp;&nbsp;&nbsp;Church Street</option>
                                            <option disabled>Bellville</option>
                                            <option value="15">&nbsp;&nbsp;&nbsp;&nbsp;Bellville CBD</option>

                                        </select>

                                    </div>

                                    <div class="mb-3">

                                        <div class="card-body">

                                            <h4 class="card-title mb-3 text-primary">Seller Requirements</h4>

                                            <ul class="list-unstyled">

                                                <li class="d-flex align-items-start mb-3">

                                                    <div class="me-3">

                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="green" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                            <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                                                        </svg>

                                                    </div>

                                                    <p class="mb-0">High quality product imaes and descriptions</p>

                                                </li>

                                                <li class="d-flex align-items-start mb-3">

                                                    <div class="me-3">

                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="green" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                            <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                                                        </svg>

                                                    </div>

                                                    <p class="mb-0">Order fulfillment and fast delivery</p>

                                                </li>

                                                <li class="d-flex align-items-start mb-3">

                                                    <div class="me-3">

                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="green" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                            <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                                                        </svg>

                                                    </div>

                                                    <p class="mb-0">Professional customer care</p>

                                                </li>

                                            </ul>

                                        </div>

                                    </div>

                                    <div class="text-center py-4">

                                        <button type="submit" name="sellerAccountBtn" id="sellerAccountBtn" class="btn btn-primary btn-lg">Create Seller Acount</button>
                                        <div id="formFeedback" class="mt-3">

                                            <p class="small text-muted">

                                                By clicking <strong>Create Seller Account</strong>, you agree to our <a href="" class="text-decoration-underline">Terms of Service</a> and <a href="" class="text-decoration-underline">Seller Guidelines</a> and confirm that you are over 18 years of age.

                                            </p>

                                        </div>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>

    <hr>

    <?php include('footer.php'); ?>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>