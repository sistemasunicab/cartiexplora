
DROP TABLE IF EXISTS tbl_imagenes;

CREATE TABLE tbl_imagenes (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_seccion int(11) UNSIGNED NOT NULL,
  ruta varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  rutaMovil varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  rutaTabletaVertical varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  rutaTabletaHorizontal varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  descripcion varchar(800) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  titulo varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  posicionTitulo varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  enlace varchar(200) NOT NULL DEFAULT '',
  rutaEncima varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  textoAlterno varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  INDEX fk_tbl_imagenes_tbl_secciones (id_seccion),
  CONSTRAINT fk_tbl_imagenes_tbl_secciones FOREIGN KEY (id_seccion) REFERENCES tbl_secciones (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_imagenes (id_seccion, ruta, rutaMovil, rutaTabletaVertical, rutaTabletaHorizontal, descripcion, titulo, posicionTitulo, rutaEncima, textoAlterno) VALUES
(2, 'assets/img/boton_primaria.png', '', '', '', 'botonPrimaria', '', '', 'assets/img/boton_over_primaria.png', ''),
(2, 'assets/img/boton_bachillerato.png', '', '', '', 'botonBachillerato', '', '', 'assets/img/boton_over_bachillerato.png', ''),
(2, 'assets/img/boton_ciclos.png', '', '', '', 'botonCiclos', '', '', 'assets/img/boton_over_ciclos.png', ''),
(3, 'assets/img/Grupo_tiroarco.png', '', '', '', 'tiroArco', 'Tiro con Arco', 'abajo', '', ''),
(3, 'assets/img/Grupo_afisica.png', '', '', '', 'actividadFisica', 'A. Físico', 'abajo', '', ''),
(3, 'assets/img/Grupo_parkour.png', '', '', '', 'parkour', 'Parkour', 'abajo', '', ''),
(3, 'assets/img/Grupo_pintura.png', '', '', '', 'pintura', 'Pintura', 'abajo', '', ''),
(3, 'assets/img/Grupo_danza.png', '', '', '', 'danza', 'Danza', 'abajo', '', ''),
(3, 'assets/img/Grupo_cambiente.png', '', '', '', 'cambiente', 'C. Ambiente', 'abajo', '', ''),
(3, 'assets/img/Grupo_bmx.png', '', '', '', 'bmx', 'BMX', 'abajo', '', ''),
(3, 'assets/img/Grupo_cocina.png', '', '', '', 'cocina', 'Cocina', 'abajo', '', ''),
(3, 'assets/img/Grupo_lectura.png', '', '', '', 'lectura', 'Lectura', 'abajo', '', ''),
(3, 'assets/img/Grupo_musica.png', '', '', '', 'musica', 'Música', 'abajo', '', ''),
(3, 'assets/img/Grupo_coral.png', '', '', '', 'coral', 'Coral', 'abajo', '', ''),
(3, 'assets/img/Grupo_granja.png', '', '', '', 'granja', 'Granja', 'abajo', '', ''),
(5, 'assets/img/estudiantes.png', '', '', '', 'estudiantes', 'Estudiantes', 'derecha', '', ''),
(5, 'assets/img/graduados.png', '', '', '', 'graduados', 'Graduados', 'derecha', '', ''),
(5, 'assets/img/egresados1.png', '', '', '', 'egresados', 'Egresados', 'derecha', '', ''),
(6, 'assets/img/cc1.png', '', '', '', 'cc1', '', '', '', ''),
(6, 'assets/img/cc2.png', '', '', '', 'cc2', '', '', '', ''),
(6, 'assets/img/cc3.png', '', '', '', 'cc3', '', '', '', ''),
(7, 'assets/img/nuestros_estudiantes.png', '', '', '', 'nuestrosEstudiantes', 'Nuestros estudiantes', 'derecha', '', ''),
(7, 'assets/img/calendario.png', '', '', '', 'calendario', 'Calendario académico', 'derecha', '', ''),
(7, 'assets/img/entidades.png', '', '', '', 'entidades', 'Entidades que nos vigilan', 'derecha', '', ''),
(7, 'assets/img/egresados.png', '', '', '', 'egresados', 'Egresados', 'derecha', '', ''),
(0, 'assets/img/manual.png', '', '', '', 'manual', 'Manual de convivencia', 'derecha', '', ''),
(0, 'assets/img/evidencias.png', '', '', '', 'evidencias', 'Evidencias de congresos y reconocimientos', 'derecha', '', ''),
(7, 'assets/img/testimonios.png', '', '', '', 'testimonios', 'Testimonios', 'derecha', '', ''),
(7, 'assets/img/biblioteca.png', '', '', '', 'biblioteca', 'Biblioteca', 'derecha', '', ''),
(7, 'assets/img/atencion.png', '', '', '', 'atencion', 'Horarios de atención', 'derecha', '', ''),
(7, 'assets/img/directorio.png', '', '', '', 'directorio', 'Directorio', 'derecha', '', ''),
(7, 'assets/img/investigacion.png', '', '', '', 'investigacion', 'Investigación', 'derecha', '', ''),
(8, 'assets/img/conectados.png', '', '', '', 'conectados', '', '', '', ''),
(8, 'assets/img/enviar.png', '', '', '', 'Suscribir', '', 'derecha', '', ''),
(9, 'assets/img/unicab.png', '', '', '', 'logoUnicab', '', '', '', ''),
(10, 'assets/img/unicab.png', '', '', '', 'logo', 'Colegio Unicab Virtual', '', 'https://unicab.org/homeunicabpro/', ''),
(10, 'assets/img/carti_explora.png', '', '', '', 'logo', 'CARTI Explora', '', 'https://unicab.org/homeunicabpro/business/cartiExplora/pages/cartiHome.php','' ),
(10, 'assets/img/unicab_solutions.png', '', '', '', 'logo', 'UNICAB Solutions', '', 'https://unicab.org/homeunicabpro/business/solutions/pages/somos.php', ''),

(10, 'assets/img/facebook.png', '', '', '', 'social-media', 'facebook', '', '', ''),
(10, 'assets/img/x.png', '', '', '', 'social-media', 'x', '', '', ''),
(10, 'assets/img/instagram.png', '', '', '', 'social-media', 'instagram', '', '', ''),
(10, 'assets/img/youtube.png', '', '', '', 'social-media', 'youtube', '', '', ''),
(11, 'assets/img/unicab_solutions.png', '', '', '', 'logoUnicabSolutions', '', '', '', ''),

(10, 'assets/img/1-1-1200x700.png', '', '', '', 'entidades', 'Gobernación de Boyacá', '', '', ''),
(10, 'assets/img/LogosSecSogamoso-300x153.png', '', '', '', 'entidades', 'Secretaría de Educación de Sogamoso', '', '', ''),
(10, 'assets/img/Logo_Dian_Derecho.png', '', '', '', 'entidades', 'DIAN', '', '', ''),

(12, 'assets/img/organigrama.jpg', 'assets/img/organigrama_movil.png', 'assets/img/organigrama_tableta_horizontal.png', 'assets/img/organigrama_tableta_horizontal.png', 'organigrama', 'organigrama', '', '', 'organigrama'),
(13, 'assets/img/_DSC0141.jpg', '', '', '', '', '', '', '', 'unicab'),
(13, 'assets/img/_DSC0152.jpg', '', '', '', '', '', '', '', 'unicab'),
(13, 'assets/img/sotarira.jpg', '', '', '', '', '', '', '', 'unicab'),
(14, 'assets/img/Grupo 1@2x.png', '', '', '', 'Desde hace 17 años el Colegio se creó para servir a estudiantes con necesidades socioeconómicas especiales que con ignición profunda desean desarrollar sus habilidades personales especiales y estudiar su primaria y bachillerato (grado 1 a grado 11) como: deportistas en vía del alto rendimiento, artistas del ballet y la danza, el teatro, la pintura, investigadores de ciencia y tecnología, estudiantes cuyas familias viajan por Colombia y el mundo, estudiantes con situaciones de salud especiales entre otros.', 'Educación Regular(grado 1 a grado 11)', '', '', 'Educación regular'),
(14, 'assets/img/Grupo 2@2x.png', '', '', '', 'El Colegio presta también el servicio de manera virtual a personas mayores de 18 años que no han podido terminar su bachillerato, a través de la modalidad de ciclos propedéuticos (2 años en 1) de manera virtual.', 'Educación por ciclos para adultos', '', '', 'Educación por ciclos'),
(14, 'assets/img/Grupo 3@2x.png', '', '', '', 'Se realiza a través de una plataforma tecnológica MOODLE versión 3.11.18 gamificada, y Maestros Mediadores del Conocimiento que atienden a los estudiantes que se encuentran desde cualquier lugar del mundo a través de las modernas Tecnologías de la Información y Comunicación TIC, permitiéndoles incorporar en sus aprendizajes autonomía, desarrollo de habilidades de pensamiento, desarrollo de su curiosidad, creatividad y manejo de nuevas herramientas tecnológicas que los prepara para el actual y futuro mundo del conocimiento.', 'El proceso Enseñanza- Aprendizaje', '', '', 'El proceso Enseñanza'),
(14, 'assets/img/Grupo 4@2x.png', '', '', '', 'Reconocido por la Secretaría de Educación de Sogamoso (Entidad certificada en Educación), a través de la cual hasta 2023 se han graduado 655 estudiantes bachilleres que han continuado con sus estudios superiores en el país y en países como EEUU, Japón, Italia, Argentina, y Chile entre otros.', 'Contamos con un Acto Administrativo vigente', '', '', 'Administrativo vigente'),
(15, 'assets/img/campus.jpg', 'assets/img/campus_movil.png', 'assets/img/campus_tableta_vertical.png', 'assets/img/campus_tableta_horizontal.png', '', '<b>Conoce</b><br> Nuestro Campus', '', '', 'campus unicab'),
(16, 'assets/img/people_16003670@2x.png', '', '', '', 'Somos un grupo de soñadores que pensamos que la educación tiene que transformarse como un derecho-servicio en beneficio de la gente y por eso creamos una Corporación sin ánimo de lucro hace 23 y desde entonces nos hemos dedicada a ofrecer servicios integrales en proyectos educativos dinámicos e incluyentes. <br><br> Nuestra labor está fundamentada en las necesidades de las comunidades, con un enfoque en las ciencias, la investigación y las tecnologías de la información y comunicación. Nos comprometemos con modelos estratégicos de gestión de calidad, brindando asesorías y consultorías que contribuyen al fortalecimiento y posicionamiento del sector productivo, en sintonía con nuestro propósito social.', '<b>¿Quiénes</b> Somos?', '', '', '¿Quiénes Somos?'),
(16, 'assets/img/g2784@2x.png', '', '', '', 'En UNICAB Corporación Educativa, nos dedicamos a ofrecer una educación de calidad, humanista, innovadora y pertinente. <b>Nuestro modelo educativo, centrado en el estudiante</b>, se basa en la investigación y el desarrollo de aprendizajes dinámicos e incluyentes, alineados con las demandas de la sociedad del conocimiento. <br><br> Promovemos el pensamiento crítico, la creatividad y el aprendizaje continuo, todo ello inspirado en principios y valores que empoderan a nuestros estudiantes como líderes responsables y ciudadanos globales comprometidos con su entorno. ', '<b>Nuestra</b> Misión', '', '', 'Nuestra Misión'),
(16, 'assets/img/vision_2967345@2x.png', '', '', '', 'Para el año 2027, seremos referentes en educación innovadora y transformadora, destacándonos por nuestra investigación en TIC y nuestro compromiso con el desarrollo de habilidades y potencialidades de nuestros estudiantes. Aspiramos a formar líderes que, desde la curiosidad y la colaboración, contribuyan a transformar sus comunidades de manera inclusiva y participativa en una sociedad global en constante evolución.', '<b>Nuestra</b> Visión', '', '', 'Nuestra visión'),
(17, 'assets/img/Grupo 50.png', '', '', '', '', 'search', '', '', ''),
(17, 'assets/img/CONTACTOS.png', '', '', '', 'image-contact', '', '', '', 'image'),
(17, 'assets/img/_2294971180768@2x.png', '', '', '', 'table', 'Nombre', '', '', ''),
(17, 'assets/img/Trazado 471@2x.png', '', '', '', 'table', 'Dep.', '', '', ''),
(17, 'assets/img/_2294971155520.png', '', '', '', 'table', 'Correo', '', '', ''),
(17, 'assets/img/_2294971183744.png', '', '', '', 'table', 'Cargo', '', '', ''),
(17, 'assets/img/_2294971184896.png', '', '', '', 'table', 'Información', '', '', ''),
(17, 'assets/img/Grupo 1.png', '', '', '', 'image-schedule', 'LUNES A VIERNES<br>8:00 a.m. A 12:00 m.', '', '', 'schedule'),
(18, 'assets/img/elearning_5466286.svg', '', '', '', 'E-learning', '', '', '', 'E-learning'),
(20, 'assets/img/paper_14969976.svg', '', '', '', 'PDF', '', '', '', 'PDF'),

(21, 'assets/img/entidades.png', '', '', '', '', 'Fundación', 'abajo', '', ''),
(21, 'assets/img/trofeo.png', '', '', '', '', '2002-2003', 'abajo', '', ''),
(21, 'assets/img/trofeo.png', '', '', '', '', '2004-2007', 'abajo', '', ''),
(21, 'assets/img/trofeo.png', '', '', '','', '2007-2008', 'abajo', '', ''),
(22, 'assets/img/historia2.png', '', '', '', '', '', '', '', 'ParteArriba'),
(22, 'assets/img/historia1.png', '', '', '', '', '', '', '', 'ParteArriba'),
(22, 'assets/img/historia3.png', '', '', '', '', '', '', '', 'ParteArriba'),
(22, 'assets/img/unicabhistoria.png', '', '', '', '', '', '', '', 'ParteAbajo'),
(23, 'assets/img/GIU.png', '', '', '', '', 'Grupo de Investigación UNICAB (GIU)', 'arriba', '', ''),
(23, 'assets/img/EquipoCreativo.jpg', '', '', '', '', 'Equipo Creativo', 'arriba', '', ''),
(23, 'assets/img/EquipoSistemas.jpg', '', '', '', '', 'Equipo de Sistemas', 'arriba', '', ''),
(23, 'assets/img/EquipoCorreccion.jpg', '', '', '', '', 'Equipo de Corrección de Estilo', 'arriba', '', ''),
(23, 'assets/img/EquipoMaestros.png', '', '', '', '', 'Grupo Cuerpo de Maestros', 'arriba', '', ''),
(24, 'assets/img/modeloPedagogico.gif', '', '', '', '', '', 'izquierda', '', ''),
(24, 'assets/img/think.svg', '', '', '', '', 'Potencialización de las habilidades individuales de los estudiantes.', 'abajo', '', ''),
(24, 'assets/img/elearning.svg', '', '', '', '', 'Fortalecimiento de principios y valores basados en la autonomía del estudiante.', 'abajo', '', ''),
(24, 'assets/img/audiobook.svg', '', '', '', '', 'Desarrollo del pensamiento creativo del estudiante.', 'abajo', '', ''),
(26, 'assets/img/browser_4919708.png', '', '', '', 'calendario', 'Año(s) académico(s) al que corresponde la solicitud', 'arriba', '', ''),
(26, 'assets/img/icon-send.png', '', '', '', 'icon-send', '', '', '', ''),

(27, 'assets/img/Farid_Hastamorir.png', '', '', '', 'imagen-farid-hastamorir', '', '', '', ''),
(27, 'assets/img/Favio_Felipe.png', '', '', '', 'imagen-favio-felipe', '', '', '', ''),
(27, 'assets/img/favio_felipe_2.png', '', '', '', 'imagen-favio-felipe', '', '', '', ''),
(27, 'assets/img/Isabella_Tapias.png', '', '', '', 'imagen-isabella-tapias', '', '', '', ''),
(27, 'assets/img/Jhon_Caicedo.png', '', '', '', 'imagen-jhon-caicedo', '', '', '', ''),
(27, 'assets/img/Juan_Baez.png', '', '', '', 'imagen-juan-baez', '', '', '', ''),
(27, 'assets/img/Juan_Jose_Huerfano.png', '', '', '', 'imagen-juan-jose', '', '', '', ''),
(27, 'assets/img/Katerin_Gomez.png', '', '', '', 'imagen-katerin-gomez', '', '', '', ''),

(28, 'assets/img/descargar_pdf.png', '', '', '', 'Icono descarga', '', '', '', ''),
(29, 'assets/img/bannerPrincipios.png', '', '', '', 'Banner', '', '', '', ''),
(29, 'assets/img/compromiso.png', '', '', '', 'Icono', 'Compromiso', 'derecha', '', ''),
(29, 'assets/img/honestidad.png', '', '', '', 'Icono', 'Honestidad', 'derecha', '', ''),
(29, 'assets/img/solutions-icon-sistemas.png', '', '', '', 'icono', 'Libertad', 'derecha', '', ''),
(29, 'assets/img/equidad.png', '', '', '', 'Icono', 'Equidad', 'derecha', '', ''),
(29, 'assets/img/responsabilidad.png', '', '', '', 'Icono', 'Responsabilidad', 'derecha', '', ''),

(30, 'assets/img/Banner_carti.png', '', '', '', 'Banner', '', '', '', ''),
(30, 'assets/img/explorador.png', '', '', '', 'Imagen explorador', '', '', '', ''),
(30, 'assets/img/solutions-icon-transformacion.png', '', '', '', 'Icono', 'Misión', 'abajo', '', ''),
(30, 'assets/img/solutions-icon-capacitacion.png', '', '', '', 'Icono', 'Visión', 'abajo', '', ''),
(30, 'assets/img/vision_naranja.png', '', '', '', 'Icono', 'Principios Institucionales', 'abajo', '', ''),
(30, 'assets/img/compromiso.png', '', '', '', 'Icono', 'Compromiso', 'derecha', '', ''),
(30, 'assets/img/honestidad.png', '', '', '', 'Icono', 'Ética', 'derecha', '', ''),
(30, 'assets/img/solutions-icon-desarrollo.png', '', '', '', 'Icono', 'Libertad', 'derecha', '', ''),
(30, 'assets/img/equidad.png', '', '', '', 'Icono', 'Equidad', 'derecha', '', ''),
(30, 'assets/img/responsabilidad.png', '', '', '', 'Icono', 'Responsabilidad', 'derecha', '', ''),
(30, 'assets/img/solutions-icon-sistemas.png', '', '', '', 'Icono', 'Pertinencia', 'derecha', '', ''),

(31, 'assets/img/conectados.png', '', '', '', '', 'Principal', 'abajo', '', ''),
(33, 'assets/img/enviar.png', '', '', '', '', 'Suscribir', 'izquierda', '', ''), 
(33, 'assets/img/love.png', '', '', '', '', '', '', '', ''), 
(33, 'assets/img/chatIcon.png', '', '', '', '', '', '', '', ''), 
(33, 'assets/img/shareIcon.png', '', '', '', '', 'Compartir en', 'izquierda', '', ''), 
(33, 'assets/img/facebookOrangeBg.png', '', '', '', '', '', '', '', ''), 
(33, 'assets/img/instagramOrangeBg.png', '', '', '', '', '', '', '', ''), 
(33, 'assets/img/linkedInOrangeBg.png', '', '', '', '', '', '', '', ''), 
(33, 'assets/img/whatsappOrangeBg.png', '', '', '', '', '', '', '', ''),

(34, 'assets/img/admisiones/Admisiones_2025_1.jpg', '', '', '', '', '', '', '', ''), 
(34, 'assets/img/admisiones/ico1_admisiones_2025_1.jpg', '', '', '', '', '', '', '', ''), 
(34, 'assets/img/admisiones/ico2_admisiones_2025_1.jpg', '', '', '', '', '', '', '', ''),
(34, 'assets/img/admisiones/continua_proceso_1.jpg', '', '', '', '', '', '', '', ''),
(34, 'assets/img/loading1.gif', '', '', '', '', '', '', '', ''),
(34, 'assets/img/admisiones/enviar_1.jpg', '', '', '', '', '', '', '', ''),

(35, 'assets/img/whatsapp_icon_negro.png', '', '', '', 'contact-icon', 'Comunícate', '', '', ''),
(35, 'assets/img/location_icon_negro.png', '', '', '', 'location-icon', 'Comunícate', '', '', ''),
(35, 'assets/img/blog_icon_negro.png', '', '', '', 'blog-icon', 'Comunícate', '', '', '');

INSERT INTO tbl_imagenes (id_seccion, ruta, rutaMovil, rutaTabletaVertical, rutaTabletaHorizontal, descripcion, titulo, posicionTitulo, rutaEncima, textoAlterno) VALUES
(36, 'assets/img/advertencia_correo1.png', '', '', '', 'Advertencia', '', '', '', ''),
(36, 'assets/img/admisiones/Panchita.png', '', '', '', 'Panchita', '', '', '', '')
;

INSERT INTO tbl_imagenes (id_seccion, ruta, rutaMovil, rutaTabletaVertical, rutaTabletaHorizontal, descripcion, titulo, posicionTitulo, rutaEncima, textoAlterno) VALUES
(38, 'assets/img/IconoPresaberes.png', '', '', '', '', '', 'abajo', '', '');

INSERT INTO tbl_imagenes (id_seccion, ruta, rutaMovil, rutaTabletaVertical, rutaTabletaHorizontal, descripcion, titulo, posicionTitulo, rutaEncima, textoAlterno) VALUES 
(39, 'assets/img/pagos/statement.png', '', '', '', 'statement-cion', 'Pago a través de MiPagoAmigo', 'izquierda', '', ''),
(39, 'assets/img/pagos/Banco_Caja_Social.png', '', '', '', 'banco caja social icono', '', '', '', '');

INSERT INTO tbl_imagenes (id_seccion, ruta, rutaMovil, rutaTabletaVertical, rutaTabletaHorizontal, descripcion, titulo, posicionTitulo, enlace, rutaEncima, textoAlterno) VALUES 
(39, 'assets/img/pagos/mipagoamigo.png', '', '', '', 'mipagoamigo icono', '', '', 'https://www.mipagoamigo.com/MPA_WebSite/ServicePayments/StartPayment?id=3555&searchedCategoryId=&searchedAgreementName=UNICAB%20CORPORACION%20EDUCATIVA', '', ''),
(39, 'assets/img/pagos/operation.png', '', '', '', 'instructivo pago', 'Instructivo de pago', '', 'https://youtu.be/Q48MW92gABA', '', '');

INSERT INTO tbl_imagenes (id_seccion, ruta, rutaMovil, rutaTabletaVertical, rutaTabletaHorizontal, descripcion, titulo, posicionTitulo, rutaEncima, textoAlterno) VALUES 
(39, 'assets/img/pagos/statement.png', '', '', '', 'statement-icon', 'Pago a través de ePayco', '', '', ''),
(39, 'assets/img/pagos/epayco.png', '', '', '', 'epayco', 'Conceptos de pago de pensión', '', '', ''),
(39, 'assets/img/pagos/right-arrow.png', '', '', '', 'flecha', '', '', '', ''),
(39, 'assets/img/pagos/ref_pago.png', '', '', '', 'referencia pago', 'Referencia de pago', 'arriba', '', ''),
(39, 'assets/img/pagos/transaction.png', '', '', '', 'transaccion icono', '', '', '', '')
;

INSERT INTO tbl_imagenes (id_seccion, ruta, rutaMovil, rutaTabletaVertical, rutaTabletaHorizontal, descripcion, titulo, posicionTitulo, rutaEncima, textoAlterno) VALUES 
(40, 'assets/img/pagos/statement.png', '', '', '', 'statement-icon', 'Costos', 'izquierda', '', ''),
(40, 'assets/img/paper_14969976.svg', '', '', '', 'descargar-pdf', 'Ver', '', '', ''),
(40, 'assets/img/ayuda.gif', '', '', '', 'imagen ayuda', 'Contáctate con nuestro equipo de trabajo', '', '', '');

UPDATE tbl_imagenes SET titulo = '' WHERE (id = 130);
UPDATE tbl_imagenes SET titulo = 'Inscripciones Abiertas', enlace = '#inscripcionesAbiertas' WHERE (id = 131);
UPDATE tbl_imagenes SET enlace = 'https://wa.me/573008156531/?text=Hola necesito asesoría del proceso de admisiones.' WHERE (id = 129);

UPDATE tbl_imagenes SET rutaMovil = 'assets/img/unicabHistoriaMovil.jpg' WHERE (id = 76);
UPDATE tbl_imagenes SET rutaTabletaVertical = 'assets/img/unicabHistoriaTablets.jpg' WHERE (id = 76);

INSERT INTO tbl_imagenes (id_seccion, ruta, rutaMovil, rutaTabletaVertical, rutaTabletaHorizontal, descripcion, titulo, posicionTitulo, rutaEncima, textoAlterno) VALUES
(37, 'assets/img/liked.png', '', '', '', '', '', '', '', ''),
(10, 'assets/img/sumertic.png', '', '', '', 'aliados', 'Nuestros Aliados', '', '', ''),
(10, 'assets/img/linkedin.svg', '', '', '', 'social-media', 'linkedin', '', '', ''),
(10, 'assets/img/tiktok.svg', '', '', '', 'social-media', 'tiktok', '', '', '');


DELETE FROM tbl_imagenes WHERE id = 142 AND ruta = 'assets/img/pagos/ref_pago.png';
UPDATE tbl_imagenes SET posicionTitulo = 'izquierda' WHERE (id = 139);
UPDATE tbl_imagenes SET posicionTitulo = 'izquierda' WHERE (id = 135);
UPDATE tbl_imagenes SET rutaMovil = 'assets/img/bannerPrincipios.png', rutaTabletaVertical = 'assets/img/bannerPrincipios.png', rutaTabletaHorizontal = 'assets/img/bannerPrincipios.png' WHERE (id = 97);


DELETE FROM tbl_imagenes WHERE id = 28 AND ruta = 'assets/img/testimonios.png';
UPDATE tbl_imagenes SET ruta = 'assets/img/egresados1.png' WHERE id = 18;
UPDATE tbl_imagenes SET ruta = 'assets/img/modeloPedagogico.gif' WHERE id = 82;

INSERT INTO tbl_imagenes (id_seccion, ruta, rutaMovil, rutaTabletaVertical, rutaTabletaHorizontal, descripcion, titulo, posicionTitulo, rutaEncima, textoAlterno) VALUES
(42, 'assets/img/egresadosOnce.png', '', '', '', '', '', '', '', ''),
(42, 'assets/img/egresadosOnce_1.png', '', '', '', '', '', '', '', ''),
(42, 'assets/img/egresadosOnce_profesores.png', '', '', '', '', '', '', '', ''),
(42, 'assets/img/egresadosOnce_2.png', '', '', '', '', '', '', '', ''),
(43, 'assets/img/egresadosCiclos.png', '', '', '', '', '', '', '', ''),
(43, 'assets/img/egresadosCiclos_1.png', '', '', '', '', '', '', '', ''),
(43, 'assets/img/egresadosCiclos_2.png', '', '', '', '', '', '', '', ''),
(43, 'assets/img/egresadosCiclos_3.png', '', '', '', '', '', '', '', ''),
(44, 'assets/img/graduadosNoveno.png', '', '', '', '', '', '', '', ''),
(44, 'assets/img/graduadosNoveno_1.png', '', '', '', '', '', '', '', ''),
(44, 'assets/img/graduadosNoveno_2.png', '', '', '', '', '', '', '', ''),
(44, 'assets/img/graduadosNoveno_3.png', '', '', '', '', '', '', '', ''),
(45, 'assets/img/graduadosQuinto.png', '', '', '', '', '', '', '', ''),
(45, 'assets/img/graduadosQuinto_1.png', '', '', '', '', '', '', '', ''),
(45, 'assets/img/graduadosQuinto_2.png', '', '', '', '', '', '', '', ''),
(45, 'assets/img/graduadosQuinto_3.png', '', '', '', '', '', '', '', '');

INSERT INTO tbl_imagenes (id_seccion, ruta, rutaMovil, rutaTabletaVertical, rutaTabletaHorizontal, descripcion, titulo, posicionTitulo, enlace, rutaEncima, textoAlterno) VALUES
(47, 'assets/img/logoUnicabNewsletter.png', '', '', '', '', '', '', '', '', ''),
(47, 'assets/img/newsletterInscrito.png', '', '', '', '', '', '', '', '', ''),
(47, 'assets/img/newsletterPublicacionesIcon.png', '', '', '', '', '', '', '', '', ''),
(47, 'assets/img/newsletterNoticiasIcon.png', '', '', '', '', '', '', '', '', ''),
(47, 'assets/img/newsletterEventosIcon.png', '', '', '', '', '', '', '', '', ''),
(47, 'assets/img/newsletterHerramientasIcon.png', '', '', '', '', '', '', '', '', '')
;

INSERT INTO tbl_imagenes (id_seccion, ruta, rutaMovil, rutaTabletaVertical, rutaTabletaHorizontal, descripcion, titulo, posicionTitulo, enlace, rutaEncima, textoAlterno) VALUES
(48, 'assets/img/encabezado_informes1.jpg', '', '', '', '', '', '', '', '', ''),
(48, 'assets/img/checked_1.jpg', '', '', '', '', '', '', '', '', ''),
(48, 'assets/img/unchecked_1.jpg', '', '', '', '', '', '', '', '', ''),
(48, 'assets/img/na_1.jpg', '', '', '', '', '', '', '', '', '')
;

INSERT INTO tbl_imagenes (id_seccion, ruta, rutaMovil, rutaTabletaVertical, rutaTabletaHorizontal, descripcion, titulo, posicionTitulo, rutaEncima, textoAlterno) VALUES 
(25, 'assets/img/pagos/statement.png', '', '', '', 'statement-icon', 'Estados financieros', 'izquierda', '', ''),
(25, 'assets/img/paper_14969976.svg', '', '', '', 'descargar-pdf', 'Ver', '', '', '')
;

UPDATE tbl_imagenes SET ruta = 'assets/img/principios.jpg', rutaMovil = 'assets/img/principios.jpg', rutaTabletaVertical = 'assets/img/principios.jpg', rutaTabletaHorizontal = 'assets/img/principios.jpg' WHERE (id = '97');

UPDATE tbl_imagenes SET enlace = 'business/org/pages/sobreNosotros.php#ofertaAcademica' WHERE (id = '1');
UPDATE tbl_imagenes SET enlace = 'business/org/pages/sobreNosotros.php#ofertaAcademica' WHERE (id = '2');
UPDATE tbl_imagenes SET enlace = 'business/org/pages/sobreNosotros.php#ofertaAcademica' WHERE (id = '3');

UPDATE tbl_imagenes SET ruta = 'assets/img/Grupo 2.svg' WHERE (id = '4');
UPDATE tbl_imagenes SET ruta = 'assets/img/Grupo 3.svg' WHERE (id = '5');
UPDATE tbl_imagenes SET ruta = 'assets/img/Grupo 4.svg' WHERE (id = '6');
UPDATE tbl_imagenes SET ruta = 'assets/img/Grupo 5.svg' WHERE (id = '7');
UPDATE tbl_imagenes SET ruta = 'assets/img/Grupo 6.svg' WHERE (id = '8');
UPDATE tbl_imagenes SET ruta = 'assets/img/Grupo 7.svg' WHERE (id = '9');
UPDATE tbl_imagenes SET ruta = 'assets/img/Grupo 8.svg' WHERE (id = '10');
UPDATE tbl_imagenes SET ruta = 'assets/img/Grupo 9.svg' WHERE (id = '11');
UPDATE tbl_imagenes SET ruta = 'assets/img/Grupo 10.svg' WHERE (id = '12');
UPDATE tbl_imagenes SET ruta = 'assets/img/Grupo 13.svg' WHERE (id = '13');
UPDATE tbl_imagenes SET ruta = 'assets/img/Grupo 12.svg' WHERE (id = '14');
UPDATE tbl_imagenes SET ruta = 'assets/img/Grupo 11.svg' WHERE (id = '15');

UPDATE tbl_imagenes SET enlace = 'business/org/pages/sobreNosotros.php#primariaYBachillerato' WHERE (id = '1');
UPDATE tbl_imagenes SET enlace = 'business/org/pages/sobreNosotros.php#primariaYBachillerato' WHERE (id = '2');
UPDATE tbl_imagenes SET enlace = 'business/org/pages/sobreNosotros.php#ciclos' WHERE (id = '3');

UPDATE tbl_imagenes SET enlace = 'https://unicab.org/homeunicabpro/#inscripcionesAbiertas' WHERE (id = '131');

UPDATE tbl_imagenes SET ruta = 'assets/img/GIU.jpg' WHERE id = 77 AND ruta = "assets/img/GIU.png";
UPDATE tbl_imagenes SET ruta = 'assets/img/equipoDocentes.jpg' WHERE id = 81 AND ruta = "assets/img/EquipoMaestros.png";

UPDATE tbl_imagenes SET titulo = 'Potencialización de las habilidades <br><span>individuales de los estudiantes.</span>' WHERE id = 83 AND titulo = "Potencialización de las habilidades individuales de los estudiantes.";
UPDATE tbl_imagenes SET titulo = 'Fortalecimiento de principios y valores <br><span>basados en la autonomía del estudiante.</span>' WHERE id = 84 AND titulo = "Fortalecimiento de principios y valores basados en la autonomía del estudiante.";
UPDATE tbl_imagenes SET titulo = 'Desarrollo del pensamiento creativo <br><span>del estudiante.</span>' WHERE id = 85 AND titulo = "Desarrollo del pensamiento creativo del estudiante."
;

UPDATE tbl_imagenes SET enlace = 'https://unicab.org/homeunicabpro/#inicio' WHERE (id = '36');
UPDATE tbl_imagenes SET enlace = 'https://unicab.org/homeunicabpro/business/cartiExplora/pages/cartiHome.php' WHERE (id = '37');
UPDATE tbl_imagenes SET enlace = 'https://unicab.org/homeunicabpro/business/solutions/pages/somos.php' WHERE (id = '38');
UPDATE tbl_imagenes SET titulo = 'LUNES A VIERNES<br>8:00 a.m. A 12:00 p.m.<br>2:00 p.m A 6:00 p.m.' WHERE (id = '66');

UPDATE tbl_imagenes SET id_seccion = '0' WHERE (id = '40');
UPDATE tbl_imagenes SET id_seccion = '0' WHERE (id = '149');
UPDATE tbl_imagenes SET id_seccion = '0' WHERE (id = '150');
