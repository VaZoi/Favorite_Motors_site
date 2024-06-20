<?php
require '../database/other.php';
require '../database/database.php';
require '../database/motor.php';

$db = new Database();
$motor = new Motor($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST['name']);
    $category_id = htmlspecialchars($_POST['category_id']);
    $status_id = htmlspecialchars($_POST['status_id']);
    $brand_id = htmlspecialchars($_POST['brand_id']);
    $motorlicense_id = htmlspecialchars($_POST['motorlicense_id']);
    $cc = htmlspecialchars($_POST['cc']);
    $pk = htmlspecialchars($_POST['pk']);
    $kw = htmlspecialchars($_POST['kw']);
    $seat_height = htmlspecialchars($_POST['seat_height']);
    $weight = htmlspecialchars($_POST['weight']);
    $price = htmlspecialchars($_POST['price']);

    try {
        $motor->addMotor($name, $category_id, $status_id, $brand_id, $motorlicense_id, $cc, $pk, $kw, $seat_height, $weight, $price);

        header("Location: add_motor.php?success=1");
        exit();
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
        exit();
    }
} else {
    header("Location: add_motors.php");
    exit();
}

