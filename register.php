<?php

session_start();

require_once "database.php";

require_once "msg.php";

?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    

        $firstName = filter_input(INPUT_POST, "fName", FILTER_SANITIZE_SPECIAL_CHARS);
        $lastName = filter_input(INPUT_POST, "lName", FILTER_SANITIZE_SPECIAL_CHARS);
        $emailAddress = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if (empty($firstName)) {

            $_SESSION["fName_error"] = "Please enter your first name";
            $_SESSION["active_form"] = "register_container";

            header("Location: register.php");

            exit();
        } elseif (empty($lastName)) {

            $_SESSION["lName_error"] = "Please enter your last name";
            $_SESSION["active_form"] = "register_container";

            header("Location: register.php");

            exit();
        } elseif (empty($emailAddress)) {

            $_SESSION["email_error"] = "Please enter your email address";
            $_SESSION["active_form"] = "register_container";

            header("Location: register.php");

            exit();
        } elseif (empty($password)) {

            $_SESSION["password_error"] = "Please enter a password";
            $_SESSION["active_form"] = "register_container";

            header("Location: register.php");

            exit();
        } else {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $checkEmail = $connection->query("SELECT email_address FROM users WHERE email_address = '$emailAddress'");
            if (mysqli_num_rows($checkEmail) > 0) {

                $_SESSION["registration_error"] = "Email address is already in use";
                $_SESSION["active_form"] = "register_container";

                header("Location: register.php");

                exit();
            } else {

                $connection->query("INSERT INTO users (first_name, last_name, email_address, user_password) VALUES ('$firstName', '$lastName', '$emailAddress', '$hashedPassword')");
            }

            header("Location: login.php");

            exit();
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

            <div class="container py-4 text-center" id="register_container">

                <div class="row g-0 align-items-center justify-content-center">

                    <div class="col-lg-6 mb-5 mb-lg-0">

                        <div class="card cascading-right bg-body-tertiary" style="backdrop-filter: blur(30px); height: 85vh;">

                            <div class="card-body p-3 shadow-5 text-center">

                                <h2 class="fw-bold mb-3">Create An Account</h2>

                                <p class="text-black-50 mb-5">Register Your New Account</p>

                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">

                                    <div class="row">

                                        <div class="col-md-6 mb-4">

                                            <div data-mdb-input-init class="form-outline">

                                                <label class="form-label" for="fName">First name</label>

                                                <input type="text" name="fName" id="fName" class="form-control" required/>

                                                <?php

                                                if (isset($_SESSION["fName_error"])) {

                                                    echo '<div class="text-danger small">' . $_SESSION["fName_error"] . '</div>';

                                                    unset($_SESSION["fName_error"]);
                                                }


                                                ?>

                                            </div>

                                        </div>

                                        <div class="col-md-6 mb-4">

                                            <div data-mdb-input-init class="form-outline">

                                                <label class="form-label" for="lName">Last name</label>

                                                <input type="text" name="lName" id="lName" class="form-control" required/>

                                                <?php

                                                if (isset($_SESSION["lName_error"])) {

                                                    echo '<div class="text-danger small">' . $_SESSION["lName_error"] . '</div>';

                                                    unset($_SESSION["lName_error"]);
                                                }


                                                ?>

                                            </div>

                                        </div>

                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">

                                        <label class="form-label" for="email">Email address</label>

                                        <input type="email" name="email" id="email" class="form-control" required/>

                                        <?php

                                        if (isset($_SESSION["email_error"])) {

                                            echo '<div class="text-danger small">' . $_SESSION["email_error"] . '</div>';

                                            unset($_SESSION["email_error"]);
                                        }

                                        ?>

                                        <?php

                                        if (isset($_SESSION["registration_error"])) {

                                            echo '<div class="text-danger small">' . $_SESSION["registration_error"] . '</div>';

                                            unset($_SESSION["registration_error"]);
                                        }


                                        ?>

                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">

                                        <label class="form-label" for="password">Password</label>

                                        <div class="input-group">

                                            <input type="password" name="password" id="registerPassword" class="form-control" required/>

                                            <?php

                                            if (isset($_SESSION["password_error"])) {

                                                echo '<div class="text-danger small">' . $_SESSION["password_error"] . '</div>';

                                                unset($_SESSION["password_error"]);
                                            }


                                            ?>

                                            <button type="button" class="btn btn-outline-secondary" id="registerPasswordToggle">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                                </svg>

                                            </button>

                                        </div>

                                    </div>

                                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4" id="registerBtn" name="registerBtn">Register</button>

                                    <div class="text-center">

                                        <p class="mb-0">

                                            Already have an account?
                                            <a href="login.php" class="nav-link link-secondary">Login</a>

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