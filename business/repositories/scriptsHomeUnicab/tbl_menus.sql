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
('CARTI Explora', '', '', '', '', '',''),
('UNICAB Solutions', '' ,'', '', '', '', ''),
('Admisiones', '', '', '', '', '', ''),
('Aula Virtual', '', '', '', 'https://aulavirtual.unicab.org/login/', 'https://aulavirtual.unicab.org/login/', '_blank'),
('Registro Académico', '', '', '', '', '', ''),
('Correo', '', '', '', 'https://mail.google.com/a/unicab.org/', 'https://mail.google.com/a/unicab.org/', '_blank'),

('Dirección y Administración', 'raiz', '1', '', '', '',''),
('Sobre Nosostros', 'raiz', '1', '', 'business/org/pages/sobreNosotros.php', 'sobreNosotros.php',''),
('Nuestra Historia', 'raiz', '1', '', '', '',''),
('Principios que Nos Guían', 'raiz', '1', '', '', '',''),
('Red de Grupos UNICAB', 'raiz', '1', '', '', '',''),
('Modelo Pedagógico', 'raiz', '1', '', '', '',''),
('Oferta Educativa', 'raiz', '1', '', '', '',''),
('Directorio de Contactos', 'raiz', '1', '', '', '',''),
('Horarios de Atención', 'raiz', '1', '', '', '',''),
('Calendario Académico', 'raiz', '1', '', '', '',''),

('Comunicados', 'uno', '8', '', 'business/org/pages/comunicados.php', 'comunicados.php', ''),
('Estados Financieros', 'uno', '8', '', 'business/org/pages/estadosFinancieros.php', 'estadosFinancieros.php', ''),
('Solicitud de Certificaciones', 'uno', '8', '', 'business/org/pages/solicitudCertificaciones.php', 'solicitudCertificaciones.php', ''),
('Publicaciones Académicas', 'uno', '8', '', 'business/org/pages/publicacionesAcademicas.php', 'publicacionesAcademicas.php', ''),

('Misión y Visión', 'raiz', '2', '', 'business/cartiExplora/pages/misionVision.php', 'misionVision.php',''),
('Principios y Valores', 'raiz', '2', '', 'business/cartiExplora/pages/principiosValores.php', 'principiosValores.php',''),
('Servicios', 'raiz', '2', '', 'business/cartiExplora/pages/servicios.php', 'servicios.php',''),

('¿Quiénes Somos?', 'raiz', '3', '', 'business/solutions/pages/somos.php', 'somos.php',''),
('Misión', 'raiz', '3', '', 'business/solutions/pages/mision.php', 'mision.php',''),
('Visión', 'raiz', '3', '', 'business/solutions/pages/vision.php', 'vision.php',''),
('Director del Programa de educación formal', 'raiz', '3', '', 'business/solutions/pages/directorProgramaEducacionFormal.php', 'directorProgramaEducacionFormal.php',''),
('Servicios de educación informal', 'raiz', '3', '', 'business/solutions/pages/serviciosEducacionInformal.php', 'serviciosEducacionInformal.php',''),
('Consultoría empresarial', 'raiz', '3', '', 'business/solutions/pages/consultoriaEmpresarial.php', 'consultoriaEmpresarial.php',''),

('Entrevista', 'raiz', '4', '', 'business/org/pages/entrevista.php', 'entrevista.php',''),
('Evaluación Presaberes', 'raiz', '4', '', 'business/org/pages/evaluacionPresaberes.php', 'evaluacionPresaberes.php',''),
('Costos', 'raiz', '4', '', 'business/org/pages/costos.php', 'costos.php',''),
('Pagos', 'raiz', '4', '', 'business/org/pages/pagos.php', 'pagos.php','');