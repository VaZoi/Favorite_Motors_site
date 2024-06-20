<?php
require '../database/database.php';
require '../database/motor.php';

$db = new Database();
$motor = new Motor($db);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Motors Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="../style/css/style.css">
    <script src="../style/javascript/navbar.js" defer></script>
    
</head>
<body>
<div class="app-container">
    <div id="nav" class="sidebar"></div>
    <div class="app-content">
        <div class="app-content-header">
            <h1 class="app-content-headerText">View Motor</h1>
        </div>
    </div>
</div>
</body>
</html>
