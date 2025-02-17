DROP TABLE tbl_parametros;

CREATE TABLE tbl_parametros (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  parametro varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  v1 int(11) DEFAULT NULL,
  v2 int(11) DEFAULT NULL,
  t1 varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  t2 varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  f1 date DEFAULT NULL,
  f2 date DEFAULT NULL,
  id_seccion int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_parametros (parametro, v1, v2, t1, t2, f1, f2, id_seccion) VALUES
('telefono_admisiones', NULL, NULL, '300 815 6513', NULL, NULL, NULL, 10),
('correo_admisiones', NULL, NULL, 'admisiones@unicab.org', NULL, NULL, NULL, 10),
('direccion_unicab', NULL, NULL, 'Calle 13a No. 16-60', NULL, NULL, NULL, 10),
('ubicacion_unicab', NULL, NULL, 'Sogamoso - Boyacá - Colombia', NULL, NULL, NULL, 10),
('blog_newsletter_texto', NULL, NULL, 'Recibe nuestras newsletter semanal', NULL, NULL, NULL, 8);