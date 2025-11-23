DROP TABLE tbl_tipos_participantes;

CREATE TABLE tbl_tipos_participantes (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  tipo_participante varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_tipos_participantes (tipo_participante) VALUES
('SELECCIONE TIPO PARTICIPANTE'),
('ADMINISTRADOR'),
('INVITADO'),
('LOGISTICA'),
('PARTICIPANTE'),
('PONENTE'),
('ESTUDIANTE');