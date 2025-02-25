DROP TABLE IF EXISTS tbl_eventos;

CREATE TABLE tbl_eventos (
  id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre_evento VARCHAR(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  fecha_hora DATETIME NOT NULL,
  visible TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_eventos (nombre_evento, fecha_hora, visible)  
VALUES ('Finalización 4° periodo', '2025-06-30 00:00:00', 1);
