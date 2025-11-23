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
(1, 'assets/img/banner2xvertical.jpg', '', '', '', '', '', ''),
(2, 'assets/img/solutions-icon-sistemas.png', '', 'Diseño de Sistemas y <b>Material Educativo Innovador</b>', 'abajo', '/cartiexplora/business/solutions/pages/disenoSistemas.php', '', ''),
(2, 'assets/img/solutions-icon-desarrollo.png', '', 'Diseño y Desarrollo de <b>Software</b>', 'abajo', '/cartiexplora/business/solutions/pages/desarrolloSoftware.php', '', ''),
(2, 'assets/img/solutions-icon-transformacion.png', '', 'Capacitación en <b>Transformación Digital</b>', 'abajo', '/cartiexplora/business/solutions/pages/transformacionDigital.php', '', ''),
(2, 'assets/img/solutions-icon-capacitacion.png', '', 'Servicios de <b>capacitación con metodología virtual, e híbrida</b> en diferentes modalidades', 'abajo', '/cartiexplora/business/solutions/pages/capacitacion.php', '', ''),
(3, 'assets/img/solutions-imagen-sistemas2x.png', '', '', '', '', '', ''),
(3, 'assets/img/solutions-icon-sistemas.png', '', 'Diseño de Sistemas y <b>Material Educativo Innovador</b>', 'abajo', '/cartiexplora/business/solutions/pages/disenoSistemas.php', '', ''),
(4, 'assets/img/solutions-imagen-desarrollo2x.png', '', '', '', '', '', ''),
(4, 'assets/img/solutions-icon-desarrollo.png', '', 'Diseño y Desarrollo de <b>Software</b>', 'abajo', '/cartiexplora/business/solutions/pages/desarrolloSoftware.php', '', ''),
(5, 'assets/img/solutions-imagen-transformacion2x.png', '', '', '', '', '', ''),
(5, 'assets/img/solutions-icon-transformacion.png', '', 'Capacitación en <b>Transformación Digital</b>', 'abajo', '/cartiexplora/business/solutions/pages/transformacionDigital.php', '', ''),
(6, 'assets/img/solutions-imagen-capacitacion2x.png', '', '', '', '', '', ''),
(6, 'assets/img/solutions-icon-capacitacion.png', '', 'Servicios de <b>capacitación con metodología virtual, e híbrida</b> en diferentes modalidades', 'abajo', '/cartiexplora/business/solutions/pages/capacitacion.php', '', '');

INSERT INTO tbl_imagenes (id_seccion, ruta, descripcion, titulo, posicionTitulo, enlace, rutaEncima, textoAlterno) VALUES
(5, 'assets/img/Grupo 4@2x.png', '', 'Curso del <b>Desarrollo del Pensamiento Lógico</b>', 'abajo', '', '', '')
;