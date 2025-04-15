-- First, create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS art_portfolio;

-- Select the database
USE art_portfolio;

-- Create the artworks table
CREATE TABLE IF NOT EXISTS artworks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    year INT NOT NULL,
    class_name VARCHAR(255),
    image_url VARCHAR(255) NOT NULL,
    description TEXT,
    medium VARCHAR(255),
    dimensions VARCHAR(100),
    price DECIMAL(10,2),
    etsy_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; 