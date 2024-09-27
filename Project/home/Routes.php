<?php
require '../database/database.php';
require '../database/route.php';

$db = new Database();
$route = new Route($db);

$routes = $route->getAllRoutes(); // Fetch all routes
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Routes Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="../style/css/style.css">
    <link rel="stylesheet" href="../style/css/routes.css">
    <link rel="stylesheet" href="../style/css/motors.css">
    <script src="../style/javascript/navbar.js" defer></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body>
<div class="app-container">
    <div id="nav" class="sidebar"></div>
    <div class="app-content">
        <h1>Upload a GPX Route</h1>
        <form action="upload_route.php" method="POST" enctype="multipart/form-data">
            <label for="route_name">Route Name:</label>
            <input type="text" name="route_name" required><br><br>

            <label for="description">Description:</label>
            <textarea name="description" required></textarea><br><br>

            <label for="route_file">Upload GPX File:</label>
            <input type="file" name="route_file" accept=".gpx" required><br><br>

            <input type="submit" value="Upload Route">
        </form>

        <h2>Available Routes</h2>
        <div id="map" style="height: 600px;"></div>

        <!-- Include Leaflet JS and Leaflet-GPX plugin -->
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-gpx"></script>
        <script>
            var map = L.map('map').setView([51.505, -0.09], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Fetch and load GPX routes dynamically
            <?php foreach ($routes as $route): ?>
                new L.GPX('<?= $route["file_path"] ?>', { async: true }).on('loaded', function(e) {
                    map.fitBounds(e.target.getBounds());
                }).addTo(map);
            <?php endforeach; ?>
        </script>
    </div>
</div>
</body>
</html>
