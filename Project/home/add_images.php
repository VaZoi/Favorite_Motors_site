<?php
require '../database/database.php';
require '../database/motor.php';

$db = new Database();
$motor = new Motor($db);

$motors = $motor->getMotorsOrderedByLikes();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Images to Motor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="../style/css/style.css">
    <link rel="stylesheet" href="../style/css/add_images.css">
    <script src="../style/javascript/navbar.js" defer></script>
</head>
<body>
<div class="app-container">
<div id="nav" class="sidebar"></div>
    <div class="app-content">
        <div class="app-content-header">
            <h1 class="app-content-headerText">Add Images to Motor</h1>
        </div>
        <div class="form-container">
            <form method="POST" action="upload_images.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="motor">Select Motor:</label>
                    <select id="motor" name="motor_id" required>
                        <option value="">Select Motor</option>
                        <?php foreach ($motors as $motor) : ?>
                            <option value="<?php echo $motor['motor_id']; ?>"><?php echo $motor['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="images">Select Images to Upload (Max 5):</label>
                    <input type="file" id="images" name="images[]" accept="image/*" multiple required>
                </div>
                <div class="form-group">
                    <button type="submit">Upload Images</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
