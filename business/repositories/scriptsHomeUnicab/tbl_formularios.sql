DROP TABLE IF EXISTS tbl_formularios;

CREATE TABLE tbl_formularios (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_seccion int(11) UNSIGNED NOT NULL,
  campo varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  tipo varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  texto varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  obligatorio int(11) NOT NULL DEFAULT 0,
  soloLectura int(11) NOT NULL DEFAULT 0,
  habilitado int(11) NOT NULL DEFAULT 0,
  INDEX fk_tbl_menus_tbl_secciones (id_seccion),
  CONSTRAINT fk_tbl_menus_tbl_secciones FOREIGN KEY (id_seccion) REFERENCES tbl_secciones (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_formularios (id_seccion, campo, tipo, texto, obligatorio, soloLectura, habilitado ) VALUES 
(4, 'nombre', 'text', 'nombre', 1, 0, 1 ),
(4, 'correo', 'email', 'correo', 1, 0, 1 ),
(4, 'asunto', 'text', 'asunto', 1, 0, 1 ),
(4, 'mensaje', 'textarea', 'mensaje', 1, 0, 1 ),
(4, 'checkbox', 'checkbox', 'checkbox', 1, 0, 1 ),
(4, 'Envía tu mensaje', 'submit', 'Envía tu mensaje', 0, 0, 0 ),

(34, 'register_documentoe', 'text', 'Escribe el número documento estudiante y luego haz clic en Continua con el proceso!', 1, 0, 1 ),
(34, 'register_documentoe_f', 'hidden', '', 1, 0, 1 ),
(34, 'estnuevo', 'hidden', '', 1, 0, 1 ),
(34, 'register_apellidos', 'text', 'Apellidos', 1, 0, 1 ),
(34, 'register_nombres', 'text', 'Nombres', 1, 0, 1 ),
(34, 'register_grado', 'select', 'Selecciona el grado a que ingresas', 1, 0, 1 ),
(34, 'grado_permitido', 'hidden', '', 1, 0, 1 ),
(34, 'register_tipo_documento', 'select', 'Tipo de documento de identidad', 1, 0, 1 ),
(34, 'td_text', 'hidden', '', 1, 0, 1 ),
(34, 'register_telefono', 'text', 'Número telefónico', 1, 0, 1 ),
(34, 'register_medio', 'select', 'Selecciona el medio de llegada', 1, 0, 1 ),
(34, 'register_genero', 'select', 'Género', 1, 0, 1 ),
(34, 'activiadad_extra', 'text', 'Actividad extra', 1, 0, 1 ),
(34, 'register_nombreA', 'text', 'Nombre', 1, 0, 1 ),
(34, 'register_documentoA', 'text', 'Documento', 1, 0, 1 ),
(34, 'register_direccionA', 'text', 'Dirección de residencia', 1, 0, 1 ),
(34, 'register_celularA', 'text', 'Celular', 1, 0, 1 ),
(34, 'register_correoA', 'text', 'Correo electrónico acudiente (al cual llegará la factura electrónica)', 1, 0, 1 ),
(34, 'register_correoA1', 'text', 'Confirmar correo electrónico acudiente', 1, 0, 1 ),
(34, 'parentesco_acudiente_1', 'select', 'Parentesco', 1, 0, 1 ),
(34, 'register_ciudada', 'select', 'Ciudad acudiente', 1, 0, 1 ),
(34, '', 'submit', '', 0, 0, 0 );
