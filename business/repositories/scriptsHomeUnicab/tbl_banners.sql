DROP TABLE IF EXISTS tbl_banners;

CREATE TABLE tbl_banners (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  visible int(11) NOT NULL,
  ruta varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  textoBoton varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  linkImagen varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  linkBoton varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  color varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  transparencia varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  porcentajeTop varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  porcentajeLeft varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_banners (visible, ruta, textoBoton, linkImagen, linkBoton, color, transparencia, porcentajeTop, porcentajeLeft) VALUES
(1, 'assets/img/banner.png', 'Agendar Entrevista', '', '', '51, 38, 21', '.5', '70', '70'),
(1, 'assets/img/banner2x.jpg', 'Haz crecer tus ideas con tecnología. ¡Contáctanos!', '', 'business/solutions/pages/somos.php', '51, 38, 21', '.5', '70', '45');

