DROP TABLE tbl_menus;

CREATE TABLE tbl_menus (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  menu varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  nivel varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  padre varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  icono varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  linkNivelRaiz varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  linkNivelTres varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  destino varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  visible int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_menus (menu, nivel, padre, icono, linkNivelRaiz, linkNivelTres, destino) VALUES
('Colegio UNICAB Virtual', '', '', '', '', '', ''),
('CARTI Explora', '', '', '', '', '', ''),
('UNICAB Solutions', '', '', '', '', '', ''),
('Admisiones', '', '', '', '', '', ''),
('Aula Virtual', '', '', '', 'https://aulavirtual.unicab.org/login/', 'https://aulavirtual.unicab.org/login/', '_blank'),
('Registro Académico', '', '', '', '', '', ''),
('Correo', '', '', '', 'https://mail.google.com/a/unicab.org/', 'https://mail.google.com/a/unicab.org/', '_blank'),

('Dirección y Administración', 'raiz', '1', '', '', '', ''),
('Consejo Directivo', 'raiz', '1', '', '', '', ''),
('Rectoría', 'raiz', '1', '', '', '', ''),
('Coordinación Académica', 'raiz', '1', '', '', '', ''),
('Secretaría Académica', 'raiz', '1', '', '', '', ''),
('Equipo de Maestros Mediadores', 'raiz', '1', '', '', '', ''),
('Asesores Pedagógicos', 'raiz', '1', '', '', '', ''),

('Misión y Visión', 'raiz', '2', '', 'business/cartiExplora/pages/misionVision.php', 'misionVision.php', ''),
('Principios y valores', 'raiz', '2', '', 'business/cartiExplora/pages/principiosValores.php', 'principiosValores.php', ''),
('Servicios', 'raiz', '2', '', 'business/cartiExplora/pages/servicios.php', 'servicios.php', ''),

('¿Quienes Somos?', 'raiz', '3', '', 'business/solutions/pages/somos.php', 'somos.php', ''),
('Misión', 'raiz', '3', '', 'business/solutions/pages/mision.php', 'mision.php', ''),
('Director del Programa de Educación Formal', 'raiz', '3', '', 'business/solutions/pages/directorProgramaEducacionFormal.php', 'directorProgramaEducacionFormal.php', ''),
('Servicios de Educación Informal', 'raiz', '3', '', 'business/solutions/pages/serviciosEducacionInformal.php', 'serviciosEducacionInformal.php', ''),
('Consultoría Empresarial', 'raiz', '3', '', 'business/solutions/pages/consultoriaEmpresarial.php', 'consultoriaEmpresarial.php', ''),

('Entrevista', 'raiz', '4', '', 'business/org/pages/entrevista.php', 'entrevista.php', ''),
('Evaluación Presaberes', 'raiz', '4', '', 'business/org/pages/evaluacionPresaberes.php', 'evaluacionPresaberes.php', ''),
('Costos', 'raiz', '4', '', 'business/org/pages/costos.php', 'costos.php', ''),
('Pagos', 'raiz', '4', '', 'business/org/pages/pagos.php', 'pagos.php', ''),

('Estudiantes', 'uno', '8', '', 'business/org/pages/estudiantes.php', 'estudiantes.php', ''),
('Educación Regular', 'uno', '8', '', 'business/org/pages/educacionRegular.php', 'educacionRegular.php', ''),
('Solicitud de Certificaciones y Papeles', 'uno', '8', '', 'business/org/pages/solicitudCertificacionesPapeles.php', 'solicitudCertificacionesPapeles.php', ''),
('Manual de Convivencia', 'uno', '8', '', 'business/org/pages/manualConvivencia.php', 'manualConvivencia.php', ''),
('Educación por Ciclos Propedéuticos (Mayores 18 años)', 'uno', '8', '', 'business/org/pages/educacionCiclos.php', 'educacionCiclos.php', '');

