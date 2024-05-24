CREATE TABLE users(
    id int AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    fullname VARCHAR(255) NOT NULL,
    age INT,
    alamat VARCHAR(255),
    latitude DECIMAL(9,6),
    longitude DECIMAL(9,6),
    role ENUM('admin', 'user') DEFAULT 'user'
);

INSERT INTO users (id, email, password, username, fullname, age, alamat, latitude, longitude, role) VALUES
    (1, 'admin@gmail.com', '$2y$10$HxxVy9VLwVPMz8FYTDgi/.a0/jV4HZLnoIiB5G8riHPA8FHVB1FKq', 'admin', 'Admin', 20, 'Pasirkareumbi', '-6.579202', '107.753517', 'admin'),
    (2, 'company@gmail.com', '$2y$10$MgfioOqXtADRIzWzCnYeCOOYHlPQuFXr7id0Qp941hnPWRmtwa4xC', 'company', 'CV. Mekar Tani', 20, '', '', '', 'user')
    (3, 'user@gmail.com', '$2y$10$c.JFz0f.sRhTyHoX6wWbB.91fhQbppJfzk4yP7PF6/PYs0qs8/yja', 'user', 'User', 20, 'Cisurupan, Bandung', '-6.917349', '107.712885', 'user');

CREATE TABLE program_tanam (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    waktu INT NOT NULL,
    daerah VARCHAR(255) NOT NULL,
    hasil DECIMAL(10, 2) NOT NULL,
    gambar VARCHAR(255),
    jumlah INT NOT NULL,
    koordinat VARCHAR(255),
    latitude DECIMAL(9,6),
    longitude DECIMAL(9,6)
);

INSERT INTO program_tanam (id, nama, waktu, daerah, hasil, gambar, jumlah, koordinat, latitude, longitude) VALUES
    (1, 'Padi', 4, 'Subang, Jawa Barat', 7500000.00, '1.jpg', 10, '-', '-6.547082', '107.742275'),
    (2, 'Jagung', 3, 'Garut, Jawa Barat', 6000000.00, '2.jpg', 5, '-', '-7.210950', '107.886832');

CREATE TABLE alat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    deskripsi TEXT NOT NULL,
    spesifikasi TEXT NOT NULL,
    id_pemilik INT NOT NULL, 
    pemilik VARCHAR(255) NOT NULL,
    harga DECIMAL(10, 2) NOT NULL,
    gambar VARCHAR(255),
    lokasi VARCHAR(255) NOT NULL,
    latitude DECIMAL(9,6),
    longitude DECIMAL(9,6),
    FOREIGN KEY (id_pemilik) REFERENCES users(id)
);

INSERT INTO alat (id, nama, deskripsi, harga, gambar, spesifikasi, lokasi, id_pemilik, pemilik) VALUES
  (1, 'Kultivator', 'Kultivator untuk menggemburkan tanah dan menghilangkan gulma.', 500000.00, '1.jpg', 'Mesin 4-tak, 6 HP, lebar kerja 80 cm, kedalaman kerja 15 cm', 'Surabaya, Jawa Timur', 2, 'CV. Mekar Tani'),
  (2, 'Mesin Tanam Padi', 'Mesin semi-otomatis untuk menanam benih padi secara efisien.', 750000.00, '2.jpg', 'Mesin 4-tak, 6 HP, lebar kerja 80 cm, kedalaman kerja 15 cm', 'Malang, Jawa Timur', 2, 'CV. Mekar Tani'),
  (3, 'Traktor', 'Traktor serbaguna untuk menarik bajak, memotong rumput, dan mengangkut hasil panen.', 1500000.00, '3.jpg', 'Mesin diesel 4 silinder, 60 HP, 4WD, PTO', 'Sidoarjo, Jawa Timur', 2, 'CV. Mekar Tani'),
  (4, 'Rotavator', 'Rotavator untuk mencacah tanah dan mencampur pupuk serta bahan organik.', 1000000.00, '4.jpg', 'Mesin 4-tak, 13 HP, lebar kerja 100 cm, kedalaman kerja 20 cm', 'Gresik, Jawa Timur', 2, 'CV. Mekar Tani');

CREATE TABLE user_program_tanam (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_program_tanam INT,
    tanggal_mulai DATE,
    status VARCHAR(255),
    FOREIGN KEY (id_user) REFERENCES users(id),
    FOREIGN KEY (id_program_tanam) REFERENCES program_tanam(id)
);

CREATE TABLE panen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    id_program_tanam INT,
    tanggal_panen DATE,
    jumlah_panen DECIMAL(10, 2),
    FOREIGN KEY (id_user) REFERENCES users(id),
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
    nomor_rekening VARCHAR(12) NOT NULL, 
    atas_nama VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users(id) 
);

INSERT INTO rekening_pemilik (id, id_user, jenis_rekening, nama_bank, nomor_rekening, atas_nama) VALUES
    (1, 2, 'Bank', 'BCA', 8290329013, 'CV. Mekar Tani'),
    (2, 2, 'E-Wallet', 'Gopay', 082909890822, 'CV. Mekar Tani');
