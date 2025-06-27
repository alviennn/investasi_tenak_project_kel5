CREATE TABLE laporan_pertumbuhan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_komoditas VARCHAR(20) NOT NULL UNIQUE,
    nama VARCHAR(100) NOT NULL,
    jenis ENUM('livestock', 'agriculture', 'fishery', 'poultry') NOT NULL,
    satuan_awal VARCHAR(50) NOT NULL,
    satuan_akhir VARCHAR(50) NOT NULL,
    pertumbuhan_persen DECIMAL(5,2) NOT NULL,
    status ENUM('Excellent', 'Good', 'Average', 'Poor') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
