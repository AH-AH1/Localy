<?php

session_start();

require_once "database.php";

require_once "msg.php";

?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $emailAddress = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($emailAddress)) {

            $_SESSION["email_error"] = "Please enter your email address";
            $_SESSION["active_form"] = "login_container";

            header("Location: login.php");

            exit();
        } elseif (empty($password)) {

            $_SESSION["password_error"] = "Please enter your password";
            $_SESSION["active_form"] = "login_container";

            header("Location: login.php");

            exit();
        } else {

            $checkEmail = $connection->query("SELECT * FROM users WHERE email_address = '$emailAddress'");
            if ($checkEmail->num_rows > 0) {

                $db_user = $checkEmail->fetch_assoc();

                if (password_verify($password, $db_user['user_password'])) {

                    $_SESSION['user_ID'] = $db_user['user_ID'];
                    $_SESSION['first_name'] = $db_user['first_name'];
                    $_SESSION['last_name'] = $db_user['last_name'];
                    $_SESSION['email_address'] = $db_user['email_address'];

                    $checkID = $_SESSION["user_ID"];
                    $sellerCheck = $connection->query("SELECT seller_ID FROM sellers WHERE user_ID = '$checkID'");

                    if ($sellerCheck && mysqli_num_rows($sellerCheck) > 0) {

                        $sellerData = mysqli_fetch_assoc($sellerCheck);
                        $_SESSION["seller_ID"] = $sellerData["seller_ID"];
                    }

                    header("Location: index.php");

                    exit();
                } else {

                    $_SESSION["password_error"] = "Incorrect password";

                    $_SESSION["active_form"] = "login_container";

                    header("Location: login.php");

                    exit();
                }
            } else {

                $_SESSION["email_error"] = "Incorrect email address";
                $_SESSION["active_form"] = "login_container";

                header("Location: login.php");

                exit();
            }
        }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login/Sign up</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

</head>

<body>

    <main>

        <section class="text-center text-lg-start">

            <div class="container py-4 text-center active" id="login_container">

                <div class="row g-1 align-items-center justify-content-center">

                    <div class="col-lg-6 mb-5 mb-lg-0">

                        <div class="card cascading-right bg-body-tertiary" style="backdrop-filter: blur(30px);">

                            <div class="card-body p-3 shadow-5 text-center">

                                <h2 class="fw-bold mb-3">Welcome Back</h2>

                                <p class="text-black-50 mb-5">Log In To Your Account</p>

                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">

                                    <div data-mdb-input-init class="form-outline mb-4">

                                        <label class="form-label" for="email">Email address</label>

                                        <input type="email" name="email" id="emailLogin" class="form-control" required/>

                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">

                                        <label class="form-label" for="password">Password</label>

                                        <div class="input-group">

                                            <input type="password" name="password" id="loginPassword" class="form-control" required/>

                                            <button type="button" class="btn btn-outline-secondary" id="loginPasswordToggle">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                                </svg>

                                            </button>

                                        </div>

                                    </div>

                                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4" id="loginBtn" name="loginBtn">Login</button>

                                    <div class="text-center">

                                        <p class="mb-0">

                                            Don't have an account?
                                            <a href="register.php" class="nav-link link-secondary">Register</a>

                                        </p>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>