<?php

/**
 * Clase encargada de generar los estilos y posicionamiento
 * de la etiqueta <a></a> o <button></button>
 */
class ButtonStylesBannerBuilder
{

    /**
     * Construye y devuelve un conjunto de estilos
     * CSS teniendo en cuenta los parametros suministrados.
     * 
     * @param string $color      El valor del color en rgb.
     * @param string $alpha      El valor del alpha channel que define la transaparencia.
     * @param string $top        El valor de cuanto porcentaje debe estar separado del top
     * @param string $left       El valor de cuanto porcentaje debe estar separado de la parte izquierda
     * 
     * @return string Devuelve un string con los estilos CSS de un boton.
     * 
     * Ejemplo de uso:
     * $styles = ButtonStylesBannerBuilder::buildStyles($row_db[$i]['color'], $row_db['transparencia'], $row_db['porcentajeTop'], $row_db['porcentajeLeft']);
     */
    public static function buildStyles($color = '0, 0, 0', $alpha = '0.5', $top = '0', $left = '0')
    {

        if($alpha > 1) $alpha = 1;

        return
            '
         background: rgba(' . $color . ', ' . $alpha . '); 
         top: ' . $top . '%;
         left: ' . $left . '%;
        ';
    }
}
