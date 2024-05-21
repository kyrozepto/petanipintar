CREATE TABLE users(
    Id int PRIMARY KEY AUTO_INCREMENT,
    Email varchar(200),
    Password varchar(200),
    Username varchar(200),
    Fullname varchar(200),
    Age int
);

CREATE TABLE program_tanam (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    waktu INT NOT NULL,
    daerah VARCHAR(255) NOT NULL,
    hasil DECIMAL(10, 2) NOT NULL,
    gambar VARCHAR(255)
);

CREATE TABLE alat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    deskripsi TEXT NOT NULL,
    harga DECIMAL(10, 2) NOT NULL,
    gambar VARCHAR(255)
);