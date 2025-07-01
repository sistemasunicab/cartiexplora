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
(4, 'correo', 'text', 'correo', 'required', '', '', '' ),
(4, 'asunto', 'text', 'asunto', 'required', '', '', '' ),
(4, 'mensaje', 'text', 'mensaje', 'required', '', '', '' ),
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

INSERT INTO tbl_formularios (id_seccion, campo, tipo, texto, obligatorio, soloLectura, habilitado, placeHolder) VALUES
(37, 'comentario', 'text', 'Comentario', 'required', '', '', 'Comentario'),
(37, 'correo', 'text', 'Correo', 'required', '', '', 'Correo Electronico'),
(37, 'aceptaDatos', 'checkbox', 'Estoy de acuerdo en que estos datos se almacenen y procesen con el fin de establecer contacto. Soy consciente de que puedo revocar mi consentimiento en cualquier momento.', 'required', '', '', ''),
(37, 'enviarComentarioBlog', 'submit', 'Enviar', '', '', '', '');

INSERT INTO tbl_formularios (id_seccion, campo, tipo, texto, obligatorio, soloLectura, habilitado, placeHolder) VALUES
(39, 'btn_pagoamigo', 'button', 'Haz clic para el pago', '', '', '', ''),
(39, 'nombre_responsable', 'text', 'Datos de quien paga', 'required', ' ', ' ', 'Nombre de quien paga'),
(39, 'identificacion_responsable', 'text', '', 'required', '', '', 'Número de identificación'),
(39, 'tratamiento_datos', 'checkbox', 'Acepto tratamiento de datos', 'required', '', '', ''),
(39, 'opvalor0', 'radio', 'Ingrese referencia de pago', '', '', '', ''),
(39, 'opvalor1', 'radio', 'Ingrese valor manual', '', '', '', ''),
(39, 'txtref', 'text', '', 'required', '', '', 'Referencia de pago'),
(39, 'txtvalorref', 'text', '', '', 'readonly', '', 'Valor a pagar'),
(39, 'consultaref', 'button', 'Consultar', '', '', '', ''),
(39, 'txtnumdoc', 'text', 'Documento estudiante', 'required', '', '', 'Documento estudiante'),
(39, 'txtanio', 'text', 'Año', 'required', '', '', 'Año'),
(39, 'txtvalor', 'text', 'Ingrese valor a pagar', 'required', '', '', 'Ingrese valor'),
(39, 'txtvalorrefman', 'text', '', '', 'readonly', '', 'Referencia de pago'),
(39, 'btnpagar', 'submit', 'Realizar pago por ePayco', '', '', '', '')
;

INSERT INTO tbl_formularios (id_seccion, campo, tipo, texto, obligatorio, soloLectura, habilitado, placeHolder)
VALUES 
(25, 'correo_estados_financieros', 'correo', 'correo', 'required', '', '', 'Usuario email'),
(25, 'password_estados_financieros', 'password', 'contraseña', 'required', '', '', 'Password'),
(25, 'submit-estados-financieros', 'submit', 'Solicitar', '', '', '', '');

INSERT INTO tbl_formularios (id_seccion, campo, tipo, texto, obligatorio, soloLectura, habilitado, placeHolder)
VALUES 
-- Primera fila
(26, 'nombre_certificaciones', 'texto', 'nombre', 'required', '', '', 'Nombre Completo'),
(26, 'identificacion_certificaciones', 'numero', 'identificación', 'required', '', '', 'Número de identificación'),
(26, 'tipo_id_certificaciones', 'texto', 'tipo', 'required', '', '', 'Seleccionar tipo'),

-- Segunda fila
(26, 'correo_certificaciones', 'correo', 'correo', 'required', '', '', 'Correo electrónico'),
(26, 'telefono_certificaciones', 'numero', 'telefono', 'required', '', '', 'Número de teléfono'),
(26, 'grado_id_certificaciones', 'texto', 'grado', 'required', '', '', 'Seleccionar grado'),

-- Relación con la institución
(26, 'relacion_certificaciones_select', 'texto', 'relación', 'required', '', '', 'Seleccionar relación con la institución'),

-- Tipo de certificación
(26, 'tipo_certificaciones_select', 'texto', 'tipo de certificación', 'required', '', '', 'Seleccionar tipo de certificación'),

-- Fecha 
(26, 'certificaciones_date', 'numero', 'fecha', 'required', '', '', 'Fecha'),

-- Propósito
(26, 'proposito_certificaciones', 'texto', 'propósito', 'required', '', '', 'Propósito del documento'),

-- Tratamiento de datos
(26, 'tratamiento_certificaciones', 'checkbox', 'Acepto tratamiento de datos', 'required', '', '', 'Acepto tratamiento de datos.'),

-- Botón de envío
(26, 'submit-certificaciones-papeles', 'submit', 'Solicitar', '', '', '', '');

DELETE FROM tbl_formularios WHERE id = 36 AND campo = 'tratamiento_datos';

INSERT INTO tbl_formularios (id_seccion, campo, tipo, texto, obligatorio, soloLectura, habilitado, placeHolder) VALUES
(39, 'selmediopago', 'select', 'Debe seleccionar un medio de pago.', 'required', '', '', 'Seleccione medio de pago'),
(39, 'selconcepto', 'select', 'Debe seleccionar un concepto de pago.', 'required', '', '', 'Seleccione concepto de pago')
;

INSERT INTO tbl_formularios (id_seccion, campo, tipo, texto, obligatorio, soloLectura, habilitado, placeHolder) VALUES
(8, 'correoNewsletter', 'text', 'Correo', 'required', '', '', 'Ingresa tu correo');

INSERT INTO tbl_formularios (id_seccion, campo, tipo, texto, obligatorio, soloLectura, habilitado, placeHolder) VALUES
(39, 'txtcodfact', 'hidden', '', '', '', '', ''),
(39, 'txtconcepto', 'hidden', '', '', '', '', ''),
(39, 'txtcontrolpago', 'hidden', '', '', '', '', ''),
(39, 'txtidgrado', 'hidden', '', '', '', '', '')
;

INSERT INTO tbl_formularios (id_seccion, campo, tipo, texto, obligatorio, soloLectura, habilitado, placeHolder) VALUES
(8, 'unsubscribeNewsletter', 'text', 'Correo', 'required', '', '', 'Ingresa tu correo.'),
(8, 'unsubscribeNewsletterButton', 'submit', 'Cancelar Suscripcion.', '', '', '', '')
;
