<?php
require '../database/database.php';
require '../database/route.php';

$db = new Database();
$route = new Route($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['route_file'])) {
    $uploads_dir = '../uploads/routes';
    $route_file = $_FILES['route_file'];
    $route_name = $_POST['route_name'];
    $description = $_POST['description'];

    // Validate file extension
    $file_extension = pathinfo($route_file['name'], PATHINFO_EXTENSION);
    if (strtolower($file_extension) != 'gpx') {
        die('Only GPX files are allowed.');
    }

    // Move uploaded file
    $filename = basename($route_file['name']);
    $file_path = "$uploads_dir/$filename";
    if (!file_exists($uploads_dir)) {
        mkdir($uploads_dir, 0777, true);
    }
    if (move_uploaded_file($route_file['tmp_name'], $file_path)) {
        // Parse the GPX file for metadata (distance, duration)
        $gpx_data = simplexml_load_file($file_path);
        
        if ($gpx_data === false) {
            die('Error loading GPX file. Please ensure it is valid.');
        }

        list($distance_km, $duration_hours) = parse_gpx($gpx_data);

        // Store the route data in the database
        $route->insertRoute($route_name, $file_path, $distance_km, $duration_hours, $description);
        echo "Route uploaded successfully!";
    } else {
        echo "File upload failed!";
    }
}

// Function to calculate distance and duration from GPX data
function parse_gpx($gpx_data) {
    $total_distance = 0;
    $start_time = null;
    $end_time = null;
    $prev_lat = null;
    $prev_lon = null;

    foreach ($gpx_data->trk->trkseg->trkpt as $trkpt) {
        $lat = (float)$trkpt['lat'];
        $lon = (float)$trkpt['lon'];
        $time = (string)$trkpt->time;

        if ($start_time === null) {
            $start_time = strtotime($time); // First timestamp
        }
        $end_time = strtotime($time); // Last timestamp

        // Calculate distance between points
        if (isset($prev_lat) && isset($prev_lon)) {
            $total_distance += haversine_distance($prev_lat, $prev_lon, $lat, $lon);
        }
        $prev_lat = $lat;
        $prev_lon = $lon;
    }

    // Calculate duration in hours
    $duration_hours = ($end_time - $start_time) / 3600;

    return [$total_distance, $duration_hours];
}

// Haversine formula to calculate the distance between two lat/lon points
function haversine_distance($lat1, $lon1, $lat2, $lon2) {
    $earth_radius = 6371; // Earth radius in kilometers
    $lat_diff = deg2rad($lat2 - $lat1);
    $lon_diff = deg2rad($lon2 - $lon1);
    $a = sin($lat_diff / 2) * sin($lat_diff / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($lon_diff / 2) * sin($lon_diff / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    return $earth_radius * $c; // Distance in kilometers
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload GPX Route</title>
    <link rel="stylesheet" href="../style/css/style.css">
    <link rel="stylesheet" href="../style/css/upload_route.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="../style/javascript/navbar.js" defer></script>
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
    </div>
</div>
</body>
</html>
