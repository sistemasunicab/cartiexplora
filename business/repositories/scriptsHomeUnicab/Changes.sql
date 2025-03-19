UPDATE tbl_imagenes 
SET id_seccion = 17, 
    ruta = 'assets/img/Grupo 1.png', 
    descripcion = 'image-schedule', 
    titulo = 'LUNES A VIERNES<br>8:00 a.m. A 12:00 p.m.', 
    posicionTitulo = '', 
    rutaEncima = '', 
    textoAlterno = 'schedule' 
WHERE id = 66;

INSERT INTO tbl_imagenes (id_seccion, ruta, descripcion, titulo, posicionTitulo, rutaEncima, textoAlterno) VALUES
(26, 'assets/img/icon-send.png', 'icon-send', '', '', '', '');

--SENTENCIAS #103 y #104
INSERT INTO tbl_sentencias (campos, tablas, condiciones, agrupaciones, ordenamientos, modificaciones, condicionesAgrupaciones) VALUES
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 26 AND descripcion = |icon-send| ', '', '', '', ''),
('SELECT * ', 'FROM tbl_imagenes ', 'WHERE id_seccion = 17 AND descripcion = |image-schedule| ', '', '', '', '');