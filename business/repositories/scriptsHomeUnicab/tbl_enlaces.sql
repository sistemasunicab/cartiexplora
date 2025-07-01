DROP TABLE IF EXISTS tbl_enlaces;

CREATE TABLE tbl_enlaces (
    id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_seccion int(11) UNSIGNED NOT NULL,
    identificacion varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
    link varchar(200) NOT NULL DEFAULT '',
    visible int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_enlaces (id_seccion, identificacion, link, visible) VALUES 
(37, 'Admisiones', 'business/org/pages/costos.php', 1),
(37, 'Nosotros', 'business/org/pages/sobreNosotros.php', 1),
(37, 'Directorio', 'business/org/pages/directorioInstitucional.php', 1),
(37, 'Historia', 'business/org/pages/historia.php', 1),
(37, 'Principal', 'index.php', 1);

INSERT INTO tbl_enlaces (id_seccion, identificacion, link, visible) VALUES 
(7, 'Nuestros estudiantes', 'business/org/pages/nuestrosEstudiantes.php', 1),
(7, 'Egresados', 'business/org/pages/egresados.php', 1),
(7, 'Testimonios', '#', 1),
(7, 'Calendario académico', 'business/org/pages/calendario.php', 1),
(7, 'Manual de convivencia', '#', 0),
(7, 'Biblioteca', 'https://unicab.org/biblioteca/Biblioteca_Unicab/', 1),
(7, 'Entidades que nos vigilan', '#entidadesVigilan', 1),
(7, 'Evidencias de congresos y reconocimientos', '#', 0),
(7, 'Horarios de atención', 'business/org/pages/directorioInstitucional.php#horarios', 1),
(7, 'Directorio', 'business/org/pages/directorioInstitucional.php', 1),
(7, 'Investigación', 'business/org/pages/publicacionesAcademicas.php', 1);

DELETE FROM tbl_enlaces WHERE id = 8;

INSERT INTO tbl_enlaces (id_seccion, identificacion, link, visible) VALUES 
(47, '', 'unicab.org', 1),
(47, '', 'http://localhost/cartiexplora?unsubscribeNewsletter=', 1), -- TODO: Cambiar URL por el de la pagina en produccion
(18, '', 'https://unicab.org/calendario/calendario_2025.pdf', 1)
;

UPDATE tbl_enlaces SET link = 'http://localhost/cartiexplora#newsletterBox' WHERE (`id` = '18');
