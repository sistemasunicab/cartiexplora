DROP TABLE IF EXISTS tbl_secciones;

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
('footer', 1,'home', '', '', ''),
('navBarSolutions', 1, 'home', '', '', ''),

('sobreNosotrosUnicab', 1,'sobreNosotros', '¿Qué es <b>UNICAB CORPORACIÓN EDUCATIVA?</b>', '', 'La UNIDAD DE CAPACITACIÓN EMPRESARIAL DE BOYACÁ “<b>UNICAB CORPORACIÓN EDUCATIVA</b>” es una institución sin ánimo de lucro, creada hace 23 años a través de la Secretaría de Participación Social de la Gobernación de Boyacá, que presta servicios de educación formal e informal con más de 23 años de experiencia y que cuenta con la siguiente estructura orgánica:'),
('sobreNosotrosImagenesUne', 1,'sobreNosotros', '', '', ''),
('sobreNosotrosEducacionFormal', 1,'sobreNosotros', '<b>Colegio</b><br> UNICAB Virtual', '(Educación Formal)', ''),
('sobreNosotrosImagenesDos', 1,'sobreNosotros', '', '', ''),
('sobreNosotrosQuinesSomos', 1,'sobreNosotros', '', '', ''),
('directorioInstitucional', 1, '', '<b>DIRECTORIO</b> INSTITUCIONAL','',''),
('calendarioAcademico', 1, '', '<b>CALENDARIO</b> ACADÉMICO','',''),
('calendarioProximoEvento', 1, '', 'Próximo evento','','Tiempo Restante'),
('comunicados', 1, '', 'COMUNICADOS','',''),

('lineaTiempo', 1, 'historia', 'Historia y Logros Alcanzados', '', ''),
('informacion', 1,'historia', '', '', ''),
('ecosistema', 1, 'historia', '', '', ''),
('nuestroModelo', 1, 'modelo', 'Nuestro Modelo Pedagógico', 'Ecosistema UNICAB', 'La educación del siglo XXI, mediada por TIC, debe estar orientada por maestros mediadores y orientadores del conocimiento, quienes estudian, investigan y acompañan los procesos de enseñanza-aprendizaje, haciendo posible que los estudiantes y sus familias sean el centro del desarrollo del quehacer pedagógico. <br> <br> El modelo se ha venido construyendo con un equipo de profesionales apasionados por servir en la educación de calidad, al que hemos denominado: <span class="font-roboto-black">“MODELO PEDAGÓGICO UNICAB VIRTUAL”.</span> Este se basa en pedagogías constructivistas, conceptuales y problematizadoras, y en él, directivos, administrativos y maestros mediadores del conocimiento, a través de la tecnología y la virtualidad, trabajan sobre tres líneas base, a saber:'),

('estadosFinancieros', 1, '','<b>ESTADOS</b> FINANCIEROS', '', ''),
('solicitudesCertificaciones', 1, '','<b>SOLICITUDES DE</b> CERTIFICACIONES Y PAPELES', '', ''),

('nuestrosEstudiantes', 1, 'nuestrosEstudiantes', '<b>Nuestros</b><br>Estudiantes', '', ''),
('publicacionesAcademicas', 1, 'publicacionesAcademicas', '<b>Publicaciones</b> Académicas', '', ''),
('principiosYValores', 1, 'principiosYValores', '<b>Principios y</b><br>Valores Corporativos', '', 'UNICAB, es una institución de educación formal que propende por la formación integral de todos y cada uno de susestudiantes; pero cuando hablamos de formación, nos trasladamos a un contexto totalmente innovador, pues es aquí donde a través de nuestra estructura curricular, la formación es el resultado autónomo y consciente del estudiante en lo que refiere a un proceso de aprendizaje definido y una metodología de enseñanza flexible, dinámica y pertinente basados en principios éticos para que junto con el desarrollo de capacidades, habilidades y destrezas en áreas específicas, puedan tener un excelente desempeño y proyectar un proyecto de vida armónico con identidad, que corresponda a sus sueños e ilusiones y habilidades.'),
('cartiHome', 1, 'cartiHome', '<b>CARTI</b> Explora', '', ''),

('busqueda', 1, 'blog', '<span class="font-roboto-black">Celebrando Logros y</span><br>Compartiendo Experiencias', '', ''),
('noticias', 1,'blog', 'Noticias Destacadas', '', ''),
('lastPost', 1, 'blog', '', '', ''),

('entrevista', 1, 'admisiones', 'Admisiones', 'Entrevistas', '');
