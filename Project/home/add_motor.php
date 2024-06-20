<?php
require '../database/other.php';
require '../database/database.php';
require '../database/motor.php';

$db = new Database();
$motor = new Motor($db);
$other = new Other($db);
$categories = $other->getCategories();
$statuses = $other->getStatuses();
$brands = $other->getBrands();
$motorlicenses = $other->getMotorlicenses();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Motor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="../style/css/style.css">
    <link rel="stylesheet" href="../style/css/add_motor.css">
    <script src="../style/javascript/script.js" defer></script>
    <script src="../style/javascript/navbar.js" defer></script>
</head>
<body>
<div class="app-container">
    <div id="nav" class="sidebar"></div>
    <div class="app-content">
        <div class="app-content-header">
            <h1 class="app-content-headerText">Add Motor</h1>
        </div>
        <div class="form-container">
            <form method="POST" action="process_add_motor.php">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select id="category_id" name="category_id" required>
                        <?php
                        foreach ($categories as $category) {
                            echo "<option value='{$category['category_id']}'>{$category['category']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status_id">Status</label>
                    <select id="status_id" name="status_id" required>
                        <?php
                        foreach ($statuses as $status) {
                            echo "<option value='{$status['status_id']}'>{$status['status']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand_id">Brand</label>
                    <select id="brand_id" name="brand_id" required>
                        <?php
                        foreach ($brands as $brand) {
                            echo "<option value='{$brand['brand_id']}'>{$brand['brand_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="motorlicense_id">Motor License</label>
                    <select id="motorlicense_id" name="motorlicense_id" required>
                        <?php
                        foreach ($motorlicenses as $motorlicense) {
                            echo "<option value='{$motorlicense['motorlicense_id']}'>{$motorlicense['motorlicense_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cc">CC</label>
                    <input type="number" id="cc" name="cc" required>
                </div>
                <div class="form-group">
                    <label for="pk">PK</label>
                    <input type="number" id="pk" name="pk" required>
                </div>
                <div class="form-group">
                    <label for="kw">KW</label>
                    <input type="number" id="kw" name="kw" required>
                </div>
                <div class="form-group">
                    <label for="seat_height">Seat Height (in mm)</label>
                    <input type="number" id="seat_height" name="seat_height" required>
                </div>
                <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="number" id="weight" name="weight" required>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" required>
                </div>
                <div class="form-group">
                    <button type="submit">Add Motor</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
