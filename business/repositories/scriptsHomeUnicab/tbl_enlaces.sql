DROP TABLE IF EXISTS tbl_enlaces;

CREATE TABLE tbl_enlaces (
    id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_seccion int(11) UNSIGNED NOT NULL,
    identificacion varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
    link varchar(200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_enlaces (id_seccion, identificacion, link) VALUES 
(37, 'Admisiones', 'business/org/pages/costos.php'),
(37, 'Nosotros', 'business/org/pages/sobreNosotros.php'),
(37, 'Directorio', 'business/org/pages/directorio.php'),
(37, 'Historia', 'business/org/pages/historia.php'),
(37, 'Principal', 'index.php');