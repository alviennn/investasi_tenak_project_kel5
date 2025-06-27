CREATE TABLE ternaks (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_petani BIGINT UNSIGNED NOT NULL,
    nama VARCHAR(255) NOT NULL,
    jenis ENUM('ayam', 'sapi', 'kambing', 'bebek', 'ikan') NOT NULL,
    status ENUM('active', 'inactive', 'pending') DEFAULT 'pending',
    lokasi VARCHAR(255),
    deskripsi TEXT,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (id_petani) REFERENCES users(id) ON DELETE CASCADE
);
