<?php

function redirect($url, $status)
{

    $_SESSION['status'] = $status;

    header('Location: ' . $url);

    exit(0);
}

function alertFailMessage()
{

    if (isset($_SESSION['status'])) {

        echo '<div class="alert alert-danger">
            <h6>' . $_SESSION['status'] . '</h6>
        </div>';
        unset($_SESSION['status']);
    }
}

function alertSuccessMessage()
{

    if (isset($_SESSION['status'])) {

        echo '<div class="alert alert-success">
            <h6>' . $_SESSION['status'] . '</h6>
        </div>';
        unset($_SESSION['status']);
    }
}
?>