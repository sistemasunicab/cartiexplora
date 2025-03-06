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
('banner', 1, 'home', '', '', ''),
('ofertaAcademica', 1, 'home', 'Oferta Académica', '', ''),
('descubreTusHabilidades', 1, 'home', 'Descubre Tus Habilidades', 'CARTI EXPLORA', 'Centro de Alto Rendimiento Para el Talento y la Inteligencia'),
('inscripcionesAbiertas', 1, 'home', 'Inscripciones Abiertas', '2025', 'Llámanos o escríbenos'),
('indicadores', 1, 'home', 'Indicadores que hablan de nosotros', '', ''),
('conoceNuetroCampus', 1, 'home', 'Conoce', 'Nuestro Campus', 'CARTI EXPLORA es el Centro de Alto Rendimiento para el Talento y la Inteligencia, es el CAMPUS de UNICAB Corporación Educativa ubicado en el Municipio de Sogamoso para servir a estudiantes de la región, el departamento y el país a través de espacios de aprendizaje que como un laboratorio les permite a los estudiantes explorar su curiosidad, sus habilidades personales, de pensamiento,  interactuando directamente con el deporte, la naturaleza, el arte, la ciencia, la cultura, la tecnología, y estimulando la creatividad, la investigación y el desarrollo socioemocional de manera autónoma.'),
('zonaDeEnlaces', 1, 'home', 'Zona de Enlaces', '', ''),
('blogConectados', 1, 'home', 'Blog', '', ''),
('navBar', 1, 'home', '', '', ''),
('footer', 1,'home', '', '', '');

INSERT INTO tbl_secciones (seccion, visible, paginaPadre, titulo, subTitulo, texto) VALUES ('nuestrosEstudiantes', 1, 'nuestrosEstudiantes', '<b>Nuestros</b><br>Estudiantes', '', '');
INSERT INTO tbl_secciones (seccion, visible, paginaPadre, titulo, subTitulo, texto) VALUES ('publicacionesAcademicas', 1, 'publicacionesAcademicas', '<b>Publicaciones</b> Académicas', '', '');
INSERT INTO tbl_secciones (seccion, visible, paginaPadre, titulo, subTitulo, texto) VALUES ('principiosYValores', 1, 'principiosYValores', '<b>Principios y</b><br>Valores Corporativos', '', 'UNICAB, es una institución de educación formal que propende por la formación integral de todos y cada uno de susestudiantes; pero cuando hablamos de formación, nos trasladamos a un contexto totalmente innovador, pues es aquí donde a través de nuestra estructura curricular, la formación es el resultado autónomo y consciente del estudiante en lo que refiere a un proceso de aprendizaje definido y una metodología de enseñanza flexible, dinámica y pertinente basados en principios éticos para que junto con el desarrollo de capacidades, habilidades y destrezas en áreas específicas, puedan tener un excelente desempeño y proyectar un proyecto de vida armónico con identidad, que corresponda a sus sueños e ilusiones y habilidades.');
INSERT INTO tbl_secciones (seccion, visible, paginaPadre, titulo, subTitulo, texto) VALUES ('cartiHome', 1, 'cartiHome', '<b>CARTI</b> Explora', '', '');
