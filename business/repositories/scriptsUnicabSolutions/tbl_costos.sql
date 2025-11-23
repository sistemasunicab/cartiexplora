DROP TABLE tbl_costos;

CREATE TABLE tbl_costos (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_evento int(11) NOT NULL,
  costo int(11) NOT NULL,
  fecha_descuento varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  valor_con_descuento int(11) NOT NULL,
  convenio1 varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  valor_convenio1 int(11) NOT NULL,
  convenio2 varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  valor_convenio2 int(11) NOT NULL,
  fecha_limite_inscripcion varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_costos (id_evento, costo, fecha_descuento, valor_con_descuento, convenio1, valor_convenio1, convenio2, valor_convenio2, fecha_limite_inscripcion) VALUES
(1, 280000, '20250101', 280000, 'NO_ESTUDIANTE', 0, 'EXTRA', 280000, '20251202')
;