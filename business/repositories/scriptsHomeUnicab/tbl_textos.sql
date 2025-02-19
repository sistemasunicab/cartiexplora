DROP TABLE tbl_formularios;

CREATE TABLE tbl_textos (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_seccion int(11) UNSIGNED NOT NULL,
  paginaPadre varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  identificacion varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  texto mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  INDEX fk_tbl_textos_tbl_secciones (id_seccion),
  CONSTRAINT fk_tbl_textos_tbl_secciones FOREIGN KEY (id_seccion) REFERENCES tbl_secciones (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_textos (id_seccion, paginaPadre, identificacion, texto ) VALUES 
(0, 'historia', 'fundacion', 'UNICAB Corporación Educativa fue creada en la ciudad de Sogamoso mediante la Resolución No. 0194 del 18 de julio de 2001, emitida por la Gobernación de Boyacá. Desde su inicio, se estableció como una institución sin ánimo de lucro, con una filosofía de vida orientada a ofrecer el derecho-servicio educativo de manera innovadora y acorde a las necesidades de quienes participan en sus procesos, fomentando el intercambio de saberes y fortaleciendo el liderazgo de sus participantes.<br>Desde su creación y hasta el año 2007, UNICAB Corporación Educativa desarrolló diversos servicios:' ),
(0, 'historia', 'giu', 'Es un cuerpo colegiado de investigación conformado por un grupo de maestros y asesores externos, cuyo objetivo es adelantar desarrollos científicos, tecnológicos, pedagógicos y estrategias complementarias del modelo pedagógico UNICAB Ecosistema. Este grupo gestiona proyectos y propuestas de investigación coherentes, orientados a consolidar componentes cognitivos, propedéuticos, estratégicos, metodológicos y sinérgicos para desarrollar contenidos, secuencias y métodos de aprendizaje. Todo esto se aplica en la educación virtual de forma disruptiva e innovadora dentro de un entorno cibernético, formulando y respondiendo con rigor investigativo a uno o varios problemas del entorno. Además, proporciona soluciones y medidas correctivas mediante planes estratégicos de mediano y largo plazo, con el fin de generar conocimientos concretos sobre las temáticas abordadas.' );
