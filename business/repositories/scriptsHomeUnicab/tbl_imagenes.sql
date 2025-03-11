DROP TABLE tbl_imagenes;

CREATE TABLE tbl_imagenes (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_seccinon it(11) UNSIGNED NOT NULL,
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
(2, 'assets/img/boton_ciclos.png', 'botonCiclos', '', '', 'assets/img/boton_over_ciclos.png', ''),
(3, 'assets/img/Grupo_tiroarco.png', 'tiroArco', 'Tiro con Arco', 'abajo', '', ''),
(3, 'assets/img/Grupo_afisica.png', 'actividadFisica', 'A. Físico', 'abajo', '', ''),
(3, 'assets/img/Grupo_parkour.png', 'parkour', 'Parkour', 'abajo', '', ''),
(3, 'assets/img/Grupo_pintura.png', 'pintura', 'Pintura', 'abajo', '', ''),
(3, 'assets/img/Grupo_danza.png', 'danza', 'Danza', 'abajo', '', ''),
(3, 'assets/img/Grupo_cambiente.png', 'cambiente', 'C. Ambiente', 'abajo', '', ''),
(3, 'assets/img/Grupo_bmx.png', 'bmx', 'BMX', 'abajo', '', ''),
(3, 'assets/img/Grupo_cocina.png', 'cocina', 'Cocina', 'abajo', '', ''),
(3, 'assets/img/Grupo_lectura.png', 'lectura', 'Lectura', 'abajo', '', ''),
(3, 'assets/img/Grupo_musica.png', 'musica', 'Música', 'abajo', '', ''),
(3, 'assets/img/Grupo_coral.png', 'coral', 'Coral', 'abajo', '', ''),
(3, 'assets/img/Grupo_granja.png', 'granja', 'Granja', 'abajo', '', ''),
(5, 'assets/img/estudiantes.png', 'estudiantes', 'Estudiantes', 'derecha', '', ''),
(5, 'assets/img/graduados.png', 'graduados', 'Graduados', 'derecha', '', ''),
(5, 'assets/img/egresados.png', 'egresados', 'Egresados', 'derecha', '', ''),
(6, 'assets/img/cc1.png', 'cc1', '', '', '', ''),
(6, 'assets/img/cc2.png', 'cc2', '', '', '', ''),
(6, 'assets/img/cc3.png', 'cc3', '', '', '', ''),
(7, 'assets/img/nuestros_estudiantes.png', 'nuestrosEstudiantes', 'Nuestros estudiantes', 'derecha', '', ''),
(7, 'assets/img/calendario.png', 'calendario', 'Calendario académico', 'derecha', '', ''),
(7, 'assets/img/entidades.png', 'entidades', 'Entidades que nos vigilan', 'derecha', '', ''),
(7, 'assets/img/egresados.png', 'egresados', 'Egresados', 'derecha', '', ''),
(7, 'assets/img/manual.png', 'manual', 'Manual de convivencia', 'derecha', '', ''),
(7, 'assets/img/evidencias.png', 'evidencias', 'Evidencias de congresos y reconocimientos', 'derecha', '', ''),
(7, 'assets/img/testimonios.png', 'testimonios', 'Testimonios', 'derecha', '', ''),
(7, 'assets/img/biblioteca.png', 'biblioteca', 'Biblioteca', 'derecha', '', ''),
(7, 'assets/img/atencion.png', 'atencion', 'Padres de Familia: Horarios de atención', 'derecha', '', ''),
(7, 'assets/img/directorio.png', 'directorio', 'Directorio', 'derecha', '', ''),
(7, 'assets/img/investigacion.png', 'investigacion', 'Investigación', 'derecha', '', ''),
(8, 'assets/img/conectados.png', 'conectados', '', '', '', ''),
(8, 'assets/img/enviar.png', 'enviar', '', '', '', ''),
(9, 'assets/img/unicab.png', 'logoUnicab', '', '', '', ''),
(10, 'assets/img/unicab.png', 'logoUnicab', 'Colegio Unicab Virtual', '', '', ''),
(10, 'assets/img/carti_explora.png', 'logoCartiExplora', 'CARTI Explora', '', '', ''),
(10, 'assets/img/unicab_solutions.png', 'logoUnicabSolutions', 'UNICAB Solutions', '', '', ''),
(10, 'assets/img/facebook.png', 'facebook', '', '', '', ''),
(10, 'assets/img/x.png', 'x', '', '', '', ''),
(10, 'assets/img/instagram.png', 'instagram', '', '', '', ''),
(10, 'assets/img/youtube.png', 'youtube', '', '', '', '');

INSERT INTO tbl_imagenes (id_seccion, ruta, descripcion, titulo, posicionTitulo, rutaEncima, textoAlterno) VALUES (15, 'assets/img/conectados.png', '', '', 'abajo', '', '');

INSERT INTO tbl_imagenes (id_seccion, ruta, descripcion, titulo, posicionTitulo, rutaEncima, textoAlterno) VALUES 
(17, 'assets/img/enviar.png', '', 'Suscribir', 'izquierda', '', ''), 
(17, 'assets/img/love.png', '', '', '', '', ''), 
(17, 'assets/img/chatIcon.png', '', '', '', '', ''), 
(17, 'assets/img/shareIcon.png', '', 'Compartir en', 'izquierda', '', ''), 
(17, 'assets/img/facebookOrangeBg.png', '', '', '', '', ''), 
(17, 'assets/img/instagramOrangeBg.png', '', '', '', '', ''), 
(17, 'assets/img/linkedInOrangeBg.png', '', '', '', '', ''), 
(17, 'assets/img/whatsappOrangeBg.png', '', '', '', '', '');

