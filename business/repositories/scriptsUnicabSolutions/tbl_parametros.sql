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
(1, 'slogan_unicab_solutions', NULL, NULL, '¡Es momento de dar el salto hacia el futuro con nosotros!', NULL, NULL, NULL);

