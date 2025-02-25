DROP TABLE IF EXISTS tbl_archivos;

CREATE TABLE tbl_archivos (
  id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre_archivo VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  fecha_subida DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  ruta VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  visible TINYINT(1) NOT NULL DEFAULT 1  -- 1 = Visible, 0 = No visible
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_archivos (nombre_archivo, ruta, visible)  
VALUES ('Documento importante', '/assets/documents/org/prueba.txt', 1);
