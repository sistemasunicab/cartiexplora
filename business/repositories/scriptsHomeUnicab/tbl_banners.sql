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
  target varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  linkBoton varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  color varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  transparencia varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  porcentajeTop varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  porcentajeLeft varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  texto varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  porcentajeTopTexto varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  porcentajeLeftTexto varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  milisegundosSlide varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_banners (visible, tipo, ruta, rutaMovil, rutaTabletaVertical, rutaTabletaHorizontal, textoBoton, linkImagen, linkBoton, color, transparencia, porcentajeTop, porcentajeLeft, texto, porcentajeTopTexto, porcentajeLeftTexto, milisegundosSlide) VALUES
(1, 'imagen', 'assets/img/grupo_de_trabajo1.png', 'assets/img/grupo_de_trabajo3.png', 'assets/img/grupo_de_trabajo3.png', 'assets/img/grupo_de_trabajo2.png', 'Modelo pedagógico', '', 'business/org/pages/modelo.php', '254, 145, 0', '1', '60', '50', '<b>Detrás de cada logro, un gran equipo</b>', '35', '50', '5000'),
(1, 'imagen', 'assets/img/unicab_solutions1.png', 'assets/img/unicab_solutions3.png', 'assets/img/unicab_solutions3.png', 'assets/img/unicab_solutions2.png', 'Conócenos', '', 'business/solutions/pages/somos.php', '254, 145, 0', '1', '70', '50', '<b>¿Necesitas software único?<br>Nosotros lo creamos</b>', '25', '50', '3000'),
(1, 'imagen', 'assets/img/carti_explora1.png', 'assets/img/carti_explora3.png', 'assets/img/carti_explora3.png', 'assets/img/carti_explora2.png' ,'Ir CARTI', '', 'business/cartiExplora/pages/cartiHome.php', '254, 145, 0', '1', '70','50', '<b>Carti Explora, un mundo <br> para pequeños exploradores</b>', '25', '50', '3000'),
(1, 'video', 'assets/media/videobanner1.mp4', 'assets/media/videobanner3.mp4', 'assets/media/videobanner3.mp4', 'assets/media/videobanner2.mp4' ,'', '', '', '', '', '','', '', '', '', '39000'),
(1, 'imagen', 'assets/img/convocatiaSemillero_pc.jpg', 'assets/img/convocatiaSemillero_movil.jpg', 'assets/img/convocatiaSemillero_tableta.jpg', 'assets/img/convocatiaSemillero_pc.jpg' ,'Más información', '', 'https://unicab.org/assets/descargas/3a_convocatoria_Semillero_2025.pdf', '254, 145, 0', '1', '70','50', '', '', '', '5000')
;