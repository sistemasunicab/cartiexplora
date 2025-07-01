<?php
    class GenerateQuery
    {
        /*private $valores;
        private $mysqli1;

        // Constructor que recibe un array asociativo
        public function __construct(array $valores) {
            $this->valores = $valores; // Almacenamos el array recibido
        }*/

        // Método para transformar los valores en una cadena
        public static function querySql($mysqli1, $sentenciaFinal, array $valores) {
            $sql_datos = "";
            $control = 0;

            $res_sentencia = $mysqli1->query($sentenciaFinal);
            while($row_sentencia = $res_sentencia->fetch_assoc()){
                //Se valida si es insert
                if ($row_sentencia['inserciones'] != "") {
                    $sql_datos = str_replace('|', '\'', $row_sentencia['tablas'])
                    .str_replace('|', '\'', $row_sentencia['inserciones']);
                    $control = 1;
                }
                
                //Se valida si es actualización
                if ($control == 0) {
                    if ($row_sentencia['modificaciones'] != "") {
                        $sql_datos = str_replace('|', '\'', $row_sentencia['tablas'])
                        .str_replace('|', '\'', $row_sentencia['modificaciones'])
                        .str_replace('|', '\'', $row_sentencia['condiciones']);
                        $control = 1;
                    }
                }

                //Se valida si la consulta es con JOIN de tablas
                if ($control == 0) {
                    if ($row_sentencia['utilizaJoin'] == "SI") {
                        //Se valida si es una consulta con funciones de agregación
                        if ($row_sentencia['agrupaciones'] != "" && $row_sentencia['agrupaciones'] != NULL) {
                            //Se valida si tiene condiciones de agregación (Having)
                            if ($row_sentencia['condicionesAgrupaciones'] != "") {
                                //Se valida si tiene ordenamientos
                                if ($row_sentencia['ordenamientos'] != "") {
                                    $sql_datos = str_replace('|', '\'', $row_sentencia['campos'])
                                    .$row_sentencia['joinTablas']
                                    .str_replace('|', '\'', $row_sentencia['condiciones'])
                                    .$row_sentencia['agrupaciones']
                                    .$row_sentencia['condicionesAgrupaciones']
                                    .$row_sentencia['ordenamientos'];
                                } else {
                                    $sql_datos = str_replace('|', '\'', $row_sentencia['campos'])
                                    .$row_sentencia['joinTablas']
                                    .str_replace('|', '\'', $row_sentencia['condiciones'])
                                    .$row_sentencia['agrupaciones']
                                    .$row_sentencia['condicionesAgrupaciones'];
                                }
                            } else {
                                //Se valida si tiene ordenamientos
                                if ($row_sentencia['ordenamientos'] != "") {
                                    $sql_datos = str_replace('|', '\'', $row_sentencia['campos'])
                                    .$row_sentencia['joinTablas']
                                    .str_replace('|', '\'', $row_sentencia['condiciones'])
                                    .$row_sentencia['agrupaciones']
                                    .$row_sentencia['ordenamientos'];
                                } else {
                                    $sql_datos = str_replace('|', '\'', $row_sentencia['campos'])
                                    .$row_sentencia['joinTablas']
                                    .str_replace('|', '\'', $row_sentencia['condiciones'])
                                    .$row_sentencia['agrupaciones'];
                                }
                            }
                        } else if ($row_sentencia['ordenamientos'] != "") { //Se valida si tiene ordenamientos
                            $sql_datos = str_replace('|', '\'', $row_sentencia['campos'])
                            .$row_sentencia['joinTablas']
                            .str_replace('|', '\'', $row_sentencia['condiciones'])
                            .$row_sentencia['ordenamientos'];
                        } else {
                            $sql_datos = str_replace('|', '\'', $row_sentencia['campos'])
                            .$row_sentencia['joinTablas']
                            .str_replace('|', '\'', $row_sentencia['condiciones']);
                        }
                    } else { //Es una consulta que no utiliza JOIN
                        //Se valida si es una consulta con funciones de agregación
                        if ($row_sentencia['agrupaciones'] != "" && $row_sentencia['agrupaciones'] != NULL) {
                            //Se valida si tiene condiciones de agregación (Having)
                            if ($row_sentencia['condicionesAgrupaciones'] != "") {
                                //Se valida si tiene ordenamientos
                                if ($row_sentencia['ordenamientos'] != "") {
                                    $sql_datos = str_replace('|', '\'', $row_sentencia['campos'])
                                    .str_replace('|', '\'', $row_sentencia['tablas'])
                                    .str_replace('|', '\'', $row_sentencia['condiciones'])
                                    .$row_sentencia['agrupaciones']
                                    .$row_sentencia['condicionesAgrupaciones']
                                    .$row_sentencia['ordenamientos'];
                                } else {
                                    $sql_datos = str_replace('|', '\'', $row_sentencia['campos'])
                                    .str_replace('|', '\'', $row_sentencia['tablas'])
                                    .str_replace('|', '\'', $row_sentencia['condiciones'])
                                    .$row_sentencia['agrupaciones']
                                    .$row_sentencia['condicionesAgrupaciones'];
                                }
                            } else {
                                //Se valida si tiene ordenamientos
                                if ($row_sentencia['ordenamientos'] != "") {
                                    $sql_datos = str_replace('|', '\'', $row_sentencia['campos'])
                                    .str_replace('|', '\'', $row_sentencia['tablas'])
                                    .str_replace('|', '\'', $row_sentencia['condiciones'])
                                    .$row_sentencia['agrupaciones']
                                    .$row_sentencia['ordenamientos'];
                                } else {
                                    $sql_datos = str_replace('|', '\'', $row_sentencia['campos'])
                                    .str_replace('|', '\'', $row_sentencia['tablas'])
                                    .str_replace('|', '\'', $row_sentencia['condiciones'])
                                    .$row_sentencia['agrupaciones'];
                                }
                            }
                        } else if ($row_sentencia['ordenamientos'] != "") { //Se valida si tiene ordenamientos
                            $sql_datos = str_replace('|', '\'', $row_sentencia['campos'])
                            .str_replace('|', '\'', $row_sentencia['tablas'])
                            .str_replace('|', '\'', $row_sentencia['condiciones'])
                            .$row_sentencia['ordenamientos'];
                        } else {
                            $sql_datos = str_replace('|', '\'', $row_sentencia['campos'])
                            .str_replace('|', '\'', $row_sentencia['tablas'])
                            .str_replace('|', '\'', $row_sentencia['condiciones']);
                        }
                    }
                }                
            }

            // Recorremos el array asociativo
            foreach ($valores as $clave => $valor) {
                $sql_datos = str_replace($clave, $valor, $sql_datos);
            }

            return $sql_datos;
        }
    }
?>