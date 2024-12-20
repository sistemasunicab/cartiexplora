<?php

class FlexTitleLoader {
     public static function setDirection($direction) {
          $types = [
               'izquierda' => 'flex-direction-left',
               'derecha' => 'flex-direction-right',
               'abajo' => 'flex-direction-bottom',
               'arriba' => 'flex-direction-up',
          ];
          
          return $types[$direction];
     }
}