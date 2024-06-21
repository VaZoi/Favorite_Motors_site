<?php
require '../database/database.php';
require '../database/motor.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['motor_id'])) {
        $motor_id = $_POST['motor_id'];
    } else {
        die("Error: Motor ID is missing.");
    }

    $db = new Database();
    $motor = new Motor($db);

    if (isset($_FILES["images"])) {
        $uploadDir = "../uploads/";
        $allowedExtensions = array("jpg", "jpeg", "png", "gif", "webp");

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        foreach ($_FILES["images"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["images"]["tmp_name"][$key];
                $name = basename($_FILES["images"]["name"][$key]);
                $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

                if (!in_array($extension, $allowedExtensions)) {
                    die("Error: Only JPG, JPEG, PNG, WEBP and GIF files are allowed.");
                }

                $destination = $uploadDir . uniqid() . '_' . $name;
                if (!move_uploaded_file($tmp_name, $destination)) {
                    die("Error: Failed to move uploaded file.");
                }

                $motor->addMotorImage($motor_id, $destination);
            }
        }

        header("Location: view_motor.php?id={$motor_id}");
        exit();
    } else {
        die("Error: No images uploaded.");
    }
} else {
    die("Error: Invalid request.");
}

