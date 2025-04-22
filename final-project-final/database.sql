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
    medium VARCHAR(255),
    dimensions VARCHAR(255),
    price DECIMAL(10,2),
    etsy_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create commissions table
CREATE TABLE IF NOT EXISTS commissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'in_progress', 'completed', 'cancelled') DEFAULT 'pending'
);

-- Insert sample data
INSERT INTO artworks (title, class_name, image_url, description, medium, dimensions, price) VALUES
('Camping in the Mountains', 'VART-2545', 'https://drive.google.com/file/d/1kqMFeyLU9JTJgCnpd_wdTfPN0s1j1j9A/view', 'A landscape painting of a tent in the mountains. ', 'Acrylic on Canvas', '11x14 inches', 50.00),
('Shattered Thoughts', 'VART-2545', 'https://drive.google.com/file/d/1d8iIBcj7ZMYdQDWXGYTD1SoQs6YrBTUM/view', 'A piece about the struggles of the human mind. ', 'Mixed Media', '18x24 inches', 155.00),
('Licks of color', 'VART-2545', 'https://drive.google.com/file/d/1S8q8jyOkbLMVZA-w1pKN87DeEh1tsdh2/view', 'A mixed media abstract piece with a splash of color', 'Mixed Media', '11x14 inches', 50.00),
('Abyss', 'VART-2545', 'https://drive.google.com/file/d/1wQiNZOUNfHF8AeFzFJ5d4uvA9oyu-s2x/view', 'Is it bed sheets? Or is it the abyss in my mind? ', 'Acrylic and Plaster on Canvas', '18x24 inches', 175.00),
('CISC', 'VART-2545', 'https://drive.google.com/file/d/1KipXQ1-V3vEcBvUsS2lhiN8_Hz76p1rU/view', 'Color and Code, can you decipher the code? ', 'Acrylic paint, Posca markers on Paper', '18x24 inches', 90.00),
('Dinoman', 'Personal', 'https://drive.google.com/file/d/1KsUFG3PDkAQmrSvPu6-z33W9JhKiplUl/view', 'My little dino man ', 'Posca Marker on Canvas', '7x5 inches', 50.00),
('My Eyes Reveal', 'Personal', 'https://drive.google.com/file/d/1I59T4q3S7aMWpFBJ5FD72slo0jCbonqz/view', 'The emotions reflected in my eyes', 'Acrylic on Canvas', '18x24 inches', 200.00),
('A Pool of Happiness', 'VART-2545', 'https://drive.google.com/file/d/1w-Snxj-JnFjB6YFouAR5NW8fGfojm1xu/view', 'Look and you tell me what you see', 'Acrylic on Canvas', '18x24 inches', 150.00),
('Hummingbird', 'Personal', 'https://drive.google.com/file/d/1lU1Vmvvrub7Wwh4ew27SXVDbopzaJxtg/view', 'A piece about death and what comes after', 'Acrylic on Canvas', '11x14 inches', 80.00),
('Lost', 'VART-1180', 'https://drive.google.com/file/d/1y-e8EFR3jNYW14_9lWmpGygKDTrI6ECc/view', 'Navigating the New York Subway system ', 'Acrylic on Canvas', '24x20 inches', 250.00),
('A Mans Mind is His Misery', 'VART-1180', 'https://drive.google.com/file/d/1Xd-BJQ6ecNo6byk1jTFXevPYst6qojqF/view', 'An abstract painting ', 'Acrylic on Unstretched  Canvas', '50x50 inches', 200.00),
('My Mess', 'VART-1180', 'https://drive.google.com/file/d/1s92dTp26oAfE8Yvg8R6rrrMtYnuwgC8p/view', 'A painting of the miscellaneous ', 'Acrylic on Canvas', '14x18 inches', 150.00),
('Do I Overshare?', 'VART-2545', 'https://drive.google.com/file/d/1USKf_vcxuF71ZMec1nCV7GYaOqGW54Pi/view', 'A painting about the need to overshare', 'Acrylic on Paper', '18x24 inches', 150.00),
('Find My Heart', 'VART-1150', 'https://drive.google.com/file/d/1XqHX2f76ZeVfXOkdbiOnqFt_JlzZvABR/view', 'A drawing about the different forms of love', 'Ink on Paper', '18x24 inches', 150.00);


