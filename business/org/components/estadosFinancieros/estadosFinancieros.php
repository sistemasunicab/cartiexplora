<?php
$numero_de_estados_financieros = "73";
$res_estados_financieros = $mysqli1->query($sentencia . $numero_de_estados_financieros);
while ($row_estados_financieros = $res_estados_financieros->fetch_assoc()) {
    $condiciones_estados_financieros = str_replace('|', '\'', $row_estados_financieros['condiciones']);
    $sql_datos_estados_financieros = $row_estados_financieros['campos'] . $row_estados_financieros['tablas'] . $condiciones_estados_financieros;
}

$res_datos_estados_financieros = $mysqli1->query($sql_datos_estados_financieros);

while ($row_datos_estados_financieros = $res_datos_estados_financieros->fetch_assoc()) {
    $html_estados_financieros = '<div class="col-9 my-5 p-0 mx-auto d-flex flex-column">';
    $html_estados_financieros .= '<h3 class="tx-blue font-roboto-light-title">' . $row_datos_estados_financieros['titulo'] . '</h3>';
    $html_estados_financieros .= '<div class="btn-financiero col-3 d-flex flex-row bg-blue p-0 m-0 my-5">
                                <div class="bg-orange m-0 p-0 col-2" style="height:100%;"></div>
                                <p class="special-paragraph py-1 col-10 font-roboto-italic tx-white text-center my-1">Solicitar información</p></div> ';
    $html_estados_financieros .= '<div class="form-financial col-12 p-0 mx-auto d-flex flex-column">';
    $html_estados_financieros .= '<input type="text" class="text-center font-roboto-bolditalic col-6 mx-auto my-2" placeholder="Usuario email">';
    $html_estados_financieros .= '<input type="password" class="text-center font-roboto-bolditalic col-6 mx-auto my-2" placeholder="Password">';
    $html_estados_financieros .= '<button class="btn p-2 bg-orange col-2 mx-auto d-flex flex-row align-items-center justify-content-center mt-3">';
    $html_estados_financieros .= '<p class="special-paragraph font-roboto-medium tx-white m-0 mx-2">Solicitar</p>';
    $html_estados_financieros .= '<span class="icono-envio">✈️</span>';
    $html_estados_financieros .= '</button>';
    $html_estados_financieros .= '</div>';

    $html_estados_financieros .= '</div>';

}
?>

<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <?php
        echo $html_estados_financieros;
        ?>
    </div>
</div>