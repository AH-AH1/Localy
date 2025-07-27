<?php

session_start();

require_once "database.php";

require_once "msg.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $subject = filter_input(INPUT_POST, "subject", FILTER_SANITIZE_SPECIAL_CHARS);
    $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {

        redirect('contact-us.php', 'Please fill in all the input fields');
    } else {

        $connection->query("INSERT INTO contacts (contact_name, contact_email, contact_subject, contact_message) VALUES ('$name', '$email', '$subject', '$message')");

        redirect('contact-us.php', 'Message sent');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localy</title>

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

        .contact {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }

        .contact-info-card {
            text-align: center;
            padding: 30px;
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            background-color: #f9f9f9;
            height: 100%;
        }

        .contact-info-card:hover {
            box-shadow: 0 4px 20px rgba(76, 175, 79, 0.42);
        }

        .contact-info-card svg {
            color: #4caf50;
            margin-bottom: 15px;
        }

        .contact-info-card h5 {
            font-weight: bold;
        }

        .contact-info-card p {
            margin-bottom: 0.5rem;
        }

        .contact-info-card a {
            color: #d32f2f;
            text-decoration: none;
        }

        .contact-form {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            padding: 40px;
            margin-top: 40px;
        }

        .title {

            font-weight: bold !important;

            text-align: center;
        }
    </style>

</head>

<body>

    <?php include('header.php'); ?>

    <main>
        <section class="contact">

            <div class="container">

                <h1 class="text-3xl font-bold">Contact Us</h1>

                <p class="text-gray-600 mt-1 mb-5">Discover local products from trusted sellers</p>

                <div class="row justify-content-center text-center mb-5 gap-4">

                    <div class="col-md-4 mb-4">
                        <div class="contact-info-card h-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                            </svg>
                            <h5>Email Support</h5>
                            <p>Get a response within 24 hours</p>
                            <a href="mailto:support@localy.com">support@localy.com</a>
                        </div>
                    </div>


                    <div class="col-md-4 mb-4">
                        <div class="contact-info-card h-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                            </svg>
                            <h5>Phone Support</h5>
                            <p>Mon-Sat, 9AM-6PM SAST</p>
                            <a href="tel:0798811879">079-881-1879</a>
                        </div>
                    </div>
                </div>


                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <?= alertSuccessMessage(); ?>
                        <?= alertFailMessage(); ?>

                        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" class="contact-form">

                            <h5 class="title mb-4">Send us a message</h5>

                            <div class="mb-3">

                                <label for="name" class="form-label">Name</label>

                                <input type="text" name="name" class="form-control" id="name">

                            </div>

                            <div class="mb-3">

                                <label for="email" class="form-label">Email address</label>

                                <input type="email" name="email" class="form-control" id="email">

                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>

                                <select id="subject" name="subject" class="form-select">

                                    <option disabled selected>Select a subject</option>

                                    <option value="General Enquiry">General Enquiry</option>

                                    <option value="Technical Support">Technical Support</option>

                                    <option value="Report Problem">Report Problem</option>

                                    <option value="Billing Question">Billing Question</option>

                                    <option value="Feature Request">Feature Request</option>

                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>

                                <textarea class="form-control" name="message" id="message" rows="6"></textarea>
                            </div>

                            <div class="d-grid">

                                <button type="submit" class="btn btn-outline-success">Send Message</button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </section>

    </main>

    <?php include('footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>