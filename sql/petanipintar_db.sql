CREATE TABLE users(
    Id int AUTO_INCREMENT PRIMARY KEY,
    Email VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Username VARCHAR(255) NOT NULL,
    Fullname VARCHAR(255) NOT NULL,
    Age INT,
    role VARCHAR(50) DEFAULT 'user'
);

CREATE TABLE program_tanam (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    waktu INT NOT NULL,
    daerah VARCHAR(255) NOT NULL,
    hasil DECIMAL(10, 2) NOT NULL,
    gambar VARCHAR(255),
    jumlah INT NOT NULL,
    koordinat VARCHAR(255)
);

CREATE TABLE alat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    deskripsi TEXT NOT NULL,
    harga DECIMAL(10, 2) NOT NULL,
    gambar VARCHAR(255)
);