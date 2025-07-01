DROP TABLE IF EXISTS tbl_circulares;

CREATE TABLE tbl_circulares (
  id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombreArchivo VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  ruta VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  destino varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  linkLeer varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  visible TINYINT(1) NOT NULL DEFAULT 1,
  titulo varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  id_seccion INT(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_circulares (nombreArchivo, ruta, destino, linkLeer, visible, titulo, id_seccion)  VALUES 
('Costos Educación Regular', 'https://unicab.org/assets/descargas/costos/Circular_029_Costos_educación_regular_2024.pdf', '_blank', '', 1, 'CIRCULAR GENERAL N° 029 De 15 de diciembre de 2023 Colegio Regular', 40),
('Costos Educación por Ciclos', 'https://unicab.org/assets/descargas/costos/Circular_030_Costos_educación_ciclos_2024.pdf', '_blank', '', 1, 'CIRCULAR GENERAL N° 030 De 15 de diciembre de 2023 Educación Ciclos', 40)
;

INSERT INTO tbl_circulares (nombreArchivo, ruta, destino, linkLeer, visible, titulo, id_seccion)  VALUES 
('Notas Contables 2020', 'https://unicab.org/assets/pdfs/NOTAS_CONTABLES_2020.pdf', '_blank', '', 1, 'Notas Contables 2020', 25),
('Estados de Situación Financiera', 'https://unicab.org/assets/pdfs/SF_BASICO.pdf', '_blank', '', 1, 'Estados de Situación Financiera', 25),
('Estado de Resultados', 'https://unicab.org/assets/pdfs/ESF_BASICO.pdf', '_blank', '', 1, 'Estado de Resultados', 25)
;

