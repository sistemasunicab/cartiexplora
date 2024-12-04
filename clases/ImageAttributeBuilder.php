<?php

/**
 * Clase responsable de generar los atributos de la etiqueta IMG
 */
class ImageAttributeBuilder
{
    /**
     * Construye y devuelve un conjunto de atributos de la etiqueta img con base a los parametros dados.
     * 
     * @param string $nivel      El nivel en el arbol de directorios donde sera accedida la imagen.
     * @param string $source     El atributo source con la URL o path de la imagen.
     * @param string $alt        (opcional) El texto alternativo de la imagen. Por defecto es un string vacío.
     * @param string $sourceOver (opcional) El atributo source con la URL o path secundario para hacer el efecto hover. Por defecto es un string vacío.
     * 
     * @return string Devuelve un string con los atributos de la etiqueta image.
     * 
     * Ejemplo de uso:
     * $attributes = ImageAttributeBuilder::buildAttributes('raiz', $row_db['ruta'], $row_db['textoAlterno'], $row_db['rutaEncima']);
     */
    public static function buildAttributes($nivel, $source, $alt = '', $sourceOver = '')
    {
        $attributes = '';
        if ($nivel == "raiz") {
            $attributes = ' src="' . $source . '" alt="' . $alt . '"';
            if ($sourceOver != '') {
                $attributes .= 'onmouseover="this.src = \'' . $sourceOver . '\';" onmouseout="this.src = \'' . $source . '\';"';
            }
            return $attributes;
        } else if ($nivel == "uno") {
            $attributes = ' src="../' . $source . '" alt="' . $alt . '"';
            if ($sourceOver != '') {
                $attributes .= 'onmouseover="this.src = \'../' . $sourceOver . '\';"onmouseout="this.src = \'../' . $source . '\';"';
            }
            return $attributes;
        } else if ($nivel == "dos") {
            $attributes = ' src="../../' . $source . '" alt="' . $alt . '"';
            if ($sourceOver != '') {
                $attributes .= 'onmouseover="this.src = \'../../' . $sourceOver . '\';" onmouseout="this.src = \'../../' . $source . '\';"';
            }
            return $attributes;
        } else if ($nivel == "tres") {
            $attributes = ' src="../../../' . $source . '" alt="' . $alt . '"';

            if ($sourceOver != '') {
                $attributes .= 'onmouseover="this.src = \'../../../' . $sourceOver . '\';" onmouseout="this.src = \'../../../' . $source . '\';"';
            }
            return $attributes;
        }
    }
}
