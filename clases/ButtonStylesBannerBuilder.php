<?php

/**
 * Class in charge of generating the styles and positioning the <a></a> or <button></button> HTML tag
 */
class ButtonStylesBannerBuilder
{

    /**
     * Builds and returns a set of CSS styles based on the given parameters.
     * 
     * @param string $color      The rgb  color value for the background.
     * @param string $alpha      The alpha channel value to define transparency.
     * @param string $top        The value of how many percent should be separated from the top
     * @param string $left       The value of how many percent should be separated from the left part
     * 
     * @return string Returns a string with the CSS styles for a button.
     * 
     * @author Cristian Ortiz
     * 
     * Usage example:
     * $styles = ButtonStylesBannerBuilder::buildStyles($row_db[$i]['color'], $row_db['transparencia'], $row_db['porcentajeTop'], $row_db['porcentajeLeft']);
     */
    public static function buildStyles($color = '0, 0, 0', $alpha = '0.5', $top = '0', $left = '0')
    {

        if($alpha > 1) $alpha = 1;

        return
        'background: rgba(' . $color . ', ' . $alpha . '); top: ' . $top . '%; left: ' . $left . '%; transform: translateX(-'.$left.'%)';
    }
}
