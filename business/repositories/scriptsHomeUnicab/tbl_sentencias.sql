DROP TABLE IF EXISTS tbl_sentencias;

CREATE TABLE tbl_sentencias (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  utilizaJoin varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  joinTablas varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  campos varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  tablas varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  condiciones varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  agrupaciones varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  ordenamientos varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  modificaciones varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  condicionesAgrupaciones varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  inserciones varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_sentencias (utilizaJoin, joinTablas, campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('NO', '', 'SELECT * ', 'FROM tbl_menus ', 'WHERE nivel = |x| AND padre = |y| AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_banners ', 'WHERE visible = 1 ', '', 'ORDER BY id DESC ', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 1 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 2 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 3 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 4 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 5 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 6 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 7 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 8 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 9 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 10 AND visible = 1 ', '', '', '', '', ''),

('NO', '', 'SELECT * ', 'FROM tbl_parametros ', 'WHERE parametro = |telefono_admisiones| ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_parametros ', 'WHERE parametro = |correo_admisiones| ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_parametros ', 'WHERE parametro = |direccion_unicab| ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_parametros ', 'WHERE parametro = |ubicacion_unicab| ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 2 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 3 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 4 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 5 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 6 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 7 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 8 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 9 ', '', '', '', '', ''),

('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 10 AND id < 39 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_menus ', 'WHERE visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_blogs ', 'WHERE id > 0 ', '', 'ORDER BY id DESC LIMIT 3 ', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_parametros ', 'WHERE id_seccion = 8 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_formularios ', 'WHERE id_seccion = 4 ', '', '', '', '', ''),
('NO', '', '', 'INSERT INTO tbl_contactos ', '', '', '', '', '', '(nombre, correo, asunto, mensaje, fecha) VALUES (?, ?, ?, ?, ?) '),
('NO', '', 'SELECT * ', 'FROM tbl_parametros ', 'WHERE id_seccion = 4 OR id IN (1, 2) ', '', '', '', '', ''),

('NO', '', 'SELECT * ', 'FROM tbl_menus_solutions ', 'WHERE nivel = |x| AND padre = |y| AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 11 ', '', '', '', '', ''),

('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 10 AND descripcion = |logo| ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_menus ', 'WHERE visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 10 AND descripcion = |social-media| ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_parametros ', 'WHERE id >= 8 AND id < 14 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_parametros ', 'WHERE id >= 14 AND id <= 15 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 12 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 13 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 14 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 15 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 16 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 12 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 13 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 14 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 15 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 16 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 10 AND descripcion = |entidades| ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 16 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 16 AND descripcion = |icon-search| ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 16 AND descripcion = |image-contact| ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 16 AND descripcion = |table-icon| ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 16 AND descripcion = |image-schedule| ', '', '', '', '', ''),

('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 17 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 18 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 19 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 20 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 17 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 17 AND titulo=|search| ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 17 AND descripcion=|table| ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 18 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 19 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 20 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_eventos ', 'WHERE estado = 1 AND fecha > CURDATE() ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_archivos ', 'WHERE visible = 1 ', '', '', '', '', ''),

('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 21 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 22 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 23 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 24 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 21 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_textos ', 'WHERE id_seccion = 21 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 22  AND textoAlterno = |parteArriba| ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 22  AND textoAlterno = |parteAbajo| ', '', 'ORDER BY id DESC LIMIT 1 ', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 23 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_textos ', 'WHERE id_seccion = 23 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 24 ', '', '', '', '', ''),

('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 25 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 26 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 26 AND descripcion = |calendario| ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_opciones_estados_financieros ', 'WHERE nombrePadre = |Relación con la institución| ', '','','','', ''),
('NO', '', 'SELECT * ', 'FROM tbl_opciones_estados_financieros ', 'WHERE nombrePadre = |Tipo de certificación| ', '','','','', ''),

('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 27 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 27 ', '', '', '', '', ''),

('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 28 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 28 ', '', '', '', '', ''),

('NO', '', 'SELECT * ', 'FROM tbl_publicaciones_academicas ', 'WHERE visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 29 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 29 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_textos ', 'WHERE id_seccion = 29 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_textos ', 'WHERE id_seccion = 30 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 30 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 30 ', '', '', '', '', ''),

('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 31 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 31 AND titulo = |Principal| ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_textos ', 'WHERE id_seccion = 31 AND identificacion = |barraBusqueda| ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_textos ', 'WHERE id_seccion = 31 AND identificacion = |linkBusqueda| ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 32 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_blogs ', 'WHERE id > 0 ', '', 'ORDER BY id DESC LIMIT 4 ', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 33 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_blogs ', 'WHERE id > 0 ', '', 'ORDER BY id DESC LIMIT 1 ', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 33 ', '', '', '', '', ''),

('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 26 AND descripcion = |icon-send| ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 17 AND descripcion = |image-schedule| ', '', '', '', '', ''),

('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 34 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 34 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_formularios ', 'WHERE id_seccion = 34 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_textos ', 'WHERE id_seccion = 34 ', '', '', '', '', ''),

('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 35 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 35', '', '', '', '', '')
;

INSERT INTO tbl_sentencias (utilizaJoin, joinTablas, campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 36 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 36', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_textos ', 'WHERE id_seccion = 36', '', '', '', '', '')
;

INSERT INTO tbl_sentencias (utilizaJoin, joinTablas, campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES 
('NO','','SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 37 AND visible = 1 ', '', '', '', '', ''),
('NO','','SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 38 AND visible = 1 ', '', '', '', '', ''),
('NO','','SELECT * ', 'FROM tbl_blogs ', 'WHERE id = ', '', '', '', '', ''),
('NO','','', 'INSERT INTO tbl_comentarios_blog ', '', '', '', '', '', '(id_blog, comentario, correo, fecha) VALUES (?, ?, ?, ?) '),
('NO','','SELECT * ', 'FROM tbl_comentarios_blog ', 'WHERE id_blog = ', '', '', '', '', ''),
('NO','','SELECT * ', 'FROM tbl_formularios ', 'WHERE id_seccion = 37 ', '', 'ORDER BY id DESC', '', '', ''),
('NO','','SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 38 ', '', '', '', '', ''),
('NO','','SELECT * ', 'FROM tbl_enlaces ', 'WHERE id_seccion = 37 ', '', '', '', '', '');

INSERT INTO tbl_sentencias (utilizaJoin, joinTablas, campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES 
('NO','','SELECT * ','FROM tbl_secciones ','WHERE id = 39 AND visible = 1 ','','','','',''),
('NO','','SELECT * ','FROM tbl_imagenes ','WHERE id_seccion = 39 ','','','','',''),
('NO','','SELECT * ','FROM tbl_formularios ','WHERE id_seccion = 39 ','','','','',''),
('NO','','SELECT * ','FROM tbl_textos ','WHERE id_seccion = 39 ','','','','',''),
('NO','','SELECT valor, texto ','FROM tbl_conceptos_pago ','','','','','',''),
('NO','','SELECT valor, texto ','FROM tbl_formas_pago ','','','','','','')
;

INSERT INTO tbl_sentencias (utilizaJoin, joinTablas, campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('NO','','SELECT * ','FROM tbl_secciones ','WHERE id = 40 AND visible = 1 ','','','','',''),
('NO','','SELECT * ','FROM tbl_imagenes ','WHERE id_seccion = 40 ','','','','','');

INSERT INTO tbl_sentencias (utilizaJoin, joinTablas, campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('NO','','SELECT * ','FROM tbl_circulares ','WHERE id_seccion = 40 ','','','','',''); 

INSERT INTO tbl_sentencias (utilizaJoin, joinTablas, campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('NO', '', 'SELECT * ', 'FROM tbl_enlaces ', 'WHERE id_seccion = 7 AND visible = 1 ', '', '', '', '', '');

INSERT INTO tbl_sentencias (utilizaJoin, joinTablas, campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 37 ', '', '', '', '', '');

INSERT INTO tbl_sentencias (utilizaJoin, joinTablas, campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('NO', '', '', 'UPDATE tbl_blogs ', 'WHERE (id = ?) ', '', '', 'SET blogMeGusta = blogMeGusta + 1 ', '', ''),
('NO', '', '', 'UPDATE tbl_blogs ', 'WHERE (id = ?) ', '', '', 'SET blogMeGusta = blogMeGusta - 1 ', '', '');

INSERT INTO tbl_sentencias (utilizaJoin, joinTablas, campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 17 AND descripcion=|image-contact| ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_formularios ', 'WHERE id_seccion = 25 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_formularios ', 'WHERE id_seccion = 26 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 10 AND descripcion=|aliados| ', '', '', '', '', '');

INSERT INTO tbl_sentencias (utilizaJoin, joinTablas, campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('NO', '', 'SELECT * ', 'FROM tbl_parametros ', 'WHERE id_seccion = 5 ', '', '', '', '', '')
;

INSERT INTO tbl_sentencias (utilizaJoin, joinTablas, campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 41 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 42 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 43 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 44 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 45 AND visible = 1 ', '', '', '', '', '');

INSERT INTO tbl_sentencias (utilizaJoin, joinTablas, campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 42 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 43 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 44 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 45 ', '', '', '', '', '')
;

INSERT INTO tbl_sentencias (utilizaJoin, joinTablas, campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 46 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_textos ', 'WHERE id_seccion = 46', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_formularios ', 'WHERE id_seccion = 8', '', '', '', '', ''),
('NO', '', '', 'INSERT INTO tbl_registrados_newsletter ', '', '', '', '', '', '(correo) VALUES (?) '),
('NO', '', 'SELECT * ', 'FROM tbl_blogs ', 'WHERE LOWER(descripcionPrincipal) LIKE |?| OR LOWER(titulo) LIKE |?| OR LOWER(descripcionSecundaria) LIKE |?| LIMIT 5 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 47 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_secciones ', 'WHERE id = 48 AND visible = 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_textos ', 'WHERE id_seccion = 47', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 47', '', '', '', '', ''),
('NO', '', 'SELECT 1 ', 'FROM tbl_registrados_newsletter ', 'WHERE correo = ? LIMIT 1 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_enlaces ', 'WHERE id_seccion = 47', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_blogs ', 'WHERE LOWER(descripcionPrincipal) LIKE |?| OR LOWER(titulo) LIKE |?| OR LOWER(descripcionSecundaria) LIKE |?| ', '', '', '', '', '')
;

INSERT INTO tbl_sentencias (utilizaJoin, joinTablas, campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES 
('NO','','SELECT * ','FROM tbl_textos ','WHERE id_seccion = 38 ','','','','',''),
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 48 ', '', '', '', '', ''),
('NO', '', 'SELECT * ', 'FROM tbl_enlaces ', 'WHERE id_seccion = 18 ', '', '', '', '', '')
;

INSERT INTO tbl_sentencias (utilizaJoin, joinTablas, campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('NO', '', 'SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 25 ', '', '', '', '', ''),
('NO','','SELECT * ','FROM tbl_circulares ','WHERE id_seccion = 25 ','','','','','')
;

INSERT INTO tbl_sentencias (utilizaJoin, joinTablas, campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('NO', '', 'DELETE ', 'FROM tbl_registrados_newsletter ', 'WHERE id = |?| AND correo = |?|', '', '', '', '', ''),
('NO','','SELECT * ','FROM tbl_textos ','WHERE id_seccion = 32 ','','','','',''),
('NO','','SELECT * ','FROM tbl_parametros ','WHERE id_seccion = 31 ','','','','',''),
('NO','','SELECT * ','FROM tbl_blogs ','WHERE idCategoria = ? ','','','','','')
;

UPDATE tbl_sentencias SET campos = 'SELECT * ' WHERE (`id` = '158');
UPDATE tbl_sentencias SET condiciones = 'WHERE id = ? AND correo = ?' WHERE (`id` = '166');

INSERT INTO tbl_sentencias (utilizaJoin, joinTablas, campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('NO','','SELECT * ','FROM tbl_parametros ','WHERE parametro = |terminos_condiciones| ','','','','',''),
('NO','','SELECT * ','FROM tbl_parametros ','WHERE parametro = |copyright| ','','','','','')
;
