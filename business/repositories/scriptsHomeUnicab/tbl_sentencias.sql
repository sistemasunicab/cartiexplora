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
('SELECT * ', 'FROM tbl_parametros ', 'WHERE parametro = |telefono_admisiones|', '', '', '', ''),
('SELECT * ', 'FROM tbl_parametros ', 'WHERE parametro = |correo_admisiones|', '', '', '', ''),
('SELECT * ', 'FROM tbl_parametros ', 'WHERE parametro = |direccion_unicab|', '', '', '', ''),
('SELECT * ', 'FROM tbl_parametros ', 'WHERE parametro = |ubicacion_unicab|', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 2', '', '', '', ''),
('SELECT * ', 'FROM tbl_menus ', 'WHERE nivel = |x| AND padre = |y| AND visible = 1', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 9', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 10', '', '', '', '');