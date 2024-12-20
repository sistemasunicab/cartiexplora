DROP TABLE tbl_parametros;

CREATE TABLE tbl_parametros (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_seccion int(11) UNSIGNED NOT NULL DEFAULT 0,
  parametro varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  v1 int(11) DEFAULT NULL,
  v2 int(11) DEFAULT NULL,
  t1 varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  t2 varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  f1 date DEFAULT NULL,
  f2 date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_parametros (id_seccion, parametro, v1, v2, t1, t2, f1, f2) VALUES
(4, 'telefono_admisiones', NULL, NULL, '300 815 6513', NULL, NULL, NULL),
(4, 'correo_admisiones', NULL, NULL, 'admisiones@unicab.org', NULL, NULL, NULL),
(0, 'direccion_unicab', NULL, NULL, 'Calle 13a No. 16-60', NULL, NULL, NULL),
(0, 'ubicacion_unicab', NULL, NULL, 'Sogamoso - Boyacá - Colombia', NULL, NULL, NULL),
(4, 'titulo_form_inscripciones', NULL, NULL, 'Saber más', NULL, NULL, NULL),
(4, 'checkbox_form_inscripciones', NULL, NULL, 'Estoy de acuerdo en que estos datos se almacenen y procesen con el fin de establecer el contacto. Soy consiente de que puedo revocar mi consentimiento en cualquier momento. *<br><br>* indica los campos obligatorios.', NULL, NULL, NULL);

