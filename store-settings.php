<?php

session_start();

require_once "msg.php";

require_once "database.php";

if (!isset($_SESSION['seller_ID'])) {
    header("Location: seller-registration.php");
    exit();
}

$sellerID = $_SESSION['seller_ID'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $storeNameUpdate = filter_input(INPUT_POST, "storeNameUpdate", FILTER_SANITIZE_SPECIAL_CHARS);
    $storeDescriptionUpdate = filter_input(INPUT_POST, "storeDescriptionUpdate", FILTER_SANITIZE_SPECIAL_CHARS);
    $storeContactUpdate = filter_input(INPUT_POST, "storeContactUpdate", FILTER_SANITIZE_NUMBER_INT);
    $storeTypeUpdate = filter_input(INPUT_POST, "storeTypeUpdate", FILTER_SANITIZE_SPECIAL_CHARS);
    $storeLocationUpdate = filter_input(INPUT_POST, "storeLocationUpdate", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($storeNameUpdate) || empty($storeDescriptionUpdate) || empty($storeContactUpdate) || empty($storeTypeUpdate) || empty($storeLocationUpdate)) {

        redirect('store-settings.php', 'Please fill in all the input fields');
    } else {

        $update = mysqli_query($connection, "UPDATE sellers SET store_name = '$storeNameUpdate', store_description = '$storeDescriptionUpdate', store_contact = '$storeContactUpdate', store_type = '$storeTypeUpdate', store_location = '$storeLocationUpdate' WHERE seller_ID = '$sellerID'");

        $store = mysqli_query($connection, "SELECT * FROM sellers WHERE seller_ID = '$sellerID'");

        redirect('store-settings.php', 'Store updated successfully');

        if (mysqli_num_rows($store) > 0) {

            $fetch = mysqli_fetch_assoc($store);
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

        .store {
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

        <section class="store">

            <div class="container">

                <?php

                $profile = mysqli_query($connection, "SELECT * FROM sellers WHERE seller_ID = '$sellerID'");

                if (mysqli_num_rows($profile) > 0) {

                    $fetch = mysqli_fetch_assoc($profile);
                } else {

                    echo "<p>Error retrieving profile. </p>";
                }

                ?>

                <?= alertFailMessage(); ?> <?= alertSuccessMessage(); ?>

                <h2 class="mb-4">Store Settings</h2>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">

                    <div class="row mb-4">

                        <div class="col-md-6">

                            <h4 class="mb-3">Seller Information</h4>

                            <div class="mb-3">

                                <label for="storeNameUpdate" class="form-label">Store Name</label>

                                <input type="text" class="form-control" id="storeNameUpdate" name="storeNameUpdate" value="<?php echo htmlspecialchars($fetch['store_name']) ?>" />

                            </div>

                            <div class="mb-3">

                                <label for="storeDescriptionUpdate" class="form-label">Store Description</label>

                                <textarea class="form-control" id="storeDescriptionUpdate" name="storeDescriptionUpdate" rows="3"><?php echo htmlspecialchars($fetch['store_description']) ?></textarea>

                            </div>

                            <div class="mb-3">

                                <label for="storeContactUpdate" class="form-label">Phone Number</label>

                                <input type="tel" class="form-control" id="storeContactUpdate" name="storeContactUpdate" value="<?php echo htmlspecialchars($fetch['store_contact']) ?>" />

                            </div>

                            <div class="mb-3">

                                <label for="storeTypeUpdate" class="form-label">Category</label>

                                <select id="storeTypeUpdate" name="storeTypeUpdate" class="form-select">

                                    <option value="Vegetables" <?= $fetch['store_type'] == 'Vegetables' ? 'selected' : '' ?>>Vegetables</option>

                                    <option value="Fruits" <?= $fetch['store_type'] == 'Fruits' ? 'selected' : '' ?>>Fruits</option>

                                    <option value="Prepared Meat" <?= $fetch['store_type'] == 'Prepared Meat' ? 'selected' : '' ?>>Prepared Meat</option>

                                    <option value="Livestock" <?= $fetch['store_type'] == 'Livestock' ? 'selected' : '' ?>>Livestock</option>

                                    <option value="Groceries" <?= $fetch['store_type'] == 'Groceries' ? 'selected' : '' ?>>Groceries</option>

                                    <option value="Snacks" <?= $fetch['store_type'] == 'Snacks' ? 'selected' : '' ?>>Snacks</option>

                                    <option value="Takeaway/Fast Food" <?= $fetch['store_type'] == 'Takeaway/Fast Food' ? 'selected' : '' ?>>Takeaway/Fast Food</option>

                                    <option value="Traditional Meals" <?= $fetch['store_type'] == 'Traditional Meals' ? 'selected' : '' ?>>Traditional Meals</option>

                                    <option value="Beauty and Hair" <?= $fetch['store_type'] == 'Beauty and Hair' ? 'selected' : '' ?>>Beauty and Hair</option>

                                    <option value="Toiletries" <?= $fetch['store_type'] == 'Toiletries' ? 'selected' : '' ?>>Toiletries</option>

                                    <option value="Medicine and Herbs" <?= $fetch['store_type'] == 'Medicine and Herbs' ? 'selected' : '' ?>>Medicine and Herbs</option>

                                    <option value="Baby Products" <?= $fetch['store_type'] == 'Baby Products' ? 'selected' : '' ?>>Baby Products</option>

                                    <option value="Clothes" <?= $fetch['store_type'] == 'Clothes' ? 'selected' : '' ?>>Clothes</option>

                                    <option value="Arts and Crafts" <?= $fetch['store_type'] == 'Arts and Crafts' ? 'selected' : '' ?>>Arts and Crafts</option>

                                    <option value="Other" <?= $fetch['store_type'] == 'Other' ? 'selected' : '' ?>>Other</option>

                                </select>

                            </div>

                            <div class="mb-3">

                                <label for="storeLocationUpdate" class="form-label">Location</label>

                                <select id="storeLocationUpdate" name="storeLocationUpdate" class="form-select">

                                    <option disabled>Paarl</option>

                                    <option value="Klein Drakenstein Road" <?= $fetch['store_location'] == 'Klein Drakenstein Road' ? 'selected' : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Klein Drakenstein Road</option>

                                    <option value="Lady Grey Street" <?= $fetch['store_location'] == 'Lady Grey Street' ? 'selected' : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Lady Grey Street</option>

                                    <option value="New Street" <?= $fetch['store_location'] == 'New Street' ? 'selected' : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;New Street</option>

                                    <option value="Paarl East" <?= $fetch['store_location'] == 'Paarl East' ? 'selected' : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Paarl East</option>

                                    <option disabled>Mbekweni</option>

                                    <option value="Donkervliet Street" <?= $fetch['store_location'] == 'Donkervliet Street' ? 'selected' : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Donkervliet Street</option>

                                    <option value="Wamkelekile Street" <?= $fetch['store_location'] == 'Wamkelekile Street' ? 'selected' : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Wamkelekile Street</option>

                                    <option value="Mohajane Street" <?= $fetch['store_location'] == 'Mohajane Street' ? 'selected' : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Mohajane Street</option>

                                    <option value="Phokeng Street" <?= $fetch['store_location'] == 'Phokeng Street' ? 'selected' : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Phokeng Street</option>

                                    <option value="Ntshamba Street" <?= $fetch['store_location'] == 'Ntshamba Street' ? 'selected' : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Ntshamba Street</option>

                                    <option disabled>Groenheuwel</option>

                                    <option value="Bartolomeu Street" <?= $fetch['store_location'] == 'Bartolomeu Street' ? 'selected' : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Bartolomeu Street</option>

                                    <option disabled>New Orleans</option>

                                    <option value="Springbok Street" <?= $fetch['store_location'] == 'Springbok Street' ? 'selected' : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Springbok Street</option>

                                    <option disabled>Wellington</option>

                                    <option value="Market/Melling Street" <?= $fetch['store_location'] == 'Market/Melling Street' ? 'selected' : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Market/Melling Street</option>

                                    <option value="Hoofweg Road" <?= $fetch['store_location'] == 'Hoofweg Road' ? 'selected' : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Hoofweg Road</option>

                                    <option value="Church Street" <?= $fetch['store_location'] == 'Church Street' ? 'selected' : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Church Street</option>

                                    <option disabled>Bellville</option>

                                    <option value="Bell Star Junction/Bellville Train Station" <?= $fetch['store_location'] == 'Bell Star Junction/Bellville Train Station' ? 'selected' : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Bell Star Junction/Bellville Train Station</option>

                                </select>

                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                                <button type="button" onclick="history.back()" class="btn btn-secondary me-md-2">Cancel</button>

                                <button type="submit" name="updateStore" class="btn btn-primary">Save Changes</button>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </section>

    </main>

    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>