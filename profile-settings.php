<?php
session_start();
require_once "msg.php";
require_once "database.php";

if (!isset($_SESSION['user_ID'])) {

    header("Location: login.php");

    exit();
}

$userID = $_SESSION['user_ID'];



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["updateUser"])) {

        $fNameUpdate = filter_input(INPUT_POST, "fName", FILTER_SANITIZE_SPECIAL_CHARS);
        $lNameUpdate = filter_input(INPUT_POST, "lName", FILTER_SANITIZE_SPECIAL_CHARS);
        $emailUpdate = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

        $currentPasswordInput = $_POST['passwordCurrent'];
        $newPassword = $_POST['passwordUpdate'];
        $confirmPassword = $_POST['passwordConfirm'];

        $result = mysqli_query($connection, "SELECT user_password FROM users WHERE user_ID = '$userID'");
        $row = mysqli_fetch_assoc($result);
        $currentPasswordHash = $row['user_password'];

        if (!empty($currentPasswordInput) && !empty($newPassword) && !empty($confirmPassword)) {
            if (!password_verify($currentPasswordInput, $currentPasswordHash)) {

                redirect('profile-settings.php?id=' . $userID, 'Incorrect current password');
            } elseif ($newPassword !== $confirmPassword) {

                echo "<p>New passwords do not match</p>";

                redirect('profile-settings.php?id=' . $userID, 'New passwords do not match');
            } else {

                $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                $update = mysqli_query($connection, "UPDATE users SET
                first_name = '$fNameUpdate',
                last_name = '$lNameUpdate',
                email_address = '$emailUpdate',
                user_password = '$hashedNewPassword'
                WHERE user_ID = '$userID'");

                redirect('profile-settings.php', 'Profile and password updated successfully');
            }
        } elseif (empty($fNameUpdate) || empty($lNameUpdate) || empty($emailUpdate)) {

            redirect('profile-settings.php?id=' . $userID, 'Please fill in all the input fields');
        } else {

            $update = mysqli_query($connection, "UPDATE users SET
            first_name = '$fNameUpdate',
            last_name = '$lNameUpdate',
            email_address = '$emailUpdate'
            WHERE user_ID = '$userID'");

            redirect('profile-settings.php', 'Profile updated successfully');
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

        .profile {
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

        <section class="profile">

            <div class="container">

                <?php

                $profile = mysqli_query($connection, "SELECT * FROM users WHERE user_ID = '$userID'");

                if (mysqli_num_rows($profile) > 0) {

                    $fetch = mysqli_fetch_assoc($profile);
                } else {

                    echo "<p>Error retrieving profile. </p>";
                }

                ?>

                <?= alertFailMessage(); ?> <?= alertSuccessMessage(); ?>

                <h2 class="mb-4">User Settings</h2>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">

                    <input type="hidden" name="userID" value="<?= $userID ?>" required />

                    <div class="row mb-4">

                        <div class="col-md-6">

                            <h4 class="mb-3">Personal Information</h4>

                            <div class="mb-3">

                                <label class="form-label" for="fName">First name</label>

                                <input type="text" name="fName" id="fName" class="form-control" value="<?php echo htmlspecialchars($fetch['first_name']) ?>" />

                            </div>

                            <div class="mb-3">

                                <label class="form-label" for="lName">Last name</label>

                                <input type="text" name="lName" id="lName" class="form-control" value="<?php echo htmlspecialchars($fetch['last_name']) ?>" />

                            </div>

                            <div class="mb-3">

                                <label class="form-label" for="email">Email Address</label>

                                <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($fetch['email_address']) ?>" />

                            </div>

                        </div>

                    </div>

                    <hr>

                    <div class="row mb-4">

                        <div class="col-md-6">

                            <h4>Change Password</h4>

                            <div class="mb-3">

                                <label class="form-label" for="passwordCurrent">Current Password</label>

                                <input type="password" name="passwordCurrent" id="passwordCurrent" class="form-control" placeholder="Enter Current Password" />

                            </div>

                            <div class="mb-3">

                                <label class="form-label" for="passwordUpdate">New Password</label>

                                <input type="password" name="passwordUpdate" id="passwordUpdate" class="form-control" placeholder="Enter New Password" />

                            </div>

                            <div class="mb-3">

                                <label class="form-label" for="passwordConfirm">Confirm New Password</label>

                                <input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control" placeholder="Confirm New Password" />

                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                                <button type="button" onclick="history.back()" class="btn btn-secondary me-md-2">Cancel</button>
                                <button type="submit" name="updateUser" class="btn btn-primary">Save Changes</button>

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