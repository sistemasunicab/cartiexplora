DROP TABLE IF EXISTS tbl_circulares;

CREATE TABLE tbl_circulares (
  id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombreArchivo VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  ruta VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  destino varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  linkLeer varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  visible TINYINT(1) NOT NULL DEFAULT 1,
  titulo varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_circulares (nombreArchivo, ruta, destino, linkLeer, visible, titulo)  VALUES 
('nombreNuevoArchivo.txt', 'assets/documents/circulares/circulares.txt', '_blank', '', 1, 'CIRCULAR GENERAL N° 029 De 15 de diciembre de 2023');

