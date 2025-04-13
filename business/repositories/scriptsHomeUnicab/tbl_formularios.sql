DROP TABLE IF EXISTS tbl_formularios;

CREATE TABLE tbl_formularios (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  id_seccion int(11) UNSIGNED NOT NULL,
  campo varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  tipo varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  texto varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  obligatorio varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  soloLectura varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '',
  habilitado varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '',
  placeHolder varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NULL DEFAULT '',
  INDEX fk_tbl_menus_tbl_secciones (id_seccion),
  CONSTRAINT fk_tbl_menus_tbl_secciones FOREIGN KEY (id_seccion) REFERENCES tbl_secciones (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_formularios (id_seccion, campo, tipo, texto, obligatorio, soloLectura, habilitado, placeHolder ) VALUES 
(4, 'nombre', 'text', 'nombre', 'required', '', '', '' ),
(4, 'correo', 'email', 'correo', 'required', '', '', '' ),
(4, 'asunto', 'text', 'asunto', 'required', '', '', '' ),
(4, 'mensaje', 'textarea', 'mensaje', 'required', '', '', '' ),
(4, 'checkbox', 'checkbox', 'checkbox', 'required', '', '', '' ),
(4, 'enviaMensaje', 'submit', 'Envía tu mensaje', '', '', '', '' ),

(34, 'register_documentoe', 'text', 'Escribe el número documento estudiante y luego haz clic en Continua con el proceso!', 'required', '', '', '"Escribe el número de documento del estudiante sin puntos' ),
(34, 'register_documentoe_f', 'hidden', '', 'required', '', '', '' ),
(34, 'estnuevo', 'hidden', '', '', '', '', '' ),
(34, 'register_apellidos', 'text', 'Apellidos', 'required', '', '', 'Escribe los apellidos del estudiante' ),
(34, 'register_nombres', 'text', 'Nombres', 'required', '', '', 'Escribe los nombres del estudiante' ),
(34, 'register_grado', 'select', 'Selecciona el grado a que ingresas', 'required', '', '', '' ),
(34, 'grado_permitido', 'hidden', '', '', '', '', '' ),
(34, 'register_tipo_documento', 'select', 'Tipo de documento de identidad', 'required', '', '', '' ),
(34, 'td_text', 'hidden', '', '', '', '', '' ),
(34, 'register_telefono', 'text', 'Número telefónico', 'required', '', '', 'Escribe el número telefónico del estudiante sin espacios' ),
(34, 'register_medio', 'select', 'Selecciona el medio de llegada', 'required', '', '', '' ),
(34, 'register_genero', 'select', 'Género', 'required', '', '', '' ),
(34, 'activiadad_extra', 'text', 'Actividad extra', 'required', '', '', 'Escribe la actividad extra del estudiante' ),
(34, 'register_nombreA', 'text', 'Nombre', 'required', '', '', 'Escribe el nombre del acudiente' ),
(34, 'register_documentoA', 'text', 'Documento', 'required', '', '', 'Escribe el número de documento del acudiente sin puntos' ),
(34, 'register_direccionA', 'text', 'Dirección de residencia', 'required', '', '', 'Escribe la dirección del acudiente' ),
(34, 'register_celularA', 'text', 'Celular', 'required', '', '', 'Escribe el número de celular del acudiente sin espacios' ),
(34, 'register_correoA', 'text', 'Correo electrónico acudiente (al cual llegará la factura electrónica)', 'required', '', '', 'Escribe el correo electrónico del acudiente' ),
(34, 'register_correoA1', 'text', 'Confirmar correo electrónico acudiente', 'required', '', '', 'Escribe el correo electrónico del acudiente' ),
(34, 'parentesco_acudiente_1', 'select', 'Parentesco', 'required', '', '', '' ),
(34, 'register_ciudada', 'text', 'Ciudad acudiente', 'required', '', '', 'Escribe la ciudad del acudiente' ),
(34, '', 'submit', '', '', '', '', '' );
