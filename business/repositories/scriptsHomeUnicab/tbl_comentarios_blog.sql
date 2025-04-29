DROP TABLE IF EXISTS tbl_comentarios_blog;

CREATE TABLE tbl_comentarios_blog (
    id int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_blog int(11) UNSIGNED NOT NULL,
    comentario TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
    correo VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
