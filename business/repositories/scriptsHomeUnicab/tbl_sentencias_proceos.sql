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
('insert tbl_pre_matricula', 'NO', '', 'INSERT INTO tbl_pre_matricula ', '', '', '', '', '', '', '(id_empleado, id_grado, documento_est, nombres_est, apellidos_est, fecha, actividad_extra, nombre_a, celular_a, email_a, ciudad_a, entrevista, eval, id_medio, año) VALUES (18, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, \'NO\', 0, ?, ?) ')
;
