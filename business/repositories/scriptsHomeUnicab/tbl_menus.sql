CREATE TABLE tbl_menus (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  menu varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  nivel varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  icono varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  link varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_menus (menu, nivel, icono, link) VALUES
('Colegio Unicab Virtual', 'uno', '', 'business/org/pages/index.php');

