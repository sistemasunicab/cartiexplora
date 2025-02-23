DROP TABLE tbl_sentencias;

CREATE TABLE tbl_sentencias (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  campos varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  tablas varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  condiciones varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  agrupaciones varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  ordenamientos varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  modificaciones varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  condicionesAgrupaciones varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_sentencias (campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones) VALUES
('SELECT * ', 'FROM tbl_menus ', 'WHERE nivel = |x| AND padre = |y| AND visible = 1 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_banners ', 'WHERE visible = 1 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 1 AND visible = 1 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 2 AND visible = 1 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 3 AND visible = 1 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 4 AND visible = 1 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 5 AND visible = 1 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 6 AND visible = 1 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 7 AND visible = 1 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 8 AND visible = 1 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 9 AND visible = 1 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 10 AND visible = 1 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_parametros ', 'WHERE parametro = |telefono_admisiones| ', '', '', '', ''),
('SELECT * ', 'FROM tbl_parametros ', 'WHERE parametro = |correo_admisiones| ', '', '', '', ''),
('SELECT * ', 'FROM tbl_parametros ', 'WHERE parametro = |direccion_unicab| ', '', '', '', ''),
('SELECT * ', 'FROM tbl_parametros ', 'WHERE parametro = |ubicacion_unicab| ', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 2 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 3 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 4 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 5 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 6 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 7 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 8 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 9 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 10 AND id < 39 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_menus ', 'WHERE visible = 1 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_blogs ', 'WHERE id > 0 ', '', 'ORDER BY id DESC LIMIT 3 ', '', ''),
('SELECT * ', 'FROM tbl_parametros ', 'WHERE id_seccion = 8 ', '', '', '', '');
('SELECT * ', 'FROM tbl_formularios ', 'WHERE id_seccion = 4 ', '', '', '', ''),
('INSERT ', 'INTO tbl_contactos ', '(nombre, correo, asunto, mensaje, fecha) VALUES (?, ?, ?, ?, ?) ', '', '', '', ''),
('SELECT * ', 'FROM tbl_parametros ', 'WHERE id_seccion = 4 OR id IN (1, 2) ', '', '', '', '');
