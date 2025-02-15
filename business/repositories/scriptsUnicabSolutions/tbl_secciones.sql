CREATE TABLE tbl_secciones (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  seccion varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  visible int(11) NOT NULL,
  paginaPadre varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  titulo varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  subTitulo varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  texto varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_secciones (seccion, visible, paginaPadre, titulo, subTitulo, texto) VALUES
('hero', 1, 'home', 'Innovación y Soluciones Tecnológicas con <strong>UNICAB Solutions</strong>', '', 'En <strong>UNICAB Solutions</strong> transformamos ideas en soluciones tecnológicas que marcan la diferencia. Desde plataformas educativas personalizadas hasta software a medida y programas de capacitación en transformación digital, estamos aquí para revolucionar la forma en que aprendes, trabajas y lideras.<br><br>Nuestros servicios combinan innovación, personalización y tecnología avanzada para que alcances tus metas, sin importar el tamaño de tu proyecto o tu sector.'),
('servicios', 1, 'home', '', ' ', ''),
('disenoSistemas', 1, 'solutions', '', ' ', ''),
('desarrolloSoftware', 1, 'solutions', '', ' ', ''),
('transformacionDigital', 1, 'solutions', '', ' ', ''),
('capacitacion', 1, 'solutions', '', ' ', '');



