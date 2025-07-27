<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localy</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <style>

        header {

            font-family: Arial, Helvetica, sans-serif;

            color: #333333;

            background-color:#ffffff;

        }

        .nav-link {

            color: #333333 !important;

        }

        .nav-link:hover {

            color: #4caf50 !important;
            text-decoration:underline;

        }

        .dropdown-menu {

            border-color:#333333 !important;

            border-width: 1px;

            border-style: solid;

        }

        .dropdown-item:hover {

            color: #4caf50 !important;

        }

    </style>

</head>

<body>

    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-1 mb-6 border-bottom">

        <a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none"
            style="margin-left: 18px;">

            <img src="localy_logo.jpg" alt="Logo" width="180" height="54" role="img">

        </a>

        <ul class="nav col-12 col-md-auto justify-content-center mb-2 mb-md-0 gap-5"
            style="font-size: 1.2rem; margin-right: 240px;">

            <li><a href="index.php" class="nav-link link-secondary">Home</a></li>

            <li><a href="shop.php" class="nav-link">Shop</a></li>

            <li><a href="orders.php" class="nav-link">Orders</a></li>

            <li><a href="about-us.php" class="nav-link">About Us</a></li>

        </ul>

        <div class="dropdown text-end" style="margin-right: 30px;">

            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">

                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#333333" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>

            </a>

            <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">

                <li><a class="dropdown-item" href="profile-settings.php">Profile Settings</a></li>

                <li><a class="dropdown-item" href="seller-dashboard.php">Seller Dashboard</a></li>

                <li><hr class="dropdown-divider"></li>

                <li><a class="dropdown-item" href="logout.php">Sign out</a></li>

            </ul>

        </div>

    </header>

</body>

</html>