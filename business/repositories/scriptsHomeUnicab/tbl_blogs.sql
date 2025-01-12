CREATE TABLE tbl_blogs (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  idAdministrador int(11) NOT NULL,
  idCategoria int(2) NOT NULL,
  titulo varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  descripcionPrincipal varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  descripcionSecundaria mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  imagen varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  fechaPublicacion date DEFAULT NULL,
  estadoRevisionTexto int(2) NOT NULL DEFAULT 0,
  estadoRevisionMultimedia int(2) NOT NULL DEFAULT 0,
  autor varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '',
  textoBoton varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'Leer más'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--En idAdministrador por ahora poner 18
--En idCategoria por ahora poner 3

