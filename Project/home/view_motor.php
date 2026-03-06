<?php
require '../database/database.php';
require '../database/motor.php';

$db = new Database();
$motor = new Motor($db);

if (isset($_GET['id'])) {
    $motor_id = $_GET['id'];

    $motor_details = $motor->getMotorById($motor_id);
    $price_history = $motor->getPriceHistory($motor_id);
    if (!$motor_details) {
        die("Error: Motor not found.");
    }

    $motor_images = $motor->getMotorImages($motor_id);
} else {
    die("Error: Motor ID is missing.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Motor</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="../style/css/style.css">
    <link rel="stylesheet" href="../style/css/view_motor.css">
    <script src="../style/javascript/navbar.js" defer></script>
    <script src="../style/javascript/view_motor.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="app-container">
    <div id="nav" class="sidebar"></div>
    <div class="app-content">
        <div class="app-content-header">
            <h1 class="app-content-headerText">View Motor</h1>
        </div>
        <div class="motor-details">
            <h2><?php echo htmlspecialchars($motor_details['brand_name']) . ' ' . htmlspecialchars($motor_details['name']); ?></h2>
            <ul>
                <p><strong>Category:</strong> <?php echo htmlspecialchars($motor_details['category_name']); ?></p>
                <p><strong>Brand:</strong> <?php echo htmlspecialchars($motor_details['brand_name']); ?></p>
                <p><strong>Status:</strong> <?php echo htmlspecialchars($motor_details['status_name']); ?></p>
                <p><strong>CC:</strong> <?php echo htmlspecialchars($motor_details['cc']); ?></p>
                <p><strong>PK:</strong> <?php echo htmlspecialchars($motor_details['pk']); ?></p>
                <p><strong>KW:</strong> <?php echo htmlspecialchars($motor_details['kw']); ?></p>
                <p><strong>Seat Height:</strong> <?php echo htmlspecialchars($motor_details['seat_height']); ?> mm</p>
                <p><strong>Weight:</strong> <?php echo htmlspecialchars($motor_details['weight']); ?> kg</p>
                <p><strong>Price: </strong>&#8364;<?php echo htmlspecialchars($motor_details['price']); ?></p>
            </ul>
        </div>
        <h3 class="descript">Images</h3>
        <div class="motor-images">
            <?php if (!empty($motor_images)): ?>
                <?php foreach ($motor_images as $image): ?>
                    <img src="<?php echo htmlspecialchars($image['image_path']); ?>" alt="<?php echo htmlspecialchars($motor_details['brand_name'] . ' ' . $motor_details['name']); ?>" style="max-width: 200px; margin: 10px;" class="thumbnail">
                <?php endforeach; ?>
            <?php else: ?>
                <p>No images available for this motor.</p>
            <?php endif; ?>
        </div>
        <h3 class="descript">Price History</h3>
        <canvas id="priceChart" width="400" height="200"></canvas>
    </div>
</div>
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
<script>
const priceData = <?php echo json_encode($price_history); ?>;

const labels = priceData.map(item => new Date(item.recorded_at).toLocaleDateString());
const prices = priceData.map(item => item.price);

const ctx = document.getElementById('priceChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Motor Price (€)',
            data: prices,
            borderWidth: 2,
            tension: 0.2
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: false
            }
        }
    }
});
</script>
</body>
</html>
