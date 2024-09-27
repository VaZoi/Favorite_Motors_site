<?php
require '../database/database.php';
require '../database/motor.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (isset($input['motor_id'])) {
        $motor_id = $input['motor_id'];

        $db = new Database();
        $motorModel = new Motor($db);

        $result = $motorModel->addLike($motor_id);

        if ($result) {
            $motor = $motorModel->getMotorById($motor_id);
            $likes = $motor['likes'];

            echo json_encode(['success' => true, 'likes' => $likes]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Motor ID missing.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
