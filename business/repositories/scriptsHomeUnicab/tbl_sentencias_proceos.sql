DROP TABLE IF EXISTS tbl_sentencias_procesos;

CREATE TABLE tbl_sentencias_procesos (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  utilizaJoin varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  campos varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  tablas varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  joinTablas varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  condiciones varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  agrupaciones varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  ordenamientos varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  modificaciones varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  condicionesAgrupaciones varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  inserciones varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_sentencias_procesos (nombre, utilizaJoin, campos, tablas, joinTablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('máximo registro en matricula', 'NO', 'SELECT IFNULL(max(m.idmatricula), 0) maxid ', 'FROM estudiantes e, matricula m ', '', 'WHERE e.id = m.id_estudiante AND e.n_documento = |_documento*| ', '', '', '', '', ''),
('grados', 'NO', 'SELECT * ', 'FROM grados ', '', 'WHERE id > 1 ', '', '', '', '', ''),
('buscar datos iniciales', 'NO', 'SELECT e.acudiente_1, e.email_acudiente_1, e.ciudad, e.telefono_acudiente_1 ', 'FROM estudiantes e ', '', 'WHERE e.n_documento = |_documento*| ', '', '', '', '', ''),
('se valida que sea antiguo', 'NO', 'SELECT *, (YEAR(NOW()) - YEAR(fecha_ingreso)) diferencia, YEAR(now()) actual ', 'FROM matricula ', '', 'WHERE idMatricula = _maxid* ', '', '', '', '', ''),
('grado', 'NO', 'SELECT * ', 'FROM grados ', '', 'WHERE id = _idGrado* ', '', '', '', '', ''),
('datos estudiante0', 'NO', 'SELECT m.estado, m.id_grado, e.nombres, e.apellidos, e.telefono_estudiante, e.email_institucional, e.estado rh, e.acudiente_1, e.email_acudiente_1, e.direccion, e.telefono_acudiente_1, e.documento_responsable, td.id, td.tipo_documento, e.ciudad, e.actividad_extra, e.genero, e.documento_responsable, e.parentesco_acudiente_1 ', 'FROM estudiantes e, matricula m, tbl_tipos_documento td  ', '', 'WHERE e.id = m.id_estudiante AND e.tipo_documento = td.id AND e.n_documento = |_documento*| AND m.idmatricula = _maxid* ', '', '', '', '', ''),
('datos entrevista', 'NO', 'SELECT *, ifnull(id, 0) id1 ', 'FROM entrevistas ', '', 'WHERE documento = |_documento*| ', '', '', '', '', ''),
('datos tbl_pre_matricula', 'NO', 'SELECT *, ifnull(id, 0) id1 ', 'FROM tbl_pre_matricula ', '', 'WHERE documento_est = |_documento*| AND año < _fanio* ', '', '', '', '', ''),
('datos tbl_pre_matricula1', 'NO', 'SELECT *, ifnull(id, 0) id1 ', 'FROM tbl_pre_matricula ', '', 'WHERE documento_est = |_documento*| AND año = _fanio* ', '', '', '', '', ''),
('datos tbl_entrevistas', 'NO', 'SELECT * ', 'FROM tbl_entrevistas ', '', 'WHERE documento_est = |_documento*| AND fecha >= |2024-10-07| ', '', '', '', '', ''),
('validar codigo pre matricula documento', 'NO', 'SELECT COUNT(1) ct, email_pre_mat ', 'FROM tbl_cod_pre_matricula ', '', 'WHERE identificacion = |_documento*| AND codigo = |_codigo*| ', 'GROUP BY email_pre_mat ', '', '', '', ''),
('evaluacion de validacion', 'NO', 'SELECT COUNT(1) ct ', 'FROM tbl_validaciones ', '', 'WHERE documento_est = |_documento*| AND año = _fanio* ', '', '', '', '', ''),
('grado maximo a validar', 'NO', 'SELECT g.id, g.grado ', 'FROM (SELECT MAX(id_grado) id_grado FROM tbl_validaciones WHERE documento_est = |_documento*| AND fecha_programacion like |%_fanio*%|) v, grados g ', '', 'WHERE v.id_grado = g.id ', '', '', '', '', ''),
('grado maximo aprobado', 'NO', 'SELECT COUNT(1) ct ', 'FROM tbl_validaciones ', '', 'WHERE documento_est = |_documento*| AND resultado = |APROBADO| AND id_grado = _max_idgrado* ', '', '', '', '', ''),
('evaluacion presaberes finalizada', 'NO', 'SELECT COUNT(1) ct ', 'FROM tbl_respuestas ', '', 'WHERE identificacion = |_documento*| AND a = _fanio1* AND estado = |FINALIZADA| ', '', '', '', '', ''),
('valida no entrevista no evaluacion', 'NO', 'SELECT * ', 'FROM tbl_estudiantes_sin_ee ', '', 'WHERE n_documento = |_documento*| ', '', '', '', '', ''),
('rango matricula ordinaria', 'NO', 'SELECT f1, f2 ', 'FROM tbl_parametros ', '', 'WHERE parametro = |mat_ordinarias| ', '', '', '', '', ''),
('rango matricula extra ordinaria', 'NO', 'SELECT f1, f2 ', 'FROM tbl_parametros ', '', 'WHERE parametro = |mat_extraordinarias| ', '', '', '', '', ''),
('valida estudiante bloqueado', 'NO', 'SELECT COUNT(1) ct ', 'FROM tbl_estudiantes_bloqueados ', '', 'WHERE n_documento = |_documento*| ', '', '', '', '', ''),
('tipos documento', 'NO', 'SELECT * ', 'FROM tbl_tipos_documento ', '', '', '', '', '', '', ''),
('medios llegada', 'NO', 'SELECT * ', 'FROM tbl_medios_llegada ', '', '', '', '', '', '', ''),
('update tbl_pre_matricula', 'NO', '', 'UPDATE tbl_pre_matricula ', '', 'WHERE documento_est = |_documento*| AND año = _añoMatricula* ', '', '', 'SET id_grado = _idGrado*, nombres_est = |_nombres*|, apellidos_est = |_apellidos*|, fecha = |_fecha2*|, actividad_extra = |_extra*|,  nombre_a = |_nombreA*|, celular_a = |_celA*|, email_a = |_emailA*|, ciudad_a = |_ciudadA*|, id_medio = _medio* ', '', ''),
('insert tbl_pre_matricula', 'NO', '', 'INSERT INTO tbl_pre_matricula ', '', '', '', '', '', '', '(id_empleado, id_grado, documento_est, nombres_est, apellidos_est, fecha, actividad_extra, nombre_a, celular_a, email_a, ciudad_a, entrevista, eval, id_medio, año) VALUES (18, _idGrado*, |_documento*|, |_nombres*|, |_apellidos*|, |_fecha2*|, |_extra*|, |_nombreA*|, |_celA*|, |_emailA*|, |_ciudadA*|, |NO|, 0, _medio*, _añoMatricula*) '),
('existe registro en tbl_pre_matricula', 'NO', 'SELECT COUNT(1) ct ', 'FROM tbl_pre_matricula ', '', 'WHERE documento_est = |_documento*| AND año = _añoMatricula* ', '', '', '', '', ''),
('existe registro en estudiantes', 'NO', 'SELECT COUNT(1) ct ', 'FROM estudiantes ', '', 'WHERE n_documento = |_documento*| ', '', '', '', '', ''),
('update estudiantes', 'NO', '', 'UPDATE estudiantes ', '', 'WHERE n_documento = |_documento*| ', '', '', 'SET apellidos = |_apellidos*|, nombres = |_nombres*|, genero = |_genero*|, tipo_documento = _tdoc*, telefono_estudiante = |_telefonoE*|, actividad_extra = |_extra*|, email_acudiente_1 = |_emailA*|, acudiente_1 = |_nombreA*|, telefono_acudiente_1 = |_celA*|, parentesco_acudiente_1 = |_parentesco1*|, fecha_datos = |_fecha2*|, documento_responsable = |_documentoA*|, ciudad = |_ciudadA*|, a_matricula = _añoMatricula* ', '', ''),
('insert estudiantes', 'NO', '', 'INSERT INTO estudiantes ', '', '', '', '', '', '', '(apellidos, nombres, genero, tipo_documento, n_documento, ciudad, telefono_estudiante, actividad_extra, email_acudiente_1, acudiente_1, telefono_acudiente_1, parentesco_acudiente_1, fecha_datos, documento_responsable, a_matricula) VALUES (|_apellidos*|, |_nombres*|, |_genero*|, _tdoc*, |_documento*|, |_ciudadA*|, |_telefonoE*|, |_extra*|, |_emailA*|, |_nombreA*|, |_celA*|, |_parentesco1*|, |_fecha2*|, |_documentoA*|, _añoMatricula*) ')
;

INSERT INTO tbl_sentencias_procesos (nombre, utilizaJoin, campos, tablas, joinTablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('consulta directorio', 'NO', 'SELECT e.id, e.nombres, e.apellidos, e.dependencia, e.email, e.celular, e.cargo, IFNULL(e.infografia, '''') infografia, 
CASE e.perfil WHEN ''TU'' THEN ''SI'' WHEN ''SU'' THEN ''SI'' WHEN ''TU_AW'' THEN ''SI'' WHEN ''ST_PU'' THEN ''SI'' 
WHEN ''AR'' THEN ''SI'' WHEN ''FI'' THEN ''SI'' WHEN ''PS'' THEN ''SI'' ELSE ''NO'' END perfil ', 'FROM tbl_empleados e ', '', 'WHERE e.estado = |_activo*| AND e.id != 18 ', '', 'ORDER BY e.id ASC ', '', '', '');

INSERT INTO tbl_sentencias_procesos (nombre, utilizaJoin, campos, tablas, joinTablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('grado estudiante', 'NO', 'SELECT id_grado ', 'FROM matricula ', '', 'WHERE idMatricula = (SELECT MAX(idMatricula) idmax FROM matricula WHERE id_estudiante = (SELECT id FROM estudiantes WHERE n_documento = |_ndoc*|))', '', '', '', '', ''),
('incrementos convenio pago', 'NO', 'SELECT * ', 'FROM tbl_cp ', '', 'WHERE convenio = |_convenio*| ', '', '', '', '', ''),
('valor pago icfes', 'NO', 'SELECT * ', 'FROM _tabla* ', '', 'WHERE id_grado = 0 AND a = _a* ', '', '', '', '', ''),
('valor pago', 'NO', 'SELECT * ', 'FROM _tabla* ', '', 'WHERE id_grado = _idgrado* AND a = _a* ', '', '', '', '', ''),
('incrementos pse', 'NO', 'SELECT * ', 'FROM tbl_incrementos ', '', 'WHERE tipo = |_PSE*| ', '', '', '', '', ''),
('incrementos', 'NO', 'SELECT * ', 'FROM tbl_incrementos ', '', 'WHERE tipo = |_tipo*| ', '', '', '', '', ''),
('valor gateway', 'NO', 'SELECT ifnull(val_fijo_gateway, 0) val_gateway, ct_actual ', 'FROM tbl_gateway ', '', 'WHERE estado = |_estado*| AND id_convenio = (SELECT id FROM tbl_cp WHERE convenio = |_convenio*|) ', '', '', '', '', '')
;

INSERT INTO tbl_sentencias_procesos (nombre, utilizaJoin, campos, tablas, joinTablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('validacion presaberes', 'NO', 'SELECT COUNT(1) ct ', 'FROM tbl_respuestas ', '', 'WHERE identificacion = |_documento*| AND respuesta = |_NA*| AND a = _fanio* ', '', '', '', '', ''),
('valida ct preguntas abiertas', 'NO', 'SELECT COUNT(1) ct ', 'FROM tbl_respuestas ', '', 'WHERE identificacion = |_documento*| AND a = _fanio* AND estado = |_estado*| ', '', '', '', '', ''),
('valida ct preguntas cargadas', 'NO', 'SELECT COUNT(1) ct ', 'FROM tbl_respuestas ', '', 'WHERE identificacion = |_documento*| AND a = _fanio* ', '', '', '', '', ''),
('valida preguntas grado sm', 'NO', 'SELECT g.id, g.grado, e.origen ', 'FROM estudiantes_eval_admision e, grados g ', '', 'WHERE e.id_grado = g.id AND e.n_documento = |_documento*| ', '', '', '', '', ''),
('valida ct preguntas grado', 'NO', 'SELECT COUNT(1) ct ', 'FROM tbl_preguntas ', '', 'WHERE id_grado = _idgra* ', '', '', '', '', '')
;

INSERT INTO tbl_sentencias_procesos (nombre, utilizaJoin, campos, tablas, joinTablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('consulta pregunta', 'NO', 'SELECT * ', 'FROM tbl_preguntas ', '', 'WHERE id = _idpreg* ', '', '', '', '', ''),
('nombre y grado presaberes', 'NO', 'SELECT e.*, g.grado ', 'FROM estudiantes_eval_admision e, grados g ', '', 'WHERE e.id_grado = g.id AND e.n_documento = |_documento*| ', '', '', '', '', ''),
('temas pensamiento bio', 'NO', 'SELECT DISTINCT tp.id, tp.tema ', 'FROM tbl_preguntas p, tbl_temas_preguntas tp ', '', 'WHERE p.id_tema = tp.id AND p.id_grado = _idgrado* AND p.id_materia = _idmateria* ', '', '', '', '', ''),
('preguntas por tema bio', 'NO', 'SELECT id ', 'FROM tbl_preguntas ', '', 'WHERE id_tema = _idtema* AND id_grado = _idgrado* AND id_materia = _idmateria* ', '', '', '', '', ''),
('ct preguntas por tema bio', 'NO', 'SELECT ct_preguntas ', 'FROM tbl_temas_preguntas ', '', 'WHERE id_grado = _idgrado* AND id_materia = _idmateria* AND id = _id* ', '', '', '', '', ''),

('temas pensamiento soc', 'NO', 'SELECT DISTINCT tp.id, tp.tema ', 'FROM tbl_preguntas p, tbl_temas_preguntas tp ', '', 'WHERE p.id_tema = tp.id AND p.id_grado = _idgrado* AND p.id_materia = _idmateria* ', '', '', '', '', ''),
('preguntas por tema soc', 'NO', 'SELECT id ', 'FROM tbl_preguntas ', '', 'WHERE id_tema = _idtema* AND id_grado = _idgrado* AND id_materia = _idmateria* ', '', '', '', '', ''),
('ct preguntas por tema soc', 'NO', 'SELECT ct_preguntas ', 'FROM tbl_temas_preguntas ', '', 'WHERE id_grado = _idgrado* AND id_materia = _idmateria* AND id = _id* ', '', '', '', '', ''),
('temas pensamiento num', 'NO', 'SELECT DISTINCT tp.id, tp.tema ', 'FROM tbl_preguntas p, tbl_temas_preguntas tp ', '', 'WHERE p.id_tema = tp.id AND p.id_grado = _idgrado* AND p.id_materia = _idmateria* ', '', '', '', '', ''),
('preguntas por tema num', 'NO', 'SELECT id ', 'FROM tbl_preguntas ', '', 'WHERE id_tema = _idtema* AND id_grado = _idgrado* AND id_materia = _idmateria* ', '', '', '', '', ''),
('ct preguntas por tema num', 'NO', 'SELECT ct_preguntas ', 'FROM tbl_temas_preguntas ', '', 'WHERE id_grado = _idgrado* AND id_materia = _idmateria* AND id = _id* ', '', '', '', '', ''),
('temas pensamiento esp', 'NO', 'SELECT DISTINCT tp.id, tp.tema ', 'FROM tbl_preguntas p, tbl_temas_preguntas tp ', '', 'WHERE p.id_tema = tp.id AND p.id_grado = _idgrado* AND p.id_materia = _idmateria* ', '', '', '', '', ''),
('preguntas por tema esp', 'NO', 'SELECT id ', 'FROM tbl_preguntas ', '', 'WHERE id_tema = _idtema* AND id_grado = _idgrado* AND id_materia = _idmateria* ', '', '', '', '', ''),
('ct preguntas por tema esp', 'NO', 'SELECT ct_preguntas ', 'FROM tbl_temas_preguntas ', '', 'WHERE id_grado = _idgrado* AND id_materia = _idmateria* AND id = _id* ', '', '', '', '', ''),
('temas pensamiento ing', 'NO', 'SELECT DISTINCT tp.id, tp.tema ', 'FROM tbl_preguntas p, tbl_temas_preguntas tp ', '', 'WHERE p.id_tema = tp.id AND p.id_grado = _idgrado* AND p.id_materia = _idmateria* ', '', '', '', '', ''),
('preguntas por tema ing', 'NO', 'SELECT id ', 'FROM tbl_preguntas ', '', 'WHERE id_tema = _idtema* AND id_grado = _idgrado* AND id_materia = _idmateria* ', '', '', '', '', ''),
('ct preguntas por tema ing', 'NO', 'SELECT ct_preguntas ', 'FROM tbl_temas_preguntas ', '', 'WHERE id_grado = _idgrado* AND id_materia = _idmateria* AND id = _id* ', '', '', '', '', ''),
('temas pensamiento tec', 'NO', 'SELECT DISTINCT tp.id, tp.tema ', 'FROM tbl_preguntas p, tbl_temas_preguntas tp ', '', 'WHERE p.id_tema = tp.id AND p.id_grado = _idgrado* AND p.id_materia = _idmateria* ', '', '', '', '', ''),
('preguntas por tema tec', 'NO', 'SELECT id ', 'FROM tbl_preguntas ', '', 'WHERE id_tema = _idtema* AND id_grado = _idgrado* AND id_materia = _idmateria* ', '', '', '', '', ''),
('ct preguntas por tema tec', 'NO', 'SELECT ct_preguntas ', 'FROM tbl_temas_preguntas ', '', 'WHERE id_grado = _idgrado* AND id_materia = _idmateria* AND id = _id* ', '', '', '', '', ''),
('temas pensamiento fis', 'NO', 'SELECT DISTINCT tp.id, tp.tema ', 'FROM tbl_preguntas p, tbl_temas_preguntas tp ', '', 'WHERE p.id_tema = tp.id AND p.id_grado = _idgrado* AND p.id_materia = _idmateria* ', '', '', '', '', ''),
('preguntas por tema fis', 'NO', 'SELECT id ', 'FROM tbl_preguntas ', '', 'WHERE id_tema = _idtema* AND id_grado = _idgrado* AND id_materia = _idmateria* ', '', '', '', '', ''),
('ct preguntas por tema fis', 'NO', 'SELECT ct_preguntas ', 'FROM tbl_temas_preguntas ', '', 'WHERE id_grado = _idgrado* AND id_materia = _idmateria* AND id = _id* ', '', '', '', '', ''),

('conteos ok', 'NO', 'SELECT COUNT(1) ct_ok, identificacion ', 'FROM tbl_respuestas ', '', 'WHERE resultado = |_resultado*| AND identificacion = |_documento*| AND a = _a* ', 'GROUP BY identificacion ', '', '', '', ''),
('conteos no', 'NO', 'SELECT COUNT(1) ct_no, identificacion ', 'FROM tbl_respuestas ', '', 'WHERE resultado = |_resultado*| AND identificacion = |_documento*| AND a = _a* ', 'GROUP BY identificacion ', '', '', '', ''),
('conteos na', 'NO', 'SELECT COUNT(1) ct_na, identificacion ', 'FROM tbl_respuestas ', '', 'WHERE resultado = |_resultado*| AND identificacion = |_documento*| AND a = _a* ', 'GROUP BY identificacion ', '', '', '', ''),
('valida si hay registros en tbl_respuestas', 'NO', 'SELECT COUNT(1) ct ', 'FROM tbl_respuestas ', '', 'WHERE identificacion = |_documento*| AND a = _a* ', '', '', '', '', ''),
('consulta pensamiento', 'NO', 'SELECT id_materia ', 'FROM tbl_pregunta ', '', 'WHERE id = _id* ', '', '', '', '', '')
;

INSERT INTO tbl_sentencias_procesos (nombre, utilizaJoin, campos, tablas, joinTablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('insert tbl_respuestas', 'NO', '', 'INSERT INTO tbl_respuestas ', '', '', '', '', '', '', '(id_grado, id_materia, id_pregunta, a, identificacion, respuesta, resultado, estado) VALUES (_idgrado*, _idpen*, _idpregunta*, _a*, |_documento*|, |_respuesta*|, |_resultado*|, |_estado*|)'),
('valida respuestas na', 'NO', 'SELECT * ', 'FROM tbl_respuestas ', '', 'WHERE resultado = |_resultado*| AND identificacion = |_documento*| AND a = _a* ', '', '', '', '', ''),
('actualizar respuesta presaberes', 'NO', '', 'UPDATE tbl_respuestas ', '', 'WHERE id_pregunta = _idpreg* AND identificacion = |_documento*| AND a = _a* ', '', '', 'SET respuesta = |_respuesta*|, resultado = |_resultado*| ', '', ''),
('nombre estudiante', 'NO', 'SELECT e.id, e.nombres, e.apellidos ', 'FROM estudiantes e ', '', 'WHERE e.n_documento = |_documento*| ', '', '', '', '', ''),

('conteos no num', 'NO', 'SELECT COUNT(1) ct ', 'FROM tbl_respuestas r, tbl_preguntas p ', '', 'WHERE r.id_pregunta = p.id AND r.resultado = |_resultado*| AND r.identificacion = |_documento*| AND r.a = _a* AND r.id_materia = 5 ', '', '', '', '', ''),
('conteos no bio', 'NO', 'SELECT COUNT(1) ct ', 'FROM tbl_respuestas r, tbl_preguntas p ', '', 'WHERE r.id_pregunta = p.id AND r.resultado = |_resultado*| AND r.identificacion = |_documento*| AND r.a = _a* AND r.id_materia = 1 ', '', '', '', '', ''),
('conteos no soc', 'NO', 'SELECT COUNT(1) ct ', 'FROM tbl_respuestas r, tbl_preguntas p ', '', 'WHERE r.id_pregunta = p.id AND r.resultado = |_resultado*| AND r.identificacion = |_documento*| AND r.a = _a* AND r.id_materia = 4 ', '', '', '', '', ''),
('conteos no esp', 'NO', 'SELECT COUNT(1) ct ', 'FROM tbl_respuestas r, tbl_preguntas p ', '', 'WHERE r.id_pregunta = p.id AND r.resultado = |_resultado*| AND r.identificacion = |_documento*| AND r.a = _a* AND r.id_materia = 6 ', '', '', '', '', ''),
('conteos no ing', 'NO', 'SELECT COUNT(1) ct ', 'FROM tbl_respuestas r, tbl_preguntas p ', '', 'WHERE r.id_pregunta = p.id AND r.resultado = |_resultado*| AND r.identificacion = |_documento*| AND r.a = _a* AND r.id_materia = 7 ', '', '', '', '', ''),
('conteos no tec', 'NO', 'SELECT COUNT(1) ct ', 'FROM tbl_respuestas r, tbl_preguntas p ', '', 'WHERE r.id_pregunta = p.id AND r.resultado = |_resultado*| AND r.identificacion = |_documento*| AND r.a = _a* AND r.id_materia = 9 ', '', '', '', '', ''),
('conteos no fis', 'NO', 'SELECT COUNT(1) ct ', 'FROM tbl_respuestas r, tbl_preguntas p ', '', 'WHERE r.id_pregunta = p.id AND r.resultado = |_resultado*| AND r.identificacion = |_documento*| AND r.a = _a* AND r.id_materia = 11 ', '', '', '', '', ''),

('retroalimentacion no num', 'NO', 'SELECT DISTINCT p.retroalimentacion ', 'FROM tbl_respuestas r, tbl_preguntas p ', '', 'WHERE r.id_pregunta = p.id AND r.resultado = |_resultado*| AND r.identificacion = |_documento*| AND r.a = _a* AND r.id_materia = _idmateria* ', '', '', '', '', ''),
('retroalimentacion no bio', 'NO', 'SELECT DISTINCT p.retroalimentacion ', 'FROM tbl_respuestas r, tbl_preguntas p ', '', 'WHERE r.id_pregunta = p.id AND r.resultado = |_resultado*| AND r.identificacion = |_documento*| AND r.a = _a* AND r.id_materia = _idmateria* ', '', '', '', '', ''),
('retroalimentacion no soc', 'NO', 'SELECT DISTINCT p.retroalimentacion ', 'FROM tbl_respuestas r, tbl_preguntas p ', '', 'WHERE r.id_pregunta = p.id AND r.resultado = |_resultado*| AND r.identificacion = |_documento*| AND r.a = _a* AND r.id_materia = _idmateria* ', '', '', '', '', ''),
('retroalimentacion no esp', 'NO', 'SELECT DISTINCT p.retroalimentacion ', 'FROM tbl_respuestas r, tbl_preguntas p ', '', 'WHERE r.id_pregunta = p.id AND r.resultado = |_resultado*| AND r.identificacion = |_documento*| AND r.a = _a* AND r.id_materia = _idmateria* ', '', '', '', '', ''),
('retroalimentacion no ing', 'NO', 'SELECT DISTINCT p.retroalimentacion ', 'FROM tbl_respuestas r, tbl_preguntas p ', '', 'WHERE r.id_pregunta = p.id AND r.resultado = |_resultado*| AND r.identificacion = |_documento*| AND r.a = _a* AND r.id_materia = _idmateria* ', '', '', '', '', ''),
('retroalimentacion no tec', 'NO', 'SELECT DISTINCT p.retroalimentacion ', 'FROM tbl_respuestas r, tbl_preguntas p ', '', 'WHERE r.id_pregunta = p.id AND r.resultado = |_resultado*| AND r.identificacion = |_documento*| AND r.a = _a* AND r.id_materia = _idmateria* ', '', '', '', '', ''),
('retroalimentacion no fis', 'NO', 'SELECT DISTINCT p.retroalimentacion ', 'FROM tbl_respuestas r, tbl_preguntas p ', '', 'WHERE r.id_pregunta = p.id AND r.resultado = |_resultado*| AND r.identificacion = |_documento*| AND r.a = _a* AND r.id_materia = _idmateria* ', '', '', '', '', '')
;

INSERT INTO tbl_sentencias_procesos (nombre, utilizaJoin, campos, tablas, joinTablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('conteos ok por pensamiento', 'NO', 'SELECT COUNT(1) ct_ok, identificacion, id_materia ', 'FROM tbl_respuestas ', '', 'WHERE resultado = |_resultado*| AND identificacion = |_documento*| AND a = _a* ', 'GROUP BY identificacion, id_materia ', '', '', '', ''),
('conteos no por pensamiento', 'NO', 'SELECT COUNT(1) ct_no, identificacion, id_materia ', 'FROM tbl_respuestas ', '', 'WHERE resultado = |_resultado*| AND identificacion = |_documento*| AND a = _a* ', 'GROUP BY identificacion, id_materia ', '', '', '', ''),
('conteos na por pensamiento', 'NO', 'SELECT COUNT(1) ct_na, identificacion, id_materia ', 'FROM tbl_respuestas ', '', 'WHERE resultado = |_resultado*| AND identificacion = |_documento*| AND a = _a* ', 'GROUP BY identificacion, id_materia ', '', '', '', ''),
('resultado preguntas', 'NO', 'SELECT m.materia, m.pensamiento, p.pregunta, r.respuesta, r.resultado, case r.resultado when |_resultado*| then |_muyBien*| else p.retroalimentacion end comentarios, substring(p.imagen, 7) ruta ', 'FROM tbl_respuestas r, tbl_preguntas p, materias m ', '', 'WHERE r.id_pregunta = p.id AND r.id_materia = m.id AND r.a = _a* AND r.identificacion = |_documento*| ', '', '', '', '', ''),
('valida preguntas grado', 'NO', 'SELECT g.id, g.grado ', 'FROM estudiantes e, matricula m, grados g ', '', 'WHERE e.id = m.id_estudiante AND m.id_grado = g.id AND e.n_documento = |_documento*| AND m.n_matricula like _a* AND m.estado IN (|_estado*|, |_estado1*|) ', '', '', '', '', ''),
('estudiantes activos', 'NO', 'SELECT COUNT(1) ct ', 'FROM matricula ', '', 'WHERE n_matricula like _a* and estado = |_estado*| ', '', '', '', '', ''),
('autorizados para estados financieros', 'NO', 'SELECT * ', 'FROM tbl_empleados ', '', 'WHERE email = |_usuario*| AND n_documento = |_pass*| AND estado = |_estado*| ', '', '', '', '', '')
;

INSERT INTO tbl_sentencias_procesos (nombre, utilizaJoin, campos, tablas, joinTablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones, inserciones) VALUES
('grado documento', 'NO', 'SELECT e.id, e.nombres, e.apellidos, m.id_grado, g.grado ', 'FROM estudiantes e, matricula m, grados g ', '', 'WHERE e.id = m.id_estudiante AND m.id_grado = g.id AND e.n_documento = |_documento*| AND m.estado IN (|_estado*|, |_estado1*|) AND m.n_matricula like _a* ', '', '', '', '', '')
;








