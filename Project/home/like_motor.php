<?php
require '../database/database.php';
require '../database/motor.php';

// Ensure the request is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Check if motor_id is set
    if (isset($input['motor_id'])) {
        $motor_id = $input['motor_id'];

        // Initialize the Database and Motor Model
        $db = new Database();
        $motorModel = new Motor($db);

        // Increment the like
        $result = $motorModel->addLike($motor_id);

        if ($result) {
            // Fetch the updated motor to get the new likes count
            $motor = $motorModel->getMotorById($motor_id);
            $likes = $motor['likes'];

            // Return success with the new like count
            echo json_encode(['success' => true, 'likes' => $likes]);
        } else {
            // Error case
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Motor ID missing.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
