-- Create the database
CREATE DATABASE IF NOT EXISTS art_gallery;
USE art_gallery;

-- Create artworks table
CREATE TABLE IF NOT EXISTS artworks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    year INT NOT NULL,
    class_name VARCHAR(255),
    image_url VARCHAR(255) NOT NULL,
    description TEXT,
    medium VARCHAR(100),
    dimensions VARCHAR(100),
    price DECIMAL(10,2),
    etsy_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample data
INSERT INTO artworks (title, year, class_name, image_url, description, medium, dimensions, price) VALUES
('Sunset Over Mountains', 2023, 'ART-101', 'images/sunset-mountains.jpg', 'An acrylic painting of a mountain sunset', 'Acrylic on Canvas', '24x36 inches', 250.00),
('Abstract Thoughts', 2022, 'ART-201', 'images/abstract.jpg', 'Mixed media abstract piece', 'Mixed Media', '18x24 inches', 175.00),
('City Lights', 2023, NULL, 'images/city-lights.jpg', 'Digital illustration of city nightscape', 'Digital Art', '16x20 inches', 150.00); 