<?php
require '../database/database.php';
require '../database/motor.php';

$db = new Database();
$motor = new Motor($db);
$totalMotors = $motor->countMotors();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Motors Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="../style/css/style.css">
    <link rel="stylesheet" href="../style/css/home.css">
    <script src="../style/javascript/navbar.js" defer></script>
    
</head>
<body>
<div class="app-container">
    <div id="nav" class="sidebar"></div>
    
    <div class="app-content">
        <div class="app-content-header">
            <h1 class="app-content-headerText">Dashboard</h1>
            <button class="app-content-headerButton">motors: <?php echo $totalMotors;?></button>
        </div>
        <img src="../style/images/background_yamaha.jpg" alt="background">
        <div class="all-cards">
            <a href="motors.php" class="card">
                <p>View Motors</p>
            </a>
            <a href="add_motor.php" class="card">
                <p>Add Motors</p>
            </a>
            <a href="add_images.php" class="card">
                <p>Add Images</p>
            </a>
        </div>
        
    </div>
</div>
</body>
</html>
