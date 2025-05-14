DROP TABLE IF EXISTS tbl_publicaciones_academicas;

CREATE TABLE tbl_publicaciones_academicas (
  id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombreArchivo VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  fechaSubida DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  ruta VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  destino varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  linkLeer varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  visible TINYINT(1) NOT NULL DEFAULT 1,
  rutaImagen varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  descripcionImagen varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  titulo varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  texto varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_publicaciones_academicas (nombreArchivo, ruta, destino, linkLeer, visible, rutaImagen, descripcionImagen, titulo, texto)  VALUES 
('revista_talentos_dorados', '/assets/documents/org/prueba.txt', '_blank', '', 1, 'assets/img/portada_talentos.png', 'Portada Revista Talentos Dorados', 'Revista Talentos Dorados', 'Nuestro modelo educativo ECOSISTEMA UNICAB Virtual sumerge a los estudiantes con capacidades y talentos excepcionales dentro de un escenario formativo, que combina factores personales, sociales, económicos y culturales a través de la utilización de las TIC y el acompañamiento de maestros mediadores que orientan a estos talentos en una <q><em><b>nueva escuela que prioriza la diversificación, la tolerancia y el respeto a la individualidad, la diferencia y la diversidad, en donde se forman individuos únicos que desarrollan la multiplicidad de opciones que les ofrece la vida</b></em></q> (Adaotadi de German de Zubiria, 2013).'),
('ecosistema_apredizaje_digital', '/assets/documents/org/prueba.txt', '_blank', '', 1, 'assets/img/portada_ecosistemaAprendizaje.png', 'Portada Ecosistema de Aprendizaje Digital', 'Ecosistema de Aprendizaje Digital', 'Nuestro modelo educativo ECOSISTEMA UNICAB Virtual sumerge a los estudiantes con capacidades y talentos excepcionales dentro de un escenario formativo, que combina factores personales, sociales, económicos y culturales a través de la utilización de las TIC y el acompañamiento de maestros mediadores que orientan a estos talentos en una <q><em><b>nueva escuela que prioriza la diversificación, la tolerancia y el respeto a la individualidad, la diferencia y la diversidad, en donde se forman individuos únicos que desarrollan la multiplicidad de opciones que les ofrece la vida</b></em></q> (Adaotadi de German de Zubiria, 2013).'),
('proyecto_educacion_digital', '/assets/documents/org/prueba.txt', '_blank', '', 1, 'assets/img/portada_educacionDigital.png', 'Portada Proyecto de Educación Digital', 'Proyecto de Educación Digital', 'Nuestro modelo educativo ECOSISTEMA UNICAB Virtual sumerge a los estudiantes con capacidades y talentos excepcionales dentro de un escenario formativo, que combina factores personales, sociales, económicos y culturales a través de la utilización de las TIC y el acompañamiento de maestros mediadores que orientan a estos talentos en una <q><em><b>nueva escuela que prioriza la diversificación, la tolerancia y el respeto a la individualidad, la diferencia y la diversidad, en donde se forman individuos únicos que desarrollan la multiplicidad de opciones que les ofrece la vida</b></em></q> (Adaotadi de German de Zubiria, 2013).');

UPDATE tbl_publicaciones_academicas SET nombreArchivo = 'Revista_UNICAB.pdf', ruta = 'assets/documents/pdfs/Revista_UNICAB.pdf', linkLeer = 'assets/documents/pdfs/Revista_UNICAB.pdf' WHERE (id = 1);
UPDATE tbl_publicaciones_academicas SET nombreArchivo = 'ECOSISTEMA_DE_APRENDIZAJE_DIGITAL.pdf', ruta = 'assets/documents/pdfs/ECOSISTEMA_DE_APRENDIZAJE_DIGITAL.pdf', linkLeer = 'assets/documents/pdfs/ECOSISTEMA_DE_APRENDIZAJE_DIGITAL.pdf' WHERE (id = 2);
UPDATE tbl_publicaciones_academicas SET nombreArchivo = 'PROYECTO_DE_EDUCACION_DIGITAL.pdf', ruta = 'assets/documents/pdfs/PROYECTO_DE_EDUCACION_DIGITAL.pdf', linkLeer = 'assets/documents/pdfs/PROYECTO_DE_EDUCACION_DIGITAL.pdf' WHERE (id = 3);