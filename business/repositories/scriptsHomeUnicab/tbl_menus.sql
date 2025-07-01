DROP TABLE IF EXISTS tbl_menus;

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
('Registro Académico', '', '', '', 'https://unicab.org/login_registro.php', 'https://unicab.org/login_registro.php', '_blank'),
('Correo', '', '', '', 'https://mail.google.com/a/unicab.org/', 'https://mail.google.com/a/unicab.org/', '_blank'),

('Sobre Nosostros', 'raiz', '1', '', 'business/org/pages/sobreNosotros.php', '../../../business/org/pages/sobreNosotros.php',''),
('Nuestra Historia', 'raiz', '1', '', 'business/org/pages/historia.php', '../../../business/org/pages/historia.php',''),
('Principios que Nos Guían', 'raiz', '1', '', 'business/org/pages/principiosYValores.php', '../../../business/org/pages/principiosYValores.php',''),
('Red de Grupos UNICAB', 'raiz', '1', '', 'business/org/pages/historia.php#grupos', '../../../business/org/pages/historia.php#grupos',''),
('Modelo Pedagógico', 'raiz', '1', '', 'business/org/pages/modelo.php', '../../../business/org/pages/modelo.php',''),
('Oferta Educativa', 'raiz', '1', '', '#ofertaAcademica', '#ofertaAcademica',''),
('Directorio de Contactos', 'raiz', '1', '', 'business/org/pages/directorioInstitucional.php', '../../../business/org/pages/directorioInstitucional.php',''),
('Horarios de Atención', 'raiz', '1', '', 'business/org/pages/directorioInstitucional.php#horarios', '../../../business/org/pages/directorioInstitucional.php#horarios',''),
('Calendario Académico', 'raiz', '1', '', 'business/org/pages/calendario.php', '../../../business/org/pages/calendario.php',''),

('Comunicados', 'raiz', '1', '', 'business/org/pages/calendario.php#comunicados', '../../../business/org/pages/calendario.php#comunicados', ''),
('Estados Financieros', 'raiz', '1', '', 'business/org/pages/estadosFinancieros.php', '../../../business/org/pages/estadosFinancieros.php', ''),
('Solicitud de Certificaciones', 'raiz', '1', '', 'business/org/pages/estadosFinancieros.php#certificaciones', '../../../business/org/pages/estadosFinancieros.php#certificaciones', ''),
('Publicaciones Académicas', 'raiz', '1', '', 'business/org/pages/publicacionesAcademicas.php', '../../../business/org/pages/publicacionesAcademicas.php', ''),

('Misión y Visión', 'raiz', '2', '', 'business/cartiExplora/pages/cartiHome.php#divMision', '../../../business/cartiExplora/pages/cartiHome.php#divMision',''),
('Principios y Valores', 'raiz', '2', '', 'business/cartiExplora/pages/cartiHome.php#divPrincipios', '../../../business/cartiExplora/pages/cartiHome.php#divPrincipios',''),
('Servicios', 'raiz', '2', '', 'business/cartiExplora/pages/servicios.php', '../../../business/cartiExplora/pages/servicios.php',''),

('¿Quiénes Somos?', 'raiz', '3', '', 'business/solutions/pages/somos.php', '../../../business/solutions/pages/somos.php',''),
('Misión', 'raiz', '3', '', 'business/solutions/pages/mision.php', '../../../business/solutions/pages/mision.php',''),
('Visión', 'raiz', '3', '', 'business/solutions/pages/vision.php', '../../../business/solutions/pages/vision.php',''),
('Director del Programa de educación formal', 'raiz', '3', '', 'business/solutions/pages/directorProgramaEducacionFormal.php', '../../../business/solutions/pages/directorProgramaEducacionFormal.php',''),
('Servicios de educación informal', 'raiz', '3', '', 'business/solutions/pages/serviciosEducacionInformal.php', '../../../business/solutions/pages/serviciosEducacionInformal.php',''),
('Consultoría empresarial', 'raiz', '3', '', 'business/solutions/pages/consultoriaEmpresarial.php', '../../../business/solutions/pages/consultoriaEmpresarial.php',''),

('Entrevista', 'raiz', '4', '', 'business/org/pages/entrevista.php', '../../../business/org/pages/entrevista.php',''),
('Evaluación Presaberes', 'raiz', '4', '', 'business/org/pages/evaluacionPresaberes.php', '../../../business/org/pages/evaluacionPresaberes.php',''),
('Costos', 'raiz', '4', '', 'business/org/pages/costos.php', '../../../business/org/pages/costos.php',''),
('Pagos', 'raiz', '4', '', 'business/org/pages/pagos.php', '../../../business/org/pages/pagos.php',''),

('Nuestros Estudiantes', 'raiz', '1', '', 'business/org/pages/nuestrosEstudiantes.php', '../../../business/org/pages/nuestrosEstudiantes.php', ''),
('Blog', 'raiz', '1', '', 'business/org/pages/blog.php', '../../../business/org/pages/blog.php', '');

UPDATE tbl_menus SET menu = "Celebrando Logros" WHERE id = 35;
UPDATE tbl_menus SET visible = 0 WHERE id = 13;
UPDATE tbl_menus SET visible = 0 WHERE id = 23;
UPDATE tbl_menus SET menu = "Srevicios" WHERE id = 24;
UPDATE tbl_menus SET visible = 0 WHERE padre = 3 AND id != 24;