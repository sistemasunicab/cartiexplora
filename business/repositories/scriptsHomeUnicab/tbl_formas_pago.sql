DROP TABLE IF EXISTS tbl_formas_pago;

CREATE TABLE tbl_formas_pago (
  id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  valor varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  texto varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

INSERT INTO tbl_formas_pago ( valor ,  texto ) VALUES ('E', 'Efectivo');
INSERT INTO tbl_formas_pago ( valor ,  texto ) VALUES ('P', 'PSE');
INSERT INTO tbl_formas_pago ( valor ,  texto ) VALUES ('P6', 'PSE < 60000');
INSERT INTO tbl_formas_pago ( valor ,  texto ) VALUES ('TC', 'Tarjeta de crédito');
