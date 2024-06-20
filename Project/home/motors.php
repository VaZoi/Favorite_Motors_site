<?php
require '../database/other.php';
require '../database/database.php';
require '../database/motor.php';

$db = new Database();
$motorModel = new Motor($db);
$other = new Other($db);
$motors = $motorModel->getMotors();
$categories = $other->getCategories();
$statuses = $other->getStatuses();

if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $motors = $motorModel->searchMotors($searchTerm);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Motors Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="../style/css/style.css">
    <link rel="stylesheet" href="../style/css/view_motor.css">
    <link rel="stylesheet" href="../style/css/motors.css">
    <script src="../style/javascript/script.js" defer></script>
    <script src="../style/javascript/navbar.js" defer></script>
    <script src="../style/javascript/view_motor.js" defer></script>
    <script src="../style/javascript/motors.js" defer></script>
</head>
<body>
<div class="app-container">
    <div id="nav" class="sidebar"></div>
    <div class="app-content">
        <div class="app-content-header">
            <h1 class="app-content-headerText">Motors</h1>
            <a href="add_motor.php"><button class="app-content-headerButton">Add Motor</button></a>
        </div>
        <form class="search-form" action="" method="GET">
            <input type="text" name="search" placeholder="Search by name or brand..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <input type="submit" value="Search">
        </form>
        <div class="app-content-actions">
        <div class="products-area-wrapper tableView">
            <div class="products-header">
                <div class="product-cell image">Image</div>
                <div class="product-cell stock">Name</div>
                <div class="product-cell category">Category</div>
                <div class="product-cell status-cell">Status</div>
                <div class="product-cell sales">Brand</div>
                <div class="product-cell stock">Motorlicence</div>
                <div class="product-cell stock">CC</div>
                <div class="product-cell stock">PK</div>
                <div class="product-cell stock">KW</div>
                <div class="product-cell stock">Seat Height</div>
                <div class="product-cell stock">Weight</div>
                <div class="product-cell stock">Price</div>
                <div class="product-cell stock">Action</div>
            </div>
            <div class="products-">
                <?php
                foreach ($motors as $motor) {
                    echo "<div class='products-row'>";
                    echo "<div class='product-cell image'>";
                    $images = $motorModel->getMotorImages($motor['motor_id']);
                    $image = !empty($images) ? $images[0]['image_path'] : 'default_image_path';
                    echo "<img src='{$image}' alt='" . htmlspecialchars($motor['brand_name'] . ' ' . $motor['name']) . "' style='width:100px;height:100px;' class='thumbnail'>";
                    echo "</div>";
                    echo "<div class='product-cell stock'><span>{$motor['name']}</span></div>";
                    echo "<div class='product-cell category'><span>{$motor['category_name']}</span></div>";
                    echo "<div class='product-cell status-cell'><span>{$motor['status_name']}</span></div>";
                    echo "<div class='product-cell sales'><span>{$motor['brand_name']}</span></div>";
                    echo "<div class='product-cell stock'><span>{$motor['motorlicense_name']}</span></div>";
                    echo "<div class='product-cell stock'><span>{$motor['cc']}</span></div>";
                    echo "<div class='product-cell stock'><span>{$motor['pk']}</span></div>";
                    echo "<div class='product-cell stock'><span>{$motor['kw']}</span></div>";
                    echo "<div class='product-cell stock'><span>{$motor['seat_height']} mm</span></div>";
                    echo "<div class='product-cell stock'><span>{$motor['weight']} kg</span></div>";
                    echo "<div class='product-cell stock'>&#8364; <span>{$motor['price']}</span></div>";
                    echo "<div class='product-cell stock'>";
                    echo "<a href='view_motor.php?id={$motor['motor_id']}'>";
                    echo '<svg fill="#fff" height="20px" width="20px" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="-1.6 -1.6 19.20 19.20" stroke="#fff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.128"></g><g id="SVGRepo_iconCarrier"> <path class="cls-1" d="M8,6.5A1.5,1.5,0,1,1,6.5,8,1.5,1.5,0,0,1,8,6.5ZM.5,8A1.5,1.5,0,1,0,2,6.5,1.5,1.5,0,0,0,.5,8Zm12,0A1.5,1.5,0,1,0,14,6.5,1.5,1.5,0,0,0,12.5,8Z"></path> </g></svg>';
                    echo "</a>";
                    echo "<a href='edit_motor.php?id={$motor['motor_id']}'>";
                    echo '<svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#fff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M14 6L8 12V16H12L18 10M14 6L17 3L21 7L18 10M14 6L18 10M10 4L4 4L4 20L20 20V14" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>';
                    echo "</a>";
                    echo "<a href='delete_motor.php?id={$motor['motor_id']}'>";
                    echo '<svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#fff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10 12V17" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 12V17" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M4 7H20" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 10V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V10" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>';
                    echo "</a>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
</body>
</html>
