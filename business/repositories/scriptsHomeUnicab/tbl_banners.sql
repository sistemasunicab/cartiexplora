DROP TABLE IF EXISTS tbl_banners;

CREATE TABLE tbl_banners (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  visible int(11) NOT NULL,
  tipo varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  ruta varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  rutaMovil varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  rutaTabletaVertical varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  rutaTabletaHorizontal varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  textoBoton varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  linkImagen varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  linkBoton varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  color varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  transparencia varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  porcentajeTop varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  porcentajeLeft varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  texto varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  porcentajeTopTexto varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  porcentajeLeftTexto varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  milisegundosSlide varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_banners (visible, tipo, ruta, rutaMovil, rutaTabletaVertical, rutaTabletaHorizontal, textoBoton, linkImagen, linkBoton, color, transparencia, porcentajeTop, porcentajeLeft, texto, porcentajeTopTexto, porcentajeLeftTexto, milisegundosSlide) VALUES
(1, 'imagen', 'assets/img/banner.png', 'assets/img/banner_movil.jpg', 'assets/img/banner_movil.jpg', 'assets/img/banner_tableta.jpg', 'Agendar Entrevista', '', '', '254, 145, 0', '1', '60', '50', '', '', '', '2000'),
(1, 'imagen', 'assets/img/banner2x.jpg', 'assets/img/banner2x_movil.png', 'assets/img/banner2x_movil.png', 'assets/img/banner2x_tablet.png', 'Haz crecer tus ideas con tecnología. ¡Contáctanos!', '', 'business/solutions/pages/somos.php', '254, 145, 0', '1', '60', '50', '', '', '', '2000'),
(1, 'imagen', 'assets/img/estudia_con_nosotros_escritorio.jpg', 'assets/img/estudia_con_nosotros_movil.jpg', 'assets/img/estudia_con_nosotros_movil.jpg', 'assets/img/estudia_con_nosotros_tablet.jpg' ,'Descúbrelo aquí', '', '', '254, 145, 0', '1', '70','50', '<b>Haz crecer</b> tus ideas', '45', '50', '2000'),
(1, 'video', 'assets/media/media.mp4', 'assets/media/media.mp4', 'assets/media/media.mp4', 'assets/media/media.mp4' ,'', '', '', '', '', '','', '', '', '', '5000');