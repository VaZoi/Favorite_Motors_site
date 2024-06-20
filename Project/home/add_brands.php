<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Brand</title>
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
            <h1 class="app-content-headerText">Add Brand</h1>
        </div>
        <div class="form-container">
            <form method="POST" action="process_add_brand.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="brand_name">Brand:</label>
                    <input type="text" id="brand_name" name="brand_name" required>
                </div>
                <div class="form-group">
                    <button type="submit">Add Brand</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
