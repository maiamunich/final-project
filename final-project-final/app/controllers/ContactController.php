<?php

namespace app\controllers;

class ContactController {
    public function contactView() {
        require_once __DIR__ . '/../views/contact.php';
    }

    public function handleCommission() {
        // Get the raw POST data
        $data = json_decode(file_get_contents('php://input'), true);
        
        // Validate the data
        if (!$data || !isset($data['email']) || !isset($data['description'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required fields']);
            return;
        }

        // Here you would typically save the commission request to a database
        // For now, we'll just return a success response
        http_response_code(200);
        echo json_encode(['message' => 'Commission request received']);
    }
} 