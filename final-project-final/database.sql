-- Create the database
CREATE DATABASE IF NOT EXISTS art_portfolio;
USE art_portfolio;

-- Create artworks table
CREATE TABLE IF NOT EXISTS artworks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    class_name VARCHAR(255),
    image_url VARCHAR(255) NOT NULL,
    description TEXT,
    medium VARCHAR(100),
    dimensions VARCHAR(100),
    price DECIMAL(10,2),
    etsy_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data
INSERT INTO artworks (title, class_name, image_url, description, medium, dimensions, price) VALUES
('Camping in the Mountains', 'VART-2545', '/assets/images/camping.JPG', 'An painting with layers of acrylic paint making it look glossy. Its a painting of a tent with a fire and mountains. It is based of a class project to paint a place youve never been to before. Mine is based of a dream I reocurringly have about a tent in the middle of nowhere. ', 'Acrylic on Canvas', '11x14 inches', 50.00),
('Shattered Thoughts', 'VART-2545', '/assets/images/Shattered-Thoughts.JPG', 'Mixed media abstract piece', 'Mixed Media', '18x24 inches', 175.00),
('Licks of color', 'VART-2545', '/assets/images/Licks.JPG', 'Mixed media abstract piece with a splash of color', 'Mixed Media', '16x20 inches', 150.00);