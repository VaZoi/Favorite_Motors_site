<?php
require '../database/other.php';
require '../database/database.php';
require '../database/motor.php';

$db = new Database();
$motorModel = new Motor($db);
$other = new Other($db);

if (!isset($_GET['id'])) {
    exit('Motor ID not provided.');
}

$motor_id = $_GET['id'];

$motor = $motorModel->getMotorById($motor_id);
$categories = $other->getCategories();
$statuses = $other->getStatuses();
$brands = $other->getBrands();
$motorlicenses = $other->getMotorlicenses();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    $result = $motorModel->updateMotor($motor_id, $name, $category_id, $status_id, $brand_id, $motorlicense_id, $cc, $pk, $kw, $seat_height, $weight, $price);

    if ($result) {
        header('Location: view_motor.php?id=' . $motor_id);
        exit;
    } else {
        exit('Failed to update motor.');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Motor</title>
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
            <h1 class="app-content-headerText">Edit Motor</h1>
        </div>
        <div class="form-container">
            <form method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($motor['name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select id="category_id" name="category_id" required>
                        <?php
                        foreach ($categories as $category) {
                            echo "<option value='" . htmlspecialchars($category['category_id']) . "'" . ($motor['category_id'] == $category['category_id'] ? ' selected' : '') . ">" . htmlspecialchars($category['category']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="status_id">Status</label>
                    <select id="status_id" name="status_id" required>
                        <?php
                        foreach ($statuses as $status) {
                            echo "<option value='" . htmlspecialchars($status['status_id']) . "'" . ($motor['status_id'] == $status['status_id'] ? ' selected' : '') . ">" . htmlspecialchars($status['status']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand_id">Brand</label>
                    <select id="brand_id" name="brand_id" required>
                        <?php
                        foreach ($brands as $brand) {
                            echo "<option value='" . htmlspecialchars($brand['brand_id']) . "'" . ($motor['brand_id'] == $brand['brand_id'] ? ' selected' : '') . ">" . htmlspecialchars($brand['brand_name']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="motorlicense_id">Motor License</label>
                    <select id="motorlicense_id" name="motorlicense_id" required>
                        <?php
                        foreach ($motorlicenses as $motorlicense) {
                            echo "<option value='" . htmlspecialchars($motorlicense['motorlicense_id']) . "'" . ($motor['motorlicense_id'] == $motorlicense['motorlicense_id'] ? ' selected' : '') . ">" . htmlspecialchars($motorlicense['motorlicense_name']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cc">CC</label>
                    <input type="number" id="cc" name="cc" value="<?php echo htmlspecialchars($motor['cc']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="pk">PK</label>
                    <input type="number" id="pk" name="pk" value="<?php echo htmlspecialchars($motor['pk']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="kw">KW</label>
                    <input type="number" id="kw" name="kw" value="<?php echo htmlspecialchars($motor['kw']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="seat_height">Seat Height (in mm)</label>
                    <input type="number" id="seat_height" name="seat_height" value="<?php echo htmlspecialchars($motor['seat_height']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="number" id="weight" name="weight" value="<?php echo htmlspecialchars($motor['weight']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($motor['price']); ?>" required>
                </div>
                <div class="form-group">
                    <button type="submit">Update Motor</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
