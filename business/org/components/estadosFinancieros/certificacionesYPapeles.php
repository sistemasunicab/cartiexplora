<?php
$numero_de_certificaciones = "74";
$res_certificaciones = $mysqli1->query($sentencia . $numero_de_certificaciones);
while ($row_certificaciones = $res_certificaciones->fetch_assoc()) {
    $condiciones_certificaciones = str_replace('|', '\'', $row_certificaciones['condiciones']);
    $sql_datos_certificaciones = $row_certificaciones['campos'] . $row_certificaciones['tablas'] . $condiciones_certificaciones;
}

$res_datos_certificaciones = $mysqli1->query($sql_datos_certificaciones);

while ($row_datos_certificaciones = $res_datos_certificaciones->fetch_assoc()) {
    $html_certificaciones = '<div class="col-9 my-5 p-0 mx-auto d-flex flex-column">';
    $html_certificaciones .= '<h3 class="col-7 tx-blue font-roboto-light-title">' . $row_datos_certificaciones['titulo'] . '</h3>';
    // Primera fila
    $html_certificaciones .= '<div class="my-5 form-financial d-flex flex-column">';

    // Primera fila
    $html_certificaciones .= '<div class="my-2 d-flex flex-row justify-content-between">';
    $html_certificaciones .= '<input type="text" class="col-4 font-roboto-bolditalic my-2" placeholder="Nombre Completo">';
    $html_certificaciones .= '<input type="text" class="col-4 font-roboto-bolditalic my-2" placeholder="Número de identificación">';

    // Dropdown "Tipo"
    $html_certificaciones .= '<div class="btn-group col-3 my-2">';
    $html_certificaciones .= '<button class="dropdown-toggle col-3 display-options btn p-0 d-flex flex-row" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
    $html_certificaciones .= '<p class="little-paragraph col-9 m-auto font-roboto-italic tx-white">Tipo</p>';
    $html_certificaciones .= '<span class="col-3 d-flex justify-content-center align-items-center p-0">▼</span>';
    $html_certificaciones .= '</button>';
    $html_certificaciones .= '<ul class="dropdown-menu w-100" aria-labelledby="dropdownTipo">';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Estudiante</a></li>';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Docente</a></li>';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Administrativo</a></li>';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Otro</a></li>';
    $html_certificaciones .= '</ul>';
    $html_certificaciones .= '</div>'; // Cierre btn-group

    $html_certificaciones .= '</div>'; // Cierre fila

    // Segunda fila
    $html_certificaciones .= '<div class="my-2 d-flex flex-row justify-content-between">';
    $html_certificaciones .= '<input type="email" class="col-4 font-roboto-bolditalic my-2" placeholder="Correo electrónico">';
    $html_certificaciones .= '<input type="text" class="col-4 font-roboto-bolditalic my-2" placeholder="Número de teléfono">';

    // Dropdown "Grado"
    $html_certificaciones .= '<div class="btn-group col-3 my-2">';
    $html_certificaciones .= '<button class="dropdown-toggle col-3 display-options btn p-0 d-flex flex-row" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
    $html_certificaciones .= '<p class="little-paragraph col-9 m-auto font-roboto-italic tx-white">Grado</p>';
    $html_certificaciones .= '<span class="col-3 d-flex justify-content-center align-items-center p-0">▼</span>';
    $html_certificaciones .= '</button>';
    $html_certificaciones .= '<ul class="dropdown-menu w-100" aria-labelledby="dropdownGrado">';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Primaria</a></li>';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Secundaria</a></li>';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Universitario</a></li>';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Otro</a></li>';
    $html_certificaciones .= '</ul>';
    $html_certificaciones .= '</div>'; // Cierre btn-group

    $html_certificaciones .= '</div>'; // Cierre fila
    $html_certificaciones .= '</div>'; // Cierre contenedor principal

    // Dropdown "Relación con la institución"

    $html_certificaciones .= '<div class="my-2 btn-group col-4 my-2">';
    $html_certificaciones .= '<button class="dropdown-toggle col-3 display-options btn p-0 d-flex flex-row" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
    $html_certificaciones .= '<p class="little-paragraph col-9 m-auto font-roboto-italic tx-white">Relación con la institución</p>';
    $html_certificaciones .= '<span class="col-3 d-flex justify-content-center align-items-center p-0">▼</span>';
    $html_certificaciones .= '</button>';
    $html_certificaciones .= '<ul class="dropdown-menu w-100">';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Estudiante actual</a></li>';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Exalumno</a></li>';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Padre de familia</a></li>';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Maestro mediador</a></li>';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Otro (especificar)</a></li>';
    $html_certificaciones .= '</ul>';
    $html_certificaciones .= '</div>';

    $html_certificaciones .= '<div class="my-2 btn-financiero col-3 d-flex flex-row bg-blue p-0 m-0 my-5">
                                <div class="bg-orange m-0 p-0 col-2" style="height:100%;"></div>
                                <p class="special-paragraph py-1 col-10 font-roboto-italic tx-white text-center my-1">Detalles de la Solicitud: </p></div> ';


    $html_certificaciones .= '<div class="my-2 btn-group col-4 my-2">';
    $html_certificaciones .= '<button class="dropdown-toggle col-3 display-options btn p-0 d-flex flex-row" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
    $html_certificaciones .= '<p class="little-paragraph col-9 m-auto font-roboto-italic tx-white">Tipo de certificación</p>';
    $html_certificaciones .= '<span class="col-3 d-flex justify-content-center align-items-center p-0">▼</span>';
    $html_certificaciones .= '</button>';
    $html_certificaciones .= '<ul class="dropdown-menu w-100">';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Estudiante actual</a></li>';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Exalumno</a></li>';
    $html_certificaciones .= '<li><a class="dropdown-item" href="#">Padre de familia</a></li>';
    $html_certificaciones .= '</ul>';
    $html_certificaciones .= '</div>';



    $html_certificaciones .= '</div>';

    $html_certificaciones .= '</div>';
}
?>

<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <?php
        echo $html_certificaciones;
        ?>
    </div>
</div>