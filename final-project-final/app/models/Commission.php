<?php

namespace app\models;

class Commission extends Model {
    protected $table = 'commissions';

    public function __construct() {
        try {
            parent::__construct();
        } catch (\Exception $e) {
            error_log("Error in Commission constructor: " . $e->getMessage());
            throw $e;
        }
    }

    public function createCommission($data) {
        try {
            error_log("Creating commission with data: " . print_r($data, true));
            
            // Validate required fields
            if (empty($data['name']) || empty($data['email']) || empty($data['description'])) {
                error_log("Missing required fields in commission data");
                throw new \Exception("Missing required fields");
            }

            $validatedData = [
                'name' => htmlspecialchars($data['name']),
                'email' => htmlspecialchars($data['email']),
                'description' => htmlspecialchars($data['description']),
                'created_at' => date('Y-m-d H:i:s'),
                'status' => 'pending'
            ];

            error_log("Validated commission data: " . print_r($validatedData, true));

            // Try to create the commission
            $id = $this->create($validatedData);
            error_log("Commission created with ID: " . $id);
            return $id;

        } catch (\Exception $e) {
            error_log("Error creating commission: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            throw $e;
        }
    }
} 