DROP TABLE tbl_secciones;

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
('disenoSistemas', 1, 'solutions', '', ' ', '<p><b>Desarrollo de plataformas educativas LMS </b>personalizadas, desarrollo de plataformas de contenidos académicos interactivos y gamificados según necesidades y modelo pedagógico, aplicaciones móviles para la educación formal e informal.</p><ul class="ul-solutions"><li><p><b>Diseño de plataformas educativas virtuales personalizadas (LMS):</b> Sistemas intuitivos y escalables que facilitan la enseñanza y el aprendizaje online.</p></li><li><p><b>Elaboración de materiales educativos digitales:</b> Contenidos interactivos y multimedia diseñados con metodologías pedagógicas modernas y personalizados.</p></li><li><p><b>Capacitación para docentes y estudiantes:</b> Formación en el uso de herramientas tecnológicas aplicadas a educación.</p></li></ul>'),
('desarrolloSoftware', 1, 'solutions', '', ' ', '<ul class="ul-solutions"><li><p><b>Programas para empresas:</b> Diseñamos herramientas que ayudan a organizar mejor las actividades de un negocio, llevar inventarios, gestionar ventas o coordinar proyectos.</p></li><li><p><b>Soluciones a la medida:</b> Si tienes una idea o necesidad específica, creamos un software personalizado para resolverla, ya sea en educación, producción, comercialización, logística, gerencia o cualquier área. </p> </li> <li> <p> <b>Tecnología moderna:</b> Usamos lo mejor en tecnología para que el software sea rápido, eficiente y fácil de usar. </p> </li> <li> <p> <b>Desarrollo desde cero:</b> Hacemos programas únicos, diseñados exclusivamente para ti, asegurando que cumplan exactamente con lo que buscas y en código puro. </p> </li> </ul>'),
('transformacionDigital', 1, 'solutions', '', ' ', '<ul class="ul-solutions"><li><p>Formación en el uso e implementación de <b>herramientas digitales avanzadas para potenciar procesos de enseñanza-aprendizaje</b> en instituciones educativas y empresas productivas. </p></li><li><p><b>Talleres prácticos y personalizados para la adopción efectiva tecnologías emergentes, </b> diseñados según las necesidades específicas de cada organización. </p></li><li><p>Programas de <b>capacitación en competencias digitales, </b> enfocados en empoderar a docentes, estudiantes y empleados para enfrentar los retos del entorno digital actual. </p></li></ul>'),
('capacitacion', 1, 'solutions', '', ' ', '<ul class="ul-solutions"><li><p><b>Capacitación en manejo de herramientas digitales para enseñanza aprendizaje para docentes</b> a través de cursos, diplomados y seminarios prácticos ajustados a las necesidades propias del grupo. </p></li><li><p><b>Formación y transformación de liderazgo digital para implementar procesos de cambio digital en los trabajadores</b> y asumir el crecimiento de sus organizaciones. </p></li></ul>');



