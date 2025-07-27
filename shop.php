<?php

require_once "database.php";

if (isset($_GET['product']) && $_GET['product'] != '') {

    $product = $_GET['product'];

}

if (isset($_GET['location']) && $_GET['location'] != '') {

    $location = $_GET['location'];

}

if (!empty($product) && !empty($location)) {


    $display = mysqli_query($connection, "SELECT p.product_ID, p.product_name, p.product_cost, p.product_image, s.store_name
        FROM products p
        JOIN sellers s ON p.seller_ID = s.seller_ID
        WHERE s.store_type = '$product' AND s.store_location = '$location'
        ORDER BY rand() LIMIT 0,12");

} elseif (!empty($product)) {

    $display = mysqli_query($connection, "SELECT p.product_ID, p.product_name, p.product_cost, p.product_image, s.store_name
        FROM products p
        JOIN sellers s ON p.seller_ID = s.seller_ID
        WHERE s.store_type = '$product'
        ORDER BY rand() LIMIT 0,12");

} elseif (!empty($location)) {

    $display = mysqli_query($connection, "SELECT p.product_ID, p.product_name, p.product_cost, p.product_image, s.store_name
        FROM products p
        JOIN sellers s ON p.seller_ID = s.seller_ID
        WHERE s.store_location = '$location'
        ORDER BY rand() LIMIT 0,12");

} else {


    $display = mysqli_query($connection, "SELECT p.product_ID, p.product_name, p.product_cost, p.product_image, s.store_name
        FROM products p
        JOIN sellers s ON p.seller_ID = s.seller_ID
        ORDER BY rand() LIMIT 0,12");

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

        .shop {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }


        /*shop catalogue*/

        .filter-sidebar {
            background: white;
            border-radius: 12px;
            position: sticky;
            top: 20px;
            height: fit-content;
            border: 1px solid #4caf50;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            height: 100%;
            border: 1px solid #c8e6c9;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            height: 200px;
            object-fit: cover;
            border-radius: 12px 12px 0 0;
        }

        .price {
            color: #338e3c;
            font-weight: 600;
        }

        .store-name {

            color: #333333;

        }

        .category-badge {
            background: #e8f5e9;
            color: #338e3c;
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
        }

        .filter-group {
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }
    </style>

</head>

<body>

    <?php include('header.php'); ?>

    <main>

        <section class="shop">

            <div class="container">

                <h1 class="text-3xl font-bold">Shop Local</h1>

                <p class="text-gray-600 mt-1">Discover local products from trusted sellers</p>

            </div>

            <div class="container py-5">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <h4 class="mb-0">Product Collection</h4>

                </div>

                <div class="row g-4">

                    <div class="col-lg-3">

                        <form action="" method="get">

                            <div class="filter-sidebar p-4 shadow-sm">

                                <div class="filter-group">

                                    <h6 class="mb-2">Product Category</h6>

                                    <div class="form-check mb-4">

                                        <select id="product" name="product" class="form-select">

                                            <option value="">Select Product</option>

                                            <option value="Vegetables" <?= isset($_GET['product']) == true ? ($_GET['product'] == 'Vegetables' ? 'selected' : '') : '' ?>>Vegetables</option>

                                            <option value="Fruits" <?= isset($_GET['product']) == true ? ($_GET['product'] == 'Fruits' ? 'selected' : '') : '' ?>>Fruits</option>

                                            <option value="Prepared Meat" <?= isset($_GET['product']) == true ? ($_GET['product'] == 'Prepared Meat' ? 'selected' : '') : '' ?>>Prepared Meat</option>

                                            <option value="Livestock" <?= isset($_GET['product']) == true ? ($_GET['product'] == 'Livestock' ? 'selected' : '') : '' ?>>Livestock</option>

                                            <option value="Groceries" <?= isset($_GET['product']) == true ? ($_GET['product'] == 'Groceries' ? 'selected' : '') : '' ?>>Groceries</option>

                                            <option value="Snacks" <?= isset($_GET['product']) == true ? ($_GET['product'] == 'Snacks' ? 'selected' : '') : '' ?>>Snacks</option>

                                            <option value="Takeaway/Fast Food" <?= isset($_GET['product']) == true ? ($_GET['product'] == 'Takeaway/Fast Food' ? 'selected' : '') : '' ?>>Takeaway/Fast Food</option>

                                            <option value="Traditional Meals" <?= isset($_GET['product']) == true ? ($_GET['product'] == 'Traditional Meals' ? 'selected' : '') : '' ?>>Traditional Meals</option>

                                            <option value="Beauty and Hair" <?= isset($_GET['product']) == true ? ($_GET['product'] == 'Beauty and Hair' ? 'selected' : '') : '' ?>>Beauty and Hair</option>

                                            <option value="Toiletries" <?= isset($_GET['product']) == true ? ($_GET['product'] == 'Toiletries' ? 'selected' : '') : '' ?>>Toiletries</option>

                                            <option value="Medicine and Herbs" <?= isset($_GET['product']) == true ? ($_GET['product'] == 'Medicine and Herbs' ? 'selected' : '') : '' ?>>Medicine and Herbs</option>

                                            <option value="Baby Products" <?= isset($_GET['product']) == true ? ($_GET['product'] == 'Baby Products' ? 'selected' : '') : '' ?>>Baby Products</option>

                                            <option value="Clothes" <?= isset($_GET['product']) == true ? ($_GET['product'] == 'Clothes' ? 'selected' : '') : '' ?>>Clothes</option>

                                            <option value="Arts and Crafts" <?= isset($_GET['product']) == true ? ($_GET['product'] == 'Arts and Crafts' ? 'selected' : '') : '' ?>>Arts and Crafts</option>

                                            <option value="Other" <?= isset($_GET['product']) == true ? ($_GET['product'] == 'Other' ? 'selected' : '') : '' ?>>Other</option>

                                        </select>

                                    </div>

                                    <h6 class="mb-2">Location</h6>

                                    <div class="form-check mb-4">

                                        <select name="location" id="location" class="form-select">

                                            <option value="">Select Location</option>

                                            <option disabled>Paarl</option>

                                            <option value="Klein Drakenstein Road" <?= isset($_GET['location']) == true ? ($_GET['location'] == 'Klein Drakenstein Road' ? 'selected' : '') : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Klein Drakenstein Road</option>

                                            <option value="Lady Grey Street" <?= isset($_GET['location']) == true ? ($_GET['location'] == 'Lady Grey Street' ? 'selected' : '') : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Lady Grey Street</option>

                                            <option value="New Street" <?= isset($_GET['location']) == true ? ($_GET['location'] == 'New Street' ? 'selected' : '') : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;New Street</option>

                                            <option value="Paarl East" <?= isset($_GET['location']) == true ? ($_GET['location'] == 'Paarl East' ? 'selected' : '') : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Paarl East</option>

                                            <option disabled>Mbekweni</option>

                                            <option value="Donkervliet Street" <?= isset($_GET['location']) == true ? ($_GET['location'] == 'Donkervliet Street' ? 'selected' : '') : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Donkervliet Street</option>

                                            <option value="Wamkelekile Street" <?= isset($_GET['location']) == true ? ($_GET['location'] == 'Wamkelekile Street' ? 'selected' : '') : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Wamkelekile Street</option>

                                            <option value="Mohajane Street" <?= isset($_GET['location']) == true ? ($_GET['location'] == 'Mohajane Street' ? 'selected' : '') : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Mohajane Street</option>

                                            <option value="Phokeng Street" <?= isset($_GET['location']) == true ? ($_GET['location'] == 'Phokeng Street' ? 'selected' : '') : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Phokeng Street</option>

                                            <option value="Ntshamba Street" <?= isset($_GET['location']) == true ? ($_GET['location'] == 'Ntshamba Street' ? 'selected' : '') : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Ntshamba Street</option>

                                            <option disabled>Groenheuwel</option>

                                            <option value="Bartolomeu Street" <?= isset($_GET['location']) == true ? ($_GET['location'] == 'Bartolomeu Street' ? 'selected' : '') : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Bartolomeu Street</option>

                                            <option disabled>New Orleans</option>

                                            <option value="Springbok Street" <?= isset($_GET['location']) == true ? ($_GET['location'] == 'Springbok Street' ? 'selected' : '') : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Springbok Street</option>

                                            <option disabled>Wellington</option>

                                            <option value="Market/Melling Street" <?= isset($_GET['location']) == true ? ($_GET['location'] == 'Market/Melling Street' ? 'selected' : '') : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Market/Melling Street</option>

                                            <option value="Hoofweg Road" <?= isset($_GET['location']) == true ? ($_GET['location'] == 'Hoofweg Road' ? 'selected' : '') : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Hoofweg Road</option>

                                            <option value="Church Street" <?= isset($_GET['location']) == true ? ($_GET['location'] == 'Church Street' ? 'selected' : '') : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Church Street</option>

                                            <option disabled>Bellville</option>

                                            <option value="Bell Star Junction/Bellville Train Station" <?= isset($_GET['location']) == true ? ($_GET['location'] == 'Bell Star Junction/Bellville Train Station' ? 'selected' : '') : '' ?>>&nbsp;&nbsp;&nbsp;&nbsp;Bell Star Junction/Bellville Train Station</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="d-flex flex-column gap-3">

                                    <button class="btn btn-outline-success w-100">Apply Filters</button>

                                    <a href="shop.php" class="btn btn-outline-danger w-10">Reset Filters</a>

                                </div>

                            </div>

                        </form>

                    </div>

                    <div class="col-lg-9">

                        <div class="row g-4">

                            <?php

                            if (mysqli_num_rows($display) > 0): ?>

                                <?php while ($product = mysqli_fetch_assoc($display)): ?>

                                    <div class="col-md-4">
                                        <div class="product-card shadow-sm">

                                            <a href="product.php?product_ID=<?php echo $product['product_ID']; ?>" class="text-decoration-none">

                                                <div class="position-relative">

                                                    <img src="Images/<?php echo htmlspecialchars($product['product_image']); ?>" class="product-image w-100" alt="Product">

                                                </div>

                                                <div class="p-3">

                                                    <span class="category-badge mb-2 d-inline-block"><?php echo htmlspecialchars($product['product_name']); ?></span>

                                                    <h6 class="store-name mb-1"><?php echo htmlspecialchars($product['store_name']); ?></h6>

                                                    <div class="d-flex justify-content-between align-items-center">

                                                        <span class="price">R<?php echo htmlspecialchars($product['product_cost']); ?></span>

                                                    </div>

                                                </div>

                                            </a>

                                        </div>

                                    </div>

                                <?php endwhile; ?>

                            <?php else: ?>

                                <h3>No Products found</h3>

                                <p>Try adjusting you filters or search terms</p>

                            <?php endif; ?>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>

    <?php include('footer.php'); ?>

    <script src="script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>