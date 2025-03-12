<?php
$number_sentence_calendary = "57";
$res_sentence_calendary = $mysqli1->query($sentencia . $number_sentence_calendary);

while ($row_sentence_calendary = $res_sentence_calendary->fetch_assoc()) {
    $conditions_calendary = str_replace('|', '\'', $row_sentence_calendary['condiciones']);
    $sql_data_calendary = $row_sentence_calendary['campos'] . $row_sentence_calendary['tablas'] . $conditions_calendary;
}

$res_data_calendary = $mysqli1->query($sql_data_calendary);
while ($row_data_calendary = $res_data_calendary->fetch_assoc()) {
    $html_base = '<div class="p-0 col-9 m-auto my-5 d-flex flex-column">';
    // Display the title inside an h2
    $html_base .= '<h2 class="tx-blue font-roboto-light-title">' . ($row_data_calendary['titulo']) . '</h2>';
    // Fetch the SVG image with sentence #49
    $number_sentence_image = "63";
    $res_sentence_image = $mysqli1->query($sentencia . $number_sentence_image);

    while ($row_sentence_image = $res_sentence_image->fetch_assoc()) {
        $conditions_image = str_replace('|', '\'', $row_sentence_image['condiciones']);
        $sql_data_image = $row_sentence_image['campos'] . $row_sentence_image['tablas'] . $conditions_image;
    }

    $res_data_image = $mysqli1->query($sql_data_image);

    while ($row_data_image = $res_data_image->fetch_assoc()) {
        $ruta = htmlspecialchars($row_data_image['ruta']);
        $alt = htmlspecialchars($row_data_image['textoAlterno'] ?? 'Imagen'); // Default alt text

        // Determine the correct path based on the $nivel variable
        $image_path = '';
        if ($nivel == "raiz") {
            $image_path = $ruta;
        } else if ($nivel == "uno") {
            $image_path = '../' . $ruta;
        } else if ($nivel == "dos") {
            $image_path = '../../' . $ruta;
        } else if ($nivel == "tres") {
            $image_path = '../../../' . $ruta;
        }

        $html_base .= '<div class="d-flex align-items-center text-center m-auto mt-10">';
        $html_base .= '<img src="' . $image_path . '" alt="' . $alt . '" class="img-fluid" style="width:140px;">';
        // Add the "Ver" button with margin-left, box shadow, circular border, and auto height
        $html_base .= '<button class="ml-20 btn shadow h-auto tx-color-wh btn-calendary fw-semibold" style="width:200px;">Ver</button>';
        $html_base .= '</div>';
        $html_base .= '</div>';
    }
}
?>

<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <?php
        echo $html_base;
        ?>
    </div>
</div>