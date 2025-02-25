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
('inscripcionesAbiertas', 1, 'home', 'Inscripciones Abiertas', '2025', 'Llámanos o escríbenos<br>p_telefono_admisiones<br>p_correo_admisiones'),
('indicadores', 1, 'home', 'Indicadores que hablan de nosotros', '', ''),
('conoceNuetroCampus', 1, 'home', 'Conoce', 'Nuestro Campus', 'CARTI EXPLORA es el Centro de Alto Rendimiento para el Talento y la Inteligencia, es el CAMPUS de UNICAB Corporación Educativa ubicado en el Municipio de Sogamoso para servir a estudiantes de la región, el departamento y el país a través de espacios de aprendizaje que como un laboratorio les permite a los estudiantes explorar su curiosidad, sus habilidades personales, de pensamiento,  interactuando directamente con el deporte, la naturaleza, el arte, la ciencia, la cultura, la tecnología, y estimulando la creatividad, la investigación y el desarrollo socioemocional de manera autónoma.'),
('zonaDeEnlaces', 1, 'home', 'Zona de Enlaces', '', ''),
('blogConectados', 1, 'home', 'Blog', '', ''),
('navBar', 1, 'home', '', '', ''),
('footer', 1,'home', '', '', '');

INSERT INTO tbl_secciones (seccion, visible, paginaPadre, titulo, subTitulo, texto) VALUES
('lineaTiempo', 1, 'historia', 'Historia y Logros Alcanzados', '', ''),
('informacion', 1,'historia', '', '', ''),
('ecosistema', 1, 'historia', '', '', ''),;

INSERT INTO tbl_secciones (seccion, visible, paginaPadre, titulo, subTitulo, texto) VALUES
('nuestroModelo', 1, 'modelo', 'Nuestro Modelo Pedagógico', 'Ecosistema UNICAB', 'La educación del siglo XXI, mediada por TIC, debe estar orientada por maestros mediadores y orientadores del conocimiento, quienes estudian, investigan y acompañan los procesos de enseñanza-aprendizaje, haciendo posible que los estudiantes y sus familias sean el centro del desarrollo del quehacer pedagógico. <br> <br> El modelo se ha venido construyendo con un equipo de profesionales apasionados por servir en la educación de calidad, al que hemos denominado: <span class="font-roboto-black">“MODELO PEDAGÓGICO UNICAB VIRTUAL”.</span> Este se basa en pedagogías constructivistas, conceptuales y problematizadoras, y en él, directivos, administrativos y maestros mediadores del conocimiento, a través de la tecnología y la virtualidad, trabajan sobre tres líneas base, a saber:');
