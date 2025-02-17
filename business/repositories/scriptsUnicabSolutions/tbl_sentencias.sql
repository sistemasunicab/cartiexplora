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
('SELECT * ', 'FROM tbl_parametros ', 'WHERE parametro = |slogan_unicab_solutions| ', '', '', '', ''),
('SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 1 AND visible = 1 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 2 AND visible = 1 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 3 AND visible = 1 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 4 AND visible = 1 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 5 AND visible = 1 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 6 AND visible = 1 ', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 1', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 2', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 3', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 4', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 5', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 6', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id = 2', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id = 3', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id = 4', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id = 5', '', '', '', '');

