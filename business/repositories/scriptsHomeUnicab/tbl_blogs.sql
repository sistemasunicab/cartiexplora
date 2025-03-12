DROP TABLE IF EXISTS tbl_blogs;

CREATE TABLE tbl_blogs (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  idAdministrador int(11) NOT NULL,
  idCategoria int(2) NOT NULL,
  titulo varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  descripcionPrincipal varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  descripcionSecundaria mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  imagen varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  imagenEncima varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  fechaPublicacion date DEFAULT NULL,
  estadoRevisionTexto int(2) NOT NULL DEFAULT 0,
  estadoRevisionMultimedia int(2) NOT NULL DEFAULT 0,
  autor varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '',
  textoBoton varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT 'Leer más'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_blogs 
(idAdministrador, idCategoria, titulo, descripcionPrincipal, descripcionSecundaria, imagen, imagenEncima, fechaPublicacion, estadoRevisionTexto, estadoRevisionMultimedia, autor) 
VALUES 
(18, 3, 'Titulo Test', 'Hola! esto es una descripcion test.', 'test', 'assets/img/blogtestover.png', 'assets/img/cc1.png', '2024-12-19', 0, 0, 'Miguel'),
(18, 3, 'Titulo Test', 'Hola! esto es una descripcion test.', 'test', 'assets/img/blogtestover.png', 'assets/img/cc1.png', '2024-12-19', 0, 0, 'Miguel'),
(18, 3, 'Titulo Test2', 'Test ddescripcion', 'test', 'assets/img/blogtestover.png', 'assets/img/cc1.png', '2024-12-19', 0, 0, 'Miguel'),
(18, 3, 'Titulo Test3', 'Test ddescripcion', 'test', 'assets/img/blogtestover.png', 'assets/img/cc1.png', '2024-12-19', 0, 0, 'Miguel'),
(18, 3, 'Titulo Test4', 'Test ddescripcion', 'test', 'assets/img/blogtestover.png', 'assets/img/cc1.png', '2024-12-19', 0, 0, 'Miguel'),

(18, 3, '¿QUÉ HACE EL GIU?', 'Apreciados lectores, <br><br> Para el año 2018, un grupo de profesionales de las más altas calidades humanas y pedagógicas, liderado por la Rectoría y la Coordinación Académica, puso al servicio de la comunidad un Modelo Pedagógico, producto de un trabajo intenso de investigación y desarrollo. Posteriormente y con el ánimo de dar soporte a la actividad académica de la institución en trabajos de investigación pertinentes y eficientemente coordinados, que pudieran ser presentados ante entidades de vigilancia educativa, así como para la participación en eventos académicos a nivel regional, nacional e internacional y como base para los trabajos de investigación que los tutores pudieran realizar, mediante Acta 001 del 30 de abril de 2019, la Rectoría del Colegio UNICAB Virtual formaliza la creación del Grupo de Investigación de UNICAB, en adelante GIU. <br><br> La primera acción a ejecutar por el GIU, de carácter urgente, dada la apremiante necesidad de defender el Modelo Pedagógico ante la Secretaría de Educación de Sogamoso, fue la consolidación del proceso histórico, el desarrollo metodológico y la estructura teórica de la educación virtual que ofrece UNICAB, como referente de Educación Básica y Media en Colombia. <br><br> Aquí, vale la pena hacer una aclaración: En Colombia, la educación escolar virtual es legal pero no está reglamentada lo que supuso un compromiso decidido de UNICAB por demostrar de manera tangible con hechos y documentos, que dicha alternativa educativa era viable y favorable. No había en ese momento, ni hay en la actualidad más que UNICAB, como referente de dicha pedagogía netamente virtual (existen híbridos, pero virtual solo UNICAB). <br><br> Echarse al hombro dicha responsabilidad, implicaba un trabajo decidido y constante y, en consecuencia, se da inicio formal al Grupo de investigación, estableciendo su Misión y se definiendo los primeros objetivos específicos. <br><br> <span class="font-roboto-bolditalic">Misión del GIU</span> <br><br> El GIU, tiene como Misión ser un dinamizador de la investigación en Educación virtual para educación Básica y Media en Colombia, para crear, absorber, integrar y reconfigurar conocimiento. El fin mismo del GIU, es fortalecer los procesos de investigación, establecer interacciones y redes con el sector académico y el productivo para la implementación de proyectos que le aporten al desarrollo de la región y el país. De igual manera, se propone estimular la transferencia, asimilación, adaptación, difusión del conocimiento e innovación pedagógica virtual generados en UNICAB para contribuir al desarrollo regional y nacional, atender las necesidades educativas de las familias y promover una cultura de progreso y sostenibilidad desde la virtualidad. <br><br><span class="font-roboto-bolditalic">Objetivos del GIU</span><br><br> 1. Desarrollar investigación, desde un enfoque multidisciplinario dado por los Pensamientos establecidos en el Proyecto Educativo Institucional, PEI, para fortalecer el desarrollo humano de la comunidad educativa que atiende UNICAB. <br><br>2. Contribuir al desarrollo de habilidades, talentos y destrezas a nivel investigativo de tutores y estudiantes desde un enfoque colaborativo y participativo. <br><br>3. Promover el uso del conocimiento sobre educación virtual para el mejoramiento de la calidad de vida de la comunidad educativa UNICAB. <br><br>4. Ofrecer y prestar servicios de asesoría en investigación e intervención a instituciones y entidades públicas y privadas en programas y proyectos relacionados con educación virtual para educación Básica y Media en Colombia. <br><br>5. Ofrecer oportunidades para desarrollar investigaciones interdisciplinarias con otros grupos a nivel regional, nacional e internacional, desde metodologías participativas. <br><br>6. Los demás objetivos específicos que surjan en el desarrollo de la actividad de investigación del GIU', 'test', 'assets/img/blogtestover.png', 'assets/img/cc1.png', '2024-09-05', 0, 0, 'Grupo de investigacion de Unicab, GIU');
  
--En idAdministrador por ahora poner 18
--En idCategoria por ahora poner 3

