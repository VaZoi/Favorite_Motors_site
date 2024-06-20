<?php
require '../database/other.php';
require '../database/database.php';

$db = new Database();
$other = new Other($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $category_name = htmlspecialchars($_POST['category_name']);

    try {
        $other->addCategory($category_name);

        header("Location: add_category.php?success=1");
        exit();
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
} else {
    header("Location: add_category.php");
    exit();
}

