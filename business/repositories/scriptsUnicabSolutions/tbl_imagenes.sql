DROP TABLE tbl_imagenes;

CREATE TABLE tbl_imagenes (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_seccion int(11) UNSIGNED NOT NULL,
  ruta varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  descripcion varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  titulo varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  posicionTitulo varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  enlace varchar(200) NOT NULL DEFAULT '',
  rutaEncima varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  textoAlterno varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  INDEX fk_tbl_imagenes_tbl_secciones (id_seccion),
  CONSTRAINT fk_tbl_imagenes_tbl_secciones FOREIGN KEY (id_seccion) REFERENCES tbl_secciones (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_imagenes (id_seccion, ruta, descripcion, titulo, posicionTitulo, enlace, rutaEncima, textoAlterno) VALUES
(1, 'assets/img/solutions-imagen-hero.png', '', '', '', '', '', ''),
(2, 'assets/img/solutions-icon-sistemas.png', '', 'Diseño de Sistemas y Material Educativo Innovador', 'abajo', '/cartiexplora/business/solutions/pages/disenoSistemas.php', '', ''),
(2, 'assets/img/solutions-icon-desarrollo.png', '', 'Diseño y Desarrollo de Software', 'abajo', '', '', ''),
(2, 'assets/img/solutions-icon-transformacion.png', '', 'Capacitación en Transformación Digital', 'abajo', '', '', ''),
(2, 'assets/img/solutions-icon-capacitacion.png', '', 'Servicios de capacitación con metodología virtual, e híbrida en diferentes modalidades', 'abajo', '', '', ''),
(3, 'assets/img/solutions-imagen-sistemas2x.png', '', '', '', '', '', ''),
(4, 'assets/img/solutions-imagen-desarrollo2x.png', '', '', '', '', '', ''),
(5, 'assets/img/solutions-imagen-transformacion2x.png', '', '', '', '', '', ''),
(6, 'assets/img/solutions-imagen-capacitacion2x.png', '', '', '', '', '', '');