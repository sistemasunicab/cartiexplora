DROP TABLE IF EXISTS tbl_contactos;

CREATE TABLE tbl_contactos (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  correo varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  asunto varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  mensaje varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  fecha date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

