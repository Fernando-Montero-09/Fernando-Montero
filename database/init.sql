CREATE TABLE IF NOT EXISTS canciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    artista VARCHAR(150) NOT NULL,
    genero VARCHAR(80),
    anio VARCHAR(4),
    imagen VARCHAR(255),
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO canciones (titulo, artista, genero, anio, imagen) VALUES
('Bohemian Rhapsody', 'Queen', 'Rock', '1975', ''),
('Shape of You', 'Ed Sheeran', 'Pop', '2017', ''),
('Blinding Lights', 'The Weeknd', 'Synthpop', '2019', '');
