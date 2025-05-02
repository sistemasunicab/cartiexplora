DROP TABLE IF EXISTS tbl_conceptos_pago;

CREATE TABLE tbl_conceptos_pago (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  valor varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  texto varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci; 

INSERT INTO tbl_conceptos_pago ( valor ,  texto ) VALUES ('m', 'Matrícula');
INSERT INTO tbl_conceptos_pago ( valor ,  texto ) VALUES ('pm1', 'Pensión mes 1 (Febrero)');
INSERT INTO tbl_conceptos_pago ( valor ,  texto ) VALUES ('pm2', 'Pensión mes 2 (Marzo)');
INSERT INTO tbl_conceptos_pago ( valor ,  texto ) VALUES ('pm3', 'Pensión mes 3 (Abril)');
INSERT INTO tbl_conceptos_pago ( valor ,  texto ) VALUES ('pm4', 'Pensión mes 4 (Mayo)');
INSERT INTO tbl_conceptos_pago ( valor ,  texto ) VALUES ('pm5', 'Pensión mes 5 (Junio)');
INSERT INTO tbl_conceptos_pago ( valor ,  texto ) VALUES ('pm6', 'Pensión mes 6 (Julio)');
INSERT INTO tbl_conceptos_pago ( valor ,  texto ) VALUES ('pm7', 'Pensión mes 7 (Agosto)');
INSERT INTO tbl_conceptos_pago ( valor ,  texto ) VALUES ('pm8', 'Pensión mes 8 (Septiembre)');
INSERT INTO tbl_conceptos_pago ( valor ,  texto ) VALUES ('pm9', 'Pensión mes 9 (Octubre)');
INSERT INTO tbl_conceptos_pago ( valor ,  texto ) VALUES ('pm10', 'Pensión mes 10 (Noviembre)');
INSERT INTO tbl_conceptos_pago ( valor ,  texto ) VALUES ('ocp', 'Otros cobros periódicos');
INSERT INTO tbl_conceptos_pago ( valor ,  texto ) VALUES ('pp', 'Primer pago');
INSERT INTO tbl_conceptos_pago ( valor ,  texto ) VALUES ('dg', 'Derechos de grado');
