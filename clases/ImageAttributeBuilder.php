<?php

/**
 * Class responsible for generating the attributes of the HTML image element
 */
class ImageAttributeBuilder
{
    /**
     * Builds and returns a set of img tag attributes based on the given parameters.
     * 
     * @param string $nivel      The level in the directory tree from which the image will be accessed.
     * @param string $source     The source URL or path of the image.
     * @param string $alt        (optional) The alternative text for the image. Default is an empty string.
     * @param string $sourceOver (optional) The secondary source URL or path for hover effects. Default is an empty string.
     * 
     * @return string Returns a string with the attributes of the image tag.
     * 
     * @author Cristian Ortiz
     * 
     * Usage example:
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
