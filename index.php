<?php

session_start();

require_once "database.php";
require_once "msg.php";

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

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 120px 0;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;

        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: #6c757d;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .hero-buttons .btn {
            padding: 0.8rem 2rem;
            font-weight: 500;
            border-radius: 50px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(45deg, #4caf50);
            border: none !important;
            color: #ffffff;
            box-shadow: 0 5px 15px rgba(86, 171, 47, 0.2) !important;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #ffffff);
            color: #4caf50 !important;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(86, 171, 47, 0.3) !important;
        }

        .btn-outline {
            border: 2px solid #4caf50 !important;
            color: #4caf50 !important;
            background: transparent;
        }

        .btn-outline:hover {
            background: linear-gradient(45deg, #4caf50);
            color: white !important;
            border-color: transparent;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(86, 171, 47, 0.3) !important;
        }

        .hero-image {
            position: relative;
            z-index: 2;
        }

        .hero-image-main {
            width: 100%;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 9px 21px rgba(74, 234, 0, 0.3) !important;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @media (max-width: 991.98px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-image {
                margin-top: 3rem;
            }

        }

        /*Roles*/
        .service-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            background: linear-gradient(145deg, #ffffff, #f3f3f3);
            box-shadow: 5px 5px 15px #d9d9d9, -5px -5px 15px #ffffff;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 8px 8px 20px #d1d1d1, -8px -8px 20px #ffffff;
        }

        .icon-wrapper {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            background: linear-gradient(135deg, #4caf50, #88d165);
        }

        .service-title {
            color: #2d3748;
            font-weight: 600;
        }

        .service-text {
            color: #718096;
            font-size: 0.95rem;
        }

        

        /*Why choose*/
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .icon-wrapper {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .bg-soft-primary {
            background-color: #e8f1ff;
        }

        .bg-soft-success {
            background-color: #e6f8f3;
        }

        .bg-soft-warning {
            background-color: #fff8e9;
        }

        .card-title {
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .section-heading {
            font-weight: 700;

        }
    </style>

</head>

<body>

    <?php include('header.php'); ?>

    <main>

        <section class="hero-section">

            <div class="container">

                <div class="row align-items-center">

                    <div class="col-lg-6 hero-content">

                        <h1 class="hero-title">Transform Your Shopping</h1>

                        <h1 class="hero-title">Experience Local</h1>

                        <h2 class="hero-subtitle">The people powered marketplace built for you</h2>

                        <p class="hero-subtitle">Connecting local selllers with local buyers who want fresh, affordable and proudly South African goods</p>

                        <div class="hero-buttons d-flex flex-wrap gap-3">

                            <a href="shop.php" class="btn btn-primary">Shop</a>

                            <a href="seller-dashboard.php" class="btn btn-outline">Sell</a>

                        </div>

                    </div>

                    <div class="col-lg-6 hero-image">

                        <img src="hero_image.jpg" alt="Platform Dashboard" class="hero-image-main">

                    </div>

                </div>

            </div>

        </section>

        <section class="py-5">

            <div class="container" style="margin-top: 30px;">

                <div class="row justify-content-center">

                    <div class="col-12 text-center mb-5">

                        <h2 class="display-5 fw-bold mb-3">Choose Your Role</h2>

                        <p class="text-muted">Whether you're here to discover amazing products or ready to start selling, Localy has everything you need to succeed</p>

                    </div>

                </div>

                <div class="row g-4 justify-content-center" style="gap: 21px">

                    <div class="col-md-4">

                        <div class="service-card h-100 p-4">

                            <div class="icon-wrapper mb-4">

                                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" fill="white" class="bi bi-globe-europe-africa-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0m0 1a6.97 6.97 0 0 0-4.335 1.505l-.285.641a.847.847 0 0 0 1.48.816l.244-.368a.81.81 0 0 1 1.035-.275.81.81 0 0 0 .722 0l.262-.13a1 1 0 0 1 .775-.05l.984.34q.118.04.243.054c.784.093.855.377.694.801a.84.84 0 0 1-1.035.487l-.01-.003C8.273 4.663 7.747 4.5 6 4.5 4.8 4.5 3.5 5.62 3.5 7c0 3 1.935 1.89 3 3 1.146 1.194-1 4 2 4 1.75 0 3-3.5 3-4.5 0-.704 1.5-1 1-2.5-.097-.291-.396-.568-.642-.756-.173-.133-.206-.396-.051-.55a.334.334 0 0 1 .42-.043l1.085.724a.276.276 0 0 0 .348-.035c.15-.15.414-.083.488.117.16.428.445 1.046.847 1.354A7 7 0 0 0 8 1" />
                                </svg>
                            </div>

                            <h4 class="service-title text-center mb-3">Discover and Shop</h4>

                            <p class="service-text text-center mb-0">Support your community and discover local products. Shop from trsuted street vendors, spaza shops,
                                local markets, and home-based businesses near you.</p>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="service-card h-100 p-4">

                            <div class="icon-wrapper mb-4">

                                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" fill="white" class="bi bi-graph-up-arrow" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M0 0h1v15h15v1H0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5" />
                                </svg>

                            </div>

                            <h4 class="service-title text-center mb-3">Sell Now</h4>

                            <p class="service-text text-center mb-0">Open your own free digital store in minutes. Showcase your products, and connect with your customers
                                directly.</p>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <section class="py-5">

            <div class="bg-light">

                <div class="container py-5">

                    <div class="text-center mb-5">

                        <h1 class="section-heading display-4 mb-3">Why Choose Locally</h1>

                        <p class="text-muted lead">Transform your shopping experience.</p>

                    </div>

                    <div class="row g-4">

                        <div class="col-md-4">

                            <div class="card feature-card h-100 p-4">

                                <div class="icon-wrapper bg-soft-primary">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-hammer" viewBox="0 0 16 16">
                                        <path d="M9.972 2.508a.5.5 0 0 0-.16-.556l-.178-.129a5 5 0 0 0-2.076-.783C6.215.862 4.504 1.229 2.84 3.133H1.786a.5.5 0 0 0-.354.147L.146 4.567a.5.5 0 0 0 0 .706l2.571 2.579a.5.5 0 0 0 .708 0l1.286-1.29a.5.5 0 0 0 .146-.353V5.57l8.387 8.873A.5.5 0 0 0 14 14.5l1.5-1.5a.5.5 0 0 0 .017-.689l-9.129-8.63c.747-.456 1.772-.839 3.112-.839a.5.5 0 0 0 .472-.334" />
                                    </svg>

                                </div>

                                <h3 class="card-title">Built for Our Communities</h3>

                                <p class="card-text text-muted">Locally is made for South Africans, by South Africans. We understand township life, kasi hustle, and
                                    community values.</p>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="card feature-card h-100 p-4">

                                <div class="icon-wrapper bg-soft-success">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-lightning-charge" viewBox="0 0 16 16">
                                        <path d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09zM4.157 8.5H7a.5.5 0 0 1 .478.647L6.11 13.59l5.732-6.09H9a.5.5 0 0 1-.478-.647L9.89 2.41z" />
                                    </svg>

                                </div>

                                <h3 class="card-title">Quick and Easy</h3>

                                <p class="card-text text-muted">Get the goods you know and love, place orders, and choose to collect or have it delvered. All from
                                    your phone.</p>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="card feature-card h-100 p-4">

                                <div class="icon-wrapper bg-soft-warning">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-award" viewBox="0 0 16 16">
                                        <path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702z" />
                                        <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z" />
                                    </svg>

                                </div>
                                <h3 class="card-title">Local and Affordable</h3>

                                <p class="card-text text-muted">Buy directly from sellers near you. No middleman and no markups. Only quality and local value at everyday low prices.</p>

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