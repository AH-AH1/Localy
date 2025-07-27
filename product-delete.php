<?php
session_start();
require_once "msg.php";
require_once "database.php";

if (isset($_GET['product_ID'])) {

    $productID = $_GET['product_ID'];
} else {

    $productID = null;
}

if (is_numeric($productID)) {

    $query = mysqli_query($connection, "SELECT product_ID FROM products WHERE product_ID = '$productID'");

    if (mysqli_num_rows($query) > 0) {

        $delete = "DELETE FROM products WHERE product_ID = '$productID'";
        $result = mysqli_query($connection, $delete);

        if ($result) {

            redirect('seller-dashboard.php', 'Product deleted successfully.');
        } else {

            redirect('seller-dashboard.php', 'Error deleting product. Please try again.');
        }
    } else {

        redirect('seller-dashboard.php', 'Product not found.');
    }
} else {

    redirect('seller-dashboard.php', $productID);
}
?>