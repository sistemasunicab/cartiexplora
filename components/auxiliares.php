<?php
// -----------------------------
// 2) FUNCIONES AUXILIARES
// -----------------------------

/**
 * Ejecuta una sentencia SQL basada en el prefijo “$sentencia” + número,
 * devuelve el primer campo 't1' de la primera fila (o null si no hay resultado).
 *
 * @param mysqli $mysqli    Conexión activa.
 * @param string $sentencia Prefijo de la sentencia.
 * @param int    $num       Número de la sentencia a concatenar.
 * @return string|null      Valor del campo t1 o null.
 */
function obtenerValorSimple(mysqli $mysqli, string $sentencia, int $num): ?string
{
    $resSent = $mysqli->query($sentencia . $num);
    if (!$resSent) {
        return null;
    }

    $sqlDatos = '';
    while ($filaSent = $resSent->fetch_assoc()) {
        // Reemplazo '|' por comillas simples en las condiciones
        $conds = str_replace('|', '\'', $filaSent['condiciones']);
        $sqlDatos = $filaSent['campos'] . $filaSent['tablas'] . $conds;
    }
    if (empty($sqlDatos)) {
        return null;
    }

    $resDatos = $mysqli->query($sqlDatos);
    if (!$resDatos) {
        return null;
    }

    if ($filaDatos = $resDatos->fetch_assoc()) {
        return $filaDatos['t1'] ?? null;
    }
    return null;
}

/**
 * Ejecuta una sentencia SQL basada en el prefijo “$sentencia” + número,
 * y devuelve todas las filas completas (como array asociativo).
 *
 * @param mysqli $mysqli    Conexión activa.
 * @param string $sentencia Prefijo de la sentencia.
 * @param int    $num       Número de la sentencia a concatenar.
 * @return array            Array de filas (cada fila: array asociativo).
 */
function obtenerFilas(mysqli $mysqli, string $sentencia, int $num): array
{
    $resSent = $mysqli->query($sentencia . $num);
    if (!$resSent) {
        return [];
    }

    $sqlDatos = '';
    while ($filaSent = $resSent->fetch_assoc()) {
        $conds = str_replace('|', '\'', $filaSent['condiciones']);
        $sqlDatos = $filaSent['campos'] . $filaSent['tablas'] . $conds;
    }
    if (empty($sqlDatos)) {
        return [];
    }

    $resDatos = $mysqli->query($sqlDatos);
    if (!$resDatos) {
        return [];
    }

    $filas = [];
    while ($fila = $resDatos->fetch_assoc()) {
        $filas[] = $fila;
    }
    return $filas;
}

/**
 * Construye la ruta real de un recurso (imagen, CSS, etc.) según el nivel de profundidad.
 *
 * @param string $rutaRelativa Ruta tal cual viene almacenada en BD.
 * @return string              Ruta con el prefijo correspondiente ($repoPrefix).
 */
function rutaPorNivel(string $rutaRelativa): string
{
    global $nivelMap, $nivel;
    $prefix = $nivelMap[$nivel]['repo_prefix'] ?? '';
    return $prefix . ltrim($rutaRelativa, '/');
}