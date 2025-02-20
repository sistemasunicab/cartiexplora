DROP TABLE tbl_formularios;

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

INSERT INTO tbl_formularios (id_seccion, campo, tipo, obligatorio, soloLectura, habilitado ) VALUES 
(4, 'nombre', 'text', 1, 0, 1 ),
(4, 'correo', 'email', 1, 0, 1 ),
(4, 'asunto', 'text', 1, 0, 1 ),
(4, 'mensaje', 'textarea', 1, 0, 1 ),
(4, 'checkbox', 'checkbox', 1, 0, 1 ),
(4, 'Envía tu mensaje', 'submit', 0, 0, 0 );
