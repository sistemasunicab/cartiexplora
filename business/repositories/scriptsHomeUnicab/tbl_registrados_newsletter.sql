DROP TABLE IF EXISTS tbl_registrados_newsletter;

CREATE TABLE tbl_registrados_newsletter (
    id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    correo VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
);