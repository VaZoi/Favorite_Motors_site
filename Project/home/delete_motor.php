<?php
require '../database/database.php';
require '../database/motor.php';

$db = new Database();
$motorModel = new Motor($db);

if (!isset($_GET['id'])) {
    exit('Motor ID not provided.');
}

$motor_id = $_GET['id'];

$motor = $motorModel->getMotorById($motor_id);
$images = $motorModel->getImagesByMotorId($motor_id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($images as $image) {
        $filePath = '../uploads/' . $image['file_name'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    $motorModel->deleteImagesByMotorId($motor_id);

    $result = $motorModel->deleteMotor($motor_id);

    if ($result) {
        header('Location: motors.php');
        exit;
    } else {
        exit('Failed to delete motor.');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Motor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="../style/css/style.css">
    <link rel="stylesheet" href="../style/css/add_motor.css">
    <link rel="stylesheet" href="../style/css/delete_motor.css">
    <script src="../style/javascript/script.js" defer></script>
    <script src="../style/javascript/navbar.js" defer></script>
</head>
<body>
<div class="app-container">
    <div id="nav" class="sidebar"></div>
    <div class="app-content">
        <div class="app-content-header">
            <h1 class="app-content-headerText">Delete Motor</h1>
        </div>
        <div class="form-container">
            <form method="POST">
                <p>Are you sure you want to delete the motor <strong><?php echo htmlspecialchars($motor['name']); ?></strong> and all its associated images?</p>
                <div class="form-group">
                    <button type="submit">Delete Motor</button>
                    <a href="motors.php" class="delete-button">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
