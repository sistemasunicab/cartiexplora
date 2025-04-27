<?php
// 1) CHECK IF THE SECTION IS VISIBLE (Sentence #47)
$number_sentence_visible = "57";
$res_sentence_visible = $mysqli1->query($sentencia . $number_sentence_visible);

while ($row_sentence_visible = $res_sentence_visible->fetch_assoc()) {
    $conditions_visible = str_replace('|', '\'', $row_sentence_visible['condiciones']);
    $sql_data_visible = $row_sentence_visible['campos'] . $row_sentence_visible['tablas'] . $conditions_visible;
}

$res_data_visible = $mysqli1->query($sql_data_visible);

// Only display content if the section is visible
while ($row_data_visible = $res_data_visible->fetch_assoc()) {

    // 2) FETCH UPCOMING EVENTS (Sentence #51)
    $number_sentence_events = "65";
    $res_sentence_events = $mysqli1->query($sentencia . $number_sentence_events);
    while ($row_sentence_events = $res_sentence_events->fetch_assoc()) {
        $conditions_events = str_replace('|', '\'', $row_sentence_events['condiciones']);
        $sql_data_events = $row_sentence_events['campos'] . $row_sentence_events['tablas'] . $conditions_events;
    }
    $res_data_events = $mysqli1->query($sql_data_events);

    // 2) Contenedor principal
    $html_next_event = '<div class="next-events-container col-lg-8 col-md-8 col-sm-12 col-12 p-0 m-auto my-5 d-flex flex-column">';
    $html_next_event .= '<div class="w-100 m-auto d-flex flex-column bg-bold-blue shadow">';
    $html_next_event .= '<div class="col-10 d-flex flex-column m-auto pt-5 pb-5">';

    // Título fijo (si lo hay)
    $html_next_event .= '<h4 class="font-roboto-bold tx-white">' . htmlspecialchars($row_data_visible['titulo']) . '</h4>';

    if ($res_data_events->num_rows === 0) {
        // Si no hay eventos próximos
        $html_next_event .= '<p class="tx-white text-center py-5">No hay eventos próximos</p>';
    } else {
        // Para cada evento
        while ($row = $res_data_events->fetch_assoc()) {
            $tituloEvento = htmlspecialchars($row['nombre']);
            $fecha = $row['fecha'];
            $hora = $row['hora'];
            // Formato ISO
            $fechaIso = date('c', strtotime("$fecha $hora"));
            $descEvento = htmlspecialchars($row_data_visible['texto']);
            $idEvento = 'evt' . ($row['id'] ?? rand(1000, 9999));

            $html_next_event .= '
        <div class="event-item mb-4">
            <h3 class="font-roboto-bold tx-orange">' . $tituloEvento . '</h3>
            <p id="info-evento-' . $idEvento . '" class="special-paragraph tx-white">' . $descEvento . '</p>

            <div class="countdown-container d-flex gap-3 justify-content-center font-roboto-bold my-2 fs-5"
                 data-fecha="' . $fechaIso . '"
                 id="countdown-' . $idEvento . '">

                <div class="calendary-event col-2 bg-white tx-orange d-flex border-radius-20">
                    <h3 class="m-0 countdown-day">0</h3>
                </div>
                <div class="calendary-event col-2 bg-white tx-orange d-flex border-radius-20">
                    <h3 class="m-0 countdown-hour">0</h3>
                </div>
                <div class="calendary-event col-2 bg-white tx-orange d-flex border-radius-20">
                    <h3 class="m-0 countdown-min">0</h3>
                </div>
                <div class="calendary-event col-2 bg-white tx-orange d-flex border-radius-20">
                    <h3 class="m-0 countdown-sec">0</h3>
                </div>
            </div>
        </div>';
        }
    }
    $html_next_event .= '</div>';
    $html_next_event .= '</div>';
    $html_next_event .= '<button class="mx-auto mx-0 ms-md-auto me-md-5 mt-4 btn shadow h-auto tx-white btn-calendary fw-semibold" style="width:250px;">Más información</button>';
    $html_next_event .= '</div>';


}
?>

<div class="container-fluid m-0 p-0">
    <div class="row m-0 p-0">
        <?php
        echo $html_next_event;
        ?>
    </div>
</div>