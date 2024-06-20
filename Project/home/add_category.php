<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Category</title>
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
            <h1 class="app-content-headerText">Add Category</h1>
        </div>
        <div class="form-container">
            <form method="POST" action="process_add_category.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="category_name">Category:</label>
                    <input type="text" id="category_name" name="category_name" required>
                </div>
                <div class="form-group">
                    <button type="submit">Add Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
