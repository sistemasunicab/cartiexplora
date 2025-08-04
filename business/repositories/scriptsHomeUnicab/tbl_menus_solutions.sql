DROP TABLE IF EXISTS tbl_menus_solutions;

CREATE TABLE tbl_menus_solutions (
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

INSERT INTO tbl_menus_solutions (menu, nivel, padre, icono, linkNivelRaiz, linkNivelTres, destino) VALUES
('UNICAB Solutions', '' ,'', '', '', '', ''),
('Correo', '', '', '', 'https://mail.google.com/a/unicab.org/', 'https://mail.google.com/a/unicab.org/', '_blank'),

('¿Quiénes Somos?', 'raiz', '1', '', 'business/solutions/pages/index.php', 'index.php',''),
('Misión', 'raiz', '1', '', 'business/solutions/pages/mision.php', 'mision.php',''),
('Visión', 'raiz', '1', '', 'business/solutions/pages/vision.php', 'vision.php',''),
('Director del Programa de educación formal', 'raiz', '1', '', 'business/solutions/pages/directorProgramaEducacionFormal.php', 'directorProgramaEducacionFormal.php',''),
('Servicios de educación informal', 'raiz', '1', '', 'business/solutions/pages/serviciosEducacionInformal.php', 'serviciosEducacionInformal.php',''),
('Consultoría empresarial', 'raiz', '1', '', 'business/solutions/pages/consultoriaEmpresarial.php', 'consultoriaEmpresarial.php','');

UPDATE tbl_menus_solutions SET menu = "Srevicios" WHERE id = 3;
UPDATE tbl_menus_solutions SET visible = 0 WHERE padre = 1 AND id != 3;