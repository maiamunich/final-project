<?php

namespace app\views;

class View {
    private $basePath;

    public function __construct() {
        $this->basePath = dirname(__DIR__) . '/views';
    }

    public function render($template, $data = []) {
        // Extract data to make variables available in the template
        extract($data);
        
        // Start output buffering
        ob_start();
        
        // Include the template file
        $templatePath = $this->basePath . '/' . $template . '.php';
        if (file_exists($templatePath)) {
            include $templatePath;
        } else {
            throw new \Exception("Template not found: {$templatePath}");
        }
        
        // Get the contents of the buffer and clean it
        $content = ob_get_clean();
        
        // Replace placeholders with actual data
        foreach ($data as $key => $value) {
            $content = str_replace('{' . $key . '}', $value, $content);
        }
        
        // Output the final content
        echo $content;
    }
} 