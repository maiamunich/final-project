<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Commission;

class ContactController extends Controller {
    private $commissionModel;

    public function __construct() {
        try {
            $this->commissionModel = new Commission();
        } catch (\Exception $e) {
            error_log("Error initializing ContactController: " . $e->getMessage());
            throw $e;
        }
    }

    public function index() {
        $this->render('contact');
    }

    public function submit() {
        try {
            // Get the raw POST data
            $rawData = file_get_contents('php://input');
            error_log("Received raw data: " . $rawData);
            
            $data = json_decode($rawData, true);
            error_log("Decoded data: " . print_r($data, true));
            
            // Validate the data
            if (!$data) {
                error_log("Failed to decode JSON data");
                $this->json(['error' => 'Invalid JSON data'], 400);
                return;
            }

            // Check required fields
            $requiredFields = ['name', 'email', 'description'];
            $missingFields = [];
            foreach ($requiredFields as $field) {
                if (empty($data[$field])) {
                    $missingFields[] = $field;
                }
            }

            if (!empty($missingFields)) {
                error_log("Missing required fields: " . implode(', ', $missingFields));
                $this->json(['error' => 'Missing required fields: ' . implode(', ', $missingFields)], 400);
                return;
            }

            // Save the commission request
            $commissionId = $this->commissionModel->createCommission($data);
            
            if ($commissionId) {
                error_log("Commission created successfully with ID: " . $commissionId);
                $this->json([
                    'message' => 'Commission request received successfully',
                    'commission_id' => $commissionId
                ]);
            } else {
                error_log("Failed to save commission - no ID returned");
                $this->json(['error' => 'Failed to save commission request'], 500);
            }
        } catch (\Exception $e) {
            error_log("Error in submit method: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            $this->json(['error' => 'An error occurred while processing your request: ' . $e->getMessage()], 500);
        }
    }
} 