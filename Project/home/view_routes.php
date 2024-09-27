<?php
require '../database/database.php';
require '../database/route.php';
require '../secret.php';

$db = new Database();
$route = new Route($db);

// Fetch routes from the database
$routes = $db->run("SELECT * FROM routes")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Routes</title>
    <link rel="stylesheet" href="../style/css/style.css">
    <link rel="stylesheet" href="../style/css/view_route.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <script src="../style/javascript/navbar.js" defer></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $secret ?>" defer></script>
</head>
<body>
<div class="app-container">
    <div id="nav" class="sidebar"></div>
    <div class="app-content">
        <h1>Available Routes</h1>
        <div id="map" style="height: 600px;"></div>
        
        <h2>Downloadable Routes</h2>
        <ul>
            <?php foreach ($routes as $route): ?>
                <li>
                    <a href="<?= htmlspecialchars($route['file_path']) ?>" download><?= htmlspecialchars($route['name']) ?></a> - <?= htmlspecialchars($route['description']) ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <script>
            // Object to hold route colors
            const routeColors = {}; 

            // Initialize the Google Map
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: 51.505, lng: -0.09}, // Default center
                    zoom: 13
                });

                // Predefined colors for routes
                const predefinedColors = ['#FF0000', '#00FF00', '#0000FF', '#FFFF00', '#FF00FF', '#00FFFF', '#FFA500', '#800080', '#FFC0CB', '#808080'];
                let colorIndex = 0; // Index to track colors

                // Load GPX routes
                <?php foreach ($routes as $route): ?>
                    (function() {
                        // Declare variables in the IIFE scope
                        const routeName = '<?= htmlspecialchars($route["name"]) ?>';
                        const color = predefinedColors[colorIndex % predefinedColors.length];
                        routeColors[routeName] = color;
                        colorIndex++;

                        fetch('<?= htmlspecialchars($route["file_path"]) ?>')
                            .then(response => response.text())
                            .then(data => {
                                var parser = new DOMParser();
                                var xmlDoc = parser.parseFromString(data, "text/xml");
                                var trackpoints = xmlDoc.getElementsByTagName("trkpt");
                                var path = [];

                                for (var i = 0; i < trackpoints.length; i++) {
                                    var lat = parseFloat(trackpoints[i].getAttribute("lat"));
                                    var lng = parseFloat(trackpoints[i].getAttribute("lon"));
                                    path.push({lat: lat, lng: lng});
                                }

                                // Create a Polyline for the route
                                var routePath = new google.maps.Polyline({
                                    path: path,
                                    geodesic: true,
                                    strokeColor: color,
                                    strokeOpacity: 1.0,
                                    strokeWeight: 4 // Slightly thicker for visibility
                                });
                                routePath.setMap(map);

                                // Create a marker for the route name
                                if (path.length > 0) {
                                    var markerPosition = path[Math.floor(path.length / 2)]; // Middle of the route
                                    var marker = new google.maps.Marker({
                                        position: markerPosition,
                                        map: map,
                                        label: {
                                            text: routeName,
                                            color: '#fff', // White color for the label
                                            fontWeight: 'bold'
                                        }
                                    });

                                    // Set marker color to match the route color
                                    marker.setIcon({
                                        path: google.maps.SymbolPath.CIRCLE,
                                        fillColor: color, // Match marker color to route color
                                        fillOpacity: 1,
                                        strokeColor: color,
                                        strokeWeight: 2,
                                        scale: 10 // Adjust size as necessary
                                    });
                                }

                                // Fit map to the bounds of the route
                                var bounds = new google.maps.LatLngBounds();
                                for (var i = 0; i < path.length; i++) {
                                    bounds.extend(new google.maps.LatLng(path[i].lat, path[i].lng));
                                }
                                map.fitBounds(bounds);
                            })
                            .catch(error => console.error('Error loading GPX file:', error));
                    })();
                <?php endforeach; ?>
            }

            // Call initMap when the page loads
            window.onload = initMap;
        </script>
    </div>
</div>
</body>
</html>
