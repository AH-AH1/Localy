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

        .about {

            padding: 120px 0;
            position: relative;
            overflow: hidden;
            z-index: 2;
            
        }

        .img-shadow {

            border-radius: 20px;

            box-shadow: 0 9px 21px rgba(74, 234, 0, 0.3) !important;

        }

        .title span{

            color: #4caf50;

        }

        .text {

            line-height: 1.8;

            color: #333333;

        }

    </style>    
</head>

<body>

    <?php include('header.php'); ?>

    <main class="about bg-light">

        <div class="container">

            <div class="row align-items-center g-5">

                <div class="col-lg-6 text-center">

                    <img src="about_us.jpg" class="img-fluid img-shadow"  alt="Local Market Image">

                </div>

                <div class="col-lg-6">

                    <h1 class="title fw-bold mb-4">
                        
                        About <span>Localy</span>

                    </h1>

                    <p class="text">
                        Localy is a South African online marketplace that supports local street vendors, spaza shops and community-based sellers by helping them advertise their products online and reach more customers. Localy provides informal sellers a free and easy way to reach more customers nearby, allowing them to be successful in their trade. 
                        <br><br>
                        Localy is also intended for everyday shoppers looking for affordable and <strong>locally</strong> sourced products. From fresh produce, cooked meals, home-made items to daily essentials, Localy provides a convenient way for consumers to search and purchase products, without needing to walk from stall to stall. 
                        <br><br>
                        Localy is here to modernize local buying, by making it digitally accessible, convenient and community-focused.
                    </p>

                </div>

            </div>

        </div>

    </main>

    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>