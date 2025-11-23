DROP TABLE tbl_eventos;

CREATE TABLE tbl_eventos (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_tipo_evento int(11) NOT NULL,
  nombre varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  objetivo varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  fecha_ini varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  fecha_fin varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  lugar varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  slogan varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  logo varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_eventos (id_tipo_evento, nombre, objetivo, fecha_ini, fecha_fin, lugar, slogan, logo) VALUES
(5, 'CURSO DESARROLLO DEL PENSAMIENTO LÓGICO', 'DESARROLLAR NUESTRO PENSAMIENTO LÓGICO O CULTIVAR UNA FORMA DE PENSAR: METÓDICA, ANALÍTICA, CREATIVA Y EFICIENTE. SE BUSCA QUE EL ESTUDIANTE TRASLADE ESTAS HABILIDADES A CUALQUIER ÁMBITO DE SU VIDA.', '2025-12-02', '2026-02-12', 'VIRTUAL', 'NA', 'NA')
;