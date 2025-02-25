<?php

class FlexTitleLoader {
     public static function setDirection($direction) {
          $types = [
               'izquierda' => 'flex-row-reverse',
               'derecha' => 'flex-row',
               'abajo' => 'flex-column',
               'arriba' => 'flex-column-reverse',
          ];
          
          return $types[$direction];
     }
}
