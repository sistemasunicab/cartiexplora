CREATE TABLE tbl_imagenes (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_seccion int(11) UNSIGNED NOT NULL,
  ruta varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  descripcion varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  titulo varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  posicionTitulo varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  rutaEncima varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  textoAlterno varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  INDEX fk_tbl_imagenes_tbl_secciones (id_seccion),
  CONSTRAINT fk_tbl_imagenes_tbl_secciones FOREIGN KEY (id_seccion) REFERENCES tbl_secciones (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_imagenes (id_seccion, ruta, descripcion, titulo, posicionTitulo, rutaEncima, textoAlterno) VALUES
(2, 'assets/img/boton_primaria.png', 'botonPrimaria', '', '', 'assets/img/boton_over_primaria.png', ''),
(2, 'assets/img/boton_bachillerato.png', 'botonBachillerato', '', '', 'assets/img/boton_over_bachillerato.png', ''),
(2, 'assets/img/boton_ciclos.png', 'botonCiclos', '', '', 'assets/img/boton_over_ciclos.png', '');

