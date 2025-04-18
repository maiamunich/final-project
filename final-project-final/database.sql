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
('Camping in the Mountains', 'VART-2545', '/assets/images/Camping.JPG', 'A landscape painting of a tent in the mountains. ', 'Acrylic on Canvas', '11x14 inches', 50.00),
('Shattered Thoughts', 'VART-2545', '/assets/images/Shattered-Thoughts.JPG', 'A piece about the struggles of the human mind. ', 'Mixed Media', '18x24 inches', 155.00),
('Licks of color', 'VART-2545', '/assets/images/Splash.JPG', 'A mixed media abstract piece with a splash of color', 'Mixed Media', '11x14 inches', 50.00),
('Abyss', 'VART-2545', '/assets/images/Abyss.jpg', 'Is it bed sheets? Or is it the abyss in my mind? ', 'Acrylic and Plaster on Canvas', '18x24 inches', 175.00),
('CISC', 'VART-2545', '/assets/images/CISC.jpg', 'Color and Code, can you decipher the code? ', 'Acrylic paint, Posca markers on Paper', '18x24 inches', 90.00),
('Dinoman', 'Personal', '/assets/images/Dinoman.jpg', 'My little dino man ', 'Posca Marker on Canvas', '7x5 inches', 50.00),
('My Eyes Reveal', 'Personal', '/assets/images/Eyes.jpg', 'The emotions reflected in my eyes', 'Acrylic on Canvas', '18x24 inches', 200.00),
('A Pool of Happiness', 'VART-2545', '/assets/images/Happiness.JPG', 'Look and you tell me what you see', 'Acrylic on Canvas', '18x24 inches', 150.00),
('Hummingbird', 'Personal', '/assets/images/Hummingbird.jpg', 'A piece about death and what comes after', 'Acrylic on Canvas', '11x14 inches', 80.00),
('Lost', 'VART-1180', '/assets/images/Lost.jpg', 'Navigating the New York Subway system ', 'Acrylic on Canvas', '24x20 inches', 250.00),
('A Mans Mind is His Misery', 'VART-1180', '/assets/images/Misery.JPG', 'An abstract painting ', 'Acrylic on Unstretched  Canvas', '50x50 inches', 200.00),
('My Mess', 'VART-1180', '/assets/images/My_Mess.jpg', 'A painting of the miscellaneous ', 'Acrylic on Canvas', '14x18 inches', 150.00),
('Do I Overshare?', 'VART-2545', '/assets/images/Overshare.jpg', 'A painting about the need to overshare', 'Acrylic on Paper', '18x24 inches', 150.00),
('Find My Heart', 'VART-1150', '/assets/images/Find.jpg', 'A drawing about the different forms of love', 'Ink on Paper', '18x24 inches', 150.00);


