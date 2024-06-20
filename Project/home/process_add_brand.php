<?php
require '../database/other.php';
require '../database/database.php';

$db = new Database();
$other = new Other($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $brand_name = htmlspecialchars($_POST['brand_name']);

    try {
        $other->addBrand($brand_name);

        header("Location: add_brands.php?success=1");
        exit();
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
} else {
    header("Location: add_brands.php");
    exit();
}

