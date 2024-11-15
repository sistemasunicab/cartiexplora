CREATE TABLE tbl_formularios (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_seccion int(11) UNSIGNED NOT NULL,
  campo varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  tipo varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL,
  obligatorio int(11) NOT NULL DEFAULT 0,
  soloLectura int(11) NOT NULL DEFAULT 0,
  habilitado int(11) NOT NULL DEFAULT 0,
  INDEX fk_tbl_menus_tbl_secciones (id_seccion),
  CONSTRAINT fk_tbl_menus_tbl_secciones FOREIGN KEY (id_seccion) REFERENCES tbl_secciones (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

