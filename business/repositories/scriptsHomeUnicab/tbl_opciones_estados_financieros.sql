DROP TABLE IF EXISTS tbl_opciones_estados_financieros;

CREATE TABLE tbl_opciones_estados_financieros (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombrePadre varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  valor varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  visible int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_opciones_estados_financieros(nombrePadre, valor, visible) VALUES
('Relación con la institución', 'Estudiante actual', 1),
('Relación con la institución', 'Exalumno', 1),
('Relación con la institución', 'Padre de familia', 1),
('Relación con la institución', 'Maestro mediador', 1),
('Tipo de certificación', 'Certificado de estudios', 1),
('Tipo de certificación', 'Boletín de notas', 1),
('Tipo de certificación', 'Constancia de matrícula', 1);