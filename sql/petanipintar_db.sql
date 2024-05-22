CREATE TABLE users(
    Id int AUTO_INCREMENT PRIMARY KEY,
    Email VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Username VARCHAR(255) NOT NULL,
    Fullname VARCHAR(255) NOT NULL,
    Age INT,
    role ENUM('admin', 'user') DEFAULT 'user'
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
    spesifikasi TEXT NOT NULL,
    lokasi VARCHAR(255) NOT NULL,
    id_pemilik INT NOT NULL, 
    pemilik VARCHAR(255) NOT NULL,
    harga DECIMAL(10, 2) NOT NULL,
    gambar VARCHAR(255),
    FOREIGN KEY (id_pemilik) REFERENCES users(id)
);

CREATE TABLE user_program_tanam (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_program_tanam INT,
    tanggal_mulai DATE,
    status VARCHAR(255),
    FOREIGN KEY (id_user) REFERENCES users(Id),
    FOREIGN KEY (id_program_tanam) REFERENCES program_tanam(id)
);

CREATE TABLE panen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_program_tanam INT,
    tanggal_panen DATE,
    jumlah_panen DECIMAL(10, 2),
    FOREIGN KEY (id_user) REFERENCES users(Id),
    FOREIGN KEY (id_program_tanam) REFERENCES program_tanam(id)
);

CREATE TABLE sewa_alat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    id_alat INT NOT NULL,
    tanggal_sewa TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    metode_pembayaran VARCHAR(255) NOT NULL,
    status_pembayaran ENUM('Belum Dibayar', 'Menunggu Konfirmasi', 'Pembayaran Ditolak', 'Lunas', 'Dibatalkan') DEFAULT 'Belum Dibayar',
    status_distribusi ENUM('Menunggu Pembayaran', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan') DEFAULT 'Menunggu Pembayaran',
    FOREIGN KEY (id_user) REFERENCES users(id),
    FOREIGN KEY (id_alat) REFERENCES alat(id)
);

CREATE TABLE rekening_pemilik (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    jenis_rekening ENUM('Bank', 'E-Wallet') NOT NULL,
    nama_bank VARCHAR(255), 
    nomor_rekening VARCHAR(255) NOT NULL, 
    atas_nama VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users(id) 
);